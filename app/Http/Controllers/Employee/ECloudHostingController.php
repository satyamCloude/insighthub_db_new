<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller; 
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CloudHostingExport;
use Illuminate\Support\Collection;
use App\Models\OperatingSysten;
use App\Models\PaymentMethod;   
use App\Models\CloudHosting;   
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use App\Models\ProductNew;
use App\Models\IPAddress;
use App\Models\Firewall;
use App\Models\Employee;
use App\Models\Countrys;
use App\Models\Currency;   
use App\Models\Product;
use App\Models\Switchs;
use App\Models\Status;
use App\Models\Rack;
use App\Models\User;
use App\Models\Host;
use Hash;
use Auth;


class ECloudHostingController extends Controller
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
    
        if($RoleAccess[array_search('CloudHosting', array_column($RoleAccess, 'per_name'))]['view'] == 1)
        {
             // Get the search query from the request
            $search = $request->input('search');

            // Use the query builder to fetch data
        $CloudHosting = CloudHosting::select('cloud_hostings.service_type','total_services.unique_id as unique_service_id','users.profile_img','users.email','cloud_hostings.id','cloud_hostings.signup_date','cloud_hostings.status','users.first_name','product_news.product_name')
        ->join('users','users.id','cloud_hostings.customer_id')
        ->join('product_news','product_news.id','cloud_hostings.product_id')
         ->leftjoin('total_services','total_services.invoice_id','cloud_hostings.invoice_id')
        ->when($search, function ($query) use ($search) {
            // Add a where clause for the search query
            $query->where('cloud_hostings.service_type', 'like', '%'.$search.'%')
                ->orWhere('cloud_hostings.status', 'like', '%'.$search.'%')
                ->orWhere('users.first_name', 'like', '%'.$search.'%')
                ->orWhere('product_news.product_name', 'like', '%'.$search.'%');
        })
         ->where('total_services.category_id',5)
        ->groupBy('total_services.unique_id')
        ->orderBy('cloud_hostings.created_at', 'desc')
        ->paginate(10);

                $CloudHosting->appends(['search' => $search]);

            $Total = CloudHosting::count();
            $Active = CloudHosting::where('status', 1)->count();
            $Suspended = CloudHosting::where('status', 2)->count();
            $Terminated = CloudHosting::where('status', 3)->count();

        }

        if($RoleAccess[array_search('CloudHosting', array_column($RoleAccess, 'per_name'))]['view'] == 2)
        {
             // Get the search query from the request
            $search = $request->input('search');

            // Use the query builder to fetch data
           $CloudHosting = CloudHosting::select('cloud_hostings.service_type','total_services.unique_id as unique_service_id','users.profile_img','users.email','cloud_hostings.id','cloud_hostings.signup_date','cloud_hostings.status','users.first_name','product_news.product_name')
        ->join('users','users.id','cloud_hostings.customer_id')
        ->join('product_news','product_news.id','cloud_hostings.product_id')
         ->leftjoin('total_services','total_services.invoice_id','cloud_hostings.invoice_id')
                ->when($search, function ($query) use ($search) {
                    // Add a where clause for the search query
                    $query->where('cloud_hostings.service_type', 'like', '%'.$search.'%')
                        ->orWhere('cloud_hostings.status', 'like', '%'.$search.'%')
                        ->orWhere('users.first_name', 'like', '%'.$search.'%')
                        ->orWhere('product_news.product_name', 'like', '%'.$search.'%');
                })
                ->where('total_services.category_id',5)
                ->where('cloud_hostings.user_id',Auth::user()->id)
                ->groupBy('total_services.unique_id')
                ->orderBy('cloud_hostings.created_at', 'desc')
                ->paginate(10);

                $CloudHosting->appends(['search' => $search]);

            $Total = CloudHosting::where('user_id',Auth::user()->id)->count();
            $Active = CloudHosting::where('status', 1)->where('user_id',Auth::user()->id)->count();
            $Suspended = CloudHosting::where('status', 2)->where('user_id',Auth::user()->id)->count();
            $Terminated = CloudHosting::where('status', 3)->where('user_id',Auth::user()->id)->count();
            
        }

   

    return view('Employee.Services.CloudHosting.home', compact('RoleAccess','CloudHosting','Active','Suspended','Terminated','search','Total'));
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
        $Log['subject'] = "CloudHosting Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/CloudHosting/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('Employee.Services.CloudHosting.create',compact('Client','Vendor','Product','OperatingSysten','Currency','PaymentMethod','Country','Rack','Status','primary_public_ip','additional_public_ip','primary_private_ip','additional_private_ip','Switchs','firewall','Employee')); 
    }


    //home page
    public function store(Request $req)
    {


        $data = $req->all();
        $data['dc_password'] = Hash::make($req->dc_password);
        $data['password'] = Hash::make($req->password);
        $data['user_id'] = Auth::user()->id;
        $cloud = CloudHosting::create($data);

        $Host = $req->all();
        $Host['client_id'] = $req->customer_id;
        $Host['service_id'] = $cloud->id;
        $Host['host_name'] = $req->host_domain_name;
        $Host['product_id'] = $req->product_id;
        $Host['type'] = "CloudHosting";
        $Host['url'] = url('/').'/Employee/CloudHosting/store';
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
        $Log['subject'] = "CloudHosting Data Store By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/CloudHosting/store';
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);



        
        return redirect('Employee/CloudHosting/home')->with('success', "New Cloud Hosting Added Successfully");
    }

     //edit
    public function edit(Request $req,$id)
    {
        $CloudHosting = CloudHosting::find($id);
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
        $Rack = Rack::get();
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
        $Log['subject'] = "CloudHosting Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/CloudHosting/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('Employee.Services.CloudHosting.edit',compact('CloudHosting','Client','Vendor','Product','OperatingSysten','Currency','PaymentMethod','Country','Rack','Status','public_ip','private_ip','Switchs','firewall','Employee'));
    }

    //updated
public function update(Request $req, $id)
{

    $data = CloudHosting::find($id);
        $data['user_id'] = Auth::user()->id;
        $data['customer_id'] = $req->customer_id;
        $data['product_id'] = $req->product_id;
        $data['host_domain_name'] = $req->host_domain_name;
        $data['server_name_id'] = $req->server_name_id;
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
        $data['firewall_id'] = $req->firewall_id;
        $data['status'] = $req->status;
        $data['dc_login_url'] = $req->dc_login_url;
        $data['dc_username'] = $req->dc_username;
        $data['dc_password'] = Hash::make($req->dc_password);
        $data['cloudHosting_notes'] = $req->cloudHosting_notes;
        $data['username'] = $req->username;
        $data['password'] = Hash::make($req->password);
        $data['login_notes'] = $req->login_notes;
        if($req->employee_id){
                        $empid = implode(",", $req->employee_id);
        
                }else{
                   $empid = 0; 
                }
        
        
            // Update other fields (assuming this part is unchanged)
            $data['employee_id'] = $empid;
        // $data['employee_id'] = $req->employee_id;
        $data->save();


        $Host = Host::Where('service_id',$id)->where('type','CloudHosting')->first();
        $Host['client_id'] = $req->customer_id;
        $Host['host_name'] = $req->host_domain_name;
        $Host['product_id'] = $req->product_id;
        $Host['type'] = "CloudHosting";
        $Host['url'] = url('/').'/Employee/CloudHosting/update/'.$id;
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
        $Log['subject'] = "CloudHosting Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/CloudHosting/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('Employee/CloudHosting/home')->with('success', "Cloud Hosting Updated Successfully");
    }

     public function delete(Request $request,$id)
    {
        CloudHosting::find($id)->delete();
        Host::where('service_id',$id)->where('type','CloudHosting')->delete();

        $agent = new Agent();

        // Get user agent information
        $browser = $agent->browser();
        $version = $agent->version($browser); // Pass the browser name as an argument

        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "CloudHosting Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/CloudHosting/delete/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);
        return redirect('Employee/CloudHosting/home')->with('success', "Cloud Hosting Deleted Successfully");
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
            $Log['subject'] = "CloudHosting CSV Export  By " . Auth::user()->first_name;
            $Log['url'] = url('/') . '/Employee/CloudHosting/EXPORTCSV';
            $Log['method'] = "Get";
            $Log['browser'] = $browser . "-" . $version;
            LogActivity::create($Log);

            return Excel::download(new CloudHostingExport, 'CloudHosting.csv');
        }


}
