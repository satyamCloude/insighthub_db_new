<?php

namespace App\Http\Controllers\admin;

use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;   
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use Illuminate\Support\Str;
use App\Models\CompanyLogin;
use App\Models\StorageSetting;
use App\Models\LeadSource;
use App\Models\AppSetting;
use App\Models\Template;
use App\Models\TaskCategory;
use App\Models\Currency;
use App\Models\Country;
use App\Models\CustomLinkSetting;
use App\Models\Role;
use App\Models\Permission;
use App\Models\PayRollSetting;
use App\Models\PayRollIncrement;
use App\Models\PerformanceSettings;
use App\Models\Invoice;
use App\Models\User;
use App\Models\Notice;
use App\Models\InvoiceSettings;
use App\Models\PaymentMethod;
use App\Models\TaxSetting;
use App\Models\Producttype;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductNew;
use App\Models\MailSettings;
use App\Models\ModuleSetting;
use App\Models\LeaveSettings;
use App\Models\TicketEmailSetting;
use App\Models\ProjectCategory;
use App\Models\Security;
use Session;
use Hash;
use Auth;


class ETemplateSettingController extends Controller
{   
    //home page
public function home(Request $request)
{

    $TicketModule = Template::where('template_type','TicketModule')->orderBy('id','desc')->get();
    $QuotesModule = Template::where('template_type','QuotesModule')->orderBy('id','desc')->get();
    $InvoiceModule = Template::where('template_type','InvoiceModule')->orderBy('id','desc')->get();
    $TicketModule = Template::where('template_type','TicketModule')->orderBy('id','desc')->get();
    $ClientModule = Template::where('template_type','ClientModule')->orderBy('id','desc')->get();
    $OtherModule = Template::where('template_type','OtherModule')->orderBy('id','desc')->get();
    return view('admin.ETemplatesettings.index', compact('InvoiceModule','QuotesModule','TicketModule','TicketModule','ClientModule','OtherModule'));
}




    //store page
    public function TabView(Request $request)
    {
        $Currency = Currency::get();
        $Country = Country::get();
        
        if($request->type == 'InvoiceModule')
        {
          Session::put('TabViews2', 'InvoiceModule');
          $pSe = AppSetting::where('id',1)->first();
          
          return view('admin.ETemplatesettings.InvoiceModule.home',compact('pSe','Currency'));
        }
        if($request->type == 'QuotesModule')
        {
            Session::put('TabViews2', 'QuotesModule');
            $CurrencySettings = Currency::get();
            $user_details = User::where('id',Auth::user()->id)->first();
            $Complete = MailSettings::select('smtp','chimps','microsoft')->where('user_id',Auth::user()->id)->where('id',2)->first();
            return view('admin.ETemplatesettings.QuotesModule.home', compact('Complete','user_details','CurrencySettings','Country'));
        }
       if($request->type == 'Ticket')
        {
            Session::put('TabViews2', 'Ticket');
           
            return view('admin.ETemplatesettings.TicketEmailSetting.home');
        }
    }
    //home page
public function InvoiceModuleStore(Request $request,$id)
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

        $check_module = Template::find($id);

        $data = $request->all();
        $data['template_type'] = 'InvoiceModule';

        if ($check_module) {
            $check_module->update($data);
        } else {
            Template::create($data);
        }


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

public function QuotesModuleStore(Request $request,$id)
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

        $check_module = Template::where('template_type', 'QuotesModule')->first();

        $data = $request->all();
        $data['template_type'] = 'QuotesModule';

        if ($check_module) {
            $check_module->update($data);
        } else {
            Template::create($data);
        }


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

    return redirect('admin/ETempleteSettings/home')->with('success', "Template Added Successfully");
}

public function TicketModuleStore(Request $request,$id)
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

        $check_module = Template::where('template_type', 'TicketModule')->first();

        $data = $request->all();
        $data['template_type'] = 'TicketModule';

        if ($check_module) {
            $check_module->update($data);
        } else {
            Template::create($data);
        }


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

public function ClientModuleStore(Request $request,$id)
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

        $check_module = Template::where('template_type', 'ClientModule')->first();

        $data = $request->all();
        $data['template_type'] = 'ClientModule';

        if ($check_module) {
            $check_module->update($data);
        } else {
            Template::create($data);
        }


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
          Session::put('TabViews2', 'ClientModule');

    return redirect('admin/ETempleteSettings/home')->with('success', "Template Added Successfully");
}

public function OtherModuleStore(Request $request,$id)
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

        $check_module = Template::where('template_type', 'OtherModule')->first();

        $data = $request->all();
        $data['template_type'] = 'OtherModule';

        if ($check_module) {
            $check_module->update($data);
        } else {
            Template::create($data);
        }


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
          Session::put('TabViews2', 'OtherModule');

    return redirect('admin/ETempleteSettings/home')->with('success', "Template Added Successfully");
}

//////SHOW PRODUCT CATEGORYWISE
public function categoryWise(Request $request)
{
    if($request->type == 'category')
        {
           $Category = Category::orderBy('created_at', 'desc')->paginate(10);
            return view('admin.settings.Product.productCategory', compact('Category'));
        }

        if($request->type == 'product')
        {
            $Category = ProductNew::select('product_news.id','product_news.product_name','producttypes.name')->join('producttypes','producttypes.id','product_news.product_type_id')->get();
            return view('admin.settings.Product.homeProduct', compact('Category'));
        }
}
}
