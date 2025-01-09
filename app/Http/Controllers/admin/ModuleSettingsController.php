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
use App\Models\TaxSetting;
use App\Models\Security;
use App\Models\ModuleSetting;
use App\Models\ClientDetails;
use App\Models\Country;
use App\Models\EmployeeDetail;
use App\Models\User;
use Hash;
use Auth;



class ModuleSettingsController extends Controller
{   
   //home page
  public function home(Request $request)
{
        $ModuleSetting = ModuleSetting::first();
        return view('admin.settings.ModuleSettings.home', compact('ModuleSetting'));
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
        $Log['url'] = url('/') . '/admin/ModuleSettings/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('admin.settings.ModuleSettings.create'); 
    }
public function updateModuleStatus(Request $request)
{
    $settingId = $request->settingId;
    $moduleName = $request->moduleName;
    $isChecked = $request->input('isChecked');
    if($isChecked == 'true'){
        $isCheck = 1;
    }else{
        $isCheck = 0;
    }
    $moduleSetting = ModuleSetting::where('user_id', auth()->id())->first();

        if (!$moduleSetting) {
            $moduleSetting = new ModuleSetting;
            $moduleSetting->user_id = auth()->id();
        }
        $moduleSetting->$moduleName = $isCheck;
        if($moduleSetting->save()){
            return response()->json(['status' => 'success']);
        }else{
            return response()->json(['status' => 'fail']);

        }
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
        $Log['url'] = url('/') . '/admin/TaxSettings/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

       $tax = ModuleSetting::find($id);
        return view('admin.settings.ModuleSettings.edit',compact('tax','id'));
    }

    //updated
    public function update(Request $req,$id)
    {
     
        $data =ModuleSetting::find($id);
        $data['tax_name'] = $req->tax_name;
        $data['rate'] = $req->rate;
        $data->save();    

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Security Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/ModuleSettings/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect()->back()->with('success', "Tax Edit Successfully");
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
        $Log['url'] = url('/') . '/admin/ModuleSettings/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        ModuleSetting::find($id)->delete();
        return redirect()->back()->with('success', "Tax Deleted Successfully");
    }

   


}
