<?php

namespace App\Http\Controllers\admin;

use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;
use App\Models\OperatingSysten;
use App\Exports\AcronisExport;    
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use App\Models\MailSettings;
use Illuminate\Support\Str;
use App\Models\User;
use App\Mail\TwoStepAuthOtp;
use Hash;
use Auth;
use Session;


class TwoStepAuthController extends Controller
{   
    //home page
    public function index(Request $request)
    {
        return view('admin.TwoStepAuth.index');
    }

     //AuthReSendOtp page
    public function AuthReSendOtp(Request $request)
    {
        $ResendOTP = User::where('email',$request->Email)->where('id',$request->id)->first();
        
        if($ResendOTP->twostepotp != null && $ResendOTP->otp_status == 0)
        {       
                $otp = random_int(100000, 999999);
                $ResendOTP->twostepotp = $otp;
                $ResendOTP->save();


                $Name = $ResendOTP->first_name .  $ResendOTP->last_name ;
                $Email = $request->Email;
                $Otp = $ResendOTP->twostepotp;
                \Mail::to($Email)->send(new TwoStepAuthOtp($Name,$Email,$Otp));
                
            return response()->json(['status' => 200, 'success' => true]);            
        }

    }

    //CheckOtp page
    public function CheckOtp(Request $request)
    {

        $credentials = $request->only('Email', 'password');
        $id = $request->id;
        $Email = $request->Email;
        $password = $request->password;

        $OtpCak = User::where('email',$request->Email)->where('id',$request->id)->first();
        if($OtpCak->twostepotp == $request->otp)
        {
            if (Auth::attempt($credentials)) {
                    Session::put('user_id', auth::user()->id);
                    $user_agent = $_SERVER['HTTP_USER_AGENT'];
                        if (strpos($user_agent, 'iPhone') !== false || strpos($user_agent, 'Android') !== false) {
                            // The user is using a mobile device (iPhone or Android)
                            $device = 'Mobile device detected';
                        } elseif (strpos($user_agent, 'Windows') !== false || strpos($user_agent, 'Macintosh') !== false) {
                            // The user is using a desktop or laptop (Windows or Mac)
                                $device = 'Desktop or laptop detected';
                        } else {
                            // Unable to determine the device type
                            $device = 'Desktop or laptop detected';
                        }

                    $agent = new Agent();
                    $browser = $agent->browser();
                    $version = $agent->version($browser);
                    $Log = $request->all();
                    $Log['user_id'] = Auth::user()->id;
                    $Log['ip'] = $request->ip();
                    $Log['devide_type'] = $device;

                    if (auth::user()->id == 1 && auth::user()->type == "1") {
                        $Log['subject'] = "Admin Panel Login By " . Auth::user()->first_name;
                        $Log['url'] = url('/') . '/admin/admin_Login';
                        $Log['method'] = "Post";
                        $Log['devide_type'] = $device;
                        $Log['browser'] = $browser . "-" . $version;
                        LogActivity::create($Log);
                        
                        $OtpCak->otp_status = 1;
                        $OtpCak->save();
                        return redirect('admin/dashboard')->with('success',"Two-factor Authentication setup successfully");
                    }else {
                        $Log['subject'] = "Admin Login User Name or Password are not valid";
                        $Log['url'] = url('/') . '/admin/';
                        $Log['devide_type'] = $device;
                        $Log['method'] = "Post";
                        $Log['browser'] = $browser . "-" . $version;
                        LogActivity::create($Log);

                        return redirect("/admin")->with('error', 'Login details are not valid');
                    }
                }
        }else{
            Session::flash('error', "!OOPs Your OTP doesn't match");
            return view('admin.TwoStepAuth.index',compact('Email','id','password'));  
        }
    }



     public function CheckUserOtp(Request $request)
    {

        $credentials = $request->only('Email', 'password');
        $id = $request->id;
        $Email = $request->Email;
        $password = $request->password;

        $OtpCak = User::where('email',$request->Email)->where('id',$request->id)->first();
        // return $OtpCak;
        if($OtpCak->twostepotp == $request->otp)
        {
          if (Auth::attempt($credentials)) {
            $user = auth()->user();
            $name = auth::user()->first_name;
            Session::put('UserName', $name);
            if ($user->type == "2" && $user->email_verified_at != null) {
              $agent = new Agent();
              $browser = $agent->browser();
              $version = $agent->version($browser);

              $logData = [
                'user_id' => $user->id,
                'ip' => request()->ip(),
                'subject' => "Login By Client: " . $user->first_name,
                'url' => url('/'),
                'method' => "GET",
                'browser' => $browser . "-" . $version
              ];

              LogActivity::create($logData);

              return redirect('user/dashboard');
            } else {
              Auth::logout();
              return redirect('/')->with('error', 'Login details are not valid');
            }
          }else{
            Auth::logout();
            return redirect('/')->with('error', 'Login details are not valid');
          }
        }else{
            Session::flash('error', "!OOPs Your OTP doesn't match");
            return view('admin.TwoStepAuth.index',compact('Email','id','password'));  
        }
    }
}
