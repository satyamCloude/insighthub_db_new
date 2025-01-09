<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Jenssegers\Agent\Agent;
use App\Models\SpecialOffers;
use App\Models\Project;
use App\Models\Ticket;
use App\Models\OsOrder;
use App\Models\ProductNew;
use App\Models\Attendence;
use App\Models\InvoiceSettings;
use App\Models\CompanyLogin;
use App\Models\Category;
use App\Models\User;
use App\Models\OperatingSysten;
use App\Models\ClientDetail;
use App\Models\DedicatedServer;
use App\Models\CloudHosting;
use App\Models\CloudServices;
use App\Models\OSCategory;
use App\Models\Currency;
use App\Models\BareMetal;
use App\Models\Invoice;
use App\Models\HostingControlPanel;
use App\Models\OrderToProduct;
use App\Models\Template;
use App\Models\Orders;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Models\EmployeeDetail;
use App\Models\TimeShift;
use App\Models\AddonOrder;
use App\Models\Cart;
use App\Models\ProductAddOn;
use App\Models\ProductAddOnPrice;
use Illuminate\Support\Carbon; // Add this line to import Carbon
use Auth;
use Session;
use DB;
use App\Models\MailSettings;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeEmail; // Import your mail class
use App\Mail\ClientWelcomeEmail; // Import your mail class
use App\Models\Azure;
use App\Models\MicrosoftOffice365;
use App\Models\Antivirus;
use App\Models\TsPlus;
use App\Models\OneTimeSetup;
use App\Models\MonthelySetup;
use App\Models\GoogleWorkSpace;
use App\Models\AwsService;
use App\Models\Switchs;
use App\Models\Firewall;
use App\Models\Acronis;
use App\Models\Licenses;
use App\Models\SSLCertificate;
use Illuminate\Support\Facades\Log;



class UDashboardController extends Controller
{

   
    public function index()
    {
        $User = EmployeeDetail::select('shift_id')->where('user_id', Auth::user()->id)->first();
        $currency = Currency::where('is_default', 1)->first();
        $InProgress = Project::where('client_id', Auth::user()->id)->where('status_id', 1)->count();
        $Completed = Project::where('client_id', Auth::user()->id)->where('status_id', 2)->count();
        $OverDue = Project::where('client_id', Auth::user()->id)->where('status_id', 3)->count();
        $Cancel = Project::where('client_id', Auth::user()->id)->where('status_id', 4)->count();
        $DueInvoicesCount = Invoice::where('client_id', Auth::user()->id)->where('is_payment_recieved', 0)->count();
        $PaidInvoicesCount = Invoice::where('client_id', Auth::user()->id)->where('is_payment_recieved', 1)->count();
            $default_currency = Currency::where('is_default', 1)->first();

            $InVls = Orders::
            leftJoin('product_news', 'product_news.id', 'orders.product_id')
            ->where('orders.is_payment_recieved', 1)
            ->where('orders.user_id', Auth::user()->id)
            ->select('orders.*', 'product_news.category_id', 'product_news.product_name')
            // ->orderBy('created_at', 'desc')
            ->get();

        $services  = [];
        $product_data = [];
        
        foreach ($InVls as $orders) {
        $findProduct = ProductNew::find($orders->product_id);

        if($orders->category_id === 4){
            $product_data[]= BareMetal::leftjoin('product_news','product_news.id','bare_metals.product_id')->where('product_id',$orders->product_id)->select('bare_metals.*','product_news.product_name','product_news.category_id')->where('customer_id',Auth::user()->id)->latest()->first();
            }if ($orders->category_id === 5) {
                    $product_data[]=  CloudHosting::leftjoin('product_news','product_news.id','cloud_hostings.product_id')->where('product_id',$orders->product_id)->select('cloud_hostings.*','product_news.product_name','product_news.category_id')->where('customer_id',Auth::user()->id)->latest()->first();
            }if ($orders->category_id === 6) {
                    $product_data[]=  CloudServices::leftjoin('product_news','product_news.id','cloud_services.product_id')->where('product_id',$orders->product_id)->select('cloud_services.*','product_news.product_name','product_news.category_id')->where('customer_id',Auth::user()->id)->latest()->first();
            }if ($orders->category_id === 7) {
                    $product_data[]=  DedicatedServer::leftjoin('product_news','product_news.id','dedicated_servers.product_id')->where('product_id',$orders->product_id)->select('dedicated_servers.*','product_news.product_name','product_news.category_id')->where('customer_id',Auth::user()->id)->latest()->first();
            }if ($orders->category_id === 8) {
                    $product_data[]=  AwsService::leftjoin('product_news','product_news.id','aws_services.product_id')->where('product_id',$orders->product_id)->select('aws_services.*','product_news.product_name','product_news.category_id')->where('customer_id',Auth::user()->id)->latest()->first();
            }if ($orders->category_id === 9) {
                    $product_data[]=  Azure::leftjoin('product_news','product_news.id','azures.product_id')->where('product_id',$orders->product_id)->select('azures.*','product_news.product_name','product_news.category_id')->where('customer_id',Auth::user()->id)->latest()->first();
            }if ($orders->category_id === 10) {
                    $product_data[]=  GoogleWorkSpace::leftjoin('product_news','product_news.id','google_work_spaces.product_id')->where('product_id',$orders->product_id)->select('google_work_spaces.*','product_news.product_name','product_news.category_id')->where('customer_id',Auth::user()->id)->latest()->first();
            }if ($orders->category_id === 11) {
                    $product_data[]=  MicrosoftOffice365::leftjoin('product_news','product_news.id','microsoft_office365s.product_id')->where('product_id',$orders->product_id)->select('microsoft_office365s.*','product_news.product_name','product_news.category_id')->where('customer_id',Auth::user()->id)->latest()->first();
            }if ($orders->category_id === 12) {
                    $product_data[]=  OneTimeSetup::leftjoin('product_news','product_news.id','one_time_setups.product_id')->where('product_id',$orders->product_id)->select('one_time_setups.*','product_news.product_name','product_news.category_id')->where('customer_id',Auth::user()->id)->latest()->first();
            }if ($orders->category_id === 13) {
                    $product_data[]=  MonthelySetup::leftjoin('product_news','product_news.id','monthely_setups.product_id')->where('product_id',$orders->product_id)->select('monthely_setups.*','product_news.product_name','product_news.category_id')->where('customer_id',Auth::user()->id)->latest()->first();
            }if ($orders->category_id === 14) {
                    $product_data[]=  SSLCertificate::leftjoin('product_news','product_news.id','s_s_l_certificates.product_id')->where('product_id',$orders->product_id)->select('s_s_l_certificates.*','product_news.product_name','product_news.category_id')->where('customer_id',Auth::user()->id)->latest()->first();
            }if ($orders->category_id === 15) {
                    $product_data[]=  Antivirus::leftjoin('product_news','product_news.id','antiviri.product_id')->where('product_id',$orders->product_id)->select('antiviri.*','product_news.product_name','product_news.category_id')->where('customer_id',Auth::user()->id)->latest()->first();
            }if ($orders->category_id === 16) {
                    $product_data[]=  Licenses::leftjoin('product_news','product_news.id','licenses.product_id')->where('product_id',$orders->product_id)->select('licenses.*','product_news.product_name','product_news.category_id')->where('customer_id',Auth::user()->id)->latest()->first();
            }if ($orders->category_id === 17) {
                    $product_data[]=  Acronis::leftjoin('product_news','product_news.id','acronis.product_id')->where('product_id',$orders->product_id)->select('acronis.*','product_news.product_name','product_news.category_id')->where('customer_id',Auth::user()->id)->latest()->first();
            }if ($orders->category_id === 18) {
                    $product_data[]=  TsPlus::leftjoin('product_news','product_news.id','ts_pluses.product_id')->where('product_id',$orders->product_id)->select('ts_pluses.*','product_news.product_name','product_news.category_id')->where('customer_id',Auth::user()->id)->latest()->first();
            }if ($orders->category_id === 25) {
                    $product_data[]=  Switchs::leftjoin('product_news','product_news.id','switchs.product_id')->where('product_id',$orders->product_id)->select('switchs.*','product_news.product_name','product_news.category_id')->where('customer_id',Auth::user()->id)->latest()->first();
            }if ($orders->category_id === 26) {
                    $product_data[]=  Firewall::leftjoin('product_news','product_news.id','firewalls.product_id')->where('product_id',$orders->product_id)->select('firewalls.*','product_news.product_name','product_news.category_id')->where('customer_id',Auth::user()->id)->latest()->first();
            }
        }

        usort($product_data, function ($a, $b) {
            if ($a === null || $b === null) {
                return 0; // Return 0 to maintain current order if either $a or $b is null
            }
            return strtotime($b->created_at) - strtotime($a->created_at);
        });
        $product_data = array_filter($product_data);
        $product_data = array_slice($product_data, 0, 5);
        $getData = User::find(Auth::user()->accountManager);
        $ticket = Ticket::with('chat.client')->where('client_id', Auth::user()->id)->latest()->first();
        $UPInvoices = Invoice::where('client_id', Auth::user()->id)->where('is_payment_recieved', 0)->get();
        $SpecialOffers = SpecialOffers::get();
        $SpecialOffersactive = SpecialOffers::latest()->first();
        return view('user.dashboard.index', compact('InProgress','currency', 'Completed','product_data', 'DueInvoicesCount', 'OverDue', 'Cancel', 'PaidInvoicesCount','InVls', 'getData', 'ticket','UPInvoices','services','default_currency','SpecialOffers','SpecialOffersactive'));
    }
   
    public function getRelatedData(Request $request, $id)
    {
        $user_id = ClientDetail::where('user_id', Auth::user()->id)->select('company_id')->first();
        $category = Category::find($id);
        $currency = Currency::where('is_default', 1)->first();
        if ($currency && $currency->code == 'INR') {

           $products = ProductNew::join('product_pricing', 'product_pricing.product_id', '=', 'product_news.id')
                ->leftJoin('currencies', 'currencies.id', '=', 'product_pricing.currency_id')
                ->leftJoin('categories', 'categories.id', '=', 'product_news.category_id')
                ->where('product_news.category_id', $id)
                ->whereNull('product_news.deleted_at')
                ->where('product_pricing.currency_id', $currency->id);
            
            // Subquery to filter products based on plan_type
            $products->where(function ($query) {
                $query->where('product_pricing.plan_type', '!=', 1)
                      ->orWhereNull('product_pricing.plan_type');
            });
            
            

            $products = $products->select('product_news.*', 'product_pricing.price', 'product_pricing.plan_type', 'product_pricing.product_plan', 'product_pricing.product_id as product_id')
                ->get();
            



        } else if ($currency && $currency->code == 'USD') {

            $products = ProductNew::leftJoin('product_pricing', 'product_pricing.product_id', '=', 'product_news.id')
                ->leftJoin('currencies', 'currencies.id', '=', 'product_pricing.currency_id')
                ->leftJoin('categories', 'categories.id', '=', 'product_news.category_id')
                ->where('product_news.category_id', $id)
                ->where('product_pricing.currency_id', 2)
                ->whereNull('product_news.deleted_at')
                ->select('product_news.*', 'product_pricing.price', 'product_pricing.product_plan', 'product_pricing.product_id as product_id')
                ->get();
        } else if ($currency && $currency->code == 'Unr') {

            $products = ProductNew::leftJoin('product_pricing', 'product_pricing.product_id', '=', 'product_news.id')
                ->leftJoin('currencies', 'currencies.id', '=', 'product_pricing.currency_id')
                ->leftJoin('categories', 'categories.id', '=', 'product_news.category_id')
                ->where('product_news.category_id', $id)
                ->whereNull('product_news.deleted_at')
                ->where('product_pricing.currency_id', 5)
                // ->groupBy('product_pricing.product_plan')
            ->select('product_news.*', 'product_pricing.price','product_pricing.plan_type', 'product_pricing.product_plan', 'product_pricing.product_id as product_id')
             ->get();
        } else {
             $products = ProductNew::leftjoin('product_pricing', 'product_pricing.product_id', '=', 'product_news.id')
            ->leftJoin('currencies', 'currencies.id', '=', 'product_pricing.currency_id')
            ->leftJoin('categories', 'categories.id', '=', 'product_news.category_id')
            ->where('product_news.category_id', $id)
            ->whereNull('product_news.deleted_at')
            ->where('product_pricing.currency_id', $currency->id) // 1 for INR
        //   ->groupBy('product_pricing.product_plan')
            ->select('product_news.*', 'product_pricing.price','product_pricing.plan_type', 'product_pricing.product_plan', 'product_pricing.product_id as product_id')
            ->get();

        }
        // return $products;
        // echo "<pre>"; print_r($products); exit;

        $AllCurrencys = Currency::get();

        return view('user.Product.home', compact('currency', 'products', 'AllCurrencys', 'id', 'category'));
    }

    public function add_to_cart(Request $request)
    {
        $product_id = $request->pid;

        $currency = $request->currency;
        $default_currency = Currency::where('is_default', 1)->first();
        $all_currency = Currency::get();

        $client=ClientDetail::where('user_id',Auth::user()->id)->first();
        // return $client;
        $hosting_control_panels = HostingControlPanel::get();
        $products = ProductNew::leftjoin('product_pricing', 'product_pricing.product_id', 'product_news.id')
            ->leftjoin('tax_settings', 'tax_settings.id','product_news.tax_id')
            ->leftjoin('currencies', 'currencies.id', 'product_pricing.currency_id')
            ->leftjoin('categories', 'categories.id', 'product_news.category_id')
            ->where('product_news.id', $product_id)
            ->select('product_news.*', 'product_pricing.price', 'tax_settings.tax_name as tax_name', 'tax_settings.rate as tax_percent', 'product_pricing.product_plan', 'product_pricing.product_id as product_id')
            ->first();
        $operating_systems = OperatingSysten::leftjoin('o_s_categories','o_s_categories.os_id','operating_systens.id')
            ->leftjoin('currencies', 'currencies.id', 'o_s_categories.currency_id')
        ->where('category_id',$products->category_id)
        ->where('o_s_categories.currency_id',$default_currency->id)
        ->select('operating_systens.*','o_s_categories.price','currencies.prefix','currencies.code')
        ->get();

        // return $operating_systems;

            $addOnProducts=ProductAddOn::where('product_id',$product_id)->first();
            if($addOnProducts){

            $addOnProducts = ProductNew::leftJoin('product_pricing', 'product_pricing.product_id', 'product_news.id')
                ->whereIn('product_news.id', explode(',',$addOnProducts->addon_id))
                ->where('product_pricing.currency_id', $currency)
                ->select('product_news.*', 'product_pricing.price')
                ->groupBy('product_news.id')
                ->get();
            }

            $order = Orders::where('orders.user_id', Auth::id())
            ->where('orders.is_payment_recieved', 0)
            ->first();
        $BillingCycles = ProductNew::leftJoin('product_pricing', 'product_pricing.product_id', '=', 'product_news.id')
            ->where('product_pricing.product_id', $product_id)
            ->where('product_pricing.currency_id', $currency)
            ->whereNull('product_pricing.deleted_at')
            ->select('product_pricing.*', 'product_news.payment_type')
            ->groupBy('plan_type')
            ->get();
            

            
        return view('user.Product.create', compact('currency', 'products', 'default_currency', 'hosting_control_panels', 'product_id', 'all_currency', 'operating_systems', 'addOnProducts', 'BillingCycles','order','client'));
    }


    public function varifyEmail(Request $request)
    {
        $userId = $request->input('user');
        $user = User::find($userId);
        if (!$user) {
            return redirect('/')->with('error', 'User not found');
        }
        return view('user.Google.varifyEmails', compact('user'));

        // return redirect()->route('home')->with('success', 'Email verified successfully');
    }

    public function ClockStatusUpdate(Request $request)
    {
        try {
            $currentDate = date('Y-m-d');
            $currentTime = date('H:i:s');

            $user = User::find($request->id);

            if (!$user) {
                return response()->json(['status' => 404, 'success' => false, 'message' => 'User not found']);
            }

            $user->clock_status = $user->clock_status == 1 ? 0 : 1;
            $user->save();

            if ($request->value == 'clockin') {
                $attendance = new Attendence;
                $attendance->emp_Id = Auth::user()->id;
                $attendance->punch_date = $currentDate;
                $attendance->punch_in = $currentTime;
                $attendance->save();
            } elseif ($request->value == 'clockout') {
                $attendance = Attendence::where('emp_Id', Auth::user()->id)
                    ->where('punch_date', $currentDate)
                    ->whereNull('punch_out')
                    ->first();

                if ($attendance) {
                    $attendance->punch_out = $currentTime;
                    $attendance->save();
                } else {
                    return response()->json(['status' => 400, 'success' => false, 'message' => 'Clock-out record not found']);
                }
            }

            return response()->json(['status' => 200, 'success' => true, 'data' => $user]);
        } catch (\Exception $e) {
            return response()->json(['status' => 500, 'success' => false, 'message' => $e->getMessage()]);
        }
    } 

    public function getServiceData(Request $request)
    {
        $OrderId = $request->OrderId;
        $orders = Orders::find($OrderId);
        $findProduct = ProductNew::find($orders->product_id);
        $findCat = Category::find($findProduct->category_id);
        if($findProduct->category_id === 4){
            $product_data = BareMetal::where('product_id',$orders->product_id)->where('customer_id',Auth::user()->id)->first();
        }elseif ($findProduct->category_id === 5) {
            $product_data = CloudHosting::where('product_id',$orders->product_id)->where('customer_id',Auth::user()->id)->first();
        }elseif ($findProduct->category_id === 6) {
            $product_data = CloudServices::where('product_id',$orders->product_id)->where('customer_id',Auth::user()->id)->first();
        }elseif ($findProduct->category_id === 7) {
            $product_data = DedicatedServer::where('product_id',$orders->product_id)->where('customer_id',Auth::user()->id)->first();
        }elseif ($findProduct->category_id === 8) {
            $product_data = AwsService::where('product_id',$orders->product_id)->where('customer_id',Auth::user()->id)->first();
        }elseif ($findProduct->category_id === 9) {
           $product_data = Azure::where('product_id',$orders->product_id)->where('customer_id',Auth::user()->id)->first(); 
        }elseif ($findProduct->category_id === 10) {
           $product_data = GoogleWorkSpace::where('product_id',$orders->product_id)->where('customer_id',Auth::user()->id)->first();  
        }elseif ($findProduct->category_id === 11) {
           $product_data = MicrosoftOffice365::where('product_id',$orders->product_id)->where('customer_id',Auth::user()->id)->first();  
        }elseif ($findProduct->category_id === 12) {
           $product_data = OneTimeSetup::where('product_id',$orders->product_id)->where('customer_id',Auth::user()->id)->first();   
        }elseif ($findProduct->category_id === 13) {
            $product_data = MonthelySetup::where('product_id',$orders->product_id)->where('customer_id',Auth::user()->id)->first();  
        }elseif ($findProduct->category_id === 14) {
           $product_data = SSLCertificate::where('product_id',$orders->product_id)->where('customer_id',Auth::user()->id)->first();  
        }elseif ($findProduct->category_id === 15) {
          $product_data = Antivirus::where('product_id',$orders->product_id)->where('customer_id',Auth::user()->id)->first();     
        }elseif ($findProduct->category_id === 16) {
            $product_data = Licenses::where('product_id',$orders->product_id)->where('customer_id',Auth::user()->id)->first();     
        }elseif ($findProduct->category_id === 17) {
            $product_data = Acronis::where('product_id',$orders->product_id)->where('customer_id',Auth::user()->id)->first();     
        }elseif ($findProduct->category_id === 18) {
            $product_data = TsPlus::where('product_id',$orders->product_id)->where('customer_id',Auth::user()->id)->first();     
        }elseif ($orders->category_id === 25) {
            $product_data[]=  Switchs::where('product_id',$orders->product_id)->where('customer_id',Auth::user()->id)->first();
        }elseif ($orders->category_id === 26) {
            $product_data[]=  Firewall::where('product_id',$orders->product_id)->where('customer_id',Auth::user()->id)->first();
        }else{
            $product_data = BareMetal::where('product_id',$orders->product_id)->where('customer_id',Auth::user()->id)->first();
        }
        /*
             $orders = Orders::
                    leftJoin('product_news','product_news.id','orders.product_id')
                    ->select('orders.*','product_news.product_name')
                    find($OrderId);
        */
        $data['product_data'] = $product_data;
        $data['order_data'] = $findProduct;
        if($product_data){
            return response()->json(['status' => 200, 'success' => true, 'data' => $data]);
        }else{
            return response()->json(['status' => 500, 'success' => false, 'message' =>'Failed']);
        }
    }

    
    public function submit_cart_order(Request $request)
    {
        $user = auth()->user();
        $order = Orders::where('user_id', Auth::user()->id)->where('is_payment_recieved', 0)->first();
        if (!$order) {
            $newOrder = new Orders();
            $newOrder->taxes = $request->tax_id;
            $newOrder->amount = $request->price;
            $newOrder->product_id = $request->product_id;
            $newOrder->currency = $request->currency_id;
            $newOrder->billing_cycle = $request->billingcycle;
            $newOrder->hostname = $request->hostname;
            $newOrder->os_id = $request->os_id;
            $newOrder->total_amt = $request->total_amt;
            $newOrder->issue_date = now();
            $newOrder->user_id = Auth::user()->id;
            
            $newOrder->save();

            if (isset($request->addon_ids)) {
                
                foreach ($request->addon_ids as $key => $value) {
                    $orderAddon = new AddonOrder;
                    $orderAddon->user_id = $user->id;
                    $orderAddon->order_Id = $newOrder->id;
                    $orderAddon->addon_id = $value;
                    $orderAddon->tax = $request->tax_id;
                    $orderAddon->save();
                }
            }
             if (isset($request->os_id)) {
              
                    $orderAddon = new OsOrder;
                    $orderAddon->user_id = $user->id;
                    $orderAddon->order_Id = $newOrder->id;
                    $orderAddon->os_id = $request->os_id;
                    $orderAddon->tax = $request->tax_id;
                    $orderAddon->save();
            }
        } else {
            $getCategory = ProductNew::find($order->product_id);
            $os_price = OSCategory::leftjoin('operating_systens','operating_systens.id','o_s_categories.os_id')
            ->where('o_s_categories.os_id',$order->os_id)->where('o_s_categories.category_id',$getCategory->category_id)->select('o_s_categories.*','operating_systens.ostype')->first();
                Session::put('order_id',$order->id);
            AddonOrder::where('order_Id', $order->id)->delete();
            $OsOrder= OsOrder::where('order_Id', $order->id)->first();
            if($OsOrder){
                OsOrder::where('order_Id', $order->id)->delete();
            }
            $order->total_amt = $request->total_amt;
            $order->product_id = $request->product_id;
            $order->taxes = $request->tax_id;
            $order->amount = $request->price;
            $order->currency = $request->currency_id;
            $order->billing_cycle = $request->billingcycle;
            $order->hostname = $request->hostname;
            $order->os_id = $request->os_id;
            // return $order;
            // $order->issue_date = now();
            $order->save();
            if (isset($request->addon_ids)) {

                foreach ($request->addon_ids as $key => $value) {
                    $orderAddon = new AddonOrder;
                    $orderAddon->user_id = $user->id;
                    $orderAddon->order_Id = $order->id;
                    $orderAddon->addon_id = $value;
                    $orderAddon->tax = $request->tax_id;
                    $orderAddon->save();
                   
                }
            }
              if (isset($request->os_id)) {

                 $orderAddon = new OsOrder;
                    $orderAddon->user_id = $user->id;
                    $orderAddon->order_Id = $order->id;
                    $orderAddon->os_id = $request->os_id;
                    $orderAddon->tax = $request->tax_id;
                    $orderAddon->save();
            }

        }

        return redirect('user/order/cart');
    }


    public function resend_varification_email($email, $id)
    {

        $existingUser = User::where('id', $id)->first();

        if ($existingUser) {

            $verificationToken = Str::random(32); // Adjust the length of the token as needed
            $existingUser->verification_token = $verificationToken;
            $existingUser->save();

            $CompanyLogin = new CompanyLogin;
            $CompanyLogin->user_id = $existingUser->id;
            $CompanyLogin->company_name = '';
            $CompanyLogin->save();

            $ClientDetail = new ClientDetail;
            $ClientDetail->user_id = $existingUser->id;
            $ClientDetail->company_id = $CompanyLogin->id;
            $ClientDetail->save();

            $verificationLink = route('verify.email', ['user' => $existingUser->id, 'email' => $existingUser->email, 'token' => $verificationToken]);
            $message = "To finish creating your cloudtechtiq account, confirm your email address by clicking this link: $verificationLink\nHappy coding,\nTeam cloudtechtiq";

            $msgs = wordwrap($message, 70);


            $TemplateSettings1 = Template::where('name', 'Email Verification')->first();
           
            $subject1 =  $TemplateSettings1->subject;
            $header1 = $TemplateSettings1->header;
            $template1 = $TemplateSettings1->template;
            $footer1 = $TemplateSettings1->footer;

            $replacementsTemplate1 = array(
                '{$client_name}' => $existingUser->first_name,
                '[Your Company Name]' => 'CloudTechtiq',
                '[Verification Link]' => $msgs,
            );
            $messageReplacementsTemplate1 = $template1;
            $template1 = str_replace(array_keys($replacementsTemplate1), array_values($replacementsTemplate1), $messageReplacementsTemplate1);

            $replacementsFooter1 = array(
                '[Company Name]' => 'CloudTechtiq',
            );
            $messagefooter1 = $footer1;
            $footer1 = str_replace(array_keys($replacementsFooter1), array_values($replacementsFooter1), $messagefooter1);
            // \Mail::to($existingUser->email)->send(new ClientWelcomeEmail($subject1, $header1, $template1, $footer1));
            try {
                \Mail::to($existingUser->email)->send(new ClientWelcomeEmail($subject1, $header1, $template1, $footer1));
            } catch (\Exception $e) {
                Log::error('Failed to send email to ' . $existingUser->email . ': ' . $e->getMessage());
                return redirect('/')->with('message', 'Successfully registered, but the email could not be sent.');
            }
  
            return redirect()->route('google.varify_email', ['user' => $existingUser->id])->with('success', 'Google login done');
        } else {
            return redirect('/')->with('message', 'Something Went Wrong.');
        }
    }
    
    public function getBillingCycles($currencyId,$product_id)
    {
        $product = ProductNew::find($product_id);
        
        $BillingCycles = ProductNew::leftJoin('product_pricing', 'product_pricing.product_id', '=', 'product_news.id')
            ->leftJoin('currencies', 'currencies.id','product_pricing.currency_id')
            ->where('product_pricing.product_id', $product_id)
            ->where('product_pricing.currency_id', $currencyId)
            ->whereNull('product_pricing.deleted_at')
            ->select('product_pricing.*', 'product_news.payment_type', 'currencies.prefix', 'currencies.code')
            ->groupBy('plan_type')
            ->get();

        $data['billingCycle'] = view('user.Product.billing_cycle', compact('BillingCycles'))->render();
        $operating_systems = [];
        $addOnProducts = [];
        $addOnProducts = ProductAddOn::where('product_id',$product_id)->first();
        if($addOnProducts){

        $addOnProducts = ProductNew::leftJoin('product_pricing', 'product_pricing.product_id', 'product_news.id')
            ->leftJoin('tax_settings', 'tax_settings.id', 'product_news.tax_id')
            ->leftJoin('currencies', 'currencies.id','product_pricing.currency_id')
            ->whereIn('product_news.id', explode(',',$addOnProducts->addon_id))
            ->where('product_pricing.currency_id', $currencyId)
            ->select('product_news.*', 'product_pricing.price', 'tax_settings.tax_name', 'tax_settings.rate', 'currencies.prefix', 'currencies.code')
            ->groupBy('product_news.id')
            ->get();
                    $data['addons'] = view('user.Product.addons', compact('addOnProducts'))->render();

        }


        $operating_systems = OperatingSysten::leftjoin('o_s_categories','o_s_categories.os_id','operating_systens.id')
        ->leftJoin('currencies', 'currencies.id','o_s_categories.currency_id')
        ->where('category_id',$product->category_id)
        ->where('o_s_categories.currency_id',$currencyId)
        ->select('operating_systens.*','o_s_categories.price','currencies.prefix','currencies.code')
        ->get();
        if($operating_systems){

        $data['os'] = view('user.Product.os', compact('operating_systems'))->render();
        }
        
        return response()->json($data);
    }
    
}
