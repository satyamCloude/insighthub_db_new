<?php

namespace App\Http\Controllers\admin;

use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;   
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use Illuminate\Support\Str;
use App\Models\StorageSetting;
use Hash;
use Auth;


class StorageSettingsController extends Controller
{   
    //home page
    public function home(Request $request)
    {
        $SsT = StorageSetting::where('id',1)->first();       
        return view('admin.settings.StorageSettings.home',compact('SsT'));
    }

    //store page
    public function store(Request $request)
    {
         $data = StorageSetting::where('id',1)->first();
        if($request->status == 'Bucket')
        {
            $data->status = 1;
            $data->AWS_ACCESS_KEY_ID = $request->AWS_ACCESS_KEY_ID;
            $data->AWS_SECRET_ACCESS_KEY = $request->AWS_SECRET_ACCESS_KEY;
            $data->AWS_DEFAULT_REGION = $request->AWS_DEFAULT_REGION;
            $data->AWS_BUCKET = $request->AWS_BUCKET;
            $data->S3_BASE_URL = $request->S3_BASE_URL;
        }
        if($request->status == 'local')
        {
            $data->status = 0;
        }
       
        $data->save();
         return redirect()->back()->with('success', "StorageSettings Updated Successfully");
    }

}
