<?php

namespace App\Http\Controllers\Employee;

use App\Exports\MicrosoftOffice365Export;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller; 
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;
use App\Models\MicrosoftOffice365;   
use App\Models\OperatingSysten;
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
use Hash;
use Auth;


class EMicrosoftOffice365Controller extends Controller
{   
  public function home(Request $request)
{
    $RoleAccess = \App\Models\RoleAccess::select('role_accesses.add', 'role_accesses.view', 'role_accesses.update', 'role_accesses.delete', 'permissions.name as per_name')
        ->join('employee_details', 'employee_details.job_role_id', 'role_accesses.role_id')
        ->leftJoin('permissions', 'permissions.id', 'role_accesses.permission_id')
        ->where('employee_details.user_id', Auth::user()->id)
        ->where(function ($query) {
            $query->where('role_accesses.view', '!=', null)
                ->orWhere('role_accesses.add', '!=', null)
                ->orWhere('role_accesses.update', '!=', null)
                ->orWhere('role_accesses.delete', '!=', null);
        })
        ->get()
        ->toArray();

    $microsoftOffice365Access = array_search('MicrosoftOffice365', array_column($RoleAccess, 'per_name')) !== false ? $RoleAccess[array_search('MicrosoftOffice365', array_column($RoleAccess, 'per_name'))]['view'] : 0;

    $searchTerm = $request->input('search');
    $query = MicrosoftOffice365::select('microsoft_office365s.service_type', 'microsoft_office365s.unique_service_id', 'users.profile_img', 'users.email', 'microsoft_office365s.id', 'microsoft_office365s.signup_date', 'microsoft_office365s.status', 'users.first_name', 'product_news.product_name')
        ->join('users', 'users.id', 'microsoft_office365s.customer_id')
        ->join('product_news', 'product_news.id', 'microsoft_office365s.product_id')
        ->leftJoin('total_services', 'total_services.invoice_id', 'microsoft_office365s.invoice_id');

    if ($microsoftOffice365Access == 1) {
        if (!empty($searchTerm)) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('microsoft_office365s.service_type', 'like', '%' . $searchTerm . '%')
                    ->orWhere('users.first_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('product_news.product_name', 'like', '%' . $searchTerm . '%');
            });
        }

        $MicrosoftOffice365 = $query->where('total_services.category_id', 11)
            ->groupBy('total_services.unique_id')
            ->orderBy('microsoft_office365s.created_at', 'desc')
            ->paginate(10);
    } elseif ($microsoftOffice365Access == 2) {
        $query->where('microsoft_office365s.user_id', Auth::user()->id);

        if (!empty($searchTerm)) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('microsoft_office365s.service_type', 'like', '%' . $searchTerm . '%')
                    ->orWhere('users.first_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('product_news.product_name', 'like', '%' . $searchTerm . '%');
            });
        }

        $MicrosoftOffice365 = $query->where('total_services.category_id', 11)
            ->groupBy('total_services.unique_id')
            ->orderBy('microsoft_office365s.created_at', 'desc')
            ->paginate(10);
    } else {
        $MicrosoftOffice365 = collect();
    }

    if (!empty($searchTerm)) {
        $MicrosoftOffice365->appends(['search' => $searchTerm]);
    }

    $TotalQuery = MicrosoftOffice365::query();
    $ActiveQuery = MicrosoftOffice365::where('status', 1);
    $SuspendedQuery = MicrosoftOffice365::where('status', 2);
    $TerminatedQuery = MicrosoftOffice365::where('status', 3);

    if ($microsoftOffice365Access == 2) {
        $TotalQuery->where('user_id', Auth::user()->id);
        $ActiveQuery->where('user_id', Auth::user()->id);
        $SuspendedQuery->where('user_id', Auth::user()->id);
        $TerminatedQuery->where('user_id', Auth::user()->id);
    }

    $Total = $TotalQuery->count();
    $Active = $ActiveQuery->count();
    $Suspended = $SuspendedQuery->count();
    $Terminated = $TerminatedQuery->count();

    return view('Employee.Services.MicrosoftOffice365.home', compact('RoleAccess', 'MicrosoftOffice365', 'Active', 'Suspended', 'Terminated', 'searchTerm', 'Total'));
}



    //home page
    public function Create(Request $request)
    {   
        $Vendor = User::select('id','first_name')->where('type','3')->get();
        $Client = User::select('id','first_name')->where('type','2')->get();
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
        $Log['subject'] = "MicrosoftOffice365 Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/MicrosoftOffice365/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('Employee.Services.MicrosoftOffice365.create',compact('Client','Vendor','Product','Currency','PaymentMethod','Status','Employee')); 
    }


    //home page
    public function store(Request $req)
    {
        $data = $req->all();
        $data['passwrod'] = Hash::make($req->passwrod);
        $data['user_id'] = Auth::user()->id;
        $datass = MicrosoftOffice365::create($data);

        $Host = $req->all();
        $Host['user_id'] = Auth::user()->id;
        $Host['client_id'] = $req->customer_id;
        $Host['service_id'] = $datass->id;
        $Host['host_name'] = $req->domain_name_tenant_id;
        $Host['product_id'] = $req->product_id;
        $Host['type'] = "MicrosoftOffice365";
        $Host['url'] = url('/').'/Employee/MicrosoftOffice365/store';
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
        $Log['subject'] = "MicrosoftOffice365 Data Store By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/MicrosoftOffice365/store';
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('Employee/MicrosoftOffice365/home')->with('success', "New MicrosoftOffice365 Added Successfully");
    }

    //edit
    public function edit(Request $req,$id)
    {
        $MicrosoftOffice365 = MicrosoftOffice365::find($id);
        $Vendor = User::select('id','first_name')->where('type','3')->get();
        $Client = User::select('id','first_name')->where('type','2')->get();
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
        $Log['subject'] = "MicrosoftOffice365 Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/MicrosoftOffice365/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('Employee.Services.MicrosoftOffice365.edit',compact('MicrosoftOffice365','Client','Vendor','Product','Currency','PaymentMethod','Status','Employee'));
    }

    //updated
public function update(Request $req, $id)
{
        $data = MicrosoftOffice365::find($id);
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

        $Host = Host::Where('service_id',$id)->where('type','MicrosoftOffice365')->first();
        $Host['client_id'] = $req->customer_id;
        $Host['host_name'] = $req->domain_name_tenant_id;
        $Host['product_id'] = $req->product_id;
        $Host['type'] = "MicrosoftOffice365";
        $Host['url'] = url('/').'/Employee/MicrosoftOffice365/update/'.$id;
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
        $Log['subject'] = "MicrosoftOffice365 Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/MicrosoftOffice365/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);


        return redirect('Employee/MicrosoftOffice365/home')->with('success', "MicrosoftOffice365 Edit Successfully");
    }

     public function delete(Request $request,$id)
    {
        MicrosoftOffice365::find($id)->delete();

        Host::where('service_id',$id)->where('type','MicrosoftOffice365')->delete();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "MicrosoftOffice365 Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/MicrosoftOffice365/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);


        return redirect('Employee/MicrosoftOffice365/home')->with('success', "MicrosoftOffice365 Deleted Successfully");
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
            $Log['subject'] = "MicrosoftOffice365 CSV Export  By " . Auth::user()->first_name;
            $Log['url'] = url('/') . '/Employee/MicrosoftOffice365/EXPORTCSV';
            $Log['method'] = "Get";
            $Log['browser'] = $browser . "-" . $version;
            LogActivity::create($Log);

            return Excel::download(new MicrosoftOffice365Export, 'MicrosoftOffice365.csv');
        }

}
