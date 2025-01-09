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
use Auth;
use Hash;


class ECategoryController extends Controller
{   
    //store page
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
        $Log['url'] = url('/') . '/Employee/Category/store';
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log); 

        return redirect('Employee/Product/home')->with('success', "New Category Added Successfully");
    }


    //edit page
    public function edit(Request $req)
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Category Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Category/edit/'.$req->id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        $Category = Category::find($req->id);
        return view('Employee.settings.Category.edit',compact('Category'));
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
        $Log['url'] = url('/') . '/Employee/Category/update/'.$id;
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
        return redirect('Employee/Product/home')->with('success', "Category Edited Successfully");
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
        $Log['url'] = url('/') . '/Employee/Category/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('Employee/Product/home')->with('success', "Category Deleted Successfully");
    }

}
