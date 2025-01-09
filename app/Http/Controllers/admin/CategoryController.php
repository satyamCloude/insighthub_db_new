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
use App\Models\OperatingSysten;
use App\Models\Currency;
use App\Models\LogActivity;
use App\Models\OSCategory;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Auth;
use Hash;


class CategoryController extends Controller
{   
    //store page


    public function home(Request $req)
    {
        $cate = Category::get();
        return view('admin.sales.categories.home', compact('cate'));
    }


    public function Create(Request $request)
    {

        return view('admin.sales.categories.create');
    }


    public function Store(Request $req)
    {
        $data = $req->all();
        if ($req->status == 'on') {
        $data['status'] = 1;
        } else {
        $data['status'] = 0;
        }
        $data['user_id'] = Auth::user()->id;
        Category::create($data);

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Category Data Store By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Category/store';
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log); 
        return redirect('admin/Settings/home')->with('success', "New Category Added Successfully");
    }


    //edit page
    public function edit(Request $req,$id)
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Category Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Category/edit/'.$req->id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        $Category = Category::find($req->id);
        // echo "<pre>"; print_r($Category); exit;
        return view('admin.sales.categories.edit',compact('Category','id'));
    }
 //edit page
    public function edits(Request $req,$id)
    {

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Category Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Category/edit/'.$req->id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);
        $Currency = Currency::get(); // Corrected variable name to lowercase

        $Categorys= Category::get();
        $Category = Category::find($req->id);
        // echo "<pre>"; print_r($Category); exit;
        return view('admin.settings.Product.CatgegoryEdit',compact('Category','id','Currency'));
    }

    //updated
    public function update(Request $req,$id)
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Category Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Category/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

     
        $data =Category::find($id);
        $data['user_id'] = Auth::user()->id;
        $data['category_name'] = $req->category_name;
        $data['url'] = $req->url;
        $data['tag_line'] = $req->tag_line;
        if ($req->status == 'on') {
            $data['status'] = 1;
            } else {
            $data['status'] = 0;
            }
        $data->save();    
        return redirect('admin/Category/home')->with('success', "Category Edited Successfully");
    } 
    public function updates(Request $req,$id)
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Category Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Category/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

     
        $data =Category::find($id);
        $data['user_id'] = Auth::user()->id;
        $data['category_name'] = $req->category_name;
        $data['url'] = $req->url;
        $data['tag_line'] = $req->tag_line;
        if ($req->status == 'on') {
            $data['status'] = 1;
            } else {
            $data['status'] = 0;
            }
        $data->save();    
        return redirect('admin/Settings/home')->with('success', "Category Edited Successfully");
    } 
    // delete Category
     public function delete(Request $request,$id)
    {
        Category::find($id)->delete();
        Product::where('category_id',$id)->delete();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Category Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Category/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect()->back()->with('success', "Category Deleted Successfully");
    }

    public function StoreOSCategory(Request $req)
    {
        $data = $req->all();

        OSCategory::create($data);

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Category Data Store By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Category/store';
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log); 
        return redirect('admin/Settings/home')->with('success', "New Operating System Category Added Successfully");
    }
    
    public function editOSCategory(Request $req,$id)
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Category Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Category/edit/'.$req->id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);
         $categories = Category::orderBy('created_at', 'desc')->get(); // Corrected variable name to lowercase
        $OperatingSystem = OperatingSysten::orderBy('created_at', 'desc')->get(); // Corrected variable name to camelCase
        $Currency = Currency::get(); // Corrected variable name to lowercase

        $OSCategory = OSCategory::find($req->id);
        // echo "<pre>"; print_r($Category); exit;
        return view('admin.settings.Product.operatingsystemEdit',compact('OSCategory','id','categories','OperatingSystem','Currency'));
    }
    public function updateOSCategory(Request $req,$id)
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Category Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Category/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

     
        $data =OSCategory::find($id);
        $data['category_id'] = $req->category_id;
        $data['currency_id'] = $req->currency_id;
        $data['price'] = $req->price;
        $data['os_id'] = $req->os_id;
       
        $data->save();    
        return redirect('admin/Settings/home')->with('success', "Operating System Category Edited Successfully");
    }

    public function deleteOSCategory(Request $request,$id)
    {
        OSCategory::find($id)->delete();
        // Product::where('category_id',$id)->delete();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Category Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Category/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect()->back()->with('success', " Operating System Category Deleted Successfully");
    }
    
}
