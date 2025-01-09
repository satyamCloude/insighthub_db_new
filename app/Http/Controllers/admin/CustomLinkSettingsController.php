<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use App\Models\MailSettings;
use App\Models\InvoiceSettings;
use App\Models\OneTimeSetup;
use App\Models\LogActivity;
use App\Models\CustomLinkSetting;
use App\Models\Security;
use App\Models\ClientDetails;
use App\Models\Country;
use App\Models\EmployeeDetail;
use App\Models\User;
use Session;
use Hash;
use Auth;



class CustomLinkSettingsController extends Controller
{   
   //home page
      public function home(Request $request)
    {
           $CustomLinkSetting = CustomLinkSetting::get();
            $country = Country::get();
            $user_details = User::where('id',Auth::user()->id)->first();
            $Complete = MailSettings::select('smtp','chimps','microsoft')->where('user_id',Auth::user()->id)->where('id',2)->first();
            return view('admin.settings.CustomLinkSettings.home', compact('Complete','user_details','CustomLinkSetting','country'));
    }


    //home page
    public function Create(Request $request)
    {   
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Security Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/CustomLinkSettings/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('admin.settings.CustomLinkSettings.create'); 
    }

    //home page
    public function store(Request $req)
    {

        $data = $req->all();
        $CustomLinkSetting = CustomLinkSetting::create($data);
        
            $agent = new Agent();
            $browser = $agent->browser();
            $version = $agent->version($browser);
            $Log = $req->all();
            $Log['user_id'] = Auth::user()->id;
            $Log['ip'] = $req->ip();
            $Log['subject'] = "Security Data Store By " . Auth::user()->first_name;
            $Log['url'] = url('/') . '/admin/CustomLinkSettings/store';
            $Log['method'] = "Post";
            $Log['browser'] = $browser . "-" . $version;
            LogActivity::create($Log);
    

        Session::put('TabViews', 'CustomLink');

        return redirect()->back()->with('success', "New Security Added Successfully");
    }

    //edit
    public function edit(Request $req,$id)
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Security Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/CustomLinkSettings/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

       $custm_link = CustomLinkSetting::find($id);
        return view('admin.settings.CustomLinkSettings.edit',compact('custm_link','id'));
    }

    //updated
    public function update(Request $req,$id)
    {
     
        $data = CustomLinkSetting::find($id);
        if ($data) {
            $data->update($req->all());
            $data->save();
        } 
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Security Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/CustomLinkSettings/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        Session::put('TabViews', 'CustomLink');

        return redirect()->back()->with('success', "Custom Link Settings Edit Successfully");
    }

     public function delete(Request $request,$id)
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Security Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/CustomLinkSettings/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        CustomLinkSetting::find($id)->delete();
        return redirect()->back()->with('success', "Custom Link Deleted Successfully");
    }

   


}
