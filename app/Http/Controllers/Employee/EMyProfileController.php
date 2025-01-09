<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use App\Models\PaymentMethod;  
use App\Models\CompanyLogin;
use App\Models\EmployeeDetail;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use App\Models\Ticket;
use App\Models\Project;
use Illuminate\Support\Str;
use App\Models\Currency;
use App\Models\Task;
use App\Models\StorageSetting;
use Illuminate\Support\Facades\Storage;
use App\Models\Country;
use App\Models\Quotes;
use App\Models\Status;
use App\Models\State;
use App\Models\Role;
use App\Models\User;
use App\Models\City;
use Hash;
use Auth;
use Session;

class EMyProfileController extends Controller
{
    public function index(Request $req)
    {
      $id = Auth::user()->id;
      $user = User::find($id);
      $EmployeeDetail = EmployeeDetail::where('user_id',$id)->first();
      $Ticket = Ticket::where('client_id', $id)->get(); 
      $Country = Country::find($EmployeeDetail->country);
      $State = State::find($EmployeeDetail->state);
      $City = City::find($EmployeeDetail->city);
      $Company = CompanyLogin::select('company_name')->where('id',$EmployeeDetail->company_id)->first();
      $TotalProject = Project::where('client_id', $id)->count();
      $projects = Project::where('client_id', $id)->get();
      $LastLog = LogActivity::where('user_id', $id)->first();
      $LogActivity = LogActivity::where('user_id', $id)->get();
      $LastloginLogActivity = LogActivity::where('user_id', $id)->orderBy('created_at', 'desc')->first();

      $quotes = Quotes::where('company_id', $EmployeeDetail->company_id)->where('status', 1)->get();
           $tasks = Task::leftJoin('projects', 'projects.id', '=', 'tasks.project_id')
          ->where('tasks.client_id', $id)
          ->get();

      return view('Employee.MyProfile.index',compact('LastloginLogActivity', 'LogActivity', 'LastLog', 'quotes', 'tasks', 'projects','Country','user','State','City','EmployeeDetail','Company','TotalProject','id','Ticket'));
    }

    //edit
    public function edit(Request $req)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $EmployeeDetail = EmployeeDetail::where('user_id',$id)->first();
        $Role = Role::get();
        $Country = Country::get();
        $State = State::find($EmployeeDetail->state);
        $City = City::find($EmployeeDetail->city);
        $Currency = Currency::get();
        $Company = CompanyLogin::select('id','company_name')->get();
        $Status = Status::get();
        $PaymentMethod = PaymentMethod::get();


         $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Client Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Client/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('Employee.MyProfile.edit',compact('Country','user','State','City','Currency','Company','Status','PaymentMethod','EmployeeDetail','Role'));
    }
       public function Upload($StorageSetting, $fileName, $file)
    {
        config([
            'filesystems.disks.s3.key' => $StorageSetting->AWS_ACCESS_KEY_ID,
            'filesystems.disks.s3.secret' => $StorageSetting->AWS_SECRET_ACCESS_KEY,
            'filesystems.disks.s3.region' => $StorageSetting->AWS_DEFAULT_REGION,
            'filesystems.disks.s3.bucket' => $StorageSetting->AWS_BUCKET,
        ]);

        $basePath = 'images/'.date('y').'/'.date('m').'/' . $fileName;
        
        $path = Storage::disk('s3')->put($basePath, $file);

        $url =  $StorageSetting->S3_BASE_URL. '/' . $path;
        return $url;
    }
    //updated
    public function update(Request $req)
{
    $id = Auth::user()->id;
    $User = User::find($id);

    $StorageSetting = StorageSetting::find(1);
    $storageLocal = $StorageSetting->status == 0;

    // Base URL for local storage
    $localBaseUrl = url('/public/images/');

    // Handle file uploads for profile_img
    if ($req->hasFile('profile_img')) {
        $profileFilename = 'profile_' . Str::random(4) . '.' . $req->file('profile_img')->getClientOriginalExtension();

        if ($storageLocal) {
            // Store in local public folder
            $req->file('profile_img')->move('public/images/', $profileFilename);
            $User->profile_img = $localBaseUrl . '/' . $profileFilename;
        } else {
            // Store in S3
            $filePath = $this->Upload($StorageSetting, $profileFilename, $req->file('profile_img'));
            $User->profile_img = $filePath;
        }
    }

    $User['gender'] = $req->gender;
    $User['first_name'] = $req->first_name;
    $User['last_name'] = $req->last_name;
    $User['phone_number'] = $req->phone_number;
    $User['email'] = $req->email;
    $User['password'] = Hash::make($req->password);
    $User->save();

    $agent = new Agent();
    $browser = $agent->browser();
    $version = $agent->version($browser);
    $Log = $req->all();
    $Log['user_id'] = Auth::user()->id;
    $Log['ip'] = $req->ip();
    $Log['subject'] = "Client Data Updated By " . Auth::user()->first_name;
    $Log['url'] = url('/') . '/MyProfile/update/' . $id;
    $Log['method'] = "Post";
    $Log['browser'] = $browser . "-" . $version;
    LogActivity::create($Log);

    return redirect('Employee/MyProfile')->with('success', "Client Edit Successfully");
}

    public function updateOld(Request $req)
    {
        $id = Auth::user()->id;
        $User =User::find($id);

            $StorageSetting = StorageSetting::find(1);
            $storageLocal = $StorageSetting->status == 0;
        $url = url('/').'/public/images/';
        
             // Handle file uploads for profile_img
            if ($req->hasFile('profile_img')) {
                $profileFilename = 'profile_' . Str::random(4) . '.' . $req->file('profile_img')->getClientOriginalExtension();
                $req->file('profile_img')->move('public/images/', $profileFilename);
                $User->profile_img = url('/public/images/') . '/' . $profileFilename;
            }
        $User['gender'] = $req->gender;
        $User['first_name'] = $req->first_name;
        $User['last_name'] = $req->last_name;
        $User['phone_number'] = $req->phone_number;
        $User['email'] = $req->email;
        $User['password'] = Hash::make($req->password);
        $User->save();   

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Client Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/MyProfile/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('Employee/MyProfile')->with('success', "Client Edit Successfully");
    }

    //get state data thorugh ajex
    public function Get_StateData(Request $req)
    {
        $State = State::where('country_id',$req->countryid)->get();
        return response()->json(['status'=>200,'success'=>true,'states'=>$State]); 
    }
    //get city data thorugh ajex
    public function Get_CityData(Request $req)
    {
        $City = City::where('state_id',$req->stateid)->get();
        return response()->json(['status'=>200,'success'=>true,'citys'=>$City]); 
    }

    public function changePassword(Request $request)
    {
        $id = Auth::user()->id;
        $user =User::find($id);
      

            // Validate the form data
            $request->validate([
                'newPassword' => 'required',
                'confirmPassword' => 'required|same:newPassword',
            ]);

            // Update the user's password
            $user->update([
                'password' => Hash::make($request->input('newPassword')),
            ]);


            $agent = new Agent();
            $browser = $agent->browser();
            $version = $agent->version($browser);
            $Log = $request->all();

            $Log['user_id'] = $id; // Use the obtained $id value here
            $Log['ip'] = $request->ip();
            $Log['subject'] = "Task Edit Page is Viewed By " . $user->first_name;
            $Log['url'] = url('/') . '/admin/Task/edit/' . $id;
            $Log['method'] = "Get";
            $Log['browser'] = $browser . "-" . $version;
            LogActivity::create($Log);

             return response()->json(['status' => true, 'message' => 'Password updated successfully.'], 200);


    }


     public function TabView(Request $request)
    {

        if($request->type == 'Profile')
        {
            Session::put('TabViews','Profile');
            $Profile = User::select('departments.name as department_name','users.first_name','users.last_name','users.address as uaddrss','users.id','users.profile_img','users.gender','users.phone_number','users.email','employee_details.dob','employee_details.marriage_anniversary','employee_details.team_lead','users.updated_at','employee_details.kra')
                            ->leftjoin('employee_details','employee_details.user_id','users.id')
                            ->leftjoin('departments','departments.id','employee_details.department_id')
                            ->where('users.type',4)->where('users.id',$request->id)->first();
            $OpenTask = Task::where('status_id',1)->where('AssignedTo', 'LIKE', "%$request->id%")->count();
            $Projects = Project::where('team_id', 'LIKE', "%$request->id%")->count();
            $Tickets = Ticket::where('ccid', 'LIKE', "%$request->id%")->count();

            $TTask = Task::where('status_id',1)->where('AssignedTo', 'LIKE', "%$request->id%")->get();
            $TTicket = Ticket::where('ccid', 'LIKE', "%$request->id%")->get();
            if($Profile && $Profile->team_lead != 0){
               $ReportingTo = EmployeeDetail::select('users.first_name')->leftjoin('users','users.id','employee_details.user_id')
            ->leftjoin('departments','departments.id','employee_details.department_id')
            ->where('employee_details.team_lead',1)->first();  
            }else{
                 $ReportingTo = EmployeeDetail::select('users.first_name')->leftjoin('users','users.id','employee_details.team_lead_id')
            ->where('employee_details.user_id',$request->id)->first();
                
            }
           
            $ReportingTeam = EmployeeDetail::select('departments.name')->leftjoin('departments','departments.id','employee_details.department_id')->where('employee_details.user_id',Auth::user()->id)->first();

            $RTTicket =Ticket::where('ccid', 'LIKE', "%$request->id%")->get();
            $RTTask = Task::where('status_id',1)->where('AssignedTo', 'LIKE', "%$request->id%")->get();


            return view('Employee.MyProfile.Profile',compact('Profile','OpenTask','Projects','Tickets','TTask','TTicket','ReportingTeam','ReportingTo','RTTicket','RTTask'));
        }

        if($request->type == 'Projects')
        {
            Session::put('TabViews','Projects');
            $teamIdToFind = $request->id;

            $Projects =  Project::select(
                                    'client_details.id as client_details_id',
                                    'company_logins.company_name',
                                    'users.profile_img as project_manager_picture',
                                    'users.first_name as project_manager_name',
                                    'projects.deadline',
                                    'projects.start_date',
                                    'projects.status_pro',
                                    'projects.team_id',
                                    'projects.id',
                                    'projects.deadline',
                                    'projects.status_id',
                                    'projects.project_name'
                                )
                                ->leftjoin('users', 'users.id', '=', 'projects.client_id')
                                ->leftjoin('client_details', 'client_details.user_id', '=', 'users.id')
                                ->leftjoin('company_logins', 'client_details.company_id', '=', 'company_logins.id')
                                ->orderBy('projects.created_at', 'desc')
                                ->where('team_id', 'LIKE', "%$teamIdToFind%")
                                ->get();
            return view('Employee.MyProfile.Project',compact('Projects'));
        }
        if($request->type == 'Tasks')
        {
            Session::put('TabViews','Tasks');
            $AssignedToFind = $request->id;

            $Task = Task::select('users.profile_img as project_manager_picture', 'users.first_name as project_manager_name', 'tasks.deadline', 'tasks.status_pro', 'tasks.team_id', 'tasks.id', 'tasks.deadline', 'tasks.status_id','tasks.startDate','tasks.endDate','tasks.completed_on', 'tasks.project_id', 'tasks.task_name')
                    ->join('users', 'users.id', '=', 'tasks.user_id')
                    ->orderBy('tasks.created_at', 'desc')
                    ->where('AssignedTo', 'LIKE', "%$AssignedToFind%")
                    ->get();

            return view('Employee.MyProfile.Task',compact('Task'));
        }

        if($request->type == 'Leaves')
        {
            Session::put('TabViews','Leaves');
            $AssignedToFind = $request->id;
            $Leave = Leave::select('users.first_name','leaves.duration','leaves.date','leave_types.leave_type','leaves.start_date','leaves.id','leaves.status')
                ->leftjoin('users','leaves.emp_Id','users.id')
                ->leftjoin('leave_types','leaves.leavetype_id','leave_types.id')
                ->where('leaves.emp_Id', 'LIKE', "%$AssignedToFind%")
                ->orderBy('leaves.created_at', 'desc')
                ->get();
            return view('Employee.MyProfile.Leave',compact('Leave'));
        }

        if($request->type == 'Timesheet')
        {
            Session::put('TabViews','Timesheet');
            $AssignedToFind = $request->id;

           $TimeSheet = TimeSheet::select('time_sheets.id','time_sheets.emp_id','tasks.task_name as taskname','time_sheets.start_time', 'time_sheets.end_time','time_sheets.total_hours')
                ->leftjoin('tasks','time_sheets.task_id','tasks.id')
                    ->where('time_sheets.emp_Id', 'LIKE', "%$AssignedToFind%")
                    ->orderBy('time_sheets.created_at', 'desc')
                    ->get();

            return view('Employee.MyProfile.Timesheet',compact('TimeSheet'));
        }

        if($request->type == 'Ticket')
        {
            Session::put('TabViews','Ticket');
            $AssignedToFind = $request->id;

           $Ticket = Ticket::where('ccid', 'LIKE', "%$AssignedToFind%")
                    ->orderBy('created_at', 'desc')
                    ->get();

            return view('Employee.MyProfile.Ticket',compact('Ticket'));
        }

        if($request->type == 'ShiftRoster')
        {
            Session::put('TabViews','ShiftRoster');
            $AssignedToFind = $request->id;
            $TimeShift = TimeShift::select('time_shifts.id', 'time_shifts.shift_name', 'time_shifts.StartTime', 'time_shifts.EndTime', 'time_shifts.working_hours')
                    ->leftjoin('employee_details','employee_details.shift_id','time_shifts.id')
                    ->where('employee_details.user_id', 'LIKE', "%$AssignedToFind%")
                    ->get();
            return view('Employee.MyProfile.TimeShift',compact('TimeShift'));
        }

        if($request->type == 'Permissions')
        {
            Session::put('TabViews','Permissions');
            $AssignedToFind = $request->id;
            $RoleAccess = RoleAccess::
                        leftjoin('employee_details','employee_details.job_role_id','role_accesses.role_id')
                        ->leftjoin('permissions','permissions.id','role_accesses.permission_id')
                        ->leftjoin('roles','roles.id','role_accesses.role_id')
                        ->where('employee_details.user_id', 'LIKE', "%$AssignedToFind%")
                        ->get();
            $Permission = Permission::select('name','guard_name','id')->get();
            return view('Employee.MyProfile.Permissions',compact('Permission','RoleAccess'));
        }

        if($request->type == 'Activity')
        {
            Session::put('TabViews','Activity');
            $AssignedToFind = $request->id;
            $LogActivity = LogActivity::where('user_id', 'LIKE', "%$AssignedToFind%")->get();
            return view('Employee.MyProfile.Activity',compact('LogActivity'));
        }


    }
}
