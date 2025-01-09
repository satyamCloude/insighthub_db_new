<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AntivirusExport; 
use Illuminate\Support\Collection;
use App\Models\OperatingSysten;
use App\Models\PaymentMethod;   
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use Illuminate\Support\Str;
use App\Models\IPAddress;
use App\Models\Antivirus;   
use App\Models\Countrys;
use App\Models\Employee;
use App\Models\Currency;   
use App\Models\Firewall;
use App\Models\Product;
use App\Models\Switchs;
use App\Models\Status;
use App\Models\User;
use App\Models\Rack;
use App\Models\Host;
use Hash;
use Auth;


class EAntivirusController extends Controller
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
    
        if($RoleAccess[array_search('Antivirus', array_column($RoleAccess, 'per_name'))]['view'] == 1)
        {
            $query = $request->get('search');
        
             $Antivirus = Antivirus::select('antiviri.service_type','total_services.unique_id as unique_service_id','users.profile_img','users.email','antiviri.id','antiviri.signup_date','antiviri.status','users.first_name','product_news.product_name')
            ->join('users','users.id','antiviri.customer_id')
            ->join('product_news','product_news.id','antiviri.product_id')
            ->leftjoin('total_services','total_services.invoice_id','antiviri.invoice_id')
            ->where(function($q) use ($query) {
                $q->where('antiviri.service_type', 'LIKE', "%$query%")
                  ->orWhere('users.first_name', 'LIKE', "%$query%")
                  ->orWhere('product_news.product_name', 'LIKE', "%$query%");
            })
            ->where('total_services.category_id',15)
            ->groupBy('total_services.unique_id')
            ->orderBy('antiviri.created_at', 'desc')
            ->paginate(10);
            $Antivirus->appends(['search' => $query]);

            $Total = Antivirus::count();
            $Active = Antivirus::where('status', 1)->count();
            $Suspended = Antivirus::where('status', 2)->count();
            $Terminated = Antivirus::where('status', 3)->count();
            
        }

        if($RoleAccess[array_search('Antivirus', array_column($RoleAccess, 'per_name'))]['view'] == 2)
        {
            $query = $request->get('search');
        
             $Antivirus = Antivirus::select('antiviri.service_type','total_services.unique_id as unique_service_id','users.profile_img','users.email','antiviri.id','antiviri.signup_date','antiviri.status','users.first_name','product_news.product_name')
            ->join('users','users.id','antiviri.customer_id')
            ->join('product_news','product_news.id','antiviri.product_id')
            ->leftjoin('total_services','total_services.invoice_id','antiviri.invoice_id')
                ->where(function($q) use ($query) {
                    $q->where('antiviri.service_type', 'LIKE', "%$query%")
                      ->orWhere('users.first_name', 'LIKE', "%$query%")
                      ->orWhere('product_news.product_name', 'LIKE', "%$query%");
                })
                ->where('total_services.category_id',15)
                ->where('antiviri.user_id',Auth::user()->id)
            ->groupBy('total_services.unique_id')
            ->orderBy('antiviri.created_at', 'desc')
                ->paginate(10);
            $Antivirus->appends(['search' => $query]);

            $Total = Antivirus::where('user_id',Auth::user()->id)->count();
            $Active = Antivirus::where('user_id',Auth::user()->id)->where('status', 1)->count();
            $Suspended = Antivirus::where('user_id',Auth::user()->id)->where('status', 2)->count();
            $Terminated = Antivirus::where('user_id',Auth::user()->id)->where('status', 3)->count();
                    
        }

        

        
        return view('Employee.Services.Antivirus.home', compact('RoleAccess','Antivirus','Active','Suspended','Terminated','query','Total'));
    }



 //create page
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
        $Log['subject'] = "Antivirus Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Antivirus/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('Employee.Services.Antivirus.create',compact('Client','Vendor','Product','OperatingSysten','Currency','PaymentMethod','Status','Employee')); 
    }


    //store page
    public function store(Request $req)
    {
        $data = $req->all();
        $data['user_id'] = Auth::user()->id;
        $data['password'] = Hash::make($req->password);
        $datass = Antivirus::create($data);

        $Host = $req->all();
        $Host['client_id'] = $req->customer_id;
        $Host['service_id'] = $datass->id;
        $Host['host_name'] = $req->host_domain_name;
        $Host['product_id'] = $req->product_id;
        $Host['type'] = "Antivirus";
        $Host['url'] = url('/').'/Employee/Antivirus/store';
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
        $Log['subject'] = "Antivirus Data Store By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Antivirus/store';
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        
        return redirect('Employee/Antivirus/home')->with('success', "New Antivirus Added Successfully");
    }

    //edit
    public function edit(Request $req,$id)
    {
        $Antivirus = Antivirus::find($id);
       
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
        $Log['subject'] = "Antivirus Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Antivirus/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('Employee.Services.Antivirus.edit',compact('Antivirus','Client','Vendor','Product','OperatingSysten','Currency','PaymentMethod','Status','Employee'));
    }

    //updated
public function update(Request $req, $id)
{
        $data = Antivirus::find($id);
        $data['user_id'] = Auth::user()->id;
        $data['customer_id'] = $req->customer_id;
        $data['product_id'] = $req->product_id;
        $data['host_domain_name'] = $req->host_domain_name;
        $data['quantity'] = $req->quantity;
        $data['vender_id'] = $req->vender_id;
        $data['service_type'] = $req->service_type;
        $data['status'] = $req->status;
        $data['antivirus_note'] = $req->antivirus_note;
        $data['first_payment'] = $req->first_payment;
        $data['billing_cycle'] = $req->billing_cycle;
        $data['currency_id'] = $req->currency_id;
        $data['payment_method_id'] = $req->payment_method_id;
        $data['signup_date'] = $req->signup_date;
        $data['next_due_date'] = $req->next_due_date;
        $data['terminate_date'] = $req->terminate_date;
        $data['protal_url'] = $req->protal_url;
        $data['username'] = $req->username;
        $data['password'] = Hash::make($req->password);
        $data['license_key'] = $req->license_key;
        $data['valid_domain_upto'] = $req->valid_domain_upto;
        $data['license_management'] = $req->license_management;
        $data['employee_id'] = $req->user_id;
        $data->save();   

        $Host = Host::Where('service_id',$id)->where('type','Antivirus')->first();
        $Host['client_id'] = $req->customer_id;
        $Host['host_name'] = $req->host_domain_name;
        $Host['product_id'] = $req->product_id;
        $Host['type'] = "Antivirus";
        $Host['url'] = url('/').'/Employee/Antivirus/update/'.$id;
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
        $Log['subject'] = "Antivirus Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Antivirus/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log); 

        return redirect('Employee/Antivirus/home')->with('success', "Antivirus Edit Successfully");
    }

    //delete
     public function delete(Request $request,$id)
    {
        Antivirus::find($id)->delete();

        Host::where('service_id',$id)->where('type','Antivirus')->delete();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Antivirus Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Antivirus/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('Employee/Antivirus/home')->with('success', "Antivirus Deleted Successfully");
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
            $Log['subject'] = "Antivirus CSV Export  By " . Auth::user()->first_name;
            $Log['url'] = url('/') . '/Employee/Antivirus/EXPORTCSV';
            $Log['method'] = "Get";
            $Log['browser'] = $browser . "-" . $version;
            LogActivity::create($Log);

            return Excel::download(new AntivirusExport, 'Antivirus.csv');
        }

}
