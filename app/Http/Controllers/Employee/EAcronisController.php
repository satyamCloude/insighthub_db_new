<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;
use App\Models\OperatingSysten;
use App\Exports\AcronisExport; 
use App\Models\PaymentMethod;   
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use Illuminate\Support\Str;
use App\Models\IPAddress;
use App\Models\Countrys;
use App\Models\Currency;   
use App\Models\Firewall;
use App\Models\Product;
use App\Models\Switchs;
use App\Models\Acronis;   
use App\Models\Status;
use App\Models\User;
use App\Models\Host;
use App\Models\Rack;
use Hash;
use Auth;


class EAcronisController extends Controller
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
    
        if($RoleAccess[array_search('Acronis', array_column($RoleAccess, 'per_name'))]['view'] == 1)
        {
            $query = $request->get('search');
        
             $Acronis = Acronis::select('acronis.service_type','total_services.unique_id as unique_service_id','users.profile_img','users.email','acronis.id','acronis.signup_date','acronis.status','users.first_name','product_news.product_name')
            ->join('users','users.id','acronis.customer_id')
            ->join('product_news','product_news.id','acronis.product_id')
            ->leftjoin('total_services','total_services.invoice_id','acronis.invoice_id')
                ->where(function($q) use ($query) {
                    $q->where('acronis.service_type', 'LIKE', "%$query%")
                      ->orWhere('users.first_name', 'LIKE', "%$query%")
                      ->orWhere('product_news.product_name', 'LIKE', "%$query%");
                })
                 ->where('total_services.category_id',17)
            ->groupBy('total_services.unique_id')
            ->orderBy('acronis.created_at', 'desc')
                ->paginate(10);

             $Acronis->appends(['search' => $query]);

            $Total =  Acronis::count();
            $Active = Acronis::where('status', 1)->count();
            $Suspended = Acronis::where('status', 2)->count();
            $Terminated = Acronis::where('status', 3)->count();
            
        }

        if($RoleAccess[array_search('Acronis', array_column($RoleAccess, 'per_name'))]['view'] == 2)
        {
            $query = $request->get('search');
        
             $Acronis = Acronis::select('acronis.service_type','total_services.unique_id as unique_service_id','users.profile_img','users.email','acronis.id','acronis.signup_date','acronis.status','users.first_name','product_news.product_name')
            ->join('users','users.id','acronis.customer_id')
            ->join('product_news','product_news.id','acronis.product_id')
            ->leftjoin('total_services','total_services.invoice_id','acronis.invoice_id')
                ->where(function($q) use ($query) {
                    $q->where('acronis.service_type', 'LIKE', "%$query%")
                      ->orWhere('users.first_name', 'LIKE', "%$query%")
                      ->orWhere('product_news.product_name', 'LIKE', "%$query%");
                })
                ->where('total_services.category_id',17)
                ->where('acronis.user_id',Auth::user()->id)
                ->groupBy('total_services.unique_id')
                ->orderBy('acronis.created_at', 'desc')
                ->paginate(10);

             $Acronis->appends(['search' => $query]);

            $Total =  Acronis::where('user_id',Auth::user()->id)->count();
            $Active = Acronis::where('user_id',Auth::user()->id)->where('status', 1)->count();
            $Suspended = Acronis::where('user_id',Auth::user()->id)->where('status', 2)->count();
            $Terminated = Acronis::where('user_id',Auth::user()->id)->where('status', 3)->count();
                        
        }
        return view('Employee.Services.Acronis.home', compact('RoleAccess','Acronis','Active','Suspended','Terminated','query','Total'));
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
        $Log['subject'] = "Acronis Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Acronis/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('Employee.Services.Acronis.create',compact('Client','Vendor','Product','OperatingSysten','Currency','PaymentMethod','Status','Employee')); 
    }


    //home page
    public function store(Request $req)
    {
        $data = $req->all();
        $data['user_id'] = Auth::user()->id;
        $data['password'] = Hash::make($req->password);
        $datass = Acronis::create($data);

        $Host = $req->all();
        $Host['client_id'] = $req->customer_id;
        $Host['user_id'] = Auth::user()->id;
        $Host['service_id'] = $datass->id;
        $Host['host_name'] = $req->host_domain_name;
        $Host['product_id'] = $req->product_id;
        $Host['type'] = "Acronis";
        $Host['url'] = url('/').'/Employee/Acronis/store';
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
        $Log['subject'] = "Acronis Data Store By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Acronis/store';
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        
        return redirect('Employee/Acronis/home')->with('success', "New Acronis Added Successfully");
    }

    //edit
    public function edit(Request $req,$id)
    {
        $Acronis = Acronis::find($id);
       
        $Client = User::select('id','first_name')->where('type','2')->get();
        $Vendor = User::select('id','first_name')->where('type','3')->get();
        $Product = Product::select('id','product_name')->get();
        $OperatingSysten = OperatingSysten::get();
        $PaymentMethod = PaymentMethod::get();
        $Currency = Currency::get();
        $Status = Status::get();
        $Employee =  User::select('first_name','id')->where('type',4)->get();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Acronis Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Acronis/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('Employee.Services.Acronis.edit',compact('Acronis','Client','Vendor','Product','OperatingSysten','Currency','PaymentMethod','Status','Employee'));
    }

    //updated
public function update(Request $req, $id)
{
    // return $req->all();
        $data = Acronis::find($id);
        $data['user_id'] = Auth::user()->id;
        $data['customer_id'] = $req->customer_id;
        $data['product_id'] = $req->product_id;
        $data['host_domain_name'] = $req->host_domain_name;
        $data['vender_id'] = $req->vender_id;
        $data['service_type'] = $req->service_type;
        $data['status'] = $req->status;
        $data['Acronis_note'] = $req->Acronis_note;
        $data['first_payment'] = $req->first_payment;
        $data['billing_cycle'] = $req->billing_cycle;
        $data['currency_id'] = $req->currency_id;
        $data['payment_method_id'] = $req->payment_method_id;
        $data['signup_date'] = $req->signup_date;
        $data['next_due_date'] = $req->next_due_date;
        $data['terminate_date'] = $req->terminate_date;
        $data['no_of_license'] = $req->no_of_license;
        $data['protal_url'] = $req->protal_url;
        $data['username'] = $req->username;
        $data['sige_gb_usages'] = $req->sige_gb_usages;
        
        $data['license_management'] = $req->license_management;
        if($req->employee_id){
                        $empid = implode(",", $req->employee_id);
        
                }else{
                   $empid = 0; 
                }
        
        
            // Update other fields (assuming this part is unchanged)
            $data['employee_id'] = $empid;
        // $data['employee_id'] = $req->employee_id;
        $data['password'] = Hash::make($req->password);
        $data->save();

        $Host = Host::Where('service_id',$id)->where('type','Acronis')->first();
        $Host['client_id'] = $req->customer_id;
        $Host['host_name'] = $req->host_domain_name;
        $Host['product_id'] = $req->product_id;
        $Host['type'] = "Acronis";
        $Host['url'] = url('/').'/Employee/Acronis/update/'.$id;
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
        $Log['subject'] = "Acronis Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Acronis/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);     

        return redirect('Employee/Acronis/home')->with('success', "Acronis Edit Successfully");
    }

     public function delete(Request $request,$id)
    {
        Acronis::find($id)->delete();

        Host::where('service_id',$id)->where('type','Acronis')->delete();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Acronis Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Acronis/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('Employee/Acronis/home')->with('success', "Acronis Deleted Successfully");
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
            $Log['subject'] = "Acronis CSV Export  By " . Auth::user()->first_name;
            $Log['url'] = url('/') . '/Employee/Acronis/EXPORTCSV';
            $Log['method'] = "Get";
            $Log['browser'] = $browser . "-" . $version;
            LogActivity::create($Log);

            return Excel::download(new AcronisExport, 'Acronis.csv');
        }

}
