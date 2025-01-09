<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller; 
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use App\Exports\QuotesExport; 
use App\Models\CompanyLogin;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use App\Models\QuotesCal;
use App\Models\ClientDetail;
use App\Models\Currency;
use App\Models\Employee;
use App\Models\Country;
use App\Models\Product;
use App\Models\AddonOrder;
use App\Models\Quotes;
use App\Models\ProductPricing;
use App\Models\State;
use App\Models\DedicatedServer;
use App\Models\AwsService;
use App\Models\CloudServices;
use App\Models\Credit;
use App\Models\CloudHosting;
use App\Models\OneTimeSetup;
use App\Models\MicrosoftOffice365;
use App\Models\GoogleWorkSpace;
use App\Models\Azure;
use App\Models\BareMetal;
use App\Models\ProductNew;
use App\Models\Transaction;
use App\Models\ProductAddOn;
use App\Models\Project;
use App\Models\OsOrder;
use App\Models\Template;
use App\Models\City;
use App\Models\User;
use App\Models\SSLCertificate;
use App\Models\Acronis;
use App\Models\TsPlus;
use App\Models\Antivirus;
use App\Models\Firewall;
use App\Models\Switchs;
use App\Models\Licenses;
use App\Models\MonthelySetup;
use App\Models\TaxSetting;
use App\Models\InvoiceSettings;
use App\Models\Invoice;
use App\Models\Orders;
use App\Models\Category;
use Hash;
use Auth;
use DB;
use View;
use PDF;
use Mail;
use Illuminate\Support\Facades\File;
use App\Mail\InvoicePaymentConfirmation;
use App\Mail\InvoiceGenerated;



class OrdersController extends Controller
{   
    //home page


    public function home(Request $request)
    {
        $query = Orders::select(
            'orders.id as order_number',
            'orders.order_status',
            'orders.is_payment_recieved',
            'orders.total_amt',
            'orders.client_id',
            'orders.bank_account',
            'orders.updated_at',
            'orders.created_at as order_date',
             'users.first_name',
            'users.last_name',
            'users.id as users_id',
            'users.company_name as comp_name',
            'users.profile_img',
            'users.email',
            'orders.user_id as orderuser_id',
            'product_pricing.product_plan',
            'product_pricing.price',
            'product_pricing.currency_id',
            'product_news.product_name',
            'product_news.description'
        )
            ->leftJoin('users', 'users.id', '=', 'orders.user_id')
            ->leftJoin('product_news', 'product_news.id', '=', 'orders.product_id')
            ->leftJoin('product_pricing', 'product_pricing.product_id', '=', 'product_news.id')
            ->whereNull('product_news.deleted_at')
            ->whereNull('orders.quotes_id')
            // ->where('orders.user_id','!=',1)
           
            ->groupBy('orders.id')
            ->orderBy('orders.created_at', 'desc');

        $searchTerm = $request->input('search', '');
        if ($searchTerm) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('orders.subject', 'like', '%' . $searchTerm . '%')
                    ->orWhere('users.first_name', 'like', '%' . $searchTerm . '%');
            });
        }

        $users = $query->paginate(10);
        $users->appends(['search' => $searchTerm]);

        $totalOrders = Orders::count();
        $delivered = Orders::whereNull('quotes_id')->where('order_status', '1')->count();
        $onHold = Orders::whereNull('quotes_id')->where('order_status', '2')->count();
        $accepted = Orders::whereNull('quotes_id')->where('order_status', '3')->count();
        $lost = Orders::whereNull('quotes_id')->where('order_status', '4')->count();
        $win = Orders::whereNull('quotes_id')->where('order_status', '5')->count();

        return view('admin.Orders.home', compact('users', 'totalOrders', 'delivered', 'onHold', 'accepted', 'lost', 'win', 'searchTerm'));

    }

    public function homes2(Request $request)
    {
        $query = Orders::select(
            'orders.id as order_number',
            'orders.order_status',
            'orders.is_payment_recieved',
            'orders.total_amt',
            'orders.updated_at',
            'orders.created_at as order_date',
            'users.first_name',
            'orders.user_id as order_user_id',
            'users.profile_img',
            'users.id as user_id',
            'product_pricing.product_plan',
            'product_pricing.price',
            'product_pricing.currency_id',
            'product_news.product_name',
            'product_news.description',
            'users.email'
        )
        ->leftJoin('users', 'users.id', '=', 'orders.user_id')
        ->leftJoin('product_news', 'product_news.id', '=', 'orders.product_id')
        ->leftJoin('product_pricing', 'product_pricing.product_id', '=', 'product_news.id')
        ->where('orders.quotes_id',0)
        ->orderBy('orders.created_at', 'desc');

        $searchTerm = $request->input('search', '');

        if ($searchTerm) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('orders.subject', 'like', '%' . $searchTerm . '%')
                ->orWhere('users.first_name', 'like', '%' . $searchTerm . '%');
            });
        }

        $users = $query->paginate(10);
        $users->appends(['search' => $searchTerm]);

        $totalOrders = DB::table('orders')->count();
        $delivered = DB::table('orders')->whereNull('quotes_id')->where('order_status', '1')->count();
        $onHold = DB::table('orders')->whereNull('quotes_id')->where('order_status', '2')->count();
        $accepted = DB::table('orders')->whereNull('quotes_id')->where('order_status', '3')->count();
        $lost = DB::table('orders')->whereNull('quotes_id')->where('order_status', '4')->count();
        $win = DB::table('orders')->whereNull('quotes_id')->where('order_status', '5')->count();

        return view('admin.Orders.home', compact('users', 'totalOrders', 'delivered', 'onHold', 'accepted', 'lost', 'win', 'searchTerm'));
    }


    //home page
    public function Create(Request $request)
    {   
        $Client = User::select('first_name', 'last_name', 'id', 'profile_img')->where('type', 2)->get();
        $products = Category::with('productsWithTax')->get();
                    
        $default_currency = Currency::where('is_default', 1)->first();
        $BillingCycles = ProductNew::leftJoin('product_pricing', 'product_pricing.product_id', '=', 'product_news.id')
            // ->where('product_pricing.product_id', $product_id)
            // ->where('product_pricing.currency_id', $currency)
            ->whereNull('product_pricing.deleted_at')
            ->select('product_pricing.*', 'product_news.payment_type')
            ->groupBy('plan_type')
            ->get();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Quotes Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Quotes/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);
    

        return view('admin.Orders.create',compact('Client','products','BillingCycles','default_currency')); 
    }
    
    public function getAddonProducts($product_id){
        $currency = Currency::where('is_default', 1)->first();
        $addOnProducts=ProductAddOn::where('product_id',$product_id)->first();
        
        if($addOnProducts){
            $addOnProducts = ProductNew::leftJoin('product_pricing', 'product_pricing.product_id', 'product_news.id')
            ->leftJoin('tax_settings', 'tax_settings.id', 'product_news.tax_id')
            ->whereIn('product_news.id', explode(',',$addOnProducts->addon_id))
            ->where('product_pricing.currency_id', $currency->id)
            ->select('product_news.*', 'product_pricing.price', 'tax_settings.rate', 'tax_settings.tax_name')
            ->groupBy('product_news.id')
            ->get();
        }
        
        // return $addOnProducts;
        return view('admin.Orders.addon',compact('addOnProducts'));
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
       $Log['subject'] = "Quotes CSV Export  By " . Auth::user()->first_name;
       $Log['url'] = url('/') . '/admin/Quotes/EXPORTCSV';
       $Log['method'] = "Get";
       $Log['browser'] = $browser . "-" . $version;
       LogActivity::create($Log);
       return Excel::download(new QuotesExport, 'Quotes.csv');
   }
    //home page
    public function store(Request $req)
    {
        
        $url = url('/').'/public/images/';
        $dataa = $req->all();
        
        $signature = 'signature.jpg';
        if ($req->hasFile('signature')) {
            $rand = Str::random(4);
            $file = $req->file('signature');
            $extension = $file->getClientOriginalExtension();
            $signature = 'file_doc_'.$rand.'.'.$extension;
            $file->move('public/images/', $signature);
        }
        $dataa['signature'] = $url . $signature;
        $dataa['user_id'] = Auth::user()->id;
        
        $prod =   ProductNew::find($req->product_id[0]); 
        $tax = $prod->tax_id;
        
        $order = new Orders();
        $order->user_id = Auth::user()->id;
        $order->client_id = $req->client_id;
        $order->issue_date = date('Y-m-d');
        $order->due_date = null;
        $order->generated_by = 1; 
        $order->product_id = $req->product_id[0]; 
        $order->billing_cycle = $req->billingcycle;
        $order->taxes = $tax; 
        $order->quantity = $req->quantity; 
        $order->unit_id = $req->price;  
        $order->cost_per_item = $req->price; 
        $order->amount = $req->totalAmt; 
        $order->total_amt = $req->totalAmt; 
        $order->bank_account = $req->bank_account;
        if(isset($req->is_payment_received)){
            $order->is_payment_recieved = 1;
        }else{
            $order->is_payment_recieved = 0;
        }
        
        $order->save();
        if (isset($req->addon_id[0])) {
            foreach ($req->addon_id as $key => $value) {
                $orderAddon = new AddonOrder;
                $orderAddon->user_id = Auth::user()->id;
                $orderAddon->order_Id = $order->id;
                $orderAddon->addon_id = $value;
                $orderAddon->tax = isset($req->tax_ids[$key]) ? $req->tax_ids[$key] : 0;
                $orderAddon->save();
            }
        }
        
        $invoice_number2 = Invoice::max('invoice_number2');
        $invoice_number2 = (int)$invoice_number2 + 1;
        
        if(isset($req->generate_invoice)){
              if(isset($req->is_payment_received)){
              $is_payment_recieved = 1;
          }else{
              $is_payment_recieved = 0;
          }
            $data = [
                // 'invoice_attachment' => $url . $invoice_attachment,
                'client_id' => $req->client_id,
                'user_id' => Auth::user()->id,
                'product_id' => isset($req->product_id[0]) ? $req->product_id[0] : 0,
                'invoice_number1' => 'INV#',
                'invoice_number2' => $invoice_number2,
                'issue_date' => now(),
                'amount' => str_replace(',','',$req->price),
                // 'due_date' => $req->due_date,
                'order_id' => $order->id,
                'sub_total' => str_replace(',','',$req->price),
                'currency' => $req->currency,
                // 'exchange_rate' => $req->exchange_rate,
                'final_total_amt' => str_replace(',','',$req->totalAmt),
                // 'project_id' => $req->project_id,
                // 'calc_tax' => $req->calc_tax ?? 0,
                'bank_account' => $req->bank_account,
                // 'billing_address' => $req->billing_address,
                // 'shipping_address' => $req->shipping_address,
                'generated_by' => 1,
                'is_payment_recieved' => $is_payment_recieved,
            ];
        
            // return $data;
            $findUser = User::find($req->client_id);
            $emails = $findUser->email;
              
            $product = ProductNew::find($order->product_id);
            $productName = $product->product_name;
            
            $invoice = Invoice::create($data);
        
            $order->update(['invoice_id' => $invoice->id]);

            $Transaction = [
                'user_id' => $req->client_id,
                'invoice_id' => $invoice->id,
                'paymentMethod' => 'Bank Transfer',
                'razorpay_payment_id' => 0,
                'amount' => $invoice->final_total_amt,
            ];

            Transaction::create($Transaction);

          
            if(isset($req->order_confirmation)){
                $replacementssubject1 = array(
                  '[{$invoice_number}]' => $invoice->invoice_number2,
                );
                $TemplateSettings1 = Template::where('name', 'Invoice Payment Confirmation')->first();
                $message1 = $TemplateSettings1->subject;
                $subject1 = str_replace(array_keys($replacementssubject1), array_values($replacementssubject1), $message1);
                $replacementsTemplate1 = array(
                  '[Client Name]' => $findUser->first_name,
                  '[{$invoice_number}]' => $invoice->invoice_number2,
                  '[Product/Service Name]' => $productName,
                  '[Your Name]' => 'CloudTechtiq',
                );
        
                $messageReplacementsTemplate1 = $TemplateSettings1->template;
                $template1 = str_replace(array_keys($replacementsTemplate1), array_values($replacementsTemplate1), $messageReplacementsTemplate1);
        
                $template1 = str_replace(array_keys($replacementsTemplate1), array_values($replacementsTemplate1), $messageReplacementsTemplate1);
                $header1 = $TemplateSettings1->header;
                $footer1 = $TemplateSettings1->footer;
              Mail::to($emails)->send(new InvoicePaymentConfirmation($subject1, $header1, $template1, $footer1));
            }
        
            if(isset($req->send_email)){
              $invoiceData = $this->getInvoiceDetails($invoice->id);

              $InvoiceDetails = $invoiceData['InvoiceDetails'];
              $transaction = $invoiceData['transaction'];
              $Currency = $invoiceData['Currency'];
              $addOnProduct = $invoiceData['addOnProduct'];
              $taxes = $invoiceData['taxes'];
              $Company = $invoiceData['Company'];
             $InvoiceSettings = InvoiceSettings::where('id',1)->first();
            $clientDetails = $data['clientDetails'];

              $pdf = PDF::loadView('admin.Invoices.downloadView', compact('InvoiceDetails','InvoiceSettings', 'transaction', 'Currency', 'addOnProduct', 'taxes','Company'));
              // Save PDF file
              $pdfDirectory = public_path('pdf');
              if (!File::isDirectory($pdfDirectory)) {
                File::makeDirectory($pdfDirectory, 0755, true, true);
              }
              $pdfFilePath = public_path('pdf/invoice_' . $invoice->id . '.pdf');
              $pdf->save($pdfFilePath);
              
              $clientName = $findUser->first_name;
              
              $TemplateSettings = Template::where('name', 'Invoice Submission')->first();
              $subject = $TemplateSettings->subject;
              $header = $TemplateSettings->header;
              $template = $TemplateSettings->template;
              $footer = $TemplateSettings->footer;
              
              $replacementssubject = array(
                  '[Product/Service Name]' => $productName,
                  '[{$invoice_number}]' => $invoice->invoice_number2,
              );
                $replacementsTemplate = array(
                  '[Client Name]' => $findUser->first_name,
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
              $message = $subject;
              $subject = str_replace(array_keys($replacementssubject), array_values($replacementssubject), $message);
              Mail::to($emails)->send(new InvoiceGenerated($pdfFilePath, $subject, $header, $template, $footer, $invoice));
            }
        }   
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['type'] = 'order';
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Order created by Admin " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Quotes/store';
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);
        
        return redirect('admin/Orders/home')->with('success', "New order created successfully");
    
    }

    //edit
    public function edit(Request $req,$id)
    {
        $Quotes = Orders::find($id);
        $QuotesCal = QuotesCal::where('quotes_id',$id)->get();
        // $vendor = User::select('id','first_name')->where('type', '2')->get();
        $vendor = User::select('users.id','users.first_name','users.last_name','users.email','company_logins.company_name')
            ->where('users.type', '2')
            ->leftJoin('client_details','client_details.user_id','users.id')
            ->leftjoin('company_logins', 'company_logins.id', 'client_details.company_id')
            ->get();
        $Products = Product::select('id','product_name')->get();
        $Employee = User::select('first_name','id')->where('type',4)->get();
        $Company = CompanyLogin::select('id','company_name')->get();
        $Tax = TaxSetting::get();
    
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Quotes Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Quotes/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);  
    
        return view('admin.Orders.edit',compact('vendor','Employee','Products','Quotes','QuotesCal','Company','Tax'));
    }

    //updated
    public function update(Request $req,$id)
    {
    
        $dats =Orders::find($id);
        $dats['subject'] = $req->subject;
        $dats['date_created'] = $req->date_created;
        $dats['status'] = $req->status;
        $dats['valid_until'] = $req->valid_until;
        $dats['customer_name'] = $req->customer_name;
        $dats['first_name'] = $req->first_name;
        $dats['last_name'] = $req->last_name;
        $dats['email'] = $req->email;
        $dats['phone_number'] = $req->phone_number;
        $dats['company_id'] = $req->company_id;
        $dats->save();    
        QuotesCal::where('quotes_id',$id)->delete();
        $data = $req->unit_price;
        foreach ($data as $key=> $value) {
            $dat = new QuotesCal(); 
            $dat->quotes_id = $dats->id;
            $dat->qty = $req->qty[$key];
            $dat->description = $req->description[$key];
            $dat->unit_price = $value;
            $dat->discount = $req->discount[$key];
            $dat->total = $req->total[$key];
            $dat->Products_id = $req->Products_id[$key];
            $dat->BillingCycle = $req->BillingCycle[$key];
            $dat->save();
        }
    
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Quotes Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Quotes/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);
    
    
        return redirect('admin/Quotes/home')->with('success', "Quotes Edited Successfully");
    }
    // delete Quotes
    public function delete(Request $request,$id)
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Quotes Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Quotes/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);
    
        Orders::find($id)->delete();
        return redirect('admin/Quotes/home')->with('success', "Quotes Deleted Successfully");
    }

    // get_productdata Quotes
    public function get_productdata(Request $request)
    {
    
        if($request->billing_cycle == 'one_time')
        {
            $Product = Product::select('onetime_inr as unit')->where('id',$request->product_id)->first();
        }
        if($request->billing_cycle == 'hourly')
        {
            $Product = Product::select('recurr_inr_hourly as unit')->where('id',$request->product_id)->first();
        }
        if($request->billing_cycle == 'monthly')
        {
            $Product = Product::select('recurr_inr_monthly as unit')->where('id',$request->product_id)->first();
        }
        if($request->billing_cycle == 'quartely')
        {
            $Product = Product::select('recurr_inr_quartely as unit')->where('id',$request->product_id)->first();
        }
        if($request->billing_cycle == 'semi_annually')
        {
            $Product = Product::select('recurr_inr_semiannually as unit')->where('id',$request->product_id)->first();
        }
        if($request->billing_cycle == 'yearly')
        {
            $Product = Product::select('recurr_inr_yearly as unit')->where('id',$request->product_id)->first();
        }
        if($request->billing_cycle == 'annually')
        {
            $Product = Product::select('recurr_inr_annually as unit')->where('id',$request->product_id)->first();
        }
        if($request->billing_cycle == 'triennially')
        {
            $Product = Product::select('recurr_inr_triennially as unit')->where('id',$request->product_id)->first();
        }
    
        return response()->json(['success'=>true ,'status'=>200,'data'=>$Product]);
    }


    public function view(Request $request,$id)
    {
        $Order = Orders::join('product_news', 'product_news.id', 'orders.product_id')
                ->join('product_pricing', 'product_pricing.id', 'orders.billing_cycle')
                ->join('tax_settings', 'tax_settings.id', 'product_news.tax_id')
                ->select('product_pricing.plan_type','orders.id','orders.invoice_id','orders.bank_account','orders.hostname','orders.total_amt', 'orders.client_id', 'orders.user_id', 'orders.is_payment_recieved', 'orders.order_status','orders.billing_cycle','orders.quantity','product_pricing.price', 'orders.created_at','orders.product_id as product_id', 'product_news.product_name', 'product_news.description', 'tax_settings.rate')
                ->where('orders.id', $id)->first();
                
      
        $user = User::where('id',$Order->user_id)->first();
                
        if($Order){
            $findProduct = ProductNew::find($Order->product_id);
            $OsOrder = OsOrder::leftjoin('operating_systens', 'operating_systens.id', 'os_orders.os_id')
                ->leftjoin('o_s_categories', 'o_s_categories.os_id', 'operating_systens.id')->leftjoin('tax_settings', 'os_orders.tax', 'tax_settings.id')
                ->where('os_orders.order_Id', $Order->id)
                ->where('o_s_categories.category_id', $findProduct->category_id)
                ->select('os_orders.*', 'operating_systens.ostype', 'o_s_categories.price as os_price','tax_settings.rate as tax_rates')
                ->groupBy('operating_systens.id')
                ->first();
        }else{
            $OsOrder = '';
        }
        
        $Currency = Currency::join('orders','orders.currency','currencies.id')
                    ->where('orders.id', $id)
                    ->select('currencies.*')
                    ->first();

        $orders = AddonOrder::join('product_news', 'product_news.id', 'addon_orders.addon_id')
            ->join('tax_settings', 'tax_settings.id', 'product_news.tax_id')
            ->join('product_pricing', 'product_pricing.product_id', 'addon_orders.addon_id')
            ->where('addon_orders.order_id', $id)
            ->select('product_pricing.plan_type','product_news.product_name','product_news.description', 'tax_settings.tax_name','addon_orders.quantity', 'product_pricing.price','tax_settings.rate')
            ->groupBy('product_news.id')
            ->get();

        $orders->prepend($Order);
                $clientDetails = ClientDetail::where('user_id',$Order->client_id)->first();
     $client = User::leftjoin('client_details','client_details.user_id','users.id')
                ->select('client_details.address_1','client_details.address_2','users.*')
                ->where('users.id',$Order->client_id)
                ->first();
        return view('admin.Orders.view', compact('Order', 'Currency','clientDetails', 'orders','OsOrder','client','user'));
    }
    
  
    public function downloadPDF($id)
    { 
     $Quotes = Orders::select('quotes.*','invoices.is_payment_recieved','invoices.invoice_number1','invoices.invoice_number2','company_logins.company_name','company_logins.companylogo','company_logins.email_address','company_logins.contact_no','company_logins.billing_address','users.first_name','users.last_name','users.email','users.address')
     ->leftjoin('users','users.id','quotes.customer_name')
     ->leftjoin('invoices','invoices.Quotesid','quotes.id')
     ->leftjoin('company_logins','company_logins.id','quotes.company_id')
     ->where('quotes.id',$id)->first();
     $QuotesCal = QuotesCal::where('quotes_id',$id)->get();
     $InvoiceSettings = InvoiceSettings::where('id',1)->first();
    
     $pdf = PDF::loadView('admin.Orders.downloadView', ['Quotes' => $Quotes ,'InvoiceSettings' => $InvoiceSettings ,'QuotesCal' => $QuotesCal]);
    
    
     $filename = 'Quotes_' . $id . '.pdf';
    
        // Download the PDF file
     return $pdf->download($filename);
    }


    public function printView(Request $request, $id)
    {
        $Quotes = Orders::select('quotes.*','invoices.is_payment_recieved','invoices.invoice_number1','invoices.invoice_number2','company_logins.company_name','company_logins.companylogo','company_logins.email_address','company_logins.contact_no','company_logins.billing_address','users.first_name','users.last_name','users.email','users.address')
        ->leftjoin('users','users.id','quotes.customer_name')
        ->leftjoin('invoices','invoices.Quotesid','quotes.id')
        ->leftjoin('company_logins','company_logins.id','quotes.company_id')
        ->where('quotes.id',$id)->first();
        $QuotesCal = QuotesCal::where('quotes_id',$id)->get();
        $InvoiceSettings = InvoiceSettings::where('id',1)->first();
    
        return view('admin.Orders.printView', compact('Quotes', 'QuotesCal', 'InvoiceSettings'));
    
    
    }


    public function UpdateStatus(Request $request)
    {
        if($request->status == "progress")
        {
            $Task = Orders::find($request->id);
            $status_pro = $request->status_pro; // Store the status_pro value
            if($status_pro == 100)
            {
                $Task->order_status = 2; 
                if($Task->invoice_id != 0)
                {
                    $Invoice = Invoice::find($Task->invoice_id);
                    $Invoice->invoice_status = 1;
                    $Invoice->save(); 
                } 
            }
            elseif($status_pro == 2)
            {
                $Task->order_status = 3;
                if($Task->invoice_id != 0)
                {
                    $Invoice = Invoice::find($Task->invoice_id);
                    $Invoice->invoice_status = 3;
                    $Invoice->save(); 
    
                    // Array to hold all the invoice models
                    $invoices = [];
    
                    // Collecting invoices for different services
                    $services = [
                        BareMetal::class,
                        CloudHosting::class,
                        CloudServices::class,
                        DedicatedServer::class,
                        AwsService::class,
                        Azure::class,
                        GoogleWorkSpace::class,
                        MicrosoftOffice365::class,
                        OneTimeSetup::class,
                        MonthelySetup::class,
                        SSLCertificate::class,
                        Licenses::class,
                        Acronis::class,
                        TsPlus::class,
                        Antivirus::class,
                        Switchs::class,
                        Firewall::class
                    ];
    
                    foreach ($services as $service) {
                        $invoices[] = $service::where('invoice_id', $Invoice->id)->delete();
                    }

            $Transaction = [
                'user_id' => $Task->user_id,
                'invoice_id' => $Invoice->id,
                'paymentMethod' => 'Refund',
                'razorpay_payment_id' => 0,
                'amount' => $Invoice->paid_amount,
            ];

            Transaction::create($Transaction);
                
            $Credit = [
                'client_id' =>  $Task->user_id,
                'amount' => $Invoice->paid_amount,
            ];

            Credit::create($Credit);
                } 
            }
            else
            {
                $Task->order_status = 1; 
            }
            $Task->save();
        }
        elseif($request->status == "stu")
        {
            $Task = Orders::find($request->id);
            $status_pro = $request->status_pro; // Store the status_pro value
            $Task->order_status = $status_pro;
    
            if($status_pro == 2)
            {
                if($Task->invoice_id != 0)
                {
                    $Invoice = Invoice::find($Task->invoice_id);
                    $Invoice->invoice_status = 3;
                    $Invoice->save(); 
    
                    // Array to hold all the invoice models
                    $invoices = [];
    
                    // Collecting invoices for different services
                    $services = [
                        BareMetal::class,
                        CloudHosting::class,
                        CloudServices::class,
                        DedicatedServer::class,
                        AwsService::class,
                        Azure::class,
                        GoogleWorkSpace::class,
                        MicrosoftOffice365::class,
                        OneTimeSetup::class,
                        MonthelySetup::class,
                        SSLCertificate::class,
                        Licenses::class,
                        Acronis::class,
                        TsPlus::class,
                        Antivirus::class,
                        Switchs::class,
                        Firewall::class
                    ];
    
                    foreach ($services as $service) {
                        $invoices[] = $service::where('invoice_id', $Invoice->id)->delete();
                    }
                      $Transaction = [
                'user_id' => $Task->user_id,
                'invoice_id' => $Invoice->id,
                'paymentMethod' => 'Refund',
                'razorpay_payment_id' => 0,
                'amount' => $Invoice->final_total_amt,
            ];

            Transaction::create($Transaction);
                
            $Credit = [
                'client_id' => $Task->user_id,
                'amount' => $Invoice->paid_amount,
            ];

            Credit::create($Credit);
                } 
            }
            else
            {
                if($Task->invoice_id != 0)
                {
                    $Invoice = Invoice::find($Task->invoice_id);
                    $Invoice->invoice_status = 1;
                    $Invoice->save(); 
                } 
            }
            $Task->save();
        }
        return response()->json(['success' => true]);
    }


    //show creatd order form   
    public function orderInvoiceCreate (Request $request,$id)
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
      
        $selected_order_id = $id;
        $SelectedOrders = Orders::
        leftJoin('product_news', 'product_news.id', '=', 'orders.product_id')
        ->where('orders.id',$id)
        ->select('orders.*','product_news.product_name','product_news.id as proId','product_news.tax_id','product_news.description as products_desc')
        ->first();
    
      $taxValue = TaxSetting::where('id',$SelectedOrders->tax_id)->select('rate')->first();
      $currency = Currency::where('is_default',1)->first();
      $productAmount = ProductPricing::where('product_id',$SelectedOrders->proId)->where('currency_id',$currency->id)->select('price')->first();
    
      $adOnProductPrice = ProductAddOn::join('product_add_on_prices','product_add_ons.id','product_add_on_prices.product_add_on_id')
        ->join('order_to_products','product_add_ons.id','order_to_products.addOnProductId')
        ->join('order_to_products','product_add_ons.id','order_to_products.addOnProductId')
        ->where('order_to_products.order_Id',$SelectedOrders->id)
        ->where('product_add_on_prices.currency_id',$currency->id)
        ->select('product_add_ons.product_name','product_add_on_prices.price')
        ->first();
    
    $invoice_number2 = Invoice::max('invoice_number2');
    $invoice_number2 = (int)$invoice_number2 + 1;
    
    $cartDetails = AddOnProductCart::where('order_id',$id)->get();
    
    return view('admin.Orders.orderInvoiceCreate',compact('Vendor','orders','default_currency','Employee','Project','ProductNew','Client','Service','currencies','Company','Tax','billing_address','invoice_number2','SelectedOrders','selected_order_id','id','taxValue','productAmount','adOnProductPrice'));  
    }
    //////show client servers
    public function getServicesIdWise($id)
    {

     $orderByServices = Orders::join('product_news','orders.product_id','product_news.id')
                      ->join('categories','orders.productCategoryId','categories.id')
                      ->join('users','orders.user_id','users.id')
                      ->select('categories.category_name','product_news.product_name as Pproduct_name','users.first_name','users.profile_img','users.email','users.id as uid','orders.created_at','orders.order_status','orders.id','orders.total_amt','orders.public_ip')
                      ->where('orders.productCategoryId',$id)
                      ->whereNull('users.deleted_at')
                      ->paginate(10);
                     $productName = isset($orderByServices[0]) ? $orderByServices[0]['category_name'] : 'User Services';
                   $pending = Orders::join('product_news','orders.product_id','product_news.id')
                      ->join('categories','orders.productCategoryId','categories.id')
                      ->join('users','orders.user_id','users.id')
                      ->where('orders.productCategoryId',$id)
                      ->where('orders.order_status',0)
                      ->whereNull('users.deleted_at')
                      ->count();
                   $accepted = Orders::join('product_news','orders.product_id','product_news.id')
                      ->join('categories','orders.productCategoryId','categories.id')
                      ->join('users','orders.user_id','users.id')
                      ->where('orders.productCategoryId',$id)
                      ->where('orders.order_status',1)
                      ->whereNull('users.deleted_at')
                      ->count();
                   $declined = Orders::join('product_news','orders.product_id','product_news.id')
                      ->join('categories','orders.productCategoryId','categories.id')
                      ->join('users','orders.user_id','users.id')
                      ->where('orders.productCategoryId',$id)
                      ->where('orders.order_status',2)
                      ->whereNull('users.deleted_at')
                      ->count();
                   $query ='';
            return view('admin.userServices.home',compact('orderByServices','productName','pending','accepted','declined','query'));             
   }
   
   public function billingCycle(Request $request, $id)
{
    $default_currency = Currency::where('is_default', 1)->first();
    $BillingCycles = ProductPricing::where('product_id', $id)
        ->where('currency_id', $default_currency->id)
        ->whereNull('deleted_at')
        ->get();
    
    return response()->json($BillingCycles);
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
                    'orders.currency',
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
    
public function getInvoiceDetail2sd($id)
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
                'orders.currency',
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
                'orders.currency',
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
}