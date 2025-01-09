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
use App\Models\OSCategory;
use App\Models\OperatingSysten;
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
use App\Models\HostingControlPanel;
use App\Models\Product;
use App\Models\ProductNew;
use App\Models\MailSettings;
use App\Models\ModuleSetting;
use App\Models\LeaveSettings;
use App\Models\TicketEmailSetting;
use App\Models\ProjectCategory;
use App\Models\Security;
use App\Models\Department;
use App\Models\PaymentDetail;
use Session;
use Hash;
use Auth;
use App\Models\PasswordDays;


class SettingController extends Controller
{
    //home page
    public function home(Request $request)
    {
      if (empty(Session::get('TabViews'))) {
        Session::put('TabViews', 'App');
      }
      if(isset($request->type)){
        Session::put('TabViews', $request->type);
        return redirect('admin/Settings/home');
      }
      return view('admin.settings.index');
    }


    //store page
    public function TabView(Request $request)
    {
      $Currency = Currency::get();
      $Country = Country::get();

      if ($request->type == 'App') {
        Session::put('TabViews', 'App');
        $pSe = AppSetting::where('id', 1)->first();
        return view('admin.settings.AppSettings.home', compact('pSe', 'Currency'));
      }

      if ($request->type == 'Currency') {
        Session::put('TabViews', 'Currency');
        $CurrencySettings = Currency::get();
        $user_details = User::where('id', Auth::user()->id)->first();
        $Complete = MailSettings::select('smtp', 'chimps', 'microsoft')->where('user_id', Auth::user()->id)->where('id', 2)->first();
        return view('admin.settings.CurrencySettings.home', compact('Complete', 'user_details', 'CurrencySettings', 'Country'));
      }

      if ($request->type == 'AddCurrency') {
        Session::put('TabViews', 'Currency');
        $Currency = Currency::get();
        return view('admin.settings.CurrencySettings.create', compact('Currency'));
      }

      if ($request->type == 'Company') {
        Session::put('TabViews', 'Company');
        $CompanyLogin = CompanyLogin::where('user_id', Auth::user()->id)->first();
        return view('admin.settings.CompanySettings.home', compact('CompanyLogin', 'Country'));
      }

      if ($request->type == 'CustomLink') {
        Session::put('TabViews', 'CustomLink');
        $CustomLinkSetting = CustomLinkSetting::get();
        $user_details = User::where('id', Auth::user()->id)->first();
        $Complete = MailSettings::select('smtp', 'chimps', 'microsoft')->where('user_id', Auth::user()->id)->where('id', 2)->first();
        return view('admin.settings.CustomLinkSettings.home', compact('Complete', 'user_details', 'CustomLinkSetting', 'Country'));
      }

      if ($request->type == 'AddCustomLink') {
        Session::put('TabViews', 'AddCustomLink');
        return view('admin.settings.CustomLinkSettings.create');
      }

      if ($request->type == 'File') {
        Session::put('TabViews', 'File');
        $query = Invoice::select('invoices.*', 'users.first_name', 'users.last_name', 'users.profile_img', 'users.email', 'projects.project_name', 'projects.id as projects_id', 'products.product_name', 'products.id as products_id')
          ->leftJoin('users', 'users.id', 'invoices.client_id')
          ->leftJoin('projects', 'projects.id', 'invoices.project_id')
          ->leftJoin('orders', 'orders.invoice_id', '=', 'invoices.id') // Updated join condition
          ->leftJoin('products', 'products.id', 'orders.product_id')
          ->orderBy('invoices.created_at', 'desc');

        $searchTerm = '';
        if ($request->has('search')) {
          $searchTerm = $request->input('search');
          $query->where(function ($q) use ($searchTerm) {
            $q->where('invoices.name', 'like', '%' . $searchTerm . '%')
              ->orWhere('invoices.issue_date', 'like', '%' . $searchTerm . '%')
              ->orWhere('invoices.invoice_number1', 'like', '%' . $searchTerm . '%')
              ->orWhere('invoices.invoice_number2', 'like', '%' . $searchTerm . '%')
              ->orWhere('invoices.due_date', 'like', '%' . $searchTerm . '%')
              ->orWhere('invoices.shipping_address', 'like', '%' . $searchTerm . '%')
              ->orWhere('users.first_name', 'like', '%' . $searchTerm . '%');
          });
        }
        $Invoice = $query->paginate(10);
        $Invoice->appends(['search' => $searchTerm]);
        return view('admin.FileManagement.home', compact('Invoice', 'searchTerm'));
      }

      if ($request->type == 'Invoice') {
        Session::put('TabViews', 'Invoice');
        $chk_exst = InvoiceSettings::first();
        $Bulk = MailSettings::select('smtp', 'chimps', 'microsoft')->where('user_id', Auth::user()->id)->where('id', 1)->first();
        $Complete = MailSettings::select('smtp', 'chimps', 'microsoft')->where('user_id', Auth::user()->id)->where('id', 2)->first();
        return view('admin.settings.InvoiceSettings.home', compact('Complete', 'Bulk', 'chk_exst', 'Country'));
      }

      if ($request->type == 'Logs') {
        Session::put('TabViews', 'Logs');
        $query = LogActivity::orderBy('created_at', 'desc');
        $searchTerm = '';
        // Check if a search term is provided
        if ($request->has('search')) {
          $searchTerm = $request->input('search');
          $query->where(function ($q) use ($searchTerm) {
            $q->where('ip', 'like', '%' . $searchTerm . '%')
              ->orWhere('subject', 'like', '%' . $searchTerm . '%')
              ->orWhere('url', 'like', '%' . $searchTerm . '%')
              ->orWhere('method', 'like', '%' . $searchTerm . '%')
              ->orWhere('browser', 'like', '%' . $searchTerm . '%')
              ->orWhere('created_at', 'like', '%' . $searchTerm . '%');
          });
        }
        $LogActivity = $query->paginate(100);
        $LogActivity->appends(['search' => $searchTerm]);
        return view('admin.settings.LogActivity.home', compact('LogActivity', 'searchTerm'));
      }

      if ($request->type == 'Leads') {
        Session::put('TabViews', 'Leads');
        $chk_exst = InvoiceSettings::first();
        $Bulk = MailSettings::select('smtp', 'chimps', 'microsoft')->where('user_id', Auth::user()->id)->where('id', 1)->first();
        $Complete = MailSettings::select('smtp', 'chimps', 'microsoft')->where('user_id', Auth::user()->id)->where('id', 2)->first();
        $LeadSource = LeadSource::get();
        return view('admin.settings.LeadSettings.home', compact('Complete', 'Bulk', 'chk_exst', 'Country', 'LeadSource'));
      }

      if ($request->type == 'LeaveS') {
        Session::put('TabViews', 'LeaveS');
        $LeaveSettings = LeaveSettings::where('user_id', Auth::user()->id)->first();
        return view('admin.settings.LeaveSettings.home', compact('LeaveSettings'));
      }


      if ($request->type == 'Mail') {
        Session::put('TabViews', 'Mail');
        $MailSet = MailSettings::where('user_id', Auth::user()->id)->first();

        $Bulk = MailSettings::select('smtp', 'chimps', 'microsoft', 'GSuite', 'SES')->where('user_id', Auth::user()->id)->where('id', 1)->first();
        $Complete = MailSettings::select('smtp', 'chimps', 'microsoft', 'GSuite', 'SES')->where('user_id', Auth::user()->id)->where('id', 2)->first();

        return view('admin.settings.MailSettings.home', compact('MailSet','Bulk','Complete'));
      }

      if ($request->type == 'Module') {
        Session::put('TabViews', 'Module');
        $ModuleSetting = ModuleSetting::first();
        return view('admin.settings.ModuleSettings.home', compact('ModuleSetting'));
      }

      if ($request->type == 'Notice') {
        Session::put('TabViews', 'Notice');
        $searchTerm = $request->input('search');

        $Notice = Notice::where(function ($query) use ($searchTerm) {
          $query->where('Applieddate', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('Tilldate', 'LIKE', '%' . $searchTerm . '%')
            ->orWhere('status', 'LIKE', '%' . $searchTerm . '%');
        })
          ->orderBy('created_at', 'desc')
          ->paginate(10);

        $Total = Notice::count();
        $Public = Notice::where('status', 1)->count();
        $Private = Notice::where('status', 2)->count();
        return view('admin.settings.Notice.home', compact('Notice', 'searchTerm', 'Total', 'Public', 'Private'));
      }

      if ($request->type == 'AddNotice') {
        Session::put('TabViews', 'AddNotice');
        return view('admin.settings.Notice.create');
      }

      if ($request->type == 'PaymentMethod') {
        $bankDetails=PaymentDetail::where('payment_mode',1)->first();
        $paypalDetails=PaymentDetail::where('payment_mode',2)->first();
        $cardDetails=PaymentDetail::where('payment_mode',3)->first();
        Session::put('TabViews', 'PaymentMethod');
        return view('admin.settings.PaymentMethod.home',compact('bankDetails','paypalDetails','cardDetails'));
      }

      if ($request->type == 'ProjectCategory') {
        Session::put('TabViews', 'ProjectCategory');
        $ProjectCategory = ProjectCategory::orderBy('created_at', 'desc')->get();
        return view('admin.ProjectCategory.home', compact('ProjectCategory'));
      }

      if ($request->type == 'AddProjectCategory') {
        Session::put('TabViews', 'AddProjectCategory');
        return view('admin.ProjectCategory.create');
      }

      if ($request->type == 'Profile') {
        Session::put('TabViews', 'Profile');
        $chk_exst = InvoiceSettings::first();
        $country = Country::get();
        $user_details = User::where('id', Auth::user()->id)->first();
        $Complete = MailSettings::select('smtp', 'chimps', 'microsoft')->where('user_id', Auth::user()->id)->where('id', 2)->first();
        return view('admin.settings.ProfileSettings.home', compact('Complete', 'user_details', 'chk_exst', 'country'));
      }


      if ($request->type == 'Performance') {
        Session::put('TabViews', 'Performance');
        $PS = PerformanceSettings::where('id', 1)->first();
        return view('admin.settings.PerformanceSettings.home', compact('PS'));
      }

      if ($request->type == 'PayRoll') {
        Session::put('TabViews', 'PayRoll');
        $PayRollSetting = PayRollIncrement::select('users.first_name', 'users.profile_img', 'users.email', 'pay_roll_increments.increment_sallery', 'pay_roll_increments.increment_date', 'pay_roll_increments.Total_salary', 'pay_roll_increments.user_id')
          ->leftjoin('users', 'users.id', 'pay_roll_increments.user_id')
          ->groupBy('pay_roll_increments.user_id')
          ->orderBy('pay_roll_increments.created_at', 'desc')
          ->get();
          
        $Employee = User::select('id', 'first_name')->where('type', 4)->get();

        $PayCron = PayRollSetting::where('id', 1)->first();

        return view('admin.settings.PayRollSetting.home', compact('Employee', 'PayRollSetting', 'PayCron'));
      }

      if ($request->type == 'Role') {
        Session::put('TabViews', 'Role');
        $query = Role::orderBy('id', 'desc');

        $searchTerm = '';

        // Check if a search term is provided
        if ($request->has('search')) {
          $searchTerm = $request->input('search');
          $query->where('name', 'like', '%' . $searchTerm . '%');
        }

        $Role = $query->paginate(10);
        $Role->appends(['search' => $searchTerm]);

        $Total = Role::count();
        $active = Role::where('status', '1')->count();
        $Inactive = Role::where('status', '2')->count();

        return view('admin.settings.Role.home', compact('Role', 'active', 'Inactive', 'Total', 'searchTerm'));
      }

      if ($request->type == 'AddRole') {
        Session::put('TabViews', 'AddRole');
        $Permission = Permission::select('name', 'guard_name', 'id')->get();
        return view('admin.settings.Role.create', compact('Permission'));
      }

      if ($request->type == 'ServiceAutomation') {
        Session::put('TabViews', 'ServiceAutomation');
        $Category = Category::orderBy('created_at', 'desc')->paginate(10);
        return view('admin.settings.Product.home', compact('Category'));
      }

      if ($request->type == 'AddServiceAutomation') {
        Session::put('TabViews', 'AddServiceAutomation');
        $Productype = Producttype::get();
        $Category = Category::get();
        $PaymentMethod = PaymentMethod::get();
        $createdProducts = ProductNew::get();
        $TaxSettings = TaxSetting::get();
        return view('admin.settings.Product.create', compact('Productype', 'Category', 'PaymentMethod', 'createdProducts', 'TaxSettings'));
      }

      if ($request->type == 'SmSEmail') {
        Session::put('TabViews', 'SmSEmail');
        $query = Template::orderBy('created_at', 'desc');
        $searchTerm = '';
        // Check if a search term is provided
        if ($request->has('search')) {
          $searchTerm = $request->input('search');
          $query->where(function ($q) use ($searchTerm) {
            $q->where('User_ip_address', 'like', '%' . $searchTerm . '%')
              ->orWhere('status', 'like', '%' . $searchTerm . '%')
              ->orWhere('id', 'like', '%' . $searchTerm . '%');
          });
        }
        $Template = $query->paginate(200);
        $Template->appends(['search' => $searchTerm]);
        $Total = Template::count();
        $active = Template::where('status', 1)->count();
        $Inactive = Template::where('status', 2)->count();
        return view('admin.settings.Template.home', compact('Template', 'active', 'Inactive', 'searchTerm', 'Total'));
      }

      if ($request->type == 'AddSmSEmail') {
        Session::put('TabViews', 'AddSmSEmail');
        return view('admin.settings.Template.create');
      }

      if ($request->type == 'Security') {
        Session::put('TabViews', 'Security');
        $Bulk = MailSettings::select('smtp', 'chimps', 'microsoft', 'GSuite', 'SES')->where('user_id', Auth::user()->id)->where('id', 1)->first();
        $Complete = MailSettings::select('smtp', 'chimps', 'microsoft', 'GSuite', 'SES')->where('user_id', Auth::user()->id)->where('id', 2)->first();

        return view('admin.settings.SecuritySettings.home', compact('Complete', 'Bulk'));
      }

      if ($request->type == 'SecurityIP') {
        Session::put('TabViews', 'SecurityIP');
        $query = Security::orderBy('created_at', 'desc');

        $searchTerm = '';

        // Check if a search term is provided
        if ($request->has('search')) {
          $searchTerm = $request->input('search');
          $query->where(function ($q) use ($searchTerm) {
            $q->where('User_ip_address', 'like', '%' . $searchTerm . '%')
              ->orWhere('status', 'like', '%' . $searchTerm . '%')
              ->orWhere('id', 'like', '%' . $searchTerm . '%');
          });
        }

        $Security = $query->paginate(10);
        $Security->appends(['search' => $searchTerm]);

        $Total = Security::count();
        $active = Security::where('status', 1)->count();
        $Inactive = Security::where('status', 2)->count();

        return view('admin.settings.Security.home', compact('Security', 'active', 'Inactive', 'searchTerm', 'Total'));
      }

      if ($request->type == 'AddSecurityIP') {
        Session::put('TabViews', 'AddSecurityIP');
        return view('admin.settings.Security.create');
      }

      if ($request->type == 'Storage') {
        Session::put('TabViews', 'Storage');
        $SsT = StorageSetting::where('id', 1)->first();
        return view('admin.settings.StorageSettings.home', compact('SsT'));
      }

      if ($request->type == 'TaskCategory') {
        Session::put('TabViews', 'TaskCategory');
        $TaskCategory = TaskCategory::orderBy('created_at', 'desc')->get();
        return view('admin.TaskCategory.home', compact('TaskCategory'));
      }

      if ($request->type == 'AddTaskCategory') {
        Session::put('TabViews', 'AddTaskCategory');
        return view('admin.TaskCategory.create');
      }

      if ($request->type == 'Tax') {
        Session::put('TabViews', 'Tax');
        $TaxSetting = TaxSetting::get();
        $country = Country::get();
        $user_details = User::where('id', Auth::user()->id)->first();
        $Complete = MailSettings::select('smtp', 'chimps', 'microsoft')->where('user_id', Auth::user()->id)->where('id', 2)->first();
        return view('admin.settings.TaxSettings.home', compact('Complete', 'user_details', 'TaxSetting', 'country'));
      }

      if ($request->type == 'AddTax') {
        Session::put('TabViews', 'AddTax');
        return view('admin.settings.TaxSettings.create');
      }

      if ($request->type == 'TicketEmail') {
        Session::put('TabViews', 'TicketEmail');
        $departments = Department::with('ticketEmailSettings')->get();

        return view('admin.settings.TicketEmailSetting.home', compact('departments'));
      }

      if ($request->type == 'Hosting-Panel') {
        Session::put('TabViews', 'Hosting-Panel');
        $host = HostingControlPanel::get();
        // return $host;
        return view('admin.settings.HostingPanel.home', compact('host'));
      }


      if($request->type == 'Template'){
        
        Session::put('TabViews', 'Template');
        $TicketModule = Template::where('template_type','TicketModule')->orderBy('id','desc')->get();
        $QuotesModule = Template::where('template_type','QuotesModule')->orderBy('id','desc')->get();
        $InvoiceModule = Template::where('template_type','InvoiceModule')->orderBy('id','desc')->get();
        $TicketModule = Template::where('template_type','TicketModule')->orderBy('id','desc')->get();
        $ClientModule = Template::where('template_type','ClientModule')->orderBy('id','desc')->get();
        $OtherModule = Template::where('template_type','OtherModule')->orderBy('id','desc')->get();
        $LoginRegisterModule = Template::where('template_type','LoginRegisterModule')->orderBy('id','desc')->get();
        $InOfficeModule = Template::where('template_type','InOfficeModule')->orderBy('id','desc')->get();
        return view('admin.ETemplatesettings.index', compact('InvoiceModule','QuotesModule','TicketModule','TicketModule','ClientModule','OtherModule','LoginRegisterModule','InOfficeModule'));
      }
      
      if ($request->type == 'operatingsystem') {
          Session::put('TabViews', 'operatingsystem');
          $Currency = Currency::get(); // Corrected variable name to lowercase
          $categories = Category::orderBy('created_at', 'desc')->get(); // Corrected variable name to lowercase
          $OperatingSystem = OperatingSysten::orderBy('created_at', 'desc')->get(); // Corrected variable name to camelCase

          $OS = OSCategory::leftJoin('categories', 'categories.id', 'o_s_categories.category_id')
              ->leftJoin('operating_systens', 'operating_systens.id', 'o_s_categories.os_id') // Corrected table name to 'operating_systens'
              ->select('o_s_categories.*', 'categories.category_name', 'operating_systens.ostype as os_name', 'operating_systens.image')
              ->get();
          
          return view('admin.settings.Product.operatingsystem', compact('OS', 'categories', 'OperatingSystem','Currency')); // Corrected variable names in compact
      }
    }

    public function smtpDetails($id){
      // return $id;
      $smtpDetails = TicketEmailSetting::where('department_id',$id)->first();
      return $smtpDetails;
    }
    //////SHOW PRODUCT CATEGORYWISE
    public function categoryWise(Request $request)
    {
      if ($request->type == 'category') {
        // $Category = Category::orderBy('created_at', 'desc')->get();
        // return $Category;
        $categories = Category::with(['product' => function ($query) {
              $query->join('producttypes', 'producttypes.id', '=', 'product_news.product_type_id')
                    ->select('product_news.id', 'product_news.product_name','product_news.payment_type', 'producttypes.name', 'product_news.category_id')
                    ->orderBy('product_news.created_at', 'desc');
          }])->get();
                            // return $categories;

        return view('admin.settings.Product.productCategory', compact('categories'));
      }

      if ($request->type == 'product') {
        $Category = ProductNew::select('product_news.id', 'product_news.product_name', 'producttypes.name')
                  ->join('producttypes', 'producttypes.id', 'product_news.product_type_id')
                  ->get();
                  //  return $Category;
        return view('admin.settings.Product.homeProduct', compact('Category'));
      }

      // if ($request->type == 'addOnProduct') {
      //   $Category = ProductNew::select('product_add_ons.id', 'product_news.product_name as Pname', 'product_add_ons.product_name as addOnProduct')->join('product_add_ons', 'product_news.id', 'product_add_ons.product_id')->where('product_add_ons.deleted_at', null)->get();
      //   return view('admin.settings.Product.addOnProduct', compact('Category'));
      // }

      if ($request->type == 'operatingsystem') {
          $Currency = Currency::get(); // Corrected variable name to lowercase
          $categories = Category::orderBy('created_at', 'desc')->get(); // Corrected variable name to lowercase
          $OperatingSystem = OperatingSysten::orderBy('created_at', 'desc')->get(); // Corrected variable name to camelCase

          $OS = OSCategory::leftJoin('categories', 'categories.id', 'o_s_categories.category_id')
              ->leftJoin('operating_systens', 'operating_systens.id', 'o_s_categories.os_id') // Corrected table name to 'operating_systens'
              ->select('o_s_categories.*', 'categories.category_name', 'operating_systens.ostype as os_name')
              ->get();
          
          return view('admin.settings.Product.operatingsystem', compact('OS', 'categories', 'OperatingSystem','Currency')); // Corrected variable names in compact
      }

    }

    public function updatePasswordDays(Request $request)
    {
        $validatedData = $request->validate([
            'password_security_days' => 'required|in:0,1',
        ]);
    
        try {

            // Save or update the record
            $passwordDays = PasswordDays::firstOrNew(['id' => 1]);
            $passwordDays->password_security_days = $validatedData['password_security_days'];
            $passwordDays->days = $validatedData['password_security_days'] == 0 ? 60 : 90;
    
            $passwordDays->save();
    
            return response()->json(['success' => true, 'message' => 'Password security days updated successfully.']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'An error occurred while updating the password days.']);
        }
    }
    
}
