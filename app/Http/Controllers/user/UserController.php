<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use auth;
use Session;
use Hash;
use Validator;
use Razorpay\Api\Api;
use Jenssegers\Agent\Agent;
use App\Models\MailSettings;
use App\Models\User;
use App\Models\Template;
use App\Mail\TicketMail;

use App\Models\ClientDetail;
use App\Models\CompanyDetail;
use App\Models\EmployeeDetail;
use App\Models\CompanyLogin;
use App\Models\LogActivity;
use App\Models\Attendence;
use App\Models\PaymentDetail;
use App\Mail\WelcomeEmail;
use App\Mail\ClientWelcomeEmail;
use App\Mail\ForgotPassword;
use App\Mail\TwoStepAuthOtp;


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

    $User = User::where('email', $identifier)->orWhere('phone_number', $identifier)->first();
    
    if($User){
        if($User->status == 2){
            return redirect('/')->with('error', 'Your account has been suspended.');
        }
        
        if($User->status == 3){
            return redirect('/')->with('error', 'You have been terminated, so you cannot login.');
        }
        
        if($User->status == 5){
            return redirect('/')->with('error', 'Your account is unverified.');
        }
    
        
       
        // Check for 2FA (Two Factor Authentication)
        if ($User->google2fa_enabled) {
            $request->session()->put('2fa:user:id', $User->id);
            if ($User->twoFA_via > 0) {
                if ($User->twoFA_via == 2) {
                    return redirect('two-factor-authentication');
                } else {
                    $emails = $User->email;
                    if ($emails) {
                        // Generate a 4-digit OTP
                        $otp = rand(100000, 999999);

                        // Store OTP in the user model
                        $User->rand_otp = $otp; // Ensure you have an 'rand_otp' column in the users table or use another storage method
                        $User->save();

                        // Prepare and send the email
                        $templateSettings = Template::where('name', 'Two Factor Authentication')->first();
                        $userDetail = User::find($User->id);

                        if ($templateSettings && $userDetail) {
                            $subject = $templateSettings->subject;
                            $header = $templateSettings->header;
                            $template = $templateSettings->template;
                            $footer = $templateSettings->footer;

                            // Replace placeholders in the email template
                            $replacementsTemplate = [
                                '{Employee Name}' => $userDetail->first_name,
                                '[Users Name]' => $userDetail->first_name,
                                '[123456]' => $otp, // Add OTP to the template
                                '[Your Company Name]' => 'CloudTechtiq',
                                '[Company Name]' => 'CloudTechtiq',
                            ];
                           
                                       
                                        $template = str_replace(array_keys($replacementsTemplate), array_values($replacementsTemplate), $template);
                        
                            // Send email
                            Mail::to($userDetail->email)->send(new TicketMail($subject, $header, $template, $footer));
                            
                            return redirect('two-factor-authentication');
                        } else {
                            return redirect('two-factor-auth-selection');
                        }
                    } else {
                        return redirect('two-factor-auth-selection');
                    }
                }
            } else {
                return redirect('two-factor-auth-selection');
            }
        } else {
            // Attempt to authenticate the user
            if (Auth::attempt($credentials)) {
                $user = auth()->user();
                $name = auth::user()->first_name;
                Session::put('UserName', $name);
                if ($user->type == "2" && $user->email_verified_at != null && ($user->status == 4 || $user->status == 1)) {
                 
    
                    $logData = [
                        'user_id' => $user->id,
                        'ip' => request()->ip(),
                        'type' => 'login',
                        'login_time' => now(),
                    ];
    
                    LogActivity::create($logData);
    
                    return redirect('user/dashboard');
                } else {
                    Auth::logout();
                    return redirect('/')->with('error', 'Login details are not valid');
                }
            }
        }
        return redirect('/')->with('error', 'Login details are not valid');  
    }
    else{
        return redirect('/')->with('error', 'User not exist.');
    }
        
    
  }


  public function register(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'email' => 'required|string|email|max:255|unique:users',
    ]);

    // If validation fails, return validation errors
    if ($validator->fails()) {
      return response()->json(['status' => 400, 'message' => $validator->errors()]);
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
      // Assuming the following models exist and relations are defined properly
      $CompanyDetail = new CompanyDetail;
      $CompanyDetail->user_id = $user->id;
      $CompanyDetail->company_name = $request->company_name;
      $CompanyDetail->save();

      $ClientDetail = new ClientDetail;
      $ClientDetail->user_id = $user->id;
      $ClientDetail->company_id = $CompanyDetail->id;
      $ClientDetail->save();

      $verificationLink = route('verify.email', ['user' => $user->id, 'email' => $request->email, 'token' => $verificationToken]);

      $message = "To finish creating your cloudtechtiq account, confirm your email address by clicking this link: $verificationLink\n\nHappy coding,\nTeam cloudtechtiq";

      $msgs = wordwrap($message, 70);

      $TemplateSettings1 = Template::where('name', 'Email Verification')->first();

        $subject1 =  $TemplateSettings1->subject;
        $header1 = $TemplateSettings1->header;
        $template1 = $TemplateSettings1->template;
        $footer1 = $TemplateSettings1->footer;
        $replacementsTemplate1 = array(
          '{$client_name}' => $request->first_name,
          '[Your Company Name]' => 'CloudTechtiq',
          '[Verification Link]' => $msgs,
        );
        $messageReplacementsTemplate1 = $template1;
        $template1 = str_replace(array_keys($replacementsTemplate1), array_values($replacementsTemplate1), $messageReplacementsTemplate1);

        $replacementsFooter1 = array(
          '[Company Name]' => 'CloudTechtiq',
        );
        $messagefooter1 = $footer1;
        $footer1 = str_replace(array_keys($replacementsFooter1), array_values($replacementsFooter1), $messagefooter1);
        // \Mail::to($request->email)->send(new ClientWelcomeEmail($subject1,$header1,$template1,$footer1));
      
      return response()->json(['status' => 200, 'message' => 'successfully registered', 'user' => $user]);
    } else {
      return response()->json(['status' => 400, 'message' => 'registration failed']);
    }
  }
  public function account_verification($user, $email, $token)
  {
    $user2 = User::where('email', $email)->where('verification_token', $token)->first();
    if ($user2) {
      // $user->email_verified_at = now();
      // $user->verification_token = null;
      // $user->save();
      return redirect()->route('verify.validate_card', ['user' => $user2->id, 'email' => $email, 'token' => $token, 'message' => 'Email verified successfully.']);
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
    $PaymentDetails = PaymentDetail::where('payment_mode',3)->first();

    return view('validate_card', ['user' => $user, 'token' => $token, 'email' => $email,'PaymentDetails' => $PaymentDetails]);
  }

  public function validate_card_callback(Request $request, $validated_user_id, $validated_email, $validated_token, $price)
  {
    $validated_user_id = $validated_user_id;
    $validated_email = $validated_email;
    $validated_token = $validated_token;
    $razorpay_payment_id = $request->razorpay_payment_id;

    $user2 = User::where('id', $validated_user_id)->where('email', $validated_email)->where('verification_token', $validated_token)->first();
    if ($user2) {
      $user2->email_verified_at = now();
      $user->razorpay_payment_id = $razorpay_payment_id;
      $user->status = 4;
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
  public function handleCallback(Request $request, $validated_user_id, $validated_email, $validated_token, $price)
  {
    $input = $request->razorpay_payment_id;
    $api = new Api(env('RAZORPAY_KEY'), env('RAZORPAY_SECRET'));
    $razorpayPaymentId = $input;

    if (isset($razorpayPaymentId) && !empty($razorpayPaymentId)) {
      try {
        $razorpayPaymentId = $razorpayPaymentId;
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
    } else {
      return redirect('/')->with('error', 'Something went wrong.');
    }

    // return redirect('/')->with('message', 'Your registration was successful. You can now log in.');
  }

  public function Logout()
  {
    //  return 1;
    $attendance = Attendence::where('emp_Id', auth::user()->id)->where('punch_date', date('Y-m-d'))->where('punch_out', null)->where('punch_in', '!=', null)->first();
    if ($attendance) {
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
    return redirect('/');
  }
  //FORGOT PASSWORD
  public function userForgotPassword(Request $request)
  {
    return view('auth.userforgot');
  }

  public function userForgotPasswordPage(Request $request)
  {
    return view('auth.userForgotPassword');
  }
  //FOR SEND MAIL
  public function userForgotPasswordSendMail(Request $request)
  {
    $email  = $request->email;
    $userDetais = User::where('email', $email)->first();

    if (!empty($userDetais)) {
      Session::put('email', $email);
      $TemplateSettings = Template::where('name', 'Forgot Password')->first();
      $MailSettings = MailSettings::where('type', 'Bulk')->where('id', 1)->first();
      if ($MailSettings->smtp == '1') {
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
        $url = url('/') . '/forgot-password?id='.$userDetais->id;
        $replacementsTemplate = array(
          '{$client_name}' => $userDetais->first_name,
          '[Company Name]' => 'CloudTechtiq',
          '[Password Reset Link]' => $url,

        );
        $messageReplacementsTemplate = $template;
        $template = str_replace(array_keys($replacementsTemplate), array_values($replacementsTemplate), $messageReplacementsTemplate);

        \Mail::to($email)->send(new ForgotPassword($subject, $header, $template, $footer));
        return redirect('/')->with('message', 'link send on your email id for change password');
      }
    } else {
      return redirect()->back()->with('error', 'E-Mail id not registered');
    }
  }
  /////FOR UPDATE PASSWORD
  public function userForgotPasswordStore(Request $request)
  {
    $userDetails = User::find($request->user_id);

    if (!empty($userDetails)) {

      $password = $request->password;
      $userDetails->password = Hash::make($password);
      $userDetails->save();
      $client = ClientDetail::where('user_id', $userDetails->id)->count();
      $EmployeeDetail = EmployeeDetail::where('user_id', $userDetails->id)->count();
      if ($client) {
        return redirect('/')->with('message', 'Password change successfully');
      } elseif ($EmployeeDetail) {
        return redirect('/employee')->with('message', 'Password change successfully');
      } else {
        return redirect('/admin')->with('message', 'Password change successfully');
      }
    }else{
      if ($client) {
        return redirect('/')->with('message', 'User not found.');
      } elseif ($EmployeeDetail) {
        return redirect('/employee')->with('message', 'User not found.');
      } else {
        return redirect('/admin')->with('message', 'User not found.');
      }
    }
  }
}
