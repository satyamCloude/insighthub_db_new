<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use App\Models\PaymentMethod;
use App\Models\CompanyLogin;
use App\Models\ClientDetail;
use App\Models\EmployeeDetail;
use Jenssegers\Agent\Agent;
use App\Models\StorageSetting;
use Illuminate\Support\Facades\Storage;
use App\Models\LogActivity;
use App\Models\Ticket;
use App\Models\Project;
use App\Models\OsOrder;
use App\Models\Template;
use App\Models\Orders;
use Illuminate\Support\Str;
use App\Models\ProductNew;
use App\Models\OperatingSysten;
use App\Models\DedicatedServer;
use App\Models\ProductPricing;
use App\Models\CloudServices;
use App\Models\Currency;
use App\Models\BareMetal;
use App\Models\CloudHosting;
use App\Models\HostingControlPanel;
use App\Models\OrderToProduct;
use App\Models\Azure;
use App\Models\MicrosoftOffice365;
use App\Models\OneTimeSetup;
use App\Models\MonthelySetup;
use App\Models\GoogleWorkSpace;
use App\Models\AwsService;
use App\Models\SSLCertificate;
use App\Models\TsPlus;
use App\Models\Antivirus;
use App\Models\Acronis;
use App\Models\Licenses;
use App\Models\Product;
use App\Models\TimeShift;
use App\Models\Cart;
use App\Models\ProductAddOn;
use App\Models\ProductAddOnPrice;
use App\Mail\WelcomeEmail; // Import your mail class
use App\Mail\ClientAuthEmail; // Import your mail class
use App\Mail\ClientWelcomeEmail; // Import your mail class
use App\Models\Switchs;
use App\Models\Firewall;
use App\Models\Task;
use App\Models\InvoiceSettings;
use App\Models\AddOnProductCart;
use App\Models\Transaction;
use App\Models\MailSettings;
use App\Models\Country;
use App\Models\Quotes;
use App\Models\Status;
use App\Models\State;
use App\Models\Invoice;
use App\Models\Role;
use App\Models\User;
use App\Models\City;
use App\Models\Chat;
use App\Models\AddonOrder;
use App\Models\TaxSetting;
use App\Models\PaymentDetail;
use App\Models\Credit;
use App\Mail\InvoicePaymentConfirmation;
use App\Events\AppEvents;
use App\Mail\TicketMail;
use Illuminate\Support\Facades\Mail;
use ZipArchive;
use Hash;
use Validator;
use Auth;
use View;
use Session;
use DB;
use PDF;
use Illuminate\Support\Facades\File;
use App\Mail\InvoiceGenerated;

use PragmaRX\Google2FA\Google2FA;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Validation\ValidationException;


class UMyProfileController extends Controller
{
    public function index(Request $req)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $ClientDetail = ClientDetail::where('user_id', $id)->first();
        $Ticket = Ticket::where('client_id', $id)->get();
        
        $credits=Credit::where('client_id',$id)->orderBy('id','DESC')->get();
        $currency=Currency::where('is_default',1)->first();
        $accountManager=User::find(Auth::user()->accountManager);

        if ($ClientDetail) {
            $Country = Country::find($ClientDetail->country);
            $State = State::find($ClientDetail->state);
            $City = City::find($ClientDetail->city);
            $quotes = Quotes::where('company_id', $ClientDetail->company_id)->where('status', 1)->get();
        } else {
            $Country = Country::find(4);
            $State = State::where('country_id', $Country->id)->first();
            $City = City::where('state_id', $State->id)->first();
            $quotes = Quotes::where('user_id', $id)->where('status', 1)->get();
        }
        $TotalProject = Project::where('client_id', $id)->count();

        $Orders = Orders::leftJoin('product_news', 'orders.product_id', 'product_news.id')
            ->where('orders.client_id', $id)
            ->where('orders.is_payment_recieved', 1)
            ->select('orders.*', 'product_news.product_name as product_name', 'product_news.product_tag_line as services_type')
            ->get();

        $projects = Project::where('client_id', $id)->get();
        $LastLog = LogActivity::where('user_id', $id)->first();
        $LogActivity = LogActivity::where('user_id', $id)->get();
        $LastloginLogActivity = LogActivity::where('user_id', $id)->orderBy('created_at', 'desc')->first();
        $tasks = Task::leftJoin('projects', 'projects.id', '=', 'tasks.project_id')
            ->where('tasks.client_id', $id)
            ->get();
             $id = Auth::user()->id;
        // $user = User::find($id);
        $user = User::find($id);
        $ClientDetail = ClientDetail::where('user_id', $id)->first();
        $Role = Role::get();
        $Countrys = Country::get();
        $State = State::find($ClientDetail->state);
        $City = City::find($ClientDetail->city);
        $Currency = Currency::get();
        $Company = CompanyLogin::select('id', 'company_name')->get();
        $Status = Status::get();
        $PaymentMethod = PaymentMethod::get();
        return view('user.MyProfile.index', compact('accountManager','LastloginLogActivity', 'credits', 'currency', 'LogActivity', 'LastLog', 'quotes', 'tasks', 'projects', 'Country', 'user', 'State', 'City', 'ClientDetail', 'TotalProject', 'id', 'Ticket', 'Orders','Countrys', 'user', 'State', 'City', 'Currency', 'Company', 'Status', 'PaymentMethod', 'ClientDetail', 'Role'));
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
            $taxes = $data['taxes'];
            $InvoiceSettings = $data['InvoiceSettings'];
            $Company = $data['Company'];

            // echo "<pre>"; print_r($data); exit;
            $pdf = PDF::loadView('admin.Invoices.downloadView', compact('InvoiceDetails','InvoiceSettings', 'transaction', 'Currency', 'addOnProduct', 'taxes', 'Company'));
            $filename = 'invoice_' . $id . '.pdf';
            $pdfFiles[] = [
                'file' => $pdf->output(),
                'filename' => $filename
            ];
        }


        if (count($ids) > 1) {
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
        } else {
            $pdfContent = isset($pdfFiles[0]['file']) ? $pdfFiles[0]['file'] : null;

            return response()->streamDownload(function () use ($pdfContent) {
                echo $pdfContent;
            }, $pdfFiles[0]['filename']);
        }
    }

    //edit
    public function edit(Request $req)
    {
        $id = Auth::user()->id;
        // $user = User::find($id);
        $user = User::find($id);
        $ClientDetail = ClientDetail::where('user_id', $id)->first();
       
        $Role = Role::get();
        $Country = Country::get();
        
        if($ClientDetail && $ClientDetail->state){
            $State = State::find($ClientDetail->state);
        }else{
             $State = State::find(1);
        }
        
        if($ClientDetail && $ClientDetail->city){
           $City = City::find($ClientDetail->city);
        }else{
           $City = City::find(1);
        }
        $Currency = Currency::get();
        $Company = CompanyLogin::select('id', 'company_name')->get();
        $Status = Status::get();
        $PaymentMethod = PaymentMethod::get();
        // return $State;
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Client Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Client/edit/' . $id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);
        return view('user.MyProfile.edit', compact('Country', 'user', 'State', 'City', 'Currency', 'Company', 'Status', 'PaymentMethod', 'ClientDetail', 'Role'));
    }
    //updated
   public function update(Request $req)
{
    $id = Auth::user()->id;
    $User = User::find($id);

    $StorageSetting = StorageSetting::find(1);
    $storageLocal = $StorageSetting->status == 0;

    // Base URL for local storage
    $localBaseUrl = url('/public/images/');

    // Handle file uploads for profile_img
    if ($req->hasFile('profile_img')) {
        $profileFilename = 'profile_' . Str::random(4) . '.' . $req->file('profile_img')->getClientOriginalExtension();

        if ($storageLocal) {
            // Store in local public folder
            $req->file('profile_img')->move('public/images/', $profileFilename);
            $User->profile_img = $localBaseUrl . '/' . $profileFilename;
        } else {
            // Store in S3
            $filePath = $this->Upload($StorageSetting, $profileFilename, $req->file('profile_img'));
            $User->profile_img = $filePath;
        }
    }

    // Handle file uploads for doc_verify
    if ($req->hasFile('doc_verify')) {
        $docVerifyFilename = 'doc_' . Str::random(4) . '.' . $req->file('doc_verify')->getClientOriginalExtension();

        if ($storageLocal) {
            // Store in local public folder
            $req->file('doc_verify')->move('public/images/', $docVerifyFilename);
            $User->doc_verify = $localBaseUrl . '/' . $docVerifyFilename;
        } else {
            // Store in S3
            $filePath = $this->Upload($StorageSetting, $docVerifyFilename, $req->file('doc_verify'));
            $User->doc_verify = $filePath;
        }
    }

    $User['gender'] = $req->gender;
    $User['first_name'] = $req->first_name;
    $User['last_name'] = $req->last_name;
    $User['email'] = $req->email;
    $User['phone_number'] = $req->phone_number;
    $User['company_name'] = $req->company_name;
    $User['password'] = Hash::make($req->password);
    $User['type'] = '2';
    $User['status'] = '1';
    $User->save();

    $Clidet = ClientDetail::where('user_id', $id)->first();
    $Clidet['company_id'] = $req->company_id;
    $Clidet['address_1'] = $req->address_1;
    $Clidet['address_2'] = $req->address_2;
    $Clidet['country'] = $req->country;
    $Clidet['state'] = $req->state;
    $Clidet['city'] = $req->city;
    $Clidet['pincode'] = $req->pincode;
    $Clidet['gstin'] = $req->gstin;
    $Clidet['hsn_sac'] = $req->hsn_sac;
    $Clidet['tds'] = $req->tds;
    $Clidet->save();

    $profile_status = User::find(Auth::user()->id);
    if ($profile_status && $Clidet->gstin != null && $Clidet->hsn_sac != null && $Clidet->tds != null && $User->phone_number != null) {
        $profile_status->profile_status = 1;
        $profile_status->save();
    }

    $agent = new Agent();
    $browser = $agent->browser();
    $version = $agent->version($browser);
    $Log = $req->all();
    $Log['user_id'] = Auth::user()->id;
    $Log['ip'] = $req->ip();
    $Log['subject'] = "Client Data Updated By " . Auth::user()->first_name;
    $Log['url'] = url('/') . '/MyProfile/update/' . $id;
    $Log['method'] = "Post";
    $Log['browser'] = $browser . "-" . $version;
    LogActivity::create($Log);

    return redirect('user/MyProfile')->with('success', "Client Edit Successfully");
}

// Upload function for S3
public function Upload($StorageSetting, $fileName, $file)
{
    config([
        'filesystems.disks.s3.key' => $StorageSetting->AWS_ACCESS_KEY_ID,
        'filesystems.disks.s3.secret' => $StorageSetting->AWS_SECRET_ACCESS_KEY,
        'filesystems.disks.s3.region' => $StorageSetting->AWS_DEFAULT_REGION,
        'filesystems.disks.s3.bucket' => $StorageSetting->AWS_BUCKET,
    ]);

    $basePath = 'images/' . date('y') . '/' . date('m') . '/' . $fileName;
    $path = Storage::disk('s3')->put($basePath, $file);
    $url = $StorageSetting->S3_BASE_URL . '/' . $path;

    return $url;
}


    //get state data thorugh ajex
    public function Get_StateData(Request $req)
    {
        $State = State::where('country_id', $req->countryid)->get();
        return response()->json(['status' => 200, 'success' => true, 'states' => $State]);
    }
    //get city data thorugh ajex
    public function Get_CityData(Request $req)
    {
        $City = City::where('state_id', $req->stateid)->get();
        return response()->json(['status' => 200, 'success' => true, 'citys' => $City]);
    }
    public function changePassword(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        // Validate the form data
        $request->validate([
            'newPassword' => 'required',
            'confirmPassword' => 'required|same:newPassword',
        ]);
        // Update the user's password
        $user->update([
            'password' => Hash::make($request->input('newPassword')),
        ]);
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = $id; // Use the obtained $id value here
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Task Edit Page is Viewed By " . $user->first_name;
        $Log['url'] = url('/') . '/admin/Task/edit/' . $id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);
        // return response()->json(['status' => true, 'message' => 'Password updated successfully.'], 200);
        return redirect('user/MyProfile')->with('success', "Password Changed Successfully");
    }
    /////////////show user invoice
    public function userInvoice(Request $request)
{
    $id = Auth::user()->id;
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
    ->where(function($q) use ($id) {
        $q->where('invoices.client_id', $id)
          ->orWhere('invoices.user_id', $id);
    })
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
                SUM(CASE WHEN is_payment_recieved = 0 AND due_date < CURRENT_DATE() THEN final_total_amt - paid_amount ELSE 0 END) AS total_due
            ")
            ->where('invoices.deleted_at', null)
            ->where('currency', $currency->id)
            ->where(function($q) use ($id) {
                $q->where('client_id', $id)
                  ->orWhere('user_id', $id);
            });

        if ($request->filled('fDate') && $request->filled('tDate')) {
            $query->whereBetween('invoices.created_at', [$fDate, $tDate]);
        }

        $result[$currency->code] = $query->first();
    }

    $default_currency = Currency::where('is_default', 1)->first();
    return view('user.useServices.userInvoice', compact('Invoice', 'result', 'fDate', 'tDate', 'cName', 'status', 'default_currency', 'currencies', 'invoiceId'));
}

    /////////////show user Ticket
    public function userTicket(Request $request)
    {
        $id = Auth::user()->id;


        $query = Ticket::join('users', 'tickets.client_id', 'users.id')
            ->join('departments', 'tickets.department_id', 'departments.id')
            ->where('tickets.client_id', $id)
            ->orderBy('tickets.id', 'desc');
        if (isset($request->status) && $request->status != '') {
            $query->where('tickets.status', $request->status);
        }

        if ($request->has('date')) {
            switch ($request->get('date')) {
                case 'today':
                    $fromDate = now()->startOfDay();
                    $toDate = now()->endOfDay();
                    break;
                case 'month':
                    $fromDate = now()->startOfMonth();
                    $toDate = now()->endOfMonth();
                    break;
                case 'last':
                    $fromDate = now()->startOfMonth()->subMonth();
                    $toDate = now()->endOfMonth()->subMonth();
                    break;
                case 'custom':
                    // Handle custom date range
                    $fromDate = $request->input('from');
                    $toDate = $request->input('to');
                    break;
                default:
                    $fromDate = null;
                    $toDate = null;
                    // Handle other cases if needed
            }

            // Add whereBetween clause only if both fromDate and toDate are set
            if ($fromDate && $toDate) {
                $query->whereBetween('tickets.created_at', [$fromDate, $toDate]);
            }
        }
        $query->select('tickets.*', 'departments.name as department_name', 'users.first_name as client_name');

        $Tickets = $query->paginate(10);

        foreach ($Tickets as $key => $value) {
            $value->last_reply_date = Chat::where('ticket_id', $value->id)->latest()->value('created_at');
        }

        $Open = Ticket::where('client_id', $id)->where('status', 1)->count();
        $InProgress = Ticket::where('client_id', $id)->where('status', 2)->count();
        $OnHold = Ticket::where('client_id', $id)->where('status', 3)->count();
        $Resolved = Ticket::where('client_id', $id)->where('status', 4)->count();
        $Closed = Ticket::where('client_id', $id)->where('status', 5)->count();

        return view('user.userTicket.userTicket', compact('Tickets', 'Open', 'InProgress', 'OnHold', 'Resolved', 'Closed'));
    }
    /////////////show user Log Activity
    public function userLogActivity(Request $request)
    {
        $id = Auth::user()->id;
        $LastloginLogActivity = LogActivity::where('user_id', $id)->orderBy('created_at', 'desc')->first();
        return view('user.userLogScreen.userLogScreen', compact('LastloginLogActivity'));
    }
    ////update payment status
    public function paymentStatusUpdate(Request $request)
    {
        $orderId = Orders::join('product_news', 'orders.product_id', 'product_news.id')->where('orders.invoice_id', $request->orderId)->select('product_news.product_name', 'orders.id as neworder_id')->first();
        if ($orderId == '') {
            return redirect()->back()->with('error', 'Product Not Found');
        }
       
        $invoiceData = Invoice::where('id', $request->orderId)->first();
        $invoice = Invoice::where('id', $request->orderId)->first();
        // echo "<pre>"; print_r($invoiceData); exit;

        if($invoice->paid_amount == $invoice->final_total_amt){
            $order->is_payment_recieved = 1;
             $invoiceData = Invoice::where('id', $request->orderId)->update(['is_payment_recieved' => 1]);
        }else{
                $order->is_payment_recieved = 0;
                 $invoiceData = Invoice::where('id', $request->orderId)->update(['is_payment_recieved' => 0]);
        }
        $order = Orders::find($orderId->neworder_id);
        
        $order->save();


        $user_id = $orderId->client_id;

        $billing_cycle = $order->billing_cycle;
        $product_id = $order->product_id;
        $get_prod = ProductNew::find($product_id);
        $get_plan = ProductPricing::find($order->billing_cycle);
        $category_id = $get_prod->category_id;
        $order->invoice_id = $invoiceData->id;
        $order->hostname =  $request->hostname;
        $order->productCategoryId =  $category_id;
        $order->save();
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

        $class = $classMap[$category_id] ?? BareMetal::class; // Default to BareMetal if category ID not found
        $add_service_data = new $class;
        $add_service_data->user_id = Auth::user()->id;
        $add_service_data->customer_id = Auth::user()->id;
        $add_service_data->product_id = $product_id;
        $add_service_data->host_domain_name = $request->hostname ?? '';
        $add_service_data->os_id = $order->os_id;
        $add_service_data->service_type = $request->service_type ?? 1;
        $add_service_data->invoice_id = $invoice->id ?? 0;
        // $add_service_data->billing_cycle = $request->billingcycle ?? '2';
        $add_service_data->payment_method_id = $request->payment_id;
        $add_service_data->signup_date = date('Y-m-d');
        if ($billing_cycle == 2 || $billing_cycle == 'onetime') {
            // Calculate next due date
            $add_days = 30;
            $next_due_date = strtotime("+$add_days days", strtotime(date('Y-m-d')));
            $add_service_data->next_due_date = date('Y-m-d', $next_due_date); //but invoice will not generate bcs plan type in onetime

            // $add_service_data->next_due_date = date('Y-m-d');
        } else {
            $plan_type = $get_prod->plan_type;
            if ($get_plan && $get_plan->product_plan == 3) {


                switch ($plan_type) {
                    case 'triennially':
                        $add_days = 1095;
                        $next_due_date = strtotime("+$add_days days", strtotime(date('Y-m-d')));
                        break;
                    case 'biennially':
                        $add_days = 730;
                        $next_due_date = strtotime("+$add_days days", strtotime(date('Y-m-d')));
                        break;
                    case 'annually':
                        $add_days = 365;
                        $next_due_date = strtotime("+$add_days days", strtotime(date('Y-m-d')));
                        break;
                    case 'semiannually':
                        $add_days = 150;
                        $next_due_date = strtotime("+$add_days days", strtotime(date('Y-m-d')));
                        break;
                    case 'quarterly':
                        $add_days = 70;
                        $next_due_date = strtotime("+$add_days days", strtotime(date('Y-m-d')));
                        break;
                    case 'monthly':
                        $add_days = 30;
                        $next_due_date = strtotime("+$add_days days", strtotime(date('Y-m-d')));
                        break;
                    case 'hourly':
                        $add_days = 1;
                        $next_due_date = strtotime("+1 hour", strtotime(date('Y-m-d H:i:s')));
                        break;
                    default:
                        $add_days = 30;
                        $next_due_date = strtotime("+$add_days days", strtotime(date('Y-m-d')));
                }
            } else {
                $add_days = 30;
                $next_due_date = strtotime("+$add_days days", strtotime(date('Y-m-d')));
            }
            $add_service_data->next_due_date = date('Y-m-d H:i:s', $next_due_date);
        }
        $add_service_data->billing_cycle = $plan_type;
        $add_service_data->status = 1;
        $add_service_data->save();
        // return  $class;


        $Transaction = [
            'user_id' => auth()->id(),
            'invoice_id' => $invoice->id,
            'paymentMethod' => 'Razorpay',
            'razorpay_payment_id' => $request->payment_id,
            'amount' => $order->total_amt,
        ];

        Transaction::create($Transaction);

        $logData = [
            'user_id' => auth()->id(),
            'ip' => $request->ip(),
            'subject' => "Invoice data auto-generated and stored by " . auth()->user()->first_name,
            'url' => url('/') . '/user/Invoices/store',
            'method' => "Post",
            'browser' => (new Agent())->browser() . "-" . (new Agent())->version((new Agent())->browser()),
        ];

        LogActivity::create($logData);


        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $user = User::find($user_id);
        $Ticket = Ticket::where('client_id', $user_id)->get();
        $Invoice = Invoice::with('orders')->find($invoice->id);
        $Currency = Currency::where('is_default', 1)->first();
        $InvoiceDetailsAll = Orders::where('invoice_id', $invoice->id)
            ->with('user', 'clientDetails')
            ->first();
        $InvoiceSettings = InvoiceSettings::first();

        $InvoiceDetails = Invoice::with('orders.product')
            ->leftJoin('users', 'users.id', 'invoices.client_id')
            ->leftJoin('client_details', 'client_details.user_id', 'invoices.client_id')
            ->leftJoin('currencies', 'currencies.id', 'invoices.currency')
            ->leftJoin('company_logins', 'company_logins.id', 'client_details.company_id')
            ->select(
                'invoices.*',
                'users.first_name',
                'users.last_name',
                'users.phone_number',
                'users.email',
                'client_details.address_2',
                'client_details.address_1',
                'client_details.pincode',
                'client_details.gstin as ',
                'company_logins.company_name',
                'company_logins.address_1 as comp_address1',
                'company_logins.address_2 as comp_address2',
                'company_logins.pin_code as comp_pincode',
                'company_logins.email_address as comp_email',
                'company_logins.contact_no as comp_phone',
                'company_logins.pan_number',
                'company_logins.hsn_number',
                'company_logins.tan_number',
                'company_logins.gst_number',
                'currencies.prefix',
                'tax_settings.rate',
                'product_pricing.price'
            )
            ->with(['orders.product' => function ($query) {
                $query->select('id', 'description', 'product_name', 'tax_id');
            }])
            ->join('orders', 'invoices.id', 'orders.invoice_id')
            ->join('product_pricing', 'product_pricing.id', 'orders.billing_cycle')
             ->join('tax_settings', 'orders.taxes', 'tax_settings.id')
            ->where('invoices.id', $invoice->id)
            ->first();

        $addOnProduct = AddonOrder::join('product_news', 'product_news.id', 'addon_orders.addon_id')
            ->join('product_pricing', 'product_news.id', 'product_pricing.product_id')
            ->where('order_id', optional($InvoiceDetails)->order_id)
            ->select('addon_orders.*', 'product_news.product_name', 'product_news.description', 'product_pricing.price')
            ->distinct()
            ->get();


        $Currency  = Currency::where('is_default', 1)->first();

        $taxes = TaxSetting::where('status', 1)->get();

        // return $taxes;

        $transaction = Transaction::where('invoice_id', optional($InvoiceDetails)->id)->first();

        $Company = CompanyLogin::find(1);
        $Project = Project::where('status_id', 1)->get();

        $user_id = $invoice->client_id;
        $user = User::find($invoice->client_id);

        $invoiceData = $this->getInvoiceDetails($invoice->id);
        $InvoiceDetails = $invoiceData['InvoiceDetails'];
        $transaction = $invoiceData['transaction'];
        $Currency = $invoiceData['Currency'];
        $InvoiceSettings = $invoiceData['InvoiceSettings'];
        $addOnProduct = $invoiceData['addOnProduct'];
        $taxes = $invoiceData['taxes'];
        $Company = $invoiceData['Company'];

        $pdf = PDF::loadView('admin.Invoices.downloadView', compact('InvoiceDetails', 'transaction','InvoiceSettings', 'Currency', 'addOnProduct', 'taxes', 'Company'));

        // Save PDF file
        $pdfDirectory = public_path('pdf');

        if (!File::isDirectory($pdfDirectory)) {
            // If the directory doesn't exist, create it
            File::makeDirectory($pdfDirectory, 0755, true, true);
        }
        $pdfFilePath = public_path('pdf/invoice_' . $invoice->id . '.pdf');

        $pdf->save($pdfFilePath);

        $emails = $user->email;
        if ($emails) {
            // $MailSettings = MailSettings::where('type', 'Bulk')->where('id', 1)->first();
            $TemplateSettings = Template::where('name', 'Invoice Submission')->first();

            $productName = ProductNew::find($order->product_id);

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

            if ($invoice->is_payment_recieved != 1) {
                $invoice->final_total_amt == $invoice->final_total_amt;
            } else {
                $invoice->final_total_amt =  0.00;
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

            $contactDetail = EmployeeDetail::join('users', 'employee_details.company_id', 'users.id')->where('employee_details.user_id', 1)->select('employee_details.signature', 'users.first_name')->first();
            $messageReplacementsTemplate1 = $TemplateSettings1->template;
            $template1 = str_replace(array_keys($replacementsTemplate1), array_values($replacementsTemplate1), $messageReplacementsTemplate1);

            $template1 = str_replace(array_keys($replacementsTemplate1), array_values($replacementsTemplate1), $messageReplacementsTemplate1);
            $header1 = $TemplateSettings1->header;
            $footer1 = $TemplateSettings1->footer;


            Mail::to($emails)->send(new InvoicePaymentConfirmation($subject1, $header1, $template1, $footer1));

            Mail::to($emails)->send(new InvoiceGenerated($pdfFilePath, $subject, $header, $template, $footer, $invoice));
            $emails = Auth::user()->email;
        }
        return redirect()->back();
    }

    ///////////userInvoiceView
    public function userInvoiceView($id)
    {

       $data = $this->getInvoiceDetails($id);
    
            $InvoiceDetails = $data['InvoiceDetails'];

            $transaction = $data['transaction'];
            $Currency = $data['Currency'];
            $addOnProduct = $data['addOnProduct'];
            $OsOrder = $data['OsOrder'];
            $taxes = $data['taxes'];
            $InvoiceSettings = $data['InvoiceSettings'];
            $Company = $data['Company'];
            $clientDetails = $data['clientDetails'];

        return view('user.useServices.view', compact('InvoiceDetails','clientDetails','InvoiceSettings', 'transaction','OsOrder', 'Currency', 'addOnProduct', 'taxes','Company'));
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
        'InvoiceDetails' => $InvoiceDetails,
        'clientDetails' => $clientDetails,
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
    public function getInvoiceDetailssOld1($id)
{
    $invoice = Invoice::find($id);
    if ($invoice->project_id) {
        $InvoiceDetails = Invoice::with('orders')
            ->leftJoin('users', 'users.id', 'invoices.client_id')
            ->leftJoin('client_details', 'client_details.user_id', 'invoices.client_id')
            ->leftJoin('currencies', 'currencies.id', 'invoices.currency')
            ->leftJoin('orders', 'invoices.id', 'orders.invoice_id')
            ->leftJoin('product_pricing', 'product_pricing.id', 'orders.billing_cycle')
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
             ->leftJoin('currencies', 'currencies.id', 'o_s_categories.currency_id')
            ->where('os_orders.order_id', $InvoiceDetails->orders->id)
            ->where('o_s_categories.category_id', $findProduct->category_id)
            ->where('o_s_categories.currency_id', $InvoiceDetails->orders->currency)
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
        $InvoiceDetails = Invoice::with('orders.product')
            ->leftJoin('users', 'users.id', 'invoices.client_id')
            ->leftJoin('client_details', 'client_details.user_id', 'invoices.client_id')
            ->leftJoin('currencies', 'currencies.id', 'invoices.currency')
            ->leftJoin('orders', 'invoices.id', 'orders.invoice_id')
             ->leftJoin('product_pricing', 'product_pricing.id', 'orders.billing_cycle')
            ->leftJoin('tax_settings', 'orders.taxes', 'tax_settings.id')
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

    $data = [
        'InvoiceDetails' => $InvoiceDetails,
        'addOnProduct' => $addOnProduct,
        'OsOrder' => $OsOrder, // Add OsOrder to the data array
        'Currency' => $Currency,
        'taxes' => $taxes,
        'Company' => $Company,
        'transaction' => $transaction,
    ];
    return $data;
}




 

    public function twoFA()
    {
        return view('user.TwoStepAuth.index');
    }
    public function twoFAauthSelection()
    {
        return view('user.TwoStepAuth.authSelection');
    }

public function TwoStepMethod(Request $request)
{
    // Retrieve the user ID from the session
    $userId = $request->session()->get('2fa:user:id');

    $user = User::find($userId);

    if (!$user) {
        return redirect()->back()->with('error', 'User not found.');
    }

    $authMethod = $request->authMethod;

      if ($authMethod == 'email') {
        // Handle email method
        $user->twoFA_via = 1;
        $user->save();
        
         $emails = $user->email;
                    if ($emails) {
                        // Generate a 4-digit OTP
                        $otp = rand(100000, 999999);

                        // Store OTP in the user model
                        $user->rand_otp = $otp; // Ensure you have an 'rand_otp' column in the users table or use another storage method
                        $user->save();

                        // Prepare and send the email
                        $templateSettings = Template::where('name', 'Two Factor Authentication')->first();
                        $userDetail = User::find($user->id);

                        if ($templateSettings && $userDetail) {
                            $subject = $templateSettings->subject;
                            $header = $templateSettings->header;
                            $template = $templateSettings->template;
                            $footer = $templateSettings->footer;

                            // Replace placeholders in the email template
                            $replacementsTemplate = [
                                '{Employee Name}' => $userDetail->first_name,
                                '[Users Name]' => $userDetail->first_name,
                                '[123456]' => $otp, // Add OTP to the template
                                '[Your Company Name]' => 'CloudTechtiq',
                                '[Company Name]' => 'CloudTechtiq',
                            ];
                           
                                       
                                        $template = str_replace(array_keys($replacementsTemplate), array_values($replacementsTemplate), $template);
                        
                            // Send email
                            Mail::to($userDetail->email)->send(new TicketMail($subject, $header, $template, $footer));
                            
                            return redirect('two-factor-authentication');
        }
                    }
    } elseif ($authMethod == '2faGoogle') {
        // Handle Google Authenticator method
       
                
             $google2fa = new Google2FA();
                $secretKey = $google2fa->generateSecretKey();
                $qrCodeUrl = $google2fa->getQRCodeUrl('Cloud Techtiq', $user->email, $secretKey);
                // Generate the QR code image
                $qrCodeImage = QrCode::size(200)->generate($qrCodeUrl);
                
                $user->twoFA_via = 2;
                $user->two_factor_secret = $secretKey;
                $user->google2fa_enabled = 1;
                $user->save();
                
               
                       return view('user.TwoStepAuth.qrCode', compact('qrCodeImage', 'secretKey'));
                        return redirect()->back()->with('success', 'Two-factor authentication enabled successfully.');


    } else {
        // Disable 2FA
        $user->twoFA_via = 0;
        $user->save();
         return redirect()->back()->with('error', 'Something Went Wrong.');
    }

   
}

  public function enable(Request $request)
    {
         // Retrieve the user ID from the session
    $userId = $request->session()->get('2fa:user:id');
  
        $user = User::find(Auth::user()->id);
        $google2fa = new Google2FA();
        $two_factor_secret = $request->two_factor_secret;
        try {
            if ($google2fa->verifyKey($two_factor_secret, $request->two_factor_recovery_codes)) {
                $user->two_factor_secret = $request->two_factor_secret;
                $user->google2fa_enabled = 1;
                $user->save();
                Auth::login($user);
                 if ($user->type == "2" && $user->email_verified_at != null && ($user->status == 4 || $user->status == 1)) {
                 
    
                    $logData = [
                        'user_id' => $user->id,
                        'ip' => request()->ip(),
                        'type' => 'login',
                        'login_time' => now(),
                    ];
    
                    LogActivity::create($logData);
    
                    return redirect('user/dashboard');
                } else {
                    Auth::logout();
                    return redirect('/')->with('error', 'Login details are not valid');
                }
                // return redirect()->back()->with('success','Two factor authentication enabled successfully.');
            }else{
                return redirect()->back()->with('error','Provided code is invalid.');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Provided code is invalid.');
        }
    }

    public function verify_password(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        if (Hash::check($request->password, $user->password)) {
            if($user->google2fa_enabled){
                $user->google2fa_enabled = 0;
                $user->save();
                return response()->json([
                    'status' => 'disabled',
                    'success' => 'Two factor authentication disabled successfully.',
                ], 200);
            }else{

                $google2fa = new Google2FA();
                $secretKey = $google2fa->generateSecretKey();
                $qrCodeUrl = $google2fa->getQRCodeUrl('Cloud Techtiq', Auth::user()->email, $secretKey);
                // Generate the QR code image
                $qrCodeImage = QrCode::size(200)->generate($qrCodeUrl);
                return view('user.MyProfile.qrCode', compact('qrCodeImage', 'secretKey'));
            }
            // return $qrCodeImage;
        } else {
            return response()->json([
                'error' => 'Password incorrect',
            ], 422); // 422 is the HTTP status code for Unprocessable Entity
        }
    }

    public function verify(Request $request)
    {

        $request->validate([
            'two_factor_recovery_codes' => 'required',
        ]);

        $user_id = $request->session()->get('2fa:user:id');

        if (!$user_id) {
            return redirect()->route('/');
        }

        $user = User::find($user_id);

        $google2fa = new Google2FA();
        $two_factor_secret = $user->two_factor_secret;
        try {
            if($user->twoFA_via == 2){
            if ($google2fa->verifyKey($two_factor_secret, $request->two_factor_recovery_codes)) {
                Auth::login($user);
                return redirect("user/dashboard");
            }else{
                return redirect()->back()->with('error','Provided code is invalid.');
            }
            }else{
                if($user->rand_otp == $request->two_factor_recovery_codes) {
                Auth::login($user);
                return redirect("user/dashboard");
            }else{
                return redirect()->back()->with('error','Provided code is invalid.');
            }
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error','Provided code is invalid.');
        }
    }
    
    public function creditStore(Request $request){
        Credit::create([
            'amount'=>$request->amount,
            'client_id'=>Auth::user()->id
        ]);
        
        Transaction::create([
            'user_id' => Auth::user()->id,
            'amount' => $request->amount,
            'razorpay_payment_id' => $request->payment_id,
            'paymentMethod' => 'Razorpay'
        ]);
        
        // Change the message here
        return redirect('user/MyProfile')->with('success', 'Your wallet has been successfully credited.');
    }

}
