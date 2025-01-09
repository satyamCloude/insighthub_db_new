<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SSLCertificateExport; 
use Illuminate\Support\Collection;
use App\Models\OperatingSysten;
use App\Models\SSLCertificate;   
use App\Models\PaymentMethod;   
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
use App\Models\User;
use App\Models\Rack;
use App\Models\Host;
use Hash;
use Auth;


class ESSLCertificateController extends Controller
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
    
        if($RoleAccess[array_search('SSLCertificate', array_column($RoleAccess, 'per_name'))]['view'] == 1)
        {
            $query = $request->get('search');
        
        $SSLCertificate = SSLCertificate::select('s_s_l_certificates.service_type','total_services.unique_id as unique_service_id','users.profile_img','users.email','s_s_l_certificates.id','s_s_l_certificates.signup_date','s_s_l_certificates.status','users.first_name','product_news.product_name')
            ->join('users','users.id','s_s_l_certificates.customer_id')
            ->join('product_news','product_news.id','s_s_l_certificates.product_id')
            ->leftjoin('total_services','total_services.invoice_id','s_s_l_certificates.invoice_id')
            ->where(function($q) use ($query) {
                $q->where('s_s_l_certificates.service_type', 'LIKE', "%$query%")
                  ->orWhere('users.first_name', 'LIKE', "%$query%")
                  ->orWhere('product_news.product_name', 'LIKE', "%$query%");
            })
             ->where('total_services.category_id',14)
            ->groupBy('total_services.unique_id')
            ->orderBy('s_s_l_certificates.created_at', 'desc')
            ->paginate(10);
        
        
        $SSLCertificate->appends(['search' => $query]);

        $Total = SSLCertificate::count();
        $Active = SSLCertificate::where('status', 1)->count();
        $Suspended = SSLCertificate::where('status', 2)->count();
        $Terminated = SSLCertificate::where('status', 3)->count();
            
        }

        if($RoleAccess[array_search('SSLCertificate', array_column($RoleAccess, 'per_name'))]['view'] == 2)
        {
            $query = $request->get('search');
         $SSLCertificate = SSLCertificate::select('s_s_l_certificates.service_type','total_services.unique_id as unique_service_id','users.profile_img','users.email','s_s_l_certificates.id','s_s_l_certificates.signup_date','s_s_l_certificates.status','users.first_name','product_news.product_name')
            ->join('users','users.id','s_s_l_certificates.customer_id')
            ->join('product_news','product_news.id','s_s_l_certificates.product_id')
            ->leftjoin('total_services','total_services.invoice_id','s_s_l_certificates.invoice_id')
            ->where(function($q) use ($query) {
                $q->where('s_s_l_certificates.service_type', 'LIKE', "%$query%")
                  ->orWhere('users.first_name', 'LIKE', "%$query%")
                  ->orWhere('product_news.product_name', 'LIKE', "%$query%");
            })
            ->where('s_s_l_certificates.user_id',Auth::user()->id)
             ->where('total_services.category_id',14)
            ->groupBy('total_services.unique_id')
            ->orderBy('s_s_l_certificates.created_at', 'desc')
            ->paginate(10);
        
        $SSLCertificate->appends(['search' => $query]);

        $Total = SSLCertificate::where('user_id',Auth::user()->id)->count();
        $Active = SSLCertificate::where('user_id',Auth::user()->id)->where('status', 1)->count();
        $Suspended = SSLCertificate::where('user_id',Auth::user()->id)->where('status', 2)->count();
        $Terminated = SSLCertificate::where('user_id',Auth::user()->id)->where('status', 3)->count();
                    
        }
        
        return view('Employee.Services.SSLCertificate.home', compact('RoleAccess','SSLCertificate','Active','Suspended','Terminated','query','Total'));
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
        $Log['subject'] = "SSLCertificate Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/SSLCertificate/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('Employee.Services.SSLCertificate.create',compact('Client','Vendor','Product','OperatingSysten','Currency','PaymentMethod','Status','Employee')); 
    }


    //home page
    public function store(Request $req)
    {
        $data = $req->all();
        $data['user_id'] = Auth::user()->id;
        $datass = SSLCertificate::create($data);

        $Host = $req->all();
        $Host['user_id'] = Auth::user()->id;
        $Host['client_id'] = $req->customer_id;
        $Host['service_id'] = $datass->id;
        $Host['host_name'] = $req->host_domain_name;
        $Host['product_id'] = $req->product_id;
        $Host['type'] = "SSLCertificate";
        $Host['url'] = url('/').'/Employee/SSLCertificate/store';
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
        $Log['subject'] = "SSLCertificate Data Store By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/SSLCertificate/store';
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);
        
        return redirect('Employee/SSLCertificate/home')->with('success', "New SSLCertificate Added Successfully");
    }

    //edit
    public function edit(Request $req,$id)
    {
        $SSLCertificate = SSLCertificate::find($id);
       
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
        $Log['subject'] = "SSLCertificate Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/SSLCertificate/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('Employee.Services.SSLCertificate.edit',compact('SSLCertificate','Client','Vendor','Product','OperatingSysten','Currency','PaymentMethod','Status','Employee'));
    }

    //updated
public function update(Request $req, $id)
{
        $data = SSLCertificate::find($id);
        $data['customer_id'] = $req->customer_id;
        $data['product_id'] = $req->product_id;
        $data['host_domain_name'] = $req->host_domain_name;
        $data['os_id'] = $req->os_id;
        $data['vender_id'] = $req->vender_id;
        $data['service_type'] = $req->service_type;
        $data['first_payment'] = $req->first_payment;
        $data['billing_cycle'] = $req->billing_cycle;
        $data['currency_id'] = $req->currency_id;
        $data['payment_method_id'] = $req->payment_method_id;
        $data['signup_date'] = $req->signup_date;
        $data['next_due_date'] = $req->next_due_date;
        $data['terminate_date'] = $req->terminate_date;
        $data['status'] = $req->status;
        $data['license_key'] = $req->license_key;
        if($req->employee_id){
                        $empid = implode(",", $req->employee_id);
        
                }else{
                   $empid = 0; 
                }
        
        
            // Update other fields (assuming this part is unchanged)
            $data['employee_id'] = $empid;
        // $data['employee_id'] = $req->employee_id;
        $data['user_id'] = Auth::user()->id;
        $data->save();

        $Host = Host::Where('service_id',$id)->where('type','SSLCertificate')->first();
        $Host['client_id'] = $req->customer_id;
        $Host['host_name'] = $req->host_domain_name;
        $Host['product_id'] = $req->product_id;
        $Host['type'] = "SSLCertificate";
        $Host['url'] = url('/').'/Employee/SSLCertificate/update/'.$id;
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
        $Log['subject'] = "SSLCertificate Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/SSLCertificate/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);


        return redirect('Employee/SSLCertificate/home')->with('success', "SSLCertificate Edit Successfully");
    }

     public function delete(Request $request,$id)
    {
        SSLCertificate::find($id)->delete();

        Host::where('service_id',$id)->where('type','SSLCertificate')->delete();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "SSLCertificate Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/SSLCertificate/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('Employee/SSLCertificate/home')->with('success', "SSLCertificate Deleted Successfully");
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
            $Log['subject'] = "SSLCertificate CSV Export  By " . Auth::user()->first_name;
            $Log['url'] = url('/') . '/Employee/SSLCertificate/EXPORTCSV';
            $Log['method'] = "Get";
            $Log['browser'] = $browser . "-" . $version;
            LogActivity::create($Log);

            return Excel::download(new SSLCertificateExport, 'SSLCertificate.csv');
        }

}
