<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller;
use App\Exports\CompanyLoginExport; 
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;
use App\Models\OperatingSysten;
use App\Models\PaymentMethod;     
use App\Models\CompanyLogin;   
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use Illuminate\Support\Str;
use App\Models\IPAddress;
use App\Models\Currency;   
use App\Models\Countrys;
use App\Models\Firewall;
use App\Models\Employee;
use App\Models\Product;
use App\Models\Status;
use App\Models\Switchs;
use App\Models\User;
use App\Models\Rack;
use App\Models\StorageSetting;
use Illuminate\Support\Facades\Storage;

use Hash;
use Auth;


class CompanyLoginController extends Controller
{   
    //home page
    public function home(Request $request)
    {
        $query = $request->get('search');
        
        $CompanyLogin = CompanyLogin::select('company_logins.company_name','company_logins.id','company_logins.portal_login_url','company_logins.username','company_logins.password2','company_logins.status')
            ->where(function($q) use ($query) {
                $q->where('company_logins.company_name', 'LIKE', "%$query%")
                  ->orWhere('company_logins.username', 'LIKE', "%$query%");
            })
            ->orderBy('company_logins.created_at', 'desc')
            ->paginate(10);

         $CompanyLogin->appends(['search' => $query]);   
    
        $Total = CompanyLogin::count();
        $Active = CompanyLogin::where('status', 1)->count();
        $Suspended = CompanyLogin::where('status', 2)->count();
        $Terminated = CompanyLogin::where('status', 3)->count();
        
        return view('admin.CompanyLogin.home', compact('CompanyLogin','Active','Suspended','Terminated','query','Total'));
    }

    //home page
    public function Create(Request $request)
    {   
        $Status = Status::get();
        $Employee = User::select('first_name','id')->where('type',4)->get();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Company Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/CompanyLogin/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('admin.CompanyLogin.create',compact('Employee','Status')); 
    }


// Home page store method
// Home page store method
public function store(Request $req)
{
    $url = url('/').'/public/images/';

    $StorageSetting = StorageSetting::find(1);
    $storageLocal = $StorageSetting->status == 0;

    $logo_attachment_url = $url . 'default_logo_attachment.jpg'; // Default URL if no file is uploaded

    if ($req->hasFile('documents')) {
        $rand = Str::random(4);
        $file = $req->file('documents')[0]; // Assuming you want to handle the first file in 'documents' array
        $extension = $file->getClientOriginalExtension();
        $logo_attachmentname = 'file_doc_' . $rand . '.' . $extension;

        if ($storageLocal) {
            $file->move(public_path('images/'), $logo_attachmentname);
            $logo_attachment_url = $url . $logo_attachmentname;
        } else {
            $logo_attachment_url = $this->Upload($StorageSetting, $logo_attachmentname, $file);
        }
    }

    $data = $req->all();
    $data['companylogo'] = $logo_attachment_url; // Using the correct variable
    $data['password'] = Hash::make($req->password);
    $data['password2'] = $req->password;
    $data['user_id'] = Auth::user()->id;

    $datass = CompanyLogin::create($data);

    // Log activity
    $agent = new Agent();
    $browser = $agent->browser();
    $version = $agent->version($browser);

    $Log = $req->all();
    $Log['user_id'] = Auth::user()->id;
    $Log['ip'] = $req->ip();
    $Log['subject'] = "Company Data Store By " . Auth::user()->first_name;
    $Log['url'] = url('/') . '/admin/CompanyLogin/store';
    $Log['method'] = "Post";
    $Log['browser'] = $browser . "-" . $version;

    LogActivity::create($Log);

    return redirect('admin/CompanyLogin/home')->with('success', "New Company Added Successfully");
}

// Upload method


   public function Upload($StorageSetting, $fileName, $file)
    {
        config([
            'filesystems.disks.s3.key' => $StorageSetting->AWS_ACCESS_KEY_ID,
            'filesystems.disks.s3.secret' => $StorageSetting->AWS_SECRET_ACCESS_KEY,
            'filesystems.disks.s3.region' => $StorageSetting->AWS_DEFAULT_REGION,
            'filesystems.disks.s3.bucket' => $StorageSetting->AWS_BUCKET,
        ]);

        $basePath = 'images/'.date('y').'/'.date('m').'/' . $fileName;
        
        $path = Storage::disk('s3')->put($basePath, $file);

        $url =  $StorageSetting->S3_BASE_URL. '/' . $path;
        return $url;
    }
    //edit
    public function edit(Request $req,$id)
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Company Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/CompanyLogin/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        $Status = Status::get();
        $CompanyLogin = CompanyLogin::find($id);
        $Employee = User::select('first_name','id')->where('type',4)->get();
        return view('admin.CompanyLogin.edit',compact('CompanyLogin','Employee','Status'));
    }

    //updated
   public function update(Request $req, $id)
{
    $data = CompanyLogin::find($id);
    $data['company_name'] = $req->company_name;
    $data['portal_login_url'] = $req->portal_login_url;
    $data['username'] = $req->username;
    $data['authorised_person_name'] = $req->authorised_person_name;
    $data['contact_no'] = $req->contact_no;
    $data['email_address'] = $req->email_address;
    $data['aditional_informaiton'] = $req->aditional_informaiton;
    $data['status'] = $req->status;
    $data['employee_id'] = $req->employee_id;
    $data['password'] = Hash::make($req->password);
    $data['password2'] = $req->password;
    $data['user_id'] = Auth::user()->id;

    $StorageSetting = StorageSetting::find(1);
    $storageLocal = $StorageSetting->status == 0;

    if ($req->hasFile('logo_attachment')) {
        $profileFilename = 'file_doc_' . Str::random(4) . '.' . $req->file('logo_attachment')->getClientOriginalExtension();
        
        if ($storageLocal) {
            $req->file('logo_attachment')->move(public_path('images/'), $profileFilename);
            $data->companylogo = url('/public/images/') . '/' . $profileFilename;
        } else {
            $url = $this->Upload($StorageSetting, $profileFilename, $req->file('logo_attachment'));
            $data->companylogo = $url;
        }
    }
    $data->save();

    // Log activity
    $agent = new Agent();
    $browser = $agent->browser();
    $version = $agent->version($browser);

    $Log = $req->all();
    $Log['user_id'] = Auth::user()->id;
    $Log['ip'] = $req->ip();
    $Log['subject'] = "Company Data Updated By " . Auth::user()->first_name;
    $Log['url'] = url('/') . '/admin/CompanyLogin/update/' . $id;
    $Log['method'] = "Post";
    $Log['browser'] = $browser . "-" . $version;

    LogActivity::create($Log);

    return redirect('admin/CompanyLogin/home')->with('success', "Company Edit Successfully");
}



     public function delete(Request $request,$id)
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Company Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/CompanyLogin/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        CompanyLogin::find($id)->delete();
        return redirect('admin/CompanyLogin/home')->with('success', "Company Deleted Successfully");
    }

    public function EXPORTCSV(Request $request)
        {
            $agent = new Agent();
            $browser = $agent->browser();
            $version = $agent->version($browser);
            $Log = $request->all();
            $Log['user_id'] = Auth::user()->id;
            $Log['ip'] = $request->ip();
            $Log['subject'] = "Company CSV Export  By " . Auth::user()->first_name;
            $Log['url'] = url('/') . '/admin/CompanyLogin/EXPORTCSV';
            $Log['method'] = "Get";
            $Log['browser'] = $browser . "-" . $version;
            LogActivity::create($Log);

            return Excel::download(new CompanyLoginExport, 'Company.csv');
        }
}
