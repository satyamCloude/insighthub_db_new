<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use App\Models\PerformanceRating;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use Hash;
use Auth;



class PerformanceRatingController extends Controller
{   
    //store page
    public function Store(Request $req)
    {
        $data = $req->all();
        $data['rating_name'] = $req->rating_name;
        $data['rating'] = $req->rating;
        $data['user_id'] = Auth::user()->id;
        PerformanceRating::create($data);
        $PerformanceRating = PerformanceRating::get();

            $agent = new Agent();
            $browser = $agent->browser();
            $version = $agent->version($browser);
            $Log = $req->all();
            $Log['user_id'] = Auth::user()->id;
            $Log['ip'] = $req->ip();
            $Log['subject'] = "PerformanceRating Data Store By " . Auth::user()->first_name;
            $Log['url'] = url('/') . '/admin/PerformanceRating/store';
            $Log['method'] = "Post";
            $Log['browser'] = $browser . "-" . $version;
            LogActivity::create($Log);

         return view('admin.Humanesources.PerformanceRating.latestdatat_get', compact('PerformanceRating'));
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
        $Log['subject'] = "PerformanceRating Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/PerformanceRating/edit/'.$req->id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        $PerformanceRating = PerformanceRating::find($req->id);
         return view('admin.Humanesources.PerformanceRating.latestdatat_edit', compact('PerformanceRating'));
    }

    //updated
    public function update(Request $req)
    {

        $data =PerformanceRating::find($req->id);
        $data->rating_name = $req->rating_name;
        $data->rating = $req->rating;
        $data->user_id = Auth::user()->id;
        $data->save();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "PerformanceRating Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/PerformanceRating/update/'.$req->id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

         $PerformanceRating = PerformanceRating::get();    
       return view('admin.Humanesources.PerformanceRating.latestdatat_get', compact('PerformanceRating'));
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
        $Log['subject'] = "PerformanceRating Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/PerformanceRating/delete/'.$request->id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        PerformanceRating::find($request->id)->delete();
       $PerformanceRating = PerformanceRating::get();
         return view('admin.Humanesources.PerformanceRating.latestdatat_get', compact('PerformanceRating'));
    }

}
