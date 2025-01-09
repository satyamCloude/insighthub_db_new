<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use App\Models\PaymentMethod;
use App\Models\Producttype;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductNew;
use App\Models\Currency;
use App\Models\TaxSetting;
use App\Models\ProductAddOn;
use App\Models\ProductAddOnPrice;
use App\Models\ProductPricing;
use App\Models\User;
use Hash;
use Auth;


class ProductController extends Controller
{
    //home page
    public function home()
    {
        $Category = Category::orderBy('created_at', 'desc')->paginate(10);
        foreach ($Category as $key => $value) {
            $value->products = ProductNew::select('products.id', 'products.product_name', 'producttypes.name')->where('category_id', $value->id)->join('producttypes', 'producttypes.id', 'products.product_type_id')->get();
        }
        return view('admin.settings.Product.home', compact('Category'));
    }
 



    //home page
    public function Create(Request $request)
    {
        echo "12";
        exit;
        $Productype = Producttype::get();
        $Category = Category::get();
        $PaymentMethod = PaymentMethod::get();
        $TaxSettings = TaxSetting::get();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Product Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Product/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('admin.settings.Product.create', compact('Productype', 'Category', 'PaymentMethod', 'TaxSettings'));
    }


    //home page
    //home page
public function store(Request $req)
{
    $url = url('/') . '/public/images/';

    $data = $req->all();
    if ($req->display_on_frontend == 'on') {
        $data['display_on_frontend'] = 1;
    } else {
        $data['display_on_frontend'] = 0;
    }

    $product_imagename = 'product_image.jpg';
    if ($req->hasFile('product_image')) {
        $rand = Str::random(4);
        $file = $req->file('product_image');
        $extension = $file->getClientOriginalExtension();
        $product_imagename = 'Prod_img_' . $rand . '.' . $extension;
        $file->move('public/images/', $product_imagename);
    }
    $data['product_image'] = $url . $product_imagename;
    $data['payment_method'] = json_encode($req->payment_method);
    $newProduct = ProductNew::create($data);
              if ($req->payment_type == 1) {
            
                       
                            $onetime_usd = new ProductPricing;
                            $onetime_usd->product_id = $newProduct->id;
                            $onetime_usd->product_plan = 1;
                            $onetime_usd->currency_id = 2;
                            $onetime_usd->price = '0.00';
                            $onetime_usd->save();
                        
        }  if ($req->payment_type == 2) {

            if ($req->onetime_inr) {
                $onetime_inr = new ProductPricing;
                $onetime_inr->product_id = $newProduct->id;
                $onetime_inr->product_plan = 1;
                $onetime_inr->currency_id = 1;
                $onetime_inr->price = $req->onetime_inr;
                $onetime_inr->save();
            }
            if ($req->onetime_usd) {
                $onetime_usd = new ProductPricing;
                $onetime_usd->product_id = $newProduct->id;
                $onetime_usd->product_plan = 1;
                $onetime_usd->currency_id = 2;
                $onetime_usd->price = $req->onetime_usd;
                $onetime_usd->save();
            }
        }
        if ($req->payment_type == 3) {

            if ($req->recurr_inr_hourly) {
                $recurr_inr_hourly = new ProductPricing;
                $recurr_inr_hourly->product_id = $newProduct->id;
                $recurr_inr_hourly->product_plan = 3;
                $recurr_inr_hourly->currency_id = 1;
                $recurr_inr_hourly->price = $req->recurr_inr_hourly;
                $recurr_inr_hourly->save();
            }
            if ($req->recurr_inr_monthly) {
                $recurr_inr_monthly = new ProductPricing;
                $recurr_inr_monthly->product_id = $newProduct->id;
                $recurr_inr_monthly->product_plan = 4;
                $recurr_inr_monthly->currency_id = 1;
                $recurr_inr_monthly->price = $req->recurr_inr_monthly;
                $recurr_inr_monthly->save();
            }
            if ($req->recurr_inr_quartely) {
                $recurr_inr_quartely = new ProductPricing;
                $recurr_inr_quartely->product_id = $newProduct->id;
                $recurr_inr_quartely->product_plan = 5;
                $recurr_inr_quartely->currency_id = 1;
                $recurr_inr_quartely->price = $req->recurr_inr_quartely;
                $recurr_inr_quartely->save();
            }
            if ($req->recurr_inr_semiannually) {
                $recurr_inr_semiannually = new ProductPricing;
                $recurr_inr_semiannually->product_id = $newProduct->id;
                $recurr_inr_semiannually->product_plan = 6;
                $recurr_inr_semiannually->currency_id = 1;
                $recurr_inr_semiannually->price = $req->recurr_inr_semiannually;
                $recurr_inr_semiannually->save();
            }
            if ($req->recurr_inr_annually) {
                $recurr_inr_annually = new ProductPricing;
                $recurr_inr_annually->product_id = $newProduct->id;
                $recurr_inr_annually->product_plan = 7;
                $recurr_inr_annually->currency_id = 1;
                $recurr_inr_annually->price = $req->recurr_inr_annually;
                $recurr_inr_annually->save();
            }
            if ($req->recurr_inr_biennially) {
                $recurr_inr_biennially = new ProductPricing;
                $recurr_inr_biennially->product_id = $newProduct->id;
                $recurr_inr_biennially->product_plan = 8;
                $recurr_inr_biennially->currency_id = 1;
                $recurr_inr_biennially->price = $req->recurr_inr_biennially;
                $recurr_inr_biennially->save();
            }
            if ($req->recurr_inr_triennially) {
                $recurr_inr_triennially = new ProductPricing;
                $recurr_inr_triennially->product_id = $newProduct->id;
                $recurr_inr_triennially->product_plan = 9;
                $recurr_inr_triennially->currency_id = 1;
                $recurr_inr_triennially->price = $req->recurr_inr_triennially;
                $recurr_inr_triennially->save();
            }
            if ($req->recurr_usd_hourly) {
                $recurr_usd_hourly = new ProductPricing;
                $recurr_usd_hourly->product_id = $newProduct->id;
                $recurr_usd_hourly->product_plan = 10;
                $recurr_usd_hourly->currency_id = 2;
                $recurr_usd_hourly->price = $req->recurr_usd_hourly;
                $recurr_usd_hourly->save();
            }
            if ($req->recurr_usd_monthly) {
                $recurr_usd_monthly = new ProductPricing;
                $recurr_usd_monthly->product_id = $newProduct->id;
                $recurr_usd_monthly->product_plan = 11;
                $recurr_usd_monthly->currency_id = 2;
                $recurr_usd_monthly->price = $req->recurr_usd_monthly;
                $recurr_usd_monthly->save();
            }
            if ($req->recurr_usd_quartely) {
                $recurr_usd_quartely = new ProductPricing;
                $recurr_usd_quartely->product_id = $newProduct->id;
                $recurr_usd_quartely->product_plan = 12;
                $recurr_usd_quartely->currency_id = 2;
                $recurr_usd_quartely->price = $req->recurr_usd_quartely;
                $recurr_usd_quartely->save();
            }
            if ($req->recurr_usd_semiannually) {
                $recurr_usd_semiannually = new ProductPricing;
                $recurr_usd_semiannually->product_id = $newProduct->id;
                $recurr_usd_semiannually->product_plan = 13;
                $recurr_usd_semiannually->currency_id = 2;
                $recurr_usd_semiannually->price = $req->recurr_usd_semiannually;
                $recurr_usd_semiannually->save();
            }
            if ($req->recurr_usd_annually) {
                $recurr_usd_annually = new ProductPricing;
                $recurr_usd_annually->product_id = $newProduct->id;
                $recurr_usd_annually->product_plan = 14;
                $recurr_usd_annually->currency_id = 2;
                $recurr_usd_annually->price = $req->recurr_usd_annually;
                $recurr_usd_annually->save();
            }
            if ($req->recurr_usd_biennially) {
                $recurr_usd_biennially = new ProductPricing;
                $recurr_usd_biennially->product_id = $newProduct->id;
                $recurr_usd_biennially->product_plan = 15;
                $recurr_usd_biennially->currency_id = 2;
                $recurr_usd_biennially->price = $req->recurr_usd_biennially;
                $recurr_usd_biennially->save();
            }
            if ($req->recurr_usd_triennially) {
                $recurr_usd_triennially = new ProductPricing;
                $recurr_usd_triennially->product_id = $newProduct->id;
                $recurr_usd_triennially->product_plan = 16;
                $recurr_usd_triennially->currency_id = 2;
                $recurr_usd_triennially->price = $req->recurr_usd_triennially;
                $recurr_usd_triennially->save();
            }
        }

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Product Data Store By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Product/store';
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect()->back()->with('success', "New Product Added Successfully");
    }

    

    //edit
    public function edit(Request $req, $id)
    {
        $Product = ProductNew::find($id);
        $Products = ProductNew::get();
        if ($Product) {
            $Product->pricing = ProductPricing::where('product_id', $Product->id)->get();
        }
        // echo "<pre>"; print_r($Product); exit;
        $Productype = Producttype::get();
        $Category = Category::get();
        $PaymentMethod = PaymentMethod::get();
        $TaxSettings = TaxSetting::get();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Product Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Product/edit/' . $id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('admin.settings.Product.edit', compact('Product', 'Productype', 'Category', 'PaymentMethod','Products','TaxSettings'));
    }

    //updated
    public function update(Request $req, $id)
    {

        $data = ProductNew::find($id);
        $reqData = $req->all();
        // return $reqData;
        ProductPricing::where('product_id', $id)->delete();

        // code...
        if ($req->payment_type == 1) {

           
                $onetime_usd = new ProductPricing;
                $onetime_usd->product_id = $id;
                $onetime_usd->product_plan = 1;
                $onetime_usd->currency_id = 1;
                $onetime_usd->price = '0.00';
                $onetime_usd->save();
          
        } if ($req->payment_type == 2) {

            if ($req->onetime_inr) {
                $onetime_inr = new ProductPricing;
                $onetime_inr->product_id = $id;
                $onetime_inr->product_plan = 1;
                $onetime_inr->currency_id = 1;
                $onetime_inr->price = $req->onetime_inr;
                $onetime_inr->save();
            }
            if ($req->onetime_usd) {
                $onetime_usd = new ProductPricing;
                $onetime_usd->product_id = $id;
                $onetime_usd->product_plan = 1;
                $onetime_usd->currency_id = 2;
                $onetime_usd->price = $req->onetime_usd;
                $onetime_usd->save();
            }
        }
        if ($req->payment_type == 3) {

            if ($req->recurr_inr_hourly) {
                $recurr_inr_hourly = new ProductPricing;
                $recurr_inr_hourly->product_id = $id;
                $recurr_inr_hourly->product_plan = 3;
                $recurr_inr_hourly->currency_id = 1;
                $recurr_inr_hourly->price = $req->recurr_inr_hourly;
                $recurr_inr_hourly->save();
            }
            if ($req->recurr_inr_monthly) {
                $recurr_inr_monthly = new ProductPricing;
                $recurr_inr_monthly->product_id = $id;
                $recurr_inr_monthly->product_plan = 4;
                $recurr_inr_monthly->currency_id = 1;
                $recurr_inr_monthly->price = $req->recurr_inr_monthly;
                $recurr_inr_monthly->save();
            }
            if ($req->recurr_inr_quarterly) {
                $recurr_inr_quartely = new ProductPricing;
                $recurr_inr_quartely->product_id = $id;
                $recurr_inr_quartely->product_plan = 5;
                $recurr_inr_quartely->currency_id = 1;
                $recurr_inr_quartely->price = $req->recurr_inr_quarterly;
                $recurr_inr_quartely->save();
            }
            if ($req->recurr_inr_semiannually) {
                $recurr_inr_semiannually = new ProductPricing;
                $recurr_inr_semiannually->product_id = $id;
                $recurr_inr_semiannually->product_plan = 6;
                $recurr_inr_semiannually->currency_id = 1;
                $recurr_inr_semiannually->price = $req->recurr_inr_semiannually;
                $recurr_inr_semiannually->save();
            }
            if ($req->recurr_inr_annually) {
                $recurr_inr_annually = new ProductPricing;
                $recurr_inr_annually->product_id = $id;
                $recurr_inr_annually->product_plan = 7;
                $recurr_inr_annually->currency_id = 1;
                $recurr_inr_annually->price = $req->recurr_inr_annually;
                $recurr_inr_annually->save();
            }
            if ($req->recurr_inr_biennially) {
                $recurr_inr_biennially = new ProductPricing;
                $recurr_inr_biennially->product_id = $id;
                $recurr_inr_biennially->product_plan = 8;
                $recurr_inr_biennially->currency_id = 1;
                $recurr_inr_biennially->price = $req->recurr_inr_biennially;
                $recurr_inr_biennially->save();
            }
            if ($req->recurr_inr_triennially) {
                $recurr_inr_triennially = new ProductPricing;
                $recurr_inr_triennially->product_id = $id;
                $recurr_inr_triennially->product_plan = 9;
                $recurr_inr_triennially->currency_id = 1;
                $recurr_inr_triennially->price = $req->recurr_inr_triennially;
                $recurr_inr_triennially->save();
            }
            if ($req->recurr_usd_hourly) {
                $recurr_usd_hourly = new ProductPricing;
                $recurr_usd_hourly->product_id = $id;
                $recurr_usd_hourly->product_plan = 10;
                $recurr_usd_hourly->currency_id = 2;
                $recurr_usd_hourly->price = $req->recurr_usd_hourly;
                $recurr_usd_hourly->save();
            }
            if ($req->recurr_usd_monthly) {
                $recurr_usd_monthly = new ProductPricing;
                $recurr_usd_monthly->product_id = $id;
                $recurr_usd_monthly->product_plan = 11;
                $recurr_usd_monthly->currency_id = 2;
                $recurr_usd_monthly->price = $req->recurr_usd_monthly;
                $recurr_usd_monthly->save();
            }
            if ($req->recurr_usd_quartely) {
                $recurr_usd_quartely = new ProductPricing;
                $recurr_usd_quartely->product_id = $id;
                $recurr_usd_quartely->product_plan = 12;
                $recurr_usd_quartely->currency_id = 2;
                $recurr_usd_quartely->price = $req->recurr_usd_quartely;
                $recurr_usd_quartely->save();
            }
            if ($req->recurr_usd_semiannually) {
                $recurr_usd_semiannually = new ProductPricing;
                $recurr_usd_semiannually->product_id = $id;
                $recurr_usd_semiannually->product_plan = 13;
                $recurr_usd_semiannually->currency_id = 2;
                $recurr_usd_semiannually->price = $req->recurr_usd_semiannually;
                $recurr_usd_semiannually->save();
            }
            if ($req->recurr_usd_annually) {
                $recurr_usd_annually = new ProductPricing;
                $recurr_usd_annually->product_id = $id;
                $recurr_usd_annually->product_plan = 14;
                $recurr_usd_annually->currency_id = 2;
                $recurr_usd_annually->price = $req->recurr_usd_annually;
                $recurr_usd_annually->save();
            }
            if ($req->recurr_usd_biennially) {
                $recurr_usd_biennially = new ProductPricing;
                $recurr_usd_biennially->product_id = $id;
                $recurr_usd_biennially->product_plan = 15;
                $recurr_usd_biennially->currency_id = 2;
                $recurr_usd_biennially->price = $req->recurr_usd_biennially;
                $recurr_usd_biennially->save();
            }
            if ($req->recurr_usd_triennially) {
                $recurr_usd_triennially = new ProductPricing;
                $recurr_usd_triennially->product_id = $id;
                $recurr_usd_triennially->product_plan = 16;
                $recurr_usd_triennially->currency_id = 2;
                $recurr_usd_triennially->price = $req->recurr_usd_triennially;
                $recurr_usd_triennially->save();
            }
        }

        if ($req->display_on_frontend == 'on') {
            $reqData['display_on_frontend'] = 1;
        } else {
            $reqData['display_on_frontend'] = 0;
        }
        if ($req->hasFile('product_image')) {
            $product_imageename = 'file_doc_' . Str::random(4) . '.' . $req->file('product_image')->getClientOriginalExtension();
            $req->file('product_image')->move('public/images/', $product_imageename);
            $reqData->product_image = url('/public/images/') . '/' . $product_imageename;
        }
        // return $data;

        $data->update($reqData);

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Product Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Product/update/' . $id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);


        return redirect()->back()->with('success', "Product Edited Successfully");
    }
    // delete Product
    public function delete(Request $request, $id)
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Product Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Product/delete/' . $id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        ProductNew::find($id)->delete();
        return redirect()->back()->with('success', "Product Deleted Successfully");
    }
    /////////PRODUCT ADD ON STORE
    public function storeAddOnProduct(Request $req)
    {
        // print_r($req->payment_type); exit;
        $i = 0;
        $payment_type_key = 0;
        $payment_type_key1 = 0;

        foreach ($req->product_name as $product_name) {

            $newProduct = new ProductAddOn;
            $newProduct->user_id = Auth::user()->id;
            $newProduct->product_id = $req->product_id;
            $newProduct->product_name = $product_name;
            $newProduct->descriptions = isset($req->description[$i]) ? $req->description[$i] : null;
            $newProduct->payment_type = isset($req->payment_type[$i]) ? $req->payment_type[$i] : null;
            $newProduct->save();

            if ($req->payment_type[$i] == 1) {

                    $onetime_inr = new ProductAddOnPrice;
                    $onetime_inr->user_id = Auth::user()->id;
                    $onetime_inr->product_add_on_id = $newProduct->id;
                    $onetime_inr->product_plan = 1;
                    $onetime_inr->currency_id = 1;
                    $onetime_inr->price = '0.00';
                    $onetime_inr->save();
               
            }
            
            if ($req->payment_type[$i] == 2) {

                if (isset($req->onetime_inr[$payment_type_key])) {
                    $onetime_inr = new ProductAddOnPrice;
                    $onetime_inr->user_id = Auth::user()->id;
                    $onetime_inr->product_add_on_id = $newProduct->id;
                    $onetime_inr->product_plan = 1;
                    $onetime_inr->currency_id = 1;
                    $onetime_inr->price = $req->onetime_inr[$payment_type_key];
                    $onetime_inr->save();
                }
                if (isset($req->onetime_usd[$payment_type_key])) {
                    $onetime_usd = new ProductAddOnPrice;
                    $onetime_usd->user_id = Auth::user()->id;
                    $onetime_usd->product_add_on_id = $newProduct->id;
                    $onetime_usd->product_plan = 1;
                    $onetime_usd->currency_id = 2;
                    $onetime_usd->price = $req->onetime_usd[$payment_type_key];
                    $onetime_usd->save();
                }

                $payment_type_key++;
            }
            if ($req->payment_type[$i] == '3') {

                if (isset($req->recurr_inr_hourly[$payment_type_key1])) {

                    $recurr_inr_hourly = new ProductAddOnPrice;
                    $recurr_inr_hourly->user_id = Auth::user()->id;
                    $recurr_inr_hourly->product_add_on_id = $newProduct->id;
                    $recurr_inr_hourly->product_plan = 3;
                    $recurr_inr_hourly->currency_id = 1;
                    $recurr_inr_hourly->price = $req->recurr_inr_hourly[$payment_type_key1];
                    $recurr_inr_hourly->save();
                }
                if (isset($req->recurr_inr_monthly[$payment_type_key1])) {
                    $recurr_inr_monthly = new ProductAddOnPrice;
                    $recurr_inr_monthly->user_id = Auth::user()->id;
                    $recurr_inr_monthly->product_add_on_id = $newProduct->id;
                    $recurr_inr_monthly->product_plan = 4;
                    $recurr_inr_monthly->currency_id = 1;
                    $recurr_inr_monthly->price = $req->recurr_inr_monthly[$payment_type_key1];
                    $recurr_inr_monthly->save();
                }
                if (isset($req->recurr_inr_quartely[$payment_type_key1])) {
                    $recurr_inr_quartely = new ProductAddOnPrice;
                    $recurr_inr_quartely->product_add_on_id = $newProduct->id;
                    $recurr_inr_quartely->user_id = Auth::user()->id;
                    $recurr_inr_quartely->product_plan = 5;
                    $recurr_inr_quartely->currency_id = 1;
                    $recurr_inr_quartely->price = $req->recurr_inr_quartely[$payment_type_key1];
                    $recurr_inr_quartely->save();
                }
                if (isset($req->recurr_inr_semiannually[$payment_type_key1])) {
                    $recurr_inr_semiannually = new ProductAddOnPrice;
                    $recurr_inr_semiannually->product_add_on_id = $newProduct->id;
                    $recurr_inr_semiannually->user_id = Auth::user()->id;
                    $recurr_inr_semiannually->product_plan = 6;
                    $recurr_inr_semiannually->currency_id = 1;
                    $recurr_inr_semiannually->price = $req->recurr_inr_semiannually[$payment_type_key1];
                    $recurr_inr_semiannually->save();
                }
                if (isset($req->recurr_inr_annually[$payment_type_key1])) {
                    $recurr_inr_annually = new ProductAddOnPrice;
                    $recurr_inr_annually->product_add_on_id = $newProduct->id;
                    $recurr_inr_annually->user_id = Auth::user()->id;
                    $recurr_inr_annually->product_plan = 7;
                    $recurr_inr_annually->currency_id = 1;
                    $recurr_inr_annually->price = $req->recurr_inr_annually[$payment_type_key1];
                    $recurr_inr_annually->save();
                }
                if (isset($req->recurr_inr_biennially[$payment_type_key1])) {
                    $recurr_inr_biennially = new ProductAddOnPrice;
                    $recurr_inr_biennially->product_add_on_id = $newProduct->id;
                    $recurr_inr_biennially->user_id = Auth::user()->id;
                    $recurr_inr_biennially->product_plan = 8;
                    $recurr_inr_biennially->currency_id = 1;
                    $recurr_inr_biennially->price = $req->recurr_inr_biennially[$payment_type_key1];
                    $recurr_inr_biennially->save();
                }
                if (isset($req->recurr_inr_triennially[$payment_type_key1])) {
                    $recurr_inr_triennially = new ProductAddOnPrice;
                    $recurr_inr_triennially->product_add_on_id = $newProduct->id;
                    $recurr_inr_triennially->user_id = Auth::user()->id;
                    $recurr_inr_triennially->product_plan = 9;
                    $recurr_inr_triennially->currency_id = 1;
                    $recurr_inr_triennially->price = $req->recurr_inr_triennially[$payment_type_key1];
                    $recurr_inr_triennially->save();
                }
                if (isset($req->recurr_usd_hourly[$payment_type_key1])) {
                    $recurr_usd_hourly = new ProductAddOnPrice;
                    $recurr_usd_hourly->product_add_on_id = $newProduct->id;
                    $recurr_usd_hourly->user_id = Auth::user()->id;
                    $recurr_usd_hourly->product_plan = 10;
                    $recurr_usd_hourly->currency_id = 2;
                    $recurr_usd_hourly->price = $req->recurr_usd_hourly[$payment_type_key1];
                    $recurr_usd_hourly->save();
                }
                if (isset($req->recurr_usd_monthly[$payment_type_key1])) {
                    $recurr_usd_monthly = new ProductAddOnPrice;
                    $recurr_usd_monthly->product_add_on_id = $newProduct->id;
                    $recurr_usd_monthly->user_id = Auth::user()->id;
                    $recurr_usd_monthly->product_plan = 11;
                    $recurr_usd_monthly->currency_id = 2;
                    $recurr_usd_monthly->price = $req->recurr_usd_monthly[$payment_type_key1];
                    $recurr_usd_monthly->save();
                }
                if (isset($req->recurr_usd_quartely[$payment_type_key1])) {
                    $recurr_usd_quartely = new ProductAddOnPrice;
                    $recurr_usd_quartely->product_add_on_id = $newProduct->id;
                    $recurr_usd_quartely->user_id = Auth::user()->id;
                    $recurr_usd_quartely->product_plan = 12;
                    $recurr_usd_quartely->currency_id = 2;
                    $recurr_usd_quartely->price = $req->recurr_usd_quartely[$payment_type_key1];
                    $recurr_usd_quartely->save();
                }
                if (isset($req->recurr_usd_semiannually[$payment_type_key1])) {
                    $recurr_usd_semiannually = new ProductAddOnPrice;
                    $recurr_usd_semiannually->product_add_on_id = $newProduct->id;
                    $recurr_usd_semiannually->user_id = Auth::user()->id;
                    $recurr_usd_semiannually->product_plan = 13;
                    $recurr_usd_semiannually->currency_id = 2;
                    $recurr_usd_semiannually->price = $req->recurr_usd_semiannually[$payment_type_key1];
                    $recurr_usd_semiannually->save();
                }
                if (isset($req->recurr_usd_annually[$payment_type_key1])) {
                    $recurr_usd_annually = new ProductAddOnPrice;
                    $recurr_usd_annually->product_add_on_id = $newProduct->id;
                    $recurr_usd_annually->user_id = Auth::user()->id;
                    $recurr_usd_annually->product_plan = 14;
                    $recurr_usd_annually->currency_id = 2;
                    $recurr_usd_annually->price = $req->recurr_usd_annually[$payment_type_key1];
                    $recurr_usd_annually->save();
                }
                if (isset($req->recurr_usd_biennially[$payment_type_key1])) {
                    $recurr_usd_biennially = new ProductAddOnPrice;
                    $recurr_usd_biennially->product_add_on_id = $newProduct->id;
                    $recurr_usd_biennially->user_id = Auth::user()->id;
                    $recurr_usd_biennially->product_plan = 15;
                    $recurr_usd_biennially->currency_id = 2;
                    $recurr_usd_biennially->price = $req->recurr_usd_biennially[$payment_type_key1];
                    $recurr_usd_biennially->save();
                }
                if (isset($req->recurr_usd_triennially[$payment_type_key1])) {
                    $recurr_usd_triennially = new ProductAddOnPrice;
                    $recurr_usd_triennially->product_add_on_id = $newProduct->id;
                    $recurr_usd_triennially->user_id = Auth::user()->id;
                    $recurr_usd_triennially->product_plan = 16;
                    $recurr_usd_triennially->currency_id = 2;
                    $recurr_usd_triennially->price = $req->recurr_usd_triennially[$payment_type_key1];
                    $recurr_usd_triennially->save();
                }
                $payment_type_key1++;
            }
            $i++;
        }
        return redirect()->back()->with('success', "New Product Added Successfully");
    }

    /////////////delete addOnProduct 
    public function ProductAddOnDelete(Request $req, $id)
    {
        ProductAddOn::find($id)->delete();
        ProductAddOnPrice::where('product_add_on_id', $id)->delete();
        return redirect()->back()->with('success', "Add On Product delete Successfully");
    }
}
