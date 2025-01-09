<?php

namespace App\Http\Controllers\Employee;

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
use App\Models\User;
use Hash;
use Auth;


class EProductController extends Controller
{   
    //home page
   public function home()
    {
        $Category = Category::orderBy('created_at', 'desc')->paginate(10);
        foreach ($Category as $key => $value) {
            $value->products = Product::select('products.id','products.product_name','producttypes.name')->where('category_id',$value->id)->join('producttypes','producttypes.id','products.product_type_id')->get();
        }
        return view('Employee.settings.Product.home', compact('Category'));
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
        $Log['url'] = url('/') . '/Employee/Product/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('Employee.settings.Product.create',compact('Productype','Category','PaymentMethod')); 
    }


    //home page
    public function store(Request $req)
    {
        $data = $req->all();
        if ($req->display_on_frontend == 'on') {
            $data['display_on_frontend'] = 1;
            } else {
            $data['display_on_frontend'] = 0;
            }
        Product::create($data);

        $agent = new Agent();
            $browser = $agent->browser();
            $version = $agent->version($browser);
            $Log = $req->all();
            $Log['user_id'] = Auth::user()->id;
            $Log['ip'] = $req->ip();
            $Log['subject'] = "Product Data Store By " . Auth::user()->first_name;
            $Log['url'] = url('/') . '/Employee/Product/store';
            $Log['method'] = "Post";
            $Log['browser'] = $browser . "-" . $version;
            LogActivity::create($Log);

        return redirect('Employee/Product/home')->with('success', "New Product Added Successfully");
    }

    //edit
    public function edit(Request $req,$id)
    {
         $Product = Product::find($id);
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
        $Log['url'] = url('/') . '/Employee/Product/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('Employee.settings.Product.edit',compact('Product','Productype','Category','PaymentMethod')); 
    }

    //updated
    public function update(Request $req,$id)
    {
     
        $data =Product::find($id);
        $data['product_type_id'] = $req->product_type_id;
        $data['category_id'] = $req->category_id;
        $data['product_name'] = $req->product_name;
        $data['url'] = $req->url;
        $data['product_tag_line'] = $req->product_tag_line;
        $data['tax'] = $req->tax;
        $data['payment_method'] = $req->payment_method;
        $data['product_description'] = $req->product_description;
        $data['payment_type'] = $req->payment_type;
        $data['onetime_inr'] = $req->onetime_inr;
        $data['onetime_usd'] = $req->onetime_usd;
        $data['recurr_inr_hourly'] = $req->recurr_inr_hourly;
        $data['recurr_inr_monthly'] = $req->recurr_inr_monthly;
        $data['recurr_inr_quartely'] = $req->recurr_inr_quartely;
        $data['recurr_inr_semiannually'] = $req->recurr_inr_semiannually;
        $data['recurr_inr_annually'] = $req->recurr_inr_annually;
        $data['recurr_inr_biennially'] = $req->recurr_inr_biennially;
        $data['recurr_inr_triennially'] = $req->recurr_inr_triennially;
        $data['recurr_usd_hourly'] = $req->recurr_usd_hourly;
        $data['recurr_usd_monthly'] = $req->recurr_usd_monthly;
        $data['recurr_usd_quartely'] = $req->recurr_usd_quartely;
        $data['recurr_usd_semiannually'] = $req->recurr_usd_semiannually;
        $data['recurr_usd_annually'] = $req->recurr_usd_annually;
        $data['recurr_usd_biennially'] = $req->recurr_usd_biennially;
        $data['recurr_usd_triennially'] = $req->recurr_usd_triennially;
        if ($req->display_on_frontend == 'on') {
            $data['display_on_frontend'] = 1;
            } else {
            $data['display_on_frontend'] = 0;
            }
        $data->save();    

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Product Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Product/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);


        return redirect('Employee/Product/home')->with('success', "Product Edited Successfully");
    }
    // delete Product
     public function delete(Request $request,$id)
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Product Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Product/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        Product::find($id)->delete();
        return redirect('Employee/Product/home')->with('success', "Product Deleted Successfully");
    }

}
