<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use App\Models\MailSettings;
use App\Models\OneTimeSetup;
use App\Models\State;
use App\Models\City;
use App\Models\LogActivity;
use App\Models\Security;
use App\Models\CompanyLogin;
use App\Models\Country;
use App\Models\User;
use Hash;
use Auth;


class CompanySettingsController extends Controller
{   
    //home page
    public function home(Request $request)
    {
        $CompanyLogin = CompanyLogin::where('user_id',Auth::user()->id)->first();
        $Country = Country::get();
        return view('admin.settings.CompanySettings.home', compact('CompanyLogin','Country'));
    }

    public function getStates(Request $request,$id)
    {
            $CompanyLogin = CompanyLogin::where('user_id',Auth::user()->id)->first();
            $State = State::where('country_id',$id)->get();
             return response()->json([
                'status' => 'success', 
                'data' =>$State, 
                'message' => 'State found successfully!'
            ], 200);

    }

    public function getCity(Request $request,$id)
    {
            $CompanyLogin = CompanyLogin::where('user_id',Auth::user()->id)->first();
            $State = City::where('state_id',$id)->get();
             return response()->json([
                'status' => 'success', 
                'data' =>$State, 
                'message' => 'State found successfully!'
            ], 200);

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
        $Log['subject'] = "Company Settings  create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Security/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('admin.settings.CompanySettings.create'); 
    }

    //home page
    public function store(Request $req)
    {
        $chk_exst = CompanyLogin::where('user_id', Auth::user()->id)->first();
        // return $chk_exst ;
        if ($chk_exst) {
            // Update existing record
            $chk_exst->update($req->all());
        } else {
            // Create new record
            $data = $req->all();
            CompanyLogin::create($data);
        }


        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Security Data Store By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/CompanySettings/store';
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);
    

        return redirect()->back()->with('success', "New Company Settings Added Successfully");
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
        $Log['subject'] = "Company Settings Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/CompanySettings/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        $Security = Security::find($id);
        return view('admin.settings.CompanySettings.edit',compact('Security'));
    }
    //updated

    public function update(Request $req,$id)
    {
     
        $data =Security::find($id);
        $data['User_ip_address'] = $req->User_ip_address;
        $data['status'] = $req->status;
        $data->save();    

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Security Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Security/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('admin/Security/home')->with('success', "Security Edit Successfully");
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
        $Log['url'] = url('/') . '/admin/Security/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        Security::find($id)->delete();
        return redirect('admin/Security/home')->with('success', "Security Deleted Successfully");
    }  

    public function mail_setup(Request $request)
    {
       // return redirect('admin/Security/home')->with('success', "Security Deleted Successfully");
    }


}
