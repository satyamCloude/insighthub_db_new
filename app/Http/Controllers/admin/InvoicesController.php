<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use App\Exports\InventoryExport;
use App\Exports\InvoiceExport;
use App\Models\OperatingSysten;
use App\Models\PaymentMethod;
use App\Models\LogActivity;
use App\Models\CompanyLogin;
use App\Models\IPAddress;
use App\Models\ProductNew;
use App\Models\clientDetails;
use App\Models\Project;
use App\Models\EmployeeDetail;
use App\Models\OsOrder;
use App\Models\Inventory;
use App\Models\Orders;
use App\Models\AddOnProductCart;
use App\Models\Invoice;
use App\Models\TaxSetting;
use App\Models\Category;
use App\Models\Transaction;
use App\Models\Countrys;
use App\Models\ClientDetail;
use App\Models\Ticket;
use App\Models\Employee;
use App\Models\Currency;
use App\Models\Firewall;
use App\Models\Product;
use App\Models\ProductAddOn;
use App\Models\InvoiceSettings;
use App\Models\Switchs;
use App\Models\Status;
use App\Models\User;
use App\Models\Rack;
use App\Models\AddonOrder;
use App\Models\ProductPricing;
use App\Models\BareMetal;
use App\Models\CloudHosting;
use App\Models\CloudServices;
use App\Models\DedicatedServer;
use App\Models\AwsService;
use App\Models\Azure;
use App\Models\GoogleWorkSpace;
use App\Models\MicrosoftOffice365;
use App\Models\OneTimeSetup;
use App\Models\MonthelySetup;
use App\Models\SSLCertificate;
use App\Models\Antivirus;
use App\Models\Licenses;
use App\Models\Acronis;
use App\Models\TsPlus;
use App\Models\MailSettings;
use App\Models\Template;
use App\Models\Credit;
use App\Mail\InvoicePaymentConfirmation;
use App\Mail\InvoiceGenerated;
use App\Mail\InvoiceReminder;
use Maatwebsite\Excel\Facades\Excel;
use Jenssegers\Agent\Agent;
use ZipArchive;
use Validator;
use DateTime;
use Hash;
use Auth;
use View;
use PDF;
use DB;

class InvoicesController extends Controller
{
  //home page
   public function home(Request $request)
   {
        $fDate = $request->filled('fDate') ? $request->fDate : date('m/d/Y');
        $tDate = $request->filled('tDate') ? $request->tDate : date('m/d/Y');
        $cName = $request->filled('cName') ? $request->cName : '';
        $status = $request->filled('status') ? $request->status : '';
        $invoiceId = $request->filled('invoiceId') ? $request->invoiceId : '';
    
        $query = Invoice::select(
            'invoices.*',
            'currencies.prefix',
            'orders.quantity',
            'users.first_name',
            'users.last_name',
            'users.id as users_id',
            'users.company_name as comp_name',
            'users.profile_img',
            'users.email',
            'projects.project_name',
            'projects.id as projects_id',
            'product_news.product_name',
            'product_news.id as products_id',
            'company_logins.company_name',
            'roles.name as post_name'
        )
        ->leftJoin('users', 'users.id', 'invoices.client_id')
        ->leftJoin('projects', 'projects.id', 'invoices.project_id')
        ->leftJoin('orders', 'orders.invoice_id', '=', 'invoices.id')
        ->leftJoin('product_news', 'product_news.id', 'orders.product_id')
        ->leftJoin('client_details', 'client_details.user_id', 'users.id')
        ->leftJoin('company_logins', 'company_logins.id', 'client_details.company_id')
        ->leftJoin('roles', 'roles.id', 'client_details.role_id')
        ->leftJoin('currencies', 'currencies.id', 'invoices.currency')
        ->orderBy('invoices.created_at', 'desc');

        if ($request->filled('fDate') && $request->filled('tDate')) {
          $query->whereBetween('invoices.created_at', [$fDate, $tDate]);
        }
    
        if ($request->filled('cName')) {
          $query->where('users.first_name', $cName);
        }
    
        if ($request->filled('status')) {
          $query->where('invoices.is_payment_recieved', $status);
        }
        if ($request->filled('invoiceId')) {
          $query->where('invoices.id', $invoiceId);
        }
    
        $Invoice = $query->groupBy('invoices.id')->paginate(10);
        $Invoice->appends($request->query());
        $currencies = Currency::all(); // Fetch all currencies
        $result = [];
        foreach ($currencies as $currency) {
            $query = DB::table('invoices')
            ->selectRaw("
                SUM(CASE WHEN paid_amount > 0 THEN paid_amount ELSE 0 END) AS total_paid,
                SUM(CASE WHEN is_payment_recieved = 0 THEN final_total_amt - paid_amount ELSE 0 END) AS total_unpaid,
                SUM(CASE WHEN is_payment_recieved = 0 AND due_date < CURRENT_DATE() THEN final_total_amt-paid_amount ELSE 0 END) AS total_due
            ")
            ->where('invoices.deleted_at',null)
            ->where('currency', $currency->id);
    
            // Apply filters
            if ($request->filled('fDate') && $request->filled('tDate')) {
                $query->whereBetween('invoices.created_at', [$fDate, $tDate]);
            }
    
            $result[$currency->code] = $query->first();
        }
        $default_currency = Currency::where('is_default', 1)->first();
        
       
        
        return view('admin.Invoices.home', compact('Invoice', 'result', 'fDate', 'tDate', 'cName', 'status', 'default_currency', 'currencies', 'invoiceId'));
    }
    


  
  public function selectedCurrencyData(Request $request)
  {
    $selectedCurrencyId = $request->selectedCurrencyId;
    $currencyData = Currency::find($selectedCurrencyId);
    return response(['status' => true, 'data' => $currencyData, 'currency_id' => $selectedCurrencyId]);
  }
  public function get_product_price(Request $request)
  {
        
        $numberCount = $request->numberCount;
        $Tax = TaxSetting::get();
        
        $productDetails = ProductNew::join('product_pricing', 'product_pricing.product_id', 'product_news.id')
          ->leftJoin('tax_settings', 'tax_settings.id', '=', 'product_news.tax_id')
          ->where('product_news.id', $request->product_id)
          ->select('product_pricing.price', 'tax_settings.rate', 'tax_settings.tax_name', 'tax_settings.id as taxId', 'product_news.id as proId', 'product_news.product_name', 'product_news.description')->first();
        return view('admin.Invoices.showAppendDiv', compact('productDetails', 'Tax', 'numberCount'));
        
  }

  public function get_project_details(Request $request)
  {
    // code...
    $numberCount = $request->numberCount;
    $Tax = TaxSetting::get();
    $projectDetails = Project::find($request->project_id);
    return view('admin.Invoices.appendProjectDiv', compact('projectDetails', 'Tax', 'numberCount'));
  }

  public function getClientDetails($id)
  {
    $client = User::join('client_details', 'users.id', 'client_details.user_id')
      ->where('users.id', $id)
      ->select('client_details.*')
      ->first();
    return response()->json(['data' => $client, 'success' => true]);
  }
  
public function getEmployeeDetails($id)
  {
    $client = User::leftjoin('employee_details', 'users.id', 'employee_details.user_id')
      ->where('users.id', $id)
      ->select('employee_details.*')
      ->first();
    return response()->json(['data' => $client, 'success' => true]);
  }
  
  public function check_invoice_number(Request $request)
  {
    $invoice_number2 = $request->invoice_number2;
    $check_invoice_number2 = Invoice::where('invoice_number2', $invoice_number2)->latest();

      if ($check_invoice_number2) {
        return response()->json(['status' => false, 'message' => 'Invoice Number already taken', 'data' => $check_invoice_number2, 'invoice_number2' => $invoice_number2]);
      } else {
        return response()->json(['status' => true, 'message' => 'New Invoice Number', 'data' => null, 'invoice_number2' => $invoice_number2]);
      }
  }
  public function get_selected_product_plan(Request $request)
  {
    $selectedServiceId = $request->selectedServiceId;
    $selectedClientId = $request->selectedClientId;
    $check_plan = Orders::where('product_id', $selectedServiceId)->where('client_id', $selectedClientId)->select('services_type', 'id')->count();

      if ($check_plan > 0) {
        $get_plans = Orders::where('product_id', $selectedServiceId)->where('client_id', $selectedClientId)->select('services_type', 'id')->get();
        return response()->json(['status' => true, 'message' => 'Data Found Successfully', 'data' => $get_plans, 'selectedServiceId' => $selectedServiceId, 'selectedClientId' => $selectedClientId]);
      } else {
        return response()->json(['status' => false, 'message' => 'Data Not Found', 'data' => null, 'selectedServiceId' => $selectedServiceId, 'selectedClientId' => $selectedClientId]);
      }
  }
  public function showgst(Request $request) {
    // Retrieve filter parameters with defaults
    $fDate = $request->filled('fDate') ? $request->fDate : date('m/d/Y');
    $tDate = $request->filled('tDate') ? $request->tDate : date('m/d/Y');
    $cName = $request->cName ?? '';
    $status = $request->status ?? '';
    $ClientId = $request->ClientId ?? '';
    $invoiceId = $request->invoiceId ?? '';

    // Build the query
    $query = Invoice::select('invoices.*', 'currencies.prefix', 'users.first_name', 'users.last_name', 'users.profile_img', 'users.company_name as companys_name', 'users.id as users_id', 'users.email', 'projects.project_name', 'projects.id as projects_id', 'product_news.product_name', 'product_news.id as products_id', 'company_logins.company_name', 'roles.name as post_name', 'orders.taxes', 'orders.amtWithoutGST')
        ->leftJoin('users', 'users.id', '=', 'invoices.client_id')
        ->leftJoin('projects', 'projects.id', '=', 'invoices.project_id')
        ->leftJoin('orders', 'orders.invoice_id', '=', 'invoices.id')
        ->leftJoin('product_news', 'product_news.id', '=', 'orders.product_id')
        ->leftJoin('client_details', 'client_details.user_id', '=', 'users.id')
        ->leftJoin('company_logins', 'company_logins.id', '=', 'client_details.company_id')
        ->leftJoin('roles', 'roles.id', '=', 'client_details.role_id')
        ->leftJoin('currencies', 'currencies.id', '=', 'invoices.currency')
        ->where('orders.taxes', '>', 0)
        ->where('invoices.is_payment_recieved', 1)
        ->groupBy('invoices.id')
        ->orderBy('invoices.created_at', 'desc');

    // Apply filters
    if (!empty($cName)) {
        $query->where('users.first_name', 'like', '%' . $cName . '%');
    }

    if (!empty($status)) {
        $query->where('invoices.is_payment_recieved', $status);
    }

    if (!empty($invoiceId)) {
        $query->where('invoices.id', $invoiceId);
    }

    if (!empty($ClientId)) {
        $query->where('invoices.client_id', $ClientId);
    }

    // Execute the query with pagination
    $Invoice = $query->distinct()->paginate(10);

    // Retrieve active tax settings
    $taxes = TaxSetting::where('status', 1)->get();

    // Return the view with the data
    return view('admin.Invoices.gst', compact('Invoice', 'taxes', 'fDate', 'tDate', 'cName', 'ClientId', 'status'));
}

public function showtds(Request $request) {
    // Retrieve filter parameters with defaults
    $fDate = $request->filled('fDate') ? $request->fDate : date('m/d/Y');
    $tDate = $request->filled('tDate') ? $request->tDate : date('m/d/Y');
    $cName = $request->cName ?? '';
    $status = $request->status ?? '';
    $ClientId = $request->ClientId ?? '';
    $invoiceId = $request->invoiceId ?? '';

    // Build the query
    $query = Invoice::select('invoices.*', 'currencies.prefix', 'users.first_name', 'users.last_name', 'users.profile_img', 'users.company_name as companys_name', 'users.id as users_id', 'users.email', 'projects.project_name', 'projects.id as projects_id', 'product_news.product_name', 'product_news.id as products_id', 'company_logins.company_name', 'roles.name as post_name')
        ->leftJoin('users', 'users.id', '=', 'invoices.client_id')
        ->leftJoin('projects', 'projects.id', '=', 'invoices.project_id')
        ->leftJoin('orders', 'orders.invoice_id', '=', 'invoices.id')
        ->leftJoin('product_news', 'product_news.id', '=', 'orders.product_id')
        ->leftJoin('client_details', 'client_details.user_id', '=', 'users.id')
        ->leftJoin('company_logins', 'company_logins.id', '=', 'client_details.company_id')
        ->leftJoin('roles', 'roles.id', '=', 'client_details.role_id')
        ->leftJoin('currencies', 'currencies.id', '=', 'invoices.currency')
        ->where('invoices.tds_percent', '>', 0)
        ->where('invoices.is_payment_recieved', 1)
        ->groupBy('invoices.id')
        ->orderBy('invoices.created_at', 'desc');

    // Apply filters
    if (!empty($cName)) {
        $query->where('users.first_name', 'like', '%' . $cName . '%');
    }

    if (!empty($status)) {
        $query->where('invoices.is_payment_recieved', $status);
    }

    if (!empty($invoiceId)) {
        $query->where('invoices.id', $invoiceId);
    }

    if (!empty($ClientId)) {
        $query->where('invoices.client_id', $ClientId);
    }

    // Execute the query with pagination
    $Invoice = $query->distinct()->paginate(10);

    // Return the view with the data
    return view('admin.Invoices.tds', compact('Invoice', 'fDate', 'tDate', 'cName', 'ClientId', 'status'));
}





  public function Create(Request $request)
  {
    $agent = new Agent();
    $browser = $agent->browser();
    $version = $agent->version($browser);
    $Log = $request->all();
    $Log['user_id'] = Auth::user()->id;
    $Log['type'] = 'invoice';
    $Log['ip'] = $request->ip();
    $Log['subject'] = "Invoices Create Page is View By " . Auth::user()->first_name;
    $Log['url'] = url('/') . '/admin/Invoices/Create';
    $Log['method'] = "Get";
    $Log['browser'] = $browser . "-" . $version;

    LogActivity::create($Log);
    
    $Company = CompanyLogin::where('company_name', '!=', '')->select('company_name', 'id')->get();
    $billing_address = CompanyLogin::where('user_id', Auth::user()->id)->first();
    $Tax = TaxSetting::get();
    $default_currency = Currency::where('is_default', 1)->first();
    $orders = Orders::get();
    $currencies = Currency::get();
    $Services = Category::select('category_name', 'id','faIcon')->get();
    $ProductNews = ProductNew::get();
    $Vendor = User::select('id', 'first_name')->where('type', '3')->get();
    $Employee = User::select('first_name', 'id')->where('type', 4)->get();
    $Client = User::select('first_name', 'last_name', 'id', 'profile_img','company_name')->where('type', 2)->get();
    $Project = Project::where('status_id', 1)->get();
    if ($request->order_id && $request->order_id > 0) {
      $selected_order_id = $request->order_id;
      $SelectedOrders = Orders::leftJoin('product_news', 'product_news.id', '=', 'orders.product_id')
        ->where('orders.id', $request->order_id)
        ->select('orders.*', 'product_news.product_name', 'product_news.description as products_desc')
        ->first();
    } else {
      $selected_order_id = 0;
      $SelectedOrders = null;
    }
    $invoice_number2 = Invoice::max('invoice_number2');
    $invoice_number2 = (int)$invoice_number2 + 1;

    return view('admin.Invoices.create', compact('Vendor', 'orders', 'default_currency', 'Employee', 'Project', 'ProductNews', 'Client', 'Services', 'currencies', 'Company', 'Tax', 'billing_address', 'invoice_number2', 'SelectedOrders', 'selected_order_id'));
  }

  //edit
  public function edit(Request $req, $id)
  {
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['type'] = 'invoice';
        $Log['subject'] = "Invoices Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Invoices/edit/' . $id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);
        $Client = User::select('first_name', 'id')->where('type', 2)->get();
        $Project = Project::where('status_id', 1)->get();
        $Company = CompanyLogin::select('id', 'company_name')->where('user_id', Auth::user()->id)->first();
    
            $Inventory = DB::table('invoices')
            ->leftJoin('orders', 'orders.invoice_id','invoices.id')
            ->where('invoices.id', $id)
            ->select(
                'invoices.*',
                'orders.product_id',
                'orders.id as order_id',
                'orders.tds_percent',
                'orders.productCategoryId',
                'orders.amtWithoutGST',
                'orders.is_payment_recieved',
                'orders.quantity',
                'orders.taxes',
                'orders.bank_account',
                'orders.amount',
                'orders.billing_cycle'
            )
            ->first(); 

            $productDetails = ProductNew::join('product_pricing', 'product_pricing.product_id', 'product_news.id')
              ->leftJoin('tax_settings', 'tax_settings.id', '=', 'product_news.tax_id')
              ->leftJoin('currencies', 'currencies.id', 'product_pricing.currency_id')
              ->where('product_news.id', $Inventory->product_id)
              ->where('currencies.id', $Inventory->currency)
              ->select('product_pricing.price', 'tax_settings.rate', 'tax_settings.tax_name', 'tax_settings.id as taxId', 'product_news.id as proId', 'product_news.product_name', 'product_news.description')->first();

            $addonOrders = AddonOrder::join('product_news', 'product_news.id', 'addon_orders.addon_id')
            ->join('product_pricing', 'product_news.id', 'product_pricing.product_id')
            ->leftJoin('tax_settings', 'addon_orders.tax', 'tax_settings.id')
            ->where('order_id', $Inventory->order_id)
            ->where('product_pricing.currency_id', $Inventory->currency)
            ->select('addon_orders.*', 'product_news.product_name', 'product_news.description', 'product_pricing.price', 'tax_settings.rate')
            ->groupBy('addon_orders.id')
            ->get();
                        // return $addonOrders ;

            if(count($addonOrders) > 0){
                $numberCount = count($addonOrders)+1;
            }else{
                $numberCount = 1;
            }
            
            $Tax = TaxSetting::get();
            
            
            
          
            $Vendor = User::select('id', 'first_name')->where('type', '3')->get();
            $Employee = User::select('first_name', 'id')->where('type', 4)->get();
            $billing_address = CompanyLogin::where('user_id', Auth::user()->id)->first();
            $Tax = TaxSetting::get();
            $default_currency = Currency::where('is_default', 1)->first();
            $orders = Orders::get();
            $currencies = Currency::get();
            $Services = Category::select('category_name', 'id','faIcon')->get();
            $ProductNews = ProductNew::get();
            $Vendor = User::select('id', 'first_name')->where('type', '3')->get();
            $Employee = User::select('first_name', 'id')->where('type', 4)->get();
            $Client = User::select('first_name', 'last_name', 'id', 'profile_img','company_name')->where('type', 2)->get();
            $Project = Project::where('status_id', 1)->get();
            if ($req->order_id && $req->order_id > 0) {
              $selected_order_id = $req->order_id;
              $SelectedOrders = Orders::leftJoin('product_news', 'product_news.id', '=', 'orders.product_id')
                ->where('orders.id', $req->order_id)
                ->select('orders.*', 'product_news.product_name', 'product_news.description as products_desc')
                ->first();
            } else {
              $selected_order_id = 0;
              $SelectedOrders = null;
            }
            $invoice_number2 = Invoice::max('invoice_number2');
            $invoice_number2 = (int)$invoice_number2 + 1;
            
            

    return view('admin.Invoices.edit', compact('Inventory', 'Vendor','addonOrders', 'Employee','productDetails','Tax','numberCount', 'id', 'Client','Tax', 'Project', 'Company','invoice_number2','selected_order_id','currencies','billing_address','SelectedOrders','Company','Services','ProductNews'));
  }

  public function store(Request $req)
  {
    // return $req->applied_tax;
  //  return $req->all();
    $validator = Validator::make($req->all(), [
      'invoice_number1' => 'required',
      'client_id' => 'required',
      'final_total_amt' => 'required',
      'invoice_number2' => 'required|unique:invoices,invoice_number2',
    ], [
      'invoice_number2.unique' => 'Invoice number : ' . $req->invoice_number2 . ' is already taken.',
      'final_total_amt.required' => 'Total amount can not be empty.',
    ]);

    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator)->withInput();
    }


    $url = url('/') . '/public/images/';
    $invoice_attachment = 'default_bill_attachment.jpg';
    if ($req->hasFile('invoice_attachment')) {
      $rand = Str::random(4);
      $file = $req->file('invoice_attachment');
      $extension = $file->getClientOriginalExtension();
      $invoice_attachment = 'bill_' . $rand . '.' . $extension;
      $file->move('public/images/', $invoice_attachment);
    }
    $currency = Currency::where('is_default','1')->first();
    $user_id = Auth::user()->id;
    // return $req->product_id;
    if (isset($req->product_id) && count($req->product_id) > 0) {
      $productPrice = ProductPricing::where('product_id', $req->product_id[0])->value('price');
      $newOrder = new Orders();
      $newOrder->product_id = $req->product_id[0];
      $newOrder->currency = $currency->id;
      $newOrder->project_id = $req->project_id;
      $newOrder->client_id = $req->client_id;
      $newOrder->taxes = isset($req->taxes2) ? implode(',',$req->taxes2) : 0;
      $newOrder->quantity = isset($req->quantity[0]) ? $req->quantity[0] : 1;
      $newOrder->amount = $req->cost_per_items[0];
      // $newOrder->amtWithoutGST = 0;
      $newOrder->total_amt = $req->final_total_amt;
      $newOrder->issue_date = now();
      $newOrder->user_id = Auth::user()->id;
      $newOrder->save();

      if (count($req->product_id) > 1) {
        // Convert the request data to a standard PHP array
        $productIds = $req->product_id;
        // Remove the first element from the array
        array_shift($productIds);

        foreach ($productIds as $key => $value) {
          $taxVar = 'taxes'.$key+3;
          $orderAddon = new AddonOrder;
          $orderAddon->user_id = $user_id;
          $orderAddon->order_Id = $newOrder->id;
          $orderAddon->product_id =  isset($req->product_id[$key + 1]) ? $req->product_id[$key + 1] : 1;
          $orderAddon->addon_id = $value;
          $orderAddon->quantity = isset($req->quantity[$key + 1]) ? $req->quantity[$key + 1] : 1;
          $orderAddon->tax = isset($req->$taxVar) ? implode(',', $req->$taxVar) : 0;
          $orderAddon->price = count($req->cost_per_items) > 1 ? $req->cost_per_items[$key + 1] : 0;
          $orderAddon->save();
          if ($req->bank_account == 2 && $req->project_id == '') {

            $billing_cycle = $req->billing_cycle;
            $product_id = $value;
            $get_prod = ProductNew::find($product_id);
            $get_plan = ProductPricing::find($billing_cycle);
            $category_id = $get_prod->category_id;
            // Mapping category IDs to class names
           
            $classMap = [
              4 => BareMetal::class,
              5 => CloudHosting::class,
              6 => CloudServices::class,
              7 => DedicatedServer::class,
              8 => AwsService::class,
              9 => Azure::class,
              10 => GoogleWorkSpace::class,
              11 => MicrosoftOffice365::class,
              12 => OneTimeSetup::class,
              13 => MonthelySetup::class,
              14 => SSLCertificate::class,
              15 => Antivirus::class,
              16 => Licenses::class,
              17 => Acronis::class,
              18 => TsPlus::class,
              25 => Switchs::class,
              26 => Firewall::class,
            ];

            $class = $classMap[$get_prod->category_id] ?? BareMetal::class;

            $add_service_data = new $class;
            $add_service_data->user_id = Auth::user()->id;
            $add_service_data->customer_id = Auth::user()->id;
            $add_service_data->product_id = $product_id;
            // $add_service_data->host_domain_name = $req->hostname;
            // $add_service_data->os_id = $order->os_id;
            $add_service_data->service_type = $req->service_type ?? 1;
            $add_service_data->billing_cycle = $req->billingcycle ?? '2';
            $add_service_data->payment_method_id = $req->bank_account;
            $add_service_data->signup_date = date('Y-m-d');

            if ($billing_cycle == 2) {
              $add_service_data->next_due_date = date('Y-m-d');
            } else {
              $plan_type = $get_prod->plan_type;
              if ($get_plan && $get_plan->product_plan == 3) {

                switch ($plan_type) {
                  case 'triennially':
                    $add_days = 1095;
                    break;
                  case 'biennially':
                    $add_days = 730;
                    break;
                  case 'annually':
                    $add_days = 365;
                    break;
                  case 'semiannually':
                    $add_days = 150;
                    break;
                  case 'quarterly':
                    $add_days = 70;
                    break;
                  case 'monthly':
                    $add_days = 30;
                    break;
                  case 'hourly':
                    $add_days = 1;
                    break;
                  default:
                    // Handle unrecognized plan type
                    $add_days = 30;
                }
              } else {
                $add_days = 30;
              }

              // Calculate next due date
              $next_due_date = strtotime("+$add_days days", strtotime(date('Y-m-d')));
              $add_service_data->next_due_date = date('Y-m-d', $next_due_date);
            }

            $add_service_data->save();
          }
        }
      }

      $data = [
        'invoice_attachment' => $url . $invoice_attachment,
        'client_id' => $req->client_id,
        'user_id' => $user_id,
        'product_id' => isset($req->product_id[0]) ? $req->product_id[0] : 0,
        'invoice_number1' => 'INV#',
        'invoice_number2' => $req->invoice_number2,
        'issue_date' => now(),
        'amount' => $req->sub_total,
        'due_date' => $req->due_date,
        'order_id' => $newOrder->id,
        'sub_total' => $req->sub_total,
        'currency' => $req->currency,
        'exchange_rate' => $req->exchange_rate,
        'final_total_amt' => $req->final_total_amt,
        'discount_value' => $req->discount_value,
        'discount_amount' => $req->discount_amount,
        'discount_type' => $req->discount_type,
        'project_id' => $req->project_id,
        'calc_tax' => $req->calc_tax ?? 0,
        'bank_account' => $req->bank_account,
        'billing_address' => $req->billing_address,
        'shipping_address' => $req->shipping_address,
        'generated_by' => $req->generated_by,
        'is_payment_recieved' => isset($req->is_payment_recieved) ? 1 : 0,
      ];

      // return $data;

      $invoice = Invoice::create($data);

      $newOrder->update(['invoice_id' => $invoice->id]);
    
            $Transaction = [
                'user_id' => $user_id,
                'invoice_id' => $invoice->id,
                'paymentMethod' => 'Bank Transfer',
                'razorpay_payment_id' => 0,
                'amount' => $invoice->final_total_amt,
            ];

            Transaction::create($Transaction);
      
      $id = $invoice->id;
      $agent = new Agent();
      $browser = $agent->browser();
      $version = $agent->version($browser);

      $logData = [
        'user_id' => Auth::user()->id,
        'ip' => $req->ip(),
        'type' => 'invoice',
        'subject' => "Invoice Data Store By " . Auth::user()->first_name,
        'url' => url('/') . '/admin/Invoices/store',
        'method' => "Post",
        'browser' => $browser . "-" . $version,
      ];

      LogActivity::create($logData);

      $user_id = $req->client_id;
      $user = User::find($req->client_id);

      $invoiceData = $this->getInvoiceDetails($id);

      $InvoiceDetails = $invoiceData['InvoiceDetails'];
      $transaction = $invoiceData['transaction'];
      $Currency = $invoiceData['Currency'];
      $addOnProduct = $invoiceData['addOnProduct'];
      $OsOrder = $invoiceData['OsOrder'];
      $taxes = $invoiceData['taxes'];
      $Company = $invoiceData['Company'];
      $InvoiceSettings = $invoiceData['InvoiceSettings'];
    $clientDetails = $data['clientDetails'];
      $pdf = PDF::loadView('admin.Invoices.downloadView', compact('InvoiceDetails','clientDetails','InvoiceSettings','OsOrder', 'transaction', 'Currency', 'addOnProduct', 'taxes','Company'));
      // Save PDF file
      $pdfDirectory = public_path('pdf');
      if (!File::isDirectory($pdfDirectory)) {
        File::makeDirectory($pdfDirectory, 0755, true, true);
      }
      $pdfFilePath = public_path('pdf/invoice_' . $id . '.pdf');
      $pdf->save($pdfFilePath);
      $findUser = User::find($req->client_id);
      $emails = $findUser->email;
      if ($emails) {
        // $MailSettings = MailSettings::where('type', 'Bulk')->where('id', 1)->first();
        $TemplateSettings = Template::where('name', 'Invoice Submission')->first();

        if($req->project_id){
          $productName = Project::select('project_name as product_name','project_summary as description')->first($newOrder->product_id);
        }else{
          $productName = ProductNew::find($newOrder->product_id);
        }

        $productName = $productName->product_name;
        $clientName = $user->first_name;
        $subject = $TemplateSettings->subject;
        $header = $TemplateSettings->header;
        $template = $TemplateSettings->template;
        $footer = $TemplateSettings->footer;
        $replacementssubject = array(
          '[Product/Service Name]' => $productName,
          '[{$invoice_number}]' => $invoice->invoice_number2,
        );
        $message = $subject;
        $subject = str_replace(array_keys($replacementssubject), array_values($replacementssubject), $message);


        if($invoice->is_payment_recieved === 1){
          $invoice->final_total_amt == 0.00;
        }else{
          $invoice->final_total_amt = $invoice->final_total_amt;
        }
        $replacementsTemplate = array(
          '[Client Name]' => $user->first_name,
          '[{$invoice_number}]' => $invoice->invoice_number2,
          '{$invoice_date}' => $invoice->issue_date,
          '{$due_date}' => $invoice->due_date,
          '{$total_amount_due}' => $invoice->final_total_amt,
          '[Your Name]' => auth::user()->first_name,
          '[Product/Service Name]' => $productName,
        );
        $messageReplacementsTemplate = $template;
        $template = str_replace(array_keys($replacementsTemplate), array_values($replacementsTemplate), $messageReplacementsTemplate);

        $replacementsFooter = array(
          '[Your Name]' => auth::user()->first_name,
          '[Your Contact Information]' => '',
        );

        $messagefooter = $footer;
        $footer = str_replace(array_keys($replacementsFooter), array_values($replacementsFooter), $messagefooter);
        ///////////FOR PAYMENT CONFIRMACTION 
        $replacementssubject1 = array(
          '[{$invoice_number}]' => $invoice->invoice_number2,
        );

        $TemplateSettings1 = Template::where('name', 'Invoice Payment Confirmation')->first();

        $message1 = $TemplateSettings1->subject;
        $subject1 = str_replace(array_keys($replacementssubject1), array_values($replacementssubject1), $message1);
        $replacementsTemplate1 = array(
          '[Client Name]' => $user->first_name,
          '[{$invoice_number}]' => $invoice->invoice_number2,
          '[Product/Service Name]' => $productName,
          '[Your Name]' => 'CloudTechtiq',
        );

        $messageReplacementsTemplate1 = $TemplateSettings1->template;
        $template1 = str_replace(array_keys($replacementsTemplate1), array_values($replacementsTemplate1), $messageReplacementsTemplate1);

        $template1 = str_replace(array_keys($replacementsTemplate1), array_values($replacementsTemplate1), $messageReplacementsTemplate1);
        $header1 = $TemplateSettings1->header;
        $footer1 = $TemplateSettings1->footer;

        $ClientDetail = ClientDetail::where('user_id',$req->client_id)->first();
        //return $ClientDetail;
        if($ClientDetail){
          if($ClientDetail->all_emails == 1 && $invoice->is_payment_recieved == 1 ){
            Mail::to($emails)->send(new InvoicePaymentConfirmation($subject1, $header1, $template1, $footer1));
          }if($ClientDetail->invoices === 1){
            Mail::to($emails)->send(new InvoiceGenerated($pdfFilePath, $subject, $header, $template, $footer, $invoice));
          }
        }else{ 
          if($invoice->is_payment_recieved == 1){
            Mail::to($emails)->send(new InvoicePaymentConfirmation($subject1, $header1, $template1, $footer1));
          }
          Mail::to($emails)->send(new InvoiceGenerated($pdfFilePath, $subject, $header, $template, $footer, $invoice));
        }
      }
    }

    return redirect('admin/Invoices/home')->with('success', "New Invoice Added Successfully");
  }
public function update(Request $req, $id)
{
    // Validation
    $validator = Validator::make($req->all(), [
        'invoice_number1' => 'required',
        'client_id' => 'required',
        'final_total_amt' => 'required',
        'invoice_number2' => 'required|unique:invoices,invoice_number2,' . $id,
    ], [
        'invoice_number2.unique' => 'Invoice number: ' . $req->invoice_number2 . ' is already taken.',
        'final_total_amt.required' => 'Total amount cannot be empty.',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    // Find Invoice
    $data = Invoice::find($id);
    $url = url('/') . '/public/images/';
    $invoice_attachment = 'default_bill_attachment.jpg';
    
    // Handle Invoice Attachment
    if ($req->hasFile('invoice_attachment')) {
        $rand = Str::random(4);
        $file = $req->file('invoice_attachment');
        $extension = $file->getClientOriginalExtension();
        $invoice_attachment = 'bill_' . $rand . '.' . $extension;
        $file->move('public/images/', $invoice_attachment);
        $data->invoice_attachment = $url . $invoice_attachment;
    }

    $user_id = Auth::user()->id;

    // Update Order
    if (isset($req->product_id) && count($req->product_id) > 0) {
        $newOrder = Orders::find($data->order_id) ?? new Orders();
        $newOrder->fill([
            'product_id' => $req->product_id[0],
            'project_id' => $req->project_id,
            'client_id' => $req->client_id,
            'taxes' => isset($req->taxes2) ? implode(',', $req->taxes2) : 0,
            'quantity' => isset($req->quantity[0]) ? $req->quantity[0] : 1,
            'amount' => $req->cost_per_items[0],
            'total_amt' => $req->final_total_amt,
            'issue_date' => now(),
            'user_id' => $user_id,
        ]);
        $newOrder->save();

        // Update Addon Orders
        AddonOrder::where('order_id', $newOrder->id)->delete();
        if (count($req->product_id) > 1) {
            $productIds = $req->product_id;
            array_shift($productIds);

            foreach ($productIds as $key => $value) {
                $taxVar = 'taxes' . ($key + 3);
                $orderAddon = new AddonOrder;
                $orderAddon->fill([
                    'user_id' => $user_id,
                    'order_Id' => $newOrder->id,
                    'product_id' => isset($req->product_id[$key + 1]) ? $req->product_id[$key + 1] : 1,
                    'addon_id' => $value,
                    'quantity' => isset($req->quantity[$key + 1]) ? $req->quantity[$key + 1] : 1,
                    'tax' => isset($req->$taxVar) ? implode(',', $req->$taxVar) : 0,
                    'price' => count($req->cost_per_items) > 1 ? $req->cost_per_items[$key + 1] : 0,
                ]);
                $orderAddon->save();

                // Add services if specific conditions are met
                if ($req->bank_account == 2 && $req->project_id == '') {
                    $this->addService($value, $req, $user_id);
                }
            }
        }

        // Update Invoice Data
        $data->fill([
            'client_id' => $req->client_id,
            'user_id' => $user_id,
            'product_id' => isset($req->product_id[0]) ? $req->product_id[0] : 0,
            'invoice_number1' => 'INV#',
            'invoice_number2' => $data->invoice_number2,
            'issue_date' => now(),
            'amount' => $req->sub_total,
            'due_date' => $req->due_date,
            'order_id' => $newOrder->id,
            'sub_total' => $req->sub_total,
            'currency' => $req->currency,
            'exchange_rate' => $req->exchange_rate,
            'final_total_amt' => $req->final_total_amt,
             'discount_value' => $req->discount_value,
            'discount_amount' => $req->discount_amount,
            'discount_type' => $req->discount_type,
            'project_id' => $req->project_id,
            'calc_tax' => $req->calc_tax ?? 0,
            'bank_account' => $req->bank_account,
            'shipping_address' => $req->shipping_address,
            'generated_by' => $req->generated_by,
            'is_payment_recieved' => $req->has('is_payment_recieved') ? 1 : 0,
        ]);
        $data->save();

        // Log Transaction
        $this->logTransaction($data, $user_id, $req->ip());

        // Generate PDF and Send Emails
        $this->generatePdfAndSendEmail($data, $req, $newOrder);
    }

    return redirect('admin/Invoices/home')->with('success', "New Invoice Added Successfully");
}

private function addService($productId, $req, $userId)
{
    // Map category to class
    $categoryClassMap = [
        4 => BareMetal::class,
        5 => CloudHosting::class,
        6 => CloudServices::class,
        7 => DedicatedServer::class,
        8 => AwsService::class,
        9 => Azure::class,
        10 => GoogleWorkSpace::class,
        11 => MicrosoftOffice365::class,
        12 => OneTimeSetup::class,
        13 => MonthelySetup::class,
        14 => SSLCertificate::class,
        15 => Antivirus::class,
        16 => Licenses::class,
        17 => Acronis::class,
        18 => TsPlus::class,
        25 => Switchs::class,
        26 => Firewall::class,
    ];

    $product = ProductNew::find($productId);
    $plan = ProductPricing::find($req->billing_cycle);
    $class = $categoryClassMap[$product->category_id] ?? BareMetal::class;

    $service = new $class;
    $service->fill([
        'user_id' => $userId,
        'customer_id' => $userId,
        'product_id' => $productId,
        'service_type' => $req->service_type ?? 1,
        'billing_cycle' => $req->billingcycle ?? '2',
        'payment_method_id' => $req->bank_account,
        'signup_date' => date('Y-m-d'),
    ]);

    // Calculate next due date
    $plan_type = $product->plan_type;
    $add_days = match ($plan_type) {
        'triennially' => 1095,
        'biennially' => 730,
        'annually' => 365,
        'semiannually' => 150,
        'quarterly' => 70,
        'monthly' => 30,
        'hourly' => 1,
        default => 30,
    };
    $service->next_due_date = $req->billing_cycle == 2 ? date('Y-m-d') : date('Y-m-d', strtotime("+$add_days days"));

    $service->save();
}

private function logTransaction($data, $userId, $ip)
{
    $transaction = [
        'user_id' => $userId,
        'invoice_id' => $data->id,
        'paymentMethod' => 'Bank Transfer',
        'razorpay_payment_id' => 0,
        'amount' => $data->final_total_amt,
    ];
    Transaction::create($transaction);

    $agent = new Agent();
    $browser = $agent->browser();
    $version = $agent->version($browser);

    $logData = [
        'user_id' => Auth::user()->id,
        'ip' => $ip,
        'type' => 'invoice',
        'subject' => "Invoice Data Updated By " . Auth::user()->first_name,
        'url' => url('/') . '/admin/Invoices/update/' . $data->id,
        'method' => "Post",
        'browser' => $browser . "-" . $version,
    ];
    LogActivity::create($logData);
}

private function generatePdfAndSendEmail($invoice, $req, $order)
{
    $id = $invoice->id;
    $user = User::find($req->client_id);
    $invoiceData = $this->getInvoiceDetails($id);
    $InvoiceDetails = $invoiceData['InvoiceDetails'];
    $transaction = $invoiceData['transaction'];
    $Currency = $invoiceData['Currency'];
    $addOnProduct = $invoiceData['addOnProduct'];
    $osOrder = $invoiceData['OsOrder'];
    $InvoiceSettings = $invoiceData['InvoiceSettings'];
    $taxes = $invoiceData['taxes'];
    $Company = $invoiceData['Company'];
    $clientDetails = $data['clientDetails'];

    // Generate PDF
    $pdf = PDF::loadView('admin.Invoices.downloadView', compact('InvoiceDetails','clientDetails','InvoiceSettings', 'osOrder', 'transaction', 'Currency', 'addOnProduct', 'taxes', 'Company'));
    $pdfDirectory = public_path('pdf');
    if (!File::isDirectory($pdfDirectory)) {
        File::makeDirectory($pdfDirectory, 0755, true, true);
    }
    $pdfFilePath = public_path('pdf/invoice_' . $id . '.pdf');
    $pdf->save($pdfFilePath);

    $emails = $user->email;
    if ($emails) {
        // Get Email Templates
        $invoiceTemplate = Template::where('name', 'Invoice Submission')->first();
        $paymentTemplate = Template::where('name', 'Invoice Payment Confirmation')->first();

        $productName = $req->project_id ? Project::select('project_name as product_name')->first($order->product_id)->product_name : ProductNew::find($order->product_id)->product_name;
        $clientName = $user->first_name;

        // Invoice Email
        $invoiceSubject = str_replace(['[Product/Service Name]', '[{$invoice_number}]'], [$productName, $invoice->invoice_number2], $invoiceTemplate->subject);
        $invoiceBody = str_replace(
            ['[Client Name]', '[{$invoice_number}]', '{$invoice_date}', '{$due_date}', '{$total_amount_due}', '[Your Name]', '[Product/Service Name]'],
            [$clientName, $invoice->invoice_number2, $invoice->issue_date, $invoice->due_date, $invoice->final_total_amt, Auth::user()->first_name, $productName],
            $invoiceTemplate->template
        );

        // Payment Confirmation Email
        $paymentSubject = str_replace('[{$invoice_number}]', $invoice->invoice_number2, $paymentTemplate->subject);
        $paymentBody = str_replace(
            ['[Client Name]', '[{$invoice_number}]', '[Product/Service Name]', '[Your Name]'],
            [$clientName, $invoice->invoice_number2, $productName, 'CloudTechtiq'],
            $paymentTemplate->template
        );

        // Send Emails
        $clientDetail = ClientDetail::where('user_id', $req->client_id)->first();
        if ($clientDetail) {
            if ($clientDetail->all_emails == 1 && $invoice->is_payment_recieved == 1) {
                Mail::to($emails)->send(new InvoicePaymentConfirmation($paymentSubject, $paymentTemplate->header, $paymentBody, $paymentTemplate->footer));
            }
            if ($clientDetail->invoices == 1) {
                Mail::to($emails)->send(new InvoiceGenerated($pdfFilePath, $invoiceSubject, $invoiceTemplate->header, $invoiceBody, $invoiceTemplate->footer, $invoice));
            }
        } else {
            if ($invoice->is_payment_recieved == 1) {
                Mail::to($emails)->send(new InvoicePaymentConfirmation($paymentSubject, $paymentTemplate->header, $paymentBody, $paymentTemplate->footer));
            }
            Mail::to($emails)->send(new InvoiceGenerated($pdfFilePath, $invoiceSubject, $invoiceTemplate->header, $invoiceBody, $invoiceTemplate->footer, $invoice));
        }
    }
}


 public function updateOld(Request $req, $id)
  {
    $data = Invoice::find($id);
    $data = $req->all();
    $data['invoice_attachment'] = $url . $invoice_attachment;
    $data['user_id'] = Auth::user()->id;
    $data['invoice_number'] = $req->invoice_number1 . $req->invoice_number2;
    // $data['AssignedTo'] = $AssignedTo;
    $data['is_payment_recieved'] = $req->has('is_payment_recieved') ? true : false;
    if ($req->hasFile('invoice_attachment')) {
      $bill_attachment = 'profile_' . Str::random(4) . '.' . $req->file('invoice_attachment')->getClientOriginalExtension();
      $req->file('invoice_attachment')->move('public/images/', $invoice_attachment);
      $data->invoice_attachment = url('/public/images/') . '/' . $bill_attachment;
    }
    $data->save();

    $agent = new Agent();
    $browser = $agent->browser();
    $version = $agent->version($browser);
    $Log = $req->all();
    $Log['user_id'] = Auth::user()->id;
    $Log['ip'] = $req->ip();
    $Log['type'] = 'invoice';
    $Log['subject'] = "Invoices Data Updated  By " . Auth::user()->first_name;
    $Log['url'] = url('/') . '/admin/Inventory/update/' . $id;
    $Log['method'] = "Post";
    $Log['browser'] = $browser . "-" . $version;
    LogActivity::create($Log);

    return redirect('admin/Invoices/home')->with('success', "Invoices Edit Successfully");
  }


  //updated
 public function autopayinvoice(Request $req)
{
    // return $req->all();
    $data = Invoice::find($req->invoiceId);
    if(!$data) {
        return response()->json(['success' => false, 'message' => 'Invoice not found.']);
    }else{
      $already_paid = floatval($data->paid_amount) ?? 0;
      $paid = floatval($already_paid) + $req->paymentAmount;
      $fullPaymentStatus = $req->has('fullPaymentStatus') ? 1 : 0;
      $data->is_payment_recieved = $fullPaymentStatus;
      $data->payment_method = $req->paymentMethod;
      $data->paid_amount = $paid;
      $data->transaction_date = $req->transactionDate;
      $data->transaction_id = $req->transactionId;
      $data->tds_percent = $req->tdsPercent;
      if($data->save()){
          
        if($req->creditAmount && $req->creditBalance > 0){
            Credit::create([
                'client_id' => $data->client_id,
                'amount' => '-'.$req->creditBalance,
            ]); 
        }
        
          
        $data = Invoice::find($req->invoiceId);
        $method = 'Other'; // Default to 'Other' if payment method is not 1 or 2
        if ($data->payment_method == 1) {
            $method = 'Razorpay';
        } elseif ($data->payment_method == 2) {
            $method = 'Paypal';
        }
          if($data->paid_amount == $data->final_total_amt){

                Orders::where('invoice_id',$req->invoiceId)->update(['is_payment_recieved'=> 1]);
              }else{
                Orders::where('invoice_id',$req->invoiceId)->update(['is_payment_recieved'=> 0]);
              }

        $transactionData = [
            'user_id' => $data->client_id,
            'invoice_id' => $data->id,
            'paymentMethod' => $method,
            'razorpay_payment_id' => $data->transaction_id, // Assuming razorpay_payment_id is used for both Razorpay and PayPal
            'amount' => $data->paid_amount,
        ];
        Transaction::create($transactionData);
          if ($req->has('confrm_mail')) {
              
            $InvoiceDetails = Invoice::with('orders')
            ->leftJoin('users', 'users.id', 'invoices.client_id')
            ->leftJoin('client_details', 'client_details.user_id', 'invoices.client_id')
            ->leftJoin('currencies', 'currencies.id', 'invoices.currency')
            
            ->select(
              'invoices.*',
              'users.first_name',
              'users.last_name',
              'users.phone_number',
              'users.email',
              'client_details.address_2',
              'client_details.address_1',
              'client_details.pincode',
              'client_details.gstin as gstin',
              'currencies.prefix',
              'invoices.amount as price'
            )
            ->leftJoin('orders', 'invoices.id', 'orders.invoice_id')
            ->where('invoices.id', $req->invoiceId)
            ->first();
            
            
            if($InvoiceDetails->orders->product_id){
                $InvoiceDetails->orders->product = ProductNew::where('id',optional($InvoiceDetails->orders)->product_id)
                ->select('product_name','description')
                ->first();
            }else{
                 $InvoiceDetails->orders->product = Project::where('id',optional($InvoiceDetails->orders)->product_id)
                ->select('project_name as product_name','projects.project_summary as description')
                ->first();
            }
            
           

            $Currency = Currency::where('is_default', 1)->first();
            $taxes = [];
            $addOnProduct = [];
            if (!empty($InvoiceDetails) && is_array($InvoiceDetails->calc_tax)) {
                $taxes = TaxSetting::whereIn('id', $InvoiceDetails->calc_tax)->get();
            }else{
              $taxes = TaxSetting::whereIn('id',[1,3])->get();
            }
            $transaction = Transaction::where('invoice_id', optional($InvoiceDetails)->id)->first();
            $Company = CompanyLogin::find(1);
          $InvoiceSettings = InvoiceSettings::first();
            $Project = Project::where('status_id', 1)->get();
              $pdf = PDF::loadView('admin.Invoices.downloadView', compact('InvoiceDetails', 'transaction','InvoiceSettings', 'Currency', 'addOnProduct', 'taxes','Company'));
              $pdfDirectory = public_path('pdf');
              if (!File::isDirectory($pdfDirectory)) {
                File::makeDirectory($pdfDirectory, 0755, true, true);
              }
              $pdfFilePath = public_path('pdf/invoice_' . $req->invoiceId . '.pdf');
              $pdf->save($pdfFilePath);
              $findUser = User::find($data->client_id);
              $emails = $findUser->email;
              if ($emails) {
                // $MailSettings = MailSettings::where('type', 'Bulk')->where('id', 1)->first();
                $TemplateSettings = Template::where('name', 'Invoice Submission')->first();
                  $inv = Invoice::find($req->invoiceId);
                  // return $inv;
                  if($inv->project_id){
                    $productName = Project::find($inv->project_id);
                    $productName = $productName->project_name;
                  }else{
                    $productName = ProductNew::find($inv->product_id);
                    $productName = $productName->product_name;
                    
                  }
        
                $clientName = $findUser->first_name;
                $subject = $TemplateSettings->subject;
                $header = $TemplateSettings->header;
                $template = $TemplateSettings->template;
                $footer = $TemplateSettings->footer;
                $replacementssubject = array(
                  '[Product/Service Name]' => $productName,
                  '[{$invoice_number}]' => $inv->invoice_number2,
                );
                $message = $subject;
                $subject = str_replace(array_keys($replacementssubject), array_values($replacementssubject), $message);
        
        
        
                $replacementsTemplate = array(
                  '[Client Name]' => $findUser->first_name,
                  '[{$invoice_number}]' => $data->invoice_number2,
                  '{$invoice_date}' => $data->issue_date,
                  '{$due_date}' => $data->due_date,
                  '{$total_amount_due}' => $data->final_total_amt,
                  '[Your Name]' => auth::user()->first_name,
                  '[Product/Service Name]' => $productName,
                );
                $messageReplacementsTemplate = $template;
                $template = str_replace(array_keys($replacementsTemplate), array_values($replacementsTemplate), $messageReplacementsTemplate);
        
                $replacementsFooter = array(
                  '[Your Name]' => auth::user()->first_name,
                  '[Your Contact Information]' => '',
                );
        
                $messagefooter = $footer;
                $footer = str_replace(array_keys($replacementsFooter), array_values($replacementsFooter), $messagefooter);
                ///////////FOR PAYMENT CONFIRMACTION 
                $replacementssubject1 = array(
                  '[{$invoice_number}]' => $data->invoice_number2,
                );
        
                $TemplateSettings1 = Template::where('name', 'Invoice Payment Confirmation')->first();
        
                $message1 = $TemplateSettings1->subject;
                $subject1 = str_replace(array_keys($replacementssubject1), array_values($replacementssubject1), $message1);
                $replacementsTemplate1 = array(
                  '[Client Name]' => $findUser->first_name,
                  '[{$invoice_number}]' => $data->invoice_number2,
                  '[Product/Service Name]' => $productName,
                  '[Your Name]' => 'CloudTechtiq',
                );
        
                $messageReplacementsTemplate1 = $TemplateSettings1->template;
                $template1 = str_replace(array_keys($replacementsTemplate1), array_values($replacementsTemplate1), $messageReplacementsTemplate1);
        
                $template1 = str_replace(array_keys($replacementsTemplate1), array_values($replacementsTemplate1), $messageReplacementsTemplate1);
                $header1 = $TemplateSettings1->header;
                $footer1 = $TemplateSettings1->footer;
        
        
                Mail::to($emails)->send(new InvoicePaymentConfirmation($subject1, $header1, $template1, $footer1));
        
                Mail::to($emails)->send(new InvoiceGenerated($pdfFilePath, $subject, $header, $template, $footer, $inv));
              }
        }
          return response()->json(['data' => $data, 'success' => true]);
      } else {
          return response()->json(['success' => false, 'message' => 'Failed to save payment details.']);
      }
    }


}


  public function delete(Request $request, $id)
  {
    //return $id;
    $agent = new Agent();
    $browser = $agent->browser();
    $version = $agent->version($browser);
    $Log = $request->all();
    $Log['user_id'] = Auth::user()->id;
    $Log['ip'] = $request->ip();
    $Log['type'] = 'invoice';
    $Log['subject'] = "Invoices Data Deleted  By " . Auth::user()->first_name;
    $Log['url'] = url('/') . '/admin/Invoices/delete/' . $id;
    $Log['method'] = "Get";
    $Log['browser'] = $browser . "-" . $version;
    LogActivity::create($Log);

    Invoice::find($id)->delete();
    return redirect('admin/Invoices/home')->with('success', "Invoices Deleted Successfully");
  }



  // ExportCSV
  public function EXPORTCSV(Request $request)
  {
    $agent = new Agent();
    $browser = $agent->browser();
    $version = $agent->version($browser);
    $Log = $request->all();
    $Log['user_id'] = Auth::user()->id;
    $Log['type'] = 'invoice';
    $Log['ip'] = $request->ip();
    $Log['subject'] = "Invoices CSV Export  By " . Auth::user()->first_name;
    $Log['url'] = url('/') . '/admin/Invoices/EXPORTCSV';
    $Log['method'] = "Get";
    $Log['browser'] = $browser . "-" . $version;
    LogActivity::create($Log);

    return Excel::download(new InvoiceExport, 'Invoices.csv');
  }



  public function view(Request $req, $id)
  {
    
    $data = $this->getInvoiceDetails($id);
    
    $InvoiceDetails = $data['InvoiceDetails'];

    $transaction = $data['transaction'];
    $Currency = $data['Currency'];
    $addOnProduct = $data['addOnProduct'];
    $OsOrder = $data['OsOrder'];
    $taxes = $data['taxes'];
    $Company = $data['Company'];
    $InvoiceSettings = $data['InvoiceSettings'];
    $clientDetails = $data['clientDetails'];

    return view('admin.Invoices.view', compact('InvoiceDetails','InvoiceSettings','clientDetails', 'transaction','OsOrder', 'Currency', 'addOnProduct', 'taxes','Company'));
  }
  public function downloadPDF(Request $request)
  {
    $ids =  explode(",", $request->id);
    $user_id = Auth::user()->id;
    $pdfFiles = [];

    foreach ($ids as $id) {
      $data = $this->getInvoiceDetails($id);

      $InvoiceDetails = $data['InvoiceDetails'];

      $transaction = $data['transaction'];
      $Currency = $data['Currency'];
      $addOnProduct = $data['addOnProduct'];
      $OsOrder = $data['OsOrder'];
      $taxes = $data['taxes'];
      $Company = $data['Company'];
      $InvoiceSettings = $data['InvoiceSettings'];
    $clientDetails = $data['clientDetails'];
      
      // echo "<pre>"; print_r($data); exit;
      $pdf = PDF::loadView('admin.Invoices.downloadView', compact('InvoiceDetails','clientDetails','InvoiceSettings','OsOrder', 'transaction', 'Currency', 'addOnProduct', 'taxes','Company'));
      $filename = 'invoice_' . $id . '.pdf';
      $pdfFiles[] = [
        'file' => $pdf->output(),
        'filename' => $filename
      ];
    }


    if(count($ids) > 1){
      // Create a ZIP file containing all PDFs
      $zip = new ZipArchive;
      $zipFileName = 'invoices.zip';
      $zipFilePath = storage_path('app/' . $zipFileName);

      if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
        foreach ($pdfFiles as $pdfFile) {
          $zip->addFromString($pdfFile['filename'], $pdfFile['file']);
        }
        $zip->close();
      }

       // Return the ZIP archive as a downloadable response
      return response()->download($zipFilePath)->deleteFileAfterSend(true);

    }else{
      $pdfContent = isset($pdfFiles[0]['file']) ? $pdfFiles[0]['file'] : null;

          return response()->streamDownload(function () use ($pdfContent) {
              echo $pdfContent;
          }, $pdfFiles[0]['filename']);

    }
    
  }

  public function printView(Request $request, $id)
  {
    $user_id = Auth::user()->id;
    $user = User::find($id);
    $Ticket = Ticket::where('client_id', $id)->get();
    $InvoiceSettings = InvoiceSettings::first();

    $Invoice = Invoice::with('orders')->find($id);

    // // Fetching all orders associated with the invoice
    // $InvoiceDetailsAll = Orders::where('invoice_id', $id)
    //   ->with('user', 'clientDetails')
    //   ->get();
    // $Currency = Currency::where('is_default', 1)->first();

    // $InvoiceDetails = Invoice::leftJoin('orders', 'orders.invoice_id', '=', 'invoices.id')
    //   ->leftJoin('users', 'users.id', '=', 'invoices.client_id')
    //   ->leftJoin('client_details', 'client_details.user_id', '=', 'invoices.client_id')
    //   ->leftJoin('currencies', 'currencies.id', '=', 'invoices.currency')
    //   ->leftJoin('company_logins', 'company_logins.id', '=', 'invoices.generated_by')
    //   ->select('invoices.*', 'orders.*', 'users.id as user_id', 'users.first_name', 'users.last_name', 'users.email', 'client_details.address_2', 'client_details.address_1', 'client_details.pincode', 'company_logins.company_name', 'currencies.prefix', 'currencies.code')
    //   ->where('invoices.id', $id)
    //   ->first();

    // $Company = CompanyLogin::select('id', 'company_name', 'contact_no')->where('user_id', $user_id)->first();
    // $Project = Project::where('status_id', 1)->get();

    // $data = [
    //   'Ticket' => $Ticket,
    //   'user' => $user,
    //   'InvoiceDetails' => $InvoiceDetails,
    //   'Invoice' => $Invoice,
    //   'InvoiceDetailsAll' => $InvoiceDetailsAll,
    //   'Company' => $Company,
    //   'Project' => $Project,
    // ];

    // $datas = [
    //   'title' => 'Welcome to ItSolutionStuff.com',
    //   'date' => date('m/d/Y'),
    //   'users' => "ghg",
    // ];

    $data = $this->getInvoiceDetails($id);

    $InvoiceDetails = $data['InvoiceDetails'];
    $InvoiceSettings = $data['InvoiceSettings'];
    $transaction = $data['transaction'];
    $Currency = $data['Currency'];
    $addOnProduct = $data['addOnProduct'];
    $taxes = $data['taxes'];
    $Company = $data['Company'];
      $InvoiceSettings = $invoiceData['InvoiceSettings'];
      $OsOrder = $invoiceData['OsOrder'];
    $clientDetails = $data['clientDetails'];
    return view('admin.Invoices.printView', compact('InvoiceDetails','InvoiceSettings','clientDetails', 'transaction',  'OsOrder', 'Currency', 'addOnProduct', 'taxes', 'Company'));
  }
  ////update payment status
  public function paymentStatusUpdate(Request $request)
  {
    Invoice::where('id', $request->orderId)->update(['is_payment_recieved' => 1]);
    $data =  Invoice::where('id', $request->orderId)->select('order_id')->first();
    Orders::where('id', $data->order_id)->update(['is_payment_recieved' => 1]);
    return redirect()->back();
  }


  ///getProductDetail
  public function getProductDetail(Request $request)
  {
    $product = ProductNew::where('id', $request->product_id)->select('product_name', 'description')->first();
    $data['productName'] =  $product->product_name;
    $data['description'] =  strip_tags($product->description);
    return $data;
  }
  //get product

  public function getProduct(Request $request)
  {
    if ($request->id > 0) {
      $ProductNews = ProductNew::where('category_id', $request->id)->select('product_name', 'id')->get();
    } else {
      $ProductNews = ProductNew::select('product_name', 'id')->get();
    }
    return view('admin.Invoices.showProduct', compact('ProductNews'));
  }

public function getInvoiceDetails($id)
{
        $invoice = Invoice::find($id);
        if ($invoice->project_id) {
            $InvoiceDetails = Invoice::with('orders')
                ->leftJoin('users', 'users.id', 'invoices.client_id')
                ->leftJoin('client_details', 'client_details.user_id', 'invoices.client_id')
                ->leftJoin('company_details', 'company_details.id', 'client_details.company_id')
                ->leftJoin('orders', 'invoices.id', 'orders.invoice_id')
                ->leftJoin('currencies', 'currencies.id', 'orders.currency')
                ->leftJoin('product_pricing', 'product_pricing.id', 'orders.billing_cycle')
                ->select(
                    'invoices.*',
                    'orders.quantity',
                    'users.first_name',
                    'users.last_name',
                    'company_details.company_name',
                    'users.phone_number',
                    'users.email',
                    'users.email as show_client_email',
                    'client_details.address_2',
                    'client_details.address_1',
                    'client_details.pincode',
                    'client_details.gstin as gstin',
                    'currencies.prefix',
                    'orders.billing_cycle',
                    'product_pricing.price',
                    'orders.currency'
                )
                ->where('invoices.id', $id)
                ->first();

            $InvoiceDetails->orders->product = Project::where('id', optional($InvoiceDetails->orders)->product_id)
                ->select('project_name as product_name', 'projects.project_summary as description')
                ->first();
            
            $findProduct = ProductNew::find($InvoiceDetails->orders->product_id);

            $OsOrder = OsOrder::leftJoin('operating_systens', 'operating_systens.id', 'os_orders.os_id')
                ->leftJoin('o_s_categories', 'o_s_categories.os_id', 'operating_systens.id')
                 ->leftJoin('tax_settings', 'os_orders.tax', 'tax_settings.id')
                ->where('os_orders.order_id', $InvoiceDetails->orders->id)
                ->where('o_s_categories.currency_id', $InvoiceDetails->orders->currency)
                ->where('o_s_categories.category_id', $findProduct->category_id)
                ->select('os_orders.*', 'operating_systens.ostype', 'o_s_categories.price as os_price', 'tax_settings.rate')
                ->groupBy('operating_systens.id')
                ->first();

            $addOnProduct = AddonOrder::join('projects', 'projects.id', 'addon_orders.addon_id')
                ->leftJoin('tax_settings', 'addon_orders.tax', 'tax_settings.id')
                ->where('order_id', optional($InvoiceDetails->orders)->id)
                ->select('addon_orders.*', 'projects.project_name as product_name', 'projects.project_summary as description', 'tax_settings.rate')
                ->groupBy('addon_orders.id')
                ->get();
        } else {
          $InvoiceDetails = Invoice::with([
        'orders.product.pricing',
        'orders.product.taxSetting',
        'orders.currency',
        'client',
        'client.clientDetails'
    ])
        ->leftJoin('users', 'users.id', '=', 'invoices.client_id')
        ->leftJoin('client_details', 'client_details.user_id', '=', 'invoices.client_id')
            ->leftJoin('company_details', 'company_details.id', 'client_details.company_id')
        ->leftJoin('orders', 'invoices.id', '=', 'orders.invoice_id')
        ->leftJoin('currencies', 'currencies.id', '=', 'orders.currency')
        ->leftJoin('product_pricing', 'product_pricing.id', '=', 'orders.billing_cycle')
        ->leftJoin('tax_settings', 'orders.taxes', '=', 'tax_settings.id')
        ->select(
            'invoices.*',
            'orders.is_payment_recieved',
            'users.first_name',
            'users.last_name',
            'users.email as show_client_email',
            'users.phone_number',
            'company_details.company_name',
            'users.email',
            'client_details.address_2',
            'client_details.address_1',
            'client_details.pincode',
            'client_details.gstin as gstin',
            'product_pricing.price',
            'currencies.prefix',
            'tax_settings.rate',
            'orders.currency'
        )
        ->where('invoices.id', $id)
        ->first();


        $findProduct = ProductNew::find($InvoiceDetails->orders->product_id);

              $OsOrder = OsOrder::leftJoin('operating_systens', 'operating_systens.id', 'os_orders.os_id')
            ->leftJoin('o_s_categories', 'o_s_categories.os_id', 'operating_systens.id')
             ->leftJoin('tax_settings', 'os_orders.tax', 'tax_settings.id')
            ->where('os_orders.order_id', $InvoiceDetails->orders->id)
            ->where('o_s_categories.currency_id', $InvoiceDetails->orders->currency)
            ->where('o_s_categories.category_id', $findProduct->category_id)
            ->select('os_orders.*', 'operating_systens.ostype', 'o_s_categories.price as os_price', 'tax_settings.rate')
            ->groupBy('operating_systens.id')
            ->first();


        $addOnProduct = AddonOrder::join('product_news', 'product_news.id', 'addon_orders.addon_id')
            ->join('product_pricing', 'product_news.id', 'product_pricing.product_id')
            ->leftJoin('tax_settings', 'addon_orders.tax', 'tax_settings.id')
            ->where('order_id', optional($InvoiceDetails->orders)->id)
            ->where('product_pricing.currency_id', optional($InvoiceDetails->orders)->currency)
            ->select('addon_orders.*', 'product_news.product_name', 'product_news.description', 'product_pricing.price', 'tax_settings.rate')
            ->groupBy('addon_orders.id')
            ->get();
    }

    $Currency = Currency::join('orders','orders.currency','currencies.id')
    ->where('invoice_id', $id)
    ->select('currencies.*')
    ->first();

    $taxes = TaxSetting::where('status', 1)->get();
    $Company = CompanyLogin::find(1);
    $transaction = Transaction::where('invoice_id', $id)->first();
    $InvoiceSettings = InvoiceSettings::find(1);

    $clientDetails = ClientDetail::where('user_id',$invoice->client_id)->first();

    $data = [
        'clientDetails' => $clientDetails,
        'InvoiceDetails' => $InvoiceDetails,
        'addOnProduct' => $addOnProduct,
        'OsOrder' => $OsOrder, // Add OsOrder to the data array
        'Currency' => $Currency,
        'taxes' => $taxes,
        'Company' => $Company,
        'InvoiceSettings' => $InvoiceSettings,
        'transaction' => $transaction,
    ];
    return $data;
}

 public function getInvoiceDetailsOlds1($id)
{
    $invoice = Invoice::find($id);
    if ($invoice->project_id) {
        $InvoiceDetails = Invoice::with('orders')
            ->leftJoin('users', 'users.id', 'invoices.client_id')
            ->leftJoin('client_details', 'client_details.user_id', 'invoices.client_id')
            ->leftJoin('currencies', 'currencies.id', 'invoices.currency')
            ->select(
                'invoices.*',
                'orders.quantity',
                'users.first_name',
                'users.last_name',
                'users.phone_number',
                'users.email',
                'client_details.address_2',
                'client_details.address_1',
                'client_details.pincode',
                'client_details.gstin as gstin',
                'currencies.prefix',
                'product_pricing.price'
            )
            ->leftJoin('orders', 'invoices.id', 'orders.invoice_id')
            ->leftJoin('product_pricing', 'product_pricing.id', 'orders.billing_cycle')
            ->where('invoices.id', $id)
            ->first();

        $InvoiceDetails->orders->product = Project::where('id', optional($InvoiceDetails->orders)->product_id)
            ->select('project_name as product_name', 'projects.project_summary as description')
            ->first();

        $addOnProduct = AddonOrder::join('projects', 'projects.id', 'addon_orders.addon_id')
                       ->leftJoin('tax_settings', 'addon_orders.tax', 'tax_settings.id')
            ->where('order_id', optional($InvoiceDetails->orders)->id)
            ->select('addon_orders.*', 'projects.project_name as product_name', 'projects.project_summary as description','tax_settings.rate')
            ->groupBy('addon_orders.id')
            ->get();
    } else {
        $InvoiceDetails = Invoice::with('orders.product')
            ->leftJoin('users', 'users.id', 'invoices.client_id')
            ->leftJoin('client_details', 'client_details.user_id', 'invoices.client_id')
            ->leftJoin('currencies', 'currencies.id', 'invoices.currency')
            ->select(
                'invoices.*',
                'orders.is_payment_recieved',
                'users.first_name', 
                'users.last_name',
                'users.phone_number',
                'users.email',
                'client_details.address_2',
                'client_details.address_1',
                'client_details.pincode',
                'client_details.gstin as gstin',
                'product_pricing.price',
                'currencies.prefix',
                'tax_settings.rate'
            )
            ->with(['orders.product' => function ($query) {
                $query->select('id', 'description', 'product_name', 'tax_id');
            }])
            ->leftJoin('orders', 'invoices.id', 'orders.invoice_id')
             ->leftJoin('product_pricing', 'product_pricing.id', 'orders.billing_cycle')
            ->leftJoin('tax_settings', 'orders.taxes', 'tax_settings.id')
            ->where('invoices.id', $id)
            ->first();

        $addOnProduct = AddonOrder::join('product_news', 'product_news.id', 'addon_orders.addon_id') // Corrected join
            ->join('product_pricing', 'product_news.id', 'product_pricing.product_id') // Corrected join
             ->leftJoin('tax_settings', 'addon_orders.tax', 'tax_settings.id')
            ->where('order_id', optional($InvoiceDetails->orders)->id)
            ->select('addon_orders.*', 'product_news.product_name', 'product_news.description', 'product_pricing.price','tax_settings.rate')
            ->groupBy('addon_orders.id')
            ->get();
    }

    $Currency = Currency::where('is_default', 1)->first();
    $taxes = TaxSetting::where('status', 1)->get();
    $Company = CompanyLogin::find(1);
    $transaction = Transaction::where('invoice_id', $id)->first();

    $data = [
        'InvoiceDetails' => $InvoiceDetails,
        'addOnProduct' => $addOnProduct,
        'Currency' => $Currency,
        'taxes' => $taxes,
        'Company' => $Company,
        'transaction' => $transaction,
    ];
    return $data;
}

}
