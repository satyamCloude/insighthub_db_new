<?php

namespace App\Http\Controllers\admin;

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

class MailSettingsController extends Controller
{   
      public function home(Request $request)
    {
        
        $MailSet = MailSettings::where('user_id',Auth::user()->id)->first();

        return view('admin.settings.MailSettings.home', compact('MailSet'));
    }

    public function store(Request $req)
    {
        // return $req->all();

       
           $Complete = MailSettings::where('user_id', Auth::user()->id)->whereIn('id', [1, 2])->first();
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
            $Complete->GSuite_mailer = $req->GSuite_mailer;
            $Complete->GSuite_host = $req->GSuite_host;
            $Complete->GSuite_port = $req->GSuite_port;
            $Complete->GSuite_user_name = $req->GSuite_user_name;
            $Complete->GSuite_password = $req->GSuite_password;
            $Complete->GSuite_encryption = $req->GSuite_encryption;
            $Complete->SES_mailer = $req->SES_mailer;
            $Complete->SES_host = $req->SES_host;
            $Complete->SES_port = $req->SES_port;
            $Complete->SES_user_name = $req->SES_user_name;
            $Complete->SES_password = $req->SES_password;
            $Complete->SES_encryption = $req->SES_encryption;
            $Complete->microSmtp_mailer = $req->microSmtp_mailer;
            $Complete->microSmtp_host = $req->microSmtp_host;
            $Complete->microSmtp_port = $req->microSmtp_port;
            $Complete->microSmtp_user_name = $req->microSmtp_user_name;
            $Complete->microSmtp_password = $req->microSmtp_password;
            $Complete->microSmtp_encryption = $req->microSmtp_encryption;
            $Complete->save();

       

        return redirect()->back()->with('success', 'New Settings Added Successfully');
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
            $Bulk->GSuite = 0;
            $Bulk->SES = 0;
            $Bulk->save();
           }
           if($req->value == 'chimps')
           {
            $Bulk->chimps = 1;
            $Bulk->smtp = 0;
            $Bulk->microsoft = 0;
            $Bulk->GSuite = 0;
            $Bulk->SES = 0;
            $Bulk->save();
           }
           if($req->value == 'microsoft')
           {
            $Bulk->microsoft = 1;
            $Bulk->smtp = 0;
            $Bulk->chimps = 0;
            $Bulk->GSuite = 0;
            $Bulk->SES = 0;
            $Bulk->save();
           }
           if($req->value == 'GSuite')
           {
            $Bulk->GSuite = 1;
            $Bulk->microsoft = 0;
            $Bulk->chimps = 0;
            $Bulk->smtp = 0;
            $Bulk->SES = 0;
            $Bulk->save();
           }
           if($req->value == 'SES')
           {
            $Bulk->SES = 1;
            $Bulk->smtp = 0;
            $Bulk->GSuite = 0;
            $Bulk->chimps = 0;
            $Bulk->microsoft = 0;
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
             $Complete->GSuite = 0;
             $Complete->SES = 0;
             $Complete->save();
            }
            if($req->value == 'chimps')
            {
             $Complete->smtp = 0;
             $Complete->chimps = 1;
             $Complete->microsoft = 0;
             $Complete->GSuite = 0;
             $Complete->SES = 0;
             $Complete->save();
            }
            if($req->value == 'microsoft')
            {
             $Complete->microsoft = 1;
             $Complete->chimps = 0;
             $Complete->GSuite = 0;
             $Complete->smtp = 0;
             $Complete->SES = 0;
             $Complete->save();
            }
            if($req->value == 'GSuite')
            {
             $Complete->GSuite = 1;
             $Complete->SES = 0;
             $Complete->smtp = 0;
             $Complete->chimps = 0;
             $Complete->microsoft = 0;
             $Complete->save();
            }
            if($req->value == 'SES')
            {
             $Complete->SES = 1;
             $Complete->smtp = 0;
             $Complete->chimps = 0;
             $Complete->microsoft = 0;
             $Complete->GSuite = 0;
             $Complete->save();
            }
        }

        
    }
        

       


}
