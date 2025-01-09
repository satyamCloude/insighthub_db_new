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
use App\Models\Department;
use App\Models\EmployeeDetail;
use App\Models\User;
use Hash;
use Auth;


class DepartmentController extends Controller
{   
    public function home(Request $request)
    {
        $departments = Department::with('teamLead')->get();
        foreach ($departments as $department) {
            if ($department->teamLead->isEmpty()) {
                // If there is no team lead, get direct employees
                $department->employees = EmployeeDetail::where('department_id', $department->id)
                    ->where('team_lead', 0)
                    ->join('users', 'employee_details.user_id', '=', 'users.id')
                    ->join('jobroles', 'employee_details.jobrole_id', '=', 'jobroles.id')
                    ->select('employee_details.*', 'users.first_name', 'users.last_name', 'users.profile_img', 'jobroles.name as role')
                    ->get();
            } else {
                // If there is a team lead, get their employees
                foreach ($department->teamLead as $team) {
                    $team->employees = EmployeeDetail::where('team_lead_id', $team->user_id)
                        ->join('users', 'employee_details.user_id', '=', 'users.id')
                        ->join('jobroles', 'employee_details.jobrole_id', '=', 'jobroles.id')
                        ->select('employee_details.*', 'users.first_name', 'users.last_name', 'users.profile_img', 'jobroles.name as role')
                        ->get();
                }
                // Also add employees without a team lead directly to the department
                $department->employees = EmployeeDetail::where('department_id', $department->id)
                    ->where('team_lead', 0)
                    ->whereNull('team_lead_id')
                    ->join('users', 'employee_details.user_id', '=', 'users.id')
                    ->join('jobroles', 'employee_details.jobrole_id', '=', 'jobroles.id')
                    ->select('employee_details.*', 'users.first_name', 'users.last_name', 'users.profile_img', 'jobroles.name as role')
                    ->get();
            }
        }
        
        // retreturn $departments;
        
        $admin = User::find(1);
        
        return view('admin.Humanesources.Department.home', compact('admin', 'departments'));
    }

    public function Create(Request $request)
    {   
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Department Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Department/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);


        $CompanyLogin = CompanyLogin::select('id','company_name')->get();
        return view('admin.Humanesources.Department.create',compact('CompanyLogin')); 
    }


    //home page
    public function store(Request $req)
    {

        $data = $req->all();
        if(isset($req->allow_for_ticket) && $req->allow_for_ticket == 'on'){
            $data['allow_for_ticket'] = 1;
        }

        Department::create($data);
        
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Department Data Store By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Department/store';
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('admin/Department/home')->with('success', "New Department Added Successfully");
    }

    //edit
    public function edit(Request $req,$id)
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Department Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Department/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        $Department = Department::find($id);
        $CompanyLogin = CompanyLogin::select('id','company_name')->get();
        return response()->json(['department'=>$Department]);
        
    }

    //updated
    public function update(Request $req)
    {
     
        $data =Department::find($req->id);
        $data2 = $req->all();
        if(isset($req->allow_for_ticket) && $req->allow_for_ticket == 'on'){
            $data2['allow_for_ticket'] = 1;
        }else{
            $data2['allow_for_ticket'] = 0;
        }
        $data->update($data2);    

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Department Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Department/update/'.$req->id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);  

        return redirect('admin/Department/home')->with('success', "Department Edit Successfully");
    }

    public function delete(Request $request,$id)
    { 
        $employeeCount = EmployeeDetail::where('department_id',$id)->count();
        if($employeeCount > 0){
            return redirect('admin/Department/home')->with('error', "You are unable to delete this department because it has $employeeCount employees.");
        }
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Department Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Department/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        Department::find($id)->delete();
        return redirect('admin/Department/home')->with('success', "Department Deleted Successfully");
    }


}
