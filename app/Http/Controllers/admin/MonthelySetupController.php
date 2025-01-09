<?php

namespace App\Http\Controllers\admin;

use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\MonthelySetupExport; 
use Illuminate\Support\Collection;
use App\Models\OperatingSysten;
use App\Models\PaymentMethod;   
use Illuminate\Http\Request;
use App\Models\MonthelySetup;   
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use App\Models\IPAddress;
use App\Models\Countrys;
use App\Models\Employee;
use App\Models\Currency;   
use App\Models\Firewall;
use App\Models\Product;
use App\Models\ProductNew;
use App\Models\Switchs;
use App\Models\Status;
use App\Models\User;
use App\Models\Rack;
use App\Models\Host;
use Hash;
use Auth;


class MonthelySetupController extends Controller
{   
    //home page
 public function home(Request $request)
{
    $query = $request->get('search');

    $MonthelySetup = MonthelySetup::select('monthely_setups.service_type','total_services.unique_id as unique_service_id','users.profile_img','users.email', 'monthely_setups.id', 'monthely_setups.signup_date', 'monthely_setups.status', 'users.first_name', 'product_news.product_name')
        ->join('users', 'users.id', 'monthely_setups.customer_id')
        ->join('product_news', 'product_news.id', 'monthely_setups.product_id')
        ->leftjoin('total_services','total_services.invoice_id','monthely_setups.invoice_id')
        ->where(function ($q) use ($query) {
            $q->where('monthely_setups.service_type', 'LIKE', "%$query%")
                ->orWhere('users.first_name', 'LIKE', "%$query%")
                ->orWhere('product_news.product_name', 'LIKE', "%$query%");
        })
          ->where('total_services.category_id',13)
            ->groupBy('total_services.unique_id')
        ->orderBy('monthely_setups.created_at', 'desc')
        ->paginate(10);

    $MonthelySetup->appends(['search' => $query]); // Append the search term to the pagination links

    $Total = MonthelySetup::count();
    $Active = MonthelySetup::where('status', 1)->count();
    $Suspended = MonthelySetup::where('status', 2)->count();
    $Terminated = MonthelySetup::where('status', 3)->count();

    return view('admin.Services.MonthelySetup.home', compact('MonthelySetup', 'Total', 'Active', 'Suspended', 'Terminated', 'query'));
}





    //home page
    public function Create(Request $request)
    {   
        $Client = User::select('id','first_name')->where('type','2')->get();
        $Vendor = User::select('id','first_name')->where('type','3')->get();
        $Product = ProductNew::select('id','product_name')->get();
        $OperatingSysten = OperatingSysten::get();
        $PaymentMethod = PaymentMethod::get();
        $Currency = Currency::get();
        $Status = Status::get();
        $Employee = User::select('first_name','id')->where('type',4)->get();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "MonthelySetup Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/MonthelySetup/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('admin.Services.MonthelySetup.create',compact('Client','Vendor','Product','OperatingSysten','Currency','PaymentMethod','Status','Employee')); 
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
        $data['control_panel_password'] = Hash::make($req->control_panel_password);
        $data['rdp_ssh_password'] = Hash::make($req->rdp_ssh_password);
        $data['user_id'] = Auth::user()->id;
        $datass = MonthelySetup::create($data);
            
        $Host = $req->all();
        $Host['client_id'] = $req->customer_id;
        $Host['service_id'] = $datass->id;
        $Host['host_name'] = $req->host_domain_name;
        $Host['product_id'] = $req->product_id;
        $Host['type'] = "MonthelySetup";
        $Host['url'] = url('/').'/admin/MonthelySetup/store';
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
        $Log['subject'] = "MonthelySetup Data Store By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/MonthelySetup/store';
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('admin/MonthelySetup/home')->with('success', "New MonthelySetup Added Successfully");
    }

    //edit
    public function edit(Request $req,$id)
    {
        $MonthelySetup = MonthelySetup::find($id);
       
        $Client = User::select('id','first_name')->where('type','2')->get();
        $Vendor = User::select('id','first_name')->where('type','3')->get();
        $Product = ProductNew::select('id','product_name')->get();
        $OperatingSysten = OperatingSysten::get();
        $PaymentMethod = PaymentMethod::get();
        $Currency = Currency::get();
        $Status = Status::get();
        $Employee = User::select('first_name','id')->where('type',4)->get();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "MonthelySetup Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/MonthelySetup/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('admin.Services.MonthelySetup.edit',compact('MonthelySetup','Client','Vendor','Product','OperatingSysten','Currency','PaymentMethod','Status','Employee'));
    }

    //updated
public function update(Request $req, $id)
{
    $url = url('/').'/public/images/';
    $data = MonthelySetup::find($id);

   
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
        $data['status'] = $req->status;
        $data['onetimesetup_notes'] = $req->onetimesetup_notes;
        $data['todo_notes'] = $req->todo_notes;
        $data['control_panel_login_url'] = $req->control_panel_login_url;
        $data['control_panel_user_name'] = $req->control_panel_user_name;
        $data['rdp_ssh_username'] = $req->rdp_ssh_username;
        $data['rdp_ssh_port'] = $req->rdp_ssh_port;
        $data['server_ip'] = $req->server_ip;
        $data['control_panel_url'] = $req->control_panel_url;
        $data['pemkey'] = $req->pemkey;
        $data['Privatekey'] = $req->Privatekey;
        $data['publickey'] = $req->publickey;
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
        $data['control_panel_password'] = Hash::make($req->control_panel_password);
        $data['rdp_ssh_password'] = Hash::make($req->rdp_ssh_password);
        $data['user_id'] = Auth::user()->id;
        $data->save();

        $Host = Host::Where('service_id',$id)->where('type','MonthelySetup')->first();
        $Host['client_id'] = $req->customer_id;
        $Host['host_name'] = $req->host_domain_name;
        $Host['product_id'] = $req->product_id;
        $Host['type'] = "MonthelySetup";
        $Host['url'] = url('/').'/admin/MonthelySetup/update/'.$id;
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
        $Log['subject'] = "MonthelySetup Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/MonthelySetup/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);


        return redirect('admin/MonthelySetup/home')->with('success', "MonthelySetup Edit Successfully");
    }

     public function delete(Request $request,$id)
    {
        MonthelySetup::find($id)->delete();

        Host::where('service_id',$id)->where('type','MonthelySetup')->delete();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "MonthelySetup Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/MonthelySetup/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('admin/MonthelySetup/home')->with('success', "MonthelySetup Deleted Successfully");
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
            $Log['subject'] = "MonthelySetup CSV Export  By " . Auth::user()->first_name;
            $Log['url'] = url('/') . '/admin/MonthelySetup/EXPORTCSV';
            $Log['method'] = "Get";
            $Log['browser'] = $browser . "-" . $version;
            LogActivity::create($Log);

            return Excel::download(new MonthelySetupExport, 'MonthelySetup.csv');
        }

}
