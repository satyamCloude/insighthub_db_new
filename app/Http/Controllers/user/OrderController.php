<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Jenssegers\Agent\Agent;
use App\Models\Orders;
use App\Models\Product;
use App\Models\Producttype;
use App\Models\Cart;
use App\Models\Currency;
use App\Models\InvoiceSettings;
use App\Models\CompanyLogin;
use App\Models\Project;
use App\Models\ClientDetail;
use App\Models\Ticket;
use App\Models\CloudHosting;
use App\Models\OperatingSysten;
use App\Models\CloudServices;
use App\Models\Switchs;
use App\Models\Firewall;
use App\Models\LogActivity;
use App\Models\EmployeeDetail;
use App\Models\DedicatedServer;
use App\Models\OrderToProduct;
use App\Models\ProductPricing;
use App\Models\ProductNew;
use App\Models\AddonOrder;
use App\Models\OsOrder;
use App\Models\Transaction;
use App\Models\TotalService;
use App\Models\TaxSetting;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoicePaymentConfirmation;
use App\Mail\InvoiceGenerated;
use App\Models\MailSettings;
use App\Models\BareMetal;
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
use App\Models\Credit;

use App\Models\Template;
use App\Models\Category;
use App\Models\Invoice;
use App\Models\User;
use App\Models\PaymentDetail;
use ZipArchive;
use Hash;
use Validator;
use Auth;
use View;
use Session;
use DB;
use PDF;


class OrderController extends Controller
{
    public function home(Request $request)
    {
        $query = Orders::select(
            'orders.id as order_number',
            'orders.order_status',
            'orders.is_payment_recieved',
            'orders.total_amt',
            'orders.updated_at',
            'orders.created_at as order_date',
            'users.first_name',
            'orders.user_id as orderuser_id',
            'users.profile_img',
            'product_pricing.product_plan',
            'product_pricing.price',
            'product_pricing.currency_id',
            'currencies.prefix',
            'currencies.code',
            'product_news.product_name',
            'product_news.description',
            'users.email'
        )
            ->leftJoin('users', 'users.id', '=', 'orders.user_id')
            ->leftJoin('product_news', 'product_news.id', '=', 'orders.product_id')
            ->leftJoin('product_pricing', 'product_pricing.product_id', '=', 'product_news.id')
            ->leftJoin('currencies', 'orders.currency', '=', 'currencies.id')
            ->whereNull('product_news.deleted_at')
            ->whereNull('orders.quotes_id')
            ->where(function ($query) {
                $query->where('orders.user_id', Auth::user()->id)
                    ->where('orders.user_id', '!=', 1)
                    ->whereNull('orders.quotes_id')
                    ->orWhere('orders.client_id', Auth::user()->id);
            })
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

        return view('user.order.home', compact('users', 'totalOrders', 'delivered', 'onHold', 'accepted', 'lost', 'win', 'searchTerm'));
    }

    public function home2sold(Request $request)
    {

        $query = Orders::select('orders.id as order_number', 'orders.order_status', 'orders.is_payment_recieved', 'orders.total_amt', 'orders.updated_at', 'orders.created_at as order_date', 'users.first_name', 'orders.user_id as orderuser_id', 'users.profile_img', 'product_pricing.product_plan', 'product_pricing.price', 'product_pricing.currency_id', 'product_news.product_name', 'product_news.description', 'users.email')
            ->leftJoin('users', 'users.id', '=', 'orders.user_id')
            ->leftJoin('product_news', 'product_news.id', '=', 'orders.product_id')
            ->leftJoin('product_pricing', 'product_pricing.product_id', '=', 'product_news.id')
            ->whereNull('product_news.deleted_at')
            ->where('orders.user_id', Auth::user()->id)
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
        $totalOrders = DB::table('orders')->count();
        $delivered = DB::table('orders')->where('order_status', '1')->count();
        $onHold = DB::table('orders')->where('order_status', '2')->count();
        $accepted = DB::table('orders')->where('order_status', '3')->count();
        $lost = DB::table('orders')->where('order_status', '4')->count();
        $win = DB::table('orders')->where('order_status', '5')->count();
        return view('user.order.home', compact('users', 'totalOrders', 'delivered', 'onHold', 'accepted', 'lost', 'win', 'searchTerm'));
    }
    ////////////FOR ADD ORDER
    public function addOrder(Request $request)
    {
        $addOnProductCount = AddonOrder::where('product_id', $request->selected_prod_id)->where('status', 0)->where('user_id', Auth::user()->id)->count();

        if ($addOnProductCount > 0) {
            return response()->json([
                'status' => 'false',
                'user_status' => '1',
                'user_status_message' => 'Product already added on your cart',
            ]);
        } else {
            $product_id = Session::get('product_id');
            $cartData = Cart::where('user_id', auth::user()->id)->where('order_id', 0)->count();
            if ($cartData == 0) {
                Cart::where('user_id', auth::user()->id)->where('order_id', 0)->delete();
            }
            // Session::forget('orderDetail');
            // Session::forget('cartOrder');
            // Session::forget('orderId');
            // Session::forget('totalAmount');


            $data = $request->all();
            $user = auth()->user();


            $amont = ($data['total_amt'] * $data['tax'] / 100);
            $amont = $amont + $data['total_amt'];

            $order['userId'] = $user->id;
            $order['client_id'] = $user->id;
            $order['product_id'] = $data['selected_prod_id'];
            $order['order_type'] = 'client_order';
            $order['total_amt'] = $amont;
            $order['os_id'] = isset($data['os_id']) ? $data['os_id'] : 0;
            $order['withoutGst'] = $data['total_amt'];
            $order['productCategoryId'] = $data['category_id'];
            $order['productTypeId'] = $data['product_type_id'];
            $order['order_status'] = 0;
            $order['tax'] = $data['tax'];
            $order['selected_prod_id'] = $data['selected_prod_id'];

            Session::put('orderDetail', $order);

            return response()->json([
                'status' => 'success',
                'user_status' => '1',
                'user_status_message' => 'Order created successfully',
            ]);
        }
    }
    ///////order Update
    public function update(Request $request)
    {
        // return $request->all();
        $order = Orders::find($request->orderId);

        if ($order) {
            
            if(isset($request->walletBalance) && $request->walletBalance > 0){
                Credit::create([
                    'client_id' => Auth::user()->id,
                    'amount' => '-'.$request->walletBalance
                ]);
            }

            // return $order;
            // $order = Orders::find($request->orderId);
            $url = url('/') . '/public/images/';
            $invoice_attachment = 'default_bill_attachment.jpg';

                if ($request->hasFile('invoice_attachment')) {
                    $rand = Str::random(4);
                    $file = $request->file('invoice_attachment');
                    $extension = $file->getClientOriginalExtension();
                    $invoice_attachment = 'bill_' . $rand . '.' . $extension;
                    $file->move(public_path('images'), $invoice_attachment);
                }

                // Generate new invoice number
                $invoice_number2 = Invoice::max('invoice_number2');
                $invoice_number2 = (int) $invoice_number2 + 1;

                // Get product price
                $productPrice = ProductPricing::where('product_id', $order->product_id)->value('price');

                // Get current user ID
                $user_id = Auth::id();

                $checkInvoice = Invoice::where('order_id', $order->id)->first();

                // Calculate paid amount and TDS percent
                if ($checkInvoice && $checkInvoice && $checkInvoice->paid_amount > 0) {
                    $paid_amount = $checkInvoice->paid_amount + $request->paymentAmount + $request->walletBalance;
                    $tds_percent = $checkInvoice->tds_percent;
                } else {
                    $paid_amount = $request->paymentAmount + $request->walletBalance;
                    $tds_percent = $order->tds_percent;
                }
                if($checkInvoice && $checkInvoice->paid_amount != $checkInvoice->final_total_amt){
                                $order->update(['is_payment_recieved' => 0]);
                                $is_payment_recieveds = 0;
                            }else{
                                $order->update(['is_payment_recieved' => 1]);
                                $is_payment_recieveds = 1;
                            }
                // Prepare invoice data
                $data1 = [
                    'invoice_attachment' => $invoice_attachment ? url('images/' . $invoice_attachment) : null,
                    'client_id' => $user_id,
                    'user_id' => $user_id,
                    'product_id' => $order->product_id,
                    'invoice_number1' => 'INV#',
                    'invoice_number2' => $invoice_number2,
                    'issue_date' => now(),
                    'tds_percent' => $tds_percent,
                    'remarks' => $order->remarks,
                    'amount' => $order->total_amt,
                    'due_date' => $order->due_date,
                    'order_id' => $order->id,
                    'sub_total' => $productPrice,
                    'currency' => $order->currency,
                    'exchange_rate' => $order->exchange_rate,
                    'final_total_amt' => $order->total_amt,
                    'paid_amount' => $paid_amount,
                    'project_id' => $order->project_id,
                    'calc_tax' => $order->calc_tax ?? 0,
                    'bank_account' => $order->bank_account,
                    'billing_address' => $order->billing_address,
                    'shipping_address' => $order->shipping_address,
                    'generated_by' => $order->generated_by,
                    'is_payment_recieved' => $is_payment_recieveds,
                ];

                // Update or create invoice
                if ($checkInvoice && $checkInvoice->paid_amount > 0) {
                    $checkInvoice->update($data1);
                } else {
                    $invoice = Invoice::create($data1);
                }


            AddonOrder::where('order_Id', $order->id)->update(['status' => 1]);
            Cart::where('user_id', auth()->id())->delete();
            $billing_cycle = $order->billing_cycle;
            $product_id = $order->product_id;
            $get_prod = ProductNew::find($product_id);
            $get_plan = ProductPricing::find($order->billing_cycle);
            $category_id = $get_prod->category_id;
            $invoice = Invoice::where('order_id', $order->id)->first();

            $order->invoice_id = $invoice->id;
            $order->amtWithoutGST = $request->amtWithoutGst;
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
                
                // Extract the class name without the namespace
                $className = class_basename($class);
                    

                $lastServiceId = $class::where('user_id', Auth::user()->id)->latest()->value('unique_service_id');
                
                // If no previous service ID found, start with '001', otherwise increment the numeric part
                if ($lastServiceId) {
                    preg_match('/(\d+)$/', $lastServiceId, $matches);
                    $nextServiceNumber = sprintf('%03d', intval($matches[0]) + 1);
                    $prefix = strtoupper(substr($className, 0, 4));
                    
                    // Append additional identifiers for CloudHosting and CloudServices, and MicrosoftOffice365 and Azure
                    if ($class === CloudHosting::class || $class === CloudServices::class) {
                        $prefix .= '_CL';
                    } elseif ($class === MicrosoftOffice365::class || $class === Azure::class) {
                        $prefix .= '_MS';
                    }
                    
                    $newServiceId = $prefix . '_' . $nextServiceNumber;
                } else {
                    $prefix = strtoupper(substr($className, 0, 4));
                    
                    // Append additional identifiers for CloudHosting and CloudServices, and MicrosoftOffice365 and Azure
                    if ($class === CloudHosting::class || $class === CloudServices::class) {
                        $prefix .= '_CL';
                    } elseif ($class === MicrosoftOffice365::class || $class === Azure::class) {
                        $prefix .= '_MS';
                    }
                    
                    $newServiceId = $prefix . '_001';
                }
            $add_service_data = new $class;
            $add_service_data->user_id = Auth::user()->id;
            $add_service_data->customer_id = Auth::user()->id;
            $add_service_data->unique_service_id = $newServiceId;
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

            if($request->payment_id == 'wallet_id'){
                $payment_method = 'Wallet';
            }else{
                $payment_method = 'Razorpay';
            }
            
            $Transaction = [
                'user_id' => auth()->id(),
                'invoice_id' => $invoice->id,
                'paymentMethod' => $payment_method,
                'razorpay_payment_id' => $request->payment_id,
                'amount' => $paid_amount,
            ];

            Transaction::create($Transaction);
               
            $maxUniqueId = TotalService::max('unique_id');
            $newUniqueId = $maxUniqueId + 1;
            $totalService = [
                'user_id' => auth()->id(),
                'category_id' => $category_id,
                'unique_id' => $newUniqueId,
                'invoice_id' => $invoice->id,
            ];

            // Create a new TotalService record
            TotalService::create($totalService);

            $logData = [
                'user_id' => auth()->id(),
                'ip' => $request->ip(),
                'type' => 'invoice',
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
            $Currency = $Currency = Currency::join('orders','orders.currency','currencies.id')
                        ->where('invoice_id', $invoice->id)
                        ->select('currencies.*')
                        ->first();

            $Project = Project::where('status_id', 1)->get();

          $user_id = $invoice->client_id;
          $user = User::find($invoice->client_id);
    
          $invoiceData = $this->getInvoiceDetails($invoice->id);
          $InvoiceDetails = $invoiceData['InvoiceDetails'];
          $transaction = $invoiceData['transaction'];
          $Currency = $invoiceData['Currency'];
          $OsOrder = $invoiceData['OsOrder'];
          $InvoiceSettings = $invoiceData['InvoiceSettings'];
          $addOnProduct = $invoiceData['addOnProduct'];
          $taxes = $invoiceData['taxes'];
          $Company = $invoiceData['Company'];
    
          $pdf = PDF::loadView('admin.Invoices.downloadView', compact('InvoiceDetails','InvoiceSettings', 'transaction', 'Currency', 'addOnProduct', 'taxes','OsOrder','Company'));

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

                if($invoice->is_payment_recieved != 1){
               $invoice->final_total_amt == $invoice->final_total_amt;
            }else{
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

                $messageReplacementsTemplate1 = $TemplateSettings1->template;
                $template1 = str_replace(array_keys($replacementsTemplate1), array_values($replacementsTemplate1), $messageReplacementsTemplate1);

                $template1 = str_replace(array_keys($replacementsTemplate1), array_values($replacementsTemplate1), $messageReplacementsTemplate1);
                $header1 = $TemplateSettings1->header;
                $footer1 = $TemplateSettings1->footer;

                $dataMail = $this->getInvoiceDetails($invoice->id);
                Mail::to($emails)->send(new InvoicePaymentConfirmation($subject1, $header1, $template1, $footer1));

                Mail::to($emails)->send(new InvoiceGenerated($pdfFilePath, $subject, $header, $template, $footer, $invoice));
            }

            return redirect('user/order/home')->with('success', 'Order successfully created. Your Order Id is : ' . $order->id);
        }

        return redirect('user/order/home')->with('error', 'Something Went Wrong.');
    }

  public function getInvoiceDetails($id)
{
        $invoice = Invoice::find($id);
        if ($invoice->project_id) {
            $InvoiceDetails = Invoice::with('orders')
                ->leftJoin('users', 'users.id', 'invoices.client_id')
                ->leftJoin('client_details', 'client_details.user_id', 'invoices.client_id')
                ->leftJoin('orders', 'invoices.id', 'orders.invoice_id')
                ->leftJoin('currencies', 'currencies.id', 'orders.currency')
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
          $InvoiceDetails = Invoice::with([
        'orders.product.pricing',
        'orders.product.taxSetting',
        'orders.currency',
        'client',
        'client.clientDetails'
    ])
        ->leftJoin('users', 'users.id', '=', 'invoices.client_id')
        ->leftJoin('client_details', 'client_details.user_id', '=', 'invoices.client_id')
        ->leftJoin('orders', 'invoices.id', '=', 'orders.invoice_id')
        ->leftJoin('currencies', 'currencies.id', '=', 'orders.currency')
        ->leftJoin('product_pricing', 'product_pricing.id', '=', 'orders.billing_cycle')
        ->leftJoin('tax_settings', 'orders.taxes', '=', 'tax_settings.id')
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

    $data = [
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
 public function getInvoiceDetailssOld1s($id)
{
    $invoice = Invoice::find($id);
    $addOnProduct = collect(); // Initialize empty collection

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
    public function delete(Request $request)
    {

        Cart::find($request->id)->delete();
        AddonOrder::where('cartId', $request->id)->delete();
        Session::forget('cartOrder');
        return "success";
    }
    /////////SEND CHECKOUT PAGE
    // public function checkOutPage()
    // {
    //     $orderId = Session::get('orderId');
    //     $default_currency = Currency::where('is_default', 1)->first();
    //     $orderDetails =  Cart::where('user_id', Auth::user()->id)->get();
    //     $AddonOrder = AddonOrder::where('order_Id', $orderId)->get();
    //     return view('user.order.cardCheckOut', compact('orderDetails', 'default_currency', 'AddonOrder'));
    // }
    //////show details order wise
    public function view(Request $request, $id)
    {

        $Order = Orders::join('product_news', 'product_news.id', 'orders.product_id')
            ->join('product_pricing', 'product_pricing.id', 'orders.billing_cycle')
            ->join('tax_settings', 'tax_settings.id', 'product_news.tax_id')
            ->select('orders.id', 'orders.is_payment_recieved', 'orders.order_status', 'orders.quantity','orders.billing_cycle','product_pricing.price', 'orders.created_at','orders.product_id as product_id', 'product_news.product_name', 'tax_settings.rate')
            ->where('orders.id', $id)->first();
            // return $Order;
            if($Order){

            $findProduct = ProductNew::find($Order->product_id);

            $OsOrder = OsOrder::leftjoin('operating_systens', 'operating_systens.id', 'os_orders.os_id')
                ->leftjoin('o_s_categories', 'o_s_categories.os_id', 'operating_systens.id')
                ->leftjoin('tax_settings', 'os_orders.tax', 'tax_settings.id')
                ->where('os_orders.order_Id', $Order->id)
                ->where('o_s_categories.category_id', $findProduct->category_id)
                ->select('os_orders.*', 'operating_systens.ostype', 'o_s_categories.price as os_price','tax_settings.rate as tax_rates')
                ->groupBy('operating_systens.id')
                ->first();
  
            }else{
                $OsOrder = '';
            }
// return $OsOrder;
        $Currency = Orders::join('currencies', 'currencies.id', 'orders.currency')
        ->select('currencies.prefix','currencies.code')
        ->where('orders.id',$id)
        ->first();

        $orders = AddonOrder::join('product_news', 'product_news.id', 'addon_orders.addon_id')
            ->join('tax_settings', 'tax_settings.id', 'product_news.tax_id')
            ->join('product_pricing', 'product_pricing.product_id', 'addon_orders.addon_id')
            ->where('addon_orders.order_id', $id)
            ->select('product_news.product_name', 'tax_settings.tax_name', 'product_pricing.price', 'tax_settings.rate')
            ->groupBy('addon_orders.id')
            ->get();

        $orders->prepend($Order);
        // return $orders;
        $clientDetails = ClientDetail::where('user_id',Auth::id())->first();

        return view('user.order.view', compact('Order','clientDetails', 'Currency', 'orders','OsOrder'));
    }
    //////////////delete product form checkout
    public function removeProduct($id)
    {

        $order = Orders::find($id);
    //   return $order;
        if ($order) {
            
            AddonOrder::where('order_id', $order->id)->delete();
            
        }
        $order->delete();
        return redirect()->back();
    }

    //////////////delete addons form checkout
    public function removeAddons($id)
    {
        $check = AddonOrder::find($id)->first();
        if ($check) {
            AddonOrder::find($id)->delete();
        }
        return redirect()->back();
    }

    public function removeOsOrder($id)
    {
        $order = Orders::find($id);
        $order->os_id = 0;
        $order->save();
        Session::put('orderDetail', $order);
        OsOrder::where('order_Id', $id)->delete();
        return redirect()->back();
    }


    /////addToCart
    public function addCart()
    {
        $totalAmount = Session::get('totalAmount');

        if (Session::has('orderDetail')) {
            $data = Session::get('orderDetail');
            $orderCount = Orders::where('user_id', Auth::user()->id)->where('is_payment_recieved', 0)->count();
            $orderId = Orders::where('user_id', Auth::user()->id)->where('is_payment_recieved', 0)->select('id')->first();
            if ($orderId) {
                Session::put('orderId', $orderId->id);
            }
            // echo $data['selected_prod_id']; exit;
            if ($orderCount == 0) {
                $order = new Orders();
                $order->user_id = $data['userId'];
                $order->client_id = $data['client_id'];
                $order->product_id = $data['product_id'];
                $order->product_id = $data['product_id'];
                $order->order_type = 'client_order';
                $order->total_amt = $data['total_amt'];
                $order->productCategoryId = $data['productCategoryId'];
                $order->productTypeId = $data['productTypeId'];
                $order->addOnProductId = Session::get('addOnProductId');
                $order->order_status = 0;
                $order->save();

                $productName = ProductNew::find($data['product_id']);
                $ProductAddOnName = $productName->product_name;
                $ProductAddOnDescription = $productName->description;
                $OrderToProduct = new AddonOrder;
                $OrderToProduct->user_id = Auth::user()->id;
                $OrderToProduct->order_Id = $order->id;
                $OrderToProduct->product_id = $data['product_id'];
                $OrderToProduct->product_name = $ProductAddOnName;
                $OrderToProduct->description = $ProductAddOnDescription;
                $OrderToProduct->price = $data['withoutGst'];
                $OrderToProduct->tax  = $data['tax'];
                $OrderToProduct->save();

                Session::put('orderId', $order->id);
                Session::put('product_id', $data['product_id']);

                $cart                    = new Cart;
                $cart->user_id           = $data['userId'];
                $cart->order_id          = $order->id;
                $cart->tax               = $data['tax'];
                $cart->product_id        = $data['selected_prod_id'];
                $cart->price             = $data['total_amt'];
                $cart->save();

                $cartData = Cart::where('user_id', auth::user()->id)->where('order_id', 0)->update(['order_Id' => $order->id]);
                AddonOrder::where('user_id', auth::user()->id)->where('order_id', 0)->update(['order_Id' => $order->id]);
                if ($totalAmount) {
                    Orders::where('user_id', auth::user()->id)->where('id', $order->id)->update(['total_amt' => $totalAmount]);
                }
                Cart::where('user_id', auth::user()->id)->where('order_id', 0)->delete();
                return response()->json([
                    'status' => 'success',
                    'user_status' => '1',
                    'user_status_message' => 'Product added in cart',
                ]);
            } else {

                $dataAddOn = Session::get('orderDetail');
                $productName = ProductNew::find($dataAddOn['product_id']);
                $ProductAddOnName = $productName->product_name;
                $ProductAddOnDescription = $productName->description;
                $countProduct = AddonOrder::where('product_id', $dataAddOn['product_id'])->where('status', 0)->where('user_id', Auth::user()->id)->count();
                $OrderToProduct = new AddonOrder;
                $OrderToProduct->user_id = Auth::user()->id;
                $OrderToProduct->order_Id = $orderId->id;
                $OrderToProduct->product_id = $data['product_id'];
                $OrderToProduct->product_name = $ProductAddOnName;
                $OrderToProduct->description = $ProductAddOnDescription;
                $OrderToProduct->price = $dataAddOn['withoutGst'];
                $OrderToProduct->tax  = $dataAddOn['tax'];
                $OrderToProduct->save();

                AddonOrder::where('user_id', auth::user()->id)->where('order_id', 0)->update(['order_Id' => $orderId->id]);
                Cart::where('user_id', auth::user()->id)->where('order_id', 0)->update(['order_Id' => $orderId->id]);
                if ($totalAmount) {
                    Orders::where('user_id', auth::user()->id)->where('id', $orderId->id)->update(['total_amt' => $totalAmount]);
                }
                return response()->json([
                    'status' => 'true',
                    'user_status' => '0',
                    'user_status_message' => 'Product added.',
                ]);
            }
        } else {
            return response()->json([
                'status' => 'false',
                'user_status' => '0',
                'user_status_message' => 'Product not found',
            ]);
        }
    }
    //////update order amount
    public function updateOrderPayment(Request $request)
    {
        Orders::where('user_id', Auth::user()->id)->where('is_payment_recieved', 0)->update(['total_amt' => $request->finalAmount,'is_payment_recieved' => 1, 'created_at' => date('Y-m-d H:i:s')]);
        return "success";
    }
    /////////CHECK PRODUCT ALREADY OR NOT
    public function checkOrderAlreadyExit(Request $req)
    {
        $countOrder = AddonOrder::where('product_id', $req->productId)->where('status', 0)->where('user_id', Auth::user()->id)->count();
        return $countOrder;
    }

    public function cart($value = '')
    {
        $default_currency = Currency::where('is_default', 1)->first();
        $order = Orders::join('product_news', 'product_news.id', 'orders.product_id')
            ->leftjoin('product_pricing', 'product_pricing.id', 'orders.billing_cycle')
            ->leftjoin('tax_settings', 'tax_settings.id', 'product_news.tax_id')
            ->leftjoin('currencies', 'currencies.id', 'orders.currency')
            ->where('orders.user_id', Auth::id())
            ->where('orders.deleted_at', null)
            ->where('product_pricing.deleted_at', null)
            ->where('orders.is_payment_recieved', 0)
            ->select('orders.*', 'product_news.product_name','currencies.prefix','currencies.code', 'product_news.description', 'product_pricing.price','product_pricing.plan_type', 'product_pricing.product_plan', 'tax_settings.rate as tax')
            ->latest()
            ->first();
            // return $order;
        $PaymentDetail = PaymentDetail::where('payment_mode',3)->first();
        
        $credits = Credit::where('client_id',Auth::user()->id)->sum('amount');
        $credits = number_format($credits,2);
            // return $order;

        $AddonOrder = '';
        if ($order) {
            $AddonOrder = AddonOrder::join('product_news', 'product_news.id', 'addon_orders.addon_id')
            ->join('product_pricing', 'product_pricing.product_id', 'addon_orders.addon_id')
            ->join('tax_settings', 'tax_settings.id', 'product_news.tax_id')

            ->where('order_Id', $order->id)
            ->select('addon_orders.*', 'product_news.product_name', 'product_news.description', 'product_pricing.price','product_pricing.plan_type', 'product_pricing.product_plan', 'tax_settings.rate as tax')
            ->groupBy('addon_orders.id')
            ->get();
        }
        
        $OsOrder = '';
        if ($order) {
            $findProduct = ProductNew::find($order->product_id);
            $OsOrder = OsOrder::leftjoin('operating_systens', 'operating_systens.id', 'os_orders.os_id')
                ->leftjoin('o_s_categories', 'o_s_categories.os_id', 'operating_systens.id')
                ->where('os_orders.order_Id', $order->id)
                ->where('o_s_categories.currency_id', $order->currency)
                ->where('o_s_categories.category_id', $findProduct->category_id)
                ->select('os_orders.*', 'operating_systens.ostype', 'o_s_categories.price as os_price', 'o_s_categories.currency_id as currency_id')
                ->groupBy('operating_systens.id')
                ->get();
        }
        $clientDetails = ClientDetail::where('user_id',Auth::id())->first();
        // return $OsOrder ;
        return view('user.order.cardCheckOut', compact('credits','clientDetails','order', 'default_currency', 'AddonOrder', 'OsOrder','PaymentDetail'));
    }



    public function getInvoiceData(Request $req){
        $invoice = Invoice::leftJoin('orders','orders.id','invoices.order_id')->where('invoices.id',$req->invoiceId)->select('invoices.*','orders.amtWithoutGST','orders.currency')->first();
        if($invoice){
          return response()->json(['data' => $invoice, 'success' => true]);
            } else {
                return response()->json(['success' => false, 'message' => 'Failed to find invoice.']);
            }

    }
    public function addTdsRemarkBeforePay(Request $req)
    {
        $data = Orders::find($req->orderId);
        if (!$data) {
            return response()->json(['success' => false, 'message' => 'Invoice not found.']);
        } else {
            $data->tds_percent = $req->tdsPercent;
            $data->remarks     = $req->remarks;
            if ($data->save()) {
              // return $req->all();
                $method = 'Other'; // Default to 'Other' if payment method is not 1 or 2
                    if ($data->payment_method == 1) {
                        $method = 'Razorpay';
                    } elseif ($data->payment_method == 2) {
                        $method = 'Paypal';
                    }
                    $fullPaymentStatus = $req->has('fullPaymentStatus') ? 1 : 0;

                    $invoiceUpdate = Invoice::where('order_id',$data->id)->first();
                    // if($invoiceUpdate){
                    //      $already_paid = floatval($invoiceUpdate->paid_amount) ?? 0;
                    //      $paid = floatval($already_paid) + $req->paymentAmount;
                    //         $invoiceUpdate->paid_amount = $paid;
                    //         $invoiceUpdate->is_payment_recieved = $fullPaymentStatus;
                    //         $invoiceUpdate->payment_method = $req->paymentMethod;
                    //         $invoiceUpdate->tds_percent = $req->tdsPercent;
                    //         $invoiceUpdate->remarks = $req->remarks;
                    //         $invoiceUpdate->save();
                    // }

                return response()->json(['data' => $data, 'success' => true]);
            } else {
                return response()->json(['success' => false, 'message' => 'Failed to save payment details.']);
            }
        }
    }
}
