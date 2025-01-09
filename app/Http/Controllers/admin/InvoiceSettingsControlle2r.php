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
use App\Models\LogActivity;
use App\Models\Security;
use App\Models\User;
use App\Models\AppSetting;
use Hash;
use Auth;



class InvoiceSettingsController extends Controller
{   
   //home page
  public function home(Request $request)
{
          $chk_exst = InvoiceSettings::first();
          $country = Country::get();
        $Bulk = MailSettings::select('smtp','chimps','microsoft')->where('user_id',Auth::user()->id)->where('id',1)->first();
        $Complete = MailSettings::select('smtp','chimps','microsoft')->where('user_id',Auth::user()->id)->where('id',2)->first();
        return view('admin.settings.InvoiceSettings.home', compact('Complete','Bulk','chk_exst','country'));
}


public function store(Request $request)
{
    try {
        $url = url('/').'/public/images/';

        $chk_exst = InvoiceSettings::first();
        if ($chk_exst) {
            $invoiceSettings = $chk_exst;
        } else {
            $invoiceSettings = new InvoiceSettings;
        }

    
        // Handle invoice_logo file
        if ($request->hasFile('invoice_logo')) {
            $invoice_logo = 'invoice_logo.jpg';
            $rand = Str::random(4);
            $file = $request->file('invoice_logo');
            $extension = $file->getClientOriginalExtension();
            $invoice_logo = 'invoice_logo'.$rand.'.'.$extension;
            $file->move('public/images/', $invoice_logo);
            $invoiceLogoPath = $url . $invoice_logo;

            $invoiceSettings->invoice_logo = $invoiceLogoPath;
        }

        // Handle autorised_sign file
        if ($request->hasFile('autorised_sign')) {
            $autorised_sign = 'autorised_sign.jpg';
            $rand = Str::random(4);
            $file = $request->file('autorised_sign');
            $extension = $file->getClientOriginalExtension();
            $autorised_sign = 'autorised_sign'.$rand.'.'.$extension;
            $file->move('public/images/', $autorised_sign);
            $authorisedSignPath = $url . $autorised_sign;

            $invoiceSettings->autorised_sign = $authorisedSignPath;
        }

        // Check if InvoiceSettings record exists
       

        // Assign values to the InvoiceSettings model
        $invoiceSettings->language = $request->input('language');
        $invoiceSettings->due_after = $request->due_after;
        $invoiceSettings->send_reminder_before = $request->input('send_reminder_before');
        $invoiceSettings->reminder = $request->input('reminder');
        $invoiceSettings->send_reminder_after = $request->input('send_reminder_after');
        // $invoiceSettings->show_gst = $request->has('show_gst')??00;
        // $invoiceSettings->hsn_sac_code_show = $request->has('hsn_sac_code_show')??00;
        // $invoiceSettings->show_tax_calculation_msg = $request->has('show_tax_calculation_msg')??00;
        $invoiceSettings->show_client_name = $request->has('show_client_name')??0;
        $invoiceSettings->show_client_company_name = $request->has('show_client_company_name')??0;
        $invoiceSettings->show_client_company_address = $request->has('show_client_company_address')??0;
        $invoiceSettings->invoice_terms = $request->input('invoice_terms')??0;
        $invoiceSettings->other_info = $request->input('other_info')??0;
        // $invoiceSettings->show_project = $request->has('show_project')??0;
        $invoiceSettings->show_client_phone = $request->has('show_client_phone')??0;
        $invoiceSettings->show_client_email = $request->has('show_client_email')??0;
        // $invoiceSettings->show_authorised_signatory = $request->has('show_authorised_signatory')??0;
        $invoiceSettings->show_status = $request->has('show_status')??0;

        $invoiceSettings->save();

        return redirect()->back()->with('success', "Invoice Settings Updated Successfully");
    } catch (\Exception $e) {
        return redirect()->back()->with('error', "Error updating Invoice Settings: " . $e->getMessage());
    }
}

public function storeOld(Request $request)
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
            return redirect('admin/InvoiceSettings/home')->with('success', "New Invoice Setting Updated Successfully");

}
public function InvoiceModuleETemplate(Request $request,$id){
    // return 1;
    // Session::put('TabViews2', 'InvoiceModule');
          $pSe = AppSetting::where('id',1)->first();
          return view('admin.ETemplatesettings.InvoiceModule.home',compact('pSe','id'));
}

public function QuotesModuleETemplate(Request $request,$id){
    // return 1;
    // Session::put('TabViews2', 'InvoiceModule');
          $pSe = AppSetting::where('id',1)->first();
          return view('admin.ETemplatesettings.QuotesModule.home',compact('pSe','id'));
}

public function TicketEmailSettingETemplate(Request $request,$id){
    // return 1;
    // Session::put('TabViews2', 'InvoiceModule');
          $pSe = AppSetting::where('id',1)->first();
          return view('admin.ETemplatesettings.TicketEmailSetting.home',compact('pSe','id'));
}

public function ClientSettingETemplate(Request $request,$id){
    // return 1;
    // Session::put('TabViews2', 'InvoiceModule');
          $pSe = AppSetting::where('id',1)->first();
          return view('admin.ETemplatesettings.ClientSettings.home',compact('pSe','id'));
}
public function OtherModuleETemplate(Request $request,$id){
    // return 1;
    // Session::put('TabViews2', 'InvoiceModule');
          $pSe = AppSetting::where('id',1)->first();
          return view('admin.ETemplatesettings.OtherModule.home',compact('pSe','id'));
}

   


}
