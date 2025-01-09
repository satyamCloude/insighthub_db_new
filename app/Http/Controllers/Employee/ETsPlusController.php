<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;
use App\Models\OperatingSysten;
use App\Models\PaymentMethod;   
use App\Exports\TsPlusExport; 
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use Illuminate\Support\Str;
use App\Models\IPAddress;
use App\Models\Countrys;
use App\Models\Employee;
use App\Models\Currency;   
use App\Models\Firewall;
use App\Models\Product;
use App\Models\Switchs;
use App\Models\Status;
use App\Models\TsPlus;   
use App\Models\User;
use App\Models\Rack;
use App\Models\Host;
use Hash;
use Auth;


class ETsPlusController extends Controller
{   
    //home page
    public function home(Request $request)
    {
         $RoleAccess = \App\Models\RoleAccess::select('role_accesses.add','role_accesses.view','role_accesses.update','role_accesses.delete','permissions.name as per_name')
                    ->join('employee_details','employee_details.job_role_id','role_accesses.role_id')
                    ->leftjoin('permissions','permissions.id','role_accesses.permission_id')
                    ->where('employee_details.user_id', Auth::user()->id)
                    ->where(function($query) {
                        $query->where('role_accesses.view', '!=', null)
                            ->orWhere('role_accesses.add', '!=', null)
                            ->orWhere('role_accesses.update', '!=', null)
                            ->orWhere('role_accesses.delete', '!=', null);
                    })
                    ->get()
                    ->toArray();
    
        if($RoleAccess[array_search('TsPlus', array_column($RoleAccess, 'per_name'))]['view'] == 1)
        {
            $query = $request->get('search');
        
             $TsPlus = TsPlus::select('ts_pluses.service_type','total_services.unique_id as unique_service_id','users.profile_img','users.email','ts_pluses.id','ts_pluses.signup_date','ts_pluses.status','users.first_name','product_news.product_name')
            ->join('users','users.id','ts_pluses.customer_id')
            ->join('product_news','product_news.id','ts_pluses.product_id')
             ->leftjoin('total_services','total_services.invoice_id','ts_pluses.invoice_id')
            ->where(function($q) use ($query) {
                $q->where('ts_pluses.service_type', 'LIKE', "%$query%")
                  ->orWhere('users.first_name', 'LIKE', "%$query%")
                  ->orWhere('product_news.product_name', 'LIKE', "%$query%");
            })
             ->where('total_services.category_id',18)
            ->groupBy('total_services.unique_id')
            ->orderBy('ts_pluses.created_at', 'desc')
            ->paginate(10);
             $TsPlus->appends(['search' => $query]);
            $Total = TsPlus::count();
            $Active = TsPlus::where('status', 1)->count();
            $Suspended = TsPlus::where('status', 2)->count();
            $Terminated = TsPlus::where('status', 3)->count();
            
        }

        if($RoleAccess[array_search('TsPlus', array_column($RoleAccess, 'per_name'))]['view'] == 2)
        {
            $query = $request->get('search');
        
            $TsPlus = TsPlus::select('ts_pluses.service_type','total_services.unique_id as unique_service_id','users.profile_img','users.email','ts_pluses.id','ts_pluses.signup_date','ts_pluses.status','users.first_name','product_news.product_name')
            ->join('users','users.id','ts_pluses.customer_id')
            ->join('product_news','product_news.id','ts_pluses.product_id')
             ->leftjoin('total_services','total_services.invoice_id','ts_pluses.invoice_id')
            ->where(function($q) use ($query) {
                $q->where('ts_pluses.service_type', 'LIKE', "%$query%")
                  ->orWhere('users.first_name', 'LIKE', "%$query%")
                  ->orWhere('product_news.product_name', 'LIKE', "%$query%");
            })
                ->where('ts_pluses.user_id',Auth::user()->id)
             ->where('total_services.category_id',18)
            ->groupBy('total_services.unique_id')
            ->orderBy('ts_pluses.created_at', 'desc')
                ->paginate(10);
             $TsPlus->appends(['search' => $query]);
            $Total = TsPlus::where('user_id',Auth::user()->id)->count();
            $Active = TsPlus::where('user_id',Auth::user()->id)->where('status', 1)->count();
            $Suspended = TsPlus::where('user_id',Auth::user()->id)->where('status', 2)->count();
            $Terminated = TsPlus::where('user_id',Auth::user()->id)->where('status', 3)->count();
                    
        }        
        return view('Employee.Services.TsPlus.home', compact('RoleAccess','TsPlus','Active','Suspended','Terminated','query','Total'));
    }




    //home page
    public function Create(Request $request)
    {   
        $Client = User::select('id','first_name')->where('type','2')->get();
        $Vendor = User::select('id','first_name')->where('type','3')->get();
        $Product = Product::select('id','product_name')->get();
        $OperatingSysten = OperatingSysten::get();
        $PaymentMethod = PaymentMethod::get();
        $Currency = Currency::get();
        $Status = Status::get();
        $Employee = User::select('first_name','id')->where('type',4)->get();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "TsPlus Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/TsPlus/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('Employee.Services.TsPlus.create',compact('Client','Vendor','Product','OperatingSysten','Currency','PaymentMethod','Status','Employee')); 
    }


    //home page
    public function store(Request $req)
    {
        $data = $req->all();
        $data['user_id'] = Auth::user()->id;
        $data['password'] = Hash::make($req->password);
        $datass = TsPlus::create($data);

        $Host = $req->all();
        $Host['user_id'] = Auth::user()->id;
        $Host['client_id'] = $req->customer_id;
        $Host['service_id'] = $datass->id;
        $Host['host_name'] = $req->host_domain_name;
        $Host['product_id'] = $req->product_id;
        $Host['type'] = "TsPlus";
        $Host['url'] = url('/').'/Employee/TsPlus/store';
        $Host['method'] = "Post";
        $Host['billing_cycle'] = $req->billing_cycle;
        $Host['singup'] = $req->signup_date;
        $Host['servicestype'] = $req->service_type;
        $Host['status'] = $req->status;
        Host::create($Host);

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "TsPlus Data Store By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/TsPlus/store';
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        
        return redirect('Employee/TsPlus/home')->with('success', "New TsPlus Added Successfully");
    }

    //edit
    public function edit(Request $req,$id)
    {
        $TsPlus = TsPlus::find($id);
       
        $Client = User::select('id','first_name')->where('type','2')->get();
        $Vendor = User::select('id','first_name')->where('type','3')->get();
        $Product = Product::select('id','product_name')->get();
        $OperatingSysten = OperatingSysten::get();
        $PaymentMethod = PaymentMethod::get();
        $Currency = Currency::get();
        $Status = Status::get();
        $Employee = User::select('first_name','id')->where('type',4)->get();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "TsPlus Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/TsPlus/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('Employee.Services.TsPlus.edit',compact('TsPlus','Client','Vendor','Product','OperatingSysten','Currency','PaymentMethod','Status','Employee'));
    }

    //updated
public function update(Request $req, $id)
{
        $data = TsPlus::find($id);
        $data['user_id'] = Auth::user()->id;
        $data['customer_id'] = $req->customer_id;
        $data['product_id'] = $req->product_id;
        $data['host_domain_name'] = $req->host_domain_name;
        $data['vender_id'] = $req->vender_id;
        $data['service_type'] = $req->service_type;
        $data['status'] = $req->status;
        $data['first_payment'] = $req->first_payment;
        $data['billing_cycle'] = $req->billing_cycle;
        $data['currency_id'] = $req->currency_id;
        $data['payment_method_id'] = $req->payment_method_id;
        $data['signup_date'] = $req->signup_date;
        $data['next_due_date'] = $req->next_due_date;
        $data['terminate_date'] = $req->terminate_date;
        $data['computer_id'] = $req->computer_id;
        $data['license_key'] = $req->license_key;
        $data['no_of_license'] = $req->no_of_license;
        if($req->employee_id){
                        $empid = implode(",", $req->employee_id);
        
                }else{
                   $empid = 0; 
                }
        
        
            // Update other fields (assuming this part is unchanged)
            $data['employee_id'] = $empid;
        // $data['employee_id'] = $req->employee_id;
        $data->save();    

        $Host = Host::Where('service_id',$id)->where('type','TsPlus')->first();
        $Host['client_id'] = $req->customer_id;
        $Host['host_name'] = $req->host_domain_name;
        $Host['product_id'] = $req->product_id;
        $Host['type'] = "TsPlus";
        $Host['url'] = url('/').'/Employee/TsPlus/update/'.$id;
        $Host['method'] = "Post";
        $Host['billing_cycle'] = $req->billing_cycle;
        $Host['singup'] = $req->signup_date;
        $Host['servicestype'] = $req->service_type;
        $Host['status'] = $req->status;
        $Host->save(); 

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "TsPlus Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/TsPlus/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);     

        return redirect('Employee/TsPlus/home')->with('success', "TsPlus Edit Successfully");
    }

     public function delete(Request $request,$id)
    {
        TsPlus::find($id)->delete();

         Host::where('service_id',$id)->where('type','TsPlus')->delete();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "TsPlus Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/TsPlus/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('Employee/TsPlus/home')->with('success', "TsPlus Deleted Successfully");
    }

      // ExportCSV
    public function EXPORTCSV(Request $request)
        {
            $agent = new Agent();
            $browser = $agent->browser();
            $version = $agent->version($browser);
            $Log = $request->all();
            $Log['user_id'] = Auth::user()->id;
            $Log['ip'] = $request->ip();
            $Log['subject'] = "TsPlus CSV Export  By " . Auth::user()->first_name;
            $Log['url'] = url('/') . '/Employee/TsPlus/EXPORTCSV';
            $Log['method'] = "Get";
            $Log['browser'] = $browser . "-" . $version;
            LogActivity::create($Log);

            return Excel::download(new TsPlusExport, 'TsPlus.csv');
        }

}
