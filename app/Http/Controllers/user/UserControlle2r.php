<?php

namespace App\Http\Controllers\user;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use auth;
use Session;
use Hash;
use Razorpay\Api\Api;

use App\Models\User;
use App\Models\ClientDetail;
use Jenssegers\Agent\Agent;
use App\Models\CompanyLogin;
use App\Models\LogActivity;
use App\Models\Attendence;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail; // Import your mail class
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
                if (auth()->user()->type == "2") {
                    
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
                    Auth::logout();
                    return redirect('/')->with('error', 'Login details are not valid');
                }
            }

            return redirect('/')->with('error', 'Login details are not valid');
        }



public function register(Request $request)
{
    $userExists = User::where('email', $request->email)->count();

    if ($userExists > 0) {
        return redirect('/UserRegister')->with('error', 'E-mail already exists.');
    } else {
        $verificationToken = Str::random(32); // Adjust the length of the token as needed
        $data = new User;
        $data->password = Hash::make($request->password);
        $data->first_name = $request->name;
        $data->email = $request->email;
        $data->type = 2;
        $data->status = 1;

        if ($data->save()) {
            $data->verification_token = $verificationToken;
            $data->save();

            $CompanyLogin = new CompanyLogin;
            $CompanyLogin->user_id = $data->id;
            $CompanyLogin->company_name = $request->company_name;
            $CompanyLogin->save();

            $ClientDetail = new ClientDetail;
            $ClientDetail->user_id = $data->id;
            $ClientDetail->company_id = $CompanyLogin->id;
            $ClientDetail->save();

            $verificationLink = route('verify.email', ['user' => $data->id,'email' => $data->email, 'token' => $verificationToken]);

            $msg = "To finish creating your cloudtechtiq account, confirm your email address by clicking this link: $verificationLink\nHappy coding,\nTeam cloudtechtiq";
            $msg = wordwrap($msg, 70);
                

            // mail($request->email, "Confirm your cloudtechtiq account", $msg);
             $emails = $request->email;
             $pdfFilePath = '';
    if ($emails) {
        // Fetching the message, subject, header, template, and footer from database
        $MailSettings = MailSettings::where('type', 'Bulk')->where('id', 1)->first();
        $TemplateSettings = Template::where('template_type', 'InvoiceModule')->first();

        if ($MailSettings->smtp == '1' && $TemplateSettings) {
            // Configure mail settings
            config([
                'mail.driver'     => $MailSettings->smtp_mailer,
                'mail.host'       => $MailSettings->smtp_host,
                'mail.port'       => $MailSettings->smtp_port,
                'mail.username'   => $MailSettings->smtp_user_name,
                'mail.password'   => $MailSettings->smtp_password,
                'mail.encryption' => $MailSettings->smtp_encryption,
            ]);

            // Extracting subject, header, template, and footer
            $subject = 'Welcome to cloudtechtiq';
            $header = '';
            $template = $TemplateSettings->template;
            $footer = $TemplateSettings->footer;

            // Compose and send email with attached PDF
            Mail::to($emails)->send(new WelcomeEmail($pdfFilePath, $subject, $header, $template, $footer,$data));
        }
            return redirect()->route('google.varify_email', ['user' => $data->id])->with('success', 'Your registration was successful.Mail is sent to your registered mail id');

            // return redirect('/')->with('message', 'Your registration was successful. You can now log in.');
        } else {
            return redirect('/')->with('message', 'Your registration was failed. Please try again later.');
        }
    }
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
                    $user->save();
                    return redirect('user/dashboard');
                } else {
                    // User not found
                    return redirect('/')->with('error', 'User not found.');
                }
            }else {
               //return 'Razorpay payment ID is missing or empty.';
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
