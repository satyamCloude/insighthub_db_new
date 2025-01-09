<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Collection;
use App\Models\CompanyLogin;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use App\Models\Permission;
use App\Models\Department;
use App\Models\TimeShift;
use App\Models\Employee;
use App\Models\EmployeeDetail;
use App\Models\Ticket;
use App\Models\Leave;
use App\Models\Jobroles;
use App\Models\Leads;
use App\Models\Project;
use App\Models\Weekly;
use App\Models\Status;
use App\Models\User;
use App\Models\Role;
use App\Models\Task;
use App\Models\PayRoll;
use App\Models\TimeSheet;
use App\Models\LeadsFollowup;
use App\Models\RoleAccess;
use Hash;
use Session;
use Auth;


class LeadsFollowupController extends Controller
{   
    
    public function store(Request $req)
        {
            $url = url('/').'/public/images/';
            $leads = Leads::find($req->leads_id);
            $LeadsFollowup = new LeadsFollowup($req->all());
            $LeadsFollowup->status = $req->status;
            $LeadsFollowup->user_id = Auth::user()->id;
            $LeadsFollowup->follow_up_by = $leads->assignedto;
            $LeadsFollowup->save();

            $agent = new Agent();
            $browser = $agent->browser();
            $version = $agent->version($browser);
            $Log = $req->all();
            $Log['user_id'] = Auth::user()->id;
            $Log['ip'] = $req->ip();
            $Log['subject'] = "Employee Data Store By " . Auth::user()->first_name;
            $Log['url'] = url('/') . '/admin/LeadsFollowup/store';
            $Log['method'] = "Post";
            $Log['browser'] = $browser . "-" . $version;
            LogActivity::create($Log);
            return redirect('admin/Leads/home')->with('success', "New Leads Followups Added Successfully");
        }
     public function delete(Request $request,$id)
    {
         $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Employee Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Employee/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        $LeadsFollowup = LeadsFollowup::find($id);
        $LeadsFollowup->delete();
        return redirect()->back()->with('success', "Leads Followups Deleted Successfully");
    }

    public function edit(Request $request)
    {
        $LeadsFollowup = LeadsFollowup::find($request->id);
        return view('admin.sales.Leads.editFollowUp',compact('LeadsFollowup'));
    }

    public function update(Request $request,$id)
    {
        $LeadsFollowup =  LeadsFollowup::find($id);
        $LeadsFollowup->follow_up_next = $request->follow_up_next;
        $LeadsFollowup->start_time = $request->start_time;
        $LeadsFollowup->custom_check_primary = $request->custom_check_primary;
        $LeadsFollowup->remind_before = $request->remind_before;
        $LeadsFollowup->remind_type = $request->remind_type;
        $LeadsFollowup->remark = $request->remark;
        $LeadsFollowup->status = $request->status;

        $LeadsFollowup->save();
        return redirect()->back()->with('success', "Leads Followups Update Successfully");
    }


}
