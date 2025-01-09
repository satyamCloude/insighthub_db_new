<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider; // Add this line
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use Auth;
use Exception;
use App\Models\User;
use Illuminate\Http\Request;
// use auth;
use Session;
use Hash;
use Validator;
use Razorpay\Api\Api;
use App\Models\MailSettings;
use App\Models\ClientDetail;
use Jenssegers\Agent\Agent;
use App\Models\CompanyLogin;
use App\Models\LogActivity;
use App\Models\Attendence;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail; // Import your mail class
use App\Mail\ClientWelcomeEmail; // Import your mail class
use Illuminate\Support\Str;



class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    public function handleGoogleCallback2()
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {
                Auth::login($finduser);
                return redirect('/home');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id
                ]);

                Auth::login($newUser);
                return redirect()->back();
            }

        } catch (Exception $e) {
            return redirect('admin/google');
        }
    }
    public function handleGoogleCallback()
{
    try {
        $user = Socialite::driver('google')->stateless()->user();
        \Log::info($user);

         $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {
                Auth::login($finduser);
                return redirect('/home');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id
                ]);

                Auth::login($newUser);
                 // Generate and store verification token
         $verificationToken = Str::random(32); // Adjust the length of the token as needed
        $randomPass = $this->generateRandomPassword(6); // Generate a password of length 6

        $user->verification_token = $verificationToken;
       if($user->save()){
                      $verificationLink = route('verify.email', ['user' => $newUser->id, 'email' => $newUser->email, 'token' => $verificationToken]);
        $msgs = "Welcome to cloudtechtiq, \n Your email id is: $newUser->email \n Password is:$randomPass  \nHappy coding,\nTeam cloudtechtiq";
        $msg = wordwrap($msgs, 70);
        $message = wordwrap($msgs, 70);
        // mail($newUser->email, "Confirm your cloudtechtiq account", $msg);

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
                \Mail::to($newUser->email)->send(new ClientAuthEmail($newUser->email,$message));
                \Mail::to($newUser->email)->send(new ClientWelcomeEmail($newUser->email,$verificationLink));
                }       
         }
       
                return redirect()->back();
            }
    } catch (Exception $e) {
        // Log the exception for debugging
        \Log::error($e);
        return redirect('admin/google');
    }
}


public function generateRandomPassword($length = 8) {
    $chars = [
        'abcdefghijklmnopqrstuvwxyz',
        'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
        '0123456789',
        '!@#$%^&*()-_+=<>?'
    ];

    $charCount = count($chars);
    $password = '';

    // Ensure at least one character from each character set
    foreach ($chars as $char) {
        $password .= $char[rand(0, strlen($char) - 1)];
    }

    // Fill the rest of the password with random characters
    for ($i = $charCount; $i < $length; $i++) {
        $password .= $chars[rand(0, $charCount - 1)][rand(0, strlen($chars[rand(0, $charCount - 1)]) - 1)];
    }

    // Shuffle the password to mix characters
    return str_shuffle($password);
}

}
