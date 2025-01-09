<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Collection;
use App\Models\StorageSetting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use App\Models\MailSettings;
use App\Models\InvoiceSettings;
use App\Models\OneTimeSetup;
use App\Models\LogActivity;
use App\Models\Security;
use App\Models\ClientDetails;
use App\Models\Country;
use App\Models\EmployeeDetail;
use App\Models\PasswordDays;
use App\Models\User;
use Hash;
use Auth;



class ProfileSettingsController extends Controller
{   
   //home page
    public function home(Request $request)
    {
        $chk_exst = InvoiceSettings::first();
        $country = Country::get();
        $user_details = User::find(Auth::user()->id);
        $Complete = MailSettings::select('smtp','chimps','microsoft')->where('user_id',Auth::user()->id)->where('id',2)->first();
        return view('admin.settings.ProfileSettings.home', compact('Complete','user_details','chk_exst','country'));
    }

    public function changePassword(Request $request)
    {
        
        // Validate request data
        $request->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required|min:8|different:oldPassword',
            'confirmPassword' => 'required|same:newPassword', 
        ]);
    
        // Get the authenticated user
        $user = Auth::user();
        
        if (!Hash::check($request->oldPassword, $user->password)) {
            return redirect()->back()->with('error', 'Old password is incorrect. Please try again.');
        }
        // Update the user's password
        $user->password = Hash::make($request->newPassword);
        $user->password_updateDate = now();
        

        if ($user->save()) {
            return redirect()->back()->with('success', 'Password updated successfully.');
        } else {
            return redirect()->back()->with('error', 'An error occurred while updating the password. Please try again.');
        }
    }


    public function store(Request $request)
    {
        $users = User::find(Auth::user()->id);

        $StorageSetting = StorageSetting::find(1);
        $storageLocal = $StorageSetting->status == 0;

        // Base URL for local storage
        $localBaseUrl = url('/public/images/');

        // Handle file uploads for profile_picture
        if ($request->hasFile('profile_picture')) {
            $profileFilename = 'profile_' . Str::random(4) . '.' . $request->file('profile_picture')->getClientOriginalExtension();

            if ($storageLocal) {
                // Store in local public folder
                $request->file('profile_picture')->move('public/images/', $profileFilename);
                $users->profile_img = $localBaseUrl .'/'. $profileFilename;
            } else {
                // Store in S3
                $filePath = $this->Upload($StorageSetting, $profileFilename, $request->file('profile_picture'));
                $users->profile_img = $filePath;
            }
        }

        // Handle file uploads for banner
        if ($request->hasFile('banner')) {
            $bannerFilename = 'banner_' . Str::random(4) . '.' . $request->file('banner')->getClientOriginalExtension();

            if ($storageLocal) {
                // Store in local public folder
                $request->file('banner')->move('public/images/', $bannerFilename);
                $users->banner = $localBaseUrl .'/'. $bannerFilename;
            } else {
                // Store in S3
                $filePath = $this->Upload($StorageSetting, $bannerFilename, $request->file('banner'));
                $users->banner = $filePath;
            }
        }

        if ($request->password) {
            $users->password = Hash::make($request->input('password'));
        }

        $users->first_name = $request->input('first_name');
        $users->last_name = $request->input('last_name');
        $users->email = $request->input('email');
        $users->email_notifications = $request->input('email_notifications', 0);
        $users->rtl = $request->input('rtl', 0);
        $users->google_calendar_status = $request->input('google_calendar_status', 0);
        $users->country_id = $request->input('country');
        $users->phone_number = $request->input('phone_number');
        $users->gender = $request->input('gender');
        $users->merital_status = $request->input('merital_status');
        $users->address = $request->input('address');
        $users->about = $request->input('about');

        $users->save();

        return redirect()->back()->with('success', "New Profile Setting Updated Successfully");
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

   


}
