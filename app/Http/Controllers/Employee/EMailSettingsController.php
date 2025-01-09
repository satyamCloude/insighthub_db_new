<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use App\Models\OneTimeSetup;
use App\Models\LogActivity;
use App\Models\MailSettings;
use App\Models\Security;
use App\Models\User;
use Hash;
use Auth;
use Validator;

class EMailSettingsController extends Controller
{   
      public function home(Request $request)
    {
        
        $MailSet = MailSettings::where('user_id',Auth::user()->id)->first();

        return view('Employee.settings.MailSettings.home', compact('MailSet'));
    }

    public function store(Request $req)
    {
        // return $req->all();

       
            $Complete = MailSettings::where('user_id',Auth::user()->id)->where('id',2)->first();
            $Complete->user_id = Auth::user()->id;
            $Complete->smtp_mailer = $req->smtp_mailer;
            $Complete->smtp_host = $req->smtp_host;
            $Complete->smtp_port = $req->smtp_port;
            $Complete->smtp_user_name = $req->smtp_user_name;
            $Complete->smtp_password = $req->smtp_password;
            $Complete->smtp_encryption = $req->smtp_encryption;
            $Complete->MAILCHIMP_API_KEY = $req->MAILCHIMP_API_KEY;
            $Complete->SERVER_PREFIX = $req->SERVER_PREFIX;
            $Complete->MailProvider = $req->MailProvider;
            $Complete->RedirectUrl = $req->RedirectUrl;
            $Complete->clientID = $req->clientID;
            $Complete->ClientSecret = $req->ClientSecret;
            $Complete->connectionToken = $req->connectionToken;
            $Complete->save();

            $Bulk = MailSettings::where('user_id',Auth::user()->id)->where('id',1)->first();
            $Bulk->user_id = Auth::user()->id;
            $Bulk->smtp_mailer = $req->smtp_mailer;
            $Bulk->smtp_host = $req->smtp_host;
            $Bulk->smtp_port = $req->smtp_port;
            $Bulk->smtp_user_name = $req->smtp_user_name;
            $Bulk->smtp_password = $req->smtp_password;
            $Bulk->smtp_encryption = $req->smtp_encryption;
            $Bulk->MAILCHIMP_API_KEY = $req->MAILCHIMP_API_KEY;
            $Bulk->SERVER_PREFIX = $req->SERVER_PREFIX;
            $Bulk->MailProvider = $req->MailProvider;
            $Bulk->RedirectUrl = $req->RedirectUrl;
            $Bulk->clientID = $req->clientID;
            $Bulk->ClientSecret = $req->ClientSecret;
            $Bulk->connectionToken = $req->connectionToken;
            $Bulk->save();
       

        return redirect('Employee/MailSettings/home')->with('success', 'New Security Added Successfully');
    }


    function MailViaUpdate(Request $req)
    {
        if($req->type == "Bulk")
        {
            $Bulk = MailSettings::where('user_id',Auth::user()->id)->where('id',1)->where('type','Bulk')->first();
           if($req->value == 'smtp')
           {
            $Bulk->smtp = 1;
            $Bulk->chimps = 0;
            $Bulk->microsoft = 0;
            $Bulk->save();
           }
           if($req->value == 'chimps')
           {
            $Bulk->smtp = 0;
            $Bulk->chimps = 1;
            $Bulk->microsoft = 0;
            $Bulk->save();
           }
           if($req->value == 'microsoft')
           {
            $Bulk->smtp = 0;
            $Bulk->chimps = 0;
            $Bulk->microsoft = 1;
            $Bulk->save();
           }
        }

        if($req->type == "Complete")
        {
            $Complete = MailSettings::where('user_id',Auth::user()->id)->where('id',2)->where('type','Complete')->first();
            if($req->value == 'smtp')
            {
             $Complete->smtp = 1;
             $Complete->chimps = 0;
             $Complete->microsoft = 0;
             $Complete->save();
            }
            if($req->value == 'chimps')
            {
             $Complete->smtp = 0;
             $Complete->chimps = 1;
             $Complete->microsoft = 0;
             $Complete->save();
            }
            if($req->value == 'microsoft')
            {
             $Complete->smtp = 0;
             $Complete->chimps = 0;
             $Complete->microsoft = 1;
             $Complete->save();
            }
        }

        
    }
        

       


}
