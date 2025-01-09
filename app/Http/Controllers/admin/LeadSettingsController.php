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
use App\Models\Country;
use App\Models\LeadSource;
use App\Models\LogActivity;
use App\Models\Security;
use App\Models\CompanyLogin;
use App\Models\LeadStatus;
use App\Models\LeadCategory;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Hash;
use Session;
use Auth;



class LeadSettingsController extends Controller
{   
   //home page
      public function home(Request $request)
    {
              $chk_exst = InvoiceSettings::first();
              $country = Country::get();

            $Bulk = MailSettings::select('smtp','chimps','microsoft')->where('user_id',Auth::user()->id)->where('id',1)->first();
            $Complete = MailSettings::select('smtp','chimps','microsoft')->where('user_id',Auth::user()->id)->where('id',2)->first();
            return view('admin.settings.LeadSettings.home', compact('Complete','Bulk','chk_exst','country'));
    } 
 public function TabView(Request $request)
{
    if($request->type == 'source')
        {
            $LeadSource = LeadSource::get();
            return view('admin.settings.LeadSettings.leadSource.home',compact('LeadSource'));
        }

        if($request->type == 'status')
        {
            $LeadStatus = LeadStatus::get();
            return view('admin.settings.LeadSettings.leadStatus.home',compact('LeadStatus'));
        }
        if($request->type == 'category')
        {
            $LeadCategory = LeadCategory::get();
            return view('admin.settings.LeadSettings.leadCategory.home',compact('LeadCategory'));
        }
}

public function storeLeadSource(Request $request)
 {
        $url = url('/').'/public/images/';
    
        $ClientDetail = $request->all();
        LeadSource::create($ClientDetail);

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Lead Data Store By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Client/store';
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);    
        return redirect()->back()->with('success', "Lead Source Added Successfully");
}

public function editLeadSource(Request $req)
{
    $agent = new Agent();
    $browser = $agent->browser();
    $version = $agent->version($browser);
    $Log = $req->all();
    $Log['user_id'] = Auth::user()->id;
    $Log['ip'] = $req->ip();
    $Log['subject'] = "Lead Edit Page is View By " . Auth::user()->first_name;
    $Log['url'] = url('/') . '/admin/Category/edit/' . $req->id;
    $Log['method'] = "Get";
    $Log['browser'] = $browser . "-" . $version;
    LogActivity::create($Log);

    $LeadSource = LeadSource::find($req->id);

    return response()->json(['LeadSource' => $LeadSource]);
}  

 public function updateLeadSource(Request $req)
{
    $agent = new Agent();
    $browser = $agent->browser();
    $version = $agent->version($browser);
    $Log = $req->all();
    $Log['user_id'] = Auth::user()->id;
    $Log['ip'] = $req->ip();
    $Log['subject'] = "Lead Edit Page is View By " . Auth::user()->first_name;
    $Log['url'] = url('/') . '/admin/Category/edit/' . $req->id;
    $Log['method'] = "Get";
    $Log['browser'] = $browser . "-" . $version;
    LogActivity::create($Log);

    $LeadSource = LeadSource::find($req->id);
    $LeadSource->name = $req->name;
    $LeadSource->save();

        return redirect()->back()->with('success', "Lead Source updated Successfully");
}

 public function deleteLeadSource(Request $req)
{
    $agent = new Agent();
    $browser = $agent->browser();
    $version = $agent->version($browser);
    $Log = $req->all();
    $Log['user_id'] = Auth::user()->id;
    $Log['ip'] = $req->ip();
    $Log['subject'] = "Lead Edit Page is View By " . Auth::user()->first_name;
    $Log['url'] = url('/') . '/admin/Category/edit/' . $req->id;
    $Log['method'] = "Get";
    $Log['browser'] = $browser . "-" . $version;
    LogActivity::create($Log);

    $LeadSource = LeadSource::find($req->id);
    $LeadSource->delete();

        return redirect()->back()->with('success', "Lead Source deleted Successfully");
}


public function storeleadCategory(Request $request)
 {
        $url = url('/').'/public/images/';
    
        $ClientDetail = $request->all();
        LeadCategory::create($ClientDetail);

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Lead Data Store By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Client/store';
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);    
        return redirect()->back()->with('success', "Lead Category Added Successfully");
}

public function editleadCategory(Request $req)
{
    $agent = new Agent();
    $browser = $agent->browser();
    $version = $agent->version($browser);
    $Log = $req->all();
    $Log['user_id'] = Auth::user()->id;
    $Log['ip'] = $req->ip();
    $Log['subject'] = "Lead Edit Page is View By " . Auth::user()->first_name;
    $Log['url'] = url('/') . '/admin/Category/edit/' . $req->id;
    $Log['method'] = "Get";
    $Log['browser'] = $browser . "-" . $version;
    LogActivity::create($Log);

    $LeadCategory = LeadCategory::find($req->id);

    return response()->json(['LeadCategory' => $LeadCategory]);
}  

 public function updateleadCategory(Request $req)
{
    $agent = new Agent();
    $browser = $agent->browser();
    $version = $agent->version($browser);
    $Log = $req->all();
    $Log['user_id'] = Auth::user()->id;
    $Log['ip'] = $req->ip();
    $Log['subject'] = "Lead Edit Page is View By " . Auth::user()->first_name;
    $Log['url'] = url('/') . '/admin/Category/edit/' . $req->id;
    $Log['method'] = "Get";
    $Log['browser'] = $browser . "-" . $version;
    LogActivity::create($Log);

    $LeadSource = LeadCategory::find($req->id);
    $LeadSource->name = $req->name;
    $LeadSource->save();

        return redirect()->back()->with('success', "Lead Category updated Successfully");
}

 public function deleteleadCategory(Request $req)
{
    $agent = new Agent();
    $browser = $agent->browser();
    $version = $agent->version($browser);
    $Log = $req->all();
    $Log['user_id'] = Auth::user()->id;
    $Log['ip'] = $req->ip();
    $Log['subject'] = "Lead Edit Page is View By " . Auth::user()->first_name;
    $Log['url'] = url('/') . '/admin/Category/edit/' . $req->id;
    $Log['method'] = "Get";
    $Log['browser'] = $browser . "-" . $version;
    LogActivity::create($Log);

    $LeadSource = LeadCategory::find($req->id);
    $LeadSource->delete();

        return redirect()->back()->with('success', "Lead Category deleted Successfully");
}

public function storeLeadStatus(Request $request)
    {
        $url = url('/').'/public/images/';
    
        $ClientDetail = $request->all();
        LeadStatus::create($ClientDetail);

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Lead Status Store By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Client/store';
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);    
        return redirect()->back()->with('success', "Lead Status Added Successfully");
    }
 
 public function editLeadStatus(Request $req)
{
    $agent = new Agent();
    $browser = $agent->browser();
    $version = $agent->version($browser);
    $Log = $req->all();
    $Log['user_id'] = Auth::user()->id;
    $Log['ip'] = $req->ip();
    $Log['subject'] = "Lead Edit Page is View By " . Auth::user()->first_name;
    $Log['url'] = url('/') . '/admin/Category/edit/' . $req->id;
    $Log['method'] = "Get";
    $Log['browser'] = $browser . "-" . $version;
    LogActivity::create($Log);

    $LeadSource = LeadStatus::find($req->id);

    return response()->json(['LeadStatus' => $LeadSource]);
} 

public function updateIsDefault(Request $request)
{
    $inventorId = $request->input('inventorId');
    $leadStatus = LeadStatus::find($inventorId);
    if (!$leadStatus) {
        return response()->json(['message' => 'LeadStatus not found'], 404);
    }
    DB::beginTransaction();
    try {
        if ($leadStatus->is_default == 0) {
            LeadStatus::where('id', '<>', $inventorId)->update(['is_default' => 0]);
            $leadStatus->is_default = 1;
        } else {
            $leadStatus->is_default = 0;
        }
        $leadStatus->save();
        DB::commit();
        return response()->json(['message' => 'Success']);
    } catch (\Exception $e) {
        DB::rollBack();
        return response()->json(['message' => 'Error occurred'], 500);
    }
}
 
public function updateLeadStatus(Request $req)
{
    $agent = new Agent();
    $browser = $agent->browser();
    $version = $agent->version($browser);
    $Log = $req->all();
    $Log['user_id'] = Auth::user()->id;
    $Log['ip'] = $req->ip();
    $Log['subject'] = "Lead Edit Page is View By " . Auth::user()->first_name;
    $Log['url'] = url('/') . '/admin/Category/edit/' . $req->id;
    $Log['method'] = "Get";
    $Log['browser'] = $browser . "-" . $version;
    LogActivity::create($Log);

    $LeadSource = LeadStatus::find($req->id);
    $LeadSource->lead_status = $req->lead_status;
    $LeadSource->label_color = $req->label_color;
    $LeadSource->save();

        return redirect()->back()->with('success', "Lead Status updated Successfully");
}



public function deleteLeadStatus(Request $req)
{
    $agent = new Agent();
    $browser = $agent->browser();
    $version = $agent->version($browser);
    $Log = $req->all();
    $Log['user_id'] = Auth::user()->id;
    $Log['ip'] = $req->ip();
    $Log['subject'] = "Lead Edit Page is View By " . Auth::user()->first_name;
    $Log['url'] = url('/') . '/admin/Category/edit/' . $req->id;
    $Log['method'] = "Get";
    $Log['browser'] = $browser . "-" . $version;
    LogActivity::create($Log);

    $LeadSource = LeadStatus::find($req->id);
    $LeadSource->delete();

        return redirect()->back()->with('success', "Lead Status deleted Successfully");
}

public function store(Request $request)
{
   
    $url = url('/').'/public/images/';

    $invoice_logo = 'invoice_logo.jpg';
    $autorised_sign = 'autorised_sign.jpg';
    if ($request->hasFile('invoice_logo')) {
        $rand = Str::random(4);
        $file = $request->file('invoice_logo');
        $extension = $file->getClientOriginalExtension();
        $invoice_logo = 'invoice_logo'.$rand.'.'.$extension;
        $file->move('public/images/', $invoice_logo);
    }
    $invoiceLogoPath = $url . $invoice_logo;

    if ($request->hasFile('autorised_sign')) {
        $rand = Str::random(4);
        $file = $request->file('autorised_sign');
        $extension = $file->getClientOriginalExtension();
        $autorised_sign = 'autorised_sign'.$rand.'.'.$extension;
        $file->move('public/images/', $autorised_sign);
    }
    $authorisedSignPath = $url . $autorised_sign;

      $chk_exst = InvoiceSettings::first();
    if ($chk_exst) {
        $invoiceSettings = $chk_exst;
    } else {
        $invoiceSettings = new InvoiceSettings;
    }

    $invoiceSettings->invoice_logo = $invoiceLogoPath;
    $invoiceSettings->autorised_sign = $authorisedSignPath;
    $invoiceSettings->language = $request->input('language');
    $invoiceSettings->due_after = $request->due_after;
    $invoiceSettings->send_reminder_before = $request->input('send_reminder_before');
    $invoiceSettings->reminder_time = $request->input('reminder');
    $invoiceSettings->send_reminder_after = $request->input('send_reminder_after');
    // $invoiceSettings->show_gst = $request->has('show_gst')??00;
    // $invoiceSettings->hsn_sac_code_show = $request->has('hsn_sac_code_show')??00;
    // $invoiceSettings->show_tax_calculation_msg = $request->has('show_tax_calculation_msg')??00;
    $invoiceSettings->show_client_name = $request->has('show_client_name')??00;
    $invoiceSettings->show_client_company_name = $request->has('show_client_company_name')??00;
    $invoiceSettings->show_client_company_address = $request->has('show_client_company_address')??00;
    $invoiceSettings->invoice_terms = $request->input('invoice_terms')??00;
    $invoiceSettings->other_info = $request->input('other_info')??00;
    // $invoiceSettings->show_project = $request->has('show_project')??00;
    $invoiceSettings->show_client_phone = $request->has('show_client_phone')??00;
    $invoiceSettings->show_client_email = $request->has('show_client_email')??00;
    // $invoiceSettings->show_authorised_signatory = $request->has('show_authorised_signatory')??00;
    $invoiceSettings->show_status = $request->has('show_status')??00;
    $invoiceSettings->save();
            return redirect()->back()->with('success', "New Invoice Setting Updated Successfully");

}

   


}
