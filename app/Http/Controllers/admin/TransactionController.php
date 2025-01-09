<?php

namespace App\Http\Controllers\admin;

use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InventoryExport; 
use App\Exports\InvoiceExport; 
use Illuminate\Support\Collection;
use App\Models\OperatingSysten;
use App\Models\PaymentMethod;   
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use App\Models\CompanyLogin;
use App\Models\IPAddress;
use App\Models\ProductNew;
use App\Models\Project;   
use App\Models\Inventory;   
use App\Models\Orders;   
use App\Models\Invoice;   
use App\Models\TaxSetting;
use App\Models\Countrys;
use App\Models\ClientDetail;
use App\Models\Ticket;
use App\Models\Employee;
use App\Models\Currency;   
use App\Models\Firewall;
use App\Models\Product;
use App\Models\InvoiceSettings;
use App\Models\Switchs;
use App\Models\Status;
use App\Models\User;
use App\Models\Rack;
use Hash;
use Validator;
use Auth;
use View;
use DB;
use PDF;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceGenerated;
use App\Models\MailSettings;
use App\Models\Template;
use ZipArchive;

class TransactionController extends Controller
{   
    //home page
public function home(Request $request)
{
    $invoices = DB::table('invoices')
        ->select('invoices.*','users.company_name','users.id as users_ids', 'currencies.prefix', 'users.first_name', 'users.last_name', 'users.profile_img', 'users.email','transactions.razorpay_payment_id')
        ->leftJoin('users', 'users.id', '=', 'invoices.client_id')
        ->leftJoin('transactions', 'invoices.id', '=', 'transactions.invoice_id')
        ->leftJoin('client_details', 'client_details.user_id', '=', 'users.id')
        ->leftJoin('currencies', 'currencies.id', '=', 'invoices.currency')
        
        ->where('invoices.is_payment_recieved', '1')
        ->orderBy('invoices.created_at', 'desc')
        ->groupBy('transactions.id')
        ->paginate(10);

    $totalAmount = DB::table('invoices')
        ->where('is_payment_recieved', '1')
        ->sum('amount');


    return view('admin.Transaction.home', compact('invoices', 'totalAmount'));
}
public function home2(Request $request)
{
    $query = Invoice::select('invoices.*','users.first_name','users.id as user_id','users.last_name','users.profile_img','users.email', 'projects.project_name', 'projects.id as projects_id', 'products.product_name', 'products.id as products_id', 'company_logins.company_name')
    ->leftJoin('users', 'users.id', 'invoices.client_id')
    ->leftJoin('projects', 'projects.id', 'invoices.project_id')
    ->leftJoin('orders', 'orders.invoice_id', '=', 'invoices.id')
    ->leftJoin('products','products.id','orders.product_id')
    ->leftJoin('client_details','client_details.user_id','users.id')
    ->leftJoin('company_logins','company_logins.id','client_details.company_id')
    ->orderBy('invoices.created_at','desc');
    $searchTerm = '';
    // Check if a search term is provided in the request
    if ($request->has('search')) {
        $searchTerm = $request->input('search');
        // Modify the query to search for the provided term
        $query->where(function ($q) use ($searchTerm) {
            $q->where('invoices.invoice_number1', 'like', '%' . $searchTerm . '%')
            ->orWhere('invoices.issue_date', 'like', '%' . $searchTerm . '%')
            ->orWhere('invoices.invoice_number2', 'like', '%' . $searchTerm . '%')
            ->orWhere('invoices.due_date', 'like', '%' . $searchTerm . '%')
            ->orWhere('invoices.shipping_address', 'like', '%' . $searchTerm . '%')
            ->orWhere('users.first_name', 'like', '%' . $searchTerm . '%');
        });
    }
    // Execute the query and paginate the results
    $Invoice = $query->paginate(10);
    // echo "<pre>"; print_r($Invoice); exit;
    $Invoice->appends(['search' => $searchTerm]);
    return view('admin.Invoices.home', compact('Invoice', 'searchTerm'));
}
public function homeOld2(Request $request)
{
    $query = Invoice::select('invoices.*','users.first_name','users.last_name','users.profile_img','users.email', 'projects.project_name', 'projects.id as projects_id', 'products.product_name', 'products.id as products_id', 'company_logins.company_name')
    ->leftJoin('users', 'users.id', 'invoices.client_id')
    ->leftJoin('projects', 'projects.id', 'invoices.project_id')
    ->leftJoin('orders', 'orders.invoice_id', '=', 'invoices.id')
    ->leftJoin('products','products.id','orders.product_id')
    ->leftJoin('client_details','client_details.user_id','users.id')
    ->leftJoin('company_logins','company_logins.id','client_details.company_id')
    ->orderBy('invoices.created_at','desc');

    $searchTerm = '';

    // Check if a search term is provided in the request
    if ($request->has('search')) {
        $searchTerm = $request->input('search');

        // Modify the query to search for the provided term
        $query->where(function ($q) use ($searchTerm) {
            $q->where('invoices.name', 'like', '%' . $searchTerm . '%')
            ->orWhere('invoices.issue_date', 'like', '%' . $searchTerm . '%')
            ->orWhere('invoices.invoice_number1', 'like', '%' . $searchTerm . '%')
            ->orWhere('invoices.invoice_number2', 'like', '%' . $searchTerm . '%')
            ->orWhere('invoices.due_date', 'like', '%' . $searchTerm . '%')
            ->orsWhere('invoices.shipping_address', 'like', '%' . $searchTerm . '%')
            ->orWhere('users.first_name', 'like', '%' . $searchTerm . '%');
        });
    }

    $Invoice = $query->paginate(10);
    $Invoice->appends(['search' => $searchTerm]);

    return view('admin.Invoices.home', compact('Invoice', 'searchTerm'));
}


public function selectedCurrencyData(Request $request){
    $selectedCurrencyId = $request->selectedCurrencyId;
    $currencyData = Currency::find($selectedCurrencyId);
    return response(['status' => true, 'data' => $currencyData,'currency_id'=>$selectedCurrencyId]);

}
public function get_product_price(Request $request)
{
    $agent = new Agent();
    $browser = $agent->browser();
    $version = $agent->version($browser);

    $log = $request->all();
    $log['user_id'] = Auth::user()->id;
    $log['ip'] = $request->ip();
    $log['subject'] = "Invoices Data Deleted By " . Auth::user()->first_name;
                $log['url'] = url('/') . '/admin/Invoices/delete/' . $request->selectedServiceId; // Fixing the $id issue
                $log['method'] = "GET";
                $log['browser'] = $browser . "-" . $version;

                LogActivity::create($log);

                $getPrice = Orders::where('id', $request->OrderID)->select('id', 'total_amt', 'order_type')->first();

                if ($getPrice) {
                    $total_amt = number_format(floatval($getPrice->total_amt), 2, '.', '');
                } else {
                    $total_amt = 0.00;
                }
                // $getPrice = ProductNew::
                // leftJoin('product_pricings', 'product_pricings.product_id', '=', 'product_news.id')
                // where('product_pricings.product_id', $request->selectedServiceId)->select('id', $request->selectedServiceType)->first();

                return response(['status' => true, 'data' => $total_amt]);
            }
            public function check_invoice_number(Request $request)
            {
                $invoice_number2 = $request->invoice_number2;
                $check_invoice_number2 = Invoice::where('invoice_number2', $invoice_number2)->first();

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
                $check_plan = Orders::where('product_id', $selectedServiceId)->where('client_id', $selectedClientId)->select('services_type','id')->count();

                if ($check_plan > 0) {
                    $get_plans = Orders::where('product_id', $selectedServiceId)->where('client_id', $selectedClientId)->select('services_type','id')->get();
                    return response()->json(['status' => true, 'message' => 'Data Found Successfully', 'data' => $get_plans, 'selectedServiceId' => $selectedServiceId, 'selectedClientId' => $selectedClientId]);
                } else {
                    return response()->json(['status' => false, 'message' => 'Data Not Found', 'data' => null, 'selectedServiceId' => $selectedServiceId, 'selectedClientId' => $selectedClientId]);
                }
            }


            public function Create(Request $request)
            {   
                $agent = new Agent();
                $browser = $agent->browser();
                $version = $agent->version($browser);
                $Log = $request->all();
                $Log['user_id'] = Auth::user()->id;
                $Log['ip'] = $request->ip();
                $Log['subject'] = "Invoices Create Page is View By " . Auth::user()->first_name;
                $Log['url'] = url('/') . '/admin/Invoices/Create';
                $Log['method'] = "Get";
                $Log['browser'] = $browser . "-" . $version;
                LogActivity::create($Log);
                $Company = CompanyLogin::get();
                $billing_address = CompanyLogin::where('user_id',Auth::user()->id)->first();
                $Tax = TaxSetting::get();
                $default_currency = Currency::where('is_default',1)->first();

                $orders = Orders::get();
                $currencies = Currency::get();
                $Service = Product::get();
                $ProductNew = ProductNew::get();
                $Vendor = User::select('id','first_name')->where('type','3')->get();
                $Employee = User::select('first_name','id')->where('type',4)->get();
                $Client = User::select('first_name','id')->where('type',2)->get();
                $Project = Project::where('status_id',1)->get();
                if ($request->order_id && $request->order_id > 0) {
                    $selected_order_id = $request->order_id;
                    $SelectedOrders = Orders::
                    leftJoin('product_news', 'product_news.id', '=', 'orders.product_id')
                    ->where('orders.id', $request->order_id)
                    ->select('orders.*','product_news.product_name','product_news.description as products_desc')
                    ->first();
                } else {
                    $selected_order_id = 0;
                    $SelectedOrders = null; 
                }

                $invoice_number2=Invoice::max('invoice_number2') +1;
                return view('admin.Invoices.create',compact('Vendor','orders','default_currency','Employee','Project','ProductNew','Client','Service','currencies','Company','Tax','billing_address','invoice_number2','SelectedOrders','selected_order_id')); 
            }
            public function store(Request $req)
            {
                // return $req->all();
                $validator = Validator::make($req->all(), [
                    'invoice_number1' => 'required',
                    'final_total_amt' => 'required',
                    'invoice_number2' => 'required|unique:invoices,invoice_number2',
                ], [
                    'invoice_number2.unique' => 'Invoice number : ' . $req->invoice_number2 . ' is already taken.',
                    'final_total_amt.required' => 'Total amount can not be empty.',
                ]);

                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
                $url = url('/').'/public/images/';
                $invoice_attachment = 'default_bill_attachment.jpg';
                if ($req->hasFile('invoice_attachment')) {
                    $rand = Str::random(4);
                    $file = $req->file('invoice_attachment');
                    $extension = $file->getClientOriginalExtension();
                    $invoice_attachment = 'bill_'.$rand.'.'.$extension;
                    $file->move('public/images/', $invoice_attachment);
                }
                $data = [
                    'invoice_attachment' => $url . $invoice_attachment,
                    'user_id' => Auth::user()->id,
                    'invoice_number1' => $req->invoice_number1,
                    'invoice_number2' => $req->invoice_number2,
                    'issue_date' => $req->issue_date,
                    'amount' => $req->total,
                    'recipient_notes' => $req->recipient_notes,
                    'due_date' => $req->due_date,
                    'currency' => $req->currency,
                    'exchange_rate' => $req->exchange_rate,
                    'final_total_amt' => $req->final_total_amt,
                    'client_id' => $req->client_id,
                    'project_id' => $req->project_id,
                    'calc_tax' => $req->calc_tax,
                    'bank_account' => $req->bank_account,
                    'billing_address' => $req->billing_address,
                    'shipping_address' => $req->shipping_address,
                    'generated_by' => $req->generated_by,
                    'is_payment_recieved' => $req->has('is_payment_recieved'),
                ];
                $invoice = Invoice::create($data);
                $orders = Orders::where('id', $req->services_type)->get();
                foreach ($orders as $order) {
                    $order->update([
                        'invoice_id' => $invoice->id,
                        'invoice_number' => $invoice->id,
                        'user_id' => Auth::user()->id,
                        'invoice_number2' => $req->invoice_number2,
                        'issue_date' => $req->issue_date,
                        'due_date' => $req->due_date,
                        'item_name' => $req->item_name,
                        'currency' => $req->currency,
                        'cost_per_item' => $req->cost_per_item,
                        'quantity' => $req->quantity,
                        'exchange_rate' => $req->exchange_rate,
                        'discount_value' => $req->discount_value,
                        'project_id' => $req->project_id,
                        'calc_tax' => $req->calc_tax,
                        'taxes' => $req->taxes,
                        'bank_account' => $req->bank_account,
                        'order_status' => 1,
                        'amount' => $req->final_total_amt,
                        'billing_address' => $req->billing_address,
                        'shipping_address' => $req->shipping_address,
                        'generated_by' => $req->generated_by,
                        'recipient_notes' => $req->recipient_notes,
                        'invoice_item_image' => $req->invoice_item_image,
                        'invoice_attachment' => $invoice->invoice_attachment,
                        'product_description' => $invoice->product_description,
                    ]);
                }

                $id=$invoice->id;

                $agent = new Agent();
                $browser = $agent->browser();
                $version = $agent->version($browser);

                $logData = [
                    'user_id' => Auth::user()->id,
                    'ip' => $req->ip(),
                    'subject' => "Invoice Data Store By " . Auth::user()->first_name,
                    'url' => url('/') . '/admin/Invoices/store',
                    'method' => "Post",
                    'browser' => $browser . "-" . $version,
                ];

                LogActivity::create($logData);
                

                $user = User::find($req->client_id);

                $user_id = $req->client_id;
                $Ticket = Ticket::where('client_id', $id)->get();

                $Invoice = Invoice::with('orders')->find($invoice->id);
                $Currency = Currency::where('is_default',1)->first();

                $InvoiceDetailsAll = Orders::where('invoice_id', $id)
                ->with('user', 'clientDetails')
                ->get();
                $InvoiceSettings = InvoiceSettings::first();

                $InvoiceDetails = Invoice::leftJoin('orders', 'orders.invoice_id', '=', 'invoices.id')
                ->leftJoin('users', 'users.id', '=', 'invoices.client_id')
                ->leftJoin('client_details', 'client_details.user_id', '=', 'invoices.client_id')
                ->leftJoin('currencies', 'currencies.id', '=', 'invoices.currency')
                ->leftJoin('company_logins', 'company_logins.id', '=', 'invoices.generated_by')
                ->select('invoices.*', 'orders.*', 'users.id as user_id', 'users.first_name', 'users.last_name', 'users.email', 'client_details.address_2', 'client_details.address_1', 'client_details.pincode', 'company_logins.company_name', 'currencies.prefix', 'currencies.code')
                ->where('invoices.id', $id)
                ->first();

                $Company = CompanyLogin::select('id', 'company_name', 'contact_no')->where('user_id', $user_id)->first();
                $Project = Project::where('status_id', 1)->get();
                // return $InvoiceDetails;
                $data = [
                    'Ticket' => $Ticket,
                    'user' => $user,
                    'Currency' => $Currency,
                    'InvoiceDetails' => $InvoiceDetails,
                    'InvoiceSettings' => $InvoiceSettings,
                    'Invoice' => $Invoice,
                    'InvoiceDetailsAll' => $InvoiceDetailsAll,
                    'Company' => $Company,
                    'Project' => $Project,
                ];


                $pdf = PDF::loadView('admin.Invoices.downloadView', $data);

                 // Save PDF file
                $pdfDirectory = public_path('pdf');
                if (!File::isDirectory($pdfDirectory)) {
                    // If the directory doesn't exist, create it
                    File::makeDirectory($pdfDirectory, 0755, true, true);
                }

                // Save PDF file
                $pdfFilePath = public_path('pdf/invoice_' . $order->id . '.pdf');
                $pdf->save($pdfFilePath);

                // Find user and get email
                $findUser = User::find($req->client_id);
                $emails = $findUser->email;

                // For testing, set a default email
                // $emails = ['nishant@b2infosoft.com','kamana@b2y.in','nilanjana@b2y.in'];

                // Check if emails are available
                // Check if emails are available
    if ($emails) {
        // Fetching the message, subject, header, template, and footer from database
        $MailSettings = MailSettings::where('type', 'Bulk')->where('id', 1)->first();
        $TemplateSettings = Template::where('template_type', 'InvoiceModule')->first();

        if ($MailSettings->smtp == '1' && $TemplateSettings) {
            // Configure mail settings
            config([
                'mail.driver'     => $MailSettings->smtp_mailer,
                'mail.host'       => $MailSettings->smtp_host,
                'mail.port'       => $MailSettings->smtp_port,
                'mail.username'   => $MailSettings->smtp_user_name,
                'mail.password'   => $MailSettings->smtp_password,
                'mail.encryption' => $MailSettings->smtp_encryption,
            ]);

            // Extracting subject, header, template, and footer
            $subject = $TemplateSettings->subject;
            $header = $TemplateSettings->header;
            $template = $TemplateSettings->template;
            $footer = $TemplateSettings->footer;

            // Compose and send email with attached PDF
            Mail::to($emails)->send(new InvoiceGenerated($pdfFilePath, $subject, $header, $template, $footer,$invoice));
        }
    }

    return redirect('admin/Invoices/home')->with('success', "New Invoice Added Successfully");
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
                $Log['subject'] = "Invoices Edit Page is View By " . Auth::user()->first_name;
                $Log['url'] = url('/') . '/admin/Invoices/edit/'.$id;
                $Log['method'] = "Get";
                $Log['browser'] = $browser . "-" . $version;
                LogActivity::create($Log);
                $Client = User::select('first_name','id')->where('type',2)->get();
                $Project = Project::where('status_id',1)->get();
                $Company = CompanyLogin::select('id', 'company_name')->where('user_id', $user_id)->first();
                $Inventory = Invoice::find($id);
                $Vendor = User::select('id','first_name')->where('type','3')->get();
                $Employee = User::select('first_name','id')->where('type',4)->get();
                return view('admin.Invoices.edit',compact('Inventory','Vendor','Employee','id','Client','Project','Company'));
            }

    //updated
            public function update(Request $req, $id)
            {
                $data = Invoice::find($id);
                $data = $req->all();
                $data['invoice_attachment'] = $url . $invoice_attachment;
                $data['user_id'] = Auth::user()->id;
                $data['invoice_number'] = $req->invoice_number1 . $req->invoice_number2;
        // $data['AssignedTo'] = $AssignedTo;
                $data['is_payment_recieved'] = $req->has('is_payment_recieved') ? true : false;
                if($req->hasFile('invoice_attachment')) {
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
               $Log['subject'] = "Invoices Data Updated  By " . Auth::user()->first_name;
               $Log['url'] = url('/') . '/admin/Inventory/update/'.$id;
               $Log['method'] = "Post";
               $Log['browser'] = $browser . "-" . $version;
               LogActivity::create($Log);

               return redirect('admin/Invoices/home')->with('success', "Invoices Edit Successfully");
           }

           public function delete(Request $request,$id)
           {
        //return $id;
            $agent = new Agent();
            $browser = $agent->browser();
            $version = $agent->version($browser);
            $Log = $request->all();
            $Log['user_id'] = Auth::user()->id;
            $Log['ip'] = $request->ip();
            $Log['subject'] = "Invoices Data Deleted  By " . Auth::user()->first_name;
            $Log['url'] = url('/') . '/admin/Invoices/delete/'.$id;
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
            $user_id = Auth::user()->id;
            $user = User::find($id);
            $Ticket = Ticket::where('client_id', $id)->get();

    // Fetching invoice details along with associated orders
            $InvoiceDetails = Invoice::with('orders', 'user', 'clientDetails')
            ->where('invoices.id', $id)
            ->first();
            $InvoiceSettings = InvoiceSettings::first();
            $Invoice = Invoice::with('orders')->find($id);
            $InvoiceDetailsAll = Orders::where('invoice_id', $id)
            ->with('user', 'clientDetails')
            ->get();
            // $InvoiceDetails = Invoice::leftJoin('orders', 'orders.invoice_id', '=', 'invoices.id')
            // ->leftJoin('users', 'users.id', '=', 'invoices.client_id')
            // ->leftJoin('client_details', 'client_details.user_id', '=', 'invoices.client_id')
            // ->leftJoin('currencies', 'currencies.id', '=', 'invoices.currency')
            // ->leftJoin('company_logins', 'company_logins.id', '=', 'invoices.generated_by')
            // ->select('invoices.*', 'orders.*', 'users.id as user_id', 'users.first_name','users.phone_number', 'users.last_name','users.email','client_details.address_2','client_details.address_1','client_details.pincode','company_logins.company_name','currencies.prefix','currencies.code')
            // ->where('invoices.id', $id)
            // ->first(); 
            // echo "<pre>"; print_r($InvoiceDetails); exit;
            $Currency = Currency::where('is_default',1)->first();

            $Company = CompanyLogin::select('id', 'company_name','contact_no')->where('user_id', $user_id)->first();
            $Project = Project::where('status_id', 1)->get();

            return view('admin.Invoices.view', compact('Ticket', 'user', 'InvoiceSettings', 'InvoiceDetails','Currency', 'Invoice', 'InvoiceDetailsAll', 'Company', 'Project'));
        }
        public function downloadPDF(Request $request)
        { 
            $ids =  explode(",", $request->id);
            $user_id = Auth::user()->id;
            $pdfFiles = [];

            foreach($ids as $id)
            {
                $user = User::find($id);
                $Ticket = Ticket::where('client_id', $id)->get();

                $Invoice = Invoice::with('orders')->find($id);
                $Currency = Currency::where('is_default',1)->first();

                $InvoiceDetailsAll = Orders::where('invoice_id', $id)
                ->with('user', 'clientDetails')
                ->get();
                $InvoiceSettings = InvoiceSettings::first();

                $InvoiceDetails = Invoice::leftJoin('orders', 'orders.invoice_id', '=', 'invoices.id')
                ->leftJoin('users', 'users.id', '=', 'invoices.client_id')
                ->leftJoin('client_details', 'client_details.user_id', '=', 'invoices.client_id')
                ->leftJoin('currencies', 'currencies.id', '=', 'invoices.currency')
                ->leftJoin('company_logins', 'company_logins.id', '=', 'invoices.generated_by')
                ->select('invoices.*', 'orders.*', 'users.id as user_id', 'users.first_name', 'users.last_name', 'users.email', 'client_details.address_2', 'client_details.address_1', 'client_details.pincode', 'company_logins.company_name', 'currencies.prefix', 'currencies.code')
                ->where('invoices.id', $id)
                ->first();

                $Company = CompanyLogin::select('id', 'company_name', 'contact_no')->where('user_id', $user_id)->first();
                $Project = Project::where('status_id', 1)->get();

                $data = [
                    'Ticket' => $Ticket,
                    'user' => $user,
                    'Currency' => $Currency,
                    'InvoiceDetails' => $InvoiceDetails,
                    'InvoiceSettings' => $InvoiceSettings,
                    'Invoice' => $Invoice,
                    'InvoiceDetailsAll' => $InvoiceDetailsAll,
                    'Company' => $Company,
                    'Project' => $Project,
                ];

                $pdf = PDF::loadView('admin.Invoices.downloadView', $data);
                $filename = 'invoice_' . $id . '.pdf';
                $pdfFiles[] = [
                    'file' => $pdf->output(),
                    'filename' => $filename
                ];
            }

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
        }

        public function printView(Request $request, $id)
        {
            $user_id = Auth::user()->id;
            $user = User::find($id);
            $Ticket = Ticket::where('client_id', $id)->get();
            $InvoiceSettings = InvoiceSettings::first();

            $Invoice = Invoice::with('orders')->find($id);

    // Fetching all orders associated with the invoice
            $InvoiceDetailsAll = Orders::where('invoice_id', $id)
            ->with('user', 'clientDetails')
            ->get();
            $Currency = Currency::where('is_default',1)->first();

            $InvoiceDetails = Invoice::leftJoin('orders', 'orders.invoice_id', '=', 'invoices.id')
            ->leftJoin('users', 'users.id', '=', 'invoices.client_id')
            ->leftJoin('client_details', 'client_details.user_id', '=', 'invoices.client_id')
            ->leftJoin('currencies', 'currencies.id', '=', 'invoices.currency')
            ->leftJoin('company_logins', 'company_logins.id', '=', 'invoices.generated_by')
            ->select('invoices.*', 'orders.*', 'users.id as user_id', 'users.first_name', 'users.last_name', 'users.email', 'client_details.address_2', 'client_details.address_1', 'client_details.pincode', 'company_logins.company_name', 'currencies.prefix', 'currencies.code')
            ->where('invoices.id', $id)
            ->first();

            $Company = CompanyLogin::select('id', 'company_name', 'contact_no')->where('user_id', $user_id)->first();
            $Project = Project::where('status_id', 1)->get();

            $data = [
                'Ticket' => $Ticket,
                'user' => $user,
                'InvoiceDetails' => $InvoiceDetails,
                'Invoice' => $Invoice,
                'InvoiceDetailsAll' => $InvoiceDetailsAll,
                'Company' => $Company,
                'Project' => $Project,
            ];

            $datas = [
                'title' => 'Welcome to ItSolutionStuff.com',
                'date' => date('m/d/Y'),
                'users' => "ghg",
            ]; 
            
            return view('admin.Invoices.printView', compact('Ticket','Currency','InvoiceSettings', 'user', 'InvoiceDetails', 'Invoice', 'InvoiceDetailsAll', 'Company', 'Project'));


        }

    }
