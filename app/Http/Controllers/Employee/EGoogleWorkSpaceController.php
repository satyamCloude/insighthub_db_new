<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller; 
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\GoogleWorkSpaceExport;
use Illuminate\Support\Collection;
use App\Models\OperatingSysten;
use App\Models\GoogleWorkSpace;   
use App\Models\PaymentMethod;   
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use Illuminate\Support\Str;
use App\Models\IPAddress;
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
use App\Models\File;
use Hash;
use Auth;


class EGoogleWorkSpaceController extends Controller
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
    
        if($RoleAccess[array_search('GoogleWorkSpace', array_column($RoleAccess, 'per_name'))]['view'] == 1)
        {
            $searchTerm = $request->input('search');

            $query = GoogleWorkSpace::select('google_work_spaces.service_type', 'total_services.unique_id as unique_service_id', 'users.profile_img', 'users.email', 'google_work_spaces.id', 'google_work_spaces.signup_date', 'google_work_spaces.status', 'users.first_name', 'product_news.product_name')
        ->join('users', 'users.id', '=', 'google_work_spaces.customer_id')
        ->join('product_news', 'product_news.id', '=', 'google_work_spaces.product_id')
        ->leftJoin('total_services', 'total_services.invoice_id', '=', 'google_work_spaces.invoice_id'); // Verify if 'azures.invoice_id' is correct

    // Check if a search term is provided
    if (!empty($searchTerm)) {
        $query->where(function ($q) use ($searchTerm) {
            $q->where('google_work_spaces.service_type', 'like', '%' . $searchTerm . '%')
              ->orWhere('users.first_name', 'like', '%' . $searchTerm . '%')
              ->orWhere('product_news.product_name', 'like', '%' . $searchTerm . '%');
        });
    }

    $GoogleWorkSpace = $query->where('total_services.category_id',10)
        ->groupBy('total_services.unique_id')
        ->orderBy('google_work_spaces.created_at', 'desc')
        ->paginate(10);
        
            $GoogleWorkSpace->appends(['search' => $searchTerm]);

            $Total = GoogleWorkSpace::count();
            $Active = GoogleWorkSpace::where('status', 1)->count();
            $Suspended = GoogleWorkSpace::where('status', 2)->count();
            $Terminated = GoogleWorkSpace::where('status', 3)->count();
            
        }

        if($RoleAccess[array_search('GoogleWorkSpace', array_column($RoleAccess, 'per_name'))]['view'] == 2)
        {
            $searchTerm = $request->input('search');

           $query = GoogleWorkSpace::select('google_work_spaces.service_type', 'total_services.unique_id as unique_service_id', 'users.profile_img', 'users.email', 'google_work_spaces.id', 'google_work_spaces.signup_date', 'google_work_spaces.status', 'users.first_name', 'product_news.product_name')
        ->join('users', 'users.id', '=', 'google_work_spaces.customer_id')
        ->join('product_news', 'product_news.id', '=', 'google_work_spaces.product_id')
        ->leftJoin('total_services', 'total_services.invoice_id', '=', 'google_work_spaces.invoice_id')
                ->Where('google_work_spaces.user_id',Auth::user()->id);

             // Check if a search term is provided
    if (!empty($searchTerm)) {
        $query->where(function ($q) use ($searchTerm) {
            $q->where('google_work_spaces.service_type', 'like', '%' . $searchTerm . '%')
              ->orWhere('users.first_name', 'like', '%' . $searchTerm . '%')
              ->orWhere('product_news.product_name', 'like', '%' . $searchTerm . '%');
        });
    }

    $GoogleWorkSpace = $query->where('total_services.category_id',10)
        ->groupBy('total_services.unique_id')
        ->orderBy('google_work_spaces.created_at', 'desc')
        ->paginate(10);
            $GoogleWorkSpace->appends(['search' => $searchTerm]);

            $Total = GoogleWorkSpace::where('user_id',Auth::user()->id)->count();
            $Active = GoogleWorkSpace::where('user_id',Auth::user()->id)->where('status', 1)->count();
            $Suspended = GoogleWorkSpace::where('user_id',Auth::user()->id)->where('status', 2)->count();
            $Terminated = GoogleWorkSpace::where('user_id',Auth::user()->id)->where('status', 3)->count();
            
        }


    return view('Employee.Services.GoogleWorkSpace.home', compact('RoleAccess','GoogleWorkSpace','Total','Active','Suspended','Terminated','searchTerm'));
}




    //home page
    public function Create(Request $request)
    {   
        $Vendor = User::select('id','first_name')->where('type','2')->get();
        $Client = User::select('id','first_name')->where('type','3')->get();
        $Employee = User::select('first_name','id')->where('type',4)->get();
        $Product = Product::select('id','product_name')->get();
        $PaymentMethod = PaymentMethod::get();
        $Currency = Currency::get();
        $Status = Status::get();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "GoogleWorkSpace Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/GoogleWorkSpace/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);


        return view('Employee.Services.GoogleWorkSpace.create',compact('Client','Vendor','Product','Currency','PaymentMethod','Status','Employee')); 
    }


    //home page
    public function store(Request $req)
    {
        $data = $req->all();
        $data['passwrod'] = Hash::make($req->passwrod);
        $data['user_id'] = Auth::user()->id;
        $datass = GoogleWorkSpace::create($data);

        $Host = $req->all();
        $Host['client_id'] = $req->customer_id;
        $Host['service_id'] = $datass->id;
        $Host['host_name'] = $req->domain_name_tenant_id;
        $Host['product_id'] = $req->product_id;
        $Host['type'] = "GoogleWorkSpace";
        $Host['url'] = url('/').'/Employee/GoogleWorkSpace/store';
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
        $Log['subject'] = "GoogleWorkSpace Data Store By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/GoogleWorkSpace/store';
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('Employee/GoogleWorkSpace/home')->with('success', "New GoogleWorkSpace Added Successfully");
    }

    //edit
    public function edit(Request $req,$id)
    {
        $GoogleWorkSpace = GoogleWorkSpace::find($id);
        $Vendor = User::select('id','first_name')->where('type','2')->get();
        $Client = User::select('id','first_name')->where('type','3')->get();
        $Employee = User::select('first_name','id')->where('type',4)->get();
        $Product = Product::select('id','product_name')->get();
        $PaymentMethod = PaymentMethod::get();
        $Currency = Currency::get();
        $Status = Status::get();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "GoogleWorkSpace Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/GoogleWorkSpace/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('Employee.Services.GoogleWorkSpace.edit',compact('GoogleWorkSpace','Client','Vendor','Product','Currency','PaymentMethod','Status','Employee'));
    }

    //updated
public function update(Request $req, $id)
{
        $data = GoogleWorkSpace::find($id);
        $data['customer_id'] = $req->customer_id;
        $data['customer_id2'] = $req->customer_id2;
        $data['product_id'] = $req->product_id;
        $data['domain_name_tenant_id'] = $req->domain_name_tenant_id;
        $data['quantity'] = $req->quantity;
        $data['vender_id'] = $req->vender_id;
        $data['service_type'] = $req->service_type;
        $data['subscription_id'] = $req->subscription_id;
        $data['status'] = $req->status;
        $data['google_notes'] = $req->google_notes;
        $data['first_payment'] = $req->first_payment;
        $data['billing_cycle'] = $req->billing_cycle;
        $data['currency_id'] = $req->currency_id;
        $data['payment_method_id'] = $req->payment_method_id;
        $data['signup_date'] = $req->signup_date;
        $data['next_due_date'] = $req->next_due_date;
        $data['terminate_date'] = $req->terminate_date;
        $data['login_url'] = $req->login_url;
        $data['username'] = $req->username;
        $data['passwrod'] = Hash::make($req->passwrod);
        $data['email'] = $req->email;
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

        $Host = Host::Where('service_id',$id)->where('type','GoogleWorkSpace')->first();
        $Host['user_id'] = Auth::user()->id;
        $Host['client_id'] = $req->customer_id;
        $Host['host_name'] = $req->domain_name_tenant_id;
        $Host['product_id'] = $req->product_id;
        $Host['type'] = "GoogleWorkSpace";
        $Host['url'] = url('/').'/Employee/GoogleWorkSpace/update/'.$id;
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
        $Log['subject'] = "GoogleWorkSpace Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/GoogleWorkSpace/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);    

        return redirect('Employee/GoogleWorkSpace/home')->with('success', "GoogleWorkSpace Edit Successfully");
    }

     public function delete(Request $request,$id)
    {
        GoogleWorkSpace::find($id)->delete();

        Host::where('service_id',$id)->where('type','GoogleWorkSpace')->delete();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "GoogleWorkSpace Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/GoogleWorkSpace/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('Employee/GoogleWorkSpace/home')->with('success', "GoogleWorkSpace Deleted Successfully");
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
            $Log['subject'] = "GoogleWorkSpace CSV Export  By " . Auth::user()->first_name;
            $Log['url'] = url('/') . '/Employee/GoogleWorkSpace/EXPORTCSV';
            $Log['method'] = "Get";
            $Log['browser'] = $browser . "-" . $version;
            LogActivity::create($Log);

            return Excel::download(new GoogleWorkSpaceExport, 'GoogleWorkSpace.csv');
        }

}
