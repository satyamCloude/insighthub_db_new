<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use App\Models\OperatingSysten;
use App\Models\PaymentMethod;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use App\Models\LeadSource;
use App\Models\IPAddress;
use App\Models\Countrys;
use App\Models\Firewall;
use App\Models\Currency;
use App\Models\Employee;
use App\Models\Product;
use App\Models\Country;
use App\Models\Leads;
use App\Models\City;
use App\Models\User;
use App\Models\State;
use App\Models\Rack;
use Hash;
use Auth;



class FirewallController extends Controller
{   
    //home page
public function home(Request $request)
{
    $query = Firewall::select('firewalls.id','users.profile_img','users.email', 'firewalls.status', 'firewalls.service_type','firewalls.unique_service_id', 'products.product_name', 'users.first_name', 'i_p_addresses.ip_address', 'firewalls.signup_date')
        ->join('users', 'users.id', '=', 'firewalls.customer_id')
        ->join('products', 'products.id', '=', 'firewalls.product_id')
        ->join('i_p_addresses', 'i_p_addresses.id', '=', 'firewalls.primary_public_ip')
        ->orderBy('firewalls.created_at', 'desc');

    $searchTerm = '';  // Initialize $searchTerm here

    // Check if a search term is provided
    if ($request->has('search')) {
        $searchTerm = $request->input('search');
        $query->where(function ($q) use ($searchTerm) {
            $q->where('firewalls.service_type', 'like', '%' . $searchTerm . '%')
                ->orWhere('products.product_name', 'like', '%' . $searchTerm . '%')
                ->orWhere('users.first_name', 'like', '%' . $searchTerm . '%')
                ->orWhere('i_p_addresses.ip_address', 'like', '%' . $searchTerm . '%')
                ->orWhere('firewalls.signup_date', 'like', '%' . $searchTerm . '%');
        });
    }

    $Firewall = $query->paginate(10);
    $Firewall->appends(['search' => $searchTerm]);

    $Total = Firewall::count();
    $Active = Firewall::where('status', '1')->count();
    $Suspended = Firewall::where('status', '2')->count();
    $Terminated = Firewall::where('status', '3')->count();

    return view('admin.NetworkManagement.Firewall.home', compact('Firewall', 'Active', 'Suspended', 'Terminated','Total','searchTerm'));
}




    //home page
    public function Create(Request $request)
    {   
        $Country = Country::get();
        $PaymentMethod = PaymentMethod::get();
        $Client = User::select('id','first_name')->where('type','2')->get();
        $Vendor  = User::select('id','first_name')->where('type','3')->get();
        $Employee = User::select('first_name','id')->where('type',4)->get();
        $Product  = Product::select('product_name','id')->get();
        $Rack  = Rack::select('rack_id','id')->get();
        $primary_public_ip  = IPAddress::select('id','ip_address')->where('ip_type','1')->get();
        $additional_public_ip  = IPAddress::select('id','ip_address')->where('ip_type','1')->get();
        $primary_private_ip  = IPAddress::select('id','ip_address')->where('ip_type','2')->get();
        $additional_private_ip  = IPAddress::select('id','ip_address')->where('ip_type','2')->get();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Firewall Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Firewall/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('admin.NetworkManagement.Firewall.create',compact('Country','Client','Product','Vendor','PaymentMethod','Rack','Employee','primary_public_ip','additional_public_ip','primary_private_ip','additional_private_ip')); 
    }


    //home page
    public function store(Request $req)
    {
            $agent = new Agent();
            $browser = $agent->browser();
            $version = $agent->version($browser);
            $Log = $req->all();
            $Log['user_id'] = Auth::user()->id;
            $Log['ip'] = $req->ip();
            $Log['subject'] = "Firewall Data Store By " . Auth::user()->first_name;
            $Log['url'] = url('/') . '/admin/Firewall/store';
            $Log['method'] = "Post";
            $Log['browser'] = $browser . "-" . $version;
            LogActivity::create($Log);

        $data = $req->all();
        $data['user_id'] = Auth::user()->id;
        Firewall::create($data);   
        return redirect('admin/Firewall/home')->with('success', "New Firewall Added Successfully");
    }

  
    //edit
    public function edit(Request $req,$id)
    {
        $Firewall = Firewall::find($id);
        $Country = Country::get();
        $PaymentMethod = PaymentMethod::get();
        $Client = User::select('id','first_name')->where('type','2')->get();
        $Vendor  = User::select('id','first_name')->where('type','3')->get();
        $Employee = User::select('first_name','id')->where('type',4)->get();
        $Product  = Product::select('product_name','id')->get();
        $Rack  = Rack::select('rack_id','id')->get();
        $primary_public_ip  = IPAddress::select('id','ip_address')->where('ip_type','1')->get();
        $additional_public_ip  = IPAddress::select('id','ip_address')->where('ip_type','1')->get();
        $primary_private_ip  = IPAddress::select('id','ip_address')->where('ip_type','2')->get();
        $additional_private_ip  = IPAddress::select('id','ip_address')->where('ip_type','2')->get();

        // return $additional_private_ip;

         $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Firewall Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Firewall/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

    return view('admin.NetworkManagement.Firewall.edit',compact('Firewall','Country','PaymentMethod','Client','Vendor','Employee','Product','Rack','primary_public_ip','additional_public_ip','primary_private_ip','additional_private_ip'));
    }

    //updated
    public function update(Request $req,$id)
    {
     
        $data =Firewall::find($id);
        $data['customer_id'] = $req->customer_id;
        $data['product_id'] = $req->product_id;
        $data['host_name'] = $req->host_name;
        $data['vender_id'] = $req->vender_id;
        $data['service_type'] = $req->service_type;
        $data['first_payment'] = $req->first_payment;   
        $data['firewall_serial_no'] = $req->firewall_serial_no;   
        $data['billing_cycle'] = $req->billing_cycle;
        $data['payment_method_id'] = $req->payment_method_id;
        $data['signup_date'] = $req->signup_date;
        $data['next_due_date'] = $req->next_due_date;
        $data['terminate_date'] = $req->terminate_date;
        $data['modal_no'] = $req->modal_no;
        $data['hardware_tag'] = $req->hardware_tag;
        $data['no_of_ports'] = $req->no_of_ports;
        $data['rack_id'] = $req->rack_id;
        $data['unit_no'] = $req->unit_no;
        $data['floor_name'] = $req->floor_name;
        $data['primary_public_ip'] = $req->primary_public_ip;
        $data['additional_public_ip'] = $req->additional_public_ip;
        $data['primary_private_ip'] = $req->primary_private_ip;
        $data['additional_private_ip'] = $req->additional_private_ip;
        $data['login_url'] = $req->login_url;
        $data['user_name'] = $req->user_name;
        $data['password'] = $req->password;
        $data['console'] = $req->console;
          if($req->employee_id){
                        $empid = implode(",", $req->employee_id);
        
                }else{
                   $empid = 0; 
                }
        // $data['employee_id'] = $req->employee_id;
        $data['status'] = $req->status;
        $data['firewall_note'] = $req->firewall_note;
        $data->save();    

         $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Firewall Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Firewall/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);  

        return redirect('admin/Firewall/home')->with('success', "Firewall Edited Successfully");
    }
    // delete leads
     public function delete(Request $request,$id)
    {
        Firewall::find($id)->delete();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Firewall Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Firewall/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);
        return redirect('admin/Firewall/home')->with('success', "Firewall Deleted Successfully");
    }

}
