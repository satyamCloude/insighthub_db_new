<?php

namespace App\Http\Controllers\admin;

use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\PerformanceSettings;   
use Illuminate\Support\Collection;
use App\Models\OperatingSysten;
use App\Exports\AcronisExport; 
use App\Models\PaymentMethod;   
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use Illuminate\Support\Str;
use App\Models\IPAddress;
use App\Models\Countrys;
use App\Models\Currency;   
use App\Models\Firewall;
use App\Models\Product;
use App\Models\AppSetting;
use App\Models\Switchs;
use App\Models\Acronis;   
use App\Models\Status;
use App\Models\User;
use App\Models\Host;
use App\Models\Rack;
use Hash;
use Auth;


class PerformanceSettingsController extends Controller
{   
    //home page
    public function home(Request $request)
    {
        $PS = PerformanceSettings::where('id',1)->first();
        $Currency = Currency::get();
       
        return view('admin.settings.PerformanceSettings.home',compact('PS'));
    }

    //store page
    public function update(Request $request,$id)
    {
        $PS = PerformanceSettings::find($id);
        $PS->status = $request->status;
        $PS->save();
        return redirect()->back()->with('success', "Performance Settings Updated Successfully");
    }

}
