<?php
namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders;
use App\Models\Product;
use App\Models\Producttype;
use App\Models\Currency;
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
use App\Models\Firewall;
use App\Models\Switchs;
use App\Models\Licenses;
use App\Models\Acronis;
use App\Models\TsPlus;
use App\Models\Antivirus;
use Auth;
use DB;
use Session;



class UserServicesController extends Controller
{
    public function getServicesIdWise($id)
    {
      $orderByServices = Orders::join('product_news','orders.product_id','product_news.id')
      ->join('categories','orders.productCategoryId','categories.id')
      ->join('invoices','invoices.id','orders.invoice_id')
      ->join('currencies','currencies.id','orders.currency')
      ->select('categories.category_name','orders.created_at','currencies.code','currencies.prefix','invoices.final_total_amt','orders.order_status','orders.amount','orders.id','orders.total_amt','product_news.product_name as prod_name')
      ->where('orders.productCategoryId',$id)
      ->where('orders.user_id',Auth::user()->id)
      ->get();
      
      return view('user.services.home',compact('orderByServices'));             
    }

    public function cancelSubscription(Request $request,$id) {
      $category_id =$request->category_id;
        $categories = [
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

        $serviceData = null;
        if (isset($categories[$category_id])) {
            $serviceData = $categories[$category_id]::find($id);
        }

        if ($serviceData) {
            $serviceData->status = 4;
            $serviceData->save();
        }

        return response()->json(['status' => 'success', 'success' => true]);
    }

}
