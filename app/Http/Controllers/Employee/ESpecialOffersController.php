<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use App\Models\SpecialOffers;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity; 
use App\Models\Country;
use App\Models\Currency;
use App\Models\State;
use App\Models\StorageSetting;
use Illuminate\Support\Facades\Storage;
use App\Models\City;
use Hash;
use Auth;


class ESpecialOffersController extends Controller
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
                        
    if($RoleAccess[array_search('SpecialOffers', array_column($RoleAccess, 'per_name'))]['view'] == 1)
    {
        $query = SpecialOffers::orderBy('created_at', 'desc');

        $searchTerm = '';
        // Check if a search term is provided
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('url', 'like', '%' . $searchTerm . '%');
            });
        }

        $SpecialOffers = $query->paginate(10);
         $SpecialOffers->appends(['search' => $searchTerm]);

    }

    if($RoleAccess[array_search('SpecialOffers', array_column($RoleAccess, 'per_name'))]['view'] == 2)
    {
        $query = SpecialOffers::where('user_id',Auth::user()->id)->orderBy('created_at', 'desc');

        $searchTerm = '';
        // Check if a search term is provided
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('url', 'like', '%' . $searchTerm . '%');
            });
        }

        $SpecialOffers = $query->paginate(10);
         $SpecialOffers->appends(['search' => $searchTerm]);
        
    }                                

    return view('Employee.sales.SpecialOffers.home', compact('RoleAccess','SpecialOffers','searchTerm'));
}
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



    //home page
    public function Create(Request $request)
    {   
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "SpecialOffers Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/SpecialOffers/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('Employee.sales.SpecialOffers.create'); 
    }


    //home page
    public function store(Request $req)
    {
      
    $url = url('/').'/public/images/';

    $StorageSetting = StorageSetting::find(1);
    $storageLocal = $StorageSetting->status == 0;

    $attachmentFilename = 'attachment.jpg';

    if ($req->hasFile('attachment')) {
        $rand = Str::random(4);
        $file = $req->file('attachment');
        $extension = $file->getClientOriginalExtension();
        $attachmentFilename = 'attachment_'.$rand.'.'.$extension;

        if ($storageLocal) {
            $file->move(public_path('images/'), $attachmentFilename);
            $attachment_url = $url . $attachmentFilename;
        } else {
            $attachment_url = $this->Upload($StorageSetting, $attachmentFilename, $file);
        }
    } else {
        $attachment_url = $url . $attachmentFilename; // Default URL if no file is uploaded
    }

    $data = $req->all();
    $data['attachment'] = $attachment_url;

    SpecialOffers::create($data);

        
            $agent = new Agent();
            $browser = $agent->browser();
            $version = $agent->version($browser);
            $Log = $req->all();
            $Log['user_id'] = Auth::user()->id;
            $Log['ip'] = $req->ip();
            $Log['subject'] = "SpecialOffers Data Store By " . Auth::user()->first_name;
            $Log['url'] = url('/') . '/Employee/SpecialOffers/store';
            $Log['method'] = "Post";
            $Log['browser'] = $browser . "-" . $version;
            LogActivity::create($Log);    

        return redirect('Employee/SpecialOffers/home')->with('success', "New Special Offers Added Successfully");
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
        $Log['subject'] = "SpecialOffers Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/SpecialOffers/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        $SpecialOffers = SpecialOffers::find($id);
        return view('Employee.sales.SpecialOffers.edit',compact('SpecialOffers'));
    }

     //updated
    public function update(Request $req, $id)
{
    $data = SpecialOffers::find($id);
    
    $StorageSetting = StorageSetting::find(1);
    $storageLocal = $StorageSetting->status == 0;

    $url = url('/').'/public/images/';

    // Handle file uploads for attachment
    if ($req->hasFile('attachment')) {
        $profileFilename = 'attachment_' . Str::random(4) . '.' . $req->file('attachment')->getClientOriginalExtension();

        if ($storageLocal) {
            $req->file('attachment')->move(public_path('images/'), $profileFilename);
            $attachment_url = $url . $profileFilename;
        } else {
            $attachment_url = $this->Upload($StorageSetting, $profileFilename, $req->file('attachment'));
        }

        $data->attachment = $attachment_url;
    }

    $data->name = $req->name;
    $data->url = $req->url;
    $data->save();

    // Log activity
    $agent = new Agent();
    $browser = $agent->browser();
    $version = $agent->version($browser);

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "SpecialOffers Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/SpecialOffers/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('Employee/SpecialOffers/home')->with('success', "Special Offers Edit Successfully");
    }

     public function delete(Request $request,$id)
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "SpecialOffers Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/SpecialOffers/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        SpecialOffers::find($id)->delete();
        return redirect('Employee/SpecialOffers/home')->with('success', "Special Offers Deleted Successfully");
    }


}
