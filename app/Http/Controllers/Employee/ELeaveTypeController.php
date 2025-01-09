<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Collection;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Str;
use App\Models\LogActivity;
use App\Models\LeaveType;
use App\Models\User;
use Hash;
use Auth;


class ELeaveTypeController extends Controller
{   
    
    //home page
    public function store(Request $req)
    {

        $data = $req->all();
        LeaveType::create($data);

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "LeaveType Data Store By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/LeaveType/store';
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('Employee/Leave/home')->with('success', "New LeaveType Added Successfully");
    }

    //edit
    public function edit(Request $req)
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "LeaveType Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/LeaveType/edit/'.$req->id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);
        
        $LeaveType = LeaveType::find($req->id);
        return view('Employee.Humanesources.LeaveType.edit',compact('LeaveType'));
    }

    //updated
    public function update(Request $req,$id)
    {
     
        $data =LeaveType::find($id);
        $data['leave_type'] = $req->leave_type;
        $data['no_of_leave'] = $req->no_of_leave;
        $data['leave_type'] = $req->leave_type;
        $data['theme'] = $req->theme;
        $data->save();    

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "LeaveType Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/LeaveType/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);


        return redirect('Employee/Leave/home')->with('success', "LeaveType Edit Successfully");
    }

     public function delete(Request $request,$id)
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "LeaveType Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/LeaveType/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        LeaveType::find($id)->delete();
        return redirect('Employee/Leave/home')->with('success', "LeaveType Deleted Successfully");
    }


}
