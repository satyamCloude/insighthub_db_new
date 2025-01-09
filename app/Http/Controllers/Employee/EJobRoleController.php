<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Collection;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use Illuminate\Support\Str;
use App\Models\Jobroles;
use App\Models\User;
use App\Models\Goal;
use App\Models\EmployeeDetail;
use Hash;
use Auth;


class EJobRoleController extends Controller
{   
    //home page
    public function home(Request $request)
    {
        $query = Jobroles::select('id', 'name', 'assign_emp_id')
            ->orderBy('created_at', 'desc');

        $searchTerm = '';

        // Check if a search term is provided
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('jobroles.name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('jobroles.assign_emp_id', 'like', '%' . $searchTerm . '%');
            });
        }

        $JobRole = $query->paginate(10);
        $JobRole->appends(['search' => $searchTerm]);

        return view('Employee.Humanesources.JobRole.home', compact('JobRole', 'searchTerm'));
    }

    //home page
    public function Create(Request $request)
    {   
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "JobRole Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/JobRole/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        $jobroles = Jobroles::pluck('assign_emp_id')->toArray();
        $assignedEmpIds = [];
        foreach ($jobroles as $empIds) {
            $assignedEmpIds = array_merge($assignedEmpIds, explode(',', $empIds));
        }
        $assignedEmpIds = array_unique(array_map('trim', $assignedEmpIds));
        // Get employees of type 4 who are not assigned to any job role
        $Employee = User::whereNotIn('id', $assignedEmpIds)
        ->where('type', 4)->where('deleted_at', null)
        ->select('first_name', 'id')
        ->get();
        
        // dd($Employee);
        return view('Employee.Humanesources.JobRole.create',compact('Employee')); 
    }


    //home page
    public function store(Request $req)
    {
        $empid = implode(",",$req->assign_emp_id);

        $data = $req->all();
        $data['assign_emp_id'] = $empid;
        Jobroles::create($data);

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "JobRole Data Store By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/JobRole/store';
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('Employee/JobRole/home')->with('success', "New JobRole Added Successfully");
    }

    //edit
    public function edit(Request $req,$id)
    {
        $JobRole = Jobroles::find($id);
        $Employee = User::select('first_name','id')->where('deleted_at', null)->where('type',4)->get();
        // dd($Employee);
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "JobRole Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/JobRole/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        // dd($Employee);
        return view('Employee.Humanesources.JobRole.edit',compact('JobRole','Employee'));
    }

    //updated
    public function update(Request $req, $id)
    {
        // Convert assign_emp_id array to a comma-separated string
        $empid = implode(",", $req->assign_emp_id);
    
        // Fetch all job roles and remove conflicting employee IDs in other entries
        $jobroles = Jobroles::where('id', '!=', $id) // Exclude the current job role being updated
            ->where(function ($query) use ($req) {
                foreach ($req->assign_emp_id as $empId) {
                    $query->orWhereRaw("FIND_IN_SET(?, assign_emp_id)", [$empId]); // Check if the employee ID exists in assign_emp_id
                }
            })
            ->get();
    
        foreach ($jobroles as $jobrole) {
            $currentEmpIds = explode(',', $jobrole->assign_emp_id); // Get current employee IDs as an array
            $updatedEmpIds = array_diff($currentEmpIds, $req->assign_emp_id); // Remove conflicting IDs
            $jobrole->assign_emp_id = implode(',', $updatedEmpIds); // Convert back to a comma-separated string
            $jobrole->save(); // Save the updated job role
        }
    
        // Update the current job role
        $data = Jobroles::find($id);
        $data['name'] = $req->name;
        $data['assign_emp_id'] = $empid; // Update with the new list of employee IDs
        $data->save();
        
        Goal::whereIn('employee_id', $req->assign_emp_id)->update(['job_role_id' => $data->id]);
        EmployeeDetail::whereIn('user_id', $req->assign_emp_id)->update(['jobrole_id' => $data->id]);
    

        // Log the update activity
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "JobRole Data Updated By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/JobRole/update/' . $id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
    
        LogActivity::create($Log);
    
        return redirect('Employee/JobRole/home')->with('success', "JobRole Edit Successfully");
    }
    
    

    public function delete(Request $request,$id)
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "JobRole Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/JobRole/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        Jobroles::find($id)->delete();
        return redirect('Employee/JobRole/home')->with('success', "JobRole Deleted Successfully");
    }


}
