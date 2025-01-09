<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use App\Models\OperatingSysten;
use App\Models\PaymentMethod;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use Illuminate\Support\Str;
use App\Models\LeadSource;
use App\Models\IPAddress;
use App\Models\Countrys;
use App\Models\Employee;
use App\Models\Currency;
use App\Models\Switchs;
use App\Models\Country;
use App\Models\Product;
use App\Models\Leads;
use App\Models\State;
use App\Models\City;
use App\Models\Rack;
use App\Models\User;
use Hash;
use Auth;


class ESwitchsController extends Controller
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
    
    if($RoleAccess[array_search('Switchs', array_column($RoleAccess, 'per_name'))]['view'] == 1)
    {
        $query = Switchs::select('switchs.id','switchs.status','switchs.service_type','products.product_name','users.first_name','i_p_addresses.ip_address','switchs.signup_date')
        ->join('users','users.id','switchs.customer_id')
        ->join('products','products.id','switchs.product_id')
        ->join('i_p_addresses','i_p_addresses.id','switchs.primary_public_ip')
        ->orderBy('switchs.created_at', 'desc');
         $searchTerm = '';   
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('switchs.service_type', 'like', '%' . $searchTerm . '%')
                  ->orWhere('products.product_name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('users.first_name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('i_p_addresses.ip_address', 'like', '%' . $searchTerm . '%')
                  ->orWhere('switchs.signup_date', 'like', '%' . $searchTerm . '%');
            });
        }
        $Switchs = $query->paginate(10);
        $Switchs->appends(['search' => $searchTerm]);

        $Total = Switchs::count();
        $Active = Switchs::where('status','1')->count();
        $Suspended = Switchs::where('status','2')->count();
        $Terminated = Switchs::where('status','3')->count();         
    }

     if($RoleAccess[array_search('Switchs', array_column($RoleAccess, 'per_name'))]['view'] == 2)
    {
         $query = Switchs::select('switchs.id','switchs.status','switchs.service_type','products.product_name','users.first_name','i_p_addresses.ip_address','switchs.signup_date')
        ->join('users','users.id','switchs.customer_id')
        ->join('products','products.id','switchs.product_id')
        ->join('i_p_addresses','i_p_addresses.id','switchs.primary_public_ip')
        ->where('switchs.user_id',Auth::user()->id)
        ->orderBy('switchs.created_at', 'desc');
         $searchTerm = '';   
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('switchs.service_type', 'like', '%' . $searchTerm . '%')
                  ->orWhere('products.product_name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('users.first_name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('i_p_addresses.ip_address', 'like', '%' . $searchTerm . '%')
                  ->orWhere('switchs.signup_date', 'like', '%' . $searchTerm . '%');
            });
        }
        $Switchs = $query->paginate(10);
        $Switchs->appends(['search' => $searchTerm]);
        $Total = Switchs::where('user_id',Auth::user()->id)->count();
        $Active = Switchs::where('user_id',Auth::user()->id)->where('status', '1')->count();
        $Suspended = Switchs::where('user_id',Auth::user()->id)->where('status', '2')->count();
        $Terminated = Switchs::where('user_id',Auth::user()->id)->where('status', '3')->count();
    }
   

    return view('Employee.NetworkManagement.Switchs.home', compact('RoleAccess','Switchs', 'Active', 'Suspended', 'Terminated','searchTerm','Total'));
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
        $Log['subject'] = "Switchs Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Switchs/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);


        return view('Employee.NetworkManagement.Switchs.create',compact('Country','Client','Product','Vendor','PaymentMethod','Rack','Employee','primary_public_ip','additional_public_ip','primary_private_ip','additional_private_ip')); 
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
            $Log['subject'] = "Switchs Data Store By " . Auth::user()->first_name;
            $Log['url'] = url('/') . '/Employee/Switchs/store';
            $Log['method'] = "Post";
            $Log['browser'] = $browser . "-" . $version;
            LogActivity::create($Log);

        $data = $req->all();
        $data['user_id'] = Auth::user()->id;
        Switchs::create($data);   
        return redirect('Employee/Switchs/home')->with('success', "New Switchs Added Successfully");
    }

  
    //edit
    public function edit(Request $req,$id)
    {
        $Switchs = Switchs::find($id);
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
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Switchs Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Switchs/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

    return view('Employee.NetworkManagement.Switchs.edit',compact('Switchs','Country','PaymentMethod','Client','Vendor','Employee','Product','Rack','primary_public_ip','additional_public_ip','primary_private_ip','additional_private_ip'));
    }

    //updated
    public function update(Request $req,$id)
    {
     
        $data =Switchs::find($id);
        $data['user_id'] = Auth::user()->id;
        $data['product_id'] = $req->product_id;
        $data['host_name'] = $req->host_name;
        $data['switch_id'] = $req->switch_id;
        $data['vender_id'] = $req->vender_id;
        $data['service_type'] = $req->service_type;
        $data['first_payment'] = $req->first_payment;
        $data['recurring_amount'] = $req->recurring_amount;
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
        
        
            // Update other fields (assuming this part is unchanged)
            $data['employee_id'] = $empid;
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
        $Log['subject'] = "Switchs Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Switchs/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('Employee/Switchs/home')->with('success', "Switchs Edited Successfully");
    }
    // delete leads
     public function delete(Request $request,$id)
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Switchs Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Switchs/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        Switchs::find($id)->delete();
        return redirect('Employee/Switchs/home')->with('success', "Switchs Deleted Successfully");
    }

}
