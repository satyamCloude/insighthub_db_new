<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Collection;
use App\Models\CompanyLogin;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use App\Models\User;
use App\Models\EmployeeDetail;
use App\Models\LogActivity;
use App\Models\Department;
use Hash;
use Auth;


class EDepartmentController extends Controller
{   
   public function home(Request $request)
    {
        $searchTerm = '';
         $RoleAccess = \App\Models\RoleAccess::select('role_accesses.add','role_accesses.view','role_accesses.update','role_accesses.delete','permissions.name as per_name')
                    ->join('employee_details','employee_details.job_role_id','role_accesses.role_id')
                    ->leftjoin('permissions','permissions.id','role_accesses.permission_id')
                    ->where('employee_details.user_id', Auth::user()->id)
                    ->where(function($query) {
                        $query->where('role_accesses.view', '!=', null)
                            ->orWhere('role_accesses.add', '!=', null)
                            ->orWhere('role_accesses.update', '!=', null)
                            ->orWhere('role_accesses.delete', '!=', null);
                    })
                    ->get()
                    ->toArray();
    
        if($RoleAccess[array_search('Department', array_column($RoleAccess, 'per_name'))]['view'] == 1)
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

            // Initialize $searchTerm
            $searchTerm = '';

       
            
        }

        if($RoleAccess[array_search('Department', array_column($RoleAccess, 'per_name'))]['view'] == 2)
        {

            $departments = Department::with('teamLead')->get();
                    foreach ($departments as $department) {
                        if ($department->teamLead->isEmpty()) {
                            // If there is no team lead, get direct employees
                            $department->employees = EmployeeDetail::where('department_id', $department->id)
                                ->where('team_lead', 0)
                                ->join('users', 'employee_details.user_id', '=', 'users.id')
                                ->where('employee_details.user_id',Auth::user()->id)   
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
              //   
        }
 $admin = User::find(1);
        return view('Employee.Humanesources.Department.home', compact('RoleAccess','departments', 'searchTerm','admin'));
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
        $Log['url'] = url('/') . '/Employee/Department/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);


        $CompanyLogin = CompanyLogin::select('id','company_name')->get();
        return view('Employee.Humanesources.Department.create',compact('CompanyLogin')); 
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
        $Log['url'] = url('/') . '/Employee/Department/store';
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('Employee/Department/home')->with('success', "New Department Added Successfully");
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
        $Log['url'] = url('/') . '/Employee/Department/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        $Department = Department::find($id);
        $CompanyLogin = CompanyLogin::select('id','company_name')->get();
        return view('Employee.Humanesources.Department.edit',compact('Department','CompanyLogin'));
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
        $Log['url'] = url('/') . '/Employee/Department/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);  

        return redirect('Employee/Department/home')->with('success', "Department Edit Successfully");
    }

     public function delete(Request $request,$id)
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Department Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Department/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        Department::find($id)->delete();
        return redirect('Employee/Department/home')->with('success', "Department Deleted Successfully");
    }


}
