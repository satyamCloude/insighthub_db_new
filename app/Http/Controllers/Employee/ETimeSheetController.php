<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use App\Models\TimeSheet;
use App\Models\Task;
use App\Models\Project;
use App\Models\User;
use Hash;
use Auth;


class ETimeSheetController extends Controller
{   
    //home page
  public function home(Request $request)
{

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
    
        if($RoleAccess[array_search('TimeSheet', array_column($RoleAccess, 'per_name'))]['view'] == 1)
        {
            $query = TimeSheet::select('time_sheets.id','time_sheets.emp_id', 'tasks.task_name as taskname','time_sheets.start_time', 'time_sheets.end_time','time_sheets.total_hours')
            ->leftjoin('tasks','time_sheets.task_id','tasks.id')
                ->orderBy('time_sheets.created_at', 'desc');
            $searchTerm = '';

            // Check if a search term is provided
            if ($request->has('search')) {
                $searchTerm = $request->input('search');
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('tasks.project_name', 'like', '%' . $searchTerm . '%')
                      ->orWhere('users.first_name', 'like', '%' . $searchTerm . '%')
                      ->orWhere('time_sheets.start_time', 'like', '%' . $searchTerm . '%')
                      ->orWhere('time_sheets.end_time', 'like', '%' . $searchTerm . '%')
                      ->orWhere('time_sheets.total_hours', 'like', '%' . $searchTerm . '%');
                });
            }
            $TimeSheet = $query->paginate(10);
             $TimeSheet->appends(['search' => $searchTerm]);
            
        }

        if($RoleAccess[array_search('TimeSheet', array_column($RoleAccess, 'per_name'))]['view'] == 2)
        {
            $query = TimeSheet::select('time_sheets.id','time_sheets.emp_id', 'tasks.task_name as taskname','time_sheets.start_time', 'time_sheets.end_time','time_sheets.total_hours')
            ->leftjoin('tasks','time_sheets.task_id','tasks.id')
                ->where('time_sheets.user_id',Auth::user()->id)
                ->orderBy('time_sheets.created_at', 'desc');
            $searchTerm = '';

            // Check if a search term is provided
            if ($request->has('search')) {
                $searchTerm = $request->input('search');
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('tasks.project_name', 'like', '%' . $searchTerm . '%')
                      ->orWhere('users.first_name', 'like', '%' . $searchTerm . '%')
                      ->orWhere('time_sheets.start_time', 'like', '%' . $searchTerm . '%')
                      ->orWhere('time_sheets.end_time', 'like', '%' . $searchTerm . '%')
                      ->orWhere('time_sheets.total_hours', 'like', '%' . $searchTerm . '%');
                });
            }
            $TimeSheet = $query->paginate(10);
             $TimeSheet->appends(['search' => $searchTerm]);
                    
        }
    return view('Employee.Humanesources.TimeSheet.home', compact('RoleAccess','TimeSheet','searchTerm'));
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
        $Log['subject'] = "TimeSheet Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/TimeSheet/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        $Employee = User::select('first_name','id')->where('type',4)->get();
        $Task = Task::select('task_name','id')->get();
        $Project = Project::select('project_name','id')->get();
        // return $Project;
        return view('Employee.Humanesources.TimeSheet.create',compact('Employee','Task','Project')); 
    }


    //home page
    public function store(Request $req)
    {   

        $data = $req->all();
        $empid = implode(",", (array)$data['emp_id']);
        $data['user_id'] = Auth::user()->id;
        $data['emp_id'] = $empid;
        TimeSheet::create($data);


        
            $agent = new Agent();
            $browser = $agent->browser();
            $version = $agent->version($browser);
            $Log = $req->all();
            $Log['user_id'] = Auth::user()->id;
            $Log['ip'] = $req->ip();
            $Log['subject'] = "TimeSheet Data Store By " . Auth::user()->first_name;
            $Log['url'] = url('/') . '/Employee/TimeSheet/store';
            $Log['method'] = "Post";
            $Log['browser'] = $browser . "-" . $version;
            LogActivity::create($Log);        

        return redirect('Employee/TimeSheet/home')->with('success', "New TimeSheet Added Successfully");
    }

    //edit
    public function edit(Request $req,$id)
    {
        $TimeSheet = TimeSheet::find($id);
        $Employee = User::select('first_name','id')->where('type',4)->get();
        $Task = Task::select('task_name','id')->where('user_id',Auth::user()->id)->get();
        $Project = Project::select('project_name','id')->where('user_id',Auth::user()->id)->get();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "TimeSheet Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/TimeSheet/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('Employee.Humanesources.TimeSheet.edit',compact('TimeSheet','Employee','Task','Project'));
    }

    //updated
    public function update(Request $req,$id)
    {
     
        $data =TimeSheet::find($id);
        if (is_array($req->emp_id))
        {
            $empid = implode(",", $req->emp_id);
        }
        $data['project_id'] = $req->project_id;
        $data['task_id'] = $req->task_id;
        $data['emp_id'] = $empid;
        $data['start_date'] = $req->start_date;
        $data['start_time'] = $req->start_time;
        $data['end_date'] = $req->end_date;
        $data['end_time'] = $req->end_time;
        $data['memo'] = $req->memo;
        $data['total_hours'] = $req->total_hours;
        $data->save();    

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "TimeSheet Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/TimeSheet/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('Employee/TimeSheet/home')->with('success', "TimeSheet Edit Successfully");
    }

     public function delete(Request $request,$id)
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "TimeSheet Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/TimeSheet/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        TimeSheet::find($id)->delete();
        return redirect('Employee/TimeSheet/home')->with('success', "TimeSheet Deleted Successfully");
    }


}
