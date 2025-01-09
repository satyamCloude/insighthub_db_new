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
use App\Models\Template;
use App\Models\Security;
use App\Models\User;
use App\Models\AppSetting;
use App\Models\StorageSetting;
use Illuminate\Support\Facades\Storage;
use Hash;
use Auth;
use Session;




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
        $url = url('/') . '/public/images/';
        
        $data = $request->all();
        // return $data;
        $StorageSetting = StorageSetting::find(1);
        $storageLocal = $StorageSetting->status == 0;

        if ($request->hasFile('invoice_logo')) {
            $file = $request->file('invoice_logo');
            if ($storageLocal) {
                $filename = 'invoice_logo' . Str::random(4) . '.' . $file->getClientOriginalExtension();
                $file->move('public/images/', $filename);
                $data['invoice_logo'] = $url . $filename;
            } else {
                $data['invoice_logo'] = $this->Upload($StorageSetting, $filename, $file);
            }
        }

        if ($request->hasFile('autorised_sign')) {
            $file = $request->file('autorised_sign');
            if ($storageLocal) {
                $filename = 'autorised_sign' . Str::random(4) . '.' . $file->getClientOriginalExtension();
                $file->move('public/images/', $filename);
                $data['autorised_sign'] = $url . $filename;
            } else {
                $data['autorised_sign'] = $this->Upload($StorageSetting, $filename, $file);
            }
        }

        if($request->reminder_type == 0){
            $data['send_reminder_before'] = $request->reminder_days;
        }else{
            $data['send_reminder_after'] = $request->reminder_days;
        }

        $data['show_status'] =  $request->show_status ? 1  : 0;
        $data['show_client_name'] =  $request->show_client_name ? 1  : 0;
        $data['show_client_email'] =  $request->show_client_email ? 1  : 0;
        $data['show_client_phone'] =  $request->show_client_phone ? 1  : 0;
        $data['show_client_company_name'] =  $request->show_client_company_name ? 1  : 0;
        $data['show_client_company_address'] =  $request->show_client_company_address ? 1  : 0;
        
        // return $data;
        $invoiceSettings = InvoiceSettings::first();
        if ($invoiceSettings) {
            $invoiceSettings->update($data);
            return redirect()->back()->with('success', "Invoice Settings Updated Successfully");
        } else {
            InvoiceSettings::create($data);
            return redirect()->back()->with('success', "Invoice Settings Created Successfully");
        }

        
    } catch (\Exception $e) {
        return redirect()->back()->with('error', "Error updating Invoice Settings: " . $e->getMessage());
    }
}


    public function Upload($StorageSetting, $fileName, $file)
    {
        config([
            'filesystems.disks.s3.key' => $StorageSetting->AWS_ACCESS_KEY_ID,
            'filesystems.disks.s3.secret' => $StorageSetting->AWS_SECRET_ACCESS_KEY,
            'filesystems.disks.s3.region' => $StorageSetting->AWS_DEFAULT_REGION,
            'filesystems.disks.s3.bucket' => $StorageSetting->AWS_BUCKET,
        ]);

        $basePath = 'images/'.date('y').'/'.date('m').'/' . $fileName;
        
        $path = Storage::disk('s3')->put($basePath, $file);

        $url =  $StorageSetting->S3_BASE_URL. '/' . $path;
        return $url;
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
          $template_data = Template::where('id',$id)->first();
          return view('admin.ETemplatesettings.InvoiceModule.home',compact('pSe','id','template_data'));
}

public function InvoiceModuleETemplateadd(Request $request){
    // return 1;
    // Session::put('TabViews2', 'InvoiceModule');
          $pSe = AppSetting::where('id',1)->first();
          return view('admin.ETemplatesettings.InvoiceModule.Addhome',compact('pSe'));
}

public function QuotesModuleETemplate(Request $request,$id){
    // return 1;
    // Session::put('TabViews2', 'InvoiceModule');
          $pSe = AppSetting::where('id',1)->first();
          $data = Template::where('id',$id)->first();
          return view('admin.ETemplatesettings.QuotesModule.home',compact('pSe','id','data'));
}
public function QuotesModuleETemplateadd(Request $request){
    // return 1;
    // Session::put('TabViews2', 'InvoiceModule');
          $pSe = AppSetting::where('id',1)->first();
          return view('admin.ETemplatesettings.QuotesModule.Addhome',compact('pSe'));
}

public function TicketEmailSettingETemplate(Request $request,$id){
    // return 1;
    // Session::put('TabViews2', 'InvoiceModule');
          $pSe = AppSetting::where('id',1)->first();
          $data = Template::where('id',$id)->first();
          return view('admin.ETemplatesettings.TicketEmailSetting.home',compact('pSe','id','data'));
}

public function TicketEmailSettingadd(Request $request){
    // return 1;
    // Session::put('TabViews2', 'InvoiceModule');
          $pSe = AppSetting::where('id',1)->first();
          return view('admin.ETemplatesettings.TicketEmailSetting.Addhome',compact('pSe'));
}

public function ClientSettingETemplate(Request $request,$id){
    // return 1;
    // Session::put('TabViews2', 'InvoiceModule');
          $pSe = AppSetting::where('id',1)->first();
          return view('admin.ETemplatesettings.ClientSettings.home',compact('pSe','id'));
}

public function ClientSettingETemplateadd(Request $request){
    // return 1;
    // Session::put('TabViews2', 'InvoiceModule');
          $pSe = AppSetting::where('id',1)->first();
          return view('admin.ETemplatesettings.ClientSettings.Addhome',compact('pSe'));
}
public function OtherModuleETemplate(Request $request,$id){
    // return 1;
    // Session::put('TabViews2', 'InvoiceModule');
          $pSe = AppSetting::where('id',1)->first();
          return view('admin.ETemplatesettings.OtherModule.home',compact('pSe','id'));
}

public function LoginRegisterModuleETemplate(Request $request,$id){
    // return 1;
    // Session::put('TabViews2', 'InvoiceModule');
          $pSe = AppSetting::where('id',1)->first();
          $data = Template::where('id',$id)->first();
          return view('admin.ETemplatesettings.LoginRegisterModule.home',compact('pSe','id','data'));
}


public function LoginRegisterModuleETemplateadd(Request $request){
    // return 1;
    // Session::put('TabViews2', 'InvoiceModule');
          $pSe = AppSetting::where('id',1)->first();
          return view('admin.ETemplatesettings.LoginRegisterModule.Addhome',compact('pSe'));
}

public function InOfficeModuleETemplate(Request $request,$id){
    // return 1;
    // Session::put('TabViews2', 'InvoiceModule');
          $pSe = AppSetting::where('id',1)->first();
          $data = Template::where('id',$id)->first();
          return view('admin.ETemplatesettings.InOfficeModule.home',compact('pSe','id','data'));
}


public function InOfficeModuleETemplateadd(Request $request){
    // return 1;
    // Session::put('TabViews2', 'InvoiceModule');
          $pSe = AppSetting::where('id',1)->first();
          return view('admin.ETemplatesettings.InOfficeModule.Addhome',compact('pSe'));
}

   public function InvoiceModuleETemplatestore(Request $request)
{
    $url = url('/').'/public/images/';
    $logo_attachmentname = 'logo_attachment.jpg';

    if ($request->hasFile('documents')) {
        foreach ($request->file('documents') as $key => $file) {
            $rand = Str::random(4);
            $extension = $file->getClientOriginalExtension();
            $logo_attachmentname = 'file_doc_'.$rand.'.'.$extension;
            $file->move('public/images/', $logo_attachmentname);
        }
    }


        $data = $request->all();
        $data['template_type'] = 'InvoiceModule';

            Template::create($data);
      


    // Logging activity
    $agent = new Agent();
    $browser = $agent->browser();
    $version = $agent->version($browser);
    $Log = $request->all();
    $Log['user_id'] = Auth::user()->id;
    $Log['ip'] = $request->ip();
    $Log['subject'] = "Company Data Store By " . Auth::user()->first_name;
    $Log['url'] = url('/') . '/admin/CompanyLogin/store';
    $Log['method'] = "Post";
    $Log['browser'] = $browser . "-" . $version;
    LogActivity::create($Log);
          Session::put('TabViews2', 'InvoiceModule');

    return redirect('admin/ETempleteSettings/home')->with('success', "Template Added Successfully");
}

public function QuotesModuleETemplatestore (Request $request)
{
    $url = url('/').'/public/images/';
    $logo_attachmentname = 'logo_attachment.jpg';

    if ($request->hasFile('documents')) {
        foreach ($request->file('documents') as $key => $file) {
            $rand = Str::random(4);
            $extension = $file->getClientOriginalExtension();
            $logo_attachmentname = 'file_doc_'.$rand.'.'.$extension;
            $file->move('public/images/', $logo_attachmentname);
        }
    }


        $data = $request->all();
        $data['template_type'] = 'QuotesModule';

            Template::create($data);
      


    // Logging activity
    $agent = new Agent();
    $browser = $agent->browser();
    $version = $agent->version($browser);
    $Log = $request->all();
    $Log['user_id'] = Auth::user()->id;
    $Log['ip'] = $request->ip();
    $Log['subject'] = "Company Data Store By " . Auth::user()->first_name;
    $Log['url'] = url('/') . '/admin/CompanyLogin/store';
    $Log['method'] = "Post";
    $Log['browser'] = $browser . "-" . $version;
    LogActivity::create($Log);
          Session::put('TabViews2', 'QuotesModule');

    return redirect('admin/Settings/home')->with('success', "Template Added Successfully");
}


public function TicketEmailSettingstore (Request $request)
{
    $url = url('/').'/public/images/';
    $logo_attachmentname = 'logo_attachment.jpg';

    if ($request->hasFile('documents')) {
        foreach ($request->file('documents') as $key => $file) {
            $rand = Str::random(4);
            $extension = $file->getClientOriginalExtension();
            $logo_attachmentname = 'file_doc_'.$rand.'.'.$extension;
            $file->move('public/images/', $logo_attachmentname);
        }
    }


        $data = $request->all();
        $data['template_type'] = 'TicketModule';

            Template::create($data);
      


    // Logging activity
    $agent = new Agent();
    $browser = $agent->browser();
    $version = $agent->version($browser);
    $Log = $request->all();
    $Log['user_id'] = Auth::user()->id;
    $Log['ip'] = $request->ip();
    $Log['subject'] = "Company Data Store By " . Auth::user()->first_name;
    $Log['url'] = url('/') . '/admin/CompanyLogin/store';
    $Log['method'] = "Post";
    $Log['browser'] = $browser . "-" . $version;
    LogActivity::create($Log);
          Session::put('TabViews2', 'TicketModule');

    return redirect('admin/ETempleteSettings/home')->with('success', "Template Added Successfully");
}




public function LoginRegisterModuleETemplatestore (Request $request)
{
    $url = url('/').'/public/images/';
    $logo_attachmentname = 'logo_attachment.jpg';

    if ($request->hasFile('documents')) {
        foreach ($request->file('documents') as $key => $file) {
            $rand = Str::random(4);
            $extension = $file->getClientOriginalExtension();
            $logo_attachmentname = 'file_doc_'.$rand.'.'.$extension;
            $file->move('public/images/', $logo_attachmentname);
        }
    }


        $data = $request->all();
        $data['template_type'] = 'LoginRegisterModule';

            Template::create($data);
      


    // Logging activity
    $agent = new Agent();
    $browser = $agent->browser();
    $version = $agent->version($browser);
    $Log = $request->all();
    $Log['user_id'] = Auth::user()->id;
    $Log['ip'] = $request->ip();
    $Log['subject'] = "Company Data Store By " . Auth::user()->first_name;
    $Log['url'] = url('/') . '/admin/CompanyLogin/store';
    $Log['method'] = "Post";
    $Log['browser'] = $browser . "-" . $version;
    LogActivity::create($Log);
          Session::put('TabViews2', 'LoginRegisterModule');

    return redirect('admin/ETempleteSettings/home')->with('success', "Template Added Successfully");
}




public function InOfficeModuleETemplatestore (Request $request)
{
    $url = url('/').'/public/images/';
    $logo_attachmentname = 'logo_attachment.jpg';

    if ($request->hasFile('documents')) {
        foreach ($request->file('documents') as $key => $file) {
            $rand = Str::random(4);
            $extension = $file->getClientOriginalExtension();
            $logo_attachmentname = 'file_doc_'.$rand.'.'.$extension;
            $file->move('public/images/', $logo_attachmentname);
        }
    }


        $data = $request->all();
        $data['template_type'] = 'InOfficeModule';

            Template::create($data);
      


    // Logging activity
    $agent = new Agent();
    $browser = $agent->browser();
    $version = $agent->version($browser);
    $Log = $request->all();
    $Log['user_id'] = Auth::user()->id;
    $Log['ip'] = $request->ip();
    $Log['subject'] = "Company Data Store By " . Auth::user()->first_name;
    $Log['url'] = url('/') . '/admin/CompanyLogin/store';
    $Log['method'] = "Post";
    $Log['browser'] = $browser . "-" . $version;
    LogActivity::create($Log);
          Session::put('TabViews2', 'InOfficeModule');

    return redirect('admin/ETempleteSettings/home')->with('success', "Template Added Successfully");
}




}
