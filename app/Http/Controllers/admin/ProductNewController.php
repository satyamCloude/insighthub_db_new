<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use App\Models\PaymentMethod;
use App\Models\TaxSetting;
use App\Models\Currency;
use App\Models\ProductPricing;
use App\Models\ProductAddOn;
use App\Models\Producttype;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use App\Models\ProductNew;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Hash;
use Auth;


class ProductNewController extends Controller
{
  //home page
  public function home()
  {
    $Category = Category::orderBy('created_at', 'desc')->paginate(10);
    foreach ($Category as $key => $value) {
      $value->products = Product::select('products.id', 'products.product_name', 'producttypes.name')->where('category_id', $value->id)->join('producttypes', 'producttypes.id', 'products.product_type_id')->get();
    }
    // return $Category;
    return view('admin.settings.Product.home', compact('Category'));
  }
  //home page
  public function currency(Request $request)
  {
    $plan_type = $request->plan_type;
    $payment_type = $request->paymenttype;
    $p_id = $request->p_id;
    $currency = Currency::get();
    return view('admin.settings.Product.currency', compact('currency', 'payment_type', 'plan_type','p_id'));
  }


  //home page
  public function Create(Request $request)
  {
    $Productype = Producttype::get();
    $Category = Category::get();
    $PaymentMethod = PaymentMethod::get();

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

    return view('admin.settings.Product.create', compact('Productype', 'Category', 'PaymentMethod'));
  }


  //home page
public function store(Request $req)
{
    $url = url('/') . '/public/images/';
    $data = $req->all();
    // Handle display_on_frontend
    $data['display_on_frontend'] = $req->display_on_frontend == 'on' ? 1 : 0;

    // Handle product_image
    $product_imagename = 'product_image.jpg';
    if ($req->hasFile('product_image')) {
        $rand = Str::random(4);
        $file = $req->file('product_image');
        $extension = $file->getClientOriginalExtension();
        $product_imagename = 'Prod_img_' . $rand . '.' . $extension;
        $file->move(public_path('images'), $product_imagename);
    }
    $data['product_image'] = $url . $product_imagename;

    // Handle payment_method
    $data['payment_method'] = $req->has('payment_method') ? implode(',', $req->payment_method) : null;

    // Create new product
    $newProduct = ProductNew::create($data);
// Handle product pricing based on payment_type
if ($req->payment_type == 3) {
    $selectedPlans = $req->input('selected_plans', []);
    $currencies = $req->input('currency_id', []);
    $planTypes = $req->input('plan_type', []);
    $prices = $req->input('price', []);

    // Create a map to hold price information
    $pricingMap = [];
    
    foreach ($selectedPlans as $currencyId => $planTypesArray) {
        foreach ($planTypesArray as $planType) {
            // Store prices indexed by currencyId and planType
            $pricingMap[$currencyId][$planType] = null;
        }
    }

    foreach ($planTypes as $index => $planType) {
        if (isset($currencies[$index]) && isset($prices[$index])) {
            $currencyId = $currencies[$index];
            $price = $prices[$index];
            if ($price !== null && $price !== '') { // Only save if price is not null or empty
                $pricingMap[$currencyId][$planType] = $price;
            }
        }
    }

    // Save the pricing information to the database
    foreach ($pricingMap as $currencyId => $plans) {
        foreach ($plans as $planType => $price) {
            if ($price !== null) {
                $pricing = new ProductPricing();
                $pricing->product_id = $newProduct->id;
                $pricing->product_plan = $req->payment_type;
                $pricing->plan_type = $planType;
                $pricing->currency_id = $currencyId;
                $pricing->price = $price;
                $pricing->save();
            }
        }
    }
} else {
    $onetime_usd = new ProductPricing();
    $onetime_usd->product_id = $newProduct->id;
    $onetime_usd->product_plan = 1;
    $onetime_usd->plan_type = 'free';
    $onetime_usd->currency_id = 1;
    $onetime_usd->price = '0.00';
    $onetime_usd->save();
}

    // Handle product add-ons
    if ($req->has('addon_id')) {
        $ProductAddOn = new ProductAddOn();
        $ProductAddOn->product_id = $newProduct->id;
        $ProductAddOn->addon_id = implode(',', $req->addon_id);
        $ProductAddOn->save();  
    }

    // Log activity
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

 //updated
 public function update(Request $req, $id)
{
    $product = ProductNew::find($id);
    $url = url('/') . '/public/images/';

    $data = $req->all();
    
    // Handle display_on_frontend
    $data['display_on_frontend'] = $req->display_on_frontend == 'on' ? 1 : 0;

    // Handle product_image
    if ($req->hasFile('product_image')) {
        $rand = Str::random(4);
        $file = $req->file('product_image');
        $extension = $file->getClientOriginalExtension();
        $product_imagename = 'Prod_img_' . $rand . '.' . $extension;
        $file->move(public_path('images'), $product_imagename);
        $data['product_image'] = $url . $product_imagename;
    }

    // Handle payment_method
    $data['payment_method'] = $req->has('payment_method') ? implode(',', $req->payment_method) : null;

    // Update the product details
    $product->update($data);

    // Handle product pricing
    if ($req->payment_type == 3) {
        // Delete existing pricing records for the product
        ProductPricing::where('product_id', $id)->delete();

        $selectedPlans = $req->input('selected_plans', []);
        $currencies = $req->input('currency_id', []);
        $planTypes = $req->input('plan_type', []);
        $prices = $req->input('price', []);

        // Create a map to hold price information
        $pricingMap = [];

        foreach ($selectedPlans as $currencyId => $planTypesArray) {
            foreach ($planTypesArray as $planType) {
                // Store prices indexed by currencyId and planType
                $pricingMap[$currencyId][$planType] = null;
            }
        }

        foreach ($planTypes as $index => $planType) {
            if (isset($currencies[$index]) && isset($prices[$index])) {
                $currencyId = $currencies[$index];
                $price = $prices[$index];
                if ($price !== null && $price !== '') { // Only save if price is not null or empty
                    $pricingMap[$currencyId][$planType] = $price;
                }
            }
        }

        // Save the pricing information to the database
        foreach ($pricingMap as $currencyId => $plans) {
            foreach ($plans as $planType => $price) {
                if ($price !== null) {
                    ProductPricing::create([
                        'product_id' => $id,
                        'product_plan' => $req->payment_type,
                        'plan_type' => $planType,
                        'currency_id' => $currencyId,
                        'price' => $price
                    ]);
                }
            }
        }
    } else {
        // Handle pricing for non-recurring plans
        ProductPricing::where('product_id', $id)->delete();
        ProductPricing::create([
            'product_id' => $id,
            'product_plan' => 1,
            'plan_type' => 'free',
            'currency_id' => 1,
            'price' => '0.00'
        ]);
    }

    // Handle product add-ons
    if ($req->has('addon_id')) {
        ProductAddOn::updateOrCreate(
            ['product_id' => $id],
            ['addon_id' => implode(',', $req->addon_id)]
        );
    } else {
        // Optionally handle the case where add-ons are not provided
        ProductAddOn::where('product_id', $id)->delete();
    }

    // Log activity
    $agent = new Agent();
    $browser = $agent->browser();
    $version = $agent->version($browser);
    $Log = $req->all();
    $Log['user_id'] = Auth::user()->id;
    $Log['ip'] = $req->ip();
    $Log['subject'] = "Product Data Updated By " . Auth::user()->first_name;
    $Log['url'] = url('/') . '/admin/Product/update/' . $id;
    $Log['method'] = "Post";
    $Log['browser'] = $browser . "-" . $version;
    LogActivity::create($Log);

    return redirect()->back()->with('success', "Product Edited Successfully");
}

  public function update2(Request $req, $id)
  {

    $product = ProductNew::find($id);
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

    if ($req->has('payment_method')) {
      $data['payment_method'] = implode(',', $req->payment_method);
    } else {
      $data['payment_method'] = null; // or any default value you prefer
    }
    $product->update($data);


    if ($req->payment_type != 1) {
      $checkPrice = ProductPricing::where('product_id', $id)->delete();
      foreach ($req->plan_type as $key => $plan) {
        $onetime_usd = new ProductPricing;
        $onetime_usd->product_id = $id;
        $onetime_usd->product_plan = $req->payment_type;
        $onetime_usd->plan_type = $plan;
        $onetime_usd->currency_id = $req->currency_id[$key];
        $onetime_usd->price = $req->price[$key];
        $onetime_usd->save();
      }
    }else{
         $checkPrice = ProductPricing::where('product_id', $id)->delete();
          $onetime_usd = new ProductPricing;
        $onetime_usd->product_id = $id;
        $onetime_usd->product_plan = $req->payment_type;
        $onetime_usd->plan_type = 'free';
        $onetime_usd->currency_id = 1;
        $onetime_usd->price = 00.00;
        $onetime_usd->save();
    }





 // Handle product add-ons
    if ($req->has('addon_id')) {
            $checkProductAddOn = ProductAddOn::where('product_id', $id)->delete();
        $ProductAddOn = new ProductAddOn;
    $ProductAddOn->product_id = $id;
    $ProductAddOn->addon_id = implode(',', $req->addon_id);
    $ProductAddOn->save();

    }
    
    
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
  public function stores2(Request $req)
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

    if ($req->has('payment_method')) {
      $data['payment_method'] = implode(',', $req->payment_method);
    } else {
      $data['payment_method'] = null; // or any default value you prefer
    }
    // $data['payment_method'] = json_encode($req->payment_method);
    $newProduct = ProductNew::create($data);
    // return $newProduct;
    if ($req->payment_type != 1) {

      foreach ($req->plan_type as $key => $plan) {
        $onetime_usd = new ProductPricing;
        $onetime_usd->product_id = $newProduct->id;
        $onetime_usd->product_plan = $req->payment_type;
        $onetime_usd->plan_type = $plan;
        $onetime_usd->currency_id = $req->currency_id[$key];
        $onetime_usd->price = $req->price[$key];
        $onetime_usd->save();
      }
    }else{
         $onetime_usd = new ProductPricing;
        $onetime_usd->product_id = $newProduct->id;
        $onetime_usd->product_plan = 1;
        $onetime_usd->plan_type = 'free';
        $onetime_usd->currency_id = 1;
        $onetime_usd->price = '0.00';
        $onetime_usd->save();
    }


    if ($req->has('addon_id')) {
        $ProductAddOn = new ProductAddOn;
        $ProductAddOn->product_id = $newProduct->id;
        $ProductAddOn->addon_id = implode(',', $req->addon_id);
        $ProductAddOn->save();  
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
  public function storeOld(Request $req)
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
    Product::create($data);

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
         $addonString = ProductAddOn::where('product_id', $Product->id)->pluck('addon_id')->first();
        $Product->addon = explode(',', $addonString); // Convert to arra
    }

    // echo "<pre>"; print_r($Product->addon); exit;
    $Productype = Producttype::get();
    $Category = Category::get();
    $PaymentMethod = PaymentMethod::get();

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
    $TaxSettings = TaxSetting::get();

    return view('admin.settings.Product.edit', compact('Product', 'Productype', 'Category', 'PaymentMethod', 'Products', 'TaxSettings'));
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

    Product::find($id)->delete();
    return redirect()->back()->with('success', "Product Deleted Successfully");
  }
}
