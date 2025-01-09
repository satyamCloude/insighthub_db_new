<?php

namespace App\Http\Controllers\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use App\Models\Security;
use App\Models\Attendence;
use Carbon\Carbon;

use App\Models\User;
use auth;
use Session;
use Hash;


class EAdminController extends Controller
{
    /////Login
    public function Login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ], [
            'email.required' => 'The email address is required',
            'password.required' => 'The Password Filed is required.',
        ]);

        $credentials = [
            'login_email' => $request->email,
            'password' => $request->password,
        ];

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

            if (auth::user()->type == 4) {
                // $Log['subject'] = "Employee Panel Login By " . Auth::user()->first_name;
                // $Log['url'] = url('/') . '/Employee/Employee_Login';
                // $Log['devide_type'] = $device;
                // $Log['method'] = "Post";
                // $Log['browser'] = $browser . "-" . $version;
                // LogActivity::create($Log);
                
                $logData = [
                    'user_id' => auth::user()->id,
                    'ip' => request()->ip(),
                    'type' => 'login',
                    'login_time' => now(),
                ];
                                    // Calculate dates
                        $currentDate = now()->format('Y-m-d');
                        $yesterdayDate = now()->subDay()->format('Y-m-d'); // Get yesterday's date
                        $yesterdayAt730PM = Carbon::now()->subDay()->setTime(19, 30)->format('Y-m-d H:i:s'); // Get 7:30 PM of yesterday
                        
                        $attendance = Attendence::where('emp_Id', auth()->user()->id)
                                                 ->where('punch_date', $yesterdayDate)
                                                 ->whereNull('punch_out')
                                                 ->whereNotNull('punch_in')
                                                 ->first();
                        
                        if ($attendance) {
                            $attendance->emp_Id = Auth::user()->id;
                            $attendance->punch_date = $yesterdayDate;
                            $attendance->punch_out = $yesterdayAt730PM; // Use the calculated time
                            $attendance->save();
                        }

                $user = User::find(Auth::user()->id);
                if($user && $user->clock_status == 1){
                    $user->clock_status = 0;
                    $user->save();
                }
                            LogActivity::create($logData);

                return redirect('Employee/dashboard');
            } else {
                $Log['subject'] = "Employee Login User Name or Password are not valid";
                $Log['url'] = url('/') . '/Employee/';
                $Log['devide_type'] = $device;
                $Log['method'] = "Post";
                $Log['browser'] = $browser . "-" . $version;
                LogActivity::create($Log);

                return redirect("/Employee")->with('error', 'Login details are not valid');
            }
        }
        return redirect("/Employee")->with('error', 'Login details are not valid');
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

    public function Logout(Request $request)
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        // $Log = $request->all();
        // $Log['user_id'] = Auth::user()->id;
        // $Log['ip'] = $request->ip();
        // $Log['subject'] = "Employee Panel Logout By " . Auth::user()->first_name;
        // $Log['url'] = url('/') . '/Employee/Logout';
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

        $attendance = Attendence::where('emp_Id',auth::user()->id)->where('punch_date',date('Y-m-d'))->where('punch_out',null)->where('punch_in','!=',null)->first();
      if($attendance)

        {
            $currentDate = date('Y-m-d');
            $currentTime = date('H:i:s');

            $attendance->emp_Id = Auth::user()->id;
            $attendance->punch_date = $currentDate;
            $attendance->punch_out = $currentTime;
            $attendance->save();
        }
     
    $user = User::find(Auth::user()->id);
    if($user && $user->clock_status == 1){
        $user->clock_status = 0;
        $user->save();
    }
        Session::flush();  
        Auth::logout();
        return redirect('/employee');
    }


}
