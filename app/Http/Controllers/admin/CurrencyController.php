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
use App\Models\Currency;
use App\Models\LogActivity;
use App\Models\TaxSetting;
use App\Models\Security;
use App\Models\ClientDetails;
use App\Models\Country;
use App\Models\EmployeeDetail;
use App\Models\User;
use Hash;
use Auth;



class CurrencyController extends Controller
{   
   //home page
  public function home(Request $request)
{
       $CurrencySettings = Currency::get();
        $country = Country::get();
        $user_details = User::where('id',Auth::user()->id)->first();
        $Complete = MailSettings::select('smtp','chimps','microsoft')->where('user_id',Auth::user()->id)->where('id',2)->first();
        return view('admin.settings.CurrencySettings.home', compact('Complete','user_details','CurrencySettings','country'));
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
        $Log['url'] = url('/') . '/admin/CurrencySettings/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

         
    }

    //home page
    public function store(Request $req)
    {

            $data = $req->all();
            Currency::create($data);
            $agent = new Agent();
            $browser = $agent->browser();
            $version = $agent->version($browser);
            $Log = $req->all();
            $Log['user_id'] = Auth::user()->id;
            $Log['ip'] = $req->ip();
            $Log['subject'] = "Security Data Store By " . Auth::user()->first_name;
            $Log['url'] = url('/') . '/admin/CurrencySettings/store';
            $Log['method'] = "Post";
            $Log['browser'] = $browser . "-" . $version;
            LogActivity::create($Log);
        return redirect()->back()->with('success', "New Currency Added Successfully");
    }

    //edit
    public function edit(Request $req,$id)
    {
       $tax = Currency::find($req->id);
        return view('admin.settings.CurrencySettings.edit',compact('tax','id'));
    }

   public function update(Request $req, $id)
{
    $data = Currency::find($id);


    if (!$data) {
        return redirect()->back()->with('error', 'Currency not found');
    }

    $data->update($req->all());

    $agent = new Agent();
    $browser = $agent->browser();
    $version = $agent->version($browser);

    $log = $req->all();
    $log['user_id'] = Auth::user()->id;
    $log['ip'] = $req->ip();
    $log['subject'] = "Currency Data Updated by " . Auth::user()->first_name;
    $log['url'] = url('/') . '/admin/CurrencySettings/update/' . $id;
    $log['method'] = "Post";
    $log['browser'] = $browser . "-" . $version;

    LogActivity::create($log);

     return redirect()->back()->with('success', "Currency Settings Edit Successfully");
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
        $Log['url'] = url('/') . '/admin/CurrencySettings/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        Currency::find($id)->delete();
         return redirect()->back()->with('success', "Currency Settings Deleted Successfully");
    }

   


}
