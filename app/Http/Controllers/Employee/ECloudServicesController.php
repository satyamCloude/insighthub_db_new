<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller; 
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CloudServicesExport;
use Illuminate\Support\Collection;
use App\Models\OperatingSysten;
use App\Models\CloudServices;   
use App\Models\PaymentMethod;   
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use Illuminate\Support\Str;
use App\Models\IPAddress;
use App\Models\ProductNew;
use App\Models\BareMetal;
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


class ECloudServicesController extends Controller
{   
 public function home(Request $request)
{
    $RoleAccess = \App\Models\RoleAccess::select('role_accesses.add', 'role_accesses.view', 'role_accesses.update', 'role_accesses.delete', 'permissions.name as per_name')
        ->join('employee_details', 'employee_details.job_role_id', '=', 'role_accesses.role_id')
        ->leftJoin('permissions', 'permissions.id', '=', 'role_accesses.permission_id')
        ->where('employee_details.user_id', Auth::user()->id)
        ->where(function($query) {
            $query->where('role_accesses.view', '!=', null)
                ->orWhere('role_accesses.add', '!=', null)
                ->orWhere('role_accesses.update', '!=', null)
                ->orWhere('role_accesses.delete', '!=', null);
        })
        ->get()
        ->toArray();

    $cloudServiceViewAccess = array_search('CloudServices', array_column($RoleAccess, 'per_name')) !== false ? $RoleAccess[array_search('CloudServices', array_column($RoleAccess, 'per_name'))]['view'] : 0;

    if ($cloudServiceViewAccess == 1 || $cloudServiceViewAccess == 2) {
        $searchTerm = $request->input('search');
        $query = CloudServices::select('cloud_services.service_type', 'total_services.unique_id as unique_service_id', 'users.profile_img', 'users.email', 'cloud_services.id', 'cloud_services.signup_date', 'cloud_services.status', 'users.first_name', 'product_news.product_name')
            ->join('users', 'users.id', '=', 'cloud_services.customer_id')
            ->join('product_news', 'product_news.id', '=', 'cloud_services.product_id')
            ->leftJoin('total_services', 'total_services.invoice_id', '=', 'cloud_services.invoice_id');

        if ($cloudServiceViewAccess == 2) {
            $query->where('cloud_services.user_id', Auth::user()->id);
        }

        if (!empty($searchTerm)) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('cloud_services.service_type', 'like', '%' . $searchTerm . '%')
                    ->orWhere('users.first_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('product_news.product_name', 'like', '%' . $searchTerm . '%');
            });
        }

        $CloudServices = $query->groupBy('total_services.unique_id')
            ->orderBy('cloud_services.created_at', 'desc')
            ->paginate(10);

        $CloudServices->appends(['search' => $searchTerm]);

        $TotalQuery = CloudServices::query();
        $ActiveQuery = CloudServices::where('status', 1);
        $SuspendedQuery = CloudServices::where('status', 2);
        $TerminatedQuery = CloudServices::where('status', 3);

        if ($cloudServiceViewAccess == 2) {
            $TotalQuery->where('user_id', Auth::user()->id);
            $ActiveQuery->where('user_id', Auth::user()->id);
            $SuspendedQuery->where('user_id', Auth::user()->id);
            $TerminatedQuery->where('user_id', Auth::user()->id);
        }

        $Total = $TotalQuery->count();
        $Active = $ActiveQuery->count();
        $Suspended = $SuspendedQuery->count();
        $Terminated = $TerminatedQuery->count();
    } else {
        $CloudServices = collect();
        $Total = $Active = $Suspended = $Terminated = 0;
        $searchTerm = '';
    }

    return view('Employee.Services.CloudServices.home', compact('CloudServices', 'RoleAccess', 'Active', 'Suspended', 'Terminated', 'searchTerm', 'Total'));
}




    //home page
    public function Create(Request $request)
    {   
        $BareMetal = BareMetal::select('bare_metals.id','products.product_name')->join('products','products.id','bare_metals.product_id')->get();
        $additional_private_ip  = IPAddress::select('id','ip_address')->where('ip_type','2')->get();
        $additional_public_ip  = IPAddress::select('id','ip_address')->where('ip_type','1')->get();
        $primary_private_ip  = IPAddress::select('id','ip_address')->where('ip_type','2')->get();
        $primary_public_ip  = IPAddress::select('id','ip_address')->where('ip_type','1')->get();
        $Client = User::select('id','first_name')->where('type','2')->get();
        $Vendor = User::select('id','first_name')->where('type','3')->get();
        $firewall = Firewall::select('id','firewall_serial_no')->get();
        $Product = Product::select('id','product_name')->get();
        $Employee = User::select('first_name','id')->where('type',4)->get();
        $Switchs = Switchs::select('id','switch_id')->get();
        $OperatingSysten = OperatingSysten::get();
        $PaymentMethod = PaymentMethod::get();
        $Currency = Currency::get();
        $Country = Countrys::get();
        $Status = Status::get();
        $Rack = Rack::get();

        $agent = new Agent();

        // Get user agent information
        $browser = $agent->browser();
        $version = $agent->version($browser); // Pass the browser name as an argument

        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "CloudServices Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/CloudServices/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);


        return view('Employee.Services.CloudServices.create',compact('BareMetal','Client','Vendor','Product','OperatingSysten','Currency','PaymentMethod','Country','Rack','Status','primary_public_ip','additional_public_ip','primary_private_ip','additional_private_ip','Switchs','firewall','Employee')); 
    }


    //home page
    public function store(Request $req)
    {
        $url = url('/').'/public/images/';
     
        $pemkey = 'pemkeyDefault.jpg';
        if ($req->hasFile('pemkey')) {
            $rand = Str::random(4);
            $file = $req->file('pemkey');
            $extension = $file->getClientOriginalExtension();
            $pemkey = 'pemkey'.$rand.'.'.$extension;
            $file->move('public/images/', $pemkey);
        }

        $Privatekey = 'PrivatekeyDefault.jpg';
        if ($req->hasFile('Privatekey')) {
            $rand = Str::random(4);
            $file = $req->file('Privatekey');
            $extension = $file->getClientOriginalExtension();
            $Privatekey = 'Privatekey'.$rand.'.'.$extension;
            $file->move('public/images/', $Privatekey);
        }

        $publickey = 'publickeyDefault.jpg';
        if ($req->hasFile('publickey')) {
            $rand = Str::random(4);
            $file = $req->file('publickey');
            $extension = $file->getClientOriginalExtension();
            $publickey = 'publickey'.$rand.'.'.$extension;
            $file->move('public/images/', $publickey);
        }

        $data = $req->all();
        $data['pemkey'] = $url . $pemkey;
        $data['Privatekey'] = $url . $Privatekey;
        $data['publickey'] = $url . $publickey;
        $data['ip_kvm_password'] = Hash::make($req->ip_kvm_password);
        $data['control_panel_password'] = Hash::make($req->control_panel_password);
        $data['rdp_ssh_password'] = Hash::make($req->rdp_ssh_password);
        $data['user_id'] = Auth::user()->id;
         $cloud = CloudServices::create($data);


        $Host = $req->all();
        $Host['client_id'] = $req->customer_id;
        $Host['service_id'] = $cloud->id;
        $Host['host_name'] = $req->host_domain_name;
        $Host['product_id'] = $req->product_id;
        $Host['type'] = "CloudServices";
        $Host['url'] = url('/').'/Employee/CloudServices/store';
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
        $Log['subject'] = "CloudServices Data Store By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/CloudServices/store';
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('Employee/CloudServices/home')->with('success', "New CloudServices Added Successfully");
    }

     //edit
    //edit
    public function edit(Request $req,$id)
    {
        $CloudServices = CloudServices::find($id);
        $BareMetal = BareMetal::select('bare_metals.id','product_news.product_name')->join('product_news','product_news.id','bare_metals.product_id')->get();
        $additional_private_ip  = IPAddress::select('id','ip_address')->where('ip_type','2')->get();
        $additional_public_ip  = IPAddress::select('id','ip_address')->where('ip_type','1')->get();
        $primary_private_ip  = IPAddress::select('id','ip_address')->where('ip_type','2')->get();
        $primary_public_ip  = IPAddress::select('id','ip_address')->where('ip_type','1')->get();
        $Client = User::select('id','first_name')->where('type','2')->get();
        $Vendor = User::select('id','first_name')->where('type','3')->get();
        $firewall = Firewall::select('id','firewall_serial_no')->get();
        $Product = Product::select('id','product_name')->get();
        $Employee = User::select('first_name','id')->where('type',4)->get();
        $Switchs = Switchs::select('id','switch_id')->get();
        $OperatingSysten = OperatingSysten::get();
        $PaymentMethod = PaymentMethod::get();
        $Currency = Currency::get();
        $Country = Countrys::get();
        $Status = Status::get();
        $Rack = Rack::get();
        $public_ip  = IPAddress::leftjoin('network_subnets','network_subnets.id','i_p_addresses.subnet_network_id')
        ->select('i_p_addresses.id','i_p_addresses.ip_address')
        ->where('network_subnets.ip_type','1')
        ->orwhere('i_p_addresses.ip_type','1')
        ->get();

        $private_ip  = IPAddress::leftjoin('network_subnets','network_subnets.id','i_p_addresses.subnet_network_id')
        ->select('i_p_addresses.id','i_p_addresses.ip_address')
        ->where('network_subnets.ip_type','2')
        ->orwhere('i_p_addresses.ip_type','2')
        ->get();
        $agent = new Agent();

        // Get user agent information
        $browser = $agent->browser();
        $version = $agent->version($browser); // Pass the browser name as an argument

        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "CloudServices Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/CloudServices/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('Employee.Services.CloudServices.edit',compact('BareMetal','CloudServices','Client','Vendor','Product','OperatingSysten','Currency','PaymentMethod','Country','Rack','Status','primary_public_ip','public_ip','private_ip','additional_public_ip','primary_private_ip','additional_private_ip','Switchs','firewall','Employee','id'));
    }

    //updated
public function update(Request $req, $id)
{
    $url = url('/').'/public/images/';
    $data = CloudServices::find($id);

   
        if ($req->hasFile('pemkey')) {
            $rand = Str::random(4);
            $file = $req->file('pemkey');
            $extension = $file->getClientOriginalExtension();
            $pemkey = 'pemkey'.$rand.'.'.$extension;
            $file->move('public/images/', $pemkey);

            $data['pemkey'] = $url . $pemkey;

        }

        if ($req->hasFile('Privatekey')) {
            $rand = Str::random(4);
            $file = $req->file('Privatekey');
            $extension = $file->getClientOriginalExtension();
            $Privatekey = 'Privatekey'.$rand.'.'.$extension;
            $file->move('public/images/', $Privatekey);

            $data['Privatekey'] = $url . $Privatekey;
        }

        if ($req->hasFile('publickey')) {
            $rand = Str::random(4);
            $file = $req->file('publickey');
            $extension = $file->getClientOriginalExtension();
            $publickey = 'publickey'.$rand.'.'.$extension;
            $file->move('public/images/', $publickey);

            $data['publickey'] = $url . $publickey;
        }

    


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
        $data['bare_metal_id'] = $req->bare_metal_id;
        $data['dc_location'] = $req->dc_location;
        $data['firewall_serial_id'] = $req->firewall_serial_id;
        $data['switch_id'] = $req->switch_id;
        $data['swith_port'] = $req->swith_port;
        $data['firewall_port'] = $req->firewall_port;
        $data['status'] = $req->status;
        $data['vps_notes'] = $req->vps_notes;
        $data['primary_public_ip'] = $req->primary_public_ip;
        $data['additional_public_ip'] = $req->additional_public_ip;
        $data['primary_private_ip'] = $req->primary_private_ip;
        $data['additional_private_ip'] = $req->additional_private_ip;
        $data['ip_kvm_console'] = $req->ip_kvm_console;
        $data['ip_kvm_username'] = $req->ip_kvm_username;
        $data['ip_kvm_password'] = Hash::make($req->ip_kvm_password);
        $data['hosting_control_panel'] = $req->hosting_control_panel;
        $data['control_panel_user_name'] = $req->control_panel_user_name;
        $data['control_panel_password'] = Hash::make($req->control_panel_password);
        $data['rdp_ssh_username'] = $req->rdp_ssh_username;
        $data['rdp_ssh_port'] = $req->rdp_ssh_port;
        $data['rdp_ssh_password'] = Hash::make($req->rdp_ssh_password);
        $data['addon'] = $req->addon;
        $data['license_management'] = $req->license_management;
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

        $Host = Host::Where('service_id',$id)->where('type','CloudServices')->first();
        $Host['client_id'] = $req->customer_id;
        $Host['host_name'] = $req->host_domain_name;
        $Host['product_id'] = $req->product_id;
        $Host['type'] = "CloudServices";
        $Host['url'] = url('/').'/Employee/CloudServices/update/'.$id;
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
        $Log['subject'] = "CloudServices Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/CloudServices/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('Employee/CloudServices/home')->with('success', "CloudServices Edit Successfully");
    }

     public function delete(Request $request,$id)
    {
        CloudServices::find($id)->delete();
        Host::where('service_id',$id)->where('type','CloudServices')->delete();

        $agent = new Agent();

        // Get user agent information
        $browser = $agent->browser();
        $version = $agent->version($browser); // Pass the browser name as an argument

        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "CloudServices Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/CloudServices/delete/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);
        return redirect('Employee/CloudServices/home')->with('success', "CloudServices Deleted Successfully");
    }

      // ExportCSV
    public function EXPORTCSV(Request $request)
        {
            $agent = new Agent();

            // Get user agent information
            $browser = $agent->browser();
            $version = $agent->version($browser); // Pass the browser name as an argument

            $Log = $request->all();
            $Log['user_id'] = Auth::user()->id;
            $Log['ip'] = $request->ip();
            $Log['subject'] = "CloudServices CSV Export  By " . Auth::user()->first_name;
            $Log['url'] = url('/') . '/Employee/CloudServices/EXPORTCSV';
            $Log['method'] = "Get";
            $Log['browser'] = $browser . "-" . $version;
            LogActivity::create($Log);

            return Excel::download(new CloudServicesExport, 'CloudServices.csv');
        }

}
