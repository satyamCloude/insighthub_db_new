<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use Illuminate\Pagination\Paginator;
use App\Models\PerformanceCategory;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use Hash;
use Auth;


class EPerformanceCategoryController extends Controller
{   
    //store page
    public function Store(Request $req)
    {
        $data = $req->all();
        $data['category_name'] = $req->category_name;
        $data['description'] = $req->description;
        $data['user_id'] = Auth::user()->id;
        PerformanceCategory::create($data);
        $PerformanceCategory = PerformanceCategory::get();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "PerformanceCategory Data Store By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/PerformanceCategory/store';
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

         return view('Employee.Humanesources.PerformanceCategory.latestdatat_get', compact('PerformanceCategory'));
    }


    //edit page
    public function edit(Request $req)
    {
        $PerformanceCategory = PerformanceCategory::find($req->id);

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "PerformanceCategory Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/PerformanceCategory/edit/'.$req->id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

         return view('Employee.Humanesources.PerformanceCategory.latestdatat_edit', compact('PerformanceCategory'));
    }

    //updated
    public function update(Request $req)
    {

        $data =PerformanceCategory::find($req->id);
        $data->category_name = $req->category_name;
        $data->description = $req->description;
        $data->user_id = Auth::user()->id;
        $data->save();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "PerformanceCategory Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/PerformanceCategory/update/'.$req->id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);


         $PerformanceCategory = PerformanceCategory::get();    
       return view('Employee.Humanesources.PerformanceCategory.latestdatat_get', compact('PerformanceCategory'));
    }
    // delete Category
     public function delete(Request $request)
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "PerformanceCategory Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/PerformanceCategory/delete/'.$request->id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        PerformanceCategory::find($request->id)->delete();
       $PerformanceCategory = PerformanceCategory::get();
         return view('Employee.Humanesources.PerformanceCategory.latestdatat_get', compact('PerformanceCategory'));
    }

}
