<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Collection;
use App\Models\OperatingSysten;
use App\Models\PaymentMethod;   
use Jenssegers\Agent\Agent;
use Illuminate\Support\Str;
use App\Models\LogActivity;
use App\Models\IPAddress;
use App\Models\TotalService;
use App\Models\BareMetal;   
use App\Models\ProductNew;   
use App\Models\Countrys;
use App\Models\Currency;   
use App\Models\Product;
use App\Models\User;
use App\Models\Rack;
use App\Models\Status;
use App\Models\Switchs;
use App\Models\Firewall;
use App\Models\Host;
use Hash;
use Auth;


class EBareMetalController extends Controller
{   
    //home page
    public function home(Request $request)
{
    // Fetch role access permissions
    $RoleAccess = \App\Models\RoleAccess::select(
        'role_accesses.add',
        'role_accesses.view',
        'role_accesses.update',
        'role_accesses.delete',
        'permissions.name as per_name'
    )
    ->join('employee_details', 'employee_details.job_role_id', '=', 'role_accesses.role_id')
    ->leftJoin('permissions', 'permissions.id', '=', 'role_accesses.permission_id')
    ->where('employee_details.user_id', Auth::user()->id)
    ->where(function ($query) {
        $query->where('role_accesses.view', '!=', null)
              ->orWhere('role_accesses.add', '!=', null)
              ->orWhere('role_accesses.update', '!=', null)
              ->orWhere('role_accesses.delete', '!=', null);
    })
    ->get()
    ->toArray();

    // Fetch search query
    $query = $request->get('search');
    $BareMetal = collect();
    $TotalBareMetal = $Active = $Suspended = $Terminated = 0;

    // Check for permissions and fetch data accordingly
    $permissionIndex = array_search('BareMetal', array_column($RoleAccess, 'per_name'));
    if ($permissionIndex !== false) {
        $viewPermission = $RoleAccess[$permissionIndex]['view'];

        $BareMetalQuery = BareMetal::select(
            'bare_metals.service_type',
            'total_services.unique_id as unique_service_id',
            'users.profile_img',
            'users.email',
            'bare_metals.id',
            'bare_metals.signup_date',
            'bare_metals.status', // Ensure status is prefixed here
            'users.first_name',
            'product_news.product_name'
        )
        ->join('users', 'users.id', '=', 'bare_metals.customer_id')
        ->join('product_news', 'product_news.id', '=', 'bare_metals.product_id')
        ->leftJoin('total_services', 'total_services.invoice_id', '=', 'bare_metals.invoice_id')
        ->where(function ($q) use ($query) {
            $q->where('bare_metals.service_type', 'LIKE', "%$query%")
              ->orWhere('users.first_name', 'LIKE', "%$query%")
              ->orWhere('product_news.product_name', 'LIKE', "%$query%");
        })
        ->where(function ($q) {
            $q->whereNull('bare_metals.employee_id')
              ->orWhereRaw('FIND_IN_SET(?, bare_metals.employee_id)', [Auth::user()->id]);
        })
        ->orderBy('bare_metals.created_at', 'desc');

        if ($viewPermission == 1) {
            // Filtered query
            $BareMetal = $BareMetalQuery->paginate(10);
            $TotalBareMetal = $BareMetalQuery->count();
            $Active = $BareMetalQuery->where('bare_metals.status', 1)->count();
            $Suspended = $BareMetalQuery->where('bare_metals.status', 2)->count();
            $Terminated = $BareMetalQuery->where('bare_metals.status', 3)->count();
        } elseif ($viewPermission == 2) {
            $BareMetal = $BareMetalQuery->where('bare_metals.user_id', Auth::user()->id)->paginate(10);
            $TotalBareMetal = $BareMetalQuery->where('bare_metals.user_id', Auth::user()->id)->count();
            $Active = $BareMetalQuery->where('bare_metals.user_id', Auth::user()->id)->where('bare_metals.status', 1)->count();
            $Suspended = $BareMetalQuery->where('bare_metals.user_id', Auth::user()->id)->where('bare_metals.status', 2)->count();
            $Terminated = $BareMetalQuery->where('bare_metals.user_id', Auth::user()->id)->where('bare_metals.status', 3)->count();
        }

        // Append the search term to the pagination links
        $BareMetal->appends(['search' => $query]);
    }

    return view('Employee.Services.BareMetal.home', compact('RoleAccess', 'BareMetal', 'TotalBareMetal', 'Active', 'Suspended', 'Terminated', 'query'));
}

 public function home2s(Request $request)
{
    // Fetch role access permissions
    $RoleAccess = \App\Models\RoleAccess::select(
        'role_accesses.add',
        'role_accesses.view',
        'role_accesses.update',
        'role_accesses.delete',
        'permissions.name as per_name'
    )
    ->join('employee_details', 'employee_details.job_role_id', '=', 'role_accesses.role_id')
    ->leftJoin('permissions', 'permissions.id', '=', 'role_accesses.permission_id')
    ->where('employee_details.user_id', Auth::user()->id)
    ->where(function ($query) {
        $query->where('role_accesses.view', '!=', null)
              ->orWhere('role_accesses.add', '!=', null)
              ->orWhere('role_accesses.update', '!=', null)
              ->orWhere('role_accesses.delete', '!=', null);
    })
    ->get()
    ->toArray();

    // Fetch search query
    $query = $request->get('search');
    $BareMetal = collect();
    $TotalBareMetal = $Active = $Suspended = $Terminated = 0;

    // Check for permissions and fetch data accordingly
    $permissionIndex = array_search('BareMetal', array_column($RoleAccess, 'per_name'));
    if ($permissionIndex !== false) {
        $viewPermission = $RoleAccess[$permissionIndex]['view'];

        $BareMetalQuery = BareMetal::select(
            'bare_metals.service_type',
            'total_services.unique_id as unique_service_id',
            'users.profile_img',
            'users.email',
            'bare_metals.id',
            'bare_metals.signup_date',
            'bare_metals.status',
            'users.first_name',
            'product_news.product_name'
        )
        ->join('users', 'users.id', '=', 'bare_metals.customer_id')
        ->join('product_news', 'product_news.id', '=', 'bare_metals.product_id')
        ->leftJoin('total_services', 'total_services.invoice_id', '=', 'bare_metals.invoice_id')
        ->where(function ($q) use ($query) {
            $q->where('bare_metals.service_type', 'LIKE', "%$query%")
              ->orWhere('users.first_name', 'LIKE', "%$query%")
              ->orWhere('product_news.product_name', 'LIKE', "%$query%");
        })
        ->orderBy('bare_metals.created_at', 'desc');

        if ($viewPermission == 1) {
            $BareMetal = $BareMetalQuery->paginate(10);
            $TotalBareMetal = BareMetal::count();
            $Active = BareMetal::where('status', 1)->count();
            $Suspended = BareMetal::where('status', 2)->count();
            $Terminated = BareMetal::where('status', 3)->count();
        } elseif ($viewPermission == 2) {
            $BareMetal = $BareMetalQuery->where('bare_metals.user_id', Auth::user()->id)->paginate(10);
            $TotalBareMetal = BareMetal::where('user_id', Auth::user()->id)->count();
            $Active = BareMetal::where('user_id', Auth::user()->id)->where('status', 1)->count();
            $Suspended = BareMetal::where('user_id', Auth::user()->id)->where('status', 2)->count();
            $Terminated = BareMetal::where('user_id', Auth::user()->id)->where('status', 3)->count();
        }

        // Append the search term to the pagination links
        $BareMetal->appends(['search' => $query]);
    }

    return view('Employee.Services.BareMetal.home', compact('RoleAccess', 'BareMetal', 'TotalBareMetal', 'Active', 'Suspended', 'Terminated', 'query'));
}




    //home page
    public function Create(Request $request)
    {   
        $additional_private_ip  = IPAddress::select('id','ip_address')->where('ip_type','2')->where('status','1')->get();
        $additional_public_ip  = IPAddress::select('id','ip_address')->where('ip_type','1')->where('status','1')->get();
        $primary_private_ip  = IPAddress::select('id','ip_address')->where('ip_type','2')->where('status','1')->get();
        $primary_public_ip  = IPAddress::select('id','ip_address')->where('ip_type','1')->where('status','1')->get();
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
        $Log['subject'] = "BareMetal Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/BareMetal/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);


        return view('Employee.Services.BareMetal.create',compact('Client','Vendor','Product','OperatingSysten','Currency','PaymentMethod','Country','Rack','Status','primary_public_ip','additional_public_ip','primary_private_ip','additional_private_ip','Switchs','firewall','Employee')); 
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



        $Host = $req->all();
        $Host['client_id'] = $req->customer_id;
        $Host['service_id'] = $base->id;
        $Host['host_name'] = $req->host_domain_name;
        $Host['product_id'] = $req->product_id;
        $Host['type'] = "BareMetal";
        $Host['url'] = url('/').'/Employee/BareMetal/store';
        $Host['method'] = "Post";
        $Host['billing_cycle'] = $req->billing_cycle;
        $Host['singup'] = $req->signup_date;
        $Host['servicestype'] = $req->service_type;
        $Host['status'] = $req->status;
        $hostid = Host::create($Host);
        
        $IPAddress =  IPAddress::where('id',$req->primary_public_ip)->first(); 
        $IPAddress->status = '2';
        $IPAddress->hostname_id = $hostid->id;
        $IPAddress->save();

        $agent = new Agent();

        // Get user agent information
        $browser = $agent->browser();
        $version = $agent->version($browser); // Pass the browser name as an argument

        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "BareMetal Data Store By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/BareMetal/store';
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);
        return redirect('Employee/BareMetal/home')->with('success', "New BareMetal Added Successfully");
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
        $Log['url'] = url('/') . '/Employee/BareMetal/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('Employee.Services.BareMetal.edit',compact('BareMetal','Client','Vendor','Product','OperatingSysten','Currency','PaymentMethod','Country','Rack','Status','public_ip','private_ip','Switchs','firewall','Employee'));
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

        $agent = new Agent();

        // Get user agent information
        $browser = $agent->browser();
        $version = $agent->version($browser); // Pass the browser name as an argument

        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "BareMetal Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/BareMetal/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);


        return redirect('Employee/BareMetal/home')->with('success', "BareMetal Edit Successfully");
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
        $Log['url'] = url('/') . '/Employee/BareMetal/delete/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);
        return redirect('Employee/BareMetal/home')->with('success', "BareMetal Deleted Successfully");
    }

}
