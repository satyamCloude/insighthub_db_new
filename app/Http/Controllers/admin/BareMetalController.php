<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Collection;
use App\Models\OperatingSysten;
use App\Models\PaymentMethod;   
use Jenssegers\Agent\Agent;
use Illuminate\Support\Str;
use App\Models\LogActivity;
use App\Models\RackServiceUnit;
use App\Models\IPAddress;
use App\Models\TotalService;   
use App\Models\BareMetal;   
use App\Models\Countrys;
use App\Models\Currency;   
use App\Models\Product;
use App\Models\ProductNew;
use App\Models\User;
use App\Models\Rack;
use App\Models\Status;
use App\Models\Switchs;
use App\Models\Firewall;
use App\Models\Host;
use Hash;
use Auth;


class BareMetalController extends Controller
{   
    //home page
    public function home(Request $request)
    {
        $query = $request->get('search');
        
        $BareMetal = BareMetal::select('bare_metals.service_type','total_services.unique_id as unique_service_id','users.profile_img','users.email','bare_metals.id','bare_metals.signup_date','bare_metals.status','users.first_name','product_news.product_name')
            ->join('users','users.id','bare_metals.customer_id')
            ->join('product_news','product_news.id','bare_metals.product_id')
            ->leftjoin('total_services','total_services.invoice_id','bare_metals.invoice_id')
            ->where(function($q) use ($query) {
                $q->where('bare_metals.service_type', 'LIKE', "%$query%")
                  ->orWhere('users.first_name', 'LIKE', "%$query%")
                  ->orWhere('product_news.product_name', 'LIKE', "%$query%");
            })
            ->where('total_services.category_id',4)
            ->groupBy('total_services.unique_id')
            ->orderBy('bare_metals.created_at', 'desc')
            ->paginate(10);

        $BareMetal->appends(['search' => $query]);
    
        $Total = BareMetal::count();
        $Active = BareMetal::where('status', 1)->count();
        $Suspended = BareMetal::where('status', 2)->count();
        $Terminated = BareMetal::where('status', 3)->count();
                    $TotalBareMetal = BareMetal::count();

        return view('admin.Services.BareMetal.home', compact('BareMetal', 'TotalBareMetal', 'Active', 'Suspended', 'Terminated', 'query'));
    }



    //home page
    public function Create(Request $request)
    {   
        
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

        $Vendor = User::select('id','first_name')->where('type','3')->get();
        $OperatingSysten = OperatingSysten::get();
        $PaymentMethod = PaymentMethod::get();
        $Currency = Currency::get();
        $Country = Countrys::get();
        $Status = Status::get();
        $Rack = Rack::where('status','!=','2')->get(); // where rack status 1 only
        $Switchs = Switchs::select('id','switch_id')->get();
        $firewall = Firewall::select('id','firewall_serial_no')->get();

        $Client = User::select('first_name', 'last_name', 'id', 'profile_img','company_name')->where('type', 2)->whereNull('deleted_at')->get();
        $Product = ProductNew::where('category_id',4)->select('id','product_name')->get();
        $Employee = User::
        leftjoin('employee_details','employee_details.user_id','users.id')
        ->leftjoin('jobroles','jobroles.id','employee_details.jobrole_id')
        ->select('users.first_name','users.last_name','users.id','jobroles.name as jobrole')->where('type',4)->get();
         // echo "<pre>"; print_r($primary_public_ip); exit;
        $agent = new Agent();

        // Get user agent information
        $browser = $agent->browser();
        $version = $agent->version($browser); // Pass the browser name as an argument

        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "BareMetal Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/BareMetal/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);


        return view('admin.Services.BareMetal.create',compact('Client','Vendor','Product','OperatingSysten','Currency','PaymentMethod','Country','Rack','Status','public_ip','private_ip','Switchs','firewall','Employee')); 
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
        $base = BareMetal::create($data);
        
        // rack id status change 
        if($req->rack_id){
            $rack = Rack::find($req->rack_id);
            $rack->status = 2; // rack id status change 
            $rack->save();
        }
    // rack id status change  end

        $Host = $req->all();
        $Host['client_id'] = $req->customer_id;
        $Host['service_id'] = $base->id;
        $Host['host_name'] = $req->host_domain_name;
        $Host['product_id'] = $req->product_id;
        $Host['type'] = "BareMetal";
        $Host['url'] = url('/').'/admin/BareMetal/store';
        $Host['method'] = "Post";
        $Host['billing_cycle'] = $req->billing_cycle;
        $Host['singup'] = $req->signup_date;
        $Host['servicestype'] = $req->service_type;
        $Host['status'] = $req->status;
        $hostid = Host::create($Host);
        
      //   $IPAddress =  IPAddress::where('id',$req->primary_public_ip)->first(); 
      //   if($IPAddress)
      // {      
      //         $IPAddress->status = '2';
      //         $IPAddress->hostname_id = $hostid->id;
      //         $IPAddress->save();
      // }
        $agent = new Agent();

        // Get user agent information
        $browser = $agent->browser();
        $version = $agent->version($browser); // Pass the browser name as an argument

        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "BareMetal Data Store By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/BareMetal/store';
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);
        return redirect('admin/BareMetal/home')->with('success', "New BareMetal Added Successfully");
    }

    //edit
    public function edit(Request $req,$id)
    {
        $BareMetal = BareMetal::
        leftjoin('invoices','invoices.id','bare_metals.invoice_id')
        ->leftjoin('orders','orders.id','invoices.order_id')
        ->leftjoin('product_pricing','product_pricing.id','orders.billing_cycle')
        ->where('bare_metals.id',$id)->select('bare_metals.*','invoices.final_total_amt','product_pricing.plan_type','orders.currency','product_pricing.price')->first();

        $public_ip  = IPAddress::leftjoin('network_subnets','network_subnets.id','i_p_addresses.subnet_network_id')
        ->select('i_p_addresses.id','i_p_addresses.ip_address')
        ->where('network_subnets.ip_type','1')
        ->orwhere('i_p_addresses.ip_type','1')
        ->whereNull('i_p_addresses.customer_id')
        ->whereNull('i_p_addresses.deleted_at')
        ->get();

        $private_ip  = IPAddress::leftjoin('network_subnets','network_subnets.id','i_p_addresses.subnet_network_id')
        ->select('i_p_addresses.id','i_p_addresses.ip_address')
        ->where('network_subnets.ip_type','2')
        ->orwhere('i_p_addresses.ip_type','2')
        ->whereNull('i_p_addresses.customer_id')
        ->whereNull('i_p_addresses.deleted_at')
        ->get();

        $Vendor = User::select('id','first_name')->where('type','3')->get();
        $Client = User::select('first_name', 'last_name', 'id', 'profile_img','company_name')->where('type', 2)->whereNull('deleted_at')->get();
        $Product = ProductNew::where('category_id',4)->select('id','product_name')->get();
        $Employee = User::
        leftjoin('employee_details','employee_details.user_id','users.id')
        ->leftjoin('jobroles','jobroles.id','employee_details.jobrole_id')
        ->select('users.first_name','users.last_name','users.id','jobroles.name as jobrole')->where('type',4)->get();
        $OperatingSysten = OperatingSysten::get();
        $PaymentMethod = PaymentMethod::get();
        $Currency = Currency::get();
        $Country = Countrys::get();
        $Status = Status::get();
        $Rack = Rack::whereNull('deleted_at')->get();
        $Switchs = Switchs::select('id','switch_id')->get();
        $firewall = Firewall::select('id','firewall_serial_no')->get();

        $agent = new Agent();

        // Get user agent information
        $browser = $agent->browser();
        $version = $agent->version($browser); // Pass the browser name as an argument

        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "BareMetal Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/BareMetal/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('admin.Services.BareMetal.edit',compact('BareMetal','Client','Vendor','Product','OperatingSysten','Currency','PaymentMethod','Country','Rack','Status','public_ip','private_ip','Switchs','firewall','Employee'));
    }

public function update(Request $req, $id)
{
    $url = url('/').'/public/images/';
    $data = BareMetal::find($id);

    // Debugging statement (remove or comment out in production)
    // return $req->all();

    // Handle file uploads (assuming this part is unchanged)
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

      if ($req->unit_no) {
        $unit_nos = $req->unit_no; // Assuming $req->unit_no is already an array

        foreach ($unit_nos as $unit_no) {
            $RackServiceUnit = RackServiceUnit::where('rack_id', $data->rack_id)
                ->where('unit_no', $unit_no)
                ->where('service_unique_id', 0)
                ->where('invoice_id', 0)
                ->first();

            if ($RackServiceUnit) {
                // Update service_unique_id and invoice_id
                $TotalService = TotalService::where('invoice_id', $data->invoice_id)->first();
                if ($TotalService) {
                    $RackServiceUnit->service_unique_id = $TotalService->unique_id;
                    $RackServiceUnit->invoice_id = $TotalService->invoice_id;
                    $RackServiceUnit->save();
                }
            } 
        }
    }
      if($req->employee_id){
                $empid = implode(",", $req->employee_id);

        }else{
           $empid = 0; 
        }


    // Update other fields (assuming this part is unchanged)
    $data['employee_id'] = $empid;
    $data['rack_id'] = $req->rack_id;
    $data->save();

    // Log activity (assuming this part is unchanged)
    $agent = new Agent();
    $browser = $agent->browser();
    $version = $agent->version($browser);

    $Log = $req->all();
    $Log['user_id'] = Auth::user()->id;
    $Log['ip'] = $req->ip();
    $Log['subject'] = "BareMetal Data Updated By " . Auth::user()->first_name;
    $Log['url'] = url('/') . '/admin/BareMetal/update/'.$id;
    $Log['method'] = "Post";
    $Log['browser'] = $browser . "-" . $version;
    LogActivity::create($Log);

    return redirect('admin/BareMetal/home')->with('success', "BareMetal Edit Successfully");
}


  //updated
public function updateOld(Request $req, $id)
{
    $url = url('/').'/public/images/';
    $data = BareMetal::find($id);

   return $req->all();
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


        // rack id status change 
        if($req->rack_id){
            $rack = Rack::find($req->rack_id);
            $rack->status = 2; // rack id status change 
            $rack->save();
        }
         // rack id status change  end
      
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
        $data['employee_id'] = $req->employee_id;
        $data['password'] = Hash::make($req->password);
        $data['control_panel_password'] = Hash::make($req->control_panel_password);
        $data['rdp_ssh_password'] = Hash::make($req->rdp_ssh_password);
        $data['user_id'] = Auth::user()->id;
        $data->save();

        $Host = Host::Where('service_id',$id)->where('type','BareMetal')->first();
        $Host['client_id'] = $req->customer_id;
        $Host['host_name'] = $req->host_domain_name;
        $Host['product_id'] = $req->product_id;
        $Host['type'] = "BareMetal";
        $Host['url'] = url('/').'/admin/BareMetal/update/'.$id;
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
        $Log['subject'] = "BareMetal Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/BareMetal/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);


        return redirect('admin/BareMetal/home')->with('success', "BareMetal Edit Successfully");
}

     public function delete(Request $request,$id)
    {
        BareMetal::find($id)->delete();
        Host::where('service_id',$id)->where('type','BareMetal')->delete();

        $agent = new Agent();

        // Get user agent information
        $browser = $agent->browser();
        $version = $agent->version($browser); // Pass the browser name as an argument

        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "BareMetal Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/BareMetal/delete/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);
        return redirect('admin/BareMetal/home')->with('success', "BareMetal Deleted Successfully");
    }

}
