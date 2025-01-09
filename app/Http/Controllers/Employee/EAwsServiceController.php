<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use App\Exports\AwsServicerExport; 
use App\Models\OperatingSysten;
use App\Models\PaymentMethod;   
use App\Models\AwsService2;   
use App\Models\LogActivity;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Str;
use App\Models\AwsService;   
use App\Models\IPAddress;
use App\Models\Firewall;
use App\Models\Currency;   
use App\Models\Employee;
use App\Models\Countrys;
use App\Models\Switchs;
use App\Models\Product;
use App\Models\Status;
use App\Models\Host;
use App\Models\User;
use App\Models\Rack;
use Hash;
use Auth;


class EAwsServiceController extends Controller
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
    
        if($RoleAccess[array_search('AwsService', array_column($RoleAccess, 'per_name'))]['view'] == 1)
        {
            $query = $request->get('search');
        
            $AwsService = AwsService::select('aws_services.service_type','total_services.unique_id as unique_service_id','users.profile_img','users.email','aws_services.id','aws_services.signup_date','aws_services.status','users.first_name','product_news.product_name')
            ->join('users','users.id','aws_services.customer_id')
            ->join('product_news','product_news.id','aws_services.product_id')
            ->leftjoin('total_services','total_services.invoice_id','aws_services.invoice_id')
            ->where(function($q) use ($query) {
                $q->where('aws_services.service_type', 'LIKE', "%$query%")
                  ->orWhere('users.first_name', 'LIKE', "%$query%")
                  ->orWhere('product_news.product_name', 'LIKE', "%$query%");
            })
            ->where('total_services.category_id',8)
            ->groupBy('total_services.unique_id')
            ->orderBy('aws_services.created_at', 'desc')
            ->paginate(10);


            $AwsService->appends(['search' => $query]);
                    
            $Total = AwsService::count();
            $Active = AwsService::where('status', 1)->count();
            $Suspended = AwsService::where('status', 2)->count();
            $Terminated = AwsService::where('status', 3)->count();
            
        }

        if($RoleAccess[array_search('AwsService', array_column($RoleAccess, 'per_name'))]['view'] == 2)
        {
            $query = $request->get('search');

            $AwsService = AwsService::select('aws_services.service_type','total_services.unique_id as unique_service_id','users.profile_img','users.email','aws_services.id','aws_services.signup_date','aws_services.status','users.first_name','product_news.product_name')
            ->join('users','users.id','aws_services.customer_id')
            ->join('product_news','product_news.id','aws_services.product_id')
            ->leftjoin('total_services','total_services.invoice_id','aws_services.invoice_id')
                ->where(function($q) use ($query) {
                    $q->where('aws_services.service_type', 'LIKE', "%$query%")
                      ->orWhere('users.first_name', 'LIKE', "%$query%")
                      ->orWhere('product_news.product_name', 'LIKE', "%$query%");
                })
                ->where('aws_services.user_id',Auth::user()->id)
                 ->where('total_services.category_id',8)
            ->groupBy('total_services.unique_id')
            ->orderBy('aws_services.created_at', 'desc')
                ->paginate(10);

            $AwsService->appends(['search' => $query]);
                    
            $Total = AwsService::where('user_id',Auth::user()->id)->count();
            $Active = AwsService::where('user_id',Auth::user()->id)->where('status', 1)->count();
            $Suspended = AwsService::where('user_id',Auth::user()->id)->where('status', 2)->count();
            $Terminated = AwsService::where('user_id',Auth::user()->id)->where('status', 3)->count();
            
        }

        return view('Employee.Services.AwsService.home', compact('RoleAccess','AwsService','Active','Suspended','Terminated','query','Total'));
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
        $Log['subject'] = "AwsService Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/AwsService/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('Employee.Services.AwsService.create',compact('Client','Vendor','Product','OperatingSysten','Currency','PaymentMethod','Country','Rack','Status','primary_public_ip','additional_public_ip','primary_private_ip','additional_private_ip','Switchs','firewall','Employee')); 
    }


    //home page
    public function store(Request $req)
    {

        $url = url('/').'/public/images/';
     
        $architecture = 'architectureDefault.jpg';
        if ($req->hasFile('architecture')) {
            $rand = Str::random(4);
            $file = $req->file('architecture');
            $extension = $file->getClientOriginalExtension();
            $architecture = 'architecture'.$rand.'.'.$extension;
            $file->move('public/images/', $architecture);
        }

        $data = $req->all();
        $data['architecture'] = $url . $architecture;
        $data['aws_password'] = Hash::make($req->aws_password);
        $data['control_panel_password'] = Hash::make($req->control_panel_password);
        $data['user_id'] = Auth::user()->id;
        $datass =  AwsService::create($data);


        foreach ($req->server_ip as $key => $value) {
        $data = new AwsService2;
    
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
        $data['rdp_ssh_password'] = bcrypt($req->rdp_ssh_password[$key]); // Fixing password hashing
        $data['region'] = $req->region[$key];
        $data['aws_id'] = $datass->id;
        $data->save();
        }

         $Host = $req->all();
        $Host['user_id'] = Auth::user()->id;
        $Host['client_id'] = $req->customer_id;
        $Host['service_id'] = $datass->id;
        $Host['host_name'] = $req->host_domain_name;
        $Host['product_id'] = $req->product_id;
        $Host['type'] = "AwsService";
        $Host['url'] = url('/').'/Employee/AwsService/store';
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
        $Log['subject'] = "AwsService Data Store By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/AwsService/store';
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        
        return redirect('Employee/AwsService/home')->with('success', "New AwsService Added Successfully");
    }

    //edit
    public function edit(Request $req,$id)
    {
        $AwsService = AwsService::find($id);
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
        $AwsService2 = AwsService2::where('aws_id',$id)->get();
        $Currency = Currency::get();
        $Country = Countrys::get();
        $Status = Status::get();
        $Rack = Rack::get();

         $agent = new Agent();

        // Get user agent information
        $browser = $agent->browser();
        $version = $agent->version($browser); // Pass the browser name as an argument

        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "AwsService Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/AwsService/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);



        return view('Employee.Services.AwsService.edit',compact('AwsService','AwsService2','Client','Vendor','Product','OperatingSysten','Currency','PaymentMethod','Country','Rack','Status','primary_public_ip','additional_public_ip','primary_private_ip','additional_private_ip','Switchs','firewall','Employee'));
    }

    //updated
public function update(Request $req, $id)
{
    $url = url('/').'/public/images/';
        $data = AwsService::find($id);

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
        $data['aws_account_Id'] = $req->aws_account_Id;
        $data['status'] = $req->status;
        $data['aws_notes'] = $req->aws_notes;
        $data['aws_login_url'] = $req->aws_login_url;
        $data['aws_username'] = $req->aws_username;
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
        $data['aws_password'] = Hash::make($req->aws_password);
        $data['control_panel_password'] = Hash::make($req->control_panel_password);
        $data['user_id'] = Auth::user()->id;
        $data->save();   

        AwsService2::where('aws_id',$id)->delete();


        foreach ($req->server_ip as $key => $value) {
        $datas = new AwsService2;
    
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
        $datas['aws_id'] = $data->id;
        $datas->save();
} 
        
       $Host = Host::where('service_id', $id)->where('type', 'AwsService')->first();

        // Check if a Host record was found
        if ($Host) {
            $Host->client_id = $req->customer_id;
            $Host->host_name = $req->host_domain_name;
            $Host->product_id = $req->product_id;
            $Host->type = "AwsService";
            $Host->url = url('/').'/Employee/AwsService/update/'.$id;
            $Host->method = "Post";
            $Host->billing_cycle = $req->billing_cycle;
            $Host->singup = $req->signup_date;
            $Host->servicestype = $req->service_type;
            $Host->status = $req->status;
            $Host['user_id'] = Auth::user()->id;
            $Host->save();
        } else {
            // Handle the case where no Host record was found
            // This could be an error condition based on your application logic
            // You may want to insert a new record instead of updating in this case
        }


        $agent = new Agent();

        // Get user agent information
        $browser = $agent->browser();
        $version = $agent->version($browser); // Pass the browser name as an argument

        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "AwsService Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/AwsService/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);  


        return redirect('Employee/AwsService/home')->with('success', "AwsService Edit Successfully");
    }

     public function delete(Request $request,$id)
    {
        AwsService::find($id)->delete();
        AwsService2::where('aws_id',$id)->delete();

        Host::where('service_id',$id)->where('type','AwsService')->delete();

        $agent = new Agent();

        // Get user agent information
        $browser = $agent->browser();
        $version = $agent->version($browser); // Pass the browser name as an argument

        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "AwsService Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/AwsService/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);


        return redirect('Employee/AwsService/home')->with('success', "AwsService Deleted Successfully");
    }

    public function EXPORTCSV(Request $request)
        {
              $agent = new Agent();

            // Get user agent information
            $browser = $agent->browser();
            $version = $agent->version($browser); // Pass the browser name as an argument

            $Log = $request->all();
            $Log['user_id'] = Auth::user()->id;
            $Log['ip'] = $request->ip();
            $Log['subject'] = "AwsService CSV Export  By " . Auth::user()->first_name;
            $Log['url'] = url('/') . '/Employee/AwsService/EXPORTCSV';
            $Log['method'] = "Get";
            $Log['browser'] = $browser . "-" . $version;
            LogActivity::create($Log);

            return Excel::download(new AwsServicerExport, 'AwsService.csv');
        }

}
