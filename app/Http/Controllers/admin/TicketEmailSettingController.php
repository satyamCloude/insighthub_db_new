<?php

namespace App\Http\Controllers\admin;

use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;
use App\Models\TicketEmailSetting;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use Hash;
use Auth;


class TicketEmailSettingController extends Controller
{   
    //home page
    public function home(Request $request)
    {
        $TES = TicketEmailSetting::where('id',1)->first();
        return view('admin.settings.TicketEmailSetting.home',compact('TES'));
    }

    //store page
    public function update(Request $request,$id)
    {
        $TES = TicketEmailSetting::find($request->id);
        $data = $request->all();
        if($TES){
            $TES->update($data);
        }else{
            TicketEmailSetting::create($data);
        }
        return redirect()->back()->with('success', "Ticket email setting's updated Successfully.");
    }

}
