<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\CompanyLogin;
use App\Models\ClientDetail;
use App\Models\Template;
use App\Mail\ClientAuthEmail;
use App\Mail\ClientWelcomeEmail;
use Hash;

class MicrosoftController extends Controller
{
   public function redirectToMicrosoft()
    {
          // echo config('services.microsoft.redirect'); exit;
        // echo config('services.microsoft.redirect'); exit;
        $clientId = config('services.microsoft.client_id');
        $redirectUri = config('services.microsoft.redirect');
        $authorizeUrl = config('services.microsoft.oauth_url') . config('services.microsoft.authorize_uri');

        return redirect()->away($authorizeUrl . '?' . http_build_query([
            'client_id' => $clientId,
            'redirect_uri' => $redirectUri,
            'response_type' => 'code',
            'scope' => 'openid email profile',
        ]));
    }

    // public function handleMicrosoftCallback(Request $request)
    // {
        

    //     $clientId = config('services.microsoft.client_id');
    //     $clientSecret = config('services.microsoft.client_secret');
    //     $redirectUri = config('services.microsoft.redirect');
    //     $tokenUrl = config('services.microsoft.oauth_url') . config('services.microsoft.token_uri');

    //     $client = new \GuzzleHttp\Client();

    //     try {
    //         $response = $client->post($tokenUrl,[
    //             'form_params' => [
    //                 'client_id' => $clientId,
    //                 'client_secret' => $clientSecret,
    //                 'code' => $request->code,
    //                 'redirect_uri' => $redirectUri,
    //                 'grant_type' => 'authorization_code',
    //             ],
    //         ]);


    //         $body = json_decode($response->getBody());

    //         $accessToken = $body->access_token;
    //         // return $accessToken;
    //         // Use the access token to fetch user data from Microsoft Graph API
    //         $graphUrl = 'https://graph.microsoft.com/v1.0/me'; // Endpoint to fetch user data
    //         $graphResponse = $client->get($graphUrl, [
    //             'headers' => [
    //                 'Authorization' => 'Bearer ' . $accessToken,
    //                 'Accept' => 'application/json',
    //             ],
    //         ]);

    //         $userData = json_decode($graphResponse->getBody());

    //         // At this point, $userData contains the user's information from Microsoft Graph API
    //         $id= $userData->id;
    //         $user=User::where('microsoft_id',$id)->first();
    //         if($user){
    //             auth()->login($user,true);
    //             return redirect('user/dashboard');
    //         }else{
    //             $name=explode(' ',$userData->displayName);
    //             $verificationToken = Str::random(32); 
    //             $randomPass = rand(100000, 999999);
                
    //             $newUser = new User();
    //             if(count($name) > 1){
    //               $newUser->first_name = $name[0];  
    //               $newUser->last_name = $name[1];  
    //             }else{
    //               $newUser['first_name'] = $userData->displayName;
    //             }
    //             $newUser->email = $userData->mail;
    //             $newUser->microsoft_id = $id;
    //             $newUser->type = 2;
    //             $newUser->status = 4;
    //             $newUser->password = Hash::make($randomPass);
    //             $newUser->verification_token = $verificationToken;
    //             if ($newUser->save()) {
    //                 $CompanyLogin = new CompanyLogin;
    //                 $CompanyLogin->user_id = $newUser->id;
    //                 $CompanyLogin->company_name = '';
    //                 $CompanyLogin->save();
        
    //                 $ClientDetail = new ClientDetail;
    //                 $ClientDetail->user_id = $newUser->id;
    //                 $ClientDetail->company_id = $CompanyLogin->id;
    //                 $ClientDetail->save();
                    
    //                 auth()->login($newUser,true);
    //                 return redirect('user/dashboard');
    //             }
    //         }
    //     } catch (\Exception $e) {
    //         // Handle exception
    //         return $e->getMessage();
    //         return redirect('/')->with('error', 'Failed to authenticate with Microsoft 365.');
    //     }
    // }
    
    public function handleMicrosoftCallback(Request $request)
    {
        $clientId = config('services.microsoft.client_id');
        $clientSecret = config('services.microsoft.client_secret');
        $redirectUri = config('services.microsoft.redirect');
        $tokenUrl = config('services.microsoft.oauth_url') . config('services.microsoft.token_uri');

        $client = new \GuzzleHttp\Client();

        try {
            $response = $client->post($tokenUrl,[
                'form_params' => [
                    'client_id' => $clientId,
                    'client_secret' => $clientSecret,
                    'code' => $request->code,
                    'redirect_uri' => $redirectUri,
                    'grant_type' => 'authorization_code',
                ],
            ]);


            $body = json_decode($response->getBody());

            $accessToken = $body->access_token;
        // return $accessToken;
            // Use the access token to fetch user data from Microsoft Graph API
            $graphUrl = 'https://graph.microsoft.com/v1.0/me'; // Endpoint to fetch user data
            $graphResponse = $client->get($graphUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                    'Accept' => 'application/json',
                ],
            ]);

            $userData = json_decode($graphResponse->getBody());
            // return $userData;
            // At this point, $userData contains the user's information from Microsoft Graph API
            $id= $userData->id;
            $user=User::where('microsoft_id',$id)->first();
            
            if($user){
                auth()->login($user,true);
                return redirect('user/dashboard');
            }else{
                $name=explode(' ',$userData->displayName);
                $verificationToken = Str::random(32); 
                $randomPass = rand(100000, 999999);
                
                $newUser = new User();
                if(count($name) > 1){
                  $newUser->first_name = $name[0];  
                  $newUser->last_name = $name[1];  
                }else{
                  $newUser['first_name'] = $userData->displayName;
                }
                $newUser->email = $userData->mail;
                $newUser->microsoft_id = $id;
                $newUser->type = 2;
                $newUser->status = 5;
                $newUser->password = Hash::make($randomPass);
                $newUser->verification_token = $verificationToken;
                if ($newUser->save()) {
                    $CompanyLogin = new CompanyLogin;
                    $CompanyLogin->user_id = $newUser->id;
                    $CompanyLogin->company_name = '';
                    $CompanyLogin->save();
        
                    $ClientDetail = new ClientDetail;
                    $ClientDetail->user_id = $newUser->id;
                    $ClientDetail->company_id = $CompanyLogin->id;
                    $ClientDetail->save();
                    
                    // auth()->login($newUser,true);
                    // return redirect('user/dashboard');

                    $verificationLink = route('verify.email', ['user' => $newUser->id, 'email' => $newUser->email, 'token' => $verificationToken]);
                    $msgs = "To finish creating your cloudtechtiq account, confirm your email address by clicking this link: <a href='$verificationLink'>$verificationLink</a><br/>Happy coding,\nTeam cloudtechtiq";

                    $userDetals = "Welcome to cloudtechtiq, \n Your email id is: $newUser->email \n Password is:$randomPass  \nHappy coding,\nTeam cloudtechtiq";

                    $msgs = wordwrap($msgs, 70);
                    $userDetals = wordwrap($userDetals, 70);
                    // mail($newUser->email, "Confirm your cloudtechtiq account", $msg);
                    $TemplateSettings = Template::where('name', 'Successfully Registered')->first();
                    $TemplateSettings1 = Template::where('name', 'Email Verification')->first();

                    $subject = $TemplateSettings->subject;
                    $header = $TemplateSettings->header;
                    $template = $TemplateSettings->template;
                    $footer = $TemplateSettings->footer;


                    $subject1 = $TemplateSettings1->subject;
                    $header1 = $TemplateSettings1->header;
                    $template1 = $TemplateSettings1->template;
                    $footer1 = $TemplateSettings1->footer;

                    $replacementsSubject = array(
                     '[Company Name]' => 'CloudTechtiq',
                      );
                    $messageReplacementssubject = $subject;
                    $subject = str_replace(array_keys($replacementsSubject), array_values($replacementsSubject),$messageReplacementssubject);

                    $replacementsTemplate = array(
                     '{$client_name}' => $newUser->first_name,
                     '[Your Company Name]' => 'CloudTechtiq',
                     '{$client_username}' => $newUser->email,
                     '[automatically generated password or instructions to set up a password]' => $randomPass,
                    );
                    $messageReplacementsTemplate = $template;
                    $template = str_replace(array_keys($replacementsTemplate), array_values($replacementsTemplate), $messageReplacementsTemplate);


                    $replacementsFooter = array(
                    '[Company Name]' => 'CloudTechtiq',
                    );
                    $messagefooter = $footer;
                    $footer = str_replace(array_keys($replacementsFooter), array_values($replacementsFooter), $messagefooter);

                    $replacementsTemplate1 = array(
                        '{$client_name}' => $newUser->first_name,
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

                    \Mail::to($newUser->email)->send(new ClientAuthEmail($subject,$header,$template,$footer));
                    \Mail::to($newUser->email)->send(new ClientWelcomeEmail($subject1,$header1,$template1,$footer1));   
                    return redirect()->route('google.varify_email', ['user' => $newUser->id])->with('success', 'Logged in successfully via microsoft account');
                } else {
                    return redirect('/')->with('message', 'Your registration was failed. Please try again later.');
                }
            }
        } catch (\Exception $e) {
            // Handle exception
            return $e->getMessage();
            return redirect('/')->with('error', 'Failed to authenticate with Microsoft 365.');
        }
    }
}
