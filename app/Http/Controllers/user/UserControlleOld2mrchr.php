<?php

namespace App\Http\Controllers\user;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use auth;
use Session;
use Hash;
use Validator;
use Razorpay\Api\Api;
use App\Models\MailSettings;

use App\Models\User;
use App\Models\ClientDetail;
use Jenssegers\Agent\Agent;
use App\Models\CompanyLogin;
use App\Models\LogActivity;
use App\Models\Template;
use App\Models\Attendence;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail; // Import your mail class
use App\Mail\ClientAuthEmail; // Import your mail class
use Illuminate\Support\Str;

class UserController extends Controller
{
           public function login(Request $request)
        {
            $request->validate([
                'identifier' => 'required',
                'password' => 'required',
            ], [
                'identifier.required' => 'The username or email is required',
                'password.required' => 'The password field is required',
            ]);

            $credentials = [
                'password' => $request->input('password'),
            ];

            $identifier = $request->input('identifier');
            if (filter_var($identifier, FILTER_VALIDATE_EMAIL)) {
                $credentials['email'] = $identifier;
            } else {
                $credentials['phone_number'] = $identifier;
            }
          if (Auth::attempt($credentials)) {
                    $user = auth()->user();

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
                }
            return redirect('/')->with('error', 'Login details are not valid');
        }



public function register(Request $request)
{
           $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => ['required', 'confirmed', 'min:6', 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/'],
        ], [
            'email.unique' => 'Email has already been taken.',
            'password.required' => 'Password is required.',
            'password.min' => 'Password must be at least :min characters long.',
            'password.regex' => 'Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character.',
            'password.confirmed' => 'Password confirmation does not match.',
        ]);

        if ($validator->fails()) {
            return redirect('/UserRegister')
                ->withErrors($validator)
                ->withInput();
        }

    $user = new User;
    $user->first_name = $request->first_name;
    $user->last_name = $request->last_name;
    $user->email = $request->email;
    $user->company_name = $request->company_name;
    $user->phone_number = $request->phone_number;
    $user->password = Hash::make($request->password);
    $user->type = 2;
    $user->status = 5;
    if ($user->save()) {

        // Generate and store verification token
        $verificationToken = Str::random(32);
        $user->verification_token = $verificationToken;
        $user->save();


            $CompanyLogin = new CompanyLogin;
            $CompanyLogin->user_id = $user->id;
            $CompanyLogin->company_name = $request->company_name;
            $CompanyLogin->save();

            $ClientDetail = new ClientDetail;
            $ClientDetail->user_id = $user->id;
            $ClientDetail->company_id = $CompanyLogin->id;
            $ClientDetail->save();






        $verificationLink = route('verify.email', ['user' => $user->id, 'email' => $request->email, 'token' => $verificationToken]);
        $msgs = "To finish creating your cloudtechtiq account, confirm your email address by clicking this link: $verificationLink\nHappy coding,\nTeam cloudtechtiq";
        $msg = wordwrap($msgs, 70);
        $message = wordwrap($msgs, 70);
        mail($request->email, "Confirm your cloudtechtiq account", $msg);
                 $TemplateSettings = Template::where('name', 'Email Verification')->first();
                $MailSettings = MailSettings::where('type','Bulk')->where('id',1)->first();
                if ($MailSettings->smtp == '1') 
                {
                        config([
                            'mail.driver'     => $MailSettings->smtp_mailer,
                            'mail.host'       => $MailSettings->smtp_host,
                            'mail.port'       => $MailSettings->smtp_port,
                            'mail.username'   => $MailSettings->smtp_user_name,
                            'mail.password'   => $MailSettings->smtp_password,
                            'mail.encryption' => $MailSettings->smtp_encryption,
                        ]);


                         $subject = $TemplateSettings->subject;
                        $header = $TemplateSettings->header;
                        $template = $TemplateSettings->template;
                        $footer = $TemplateSettings->footer;

                  $replacementsTemplate = array(
            '{$client_name}' => $request->first_name,
            '[Your Company Name]' => $request->company_name,
            '[Verification Link]' => $msgs,
             );
            $messageReplacementsTemplate = $template;
            $template = str_replace(array_keys($replacementsTemplate), array_values($replacementsTemplate), $messageReplacementsTemplate);

         $replacementsFooter = array(
            '[Company Name]' =>'Cloud Techtiq',
             );
            $messagefooter = $footer;
            $footer = str_replace(array_keys($replacementsFooter), array_values($replacementsFooter), $messagefooter);

                \Mail::to($request->email)->send(new ClientAuthEmail($subject,$header,$template,$footer));
                }       
                 return redirect()->route('google.varify_email', ['user' => $user->id])->with('success', 'Your registration was successful. Mail is sent to your registered email address.');
    } else {
        // Redirect with error message
        return redirect('/')->with('error', 'Your registration was failed. Please try again later.');
    }
}



public function account_verification($user,$email,$token)
{
    $user2 = User::where('email', $email)->where('verification_token', $token)->first();
    if ($user2) {
            // $user->email_verified_at = now();
            // $user->verification_token = null;
            // $user->save();
            return redirect()->route('verify.validate_card', ['user' => $user2->id,'email' => $email,'token' => $token, 'message' => 'Email verified successfully.']);
        // } else {
        //     return redirect('/')->with('message', 'Email already verified.');
        // }
    } else {
        return redirect('/')->with('error', 'Invalid verification token.');
    }
}

public function validate_card(Request $request)
{
    $user = $request->user;
    $email = $request->email;
    $token = $request->token;

    return view('validate_card', ['user' => $user,'token' => $token,'email' => $email]);
}

public function validate_card_callback(Request $request,$validated_user_id,$validated_email,$validated_token,$price)
{
    $validated_user_id = $validated_user_id;
    $validated_email = $validated_email;
    $validated_token = $validated_token;
    $razorpay_payment_id = $request->razorpay_payment_id;

   $user2 = User::where('id', $validated_user_id)->where('email', $validated_email)->where('verification_token', $validated_token)->first();
    if ($user2) {
            $user2->email_verified_at = now();
            $user->razorpay_payment_id = $razorpay_payment_id;
            $user2->save();
             $agent = new Agent();
                        $browser = $agent->browser();
                        $version = $agent->version($browser);
                        $Log = $request->all();
                        $Log['user_id'] = Auth::user()->id;
                        $Log['ip'] = $request->ip();
                        $Log['subject'] = "Login By Client : " . Auth::user()->first_name;
                        $Log['url'] = url('/');
                        $Log['method'] = "Get";
                        $Log['browser'] = $browser . "-" . $version;
                        LogActivity::create($Log);
                        return redirect('user/dashboard');
        } else {
            return redirect('/')->with('message', 'Email already verified.');
        }
   
}
  public function handleCallback(Request $request,$validated_user_id,$validated_email,$validated_token,$price)
  {
    $input = $request->razorpay_payment_id;
    $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
    $razorpayPaymentId = $input;

        if (isset($razorpayPaymentId) && !empty($razorpayPaymentId)) {
        try {
            $razorpayPaymentId =$razorpayPaymentId;
        } catch (Exception $e) {
            return $e->getMessage();
        }
                $user = User::where('email', $validated_email)->first();
              if ($user) {
                    $user->razorpay_payment_id = $razorpayPaymentId;
                    $user->email_verified_at = now();
                    $user->payment_status = 1;
                    $user->status = 4;
                    $user->save();
            return redirect('/')->with('message', 'You can login now.');
                } else {
                    // User not found
                    return redirect('/')->with('error', 'User not found.');
                }
            }else {
                    return redirect('/')->with('error', 'Something went wrong.');
            }
                
            // return redirect('/')->with('message', 'Your registration was successful. You can now log in.');
} 

        // public function Register(Request $request)
        // {
        //     $UserExist = User::where('email',$request->email)->count();

        //     if($UserExist > 0)
        //     {
        //         return redirect('/UserRegister')->with('error', 'E-mail already exists.');
        //     }else{
        //         $data = new User;
        //         $data['password'] = Hash::make($request->password);
        //         $data['first_name'] = $request->name;
        //         $data['email'] = $request->email;
        //         $data['type'] = 2;
        //         $data['status'] = 1;
        //         if($data->save()){
        //             //send mail to user email id

        //         }else{

        //         }

                
        //         return redirect('/')->with('message', 'Your registration was successful. You can now log in.');
        //     }



        // }

    public function Logout()
    {
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
        Session::flush();  
        Auth::logout();
        return redirect('/');
    }
}
