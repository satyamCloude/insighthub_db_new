<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DedicatedServerExport; 
use Illuminate\Support\Collection;
use App\Models\OperatingSysten;
use App\Models\DedicatedServer;   
use App\Models\PaymentMethod;   
use Illuminate\Http\Request;
use App\Models\LogActivity;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use App\Models\IPAddress;
use App\Models\Countrys;
use App\Models\ProductNew;
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


class EDedicatedServerController extends Controller
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
    
        if($RoleAccess[array_search('DedicatedServer', array_column($RoleAccess, 'per_name'))]['view'] == 1)
        {
            $query = $request->get('search');
        
            $DedicatedServer = DedicatedServer::select('dedicated_servers.service_type','total_services.unique_id as unique_service_id','users.profile_img','users.email','dedicated_servers.id','dedicated_servers.signup_date','dedicated_servers.status','users.first_name','product_news.product_name')
            ->join('users','users.id','dedicated_servers.customer_id')
            ->join('product_news','product_news.id','dedicated_servers.product_id')
            ->leftjoin('total_services','total_services.invoice_id','dedicated_servers.invoice_id')
            ->where(function($q) use ($query) {
                $q->where('dedicated_servers.service_type', 'LIKE', "%$query%")
                  ->orWhere('users.first_name', 'LIKE', "%$query%")
                  ->orWhere('product_news.product_name', 'LIKE', "%$query%");
            })
            ->where('total_services.category_id',7)
            ->groupBy('total_services.unique_id')
            ->orderBy('dedicated_servers.created_at', 'desc')
            ->paginate(10);

            $DedicatedServer->appends(['search' => $query]);
        
            $Total = DedicatedServer::count();
            $Active = DedicatedServer::where('status', 1)->count();
            $Suspended = DedicatedServer::where('status', 2)->count();
            $Terminated = DedicatedServer::where('status', 3)->count();
            
        }

        if($RoleAccess[array_search('DedicatedServer', array_column($RoleAccess, 'per_name'))]['view'] == 2)
        {
            $query = $request->get('search');
        
       $DedicatedServer = DedicatedServer::select('dedicated_servers.service_type','total_services.unique_id as unique_service_id','users.profile_img','users.email','dedicated_servers.id','dedicated_servers.signup_date','dedicated_servers.status','users.first_name','product_news.product_name')
            ->join('users','users.id','dedicated_servers.customer_id')
            ->join('product_news','product_news.id','dedicated_servers.product_id')
            ->leftjoin('total_services','total_services.invoice_id','dedicated_servers.invoice_id')
            ->where(function($q) use ($query) {
                $q->where('dedicated_servers.service_type', 'LIKE', "%$query%")
                  ->orWhere('users.first_name', 'LIKE', "%$query%")
                  ->orWhere('product_news.product_name', 'LIKE', "%$query%");
            })
            ->where('dedicated_servers.user_id',Auth::user()->id)
            ->where('total_services.category_id',7)
            ->groupBy('total_services.unique_id')
            ->orderBy('dedicated_servers.created_at', 'desc')
            ->paginate(10);

        $DedicatedServer->appends(['search' => $query]);
    
        $Total = DedicatedServer::where('user_id',Auth::user()->id)->count();
        $Active = DedicatedServer::where('user_id',Auth::user()->id)->where('status', 1)->count();
        $Suspended = DedicatedServer::where('user_id',Auth::user()->id)->where('status', 2)->count();
        $Terminated = DedicatedServer::where('user_id',Auth::user()->id)->where('status', 3)->count();
            
        }

        
            
        return view('Employee.Services.DedicatedServer.home', compact('RoleAccess','DedicatedServer','Active','Suspended','Terminated','Total','query'));
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

        // Get user agent information
        $browser = $agent->browser();
        $version = $agent->version($browser); // Pass the browser name as an argument

        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "DedicatedServer Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/DedicatedServer/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);


        return view('Employee.Services.DedicatedServer.create',compact('Client','Vendor','Product','OperatingSysten','Currency','PaymentMethod','Country','Rack','Status','primary_public_ip','additional_public_ip','primary_private_ip','additional_private_ip','Switchs','firewall','Employee')); 
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
        $data['password'] = Hash::make($req->password);
        $data['control_panel_password'] = Hash::make($req->control_panel_password);
        $data['rdp_ssh_password'] = Hash::make($req->rdp_ssh_password);
        $data['user_id'] = Auth::user()->id;
        $Dedicated = DedicatedServer::create($data);

         $Host = $req->all();
        $Host['client_id'] = $req->customer_id;
        $Host['service_id'] = $Dedicated->id;
        $Host['host_name'] = $req->host_domain_name;
        $Host['product_id'] = $req->product_id;
        $Host['type'] = "DedicatedServer";
        $Host['url'] = url('/').'/Employee/DedicatedServer/store';
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
        $Log['subject'] = "DedicatedServer Data Store By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/DedicatedServer/store';
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        
        return redirect('Employee/DedicatedServer/home')->with('success', "New DedicatedServer Added Successfully");
    }

     //edit
    public function edit(Request $req,$id)
    {
        $DedicatedServer = DedicatedServer::find($id);
        // $additional_private_ip  = IPAddress::select('id','ip_address')->where('ip_type','2')->get();
        // $additional_public_ip  = IPAddress::select('id','ip_address')->where('ip_type','1')->get();
        // $primary_private_ip  = IPAddress::select('id','ip_address')->where('ip_type','2')->get();
        // $primary_public_ip  = IPAddress::select('id','ip_address')->where('ip_type','1')->get();

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

        $Client = User::select('id','first_name')->where('type','2')->get();
        $Vendor = User::select('id','first_name')->where('type','3')->get();
        $Product = ProductNew::select('id','product_name')->get();
        $OperatingSysten = OperatingSysten::get();
        $PaymentMethod = PaymentMethod::get();
        $Currency = Currency::get();
        $Country = Countrys::get();
        $Status = Status::get();
        $Rack = Rack::where('status','!=','2')->get();
        $Switchs = Switchs::select('id','switch_id')->get();
        $firewall = Firewall::select('id','firewall_serial_no')->get();
        $Employee = User::select('first_name','id')->where('type',4)->get();


         $agent = new Agent();

        // Get user agent information
        $browser = $agent->browser();
        $version = $agent->version($browser); // Pass the browser name as an argument

        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "DedicatedServer Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/DedicatedServer/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);


        return view('Employee.Services.DedicatedServer.edit',compact('DedicatedServer','Client','Vendor','Product','OperatingSysten','Currency','PaymentMethod','Country','Rack','Status','public_ip','private_ip','Switchs','firewall','Employee'));
    }

    //updated
public function update(Request $req, $id)
{
    $url = url('/').'/public/images/';
    $data = DedicatedServer::find($id);

   
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
        $data['dc_location'] = $req->dc_location;
        $data['floor_name'] = $req->floor_name;
        $data['rack_id'] = $req->rack_id;
        $data['unit_no'] = $req->unit_no;
        $data['server_serial_no'] = $req->server_serial_no;
        $data['server_tag_id'] = $req->server_tag_id;
        $data['product_manufacturer'] = $req->product_manufacturer;
        $data['status'] = $req->status;
        $data['bare_notes'] = $req->bare_notes;
        $data['primary_public_ip'] = $req->primary_public_ip;
        $data['additional_public_ip'] = $req->additional_public_ip;
        $data['primary_private_ip'] = $req->primary_private_ip;
        $data['additional_private_ip'] = $req->additional_private_ip;
        $data['ilo_rmm_darc_console_url'] = $req->ilo_rmm_darc_console_url;
        $data['username'] = $req->username;
        $data['switch_id'] = $req->switch_id;
        $data['swith_port'] = $req->swith_port;
        $data['firewall_serial_id'] = $req->firewall_serial_id;
        $data['firewall_port'] = $req->firewall_port;
        $data['hosting_control_panel'] = $req->hosting_control_panel;
        $data['control_panel_user_name'] = $req->control_panel_user_name;
        $data['rdp_ssh_username'] = $req->rdp_ssh_username;
        $data['rdp_ssh_port'] = $req->rdp_ssh_port;
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
        $data['password'] = Hash::make($req->password);
        $data['control_panel_password'] = Hash::make($req->control_panel_password);
        $data['rdp_ssh_password'] = Hash::make($req->rdp_ssh_password);
        $data['user_id'] = Auth::user()->id;
        $data->save();

        $Host = Host::Where('service_id',$id)->where('type','DedicatedServer')->first();
        $Host['client_id'] = $req->customer_id;
        $Host['host_name'] = $req->host_domain_name;
        $Host['product_id'] = $req->product_id;
        $Host['type'] = "DedicatedServer";
        $Host['url'] = url('/').'/Employee/DedicatedServer/update/'.$id;
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
        $Log['subject'] = "DedicatedServer Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/DedicatedServer/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);    

        return redirect('Employee/DedicatedServer/home')->with('success', "DedicatedServer Edit Successfully");
    }

     public function delete(Request $request,$id)
    {
        DedicatedServer::find($id)->delete();
         Host::where('service_id',$id)->where('type','DedicatedServer')->delete();

        $agent = new Agent();

        // Get user agent information
        $browser = $agent->browser();
        $version = $agent->version($browser); // Pass the browser name as an argument

        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "DedicatedServer Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/DedicatedServer/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('Employee/DedicatedServer/home')->with('success', "DedicatedServer Deleted Successfully");
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
            $Log['subject'] = "DedicatedServer CSV Export  By " . Auth::user()->first_name;
            $Log['url'] = url('/') . '/Employee/DedicatedServer/EXPORTCSV';
            $Log['method'] = "Get";
            $Log['browser'] = $browser . "-" . $version;
            LogActivity::create($Log);

            return Excel::download(new DedicatedServerExport, 'DedicatedServer.csv');
        }

}
