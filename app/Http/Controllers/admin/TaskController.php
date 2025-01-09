<?php

namespace App\Http\Controllers\admin;

use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;
use App\Models\OperatingSysten;
use App\Models\PaymentMethod;   
use Illuminate\Http\Request;
use App\Exports\TaskExport; 
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use Illuminate\Support\Str;
use App\Models\IPAddress;
use App\Models\Countrys;
use App\Models\EmployeeDetail;
use App\Models\Currency;   
use App\Models\TaskCategory;   
use App\Models\Firewall;
use App\Models\Product;
use App\Models\Switchs;
use App\Models\Status;
use App\Models\User;
use App\Models\Rack;
use App\Models\TaskTimer;   
use App\Models\Task;   
use App\Models\Project;   
use Hash;
use Auth;
use App\Events\AppEvents;


class TaskController extends Controller
{   


    // Home page
public function home(Request $request)
{
    $query = Task::select('users.profile_img as project_manager_picture', 'users.first_name as project_manager_name', 'tasks.deadline', 'tasks.status_pro', 'tasks.team_id', 'tasks.id', 'tasks.deadline', 'tasks.status_id','tasks.startDate','tasks.endDate','tasks.completed_on', 'tasks.project_id', 'tasks.task_name') // Fixed: Added 'tasks.task_name'
        ->join('users', 'users.id', '=', 'tasks.user_id')
        ->orderBy('tasks.created_at', 'desc');

    $search = '';    

    // Check if there is a search query
    if ($request->has('search')) {
        $search = $request->input('search');
        $query->where(function ($q) use ($search) {
            $q->where('users.first_name', 'LIKE', '%' . $search . '%')
                ->orWhere('tasks.task_name', 'LIKE', '%' . $search . '%') // Fixed: Changed 'tasks.project_name' to 'tasks.task_name'
                ->orWhere('tasks.deadline', 'LIKE', '%' . $search . '%')
                ->orWhere('tasks.status_pro', 'LIKE', '%' . $search . '%');
        });
    }
        $Project = Project::select('project_name','id')->get();

    $Task = $query->paginate(10);
    $Task->appends(['search' => $search]);    
    $InProgress = Task::where('status_id', 1)->count();
    $Completed = Task::where('status_id', 2)->count();
    $OverDue = Task::where('status_id', 3)->count();
    $TaskCategory = TaskCategory::where('user_id', Auth::user()->id)->get();
    $Cancel = Task::where('status_id', 4)->count();

    return view('admin.Task.home', compact('Task', 'InProgress', 'Completed', 'OverDue', 'Cancel', 'search', 'TaskCategory','Project'));
}




    //home page
    public function Create(Request $request)
    {   
        $Employee =  User::
            leftjoin('employee_details','employee_details.user_id','users.id')
            ->leftjoin('jobroles','jobroles.id','employee_details.jobrole_id')
            ->where('users.type', '4')
            ->select('users.*','jobroles.name as jobrole')
            ->get();
        $Project = Project::select('project_name','id')->get();

        $TaskCategory = TaskCategory::where('user_id', Auth::user()->id)->get();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Task Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Task/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('admin.Task.create',compact('Employee','Project','TaskCategory')); 
    }


    //home page
    public function store(Request $req)
    {
        $url = url('/').'/public/images/';
        
        // Process Document
        $Addfile = 'default_Addfile.jpg';
        if ($req->hasFile('Addfile')) {
            $rand = Str::random(4);
            $file = $req->file('Addfile');
            $extension = $file->getClientOriginalExtension();
            $Addfile = 'bill_'.$rand.'.'.$extension;
            $file->move('public/images/', $Addfile);
        }



        $AssignedTo = implode(",", $req->AssignedTo);
        $data = $req->all();
        $data['Addfile'] = $url . $Addfile;
        $data['user_id'] = Auth::user()->id;
        $data['AssignedTo'] = $AssignedTo;
        $task = Task::create($data);
        
             
            // Create the task

            if ($task) {
                // Convert comma-separated string back to array
                $assignedToIds = explode(",", $assignedTo);
            
                // Send notification to each ID
                foreach ($assignedToIds as $userId) {
                    // Validate user ID if necessary
                    if (is_numeric($userId) && User::find($userId)) {
                        event(new AppEvents($userId, 'New task assigned #' . $task->id));
                    }
                }
            } else {
                // Handle the case where task creation fails
                // For example, you can log an error or return a response indicating failure
                Log::error('Task creation failed.');
                return response()->json(['error' => 'Task creation failed'], 500);
            }

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Task Data Store By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Task/store';
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);
        
        return redirect('admin/Task/home')->with('success', "New Task Added Successfully");
    }

    //edit
    public function edit(Request $req,$id)
    {
        $Task = Task::find($id);
        $Vendor = User::select('id','first_name')->where('type','3')->get();
        $Client = User::select('id','first_name')->where('type','2')->get();
        $Employee =User::
            leftjoin('employee_details','employee_details.user_id','users.id')
            ->leftjoin('jobroles','jobroles.id','employee_details.jobrole_id')
            ->where('users.type', '4')
            ->select('users.*','jobroles.name as jobrole')
            ->get();
        $Project = Project::select('project_name','id')->get();
        $TaskCategory = TaskCategory::where('user_id', Auth::user()->id)->get();
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Task Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Task/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('admin.Task.edit',compact('Task','Vendor','Employee','Client','Project','TaskCategory'));
    } 
    //edit
 public function GetTask(Request $req)
{
    // Check if project_id is present in the request
    if ($req->has('project_id')) {
        $Task = Task::where('project_id', $req->project_id)->get(); // Don't forget to call get() to execute the query and retrieve the results
        return response()->json(['status' => true, 'data' => $Task], 200);
    } else {
        // Return an error response if project_id is not present
        return response()->json(['status' => false, 'message' => 'Project ID is missing'], 400);
    }
} 
public function startTimer(Request $req)
{

    $currentDate = now()->toDateString(); // Use Laravel's built-in now() function to get the current date
    if ($req->has('project_id') && $req->has('task_id')) {
        $userId = Auth::id();
        $countRunningTaskTimer = TaskTimer::where(['timer_date' => $currentDate, 'run_status' => 1])->count();

        $taskTimer = new TaskTimer([
            'user_id' => $userId,
            'project_id' => $req->project_id,
            'task_id' => $req->task_id,
            'memo' => $req->memo,
            'timer_date' => 1,
            'run_status' => 1,
            'timer_date' => date('Y-m-d'), // You may adjust this based on your requirement
            'start_time' => now(), // You may adjust this based on your requirement
        ]);
        if($countRunningTaskTimer > 0){
       // $taskTimer->save();

        }else{

        $taskTimer->save();
        }

        // Convert start_time to a timestamp
        $taskTimer->start_time = strtotime($taskTimer->start_time);
       $taskTimer->start_time = date('H:i:s', $taskTimer->start_time);

        // Return the response with the modified TaskTimer instance
        return response()->json(['status' => true, 'message' => 'Timer started successfully', 'data' => $taskTimer], 200);
    } else {
        return response()->json(['status' => false, 'message' => 'Project ID or Task ID is missing', 'data' =>''], 400);
    }
}
public function checkStartTimer(Request $request)
{
    try {
        $currentDate = now()->toDateString();

        // Use the TaskTimer model to query the database
        $countRunningTaskTimer = TaskTimer::where(['timer_date' => $currentDate, 'run_status' => 1])->count();
        $getRunningTaskTimer = TaskTimer::where(['timer_date' => $currentDate, 'run_status' => 1])->first();

        return response()->json([
            'status' => true,
            'message' => 'Timer status retrieved successfully',
            'countRunningTaskTimer' => $countRunningTaskTimer,
            'getRunningTaskTimer' => $getRunningTaskTimer,
        ], 200);
    } catch (\Exception $e) {
        // Handle exceptions, log errors, etc.
        return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
    }
}

public function stopTimer(Request $req)
{
    if ($req->has('project_id') && $req->has('task_id') && $req->has('timer_u_id')) {
        $userId = Auth::id();
        $taskTimer = TaskTimer::find($req->timer_u_id);
        if ($taskTimer) {
            $taskTimer->update([
                'user_id' => $userId,
                'run_status' => 0,
                'timer_date' => date('Y-m-d'), // You may adjust this based on your requirement
                'stop_time' => now(), // You may adjust this based on your requirement
            ]);

            return response()->json(['status' => true, 'message' => 'Timer stopped successfully', 'data' => $taskTimer], 200);
        } else {
            return response()->json(['status' => false, 'message' => 'Timer not found', 'data' => ''], 404);
        }
    } else {
        return response()->json(['status' => false, 'message' => 'Project ID or Task ID is missing', 'data' => ''], 400);
    }
}

    //updated
   public function update(Request $req, $id)
{
    $url = url('/').'/public/images/';

    // Process Document
    $Addfile = 'default_Addfile.jpg';
    if ($req->hasFile('Addfile')) {
        $rand = Str::random(4);
        $file = $req->file('Addfile');
        $extension = $file->getClientOriginalExtension();
        $Addfile = 'bill_'.$rand.'.'.$extension;
        $file->move('public/images/', $Addfile);
    }

    $AssignedTo = implode(",", $req->AssignedTo);
    $data = $req->all();
    $data['Addfile'] = $url . $Addfile;
    $data['AssignedTo'] = $AssignedTo;

    // Find the task by id and update its attributes
    $task = Task::find($id);
         
            // Create the task

            if ($task) {
                // Convert comma-separated string back to array
                $assignedToIds = explode(",", $assignedTo);
            
                // Send notification to each ID
                foreach ($assignedToIds as $userId) {
                    // Validate user ID if necessary
                    if (is_numeric($userId) && User::find($userId)) {
                        event(new AppEvents($userId, 'New task assigned #' . $task->id));
                    }
                }
            } else {
                // Handle the case where task creation fails
                // For example, you can log an error or return a response indicating failure
                Log::error('Task creation failed.');
                return response()->json(['error' => 'Task creation failed'], 500);
            }
    if ($task) {
        $task->update($data);

        // Log activity for the update
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Task Data Updated By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Task/update/' . $id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('admin/Task/home')->with('success', "Task Updated Successfully");
    }

    return redirect('admin/Task/home')->with('error', "Task not found");
}

     public function delete(Request $request,$id)
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Task Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Task/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        Task::find($id)->delete();
        return redirect('admin/Task/home')->with('success', "Task Deleted Successfully");
    }

      // ExportCSV
    public function EXPORTCSV(Request $request)
    {
         $agent = new Agent();
            $browser = $agent->browser();
            $version = $agent->version($browser);
            $Log = $request->all();
            $Log['user_id'] = Auth::user()->id;
            $Log['ip'] = $request->ip();
            $Log['subject'] = "Task CSV Export  By " . Auth::user()->first_name;
            $Log['url'] = url('/') . '/admin/Task/EXPORTCSV';
            $Log['method'] = "Get";
            $Log['browser'] = $browser . "-" . $version;
            LogActivity::create($Log);


        return Excel::download(new TaskExport, 'Task.csv');
    }

      // UpdateStatus
public function UpdateStatus(Request $request)
{
    if ($request->status == "progress") {
        $Task = Task::find($request->id);
        $Task->status_pro = $request->status_pro;
        if ($request->status_pro == 100) {
            $Task->status_id = 2;
        } else {
            $Task->status_id = 1;
        }
        $Task->save();
    } elseif ($request->status == "stu") {
        $Task = Task::find($request->id);
        $Task->status_id = $request->status_pro;
        if ($request->status_pro == "2") {
            $Task->completed_on = date('Y-m-d');
        }
        $Task->save(); // Move this line outside the if block
    }

    return response()->json(['success' => true]);
}


}
