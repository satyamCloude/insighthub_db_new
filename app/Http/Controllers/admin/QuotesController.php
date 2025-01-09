<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller; 
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use App\Exports\QuotesExport; 
use App\Exports\SelectedQuotesExport;

use App\Models\CompanyLogin;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use App\Models\QuotesCal;
use App\Models\Currency;
use App\Models\ProductPricing;
use App\Models\Employee;
use App\Models\Country;
use App\Models\ProductAddOnPrice;
use App\Models\ProductAddOn;
use App\Models\Product;
use App\Models\Quotes;
use App\Models\ProductNew;
use App\Models\Template;
use App\Models\Category;
use App\Models\State;
use App\Models\City;
use App\Models\User;
use App\Models\TaxSetting;
use App\Models\InvoiceSettings;
use App\Models\Leads;
use App\Models\Invoice;
use App\Models\MailSettings;
use App\Models\Orders;
use App\Models\Ticket;
use Hash;
use Auth;
use DB;
use View;
use PDF;
use App\Mail\SendQuotes;
use Illuminate\Support\Facades\Mail;
use ZipArchive;
use DateTime;

class QuotesController extends Controller
{   
    public function home(Request $request)
    {
        // Initial query builder setup
        $query = Quotes::select(
                'quotes.subject',
                'quotes.id',
                'quotes.customer_name',
                'quotes.leads_id',
                'quotes.status',
                'quotes.updated_at',
                'quotes.valid_until',
                'quotes.user_id as quotesuser_id',
                DB::raw('SUM(quotes_cals.total) as total')
            )->join('quotes_cals', 'quotes_cals.quotes_id', '=', 'quotes.id')
            ->whereNull('quotes_cals.deleted_at')
            ->groupBy('quotes.id', 'quotes.subject', 'quotes.status', 'quotes.updated_at', 'quotes.valid_until')
            ->orderBy('quotes.created_at', 'desc');

        $searchTerm = '';

        // Check if a search term is provided
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('quotes.subject', 'like', '%' . $searchTerm . '%')
                ->orWhere('quotes.valid_until', 'like', '%' . $searchTerm . '%');
            });
        }
        // Filter by date range if provided and not empty
        if ($request->filled('from') && $request->filled('to')) {
            $from = $request->input('from');
            $to = $request->input('to');

            $query->whereDate('quotes.created_at', '>=', $from)
                ->whereDate('quotes.created_at', '<=', $to);
        }

        // Retrieve paginated data
        $users = $query->paginate(10);
        $users->appends(['search' => $searchTerm]);

        // Additional counts
        $TotalQuotes = Quotes::count();
        $delivered = Quotes::where('status', '1')->count();
        $onhold = Quotes::where('status', '2')->count();
        $accepted = Quotes::where('status', '3')->count();
        $lost = Quotes::where('status', '4')->count();
        $win = Quotes::where('status', '5')->count();
        // return $users;
        // Pass data to the view
        return view('admin.sales.Quotes.home', compact('users', 'TotalQuotes', 'delivered', 'onhold', 'accepted', 'lost', 'win', 'searchTerm'));
    }
    
    public function changeQuotesStatus(Request $req)
    {
        $Quotes = Quotes::find($req->userId);
        $Quotes->status=$req->status;
        $Quotes->save();
        return response()->json([
                "status" => "success",
                "data" => $Quotes
            ], 200);
    }

    //home page
    public function Create(Request $request)
    {   
        $id = $request->id;
        if($id){

            $lead =  Leads::find($request->id);
            $vendor = User::select('users.id','users.first_name','users.profile_img','users.last_name','users.email','company_logins.company_name')
                ->where('users.type', '2')
                ->whereNull('users.deleted_at')
                ->leftJoin('client_details','client_details.user_id','users.id')
                ->leftjoin('company_logins', 'company_logins.id', 'client_details.company_id')
                ->groupBy('users.id')
                ->get();
            
            $Products = ProductNew::select('id','product_name')->get();
            $Employee = User::select('first_name','id')->where('type',4)->get();
            $Company = CompanyLogin::leftjoin('users', 'users.id', 'company_logins.user_id')
                ->select('company_logins.id','company_logins.company_name','company_logins.username','users.first_name','users.last_name')->get();
            $Tax = TaxSetting::get();
            $Category = Category::select('id','category_name as product_name')->get();

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
        }else{
            $lead = ''; 
            $vendor = User::select('users.id','users.first_name','users.profile_img','users.last_name','users.email','company_logins.company_name')
                ->where('users.type', '2')
                ->whereNull('users.deleted_at')
                ->leftJoin('client_details','client_details.user_id','users.id')
                ->leftjoin('company_logins', 'company_logins.id', 'client_details.company_id')
                ->groupBy('users.id')
                ->get();
            $Products = ProductNew::select('id','product_name')->get();
            $Category = Category::select('id','faIcon','category_name as product_name')->get();
            $Employee = User::select('first_name','id')->where('type',4)->get();
            $Company = CompanyLogin::leftjoin('users', 'users.id', 'company_logins.user_id')
                ->select('company_logins.id','company_logins.company_name','company_logins.username','users.first_name','users.last_name')->get();
            $Tax = TaxSetting::get();

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
        }

        return view('admin.sales.Quotes.create',compact('vendor','Employee','Products','Company','Tax','lead','id','Category')); 
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

    public function downloadSelected(Request $request)
    {
        $selectedQuotes = explode(',', $request->input('quotes'));
        // Assuming you have a method to filter quotes based on selected IDs
        $quotesData = Quotes::whereIn('id', $selectedQuotes)->get();
        return Excel::download(new QuotesExport($quotesData), 'selected_quotes.csv');
    }

    //home page
    public function store(Request $req)
    {
        
        $url = url('/').'/public/images/';

        $dataa = $req->all();
        $productName = ProductNew::whereIn('id',$dataa['Products_id'])->pluck('product_name')->toArray();
        $productName = implode(",",$productName);
    
        $signature = 'signature.jpg';
        if ($req->hasFile('signature')) {
            $rand = Str::random(4);
            $file = $req->file('signature');
            $extension = $file->getClientOriginalExtension();
            $signature = 'file_doc_'.$rand.'.'.$extension;
            $file->move('public/images/', $signature);
        }
    
    
        $userEmail = $req->email;
        $userFirstName = isset($req->first_name) ? $req->first_name :'';
        $userLastName = isset($req->last_name) ? $req->last_name :'';
        $userName = $userFirstName.'-'.$userLastName;

        
        $dataa['signature'] = $url . $signature;
        $dataa['user_id'] = Auth::user()->id;
        $Quotesid = Quotes::create($dataa);


        $Quotes = Quotes::select('quotes.*','invoices.is_payment_recieved','invoices.invoice_number1','invoices.invoice_number2',
            'company_logins.company_name','company_logins.companylogo','company_logins.email_address','company_logins.contact_no',
            'company_logins.billing_address','users.first_name','users.last_name','users.email','users.address')
            ->leftjoin('users','users.id','quotes.customer_name')
            ->leftjoin('invoices','invoices.Quotesid','quotes.id')
            ->leftjoin('company_logins','company_logins.id','quotes.company_id')
            ->where('quotes.id',$Quotesid->id)->first();

        $TemplateSettings = Template::where('name', 'Quotation Submission')->first();
        $MailSettings = MailSettings::where('type','Bulk')->where('id',1)->first();
        // $Quotes = Quotes::select('quotes.*','invoices.is_payment_recieved','invoices.invoice_number1','invoices.invoice_number2',
        //     'company_logins.company_name','company_logins.companylogo','company_logins.email_address','company_logins.contact_no','company_logins.billing_address',
        //     'users.first_name','users.last_name','users.email','users.address')
        //     ->leftjoin('users','users.id','quotes.customer_name')
        //     ->leftjoin('quotes_cals','quotes_cals.quotes_id','quotes.id')
        //     ->leftjoin('product_news','product_news.id','quotes_cals.Products_id')
        //     ->leftjoin('invoices','invoices.Quotesid','quotes.id')
        //     ->leftjoin('company_logins','company_logins.id','quotes.company_id')
        //     ->where('quotes.id',$Quotesid->id)->first();

        $Quotes = Quotes::select(
                'quotes.*',
                'invoices.is_payment_recieved','invoices.invoice_number1','invoices.invoice_number2','company_logins.company_name',
                'company_logins.companylogo','company_logins.email_address','company_logins.contact_no','company_logins.billing_address',
                'company_logins.pan_number','company_logins.hsn_number','company_logins.gst_number','company_logins.tan_number',
                'company_logins.pin_code','users.first_name','users.last_name','users.email','users.address','client_details.address_1',
                'client_details.address_2','client_details.pincode','client_details.gstin','client_details.hsn_sac'
            )
            ->leftJoin('users', 'users.id', '=', 'quotes.customer_name')
            ->leftjoin('quotes_cals','quotes_cals.quotes_id','quotes.id')
            ->leftjoin('product_news','product_news.id','quotes_cals.Products_id')
            ->leftJoin('invoices', 'invoices.Quotesid', '=', 'quotes.id')
            ->leftJoin('company_logins', 'company_logins.id', '=', DB::raw('(SELECT id FROM company_logins ORDER BY id ASC LIMIT 1)'))
            ->leftJoin('client_details', 'client_details.user_id', '=', 'quotes.customer_name') // Added join for client_details
            ->where('quotes.id', $Quotesid->id)->first();

        $QuotesCal = QuotesCal::where('quotes_id',$Quotesid->id)->get();
        $InvoiceSettings = InvoiceSettings::first();
        $Currency = Currency::where('is_default',1)->first();

        $data = $req->unit_price;

        $datas = [
            'user_id' => Auth::user()->id,
            'invoice_number1' => $req->invoice_number1,
            'invoice_number2' => $req->invoice_number2,
            'issue_date' => $req->date_created,
            'Quotesid' => $Quotesid->id,
            'due_date' => $req->valid_until,
            'client_id' => $req->customer_name,
            'generated_by' => $req->company_id,
        ];

        // $invoice = Invoice::create($datas);
        foreach ($data as $key=> $value) {
            $dat = new QuotesCal(); 
            $dat->quotes_id = $Quotesid->id;
            $dat->qty = $req->qty[$key];
            $dat->description = $req->description[$key];
            $dat->unit_price = $value;
            $dat->discount = $req->discount[$key];
            $dat->tax = $req->tax[$key];
            $dat->tax_rate = $req->tax_rate[$key];
            $dat->total = $req->total[$key];
            $dat->Products_id = $req->Products_id[$key];
            $dat->BillingCycle = $req->BillingCycle[$key];
            $dat->Caltax = $req->Caltax[$key];
            $dat->save();

            $order = new Orders();
            $order->invoice_id    = 0;
            $order->user_id       = Auth::user()->id;
            $order->quotes_id     = $Quotesid->id;
            $order->issue_date    = $req->date_created;
            $order->due_date      = $req->valid_until;
            $order->generated_by  = $req->company_id; 
            $order->product_id    = $req->Products_id[$key]; 
            $order->services_type = $req->BillingCycle[$key];
            $order->taxes         = $req->Caltax[$key]; 
            $order->quantity      = $req->qty[$key]; 
            $order->unit_id       = $req->unit_price[$key]; 
            $order->item_summary  = $req->description[$key]; 
            $order->cost_per_item = $req->unit_price[$key]; 
            $order->amount        = $req->total[$key]; 
            $order->save();

            $Product = ProductNew::find($req->Products_id[$key]);
            // Check if the product is found
            if ($Product) {
                // Update the order count
                $Product->order_count += 1;
                $Product->save();
            } 
        } 

        $pdf = PDF::loadView('admin.sales.Quotes.downloadView', ['Quotes' => $Quotes ,'InvoiceSettings' => $InvoiceSettings ,'QuotesCal' => $QuotesCal,'Currency' => $Currency]);

        $filename = 'Quotes_' . $Quotesid->id . '.pdf';
        // Save the PDF to the server
        $pdfPath = storage_path('app/pdf/' . $filename);
        if (!is_writable(storage_path('app/pdf/'))) {
            throw new \Exception("The directory is not writable: " . storage_path('app/pdf/'));
        }    
        $pdf->save($pdfPath);
        // echo "okk";die;

        if ($MailSettings->smtp == '1'){
            config([
                'mail.driver'     => $MailSettings->smtp_mailer,
                'mail.host'       => $MailSettings->smtp_host,
                'mail.port'       => $MailSettings->smtp_port,
                'mail.username'   => $MailSettings->smtp_user_name,
                'mail.password'   => $MailSettings->smtp_password,
                'mail.encryption' => $MailSettings->smtp_encryption,
            ]);

            $subject  = $TemplateSettings->subject;
            $header   = $TemplateSettings->header;
            $template = $TemplateSettings->template;
            $footer   = $TemplateSettings->footer;
            $title   = 'Quotation Submission';

            $replacementsTemplate = array(
                '{$client_name}' => $userName,
                '[Product/Service Name]' => $productName,
                '[Company Name]' => 'CloudTechtiq',
            );
            $messageReplacementsTemplate = $template;
            $template = str_replace(array_keys($replacementsTemplate), array_values($replacementsTemplate),$messageReplacementsTemplate);

            // Generate PDF
            $pdf = PDF::loadView('admin.sales.Quotes.downloadView', [
                'Quotes' => $Quotes,
                'InvoiceSettings' => $InvoiceSettings,
                'QuotesCal' => $QuotesCal,
                'Currency' => $Currency
            ]);

            // Save the PDF to the server
            // $pdfPath = public_path('pdf/' . $filename);
            $pdfPath = storage_path('app/pdf/' . $filename);
            if (!is_writable(storage_path('app/pdf/'))) {
                throw new \Exception("The directory is not writable: " . storage_path('app/pdf/'));
            }    
            $pdf->save($pdfPath);

            // Attach the PDF to the email
            $pdfData = file_get_contents($pdfPath);

            // Send the email with the PDF attachment
            Mail::to($userEmail)->send(new SendQuotes($subject, $header, $template, $footer, $title, $pdfData, $filename));
                // Mail::to($userEmail)->send(new SendQuotes($subject,$header,$template,$footer,$title));                
        }

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Quotes Data Store By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Quotes/store';
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('admin/Quotes/home')->with('success', "New Quotes Added Successfully");

    }

    //edit
    public function edit(Request $req,$id)
    {
        $Quotes = Quotes::find($id);
        $QuotesCal = QuotesCal::where('quotes_id',$id)->get();
        // $vendor = User::select('id','first_name')->where('type', '2')->get();
        $Products = ProductNew::select('id','product_name')->get();
        $Employee = User::select('first_name','id')->where('type',4)->get();
        $Company = CompanyLogin::select('id','company_name')->get();
        $Tax = TaxSetting::get();
        $vendor = User::select('users.id','users.first_name','users.profile_img','users.last_name','users.email','company_logins.company_name')
        ->where('users.type', '2')
        ->leftJoin('client_details','client_details.user_id','users.id')
        ->leftjoin('company_logins', 'company_logins.id', 'client_details.company_id')
        ->get();
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
        $Category = Category::select('id','category_name as product_name')->get();

        return view('admin.sales.Quotes.edit',compact('vendor','Employee','Products','Quotes','QuotesCal','Company','Tax','Category'));
    }

        //updated
    public function update(Request $req,$id)
    {

        $dats =Quotes::find($id);
        $dats['subject'] = $req->subject;
        $dats['date_created'] = $req->date_created;
        $dats['status'] = $req->status;
        $dats['valid_until'] = $req->valid_until;
        if($req->customer_name){
            $dats['customer_name'] = $req->customer_name;
        }else{
            $dats['customer_name'] = $dats->customer_name;
        }
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
            $dat->tax = $req->tax[$key];
            $dat->tax_rate = $req->tax_rate[$key];
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

        Quotes::find($id)->delete();
        return redirect('admin/Quotes/home')->with('success', "Quotes Deleted Successfully");
    }

        // get_productdata Quotes
    public function get_productdata(Request $request)
    {
        if($request->addones == 0 && isset($request->billing_cycle)){
            if(isset($request->billing_cycle) && $request->product_id != 0)
                {
                    $Product = ProductPricing::
                    leftjoin('product_news','product_news.id','product_pricing.product_id')
                    ->leftjoin('currencies','currencies.id','product_pricing.currency_id')
                    ->select('price as price','currencies.name as currencies_name','currencies.code as currencies_code','product_news.description as product_description','currencies.prefix as currencies_prefix')->where('product_id',$request->product_id)->where('plan_type',$request->billing_cycle)->first();
                } 

        }else{
                    if(isset($request->billing_cycle) && $request->addones != 0)

        $Product = ProductPricing::
                    leftjoin('product_news','product_news.id','product_pricing.product_id')
                    ->leftjoin('currencies','currencies.id','product_pricing.currency_id')
                    ->select('price as price','currencies.name as currencies_name','currencies.code as currencies_code','product_news.description as product_description','currencies.prefix as currencies_prefix')->where('product_id',$request->addones)->where('plan_type',$request->billing_cycle)->first();
        }

        return response()->json(['success'=>true ,'status'=>200,'data'=>$Product]);
    }


    public function get_product_addon(Request $request)
    {
        $productAddons = [];

        if ($request->product_id != 0) {
            $addonIds = ProductAddOn::where('product_id', $request->product_id)
                ->pluck('addon_id')
                ->flatMap(function ($addonIds) {
                    return explode(',', $addonIds);
                })
                ->unique();

            $productAddons = ProductNew::whereIn('id', $addonIds)
                ->select('id', 'product_name', 'description as product_description')
                ->get();
        }

        return response()->json(['success' => true, 'status' => 200, 'data' => $productAddons]);
    }

    public function get_categoryProduct(Request $request)
    {
        if($request->selectedCategoryId != 0)
        {
            $Product = ProductNew::select('id','product_name')->where('category_id',$request->selectedCategoryId)->get();
        return response()->json(['success'=>true ,'status'=>200,'data'=>$Product]);
        }else{
                $Product = [];
    
        return response()->json(['success'=>false ,'status'=>400,'data'=>$Product]);
        }

    }

    public function view(Request $request,$id)
    {
        // $Quotes = Quotes::select('quotes.*','invoices.is_payment_recieved','invoices.invoice_number1','invoices.invoice_number2',
        // 'company_logins.company_name','company_logins.companylogo','company_logins.email_address','company_logins.contact_no',
        //'company_logins.billing_address','users.first_name','users.last_name','users.email','users.address')
        // ->leftjoin('users','users.id','quotes.customer_name')
        // ->leftjoin('invoices','invoices.Quotesid','quotes.id')
        // ->leftjoin('company_logins','company_logins.id','quotes.company_id')
        // ->where('quotes.id',$id)->first(); old query
        $Quotes = Quotes::select(
            'quotes.*',
            'invoices.is_payment_recieved',
            'invoices.invoice_number1',
            'invoices.invoice_number2',
            'company_logins.company_name',
            'company_logins.companylogo',
            'company_logins.email_address',
            'company_logins.contact_no',
            'company_logins.billing_address',
            'company_logins.pan_number',
            'company_logins.hsn_number',
            'company_logins.gst_number',
            'company_logins.tan_number',
            'company_logins.pin_code',
            'users.first_name',
            'users.last_name',
            'users.email',
            'users.address',
            'client_details.address_1',
            'client_details.address_2',
            'client_details.pincode',
            'client_details.gstin',
            'client_details.hsn_sac'
        )
        ->leftJoin('users', 'users.id', '=', 'quotes.customer_name')
        ->leftJoin('invoices', 'invoices.Quotesid', '=', 'quotes.id')
        ->leftJoin('company_logins', 'company_logins.id', '=', DB::raw('(SELECT id FROM company_logins ORDER BY id ASC LIMIT 1)'))
        ->leftJoin('client_details', 'client_details.user_id', '=', 'quotes.customer_name') // Added join for client_details
        ->where('quotes.id', $id)
        ->first();
    
        $QuotesCal = QuotesCal::where('quotes_id',$id)->get();
        $InvoiceSettings = InvoiceSettings::where('id',1)->first();
        $Currency = Currency::where('is_default',1)->first();

        // dd($Quotes);
        return view('admin.sales.Quotes.view',compact('Quotes','QuotesCal','InvoiceSettings','Currency'));
    }

    public function downloadPDF_old(Request $request)
    { 
        $ids = explode(",", $request->ids);
        $user_id = Auth::user()->id;
        $pdfFiles = [];
        $zipFileName = 'quotes.zip';
        $zipFilePath = storage_path('app/' . $zipFileName);

        // Create a new ZIP file
        $zip = new ZipArchive;

        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
            foreach ($ids as $id) {
                $user = User::find($id);
                $Ticket = Ticket::where('client_id', $id)->get();
                $Invoice = Invoice::with('orders')->find($id);
                $Currency = Currency::where('is_default', 1)->first();
                $InvoiceDetailsAll = Orders::where('invoice_id', $id)
                    ->with('user', 'clientDetails')
                    ->get();
                $Quotes = Quotes::select('quotes.*','invoices.is_payment_recieved','invoices.invoice_number1',
                    'invoices.invoice_number2','company_logins.company_name','company_logins.companylogo','company_logins.email_address',
                    'company_logins.contact_no','company_logins.billing_address','users.first_name','users.last_name','users.email','users.address')
                    ->leftJoin('users','users.id','quotes.customer_name')
                    ->leftJoin('invoices','invoices.Quotesid','quotes.id')
                    ->leftJoin('company_logins','company_logins.id','quotes.company_id')
                    ->where('quotes.id',$id)->first();
                $QuotesCal = QuotesCal::where('quotes_id',$id)->get();
                $InvoiceSettings = InvoiceSettings::where('id',1)->first();

            $pdf = PDF::loadView('admin.sales.Quotes.downloadView', ['Quotes' => $Quotes ,'InvoiceSettings' => $InvoiceSettings ,'QuotesCal' => $QuotesCal]);
            $filename = 'quotes_' . $id . '.pdf';
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

        } else {
            // Return error response if ZIP file cannot be created
            return response()->json(['error' => 'Failed to create ZIP file.']);
        }
    }

    public function downloadPDF(Request $request)
    { 
        $ids = explode(",", $request->ids);
        $user_id = Auth::user()->id;
    
        if (count($ids) === 1) {
            // Handle the case for a single PDF
            $id = $ids[0];
            // $Quotes = Quotes::select('quotes.*', 'invoices.is_payment_recieved', 'invoices.invoice_number1', 'invoices.invoice_number2', 'company_logins.company_name', 
            //     'company_logins.companylogo', 'company_logins.email_address', 'company_logins.contact_no', 'company_logins.billing_address', 'users.first_name', 'users.last_name', 'users.email', 'users.address')
            //     ->leftJoin('users', 'users.id', 'quotes.customer_name')
            //     ->leftJoin('invoices', 'invoices.Quotesid', 'quotes.id')
            //     ->leftJoin('company_logins', 'company_logins.id', 'quotes.company_id')
            //     ->where('quotes.id', $id)->first();
    
            $Quotes = Quotes::select(
                'quotes.*',
                'invoices.is_payment_recieved',
                'invoices.invoice_number1',
                'invoices.invoice_number2',
                'company_logins.company_name',
                'company_logins.companylogo',
                'company_logins.email_address',
                'company_logins.contact_no',
                'company_logins.billing_address',
                'company_logins.pan_number',
                'company_logins.hsn_number',
                'company_logins.gst_number',
                'company_logins.tan_number',
                'company_logins.pin_code',
                'users.first_name',
                'users.last_name',
                'users.email',
                'users.address',
                'client_details.address_1',
                'client_details.address_2',
                'client_details.pincode',
                'client_details.gstin',
                'client_details.hsn_sac'
            )
            ->leftJoin('users', 'users.id', '=', 'quotes.customer_name')
            ->leftJoin('invoices', 'invoices.Quotesid', '=', 'quotes.id')
            ->leftJoin('company_logins', 'company_logins.id', '=', DB::raw('(SELECT id FROM company_logins ORDER BY id ASC LIMIT 1)'))
            ->leftJoin('client_details', 'client_details.user_id', '=', 'quotes.customer_name') // Added join for client_details
            ->where('quotes.id', $id)
            ->first();

            $QuotesCal = QuotesCal::where('quotes_id', $id)->get();
            $InvoiceSettings = InvoiceSettings::where('id', 1)->first();
            $Currency = Currency::where('is_default',1)->first();

            // return view('admin.sales.Quotes.downloadView',compact('Quotes','QuotesCal','InvoiceSettings','Currency'));
            $pdf = PDF::loadView('admin.sales.Quotes.downloadView', ['Quotes' => $Quotes, 
                'InvoiceSettings' => $InvoiceSettings, 
                'QuotesCal' => $QuotesCal, 
                'Currency' => $Currency
            ]);
            $filename = 'quotes_' . $id . '.pdf';

            // Return the single PDF as a download
            return $pdf->download($filename);
        } else {
            // Handle the case for multiple PDFs in a ZIP
            $pdfFiles = [];
            $zipFileName = 'quotes.zip';
            $zipFilePath = storage_path('app/' . $zipFileName);
    
            // Create a new ZIP file
            $zip = new ZipArchive;
    
            if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) === TRUE) {
                foreach ($ids as $id) {
                    // $Quotes = Quotes::select('quotes.*', 'invoices.is_payment_recieved', 'invoices.invoice_number1', 'invoices.invoice_number2', 
                    //     'company_logins.company_name', 'company_logins.companylogo', 'company_logins.email_address', 'company_logins.contact_no', 
                    //     'company_logins.billing_address', 'users.first_name', 'users.last_name', 'users.email', 'users.address')
                    //     ->leftJoin('users', 'users.id', 'quotes.customer_name')
                    //     ->leftJoin('invoices', 'invoices.Quotesid', 'quotes.id')
                    //     ->leftJoin('company_logins', 'company_logins.id', 'quotes.company_id')
                    //     ->where('quotes.id', $id)->first();
                    $Quotes = Quotes::select(
                        'quotes.*',
                        'invoices.is_payment_recieved',
                        'invoices.invoice_number1',
                        'invoices.invoice_number2',
                        'company_logins.company_name',
                        'company_logins.companylogo',
                        'company_logins.email_address',
                        'company_logins.contact_no',
                        'company_logins.billing_address',
                        'company_logins.pan_number',
                        'company_logins.hsn_number',
                        'company_logins.gst_number',
                        'company_logins.tan_number',
                        'company_logins.pin_code',
                        'users.first_name',
                        'users.last_name',
                        'users.email',
                        'users.address',
                        'client_details.address_1',
                        'client_details.address_2',
                        'client_details.pincode',
                        'client_details.gstin',
                        'client_details.hsn_sac'
                    )
                    ->leftJoin('users', 'users.id', '=', 'quotes.customer_name')
                    ->leftJoin('invoices', 'invoices.Quotesid', '=', 'quotes.id')
                    ->leftJoin('company_logins', 'company_logins.id', '=', DB::raw('(SELECT id FROM company_logins ORDER BY id ASC LIMIT 1)'))
                    ->leftJoin('client_details', 'client_details.user_id', '=', 'quotes.customer_name') // Added join for client_details
                    ->where('quotes.id', $id)
                    ->first();

                    $QuotesCal = QuotesCal::where('quotes_id', $id)->get();
                    $InvoiceSettings = InvoiceSettings::where('id', 1)->first();
                    $Currency = Currency::where('is_default',1)->first();
    
                    $pdf = PDF::loadView('admin.sales.Quotes.downloadView', ['Quotes' => $Quotes, 
                        'InvoiceSettings' => $InvoiceSettings, 
                        'QuotesCal' => $QuotesCal, 
                        'Currency' => $Currency
                    ]);

                    $filename = 'invoices_' . $id . '.pdf';
                    $pdfFiles[] = [
                        'file' => $pdf->output(),
                        'filename' => $filename
                    ];
                }
    
                foreach ($pdfFiles as $pdfFile) {
                    $zip->addFromString($pdfFile['filename'], $pdfFile['file']);
                }
    
                $zip->close();
    
                // Return the ZIP archive as a downloadable response
                return response()->download($zipFilePath)->deleteFileAfterSend(true);
            } else {
                // Return error response if ZIP file cannot be created
                return response()->json(['error' => 'Failed to create ZIP file.']);
            }
        }
    }
    
    public function printView(Request $request, $id)
    {
        // $Quotes = Quotes::select('quotes.*','invoices.is_payment_recieved','invoices.invoice_number1','invoices.invoice_number2','company_logins.company_name','company_logins.companylogo','company_logins.email_address','company_logins.contact_no','company_logins.billing_address','users.first_name','users.last_name','users.email','users.address')
        // ->leftjoin('users','users.id','quotes.customer_name')
        // ->leftjoin('invoices','invoices.Quotesid','quotes.id')
        // ->leftjoin('company_logins','company_logins.id','quotes.company_id')
        // ->where('quotes.id',$id)->first();

        $Quotes = Quotes::select(
            'quotes.*',
            'invoices.is_payment_recieved',
            'invoices.invoice_number1',
            'invoices.invoice_number2','company_logins.company_name','company_logins.companylogo','company_logins.email_address','company_logins.contact_no','company_logins.billing_address',
            'users.first_name','users.last_name','users.email','users.address','client_details.address_1','client_details.address_2','client_details.pincode',
            'client_details.gstin','client_details.hsn_sac'
        )
        ->leftJoin('users', 'users.id', '=', 'quotes.customer_name')
        ->leftJoin('invoices', 'invoices.Quotesid', '=', 'quotes.id')
        ->leftJoin('company_logins', 'company_logins.id', '=', DB::raw('(SELECT id FROM company_logins ORDER BY id ASC LIMIT 1)'))
        ->leftJoin('client_details', 'client_details.user_id', '=', 'quotes.customer_name') // Added join for client_details
        ->where('quotes.id', $id)
        ->first();

        $QuotesCal = QuotesCal::where('quotes_id',$id)->get();
        $InvoiceSettings = InvoiceSettings::where('id',1)->first();

        return view('admin.sales.Quotes.printView', compact('Quotes', 'QuotesCal', 'InvoiceSettings'));


    }

    public function GenerateQuotes(Request $request, $id)
    {
        $Quotes = Quotes::find($id);
        $Quotes->status = "5";
        $Quotes->save();
        return redirect('admin/Quotes/home')->with('success', "Quotes Generated Successfully");

    }

    public function MakeQuotesInvoice(Request $request, $id)
    {
        $Quotes = Quotes::find($id);
        
        if($Quotes) {
            $QuotesNew = Quotes::leftJoin('quotes_cals', 'quotes_cals.quotes_id', '=', 'quotes.id')
                ->where('quotes.id', $id)
                ->select('quotes.*', 'quotes_cals.tax','quotes_cals.BillingCycle', 'quotes_cals.Products_id', 'quotes_cals.unit_price', 
                'quotes_cals.discount', 'quotes_cals.tax', 'quotes_cals.total')
                ->first();

            // return $QuotesNew;
            // $Quotes->status = "5";
            // $Quotes->save();
            $invoice_number2 = Invoice::max('invoice_number2');
            $invoice_number2 = (int)$invoice_number2 + 1;
            $datas = [
                'user_id' => Auth::user()->id,
                'invoice_number1' => 'INV#',
                'invoice_number2' => $invoice_number2 ?? null,
                'issue_date' => $QuotesNew->date_created ?? null,
                'product_id' => $QuotesNew->Products_id ?? '0',
                'sub_total' => $QuotesNew->unit_price ?? '0',
                'calc_tax' => $QuotesNew->tax ?? '0',
                'client_id' => $QuotesNew->customer_name ?? null,
                'due_date' => $QuotesNew->valid_until ?? null,
                'discount_value' => $QuotesNew->discount ?? null,
                'final_total_amt' => $QuotesNew->total ?? null,
                'Quotesid' =>  $id,
                'due_date' => $QuotesNew->valid_until,
                // 'client_id' => $QuotesNew->customer_name,
                'generated_by' => 1,
            ];

            $invoice = Invoice::create($datas);
            $Quotes = Quotes::find($id);
            $findQuotes = Orders::where('quotes_id',$Quotes->id)->count();
            if($findQuotes > 0){
                $findQuotes = Orders::where('quotes_id',$Quotes->id)->first();

                $findQuotes->user_id       = Auth::user()->id;
                $findQuotes->quotes_id     = $QuotesNew->id;
                $findQuotes->invoice_id    = $invoice->id;
                $findQuotes->issue_date    = $QuotesNew->date_created;
                $findQuotes->due_date      = $QuotesNew->valid_until;
                $findQuotes->generated_by  = 1; 
                $findQuotes->issue_date    =  $QuotesNew->date_created;
                $findQuotes->product_id    =  $QuotesNew->Products_id;
                $findQuotes->cost_per_item     =  $QuotesNew->unit_price;
                $findQuotes->calc_tax      =  $QuotesNew->tax;
                $findQuotes->client_id     =  $QuotesNew->customer_name;
                $findQuotes->due_date      =  $QuotesNew->valid_until;
                $findQuotes->discount_value  =  $QuotesNew->discount;
                $findQuotes->amount  =  $QuotesNew->total;
                $findQuotes->total_amt  =  $QuotesNew->total;
                $findQuotes->save();
            }else{
                $findQuotes = new Orders();
                $findQuotes->invoice_id    = $invoice->id;
                $findQuotes->user_id       = Auth::user()->id;
                $findQuotes->quotes_id     = $QuotesNew->id;
                $findQuotes->issue_date    = $QuotesNew->date_created;
                $findQuotes->due_date      = $QuotesNew->valid_until;
                $findQuotes->generated_by  = 1; 
                $findQuotes->issue_date    =  $QuotesNew->date_created;
                $findQuotes->product_id    =  $QuotesNew->Products_id;
                $findQuotes->cost_per_item     =  $QuotesNew->unit_price;
                $findQuotes->calc_tax      =  $QuotesNew->tax;
                $findQuotes->client_id     =  $QuotesNew->customer_name;
                $findQuotes->due_date      =  $QuotesNew->valid_until;
                $findQuotes->discount_value  =  $QuotesNew->discount;
                $findQuotes->amount  =  $QuotesNew->total;
                $findQuotes->total_amt  =  $QuotesNew->total;
                $findQuotes->save();
            }
                    
            // return response()->json(['success' => true, 'message' => 'Quotes Accepted successfully.']);
            return redirect('admin/Quotes/home')->with('success', "Invoice Generated Successfully");
        }else{
            return redirect('admin/Quotes/home')->with('error', "Invoice Generated Failed");
        }
    }

    public function SendQuotes(Request $request, $id)
    {
        $Quotess = Quotes::find($id);
        
        // $Quotes = Quotes::select('quotes.*','invoices.is_payment_recieved','invoices.invoice_number1','invoices.invoice_number2','company_logins.company_name','company_logins.companylogo','company_logins.email_address','company_logins.contact_no','company_logins.billing_address','users.first_name','users.last_name','users.email','users.address')
        //     ->leftjoin('users','users.id','quotes.customer_name')
        //     ->leftjoin('invoices','invoices.Quotesid','quotes.id')
        //     ->leftjoin('company_logins','company_logins.id','quotes.company_id')
        //     ->where('quotes.id',$Quotess->id)->first();
        $Quotes = Quotes::select(
            'quotes.*',
            'invoices.is_payment_recieved',
            'invoices.invoice_number1',
            'invoices.invoice_number2',
            'company_logins.company_name',
            'company_logins.companylogo',
            'company_logins.email_address',
            'company_logins.contact_no',
            'company_logins.billing_address',
            'company_logins.pan_number',
            'company_logins.hsn_number',
            'company_logins.gst_number',
            'company_logins.tan_number',
            'company_logins.pin_code',
            'users.first_name',
            'users.last_name',
            'users.email',
            'users.address',
            'client_details.address_1',
            'client_details.address_2',
            'client_details.pincode',
            'client_details.gstin',
            'client_details.hsn_sac'
        )
        ->leftJoin('users', 'users.id', '=', 'quotes.customer_name')
        ->leftJoin('invoices', 'invoices.Quotesid', '=', 'quotes.id')
        ->leftJoin('company_logins', 'company_logins.id', '=', DB::raw('(SELECT id FROM company_logins ORDER BY id ASC LIMIT 1)'))
        ->leftJoin('client_details', 'client_details.user_id', '=', 'quotes.customer_name') // Added join for client_details
        ->where('quotes.id', $id)
        ->first();

        $email = $Quotes->email; 
        $userName = $Quotes->first_name . $Quotes->last_name; 
        $QuotesCal = QuotesCal::where('quotes_id',$Quotes->id)->get();
        $InvoiceSettings = InvoiceSettings::where('id',1)->first();
        $TemplateSettings = Template::where('name', 'Quotation Submission')->first();
        $MailSettings = MailSettings::where('type','Bulk')->where('id',1)->first();
        
        if ($MailSettings->smtp == '1'){
            config([
                'mail.driver'     => $MailSettings->smtp_mailer,
                'mail.host'       => $MailSettings->smtp_host,
                'mail.port'       => $MailSettings->smtp_port,
                'mail.username'   => $MailSettings->smtp_user_name,
                'mail.password'   => $MailSettings->smtp_password,
                'mail.encryption' => $MailSettings->smtp_encryption,
            ]);

            $subject  = $TemplateSettings->subject;
            $header   = $TemplateSettings->header;
            $template = $TemplateSettings->template;
            $footer   = $TemplateSettings->footer;
            $title   = 'Quotation Submission';


            $replacementsTemplate = array(
                '{$client_name}' => $userName,
                '[Product/Service Name]' => '',
                '[Company Name]' => 'CloudTechtiq',
            );

            $messageReplacementsTemplate = $template;
            $template = str_replace(array_keys($replacementsTemplate), array_values($replacementsTemplate),$messageReplacementsTemplate);
            // $Quotes = Quotes::select('quotes.*','invoices.is_payment_recieved','invoices.invoice_number1','invoices.invoice_number2','company_logins.company_name','company_logins.companylogo','company_logins.email_address','company_logins.contact_no','company_logins.billing_address','users.first_name','users.last_name','users.email','users.address')
            //     ->leftjoin('users','users.id','quotes.customer_name')
            //     ->leftjoin('invoices','invoices.Quotesid','quotes.id')
            //     ->leftjoin('company_logins','company_logins.id','quotes.company_id')
            //     ->where('quotes.id',$id)->first();

            $Quotes = Quotes::select(
                'quotes.*',
                'invoices.is_payment_recieved',
                'invoices.invoice_number1',
                'invoices.invoice_number2',
                'company_logins.company_name',
                'company_logins.companylogo',
                'company_logins.email_address',
                'company_logins.contact_no',
                'company_logins.billing_address',
                'company_logins.pan_number',
                'company_logins.hsn_number',
                'company_logins.gst_number',
                'company_logins.tan_number',
                'company_logins.pin_code',
                'users.first_name',
                'users.last_name',
                'users.email',
                'users.address',
                'client_details.address_1',
                'client_details.address_2',
                'client_details.pincode',
                'client_details.gstin',
                'client_details.hsn_sac'
            )
            ->leftJoin('users', 'users.id', '=', 'quotes.customer_name')
            ->leftJoin('invoices', 'invoices.Quotesid', '=', 'quotes.id')
            ->leftJoin('company_logins', 'company_logins.id', '=', DB::raw('(SELECT id FROM company_logins ORDER BY id ASC LIMIT 1)'))
            ->leftJoin('client_details', 'client_details.user_id', '=', 'quotes.customer_name') // Added join for client_details
            ->where('quotes.id', $id)
            ->first();

            $TemplateSettings = Template::where('name', 'Quotation Submission')->first();
            $MailSettings = MailSettings::where('type','Bulk')->where('id',1)->first();
            // $Quotes = Quotes::select('quotes.*','invoices.is_payment_recieved','invoices.invoice_number1','invoices.invoice_number2','company_logins.company_name','company_logins.companylogo','company_logins.email_address','company_logins.contact_no','company_logins.billing_address','users.first_name','users.last_name','users.email','users.address')
            //     ->leftjoin('users','users.id','quotes.customer_name')
            //     ->leftjoin('quotes_cals','quotes_cals.quotes_id','quotes.id')
            //     ->leftjoin('product_news','product_news.id','quotes_cals.Products_id')
            //     ->leftjoin('invoices','invoices.Quotesid','quotes.id')
            //     ->leftjoin('company_logins','company_logins.id','quotes.company_id')
            //     ->where('quotes.id',$id)->first();
            
            $QuotesCal = QuotesCal::where('quotes_id',$id)->get();
            $InvoiceSettings = InvoiceSettings::first();
            $Currency = Currency::where('is_default',1)->first();

            // dd($Quotess);
            $pdf = PDF::loadView('admin.sales.Quotes.downloadView', ['Quotes' => $Quotes ,'InvoiceSettings' => $InvoiceSettings ,'QuotesCal' => $QuotesCal,'Currency' => $Currency]);

            $filename = 'Quotes_' . $id . '.pdf';

            $pdfPath = storage_path('app/pdf/' . $filename);
            if (!is_writable(storage_path('app/pdf/'))) {
                throw new \Exception("The directory is not writable: " . storage_path('app/pdf/'));
            }    
            $pdf->save($pdfPath);

            // Generate PDF
            $pdf = PDF::loadView('admin.sales.Quotes.downloadView', [
                'Quotes' => $Quotes,
                'InvoiceSettings' => $InvoiceSettings,
                'QuotesCal' => $QuotesCal,
                'Currency' => $Currency
            ]);

            // Save the PDF to the server
            $pdfPath = storage_path('app/pdf/' . $filename);
            if (!is_writable(storage_path('app/pdf/'))) {
                throw new \Exception("The directory is not writable: " . storage_path('app/pdf/'));
            }    
            $pdf->save($pdfPath);

            // Attach the PDF to the email
            $pdfData = file_get_contents($pdfPath);

            // Send the email with the PDF attachment
            if (!empty($email)) {
                // Construct and send the email only if the recipient's email address is not empty
                Mail::to($email)->send(new SendQuotes($subject, $header, $template, $footer, $title, $pdfData, $filename));
                return redirect('admin/Quotes/home')->with('success', "Quotes Sent Successfully");
            } else {
                // Redirect with an error message if the recipient's email address is empty
                return redirect('admin/Quotes/home')->with('error', "Recipient's email address is empty. Quotes could not be sent.");
            }
             // Mail::to($Quotes->email)->send(new SendQuotes($subject,$header,$template,$footer,$title));               
        }
        
        return redirect('admin/Quotes/home')->with('error', "Quotes Sent Failed");

    }

    ///get user details
    public function getUserDetails(Request $request)
    {
        $getUserDetails = User::find($request->id);
        if($getUserDetails)
        {
            $data['first_name'] = $getUserDetails->first_name;
            $data['last_name'] = $getUserDetails->last_name;
            $data['email'] = $getUserDetails->email;
            $data['phone_number'] = $getUserDetails->phone_number;
            $data['company_name'] = $getUserDetails->company_name;
            $data['status'] = true; 
            $data['message'] = 'User Detail fond Successfully'; 
        }else
        {
        $data['status'] = false; 
        $data['message'] = 'User Detail not fond';
        }
        return json_encode($data);
    }

}




























































