<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use App\Models\OperatingSysten;
use App\Models\PaymentMethod;   
use App\Exports\AzureExport; 
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use Illuminate\Support\Str;
use App\Models\IPAddress;
use App\Models\Currency;   
use App\Models\Countrys;
use App\Models\Employee;
use App\Models\Firewall;
use App\Models\Switchs;
use App\Models\Product;
use App\Models\Azure2;   
use App\Models\Status;
use App\Models\Host;
use App\Models\Azure;   
use App\Models\User;
use App\Models\Rack;
use Hash;
use Auth;


class EAzureController extends Controller
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
    
        if($RoleAccess[array_search('Azure', array_column($RoleAccess, 'per_name'))]['view'] == 1)
        {
            $query = $request->get('search');
        
       $Azure = Azure::select('azures.service_type','total_services.unique_id as unique_service_id','users.profile_img','users.email','azures.id','azures.signup_date','azures.status','users.first_name','product_news.product_name')
            ->join('users','users.id','azures.customer_id')
            ->join('product_news','product_news.id','azures.product_id')
            ->leftjoin('total_services','total_services.invoice_id','azures.invoice_id')
            ->where(function($q) use ($query) {
                $q->where('azures.service_type', 'LIKE', "%$query%")
                  ->orWhere('users.first_name', 'LIKE', "%$query%")
                  ->orWhere('product_news.product_name', 'LIKE', "%$query%");
            })
             ->where('total_services.category_id',9)
            ->groupBy('total_services.unique_id')
            ->orderBy('azures.created_at', 'desc')
            ->paginate(10);


        $Azure->appends(['search' => $query]);

        $Total = Azure::count();
        $Active = Azure::where('status', 1)->count();
        $Suspended = Azure::where('status', 2)->count();
        $Terminated = Azure::where('status', 3)->count();
            
        }

        if($RoleAccess[array_search('Azure', array_column($RoleAccess, 'per_name'))]['view'] == 2)
        {
            $query = $request->get('search');
        
            $Azure = Azure::select('azures.service_type','total_services.unique_id as unique_service_id','users.profile_img','users.email','azures.id','azures.signup_date','azures.status','users.first_name','product_news.product_name')
            ->join('users','users.id','azures.customer_id')
            ->join('product_news','product_news.id','azures.product_id')
            ->leftjoin('total_services','total_services.invoice_id','azures.invoice_id')
                ->where('azures.user_id',Auth::user()->id)
                ->where(function($q) use ($query) {
                    $q->where('azures.service_type', 'LIKE', "%$query%")
                      ->orWhere('users.first_name', 'LIKE', "%$query%")
                      ->orWhere('product_news.product_name', 'LIKE', "%$query%");
                })
                ->where('total_services.category_id',9)
            ->groupBy('total_services.unique_id')
            ->orderBy('azures.created_at', 'desc')
                ->paginate(10);
    
            $Azure->appends(['search' => $query]);
    
            $Total = Azure::where('user_id',Auth::user()->id)->count();
            $Active = Azure::where('user_id',Auth::user()->id)->where('status', 1)->count();
            $Suspended = Azure::where('user_id',Auth::user()->id)->where('status', 2)->count();
            $Terminated = Azure::where('user_id',Auth::user()->id)->where('status', 3)->count();
            
        }
        
        return view('Employee.Services.Azure.home', compact('RoleAccess','Azure','Active','Suspended','Terminated','Total','query'));
    }




    //home page
    public function Create(Request $request)
    {   
        $additional_private_ip  = IPAddress::select('id','ip_address')->where('ip_type','2')->get();
        $additional_public_ip  = IPAddress::select('id','ip_address')->where('ip_type','1')->get();
        $primary_private_ip  = IPAddress::select('id','ip_address')->where('ip_type','2')->get();
        $primary_public_ip  = IPAddress::select('id','ip_address')->where('ip_type','1')->get();
        $Client = User::select('id','first_name')->where('type','2')->get();
        $Vendor = User::select('id','first_name')->where('type','3')->get();
        $Product = Product::select('id','product_name')->get();
        $OperatingSysten = OperatingSysten::get();
        $PaymentMethod = PaymentMethod::get();
        $Currency = Currency::get();
        $Country = Countrys::get();
        $Status = Status::get();
        $Rack = Rack::get();
        $Switchs = Switchs::select('id','switch_id')->get();
        $firewall = Firewall::select('id','firewall_serial_no')->get();
        $Employee = User::select('first_name','id')->where('type',4)->get();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Azure Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Azure/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('Employee.Services.Azure.create',compact('Client','Vendor','Product','OperatingSysten','Currency','PaymentMethod','Country','Rack','Status','primary_public_ip','additional_public_ip','primary_private_ip','additional_private_ip','Switchs','firewall','Employee')); 
    }


    //home page
    public function store(Request $req)
    {

        $url = url('/').'/public/images/';

        $data = $req->all();
        $data['azure_password'] = Hash::make($req->azure_password);
        $data['control_panel_password'] = Hash::make($req->control_panel_password);
        $data['user_id'] = Auth::user()->id;
        $datass =  Azure::create($data);


        foreach ($req->server_ip as $key => $value) {
        $data = new Azure2;
    
        $privateKey = 'Privatekey.jpg';
        if ($req->hasFile('Privatekey') && $req->file('Privatekey')[$key]->isValid()) {
            $rand = Str::random(4);
            $file = $req->file('Privatekey')[$key];
            $extension = $file->getClientOriginalExtension();
            $privateKey = 'Privatekey_'.$rand.'.'.$extension;
            $file->move('public/images/', $privateKey);
        }
    
        $publicKey = 'publickey.jpg';
        if ($req->hasFile('publickey') && $req->file('publickey')[$key]->isValid()) {
            $rand = Str::random(4);
            $file = $req->file('publickey')[$key];
            $extension = $file->getClientOriginalExtension();
            $publicKey = 'publickey_'.$rand.'.'.$extension;
            $file->move('public/images/', $publicKey);
        }
    
        $pemKey = 'pemkey.jpg';
        if ($req->hasFile('pemkey') && $req->file('pemkey')[$key]->isValid()) {
            $rand = Str::random(4);
            $file = $req->file('pemkey')[$key];
            $extension = $file->getClientOriginalExtension();
            $pemKey = 'pemkey_'.$rand.'.'.$extension;
            $file->move('public/images/', $pemKey);
        }
    
        $data['Privatekey'] = $url . $privateKey;
        $data['publickey'] = $url . $publicKey;
        $data['pemkey'] = $url . $pemKey;
        $data['server_ip'] = $value;
        $data['hostname'] = $req->hostname[$key];
        $data['rdp_ssh_username'] = $req->rdp_ssh_username[$key];
        $data['rdp_ssh_port'] = $req->rdp_ssh_port[$key];
        $data['rdp_ssh_password'] = bcrypt($req->rdp_ssh_password[$key]);
        $data['region'] = $req->region[$key];
        $data['azure_id'] = $datass->id;
        $data->save();
    }

        $Host = $req->all();
        $Host['user_id'] = Auth::user()->id;
        $Host['client_id'] = $req->customer_id;
        $Host['service_id'] = $datass->id;
        $Host['host_name'] = $req->host_domain_name;
        $Host['product_id'] = $req->product_id;
        $Host['type'] = "Azure";
        $Host['url'] = url('/').'/Employee/Azure/store';
        $Host['method'] = "Post";
        $Host['billing_cycle'] = $req->billing_cycle;
        $Host['singup'] = $req->signup_date;
        $Host['servicestype'] = $req->service_type;
        $Host['status'] = $req->status;
        Host::create($Host);

        $agent = new Agent();

        // Get user agent information
        $browser = $agent->browser();
        $version = $agent->version($browser); // Pass the browser name as an argument

        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Azure Data Store By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Azure/store';
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);


        
        return redirect('Employee/Azure/home')->with('success', "New Azure Added Successfully");
    }

    //edit
    public function edit(Request $req,$id)
    {
        $Azure = Azure::find($id);
        $additional_private_ip  = IPAddress::select('id','ip_address')->where('ip_type','2')->get();
        $additional_public_ip  = IPAddress::select('id','ip_address')->where('ip_type','1')->get();
        $primary_private_ip  = IPAddress::select('id','ip_address')->where('ip_type','2')->get();
        $primary_public_ip  = IPAddress::select('id','ip_address')->where('ip_type','1')->get();
        $Client = User::select('id','first_name')->where('type','2')->get();
        $Vendor = User::select('id','first_name')->where('type','3')->get();
        $firewall = Firewall::select('id','firewall_serial_no')->get();
        $Employee = User::select('first_name','id')->where('type',4)->get();
        $Product = Product::select('id','product_name')->get();
        $Switchs = Switchs::select('id','switch_id')->get();
        $OperatingSysten = OperatingSysten::get();
        $PaymentMethod = PaymentMethod::get();
        $Azure2 = Azure2::where('azure_id',$id)->get();
        $Currency = Currency::get();
        $Country = Countrys::get();
        $Status = Status::get();
        $Rack = Rack::get();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Azure Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Azure/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);


        return view('Employee.Services.Azure.edit',compact('Azure','Azure2','Client','Vendor','Product','OperatingSysten','Currency','PaymentMethod','Country','Rack','Status','primary_public_ip','additional_public_ip','primary_private_ip','additional_private_ip','Switchs','firewall','Employee'));
    }

    //updated
public function update(Request $req, $id)
{
    $url = url('/').'/public/images/';
        $data = Azure::find($id);

         if ($req->hasFile('architecture')) {
            $rand = Str::random(4);
            $file = $req->file('architecture');
            $extension = $file->getClientOriginalExtension();
            $architecture = 'architecture'.$rand.'.'.$extension;
            $file->move('public/images/', $architecture);

            $data['architecture'] = $url . $architecture;
        }
        $data['customer_id'] = $req->customer_id;
        $data['product_id'] = $req->product_id;
        $data['host_domain_name'] = $req->host_domain_name;
        $data['services_name'] = $req->services_name;
        $data['vender_id'] = $req->vender_id;
        $data['service_type'] = $req->service_type;
        $data['first_payment'] = $req->first_payment;
        $data['billing_cycle'] = $req->billing_cycle;
        $data['currency_id'] = $req->currency_id;
        $data['payment_method_id'] = $req->payment_method_id;
        $data['signup_date'] = $req->signup_date;
        $data['next_due_date'] = $req->next_due_date;
        $data['terminate_date'] = $req->terminate_date;
        $data['azure_account_Id'] = $req->azure_account_Id;
        $data['status'] = $req->status;
        $data['azure_notes'] = $req->azure_notes;
        $data['azure_login_url'] = $req->azure_login_url;
        $data['azure_username'] = $req->azure_username;
        $data['hosting_control_panel'] = $req->hosting_control_panel;
        $data['control_panel_user_name'] = $req->control_panel_user_name;
        $data['addon'] = $req->addon;
        $data['specification'] = $req->specification;
        $data['backup_security'] = $req->backup_security;
        $data['license_management'] = $req->license_management;
        if($req->employee_id){
                        $empid = implode(",", $req->employee_id);
        
                }else{
                   $empid = 0; 
                }
        
        
            // Update other fields (assuming this part is unchanged)
            $data['employee_id'] = $empid;
        // $data['employee_id'] = $req->employee_id;
        $data['tenant_id'] = $req->tenant_id;
        $data['azure_password'] = Hash::make($req->azure_password);
        $data['control_panel_password'] = Hash::make($req->control_panel_password);
        $data['user_id'] = Auth::user()->id;
        $data->save();   

        Azure2::where('azure_id',$id)->delete();


        foreach ($req->server_ip as $key => $value) {
        $datas = new Azure2;
    
        $privateKey = 'Privatekey.jpg';
        if ($req->hasFile('Privatekey') && $req->file('Privatekey')[$key]->isValid()) {
            $rand = Str::random(4);
            $file = $req->file('Privatekey')[$key];
            $extension = $file->getClientOriginalExtension();
            $privateKey = 'Privatekey_'.$rand.'.'.$extension;
            $file->move('public/images/', $privateKey);
        }
    
        $publicKey = 'publickey.jpg';
        if ($req->hasFile('publickey') && $req->file('publickey')[$key]->isValid()) {
            $rand = Str::random(4);
            $file = $req->file('publickey')[$key];
            $extension = $file->getClientOriginalExtension();
            $publicKey = 'publickey_'.$rand.'.'.$extension;
            $file->move('public/images/', $publicKey);
        }
    
        $pemKey = 'pemkey.jpg';
        if ($req->hasFile('pemkey') && $req->file('pemkey')[$key]->isValid()) {
            $rand = Str::random(4);
            $file = $req->file('pemkey')[$key];
            $extension = $file->getClientOriginalExtension();
            $pemKey = 'pemkey_'.$rand.'.'.$extension;
            $file->move('public/images/', $pemKey);
        }
    
        $datas['Privatekey'] = $url . $privateKey;
        $datas['publickey'] = $url . $publicKey;
        $datas['pemkey'] = $url . $pemKey;
        $datas['server_ip'] = $value;
        $datas['hostname'] = $req->hostname[$key];
        $datas['rdp_ssh_username'] = $req->rdp_ssh_username[$key];
        $datas['rdp_ssh_port'] = $req->rdp_ssh_port[$key];
        $datas['rdp_ssh_password'] = bcrypt($req->rdp_ssh_password[$key]); // Fixing password hashing
        $datas['region'] = $req->region[$key];
        $datas['azure_id'] = $data->id;
        $datas->save();
} 
        
        $Host = Host::Where('service_id',$id)->where('type','Azure')->first();
        $Host['client_id'] = $req->customer_id;
        $Host['host_name'] = $req->host_domain_name;
        $Host['product_id'] = $req->product_id;
        $Host['type'] = "Azure";
        $Host['url'] = url('/').'/Employee/Azure/update/'.$id;
        $Host['method'] = "Post";
        $Host['billing_cycle'] = $req->billing_cycle;
        $Host['singup'] = $req->signup_date;
        $Host['servicestype'] = $req->service_type;
        $Host['status'] = $req->status;
        $Host->save(); 



        $agent = new Agent();

        // Get user agent information
        $browser = $agent->browser();
        $version = $agent->version($browser); // Pass the browser name as an argument

        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Azure Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Azure/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);  

        return redirect('Employee/Azure/home')->with('success', "Azure Edit Successfully");
    }

     public function delete(Request $request,$id)
    {
        Azure::find($id)->delete();
        Azure2::where('azure_id',$id)->delete();

        Host::where('service_id',$id)->where('type','Azure')->delete();

        $agent = new Agent();

        // Get user agent information
        $browser = $agent->browser();
        $version = $agent->version($browser); // Pass the browser name as an argument

        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Azure Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Azure/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('Employee/Azure/home')->with('success', "Azure Deleted Successfully");
    }

    public function EXPORTCSV(Request $request)
        {
            $agent = new Agent();
            $browser = $agent->browser();
            $version = $agent->version($browser);
            $Log = $request->all();
            $Log['user_id'] = Auth::user()->id;
            $Log['ip'] = $request->ip();
            $Log['subject'] = "Azure CSV Export  By " . Auth::user()->first_name;
            $Log['url'] = url('/') . '/Employee/Azure/EXPORTCSV';
            $Log['method'] = "Get";
            $Log['browser'] = $browser . "-" . $version;
            LogActivity::create($Log);

            return Excel::download(new AzureExport, 'Azure.csv');
        }

}
