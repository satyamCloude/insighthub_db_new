<?php

namespace App\Http\Controllers\Employee;

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
use App\Models\Attendence;
use App\Models\StorageSetting;
use Illuminate\Support\Facades\Storage;
use App\Models\Ticket;
use App\Models\Leave;
use App\Models\Jobroles;
use App\Models\Project;
use App\Models\Weekly;
use App\Models\Status;
use App\Models\User;
use App\Models\Role;
use App\Models\Task;
use App\Models\PayRoll;
use App\Models\TimeSheet;
use App\Models\RoleAccess;
use Hash;
use Session;
use Illuminate\Support\Facades\File as FileFacade;
use App\Models\Folder;
use Auth;
use Mail;
use Validator;
use Carbon\Carbon;
use DB;
use DateTime;
use DateInterval;


class EEmployeeController extends Controller
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

        if($RoleAccess[array_search('Employee', array_column($RoleAccess, 'per_name'))]['view'] == 1)
        {
            $query = $request->input('search');

            $Employee = User::select('users.status', 'users.phone_number', 'departments.name as department_name', 
                    'users.profile_img', 'users.id', 'company_logins.company_name', 'users.first_name','users.last_name','users.email', 
                    'employee_details.working_type_id','employee_details.jobrole_id')
                    ->join('employee_details', 'employee_details.user_id', 'users.id')
                    ->join('company_logins', 'company_logins.id', 'employee_details.company_id')
                    ->join('departments', 'departments.id', 'employee_details.department_id')
                    ->where('users.type', '4')
                ->when($query, function ($query) use ($request) {
                    $query->where(function ($q) use ($request) {
                        $q->where('users.first_name', 'like', '%' . $request->input('search') . '%')
                            ->orWhere('users.email', 'like', '%' . $request->input('search') . '%')
                            ->orWhere('company_logins.company_name', 'like', '%' . $request->input('search') . '%')
                            ->orWhere('users.phone_number', 'like', '%' . $request->input('search') . '%')
                            ->orWhere('departments.name', 'like', '%' . $request->input('search') . '%');
                    });
                })
                ->orderBy('users.created_at', 'desc')
                ->paginate(10);

            $TotalEmployee = User::where('type', '4')->count();
            $Active = User::where('status', '1')->where('type', '4')->count();
            $Suspended = User::where('status', '2')->where('type', '4')->count();
            $Terminated = User::where('status', '3')->where('type', '4')->count();
            
        }

        if($RoleAccess[array_search('Employee', array_column($RoleAccess, 'per_name'))]['view'] == 2)
        {
            $query = $request->input('search');

            $Employee =  User::select('users.status', 'users.phone_number', 'departments.name as department_name', 'users.profile_img', 'users.id', 'company_logins.company_name', 'users.first_name','users.last_name','users.email', 'employee_details.working_type_id','employee_details.jobrole_id')
                    ->join('employee_details', 'employee_details.user_id', 'users.id')
                    ->join('company_logins', 'company_logins.id', 'employee_details.company_id')
                    ->join('departments', 'departments.id', 'employee_details.department_id')
                    ->where('users.type', '4')
                ->when($query, function ($query) use ($request) {
                    $query->where(function ($q) use ($request) {
                        $q->where('users.first_name', 'like', '%' . $request->input('search') . '%')
                            ->orWhere('users.email', 'like', '%' . $request->input('search') . '%')
                            ->orWhere('company_logins.company_name', 'like', '%' . $request->input('search') . '%')
                            ->orWhere('users.phone_number', 'like', '%' . $request->input('search') . '%')
                            ->orWhere('departments.name', 'like', '%' . $request->input('search') . '%');
                    });
                })
                ->orderBy('users.created_at', 'desc')
                ->where('employee_details.user_id',Auth::user()->id)
                ->paginate(10);

            $TotalEmployee = User::where('type', '4')->where('user_id',Auth::user()->id)->count();
            $Active = User::where('status', '1')->where('user_id',Auth::user()->id)->where('type', '4')->count();
            $Suspended = User::where('status', '2')->where('user_id',Auth::user()->id)->where('type', '4')->count();
            $Terminated = User::where('status', '3')->where('user_id',Auth::user()->id)->where('type', '4')->count();
                    
        }

        return view('Employee.Humanesources.Employee.home', compact('RoleAccess','Employee', 'TotalEmployee', 'Active', 'Suspended', 'Terminated'));
        
    }


    //Create
    public function Create(Request $request)
    {
        $Department = Department::select('id', 'name')->get();
        $Jobrole = Jobroles::select('id', 'name')->get();
        $Weekly = Weekly::select('id', 'name')->get();
        $Status = Status::select('id', 'status')->get();
        $TimeShift = TimeShift::select('id', 'shift_name', 'StartTime', 'EndTime')->get();
        $Teamlead = User::select('users.id', 'users.first_name','users.last_name','users.email', 'users.profile_img')->join('employee_details', 'employee_details.user_id', 'users.id')->where('employee_details.team_lead', 1)->get();
        $Role = Role::select('id', 'name')->get();
        $Permission = Permission::select('id', 'name')->get();
        $Company = CompanyLogin::find(1);

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Employee Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Employee/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);


        return view('Employee.Humanesources.Employee.create',compact('Department','Jobrole','Weekly','Status','Teamlead','TimeShift','Role','Permission','Company'));
    }

    //store function
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            
            'email' => 'required|string|email|max:255|unique:users',
            'login_email' => 'required|string|email|max:255|unique:users,login_email',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Validate net_salary
        $net_salary = $request->net_salary;
        if ($net_salary <= 0) {
            return redirect()->back()->withErrors('Net Salary must be greater than 0')->withInput();
        }

        // Determine base URL
        $url = url('/').'/public/images/';

        // Handle profile image upload
        $profileFilename = 'profile_img.jpg';
        if ($request->hasFile('profile_img')) {
            $rand = Str::random(4);
            $file = $request->file('profile_img');
            $extension = $file->getClientOriginalExtension();
            $profileFilename = 'emp_pro' . $rand . '.' . $extension;

            // Determine storage method based on StorageSetting
            $StorageSetting = StorageSetting::find(1);
            if ($StorageSetting->status == 1) {
                // Upload to S3
                $fileName = 'emp_pro' . $rand . '.' . $extension;
                $filePath = 'public/images/' . $fileName;
                $url = $this->uploadToS3($StorageSetting, $filePath, $file);
            } else {
                // Upload locally
                $file->move('public/images/', $profileFilename);
                $url = $url . $profileFilename;
            }
        }

        // Create new User
        $user = new User();
        $user->profile_img = $url;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->type = 4; 
        $user->status = $request->status; 
        $user->first_name = $request->first_name; 
        $user->last_name = $request->last_name; 
        $user->login_email = $request->login_email; 
        $user->login_password = $request->password; 
        $user->phone_number = $request->phone_number;
        $user->address = $request->address; 

        $user->save();

        // Create EmployeeDetail
        $employeeDetail = new EmployeeDetail();
        $employeeDetail->fill($request->all());
        $employeeDetail->company_id = 1;
        $employeeDetail->team_lead = $request->has('team_lead') ? 1 : 0;
        $employeeDetail->user_id = $user->id;
        $employeeDetail->save();

        // Create PayRoll entry
        $payroll = new PayRoll();
        $payroll->emp_id = $user->id;
        $payroll->net_salary = $request->net_salary;
        $payroll->save();
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Employee Data Store By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Employee/store';
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('Employee/Employee/home')->with('success', "New Employee Added Successfully");
    }

    // Method to upload file to S3
    private function uploadToS3($StorageSetting, $filePath, $file)
    {
        config([
            'filesystems.disks.s3.key' => $StorageSetting->AWS_ACCESS_KEY_ID,
            'filesystems.disks.s3.secret' => $StorageSetting->AWS_SECRET_ACCESS_KEY,
            'filesystems.disks.s3.region' => $StorageSetting->AWS_DEFAULT_REGION,
            'filesystems.disks.s3.bucket' => $StorageSetting->AWS_BUCKET,
        ]);

        $path = Storage::disk('s3')->put($filePath, $file);

        $url = $StorageSetting->S3_BASE_URL . '/' . $path;
        return $url;
    }

    public function check_email(Request $request)
    {
        $emailExists = User::where('email', $request->input('email'))->exists();
        
        return response()->json(['valid' => !$emailExists]);
    }


    //edit
    public function edit(Request $req, $id)
    {
        
        $Department = Department::select('id', 'name')->get();
        $Jobrole = Jobroles::select('id', 'name')->get();
        $Weekly = Weekly::select('id', 'name')->get();
        $Status = Status::select('id', 'status')->get();
        $TimeShift = TimeShift::select('id', 'shift_name', 'StartTime', 'EndTime')->get();
        $Teamlead = User::select('users.id', 'users.first_name','users.last_name','users.email', 'users.profile_img')
        ->join('employee_details', 'employee_details.user_id', 'users.id')
        ->where('employee_details.team_lead', 1)
        ->where('employee_details.user_id','!=' ,$id)
        ->get();
        $Role = Role::select('id', 'name')->get();
        $Permission = Permission::select('id', 'name')->get();
        $Company = CompanyLogin::find(1);
        $Employee = User::find($req->id);
        $EmployeeDetail = EmployeeDetail::where('user_id', $id)->first();


        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Employee Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Employee/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);
        return view('Employee.Humanesources.Employee.edit',compact('Department','Jobrole','Weekly','Status','TimeShift','Teamlead','Employee','Role','Permission','Company','EmployeeDetail'));
    }

  //updated
    public function update(Request $request, $id)
    {
        $checkLoginEmail = User::where('id','!=',$id)->where('login_email',$request->login_email)->count();
        
        $checkUserEmail = User::where('id','!=',$id)->where('email',$request->email)->count();
        $User = User::find($id);
        if (!$User) {
            return redirect()->back()->withErrors('User not found')->withInput();
        }

        if($checkLoginEmail>0){
            return redirect()->back()->withErrors('Login Email is already in use')->withInput();
        }elseif($checkUserEmail>0){
            return redirect()->back()->withErrors('Email is already in use')->withInput();
        
        }else{
            if ($request->password) {
                $User->password = Hash::make($request->password);
                $User->login_password = $request->password;
                $User->password_updateDate = now();
            }
        
            $Jobroles = Jobroles::find($request->jobrole_id);
            if ($Jobroles) {
                $assignEmpIds = explode(',', $Jobroles->assign_emp_id);
                if (!in_array($id, $assignEmpIds)) {
                    $assignEmpIds[] = $id;
                    $Jobroles->assign_emp_id = implode(',', $assignEmpIds);
                    $Jobroles->save();
                }
            }
        
            $User->gender = $request->gender;
            $User->first_name = $request->first_name;
            $User->last_name = $request->last_name;
            $User->phone_number = $request->phone_number;
            $User->email = $request->email;
            $User->type = '4'; // Ensure this is correct
            $User->status = $request->status;
            $User->login_email = $request->login_email;
            $User->address = $request->address; 

            // if ($request->hasFile('profile_img')) {
            //     $profileFilename = 'emp_pro' . Str::random(4) . '.' . $request->file('profile_img')->getClientOriginalExtension();
            //     $request->file('profile_img')->move(public_path('images'), $profileFilename);
            //     $User->profile_img = url('public/images/' . $profileFilename);
            // }else{
            //    $User->profile_img = $request->existing_profile_img;
            // }
            
            // Determine base URL
            $url = url('/').'/public/images/';

            // Handle profile image upload
            $profileFilename = 'profile_img.jpg';
            if($request->hasFile('profile_img')) {
                $rand = Str::random(4);
                $file = $request->file('profile_img');
                $extension = $file->getClientOriginalExtension();
                $profileFilename = 'emp_pro' . $rand . '.' . $extension;

                // Determine storage method based on StorageSetting
                $StorageSetting = StorageSetting::find(1);
                if ($StorageSetting->status == 1) {
                    // Upload to S3
                    $fileName = 'emp_pro' . $rand . '.' . $extension;
                    $filePath = 'public/images/' . $fileName;
                    $url = $this->uploadToS3($StorageSetting, $filePath, $file);
                } else {
                    // Upload locally
                    $file->move('public/images/', $profileFilename);
                    $url = $url . $profileFilename;
                }
            }else{
                //   $User->profile_img = $request->existing_profile_img;
                $User->profile_img = $User->profile_img;
            }

            $User->save();
        
            $EmpDetail = EmployeeDetail::where('user_id', $id)->first();
            if ($EmpDetail) {
                $EmpDetail->dob = $request->dob;
                $EmpDetail->marriage_anniversary = $request->marriage_anniversary;
                $EmpDetail->date_of_joining = $request->date_of_joining;
                $EmpDetail->net_salary = $request->net_salary;
                $EmpDetail->company_id = 1;
                $EmpDetail->department_id = $request->department_id;
                $EmpDetail->job_role_id = $request->job_role_id;
                $EmpDetail->jobrole_id = $request->jobrole_id;
                $EmpDetail->admin_type_id = $request->admin_type_id;
                $EmpDetail->permission_role_id = $request->permission_role_id;
                $EmpDetail->weekly_off_id = $request->weekly_off_id;
                $EmpDetail->additional_week_off_first = $request->additional_week_off_first;
                $EmpDetail->additional_week_off_second = $request->additional_week_off_second;
                $EmpDetail->additional_week_off_third = $request->additional_week_off_third;
                $EmpDetail->additional_week_off_fourth = $request->additional_week_off_fourth;
                $EmpDetail->team_lead_id = $request->team_lead_id;
                $EmpDetail->date_of_relieving = $request->date_of_relieving;
                $EmpDetail->working_type_id = $request->working_type_id;
                $EmpDetail->signature = $request->signature;
                $EmpDetail->shift_id = $request->shift_id;
                $EmpDetail->kra = $request->kra ?? '';
                $EmpDetail->team_lead = $request->has('team_lead') && $request->team_lead == 'on' ? 1 : 0;
                $EmpDetail->save();
            }
        
            $agent = new Agent();
            $Log = $request->all();
            $Log['user_id'] = Auth::user()->id;
            $Log['ip'] = $request->ip();
            $Log['subject'] = 'Employee Data Updated By ' . Auth::user()->first_name;
            $Log['url'] = url('/Employee/Employee/update/' . $id);
            $Log['method'] = 'Post';
            $Log['browser'] = $agent->browser() . '-' . $agent->version($agent->browser());
            LogActivity::create($Log);
        
            return redirect('Employee/Employee/home')->with('success', 'Employee Edit Successfully');
                
        }
    }

    public function updates2(Request $request, $id)
    {
        $checkLoginEmail = User::where('id','!=',$id)->where('login_email',$request->login_email)->count();
            
        $checkUserEmail = User::where('id','!=',$id)->where('email',$request->email)->count();
        $User = User::find($id);
            if (!$User) {
                return redirect()->back()->withErrors('User not found')->withInput();
            }

        if($checkLoginEmail>0){
            return redirect()->back()->withErrors('Login Email is already in use')->withInput();
        }elseif($checkUserEmail>0){
            return redirect()->back()->withErrors('Email is already in use')->withInput();
            
        }else{
            
            if ($request->password) {
                $User->password = Hash::make($request->password);
                $User->login_password = $request->password;
                $User->password_updateDate = now();
            }
        
            $Jobroles = Jobroles::find($request->jobrole_id);
            if ($Jobroles) {
                $assignEmpIds = explode(',', $Jobroles->assign_emp_id);
                if (!in_array($id, $assignEmpIds)) {
                    $assignEmpIds[] = $id;
                    $Jobroles->assign_emp_id = implode(',', $assignEmpIds);
                    $Jobroles->save();
                }
            }
        
            $User->gender = $request->gender;
            $User->first_name = $request->first_name;
            $User->last_name = $request->last_name;
            $User->phone_number = $request->phone_number;
            $User->email = $request->email;
            $User->type = '4'; // Ensure this is correct
            $User->status = $request->status;
            $User->login_email = $request->login_email;
            $User->address = $request->address; 

            // if ($request->hasFile('profile_img')) {
            //     $profileFilename = 'emp_pro' . Str::random(4) . '.' . $request->file('profile_img')->getClientOriginalExtension();
            //     $request->file('profile_img')->move(public_path('images'), $profileFilename);
            //     $User->profile_img = url('public/images/' . $profileFilename);
            // }else{
            //    $User->profile_img = $request->existing_profile_img;
            // }
            
            // Determine base URL
            $url = url('/').'/public/images/';

            // Handle profile image upload
            $profileFilename = 'profile_img.jpg';
            if ($request->hasFile('profile_img')) {
                $rand = Str::random(4);
                $file = $request->file('profile_img');
                $extension = $file->getClientOriginalExtension();
                $profileFilename = 'emp_pro' . $rand . '.' . $extension;

                // Determine storage method based on StorageSetting
                $StorageSetting = StorageSetting::find(1);
                if ($StorageSetting->status == 1) {
                    // Upload to S3
                    $fileName = 'emp_pro' . $rand . '.' . $extension;
                    $filePath = 'public/images/' . $fileName;
                    $url = $this->uploadToS3($StorageSetting, $filePath, $file);
                } else {
                    // Upload locally
                    $file->move('public/images/', $profileFilename);
                    $url = $url . $profileFilename;
                }
            }else{
                //   $User->profile_img = $request->existing_profile_img;
                $User->profile_img = $User->profile_img;
            }
        
            $User->save();
        
            $EmpDetail = EmployeeDetail::where('user_id', $id)->first();
            if ($EmpDetail) {
                $EmpDetail->dob = $request->dob;
                $EmpDetail->marriage_anniversary = $request->marriage_anniversary;
                $EmpDetail->date_of_joining = $request->date_of_joining;
                $EmpDetail->net_salary = $request->net_salary;
                $EmpDetail->company_id = 1;
                $EmpDetail->department_id = $request->department_id;
                $EmpDetail->job_role_id = $request->job_role_id;
                $EmpDetail->jobrole_id = $request->jobrole_id;
                $EmpDetail->admin_type_id = $request->admin_type_id;
                $EmpDetail->permission_role_id = $request->permission_role_id;
                $EmpDetail->weekly_off_id = $request->weekly_off_id;
                $EmpDetail->additional_week_off_first = $request->additional_week_off_first;
                $EmpDetail->additional_week_off_second = $request->additional_week_off_second;
                $EmpDetail->additional_week_off_third = $request->additional_week_off_third;
                $EmpDetail->additional_week_off_fourth = $request->additional_week_off_fourth;
                $EmpDetail->team_lead_id = $request->team_lead_id;
                $EmpDetail->date_of_relieving = $request->date_of_relieving;
                $EmpDetail->working_type_id = $request->working_type_id;
                $EmpDetail->signature = $request->signature;
                $EmpDetail->shift_id = $request->shift_id;
                $EmpDetail->kra = $request->kra ?? '';
                $EmpDetail->team_lead = $request->has('team_lead') && $request->team_lead == 'on' ? 1 : 0;
                $EmpDetail->save();
            }  

            $agent = new Agent();
            $browser = $agent->browser();
            $version = $agent->version($browser);
            $Log = $request->all();
            $Log['user_id'] = Auth::user()->id;
            $Log['ip'] = $request->ip();
            $Log['subject'] = "Employee Data Updated  By " . Auth::user()->first_name;
            $Log['url'] = url('/') . '/Employee/Employee/update/'.$id;
            $Log['method'] = "Post";
            $Log['browser'] = $browser . "-" . $version;
            LogActivity::create($Log);

            return redirect('Employee/Employee/home')->with('success', "Employee Updated Successfully");
        }  
    }

    // Helper function to format folder name
    private function formatFolderName($folderName)
    {
        // Replace spaces with underscores
        $folderName = str_replace(' ', '_', $folderName);
        // Replace hyphens with underscores
        $folderName = str_replace('-', '_', $folderName);
        // Replace any consecutive underscores with a single underscore
        $folderName = preg_replace('/_+/', '_', $folderName);
        return $folderName;
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
        $Log['url'] = url('/') . '/Employee/Employee/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        User::find($id)->delete();
        EmployeeDetail::where('user_id',$id)->delete();
        return redirect('Employee/Employee/home')->with('success', "Employee Deleted Successfully");
    }

    public function view(Request $request, $id)
    {
        if (Session::get('TabViews') == '' || Session::get('TabViews') == null) {
            Session::put('TabViews', 'Profile');
        }

        return view('Employee.Humanesources.Employee.view', compact('id'));
    }

    public function TabView(Request $request)
    {
        // return $request->all();
        if ($request->type == 'Profile') {
            Session::put('TabViews', 'Profile');
            $Profile = User::select('departments.name as department_name','users.address', 'users.first_name','users.last_name','users.email','users.id', 'users.profile_img','users.login_at', 'users.gender', 'users.phone_number', 'users.email', 'employee_details.dob', 'employee_details.marriage_anniversary','jobroles.name as desg', 'employee_details.team_lead','employee_details.jobrole_id', 'employee_details.job_role_id', 'users.updated_at', 'employee_details.kra')
                ->leftjoin('employee_details', 'employee_details.user_id', 'users.id')
                ->leftjoin('departments', 'departments.id', 'employee_details.department_id')
                ->leftjoin('roles', 'roles.id', 'employee_details.job_role_id')
                ->leftjoin('jobroles', 'jobroles.id', 'employee_details.jobrole_id')
                ->where('users.type', 4)
                ->where('users.id', $request->id)
                ->first();

            $OpenTask = Task::where('status_id', 1)
                ->where('AssignedTo', 'LIKE', "%$request->id%")
                ->count();
            $Projects = Project::where('team_id', 'LIKE', "%$request->id%")->count();
            $Tickets = Ticket::where('ccid', 'LIKE', "%$request->id%")->count();

            $TTask = Task::where('status_id', 1)
                ->where('AssignedTo', 'LIKE', "%$request->id%")
                ->get();
            $TTicket = Ticket::where('ccid', 'LIKE', "%$request->id%")->get();

                 // Initialize ReportingTo and ReportingTeam as null
            $ReportingTo = null;
            $ReportingTeam = null;
            
            
            // Fetch the team lead's details
            $ReportingTo = EmployeeDetail::select('users.first_name', 'users.last_name')
                ->leftJoin('users', 'users.id', 'employee_details.team_lead_id')
                ->where('employee_details.user_id',  $request->id)
                ->first();
            
            
            // Fetch the department name
            $ReportingTeam = EmployeeDetail::select('departments.name')
                ->leftJoin('departments', 'departments.id', '=', 'employee_details.department_id')
                ->where('employee_details.user_id', $request->id)
                ->first();

            $RTTicket = Ticket::where('ccid', 'LIKE', "%$request->id%")->get();
            $RTTask = Task::where('status_id', 1)
                ->where('AssignedTo', 'LIKE', "%$request->id%")
                ->get();
            $currentDate = Carbon::now()->toDateString(); // Get the current date
    
            // Retrieve the shift information for the logged-in user
            $shiftInfo = DB::table('employee_details as e')
                ->leftJoin('time_shifts as ts', 'ts.id', '=', 'e.shift_id')
                ->where('e.user_id',  $request->id) // Assuming the user ID is stored in the 'emp_id' field
                ->select('ts.*')
                ->first();
            
            // Calculate shift duration
            if ($shiftInfo) {
                $startTime = $shiftInfo->StartTime;
                $endTime = $shiftInfo->EndTime;
            
                // Assuming startTime and endTime are in HH:MM:SS format
                $startTime = \Carbon\Carbon::parse($startTime);
                $endTime = \Carbon\Carbon::parse($endTime);
            
                // Calculate shift duration
                $shiftDuration = $endTime->diff($startTime)->format('%H:%I');
            
                // Convert shift duration to seconds
                $shiftDurationInSeconds = $endTime->diffInSeconds($startTime);
            } else {
                // Handle case when user does not have a shift assigned
                $shiftDuration = "0.00";
                $shiftDurationInSeconds = 0; // Set default value
            }
            
                // Retrieve punch-in and punch-out times for the logged-in user
            $punchTimes = DB::table('attendences')
                ->where('emp_id',  $request->id)
                ->where('punch_date', $currentDate)
                ->whereNotNull('punch_out')
                ->orderBy('punch_in')
                ->pluck('punch_in')
                ->toArray();
            
            // Initialize variables to store total break time
            $totalBreakSeconds = 0;
            $lastPunchTime = null;
            
            // Iterate through punch times to calculate break time
            foreach ($punchTimes as $punchTime) {
                // If last punch time is set, calculate break time
                if ($lastPunchTime !== null) {
                    // Convert punch times to Carbon instances
                    $lastPunchTime = \Carbon\Carbon::parse($lastPunchTime);
                    $currentPunchTime = \Carbon\Carbon::parse($punchTime);
                    
                    // Calculate break time between consecutive punch times
                    $breakTimeSeconds = $currentPunchTime->diffInSeconds($lastPunchTime);
                    
                    // Exclude break time if it's greater than or equal to the duration of a shift (assumed not to be a break)
                    if ($breakTimeSeconds < $shiftDurationInSeconds) {
                        $totalBreakSeconds += $breakTimeSeconds;
                    }
                }
                // Update last punch time
                $lastPunchTime = $punchTime;
            }

            $RTTicket = Ticket::where('ccid', 'LIKE', "%$request->id%")->get();
            $RTTask = Task::where('status_id', 1)
                ->where('AssignedTo', 'LIKE', "%$request->id%")
                ->get();
                $RTTask = Task::where('status_id', 1)
                ->where('AssignedTo', 'LIKE', "%$request->id%")
                ->get();
                        
            // Get the current month start and end dates
            $startOfMonth = Carbon::now()->startOfMonth();
            $endOfMonth = Carbon::now()->endOfMonth();
            
            $employeeId = $request->id; // Assuming employee ID is provided in the request
            
            // Get the current month start and end dates
            $startOfMonth = Carbon::now()->startOfMonth();
            $endOfMonth = Carbon::now()->endOfMonth();
            
            // Get employee's shift details
            $shift = EmployeeDetail::leftJoin('time_shifts', 'time_shifts.id', 'employee_details.shift_id')
                                    ->where('employee_details.id', $employeeId)
                                    ->select('time_shifts.StartTime') // Make sure 'StartTime' is the correct column name
                                    ->first();
            
            if (!$shift) {
                $shift = [];
            }
            
            $shiftStartTime = $shift->StartTime ?? '00:00:00'; 
            
            // Get attendance records for the given employee in the current month
            $attendances = Attendence::where('emp_Id', $employeeId)
                                        ->whereBetween('punch_date', [$startOfMonth, $endOfMonth])
                                        ->get();
            
            // Array to keep track of late days
            $lateDays = [];
            
            foreach ($attendances as $attendance) {
                $punchInTime = Carbon::parse($attendance->punch_in);
                $shiftStart = Carbon::parse($shiftStartTime);
            
                // Check if the employee was late
                if ($punchInTime->greaterThan($shiftStart)) {
                    // Add the date to the lateDays array if the employee was late
                    $lateDays[] = Carbon::parse($attendance->punch_date)->toDateString();
                }
            }
                
                // Remove duplicate dates
            $uniqueLateDays = array_unique($lateDays);
                
                // Count the number of unique late days
            $totalLateDays = count($uniqueLateDays);
                


            $role =  Jobroles::where('id',$Profile->jobrole_id)->value('name');
            $totalLeaveTaken =  Leave::where('user_id',$request->id)->count();


            return view('Employee.Humanesources.Employee.Profile', compact('Profile', 'OpenTask','lastPunchTime', 'Projects','totalLeaveTaken','totalLateDays', 'Tickets', 'TTask', 'TTicket', 'ReportingTeam', 'ReportingTo', 'RTTicket', 'RTTask','role'));
        }

        // if($request->type == 'Projects')
        // {
        //     Session::put('TabViews','Projects');
        //     $teamIdToFind = $request->id;

        //     $Projects =  Project::select(
        //                             'client_details.id as client_details_id',
        //                             'company_logins.company_name',
        //                             'users.profile_img as project_manager_picture',
        //                             'users.first_name as project_manager_name',
        //                             'projects.deadline',
        //                             'projects.start_date',
        //                             'projects.status_pro',
        //                             'projects.team_id',
        //                             'projects.id',
        //                             'projects.deadline',
        //                             'projects.status_id',
        //                             'projects.project_name'
        //                         )
        //                         ->leftjoin('users', 'users.id', '=', 'projects.client_id')
        //                         ->leftjoin('client_details', 'client_details.user_id', '=', 'users.id')
        //                         ->leftjoin('company_logins', 'client_details.company_id', '=', 'company_logins.id')
        //                         ->orderBy('projects.created_at', 'desc')
        //                         ->where('team_id', 'LIKE', "%$teamIdToFind%")
        //                         ->get();
        //     return view('Employee.Humanesources.Employee.Project',compact('Projects'));
        // }
        // if($request->type == 'Tasks')
        // {
        //     Session::put('TabViews','Tasks');
        //     $AssignedToFind = $request->id;

        //     $Task = Task::select('users.profile_img as project_manager_picture', 'users.first_name as project_manager_name', 'tasks.deadline', 'tasks.status_pro', 'tasks.team_id', 'tasks.id', 'tasks.deadline', 'tasks.status_id','tasks.startDate','tasks.endDate','tasks.completed_on', 'tasks.project_id', 'tasks.task_name')
        //             ->join('users', 'users.id', '=', 'tasks.user_id')
        //             ->orderBy('tasks.created_at', 'desc')
        //             ->where('AssignedTo', 'LIKE', "%$AssignedToFind%")
        //             ->get();

        //     return view('Employee.Humanesources.Employee.Task',compact('Task'));
        // }

        // if($request->type == 'Leaves')
        // {
        //     Session::put('TabViews','Leaves');
        //     $AssignedToFind = $request->id;
        //     $Leave = Leave::select('users.first_name','leaves.duration','leaves.date','leave_types.leave_type','leaves.start_date','leaves.id','leaves.status')
        //         ->leftjoin('users','leaves.emp_Id','users.id')
        //         ->leftjoin('leave_types','leaves.leavetype_id','leave_types.id')
        //         ->where('leaves.emp_Id', 'LIKE', "%$AssignedToFind%")
        //         ->orderBy('leaves.created_at', 'desc')
        //         ->get();
        //     return view('Employee.Humanesources.Employee.Leave',compact('Leave'));
        // }

        // if($request->type == 'Timesheet')
        // {
        //     Session::put('TabViews','Timesheet');
        //     $AssignedToFind = $request->id;

        //    $TimeSheet = TimeSheet::select('time_sheets.id','time_sheets.emp_id','tasks.task_name as taskname','time_sheets.start_time', 'time_sheets.end_time','time_sheets.total_hours')
        //         ->leftjoin('tasks','time_sheets.task_id','tasks.id')
        //             ->where('time_sheets.emp_Id', 'LIKE', "%$AssignedToFind%")
        //             ->orderBy('time_sheets.created_at', 'desc')
        //             ->get();

        //     return view('Employee.Humanesources.Employee.Timesheet',compact('TimeSheet'));
        // }

        // if($request->type == 'Ticket')
        // {
        //     Session::put('TabViews','Ticket');
        //     $AssignedToFind = $request->id;

        //    $Ticket = Ticket::where('ccid', 'LIKE', "%$AssignedToFind%")
        //             ->orderBy('created_at', 'desc')
        //             ->get();

        //     return view('Employee.Humanesources.Employee.Ticket',compact('Ticket'));
        // }

        // if($request->type == 'ShiftRoster')
        // {
        //     Session::put('TabViews','ShiftRoster');
        //     $AssignedToFind = $request->id;
        //     $TimeShift = TimeShift::select('time_shifts.id', 'time_shifts.shift_name', 'time_shifts.StartTime', 'time_shifts.EndTime', 'time_shifts.working_hours')
        //             ->leftjoin('employee_details','employee_details.shift_id','time_shifts.id')
        //             ->where('employee_details.user_id', 'LIKE', "%$AssignedToFind%")
        //             ->get();
        //     return view('Employee.Humanesources.Employee.TimeShift',compact('TimeShift'));
        // }

        if ($request->type == 'Permissions') {
            Session::put('TabViews', 'Permissions');
            $AssignedToFind = $request->id;
            $RoleAccess = RoleAccess::leftjoin('employee_details', 'employee_details.admin_type_id', 'role_accesses.role_id')
                ->leftjoin('permissions', 'permissions.id', 'role_accesses.permission_id')
                ->leftjoin('roles', 'roles.id', 'role_accesses.role_id')
                ->where('employee_details.user_id', 'LIKE', "%$AssignedToFind%")
                ->get();
            $Permission = Permission::select('name', 'guard_name', 'id')->get();
            
            $empDetials = EmployeeDetail::where('user_id',$AssignedToFind)->first();
            $Role = Role::find($empDetials->job_role_id);
            $RoleAccess = RoleAccess::
                        leftjoin('permissions','permissions.id','role_accesses.permission_id')
                        ->where('role_accesses.role_id',$empDetials->job_role_id)
                        ->get();
             return view('Employee.Humanesources.Employee.Permissions', compact('Permission', 'RoleAccess','Role'));
        }
           

        if ($request->type == 'Activity') {
            Session::put('TabViews', 'Activity');
            $AssignedToFind = $request->id;
            $LogActivity = LogActivity::where('user_id', 'LIKE', "%$AssignedToFind%")->get();
            return view('Employee.Humanesources.Employee.Activity', compact('LogActivity'));
        }

        if ($request->type == 'KRA') {
            Session::put('TabViews', 'KRA');
            $AssignedToFind = $request->id;

            $kra = EmployeeDetail::where('user_id', 'LIKE', "%$AssignedToFind%")->value('kra');

            return view('Employee.Humanesources.Employee.kra', compact('kra'));
        }
        if ($request->type == 'Attendance') {
            Session::put('TabViews', 'Attendance');
            $id=$request->id;
            $attendances = Attendence::join('employee_details as e', 'attendences.emp_id', '=', 'e.user_id')
                        ->join('time_shifts as ts', 'e.shift_id', '=', 'ts.id')
                        ->whereYear('attendences.punch_date', date('Y'))
                        ->whereMonth('attendences.punch_date',  date('m'))
                        ->select('attendences.*','ts.working_hours as ts_working_hrs',
                            DB::raw('(TIMESTAMPDIFF(MINUTE, attendences.punch_in, attendences.punch_out) / 60) as working_hours')
                        )
                        ->where('attendences.emp_id', $id)
                        ->paginate(10);
            return view('Employee.Humanesources.Employee.attendance', compact('id','attendances'));
        }
        if ($request->type == 'Leaves') {
            Session::put('TabViews', 'Leaves');
            $AssignedToFind = $request->id;
            
            // $kra = EmployeeDetail::where('user_id', 'LIKE', "%$AssignedToFind%")->value('kra');
            
            //  $leaves= Leave::find($AssignedToFind);
            $leaves= User::find($AssignedToFind);
            $id = $leaves->id;
            $query = Leave::select('leave_accesses.approved_by', 'leave_accesses.sendBySatus','users.first_name','users.last_name','users.email', 'users.profile_img', 'leaves.duration', 'leaves.user_id', 'leaves.date','leaves.status', 'leave_types.leave_type', 'leaves.start_date', 'leaves.id', 'leaves.emp_Id', 'employee_details.job_role_id as RoleID')
                ->leftJoin('users', 'leaves.emp_Id', 'users.id')
                ->leftJoin('employee_details', 'employee_details.user_id', 'leaves.emp_Id')
                ->leftJoin('leave_types', 'leaves.leavetype_id', 'leave_types.id')
                ->leftJoin('leave_accesses', 'leaves.id', 'leave_accesses.leave_id')
                ->where('leaves.emp_Id',$id)
                ->orderBy('leaves.created_at', 'desc');
        
            $searchTerm = '';
        
            // Check if a search term is provided
            if ($request->has('search')) {
                $searchTerm = $request->input('search');
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('users.first_name', 'like', '%' . $searchTerm . '%')
                        ->orWhere('leave_types.leave_type', 'like', '%' . $searchTerm . '%')
                        ->orWhere('leaves.duration', 'like', '%' . $searchTerm . '%')
                        ->orWhere('leaves.start_date', 'like', '%' . $searchTerm . '%')
                        ->orWhere('leaves.end_date', 'like', '%' . $searchTerm . '%')
                        ->orWhere('leaves.status', 'like', '%' . $searchTerm . '%')
                        ->orWhere('leaves.emp_Id', 'like', '%' . $searchTerm . '%');
                });
            }
           // Apply filtering based on from and to dates
            if ($request->has('from') && $request->has('to')) {
                $fromDate = $request->input('from');
                $toDate = $request->input('to');
                $query->whereBetween('leaves.date', [$fromDate, $toDate]);
            }
             // Check if status is provided in the URL
            if ($request->has('status')) {
                $status = $request->input('status');
                if ($status !== '0') { // If status is not 0, filter by status
                    $query->where('leaves.status', $status);
                }
            }
        
            $Leave = $query->paginate(10);
            $Leave->appends(['search' => $searchTerm]);
        
            $LeaveType = LeaveType::get();
        
            $user_details = User::find($id);
            $AuthRoles = 1;
            
            return view('Employee.Humanesources.Employee.Leave', compact('Leave','LeaveType','user_details','AuthRoles','searchTerm','id'));
        }
    }
    


}






















