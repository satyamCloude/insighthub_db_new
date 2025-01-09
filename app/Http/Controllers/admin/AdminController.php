<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use App\Models\Security;
use App\Models\User;
use App\Models\MailSettings;
use App\Mail\TwoStepAuthOtp;
use auth;
use Session;
use Hash;


class AdminController extends Controller
{
    /////Login
public function Login(Request $request)
{
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ], [
        'email.required' => 'The email address is required',
        'password.required' => 'The Password field is required.',
    ]);

    $credentials = $request->only('email', 'password');
    $deviceID = sha1($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);
    $User = User::where('email', $credentials['email'])->where('type',1)->first();
    if ($User) {
        if ($User->google2fa_enabled == 1) {
            $request->session()->put('2fa:user:id', $User->id);
            return redirect('admin-two-factor-authentication');
        } elseif ($User->email_enable) {
            $otp = random_int(100000, 999999);
            $User->mail_otp = $otp;
            $User->save();

            \Mail::to($User->email)->send(new TwoStepAuthOtp($User->first_name, $User->email, $otp));

            $request->session()->put('mailOtp:user:id', $User->id);
            return redirect('admin-mailotp-authentication');
        } else {
            if (Hash::check($credentials['password'], $User->password)) {
                if ($User->auth_settings == 1) {
                    if ($User->twostepotp == null && $User->otp_status == 0) {
                        $otp = random_int(100000, 999999);
                        $User->twostepotp = $otp;
                        $User->save();

            \Mail::to($User->email)->send(new TwoStepAuthOtp($User->first_name, $User->email, $otp));

                        return view('admin.TwoStepAuth.index', [
                            'Email' => $User->email,
                            'id' => $User->id,
                            'password' => $request->password,
                        ]);
                    } elseif ($User->twostepotp != null && $User->otp_status == 1) {
                        if (Auth::attempt($credentials)) {
                            $this->logUserLogin($User, $request);
                            return $this->handleUserRedirect($User);
                        }
                    } elseif ($User->twostepotp != null && $User->otp_status == 0) {
                        return view('admin.TwoStepAuth.index', [
                            'Email' => $User->email,
                            'id' => $User->id,
                            'password' => $request->password,
                        ]);
                    } else {
                        return redirect("/admin")->with('error', 'Login details are not valid');
                    }
                } else {
                    return redirect("/admin")->with('error', 'Authentication settings are not enabled');
                }
            } else {
                return redirect("/admin")->with('error', 'Login details are not valid');
            }
        }
    } else {
        return redirect("/admin")->with('error', 'User does not exist');
    }
}



private function logUserLogin($User, $request)
{
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $device = 'Desktop or laptop detected';
    if (strpos($user_agent, 'iPhone') !== false || strpos($user_agent, 'Android') !== false) {
        $device = 'Mobile device detected';
    }

    $agent = new Agent();
    $browser = $agent->browser();
    $version = $agent->version($browser);

    $logData = [
        'user_id' => $User->id,
        'ip' => $request->ip(),
        'type' => 'login',
        'login_time' => now(),
        'device_type' => $device,
        'browser' => $browser . "-" . $version,
    ];

    LogActivity::create($logData);
}
public function logNotification(Request $request)
{
    DB::table('event_notifications')->insert([
        'type' => $request->type,
        'user_id' => $request->user_id,
        'status' => 1,
        'notification_date' => now()->format('Y-m-d'),
    ]);

    return response()->json(['success' => true]);
}

private function handleUserRedirect($User)
{
    if ($User->id == 1 && $User->type == "1") {
        return redirect('admin/dashboard');
    } else {
        return redirect("/admin")->with('error', 'Login details are not valid');
    }
}

    public function Logins(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'The email address is required',
            'password.required' => 'The Password Filed is required.',
        ]);

       $credentials = $request->only('email', 'password');

        $deviceID = sha1($_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']);



        $User = User::where('email', $credentials['email'])->first();
        if ($User && Hash::check($credentials['password'], $User->password)) {
            if($User->auth_settings == 1)
            {
                if($User->twostepotp == null && $User->otp_status == 0)
                {
                    $otp = random_int(100000, 999999);
                    $User->twostepotp = $devideID;
                    $User->twostepotp = $otp;
                    $User->save();

                    $Name = $User->first_name . $User->last_name ;
                    $Email = $request->email;
                    $Otp = $User->twostepotp;
                    $id = $User->id;
                    $password = $request->password;

                    \Mail::to($Email)->send(new TwoStepAuthOtp($Name,$Email,$Otp));
                    
                    return view('admin.TwoStepAuth.index',compact('Email','id','password'));             
                }else if($User->twostepotp != null && $User->otp_status == 1){
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
                            // $Log['subject'] = "Admin Panel Login By " . Auth::user()->first_name;
                            // $Log['url'] = url('/') . '/admin/admin_Login';
                            // $Log['method'] = "Post";
                            // $Log['devide_type'] = $device;
                            // $Log['browser'] = $browser . "-" . $version;
                            // LogActivity::create($Log);
                            
                            
                            $logData = [
                                'user_id' => $User->id,
                                'ip' => request()->ip(),
                                'type' => 'login',
                                'login_time' => now(),
                            ];
    
                            LogActivity::create($logData);

                            return redirect('admin/dashboard');
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
                }else if($User->twostepotp != null && $User->otp_status == 0)
                    {
                    $Email = $request->email;
                    $id = $User->id;
                    $password = $request->password;

                    return view('admin.TwoStepAuth.index',compact('Email','id','password'));   
                }else{
                        return redirect("/admin")->with('error', 'Login details are not valid');
                }
            }else{
                return "hello";
            }
        } else {
         return redirect("/admin")->with('error', 'Login details are not valid');
        }
    }


    public function Logout(Request $request)
    {
                // $agent = new Agent();
                // $browser = $agent->browser();
                // $version = $agent->version($browser);
                // $Log = $request->all();
                // $Log['user_id'] = Auth::user()->id;
                // $Log['ip'] = $request->ip();
                // $Log['subject'] = "Admin Panel Logout By " . Auth::user()->first_name;
                // $Log['url'] = url('/') . '/admin/Logout';
                // $Log['method'] = "Get";
                // $Log['browser'] = $browser . "-" . $version;
                // LogActivity::create($Log); 
                
                
                // Update the logout_time of the last login entry
        $lastLogin = LogActivity::where('user_id', Auth::user()->id)
                        ->where('type', 'login')
                        ->orderBy('created_at', 'desc')
                        ->first();
        
        if ($lastLogin) {
            $lastLogin->update(['logout_time' => now()]);
        }

        Session::flush();  
        Auth::logout();
        return redirect('/admin');
    }


}
