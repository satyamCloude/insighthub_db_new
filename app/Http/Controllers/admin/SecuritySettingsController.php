<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use App\Models\MailSettings;
use App\Models\OneTimeSetup;
use App\Models\LogActivity;
use App\Models\Security;
use PragmaRX\Google2FA\Google2FA;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use Hash;
use Auth;


class SecuritySettingsController extends Controller
{   
    //home page
  public function home(Request $request)
    {
            $Bulk = MailSettings::select('smtp','chimps','microsoft','GSuite','SES')->where('user_id',Auth::user()->id)->where('id',1)->first();
            $Complete = MailSettings::select('smtp','chimps','microsoft','GSuite','SES')->where('user_id',Auth::user()->id)->where('id',2)->first();

        return view('admin.settings.SecuritySettings.home', compact('Complete','Bulk'));
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
        $Log['subject'] = "Security Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Security/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('admin.settings.SecuritySettings.create'); 
    }


public function confirm_password(Request $request)
{
    // Retrieve password and user_id from the request
    $confirm_password = $request->input('password');
    $user_id = $request->input('user_id');

    // Find the user by user_id
    $user = User::find($user_id);

    // Check if the user exists
    if (!$user) {
        return response()->json([
            'status' => 'fail',
            'message' => 'User not found',
        ]);
    }

    // Check if the provided password matches the hashed password in the database
    if (Hash::check($confirm_password, $user->password)) {

        // Check if OneTimeSetup record exists for the user
        $oneTimeSetup = OneTimeSetup::where('user_id', $user_id)->first();

        if ($oneTimeSetup) {
            // Update existing record
            $oneTimeSetup->is_authentication_enabled = 1;
            $oneTimeSetup->save();
        } else {
            // Create a new record
            $oneTimeSetup = new OneTimeSetup;
            $oneTimeSetup->user_id = $user_id;
            $oneTimeSetup->is_authentication_enabled = 1;
            $oneTimeSetup->save();
        }

        // Password is correct
        return response()->json([
            'status' => 'success',
            'message' => 'Password is correct',
            'id' => $user->id,
        ]);
    } else {
        // Password is incorrect
        return response()->json([
            'status' => 'fail',
            'message' => 'Password is incorrect',
        ]);
    }
}

    public function enableSetting(Request $request)
    {
        $user = User::find($request->id);
        try {
            $user->google2fa_enabled = 1;
            $user->save();
            return redirect()->back()->with('success','Two factor authentication enabled successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error',$th->getMessage());
        }
    }
 public function disable(Request $request)
    {
        $user = User::find($request->id);
        try {
            $user->google2fa_enabled = 0;
            $user->save();
            return redirect()->back()->with('success','Two factor authentication disable successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error',$th->getMessage());
        }
    }

    public function twoFA()
    {
        return view('admin.TwoStepAuth.index');
    }

    public function mailOtp()
    {
        return view('admin.TwoStepAuth.mailOtp');
    }
    
    // Verify the entered OTP
    public function mailOtp_verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric',
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::find($request->user_id);

        if ($user && $user->mail_otp == $request->otp) {
            // OTP is valid, clear the mail_otp field and log in the user
            $user->mail_otp = null;
            $user->save();

            Auth::loginUsingId($user->id);

            return redirect('admin/dashboard');
        } else {
            // OTP is invalid, redirect back with an error message
            return redirect()->back()->with('error', 'Invalid OTP');
        }
    }
    public function enable(Request $request)
    {
        // return $request->all();
        $user = User::find(Auth::user()->id);
        $google2fa = new Google2FA();
        $two_factor_secret = $request->two_factor_secret;
        try {
            if ($google2fa->verifyKey($two_factor_secret, $request->two_factor_recovery_codes)) {
                $user->two_factor_secret = $request->two_factor_secret;
                $user->google2fa_enabled = 1;
                $user->save();
                return redirect()->back()->with('success','Two factor authentication enabled successfully.');
            }else{
                return redirect()->back()->with('error','Provided code is invalid.');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Provided code is invalid.');
        }
    }


    public function verify_password(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        if (Hash::check($request->password, $user->password)) {
            if($user->google2fa_enabled){
                $user->google2fa_enabled = 0;
                $user->save();
                return response()->json([
                    'status' => 'disabled',
                    'success' => 'Two factor authentication disabled successfully.',
                ], 200);
            }else{

                $google2fa = new Google2FA();
                $secretKey = $google2fa->generateSecretKey();
                $qrCodeUrl = $google2fa->getQRCodeUrl('Cloud Techtiq', Auth::user()->email, $secretKey);
                // Generate the QR code image
                $qrCodeImage = QrCode::size(200)->generate($qrCodeUrl);
                return view('admin.settings.SecuritySettings.qrCode', compact('qrCodeImage', 'secretKey'));
            }
            // return $qrCodeImage;
        } else {
            return response()->json([
                'error' => 'Password incorrect',
            ], 422); // 422 is the HTTP status code for Unprocessable Entity
        }
    }

    public function verify(Request $request)
    {

        $request->validate([
            'two_factor_recovery_codes' => 'required',
        ]);

        $user_id = $request->session()->get('2fa:user:id');

        if (!$user_id) {
            return redirect()->route('/');
        }

        $user = User::find($user_id);

        $google2fa = new Google2FA();
        $two_factor_secret = $user->two_factor_secret;
        try {

            if ($google2fa->verifyKey($two_factor_secret, $request->two_factor_recovery_codes)) {
                Auth::login($user);
                return redirect("admin/dashboard");
            }else{
                return redirect()->back()->with('error','Provided code is invalid.');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Provided code is invalid.');
        }
    }


    //home page
    public function store(Request $req)
    {

        $data = $req->all();
        Security::create($data);
        
            $agent = new Agent();
            $browser = $agent->browser();
            $version = $agent->version($browser);
            $Log = $req->all();
            $Log['user_id'] = Auth::user()->id;
            $Log['ip'] = $req->ip();
            $Log['subject'] = "Security Data Store By " . Auth::user()->first_name;
            $Log['url'] = url('/') . '/admin/Security/store';
            $Log['method'] = "Post";
            $Log['browser'] = $browser . "-" . $version;
            LogActivity::create($Log);
    

        return redirect()->back()->with('success', "New Security Added Successfully");
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
        $Log['subject'] = "Security Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Security/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        $Security = Security::find($id);
        return view('admin.settings.SecuritySettings.edit',compact('Security'));
    }

    //updated
    public function update(Request $req,$id)
    {
     
        $data =Security::find($id);
        $data['User_ip_address'] = $req->User_ip_address;
        $data['status'] = $req->status;
        $data->save();    

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Security Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Security/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect()->back()->with('success', "Security Edit Successfully");
    }

     public function delete(Request $request,$id)
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Security Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Security/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        Security::find($id)->delete();
        return redirect()->back()->with('success', "Security Deleted Successfully");
    }  
      public function mail_setup(Request $request)
    {
       // return redirect()->back()->with('success', "Security Deleted Successfully");
    }


}
