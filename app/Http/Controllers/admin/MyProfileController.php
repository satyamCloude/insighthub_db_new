<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use App\Models\PaymentMethod;  
use App\Models\CompanyLogin;
use App\Models\ClientDetail;
use Jenssegers\Agent\Agent;
use App\Models\StorageSetting;
use Illuminate\Support\Facades\Storage;
use App\Models\LogActivity;
use App\Models\Ticket;
use App\Models\Project;
use Illuminate\Support\Str;
use App\Models\Currency;
use App\Models\Task;
use App\Models\Country;
use App\Models\Quotes;
use App\Models\Status;
use App\Models\State;
use App\Models\Role;
use App\Models\User;
use App\Models\City;
use Hash;
use Auth;

class MyProfileController extends Controller
{
    public function index(Request $req)
    {
      $id = Auth::user()->id;
      $user = User::find($id);

      return view('admin.MyProfile.index',compact('user'));
    }

    //edit
    public function edit(Request $req)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $ClientDetail = ClientDetail::where('user_id',$id)->first();
        $Role = Role::get();
        $Country = Country::get();
        $State = State::find($ClientDetail->state);
        $City = City::find($ClientDetail->city);
        $Currency = Currency::get();
        $Company = CompanyLogin::select('id','company_name')->get();
        $Status = Status::get();
        $PaymentMethod = PaymentMethod::get();


         $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Client Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Client/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('admin.MyProfile.edit',compact('Country','user','State','City','Currency','Company','Status','PaymentMethod','ClientDetail','Role'));
    }
    //updated
    public function update(Request $req)
{
    $id = Auth::user()->id;
    $User = User::find($id);

    $StorageSetting = StorageSetting::find(1);
    $storageLocal = $StorageSetting->status == 0;

    // Base URL for local storage
    $localBaseUrl = url('/public/images/');

    // Handle file uploads for profile_img
    if ($req->hasFile('profile_img')) {
        $profileFilename = 'profile_' . Str::random(4) . '.' . $req->file('profile_img')->getClientOriginalExtension();

        if ($storageLocal) {
            // Store in local public folder
            $req->file('profile_img')->move('public/images/', $profileFilename);
            $User->profile_img = $localBaseUrl . '/' . $profileFilename;
        } else {
            // Store in S3
            $filePath = $this->Upload($StorageSetting, $profileFilename, $req->file('profile_img'));
            $User->profile_img = $filePath;
        }
    }

    // Handle file uploads for banner
    if ($req->hasFile('banner')) {
        $bannerFilename = 'banner_' . Str::random(4) . '.' . $req->file('banner')->getClientOriginalExtension();

        if ($storageLocal) {
            // Store in local public folder
            $req->file('banner')->move('public/images/', $bannerFilename);
            $User->banner = $localBaseUrl . '/' . $bannerFilename;
        } else {
            // Store in S3
            $filePath = $this->Upload($StorageSetting, $bannerFilename, $req->file('banner'));
            $User->banner = $filePath;
        }
    }
     $User['gender'] = $req->gender;
        $User['first_name'] = $req->first_name;
        $User['last_name'] = $req->last_name;
        $User['email'] = $req->email;
        $User['phone_number'] = $req->phone_number;
        $User['password'] = Hash::make($req->password);
        $User['type'] = '2';
        $User['status'] = $req->status;
        $User->save();

        $Clidet =ClientDetail::where('user_id',$id)->first();
        $Clidet['company_id'] = $req->company_id;
        $Clidet['address_1'] = $req->address_1;
        $Clidet['address_2'] = $req->address_2;
        $Clidet['country'] = $req->country;
        $Clidet['state'] = $req->state;
        $Clidet['city'] = $req->city;
        $Clidet['pincode'] = $req->pincode;
        $Clidet->save();    
    $agent = new Agent();
    $browser = $agent->browser();
    $version = $agent->version($browser);
    $Log = $req->all();
    $Log['user_id'] = Auth::user()->id;
    $Log['ip'] = $req->ip();
    $Log['subject'] = "Client Data Updated By " . Auth::user()->first_name;
    $Log['url'] = url('/') . '/MyProfile/update/' . $id;
    $Log['method'] = "Post";
    $Log['browser'] = $browser . "-" . $version;
    LogActivity::create($Log);

    return redirect('user/MyProfile')->with('success', "Client Edit Successfully");
}

// Upload function for S3
public function Upload($StorageSetting, $fileName, $file)
{
    config([
        'filesystems.disks.s3.key' => $StorageSetting->AWS_ACCESS_KEY_ID,
        'filesystems.disks.s3.secret' => $StorageSetting->AWS_SECRET_ACCESS_KEY,
        'filesystems.disks.s3.region' => $StorageSetting->AWS_DEFAULT_REGION,
        'filesystems.disks.s3.bucket' => $StorageSetting->AWS_BUCKET,
    ]);

    $basePath = 'images/' . date('y') . '/' . date('m') . '/' . $fileName;
    $path = Storage::disk('s3')->put($basePath, $file);
    $url = $StorageSetting->S3_BASE_URL . '/' . $path;

    return $url;
}

    public function updatesOld(Request $req)
    {
        $id = Auth::user()->id;
        $User =User::find($id);
        $url = url('/').'/public/images/';
        
             // Handle file uploads for profile_img
            if ($req->hasFile('profile_img')) {
                $profileFilename = 'profile_' . Str::random(4) . '.' . $req->file('profile_img')->getClientOriginalExtension();
                $req->file('profile_img')->move('public/images/', $profileFilename);
                $User->profile_img = url('/public/images/') . '/' . $profileFilename;
            }
            
            if ($req->hasFile('banner')) {
                $banner = 'banner_' . Str::random(4) . '.' . $req->file('banner')->getClientOriginalExtension();
                $req->file('banner')->move('public/images/', $banner);
                $User->banner = url('/public/images/') . '/' . $banner;
            }
            
        $User['gender'] = $req->gender;
        $User['first_name'] = $req->first_name;
        $User['last_name'] = $req->last_name;
        $User['email'] = $req->email;
        $User['phone_number'] = $req->phone_number;
        $User['password'] = Hash::make($req->password);
        $User['type'] = '2';
        $User['status'] = $req->status;
        $User->save();

        $Clidet =ClientDetail::where('user_id',$id)->first();
        $Clidet['company_id'] = $req->company_id;
        $Clidet['address_1'] = $req->address_1;
        $Clidet['address_2'] = $req->address_2;
        $Clidet['country'] = $req->country;
        $Clidet['state'] = $req->state;
        $Clidet['city'] = $req->city;
        $Clidet['pincode'] = $req->pincode;
        $Clidet->save();    

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Client Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/MyProfile/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('user/MyProfile')->with('success', "Client Edit Successfully");
    }

    //get state data thorugh ajex
    public function Get_StateData(Request $req)
    {
        $State = State::where('country_id',$req->countryid)->get();
        return response()->json(['status'=>200,'success'=>true,'states'=>$State]); 
    }
    //get city data thorugh ajex
    public function Get_CityData(Request $req)
    {
        $City = City::where('state_id',$req->stateid)->get();
        return response()->json(['status'=>200,'success'=>true,'citys'=>$City]); 
    }

    public function changePassword(Request $request)
    {
        $id = Auth::user()->id;
        $user =User::find($id);
      

            // Validate the form data
            $request->validate([
                'newPassword' => 'required',
                'confirmPassword' => 'required|same:newPassword',
            ]);

            // Update the user's password
            $user->update([
                'password' => Hash::make($request->input('newPassword')),
            ]);


            $agent = new Agent();
            $browser = $agent->browser();
            $version = $agent->version($browser);
            $Log = $request->all();

            $Log['user_id'] = $id; // Use the obtained $id value here
            $Log['ip'] = $request->ip();
            $Log['subject'] = "Task Edit Page is Viewed By " . $user->first_name;
            $Log['url'] = url('/') . '/admin/Task/edit/' . $id;
            $Log['method'] = "Get";
            $Log['browser'] = $browser . "-" . $version;
            LogActivity::create($Log);

             return response()->json(['status' => true, 'message' => 'Password updated successfully.'], 200);


    }
}
