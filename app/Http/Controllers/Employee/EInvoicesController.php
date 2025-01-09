<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\InventoryExport; 
use Illuminate\Support\Collection;
use App\Models\OperatingSysten;
use App\Models\PaymentMethod;   
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use App\Models\IPAddress;
use App\Models\AddonOrder;   
use App\Models\OsOrder;   
use App\Models\Project;   
use App\Models\Inventory;   
use App\Models\Orders;   
use App\Models\Invoice;   
use App\Models\Countrys;
use App\Models\Employee;
use App\Models\Currency;   
use App\Models\Firewall;
use App\Models\Product;
use App\Models\Switchs;
use App\Models\Status;
use App\Models\User;
use App\Models\Rack;
use Hash;
use Auth;


class EInvoicesController extends Controller
{   
    //home page
   public function home(Request $request)
    {
        $query = Invoice::select('invoices.*', 'users.first_name','projects.project_name','projects.id as projects_id')
            ->leftjoin('users', 'users.id', 'invoices.client_id')
            ->leftjoin('projects', 'projects.id', 'invoices.project_id')
            ->orderBy('invoices.created_at', 'desc');

        $searchTerm ='';    

        // Check if a search term is provided in the request
        if ($request->has('search')) {
            $searchTerm = $request->input('search');

            // Modify the query to search for the provided term
            $query->where(function ($q) use ($searchTerm) {
                $q->where('invoices.name', 'like', '%' . $searchTerm . '%')
                  ->orWhere('invoices.issue_date', 'like', '%' . $searchTerm . '%')
                  ->orWhere('invoices.invoice_number', 'like', '%' . $searchTerm . '%')
                  ->orWhere('invoices.due_date', 'like', '%' . $searchTerm . '%')
                  ->orWhere('invoices.shipping_address', 'like', '%' . $searchTerm . '%')
                  ->orWhere('users.first_name', 'like', '%' . $searchTerm . '%');
            });
        }

        // Execute the query and paginate the results
        $Invoice = $query->paginate(10);
         $Invoice->appends(['search' => $searchTerm]);

        return view('Employee.Invoices.home', compact('Invoice','searchTerm'));
    }




    //home page
    public function Create(Request $request)
    {   
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Invoices Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Invoices/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        $Service = Product::get();
        $Vendor = User::select('id','first_name')->where('type','3')->get();
        $Employee = User::select('first_name','id')->where('type',4)->get();
        $Client = User::select('first_name','id')->where('type',2)->get();
        $Project = Project::where('status_id',1)->get();
        return view('Employee.Invoices.create',compact('Vendor','Employee','Project','Client','Service')); 
    }


 
     public function store(Request $req)
  {
    // return $req->applied_tax;
    // return $req->all();
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

    $user_id = Auth::user()->id;
    // return $req->product_id;
    if (isset($req->product_id) && count($req->product_id) > 0) {
      $productPrice = ProductPricing::where('product_id', $req->product_id[0])->value('price');
      $newOrder = new Orders();
      $newOrder->product_id = $req->product_id[0];
      $newOrder->project_id = $req->project_id;
      $newOrder->client_id = $req->client_id;
      $newOrder->taxes = isset($req->taxes2) ? implode(',',$req->taxes2) : 0;
      $newOrder->amount = $req->cost_per_items[0];
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
          $orderAddon->addon_id = $value;

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
        // 'product_id' => $order->product_id,
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

      
      $id = $invoice->id;
      $agent = new Agent();
      $browser = $agent->browser();
      $version = $agent->version($browser);

      $logData = [
        'user_id' => Auth::user()->id,
        'ip' => $req->ip(),
        'subject' => "Invoice Data Store By " . Auth::user()->first_name,
        'url' => url('/') . '/Employee/Invoices/store',
        'method' => "Post",
        'browser' => $browser . "-" . $version,
      ];

      LogActivity::create($logData);

      $user_id = $req->client_id;
      $user = User::find($req->client_id);
      $InvoiceDetailsAll = Orders::where('invoice_id', $id)
        ->with('user', 'clientDetails')
        ->first();
      

      if ($req->project_id == '') {

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
            'client_details.gstin as gstin',
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
          ->leftJoin('orders', 'invoices.id', 'orders.invoice_id')
           ->leftJoin('product_pricing', 'product_pricing.id', 'orders.billing_cycle')
          ->leftJoin('tax_settings', 'orders.taxes', 'tax_settings.id')
          ->where('invoices.id', $invoice->id)
          ->first();

        $addOnProduct = AddonOrder::join('product_news', 'product_news.id', 'addon_orders.addon_id')
          ->join('product_pricing', 'product_news.id', 'product_pricing.product_id')
          ->where('order_id', $newOrder->id)
          ->select('addon_orders.*', 'product_news.product_name', 'product_news.description', 'product_pricing.price')
          ->distinct()
          ->get();

      } else {
        $InvoiceDetails = Invoice::with('orders')
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
            'client_details.gstin as gstin',
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
            'currencies.prefix'
          )
          ->leftJoin('orders', 'invoices.id', 'orders.invoice_id')
          ->where('invoices.id', $invoice->id)
          ->first();

          $InvoiceDetails->orders->product = Project::where('id',optional($InvoiceDetails->orders)->product_id)
          ->select('project_name as product_name','projects.project_summary as description')
          ->first();

          $addOnProduct = AddonOrder::join('projects', 'projects.id', 'addon_orders.addon_id')
            ->where('order_id', $newOrder->id)
            ->select('addon_orders.*', 'projects.project_name as product_name', 'projects.project_summary as description')
            ->distinct()
            ->get();

          // return $addOnProduct;
      }


      $Currency  = Currency::where('is_default', 1)->first();
      $taxes = TaxSetting::where('status', 1)->get();
      $transaction = Transaction::where('invoice_id', optional($InvoiceDetails)->id)->first();
      $Company = CompanyLogin::find(1);
      $Project = Project::where('status_id', 1)->get();

      $pdf = PDF::loadView('Employee.Invoices.downloadView', compact('InvoiceDetails', 'transaction', 'Currency', 'addOnProduct', 'taxes'));
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
        
        if($ClientDetail){
          if($ClientDetail->all_emails == 1 ){
            Mail::to($emails)->send(new InvoicePaymentConfirmation($subject1, $header1, $template1, $footer1));
          }else if($ClientDetail->invoices == 1){
            Mail::to($emails)->send(new InvoiceGenerated($pdfFilePath, $subject, $header, $template, $footer, $invoice));
          }
        }else{ 
          Mail::to($emails)->send(new InvoicePaymentConfirmation($subject1, $header1, $template1, $footer1));
          Mail::to($emails)->send(new InvoiceGenerated($pdfFilePath, $subject, $header, $template, $footer, $invoice));
        }
      }
    }

    return redirect('Employee/Invoices/home')->with('success', "New Invoice Added Successfully");
  }
    public function storesOld(Request $req)
    {
        $url = url('/').'/public/images/';

        // Process invoice_attachment
        $invoice_attachment = 'default_bill_attachment.jpg';
        if ($req->hasFile('invoice_attachment')) {
            $rand = Str::random(4);
            $file = $req->file('invoice_attachment');
            $extension = $file->getClientOriginalExtension();
            $invoice_attachment = 'bill_'.$rand.'.'.$extension;
            $file->move('public/images/', $invoice_attachment);
        }
        // $AssignedTo = implode(",", $req->AssignedTo);
        $data = $req->all();
        $data['invoice_attachment'] = $url . $invoice_attachment;
        $data['user_id'] = Auth::user()->id;
        $data['invoice_number'] = $req->invoice_number1 . $req->invoice_number2;
        // $data['item_name'] = $req->item_name;
        // $data['AssignedTo'] = $AssignedTo;
        $data['is_payment_recieved'] = $req->has('is_payment_recieved') ? true : false;
        $invoice = Invoice::create($data);

        // Create Order
        $order = new Orders();
        $order->invoice_id = $invoice->id; 
        $order->product_id = $req->services_id; 
        $order->services_type = $req->services_type; 
        $order->unit_id = $req->unit_id; 
        $order->item_name = $req->item_name; 
        $order->item_summary = $req->item_summary; 
        $order->cost_per_item = $req->cost_per_item; 
        $order->taxes = $req->taxes; 
        $order->amount = $req->amount; 
        $order->item_summary = $req->item_summary; 
        $order->invoice_item_image = $req->invoice_item_image; 
        $order->invoice_item_image_url = $req->invoice_item_image_url; 
        $order->save();

        // Log activity
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);

        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Invoice Data Store By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Invoices/store';
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('Employee/Invoices/home')->with('success', "New Invoice Added Successfully");
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
        $Log['url'] = url('/') . '/Employee/Invoices/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);
        $Client = User::select('first_name','id')->where('type',2)->get();
        $Project = Project::where('status_id',1)->get();
        $Inventory = Invoice::find($id);
        $Vendor = User::select('id','first_name')->where('type','3')->get();
        $Employee = User::select('first_name','id')->where('type',4)->get();
        return view('Employee.Invoices.edit',compact('Inventory','Vendor','Employee','id','Client','Project'));
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
        $Log['url'] = url('/') . '/Employee/Inventory/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('Employee/Invoices/home')->with('success', "Invoices Edit Successfully");
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
        $Log['url'] = url('/') . '/Employee/Invoices/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        Invoice::find($id)->delete();
        return redirect('Employee/Invoices/home')->with('success', "Invoices Deleted Successfully");
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
    $log['url'] = url('/') . '/Employee/Invoices/delete/' . $request->selectedServiceId; // Fixing the $id issue
    $log['method'] = "GET";
    $log['browser'] = $browser . "-" . $version;

    LogActivity::create($log);

    // Assuming $request->selectedServiceType is a valid column name
    $getPrice = Product::where('id', $request->selectedServiceId)->select('id', $request->selectedServiceType)->first();

    return response(['status' => true, 'data' => $getPrice]);
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
            $Log['url'] = url('/') . '/Employee/Invoices/EXPORTCSV';
            $Log['method'] = "Get";
            $Log['browser'] = $browser . "-" . $version;
            LogActivity::create($Log);

        return Excel::download(new InventoryExport, 'Invoices.csv');
    }
    
    public function getInvoiceDetails($id)
    {
        $invoice = Invoice::find($id);
        if ($invoice->project_id) {
            $InvoiceDetails = Invoice::with('orders')
                ->leftJoin('users', 'users.id', 'invoices.client_id')
                ->leftJoin('client_details', 'client_details.user_id', 'invoices.client_id')
                ->leftJoin('currencies', 'currencies.id', 'invoices.currency')
                ->leftJoin('orders', 'invoices.id', 'orders.invoice_id')
                ->leftJoin('product_pricing', 'orders.product_id', 'product_pricing.product_id')
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
                ->where('invoices.id', $id)
                ->first();
    
            $InvoiceDetails->orders->product = Project::where('id', optional($InvoiceDetails->orders)->product_id)
                ->select('project_name as product_name', 'projects.project_summary as description')
                ->first();
            
            $findProduct = ProductNew::find($InvoiceDetails->orders->product_id);
    
            $OsOrder = OsOrder::leftJoin('operating_systens', 'operating_systens.id', 'os_orders.os_id')
                ->leftJoin('o_s_categories', 'o_s_categories.os_id', 'operating_systens.id')
                ->where('os_orders.order_id', $InvoiceDetails->orders->id)
                ->where('o_s_categories.category_id', $findProduct->category_id)
                ->select('os_orders.*', 'operating_systens.ostype', 'o_s_categories.price as os_price')
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
                ->leftJoin('product_pricing', 'orders.product_id', 'product_pricing.product_id')
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
                    'tax_settings.rate'
                )
                ->where('invoices.id', $id)
                ->first();
    
            $findProduct = ProductNew::find($InvoiceDetails->orders->product_id);
    
            $OsOrder = OsOrder::leftJoin('operating_systens', 'operating_systens.id', 'os_orders.os_id')
                ->leftJoin('o_s_categories', 'o_s_categories.os_id', 'operating_systens.id')
                ->where('os_orders.order_id', $InvoiceDetails->orders->id)
                ->where('o_s_categories.category_id', $findProduct->category_id)
                ->select('os_orders.*', 'operating_systens.ostype', 'o_s_categories.price as os_price')
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
    
        $Currency = Currency::where('is_default', 1)->first();
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
}
