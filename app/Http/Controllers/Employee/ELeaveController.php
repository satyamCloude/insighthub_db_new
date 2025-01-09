<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use App\Models\LeaveType;
use App\Models\Employee;
use App\Models\Leave;
use App\Models\User;
use App\Models\Template;
use App\Models\EmployeeDetail;
use App\Models\LeaveAccess;
use App\Events\SingleEvent;
use App\Events\AppEvents;
use Illuminate\Support\Facades\Mail;
use App\Mail\TicketMail;

use Hash;
use Auth;
use DateTime;
use DB;


class ELeaveController extends Controller
{   
    //home page
    public function home(Request $request)
    {
        $fromDate = request()->input('fromDate', null);
        $toDate = request()->input('toDate', null);
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

        if($RoleAccess[array_search('Leave', array_column($RoleAccess, 'per_name'))]['view'] == 1)
        {
            $query = Leave::select('users.first_name','users.email','users.last_name','users.profile_img','leaves.*','leave_types.leave_type','employee_details.job_role_id as RoleID','employee_details.jobrole_id as jobrole_id')
                    ->leftjoin('users','leaves.user_id','users.id')
                    ->leftjoin('employee_details','employee_details.user_id','leaves.user_id')
            ->leftjoin('leave_types','leaves.leavetype_id','leave_types.id')
            ->orderBy('leaves.created_at', 'desc');
            $searchTerm ='';

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
                    ->orWhere('leaves.user_id', 'like', '%' . $searchTerm . '%');
                });
            }
            $Leave = $query->paginate(5);
            $Leave->appends(['search' => $searchTerm]);
            $LeaveType = LeaveType::get();
            $workfromhome = Leave::select('users.first_name','users.last_name','users.profile_img','roles.name as roles','leaves.start_date','leaves.duration','leaves.date')
                ->join('users','users.id','leaves.user_id')
                ->join('employee_details','employee_details.user_id','leaves.user_id')
                ->join('roles','employee_details.job_role_id','roles.id')
                ->where('leaves.apply_for','2')
                ->orderBy('leaves.created_at', 'desc')
                ->paginate(5);
                
            $todayonleave = Leave::select('users.first_name','users.last_name','roles.name as roles','users.profile_img','leaves.start_date','leaves.duration','leaves.date')
                ->join('users','users.id','leaves.user_id')
                ->join('employee_details','employee_details.user_id','leaves.user_id')
                ->join('roles','employee_details.job_role_id','roles.id')
                ->where('leaves.apply_for','1')
                ->where('leaves.date',date('Y-m-d'))
                ->orderBy('leaves.created_at', 'desc')
                ->paginate(5);
            $todayonleaveCount = Leave::select('users.first_name','users.last_name','roles.name as roles','users.profile_img','leaves.start_date','leaves.duration','leaves.date')
                ->join('users','users.id','leaves.user_id')
                ->join('employee_details','employee_details.user_id','leaves.user_id')
                ->join('roles','employee_details.job_role_id','roles.id')
                ->where('leaves.apply_for','1')
                ->orderBy('leaves.created_at', 'desc')
                ->count();
             $workfromhomeCount =Leave::select('users.first_name','users.last_name','roles.name as roles','users.profile_img','leaves.start_date','leaves.duration','leaves.date')
                ->join('users','users.id','leaves.user_id')
                ->join('employee_details','employee_details.user_id','leaves.user_id')
                ->join('roles','employee_details.job_role_id','roles.id')
                ->where('leaves.apply_for','2')
                ->orderBy('leaves.created_at', 'desc')
                ->count();

        }
        if($RoleAccess[array_search('Leave', array_column($RoleAccess, 'per_name'))]['view'] == 2)
        {
            $query = Leave::select('users.first_name','users.email','users.last_name','users.profile_img','leaves.*','leave_types.leave_type','employee_details.job_role_id as RoleID','employee_details.jobrole_id as jobrole_id')
                    ->leftjoin('users','leaves.user_id','users.id')
                    ->leftjoin('employee_details','employee_details.user_id','leaves.user_id')
                    ->leftjoin('leave_types','leaves.leavetype_id','leave_types.id')
                    ->leftjoin('leave_accesses','leaves.id','leave_accesses.leave_id')
                    ->where('leaves.user_id',Auth::user()->id)
                    ->orderBy('leaves.created_at', 'desc')
                    ->distinct('leaves.id');
            $searchTerm ='';
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
                    ->orWhere('leaves.approved_by', 'like', '%' . $searchTerm . '%');
                });
            }
            $Leave = $query->paginate(10);
            $Leave->appends(['search' => $searchTerm]);
            $LeaveType = LeaveType::get();
            $workfromhome = Leave::select('users.first_name','users.last_name','roles.name as roles','users.profile_img','leaves.start_date','leaves.duration','leaves.date')
                ->join('users','users.id','leaves.user_id')
                ->join('employee_details','employee_details.user_id','leaves.user_id')
                ->join('roles','employee_details.job_role_id','roles.id')
                ->where('leaves.apply_for','2')
                ->orderBy('leaves.created_at', 'desc')
                ->where('leaves.user_id',Auth::user()->id)
                ->paginate(10);
            $todayonleave = Leave::select('users.first_name','users.last_name','users.profile_img','roles.name as roles','leaves.start_date','leaves.duration','leaves.date')
                ->join('users','users.id','leaves.user_id')
                ->join('employee_details','employee_details.user_id','leaves.user_id')
                ->join('roles','employee_details.job_role_id','roles.id')
                ->where('leaves.apply_for','1')
                ->orderBy('leaves.created_at', 'desc')
                ->where('leaves.user_id',Auth::user()->id)
                ->paginate(10);
               
                
            $todayonleaveCount = Leave::select('users.first_name','users.last_name','users.profile_img','leaves.start_date','leaves.duration','leaves.date')
                ->join('users','users.id','leaves.user_id')
                ->where('leaves.apply_for','1')
                ->orderBy('leaves.created_at', 'desc')
                ->where('leaves.user_id',Auth::user()->id)
                ->count();
                
            $workfromhomeCount = Leave::select('users.first_name','users.profile_img','leaves.start_date','leaves.duration','leaves.date')
                ->join('users','users.id','leaves.user_id')
                ->where('leaves.apply_for','2')
                ->orderBy('leaves.created_at', 'desc')
                ->where('leaves.user_id',Auth::user()->id)
                ->count();
     
            $leaveTypeCounts = Leave::select('leavetype_id', DB::raw('COUNT(*) as count'))
                ->groupBy('leavetype_id')
                ->where('leaves.user_id',Auth::user()->id)
                ->whereMonth('leaves.date', now()->month) // Filter by current month
                ->pluck('count', 'leavetype_id');
        
            // Calculate total leaves
            $totalLeaves = $leaveTypeCounts->sum();
        
            // Calculate percentages
            $leaveTypePercentages = [];
            foreach ($LeaveType as $type) {
                $leaveTypeId = $type->id;
                $count = isset($leaveTypeCounts[$leaveTypeId]) ? $leaveTypeCounts[$leaveTypeId] : 0;
                $percentage = $totalLeaves > 0 ? ($count / $totalLeaves) * 100 : 0;
                $leaveTypePercentages[$leaveTypeId] = $percentage;
            }
            $totalPercentage = array_sum($leaveTypePercentages);

        }
    
        $user_details = User::find(Auth::user()->id);

                        
        $myleaves = Leave::select('users.first_name','users.last_name','users.profile_img','leaves.start_date','roles.name as roles','leaves.duration','leaves.*','leave_types.leave_type')
                ->join('users','users.id','leaves.user_id')
                ->join('employee_details','employee_details.user_id','leaves.user_id')
                ->join('roles','employee_details.job_role_id','roles.id')
                ->join('leave_types','leave_types.id','leaves.leavetype_id')
                ->where('leaves.user_id',Auth::user()->id)
                ->orWhere('leaves.user_id',Auth::user()->id)
                ->orderBy('leaves.created_at', 'desc')
                ->limit(5)
                ->get();
            
            

        $AuthRole = EmployeeDetail::select('job_role_id','team_lead')->where('user_id',Auth::user()->id)->first();
        if($AuthRole && $AuthRole->job_role_id != 2 && $AuthRole->team_lead == 1)
        {
            //team lead emp
            // $requestedLeaves = Leave::select('users.first_name', 'users.profile_img', 'users.email', 'users.last_name', 'leaves.*','employee_details.job_role_id as RoleID','leave_accesses.toGo','leave_types.leave_type','employee_details.jobrole_id as jobrole_id')
            //             ->leftjoin('users','leaves.user_id','users.id')
            //             ->leftjoin('employee_details','employee_details.user_id','leaves.user_id')
            //             ->leftjoin('leave_types','leave_types.id','leaves.leavetype_id')
            //             ->leftjoin('leave_accesses','leave_accesses.leave_id','leaves.id')
            //             ->where('leaves.user_id','!=',Auth::user()->id)
            //             ->where('employee_details.team_lead_id',Auth::user()->id)
            //             ->where('leave_accesses.approved_by','!=',Auth::user()->id)
            //             ->where('leave_accesses.toGo',3)
            //             ->whereMonth('leaves.date',date('m'))
            //             ->whereYear('leaves.date',date('Y'))
                        
            //             ->orderBy('leaves.id','desc')
            //             ->groupBy('leaves.id')
            //              ->paginate(10);
           $query = Leave::select('users.first_name','users.last_name','users.profile_img', 'users.email', 'users.last_name', 
                       'leaves.*', 'employee_details.job_role_id as RoleID', 
                       'leave_types.leave_type', 'leave_accesses.status as leave_accesses_status')
                ->leftJoin('users', 'leaves.user_id', '=', 'users.id')
                ->leftJoin('employee_details', 'employee_details.user_id', '=', 'leaves.user_id')
                ->leftJoin('leave_types', 'leave_types.id', '=', 'leaves.leavetype_id')
                ->leftJoin('leave_accesses', 'leave_accesses.leave_id', '=', 'leaves.id')
                ->where('leaves.user_id', '!=', Auth::user()->id)
                ->where('employee_details.team_lead_id', Auth::user()->id)
                ->where('leave_accesses.approved_by', '!=', Auth::user()->id)
                ->where('leave_accesses.toGo', 3)
                ->whereMonth('leaves.date', date('m'))
                ->whereYear('leaves.date', date('Y'));
            // Apply date range filter if dates are provided
            if ($fromDate && $toDate) {
                $query->whereBetween('leaves.date', [$fromDate, $toDate]);
            }
            $requestedLeaves = $query->orderBy('leaves.id', 'desc')->paginate(10);
            $approveCount = Leave::where('leaves.status', '1')->where('leaves.user_id',Auth::user()->id)->count();
            $allLeaves = Leave::select('users.first_name','leaves.*')->where('leaves.user_id', Auth::user()->id)
                    ->join('users','users.id','leaves.user_id')
                    ->where('leaves.user_id', Auth::user()->id)
                    ->orderBy('leaves.created_at', 'desc')
                    ->get();
            $unapproveCount = Leave::where('leaves.status', '2')->where('leaves.user_id',Auth::user()->id)->count();
            $PendingCount = Leave::where('leaves.status', '3')->where('leaves.user_id',Auth::user()->id)->count();
            $LeaveType = LeaveType::get();
            $leaveTypeCounts = Leave::select('leavetype_id', DB::raw('COUNT(*) as count'))
                ->groupBy('leavetype_id')
                ->where('leaves.user_id',Auth::user()->id)
               ->whereMonth('leaves.date', now()->month) // Filter by current month
                ->pluck('count', 'leavetype_id');
        
            // Calculate total leaves
            $totalLeaves = $leaveTypeCounts->sum();
        
            // Calculate percentages
            $leaveTypePercentages = [];
            foreach ($LeaveType as $type) {
                $leaveTypeId = $type->id;
                $count = isset($leaveTypeCounts[$leaveTypeId]) ? $leaveTypeCounts[$leaveTypeId] : 0;
                $percentage = $totalLeaves > 0 ? ($count / $totalLeaves) * 100 : 0;
                $leaveTypePercentages[$leaveTypeId] = $percentage;
            }
            $totalPercentage = array_sum($leaveTypePercentages);
        }else if($AuthRole && $AuthRole->job_role_id == 2)
        {
            $month = $request->input('months');
            $year = $request->input('year');
            $fromDate = $request->input('fromDate');
            $toDate = $request->input('toDate');

            // Initialize the query
            $query = Leave::select(
                    'users.first_name', 
                    'users.profile_img', 
                    'users.email', 
                    'users.last_name', 
                    'leaves.*',
                    'employee_details.job_role_id as RoleID',
                    'leave_types.leave_type',
                    'leave_accesses.status as leave_accesses_status',
                    'employee_details.jobrole_id as jobrole_id'
                )
                ->leftJoin('users', 'leaves.user_id', '=', 'users.id')
                ->leftJoin('employee_details', 'employee_details.user_id', '=', 'leaves.user_id')
                ->leftJoin('leave_types', 'leave_types.id', '=', 'leaves.leavetype_id')
                ->leftJoin('leave_accesses', 'leave_accesses.leave_id', '=', 'leaves.id');

            // Apply month and year filter if provided
            if ($month && $year) {
                $query->whereMonth('leaves.date', $month)
                    ->whereYear('leaves.date', $year);
            }

            // Apply date range filter if provided
            if ($fromDate && $toDate) {
                $query->whereBetween('leaves.date', [$fromDate, $toDate]);
            }

            // Apply role-based filtering
            if ($AuthRole->job_role_id == 1) {
                $query->where('leaves.user_id', '!=', Auth::id()) // Exclude own leaves
                    ->where('leave_accesses.approved_by', '!=', Auth::id()) // Exclude leaves already approved by this team lead
                    ->where('leave_accesses.toGo', 1); // Assuming 1 denotes leaves for team leads
            } elseif ($AuthRole->job_role_id == 2) {
                $query->where('leaves.user_id', '!=', Auth::id()) // Exclude own leaves
                    ->where('leave_accesses.approved_by', '!=', Auth::id()) // Exclude leaves already approved by this HR
                    ->where('leave_accesses.toGo', 2); // Assuming 2 denotes leaves for HR
            }

            // Get the filtered leave data with pagination
            $requestedLeaves = $query->orderBy('leaves.id', 'desc')
                                     ->groupBy('leaves.id')
                                     ->paginate(10);
        
            // Count different leave statuses based on the filtered data
            $approveCount = $requestedLeaves->filter(function ($leave) {
                return $leave->leave_accesses_status == 1; // Approved
            })->count();
        
            $unapproveCount = $requestedLeaves->filter(function ($leave) {
                return $leave->leave_accesses_status == 2; // Unapproved
            })->count();
        
            $PendingCount = $requestedLeaves->filter(function ($leave) {
                return $leave->leave_accesses_status == 3; // Pending
            })->count();
        
            
    
            // $approveCount = Leave::where('leaves.status', '1')->count();
                    
            // $unapproveCount = Leave::where('leaves.status', '2')->count();
                      
            // $PendingCount = Leave::where('leaves.status', '3')->count();
                                // return $requestedLeaves;
            $LeaveType = LeaveType::get();
                
            $leaveTypeCounts = Leave::select('leavetype_id', DB::raw('COUNT(*) as count'))
                ->groupBy('leavetype_id')
               ->whereMonth('leaves.date', now()->month) // Filter by current month
                ->pluck('count', 'leavetype_id');
        
            // Calculate total leaves
            $totalLeaves = $leaveTypeCounts->sum();
        
            // Calculate percentages
            $leaveTypePercentages = [];
            foreach ($LeaveType as $type) {
                $leaveTypeId = $type->id;
                $count = isset($leaveTypeCounts[$leaveTypeId]) ? $leaveTypeCounts[$leaveTypeId] : 0;
                $percentage = $totalLeaves > 0 ? ($count / $totalLeaves) * 100 : 0;
                $leaveTypePercentages[$leaveTypeId] = $percentage;
            }
            $totalPercentage = array_sum($leaveTypePercentages);
            $allLeaves = Leave::select('users.first_name','leaves.*')
                    ->join('users','users.id','leaves.user_id')
                    ->orderBy('leaves.created_at', 'desc')
                    ->get();     

        }else{
            //normal emp
            $requestedLeaves = [];
            $approveCount = Leave::where('leaves.status', '1')->where('leaves.user_id',Auth::user()->id)->count();
            
            $unapproveCount = Leave::where('leaves.status', '2')->where('leaves.user_id',Auth::user()->id)->count();
                
            $PendingCount = Leave::where('leaves.status', '3')->where('leaves.user_id',Auth::user()->id)->count();
            $allLeaves = Leave::select('users.first_name','leaves.*')->where('leaves.user_id', Auth::user()->id)
                ->join('users','users.id','leaves.user_id')
                ->where('leaves.user_id', Auth::user()->id)
                ->orderBy('leaves.created_at', 'desc')
                ->get();
            $LeaveType = LeaveType::get();

            $leaveTypeCounts = Leave::select('leavetype_id', DB::raw('COUNT(*) as count'))
                ->groupBy('leavetype_id')
                ->where('leaves.user_id',Auth::user()->id)
                ->whereMonth('leaves.date', now()->month) // Filter by current month
                ->pluck('count', 'leavetype_id');
        
            // Calculate total leaves
            $totalLeaves = $leaveTypeCounts->sum();
        
            // Calculate percentages
            $leaveTypePercentages = [];
            foreach ($LeaveType as $type) {
                $leaveTypeId = $type->id;
                $count = isset($leaveTypeCounts[$leaveTypeId]) ? $leaveTypeCounts[$leaveTypeId] : 0;
                $percentage = $totalLeaves > 0 ? ($count / $totalLeaves) * 100 : 0;
                $leaveTypePercentages[$leaveTypeId] = $percentage;
            }
            $totalPercentage = array_sum($leaveTypePercentages);
            
        }

        return view('Employee.Humanesources.Leave.home', compact('user_details','requestedLeaves','allLeaves','AuthRole','RoleAccess','Leave', 'LeaveType', 'workfromhome', 'todayonleave','searchTerm','todayonleaveCount','workfromhomeCount','leaveTypePercentages','totalPercentage','myleaves','unapproveCount','approveCount','PendingCount'));
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
        $Log['subject'] = "Leave Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Leave/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        $Employee = User::select('first_name','id')->where('id',Auth::user()->id)->where('type',4)->get();
        $LeaveType = LeaveType::get();
        return view('Employee.Humanesources.Leave.create',compact('Employee','LeaveType')); 
    }

    //home page
    public function addLeave(Request $request)
    { 
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Leave Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Leave/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);


        $Employee = User::select('first_name','id','last_name','profile_img')->where('type',4)->get();
        $LeaveType = LeaveType::get();
        return view('Employee.Humanesources.Leave.createLeave',compact('Employee','LeaveType')); 
    }

    //home page

    public function store(Request $req)
    {

        $Role = EmployeeDetail::select('job_role_id','admin_type_id','department_id')->where('user_id',Auth::user()->id)->first();
        $data = $req->all();
        if($req->duration == 1)
        { 
            $data['days'] = 1;
        }
        elseif($req->duration == 2)
        {
            $startDate = $req->start_date; 
            $endDate = $req->end_date;
            $startDateTime = new DateTime($startDate);
            $endDateTime = new DateTime($endDate);
            $interval = $startDateTime->diff($endDateTime);
            $daysBetween = $interval->days+1;
            $data['days'] = $daysBetween;
        }
        else
        {
        $data['days'] = ".50";
        }

        if($req->date)
        {
            $data['date'] = $req->date;
        }else
        {
            $data['date'] = $req->start_date;
        }
        if(!$req->start_date)
            { 
            $data['start_date'] = $req->date;
            $data['end_date'] = $req->date;
        }

        $data['leavetype_id'] = $req->leavetype_id; 
        $data['user_id'] = Auth::user()->id; 
        $data['emp_Id'] = Auth::user()->id; 
            
    
        $Leave = Leave::create($data);
        //hr
        if($Role && $Role->job_role_id == 2)
        {
        
            $NLeave = new LeaveAccess;
            $NLeave->user_id = $req->emp_Id;    
            $NLeave->leave_id = $Leave->id;      
            $NLeave->approved_by = 1;
            $NLeave->sendBySatus = 1;       
            $NLeave->status = 3; 
            $NLeave->toGo = 1;      
            $NLeave->save();       
        }


        //team lead
        $Roleteamlead = EmployeeDetail::select('user_id')->where('team_lead',1)->where('user_id',Auth::user()->id)->where('department_id',$Role->department_id)->first();
        
        if($Role && $Role->job_role_id != 2 && $Roleteamlead)
        {

            $NLeave = new LeaveAccess;
            $NLeave->user_id = $req->emp_Id;    
            $NLeave->leave_id = $Leave->id;      
            $NLeave->status = 3;      
            $NLeave->toGo = 2;      
            $NLeave->save();


            $NLeave = new LeaveAccess;
            $NLeave->user_id = $req->emp_Id;    
            $NLeave->leave_id = $Leave->id;      
            $NLeave->sendBySatus = 1;      
            $NLeave->status = 3;      
            $NLeave->toGo = 1;      
            $NLeave->save();
            
            
            // Retrieve all HR user IDs
            $hrUserIds = EmployeeDetail::where('department_id', 4)
                ->pluck('user_id');
            
            // Retrieve all Team Lead user IDs (excluding department_id 4)
            $teamLeadUserIds = EmployeeDetail::where('team_lead', 1)
                ->where('department_id', '!=', 4)
                ->pluck('user_id');
            
            // Dispatch events to HR users
            foreach ($hrUserIds as $userId) {
                event(new AppEvents($userId, 'New Leave for approval #' . $Leave->id));
                if ($userId) {
                    $templateSettings = Template::where('name', 'New Leave Request Approval')->first();
                    $userDetail2 = User::find($userId);
                    $EmpName = User::find(Auth::user()->id);
                    if ($templateSettings && $userDetail2 && $EmpName) {
                        $subject = $templateSettings->subject;
                        $header = $templateSettings->header;
                        $template = $templateSettings->template;
                        $footer = $templateSettings->footer;
                        // Prepare email template
                        $subject = str_replace(
                            '[Employee Name]',  $EmpName->first_name,
                            $templateSettings->subject
                        );
                        // Replace placeholders in the email template
                        $replacementsTemplate = [
                            '{Employee Name}' => $userDetail2->first_name,
                            '[dates]' => $Leave->date,
                            '[Employee Name]' => $EmpName->first_name,
                            '[Approval Name]' => $userDetail2->first_name,
                            '[Company Name]' => 'CloudTechtiq',
                        ];
                        $template = str_replace(array_keys($replacementsTemplate), array_values($replacementsTemplate), $template);
        
                    

                        Mail::to('nilanjana@b2y.in')->send(new TicketMail($subject, $header, $template, $footer));
                        Mail::to($userDetail2->email)->send(new TicketMail($subject, $header, $template, $footer));
                    }
                }
            }
                
                
        }else{

            $NLeave = new LeaveAccess;
            $NLeave->user_id = $req->emp_Id;    
            $NLeave->leave_id = $Leave->id;      
            $NLeave->status = 3;
            $NLeave->sendBySatus = 1;       
            $NLeave->toGo = 3;      
            $NLeave->save();


            $NLeave = new LeaveAccess;
            $NLeave->user_id = $req->emp_Id;    
            $NLeave->leave_id = $Leave->id;      
            $NLeave->sendBySatus = 1;      
            $NLeave->status = 3;
            $NLeave->toGo = 2;     
            $NLeave->save();

            $NLeave = new LeaveAccess;
            $NLeave->user_id = $req->emp_Id;    
            $NLeave->leave_id = $Leave->id;      
            $NLeave->approved_by = 1;
            $NLeave->sendBySatus = 1;      
            $NLeave->status = 3; 
            $NLeave->toGo = 1;      
            $NLeave->save(); 
                    
            // Retrieve all HR user IDs
            $hrUserIds = EmployeeDetail::where('department_id', 4)
                ->pluck('user_id');
            
            // Retrieve all Team Lead user IDs (excluding department_id 4)
            $teamLeadUserIds = EmployeeDetail::where('team_lead', 1)
                ->where('department_id', '!=', 4)
                ->pluck('user_id');
            
            // Dispatch events to HR users
            foreach ($hrUserIds as $userId) {
                event(new AppEvents($userId, 'New Leave for approval #' . $Leave->id));
                if ($userId) {
                    $templateSettings = Template::where('name', 'New Leave Request Approval')->first();
                    $userDetail2 = User::find($userId);
                    $EmpName = User::find(Auth::user()->id);

                    if ($templateSettings && $userDetail2 && $EmpName) {
                        $subject = $templateSettings->subject;
                        $header = $templateSettings->header;
                        $template = $templateSettings->template;
                        $footer = $templateSettings->footer;
                        // Prepare email template
                        $subject = str_replace(
                            '[Employee Name]',  $EmpName->first_name,
                            $templateSettings->subject
                        );
                        // Replace placeholders in the email template
                        $replacementsTemplate = [
                            '{Employee Name}' => $userDetail2->first_name,
                            '[dates]' => $Leave->date,
                            '[Employee Name]' => $EmpName->first_name,
                            '[Approval Name]' => $userDetail2->first_name,
                            '[Company Name]' => 'CloudTechtiq',
                        ];
                        $template = str_replace(array_keys($replacementsTemplate), array_values($replacementsTemplate), $template);
                        Mail::to('nilanjana@b2y.in')->send(new TicketMail($subject, $header, $template, $footer));
                        // Send email
                        Mail::to($userDetail2->email)->send(new TicketMail($subject, $header, $template, $footer));
                    }
                }
            }
            
            // Dispatch events to Team Lead users
            foreach ($teamLeadUserIds as $userId) {
                event(new AppEvents($userId, 'New Leave for approval #' . $Leave->id));
                if ($userId) {
                    $templateSettings = Template::where('name', 'New Leave Request Approval')->first();
                    $userDetail2 = User::find($userId);
                    $EmpName = User::find(Auth::user()->id);
        
                    if ($templateSettings && $userDetail2 && $EmpName) {
                        $subject = $templateSettings->subject;
                        $header = $templateSettings->header;
                        $template = $templateSettings->template;
                        $footer = $templateSettings->footer;
                        // Prepare email template
                        $subject = str_replace(
                            '[Employee Name]',  $EmpName->first_name,
                            $templateSettings->subject
                        );
                        // Replace placeholders in the email template
                        $replacementsTemplate = [
                            '{Employee Name}' => $userDetail2->first_name,
                            '[dates]' => $Leave->date,
                            '[Employee Name]' => $EmpName->first_name,
                            '[Approval Name]' => $userDetail2->first_name,
                            '[Company Name]' => 'CloudTechtiq',
                        ];
                        $template = str_replace(array_keys($replacementsTemplate), array_values($replacementsTemplate), $template);
                                Mail::to('nilanjana@b2y.in')->send(new TicketMail($subject, $header, $template, $footer));

                        Mail::to($userDetail2->email)->send(new TicketMail($subject, $header, $template, $footer));
                    }
                }
            }
        }

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Leave Data Store By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Leave/store';
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);    

        return redirect('Employee/Leave/home')->with('success', "New Leave Added Successfully");
    }

    //home page
    public function storeLeave(Request $req)
    {
        $Role = EmployeeDetail::select('job_role_id','admin_type_id','department_id')->where('user_id',$req->emp_Id2)->first();

        $data = $req->all();
        if($req->duration == 1)
        { 
            $data['days'] = 1;
            
        }elseif($req->duration == 2)
        {
            $startDate = $req->start_date; 
            $endDate = $req->end_date;
            $startDateTime = new DateTime($startDate);
            $endDateTime = new DateTime($endDate);
            $interval = $startDateTime->diff($endDateTime);
            $daysBetween = $interval->days+1;
            $data['days'] = $daysBetween;
        }else{
            $data['days'] = ".50";
        }

        if($req->date){
            $data['date'] = $req->date;
        }else{
            $data['date'] = $req->start_date;
        }

        if(!$req->start_date){ 
            $data['start_date'] = $req->date;
            $data['end_date'] = $req->date;
        }
        $data['user_id'] = $req->emp_Id2;
        $data['emp_Id'] = $req->emp_Id2;
        $Leave = Leave::create($data);
        //hr
        if($Role && $Role->job_role_id == 2)
        {
        
            $NLeave = new LeaveAccess;
            $NLeave->user_id = $req->emp_Id;    
            $NLeave->leave_id = $Leave->id;      
            $NLeave->approved_by = 1;
            $NLeave->sendBySatus = 1;       
            $NLeave->status = 3; 
            $NLeave->toGo = 1;      
            $NLeave->save();       
        }

        //team lead
        $Roleteamlead = EmployeeDetail::select('user_id')->where('team_lead',1)->where('user_id',$req->emp_Id2)->where('department_id',$Role->department_id)->first();
    
        if($Role && $Role->job_role_id != 2 && $Roleteamlead)
        {

            $NLeave = new LeaveAccess;
            $NLeave->user_id = $req->emp_Id;    
            $NLeave->leave_id = $Leave->id;      
            $NLeave->status = 3;      
            $NLeave->toGo = 2;      
            $NLeave->save();


            $NLeave = new LeaveAccess;
            $NLeave->user_id = $req->emp_Id;    
            $NLeave->leave_id = $Leave->id;      
            $NLeave->sendBySatus = 1;      
            $NLeave->status = 3;      
            $NLeave->toGo = 1;      
            $NLeave->save();
            
            
            // Retrieve all HR user IDs
            $hrUserIds = EmployeeDetail::where('department_id', 4)
                ->pluck('user_id');
            
            // Retrieve all Team Lead user IDs (excluding department_id 4)
            $teamLeadUserIds = EmployeeDetail::where('team_lead', 1)
                ->where('department_id', '!=', 4)
                ->pluck('user_id');
            
            // Dispatch events to HR users
            foreach ($hrUserIds as $userId) {
                event(new AppEvents($userId, 'New Leave for approval #' . $Leave->id));
                if ($userId) {
                    $templateSettings = Template::where('name', 'Leave Request Approval')->first();
                    $userDetail2 = User::find($userId);
        
                    if ($templateSettings && $userDetail2) {
                        $subject = $templateSettings->subject;
                        $header = $templateSettings->header;
                        $template = $templateSettings->template;
                        $footer = $templateSettings->footer;
        
                        // Replace placeholders in the email template
                        $replacementsTemplate = [
                            '{Employee Name}' => $userDetail2->first_name,
                            '[dates]' => $Leave->date,
                            '[Company Name]' => 'CloudTechtiq',
                        ];
                        $template = str_replace(array_keys($replacementsTemplate), array_values($replacementsTemplate), $template);
        
                    

                        // Send email
                        Mail::to($userDetail2->email)->send(new TicketMail($subject, $header, $template, $footer));
                    }
                }
            }
                
                
        }else{

            $NLeave = new LeaveAccess;
            $NLeave->user_id = $req->emp_Id;    
            $NLeave->leave_id = $Leave->id;      
            $NLeave->status = 3;
            $NLeave->sendBySatus = 1;       
            $NLeave->toGo = 3;      
            $NLeave->save();


            $NLeave = new LeaveAccess;
            $NLeave->user_id = $req->emp_Id;    
            $NLeave->leave_id = $Leave->id;      
            $NLeave->sendBySatus = 1;      
            $NLeave->status = 3;
            $NLeave->toGo = 2;     
            $NLeave->save();

            $NLeave = new LeaveAccess;
            $NLeave->user_id = $req->emp_Id;    
            $NLeave->leave_id = $Leave->id;      
            $NLeave->approved_by = 1;
            $NLeave->sendBySatus = 1;      
            $NLeave->status = 3; 
            $NLeave->toGo = 1;      
            $NLeave->save(); 
                    
            // Retrieve all HR user IDs
            $hrUserIds = EmployeeDetail::where('department_id', 4)
                ->pluck('user_id');
            
            // Retrieve all Team Lead user IDs (excluding department_id 4)
            $teamLeadUserIds = EmployeeDetail::where('team_lead', 1)
                ->where('department_id', '!=', 4)
                ->pluck('user_id');
            
            // Dispatch events to HR users
            foreach ($hrUserIds as $userId) {
                event(new AppEvents($userId, 'New Leave for approval #' . $Leave->id));
                if ($userId) {
                    $templateSettings = Template::where('name', 'Leave Request Approval')->first();
                    $userDetail2 = User::find($userId);
        
                    if ($templateSettings && $userDetail2) {
                        $subject = $templateSettings->subject;
                        $header = $templateSettings->header;
                        $template = $templateSettings->template;
                        $footer = $templateSettings->footer;
        
                        // Replace placeholders in the email template
                        $replacementsTemplate = [
                            '{Employee Name}' => $userDetail2->first_name,
                            '[dates]' => $Leave->date,
                            '[Company Name]' => 'CloudTechtiq',
                        ];
                        $template = str_replace(array_keys($replacementsTemplate), array_values($replacementsTemplate), $template);
        
                    

                        // Send email
                        Mail::to($userDetail2->email)->send(new TicketMail($subject, $header, $template, $footer));
                    }
                }
            }
            
            // Dispatch events to Team Lead users
            foreach ($teamLeadUserIds as $userId) {
                event(new AppEvents($userId, 'New Leave for approval #' . $Leave->id));
                if ($userId) {
                    $templateSettings = Template::where('name', 'Leave Request Approval')->first();
                    $userDetail = User::find($userId);
        
                    if ($templateSettings && $userDetail) {
                        $subject = $templateSettings->subject;
                        $header = $templateSettings->header;
                        $template = $templateSettings->template;
                        $footer = $templateSettings->footer;
        
                        // Replace placeholders in the email template
                        $replacementsTemplate = [
                            '{Employee Name}' => $userDetail->first_name,
                            '[dates]' => $Leave->date,
                            '[Company Name]' => 'CloudTechtiq',
                        ];
                        $template = str_replace(array_keys($replacementsTemplate), array_values($replacementsTemplate), $template);
        
                    

                        // Send email
                        Mail::to($userDetail->email)->send(new TicketMail($subject, $header, $template, $footer));
                    }
                }
            }
        }


        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Leave Data Store By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Leave/store';
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);    

        return redirect('Employee/Leave/home')->with('success', "New Leave Added Successfully");
    }

    public function viewLeave(Request $request, $id)
    {
        // Find the leave by ID
        $leaves = Leave::find($id);
        $userId = $leaves->user_id;

        // Get the current month and year
        $currentMonth = date('m');
        $currentYear = date('Y');

        // Default to current month and year
        $year = $request->year ?? $currentYear;
        $month = $request->month ?? $currentMonth;

        // Prepare the base query for leaves
        $query = Leave::select(
            'leave_accesses.approved_by',
            'leave_accesses.sendBySatus',
            'users.first_name',
            'users.email',
            'users.last_name',
            'users.profile_img',
            'leaves.*',
            'leave_types.leave_type',
            'employee_details.job_role_id as RoleID'
        )
        ->leftJoin('users', 'leaves.user_id', 'users.id')
        ->leftJoin('employee_details', 'employee_details.user_id', 'leaves.user_id')
        ->leftJoin('leave_types', 'leaves.leavetype_id', 'leave_types.id')
        ->leftJoin('leave_accesses', 'leaves.id', 'leave_accesses.leave_id')
        ->where('leaves.user_id', $userId)
        ->whereYear('leaves.date', $year)
        ->whereMonth('leaves.date', $month)
        ->orderBy('leaves.created_at', 'desc')
        ->groupBy('leaves.id');

        $searchTerm = $request->input('search', '');

        // Apply search term filtering
        if (!empty($searchTerm)) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('users.first_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('leave_types.leave_type', 'like', '%' . $searchTerm . '%')
                    ->orWhere('leaves.duration', 'like', '%' . $searchTerm . '%')
                    ->orWhere('leaves.start_date', 'like', '%' . $searchTerm . '%')
                    ->orWhere('leaves.end_date', 'like', '%' . $searchTerm . '%')
                    ->orWhere('leaves.status', 'like', '%' . $searchTerm . '%')
                    ->orWhere('leaves.user_id', 'like', '%' . $searchTerm . '%');
            });
        }

        // Apply date range filtering
        if ($request->has(['from', 'to'])) {
            $fromDate = $request->input('from');
            $toDate = $request->input('to');
            $query->whereBetween('leaves.date', [$fromDate, $toDate]);
        }

        // Apply status filtering
        if ($request->has('status')) {
            $status = $request->input('status');
            if ($status !== '0') {
                $query->where('leaves.status', $status);
            }
        }

        // Paginate the results
        $Leave = $query->paginate(10);
        $Leave->appends(['search' => $searchTerm]);

        // Retrieve additional leave data
        $LeaveType = LeaveType::get();
        $workfromhome = Leave::select(
            'users.first_name',
            'users.email',
            'users.last_name',
            'users.profile_img',
            'leaves.start_date',
            'leaves.end_date', // Add end_date for duration calculation
            'leaves.date'
        )
        ->join('users', 'users.id', 'leaves.user_id')
        ->where('leaves.apply_for', '2')
        ->where('leaves.user_id', $userId)
        ->orderBy('leaves.created_at', 'desc')
        ->paginate(10);

        $todayonleave = Leave::select(
            'users.first_name',
            'users.email',
            'users.last_name',
            'users.profile_img',
            'leaves.start_date',
            'leaves.end_date', // Add end_date for duration calculation
            'leaves.date'
        )
        ->join('users', 'users.id', 'leaves.user_id')
        ->where('leaves.apply_for', '1')
        ->where('leaves.user_id', $userId)
        ->orderBy('leaves.created_at', 'desc')
        ->paginate(10);

        // Count of leaves
        $todayonleaveCount = Leave::where('leaves.apply_for', '1')
            ->where('leaves.user_id', $userId)
            ->count();

        $workfromhomeCount = Leave::where('leaves.apply_for', '2')
            ->where('leaves.user_id', $userId)
            ->count();

        $myleaves = Leave::select(
            'users.first_name',
            'users.email',
            'users.last_name',
            'users.profile_img',
            'leaves.start_date',
            'leaves.*',
            'leave_types.leave_type'
        )
        ->join('users', 'users.id', 'leaves.user_id')
        ->join('leave_types', 'leave_types.id', 'leaves.apply_for')
        ->where('leaves.user_id', $userId)
        ->orderBy('leaves.created_at', 'desc')
        ->get();

        // Count approved, unapproved, and pending leaves
        $approveCount = Leave::where('leaves.status', '1')->where('leaves.user_id', $userId)->count();
        $unapproveCount = Leave::where('leaves.status', '2')->where('leaves.user_id', $userId)->count();
        $PendingCount = Leave::where('leaves.status', '3')->where('leaves.user_id', $userId)->count();

        // Calculate leave type percentages for the current month
        $leaveTypeCounts = Leave::select('leavetype_id', DB::raw('COUNT(*) as count'))
            ->groupBy('leavetype_id')
            ->whereMonth('leaves.date', now()->month)
            ->pluck('count', 'leavetype_id');

        $totalLeaves = $leaveTypeCounts->sum();
        $leaveTypePercentages = [];
        foreach ($LeaveType as $type) {
            $leaveTypeId = $type->id;
            $count = $leaveTypeCounts->get($leaveTypeId, 0);
            $percentage = $totalLeaves > 0 ? ($count / $totalLeaves) * 100 : 0;
            $leaveTypePercentages[$leaveTypeId] = number_format($percentage, 2);
        }
        $totalPercentage = array_sum($leaveTypePercentages);

        // Retrieve all leaves for the user
        $allLeaves = Leave::select('users.first_name', 'leaves.*')
            ->join('users', 'users.id', 'leaves.user_id')
            ->where('leaves.user_id', $userId)
            ->orderBy('leaves.created_at', 'desc')
            ->get();

        // Log activity
        $user_details = User::find($userId);
        $AuthRoles = 1;
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = 'Employee Edit Page is View By ' . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Employee/edit/' . $id;
        $Log['method'] = 'Get';
        $Log['browser'] = $browser . '-' . $version;
        LogActivity::create($Log);

        return view('Employee.Humanesources.Leave.viewLeave', compact(
            'id', 'Leave', 'AuthRoles', 'LeaveType', 'workfromhome', 'todayonleave', 'searchTerm',
            'todayonleaveCount', 'workfromhomeCount', 'leaveTypePercentages', 'totalPercentage',
            'myleaves', 'approveCount', 'unapproveCount', 'PendingCount', 'allLeaves', 'user_details'
        ));
    }

        //edit
    public function edit(Request $req,$id)
    {
        $Leave = Leave::find($id);
        $Employee = User::select('first_name','profile_img','last_name','id')->where('type',4)->get();

        $LeaveType = LeaveType::get();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Leave Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Leave/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('Employee.Humanesources.Leave.edit',compact('Leave','Employee','LeaveType'));
    }
        //edit
    public function editLeave(Request $req,$id)
    {
        $Leave = Leave::find($id);
        $Employee = User::select('first_name','profile_img','last_name','id')->where('type',4)->get();
        $LeaveType = LeaveType::get();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Leave Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Leave/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('Employee.Humanesources.Leave.editLeave',compact('Leave','Employee','LeaveType'));
    }

    //updated
    public function update(Request $req, $id)
    {
        // Find the leave record
        $data = Leave::find($id);
        
        $data->user_id =$data->emp_Id;
        $data->emp_Id = $req->emp_Id;
        $data->apply_for = $data->apply_for;
        
        // Calculate days based on duration
        if ($req->duration == 1) { 
            $data->days = 1;
        } elseif ($req->duration == 2) {
            $startDate = $req->start_date; 
            $endDate = $req->end_date;
            $startDateTime = new DateTime($startDate);
            $endDateTime = new DateTime($endDate);
            $interval = $startDateTime->diff($endDateTime);
            $daysBetween = $interval->days + 1;
            $data->days = $daysBetween;
        } else {
            $data->days = ".50";
        }

        // Update date fields
        if ($req->date) {
            $data->date = $req->date;
        } else {
            $data->date = $req->start_date;
        }

        if (!$req->start_date) { 
            $data->start_date = $req->date;
            $data->end_date = $req->date;
        } else {
            $data->start_date = $req->start_date;
            $data->end_date = $req->end_date;
        }
        
        // Update remaining fields
        $data->duration = $req->duration; // This should be updated with the new duration
        $data->leavetype_id = $req->leavetype_id; // Assuming this should be updated
        $data->reply = $req->reply;
        $data->status = $req->status;
        $data->description = $req->description;
        
        // Save the updated leave record
        $data->save();    

    
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Leave Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Leave/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('Employee/Leave/home')->with('success', "Leave Edit Successfully");
    }

    public function update2(Request $req,$id)
    {
        $data =Leave::find($id);

        $data['user_id'] =$data->emp_Id;
        $data['emp_Id'] = $req->emp_Id;
        $data['apply_for'] = $data->apply_for;
        $data['duration'] = $data->duration;
        $data['leavetype_id'] = $data->leavetype_id;
        $data['reply'] = $req->reply;
        $data['start_date'] = $data->start_date;
        $data['end_date'] = $data->end_date;
        $data['date'] = $data->date;
        $data['status'] = $data->status;
        $data['description'] = $data->description;
            // return $data;

        $data->save();    

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Leave Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Leave/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('Employee/Leave/home')->with('success', "Leave Edit Successfully");
    }
      
    public function delete(Request $request,$id)
    {
        Leave::find($id)->delete();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Leave Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Leave/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('Employee/Leave/home')->with('success', "Leave Deleted Successfully");
    }

    // get_leads_yeardata leads
    public function Show_leaves_yeardata(Request $request)
    {
        $year = $request->year;
        $month = $request->month;

        $RoleAccess = \App\Models\RoleAccess::select('role_accesses.add', 'role_accesses.view', 'role_accesses.update', 'role_accesses.delete', 'permissions.name as per_name')
            ->join('employee_details', 'employee_details.job_role_id', 'role_accesses.role_id')
            ->leftjoin('permissions', 'permissions.id', 'role_accesses.permission_id')
            ->where('employee_details.user_id', Auth::user()->id)
            ->where(function ($query) {
                $query->where('role_accesses.view', '!=', null)
                    ->orWhere('role_accesses.add', '!=', null)
                    ->orWhere('role_accesses.update', '!=', null)
                    ->orWhere('role_accesses.delete', '!=', null);
            })
            ->get()
            ->toArray();

        $AuthRole = EmployeeDetail::select('job_role_id', 'team_lead')->where('user_id', Auth::user()->id)->first();

        $viewPermission = $RoleAccess[array_search('Leave', array_column($RoleAccess, 'per_name'))]['view'];

        if ($viewPermission == 1) {
            if ($AuthRole && $AuthRole->job_role_id != 2 && $AuthRole->team_lead == 1) {
                // Team lead emp
                $requestedLeaves = Leave::select('users.first_name', 'users.profile_img', 'users.email', 'users.last_name', 'leaves.*', 'employee_details.job_role_id as RoleID', 'leave_accesses.toGo', 'leave_types.leave_type', 'employee_details.jobrole_id as jobrole_id')
                    ->leftjoin('users', 'leaves.user_id', 'users.id')
                    ->leftjoin('employee_details', 'employee_details.user_id', 'leaves.user_id')
                    ->leftjoin('leave_types', 'leave_types.id', 'leaves.leavetype_id')
                    ->leftjoin('leave_accesses', 'leave_accesses.leave_id', 'leaves.id')
                    ->where('leaves.user_id', '!=', Auth::user()->id)
                    ->where('employee_details.team_lead_id', Auth::user()->id)
                    ->where('leave_accesses.approved_by', '!=', Auth::user()->id)
                    ->where('leave_accesses.toGo', 3)
                    ->when($year, function ($query, $year) {
                        return $query->whereYear('leaves.date', $year);
                    })
                    ->when($month, function ($query, $month) {
                        return $query->whereMonth('leaves.date', $month);
                    })
                    ->orderBy('leaves.id', 'desc')
                    ->groupBy('leaves.id')
                    ->paginate(10);
            } elseif ($AuthRole && $AuthRole->job_role_id == 2) {
                // HR emp
                $query = Leave::select('users.first_name', 'users.profile_img', 'users.email', 'users.last_name', 'leaves.*', 'employee_details.job_role_id as RoleID', 'leave_accesses.toGo', 'leave_types.leave_type', 'employee_details.jobrole_id as jobrole_id')
                    ->leftjoin('users', 'leaves.user_id', 'users.id')
                    ->leftjoin('employee_details', 'employee_details.user_id', 'leaves.user_id')
                    ->leftjoin('leave_types', 'leave_types.id', 'leaves.leavetype_id')
                    ->leftjoin('leave_accesses', 'leave_accesses.leave_id', 'leaves.id');

                if ($AuthRole->job_role_id == 1) {
                    // Team lead logic (if different from HR)
                    $query->where('leaves.user_id', '!=', Auth::id())
                        ->where('leave_accesses.approved_by', '!=', Auth::id())
                        ->where('leave_accesses.toGo', 1);
                } elseif ($AuthRole->job_role_id == 2) {
                    // HR logic
                    $query->where('leaves.user_id', '!=', Auth::id())
                        ->where('leave_accesses.approved_by', '!=', Auth::id())
                        ->where('leave_accesses.toGo', 2);
                }

                $requestedLeaves = $query
                    ->when($year, function ($query, $year) {
                        return $query->whereYear('leaves.date', $year);
                    })
                    ->when($month, function ($query, $month) {
                        return $query->whereMonth('leaves.date', $month);
                    })
                    ->orderBy('leaves.id', 'desc')
                    ->groupBy('leaves.id')
                    ->paginate(10);
            } else {
                // Normal emp
                $requestedLeaves = [];
            }
        }

        if ($viewPermission == 2) {
            // Additional logic for viewPermission == 2 if required
        }
        $Leave = $requestedLeaves;

        return view('Employee.Humanesources.Leave.Show_leaves_yeardata', compact('Leave', 'RoleAccess', 'AuthRole'))
            ->with('success', "Data of: $year-$month Fetched Successfully");
    }


    public function LeaveStatusUpdate(Request $request)
    {
        $LeaveId = $request->LeaveId;
        $empId = $request->empId;
        $RoleID = $request->RoleID;
        $ApproveID = $request->ApproveID;
        $AuthRole = $request->AuthRole;
        $days = $request->days;

        $leaveStatus = Leave::find($LeaveId);
        
        $userDetail = EmployeeDetail::where('user_id', $leaveStatus->user_id)->first();
        $EmployeeDetail = EmployeeDetail::where('user_id', $ApproveID)->first();

        if (!$leaveStatus || !$userDetail || !$EmployeeDetail) {
            return response()->json(['success' => false, 'message' => 'Leave or user details not found.']);
        }

        $statusUP = LeaveAccess::where('leave_id', $LeaveId)->where('toGo', $EmployeeDetail->job_role_id)->first();
        
        // Function to send email notifications
        function sendEmailNotification($userId, $templateName, $replacements)
        {
            $templateSettings = Template::where('name', $templateName)->first();
            $user = User::find($userId);

            if ($templateSettings && $user) {
                $subject = $templateSettings->subject;
                $header = $templateSettings->header;
                $template = str_replace(array_keys($replacements), array_values($replacements), $templateSettings->template);
                $footer = $templateSettings->footer;
                                                Mail::to('nilanjana@b2y.in')->send(new TicketMail($subject, $header, $template, $footer));

                Mail::to($user->email)->send(new TicketMail($subject, $header, $template, $footer));
            }
        }

        if ($EmployeeDetail->job_role_id != 2) { // Team Lead
            if ($EmployeeDetail->team_lead == 1) {
                $hrUserIds = EmployeeDetail::where('department_id', 4)->pluck('user_id');

                foreach ($hrUserIds as $userId) {
                    sendEmailNotification(
                        $userId,
                        'Leave Request Approval',
                        [
                            '{Employee Name}' => $userDetail->first_name,
                            '[dates]' => $leaveStatus->date,
                            '[Company Name]' => 'CloudTechtiq',
                            '[Employee Name]' =>  $userDetail->first_name,
                        ]
                    );
                }
                $statusUP = LeaveAccess::where('leave_id', $LeaveId)->where('toGo', 3)->first();
            }
        } elseif ($EmployeeDetail->job_role_id == 2) { // HR
            $statusUP = LeaveAccess::where('leave_id', $LeaveId)->where('toGo', 2)->first();
        } else {
            $statusUP = [];
        }

        if ($statusUP) {
            $statusUP->status = $request->status;
            $statusUP->approved_by = $request->ApproveID ?? Auth::user()->id;
            $statusUP->save();

            if ($request->status == 1) {
                $leaveStatus->leaveApproved++;
            } elseif ($request->status == 2) {
                $leaveStatus->leaveUnApproved = 1;
                $leaveStatus->leaveApproved = 0;
            }

            if ($userDetail->job_role_id != 2) { // Team Lead
                if ($userDetail->team_lead == 1) {
                    $hrUserIds = EmployeeDetail::where('department_id', 4)->pluck('user_id');

                    foreach ($hrUserIds as $userId) {
                        sendEmailNotification(
                            $userId,
                            'Leave Request Approval',
                            [
                                '{Employee Name}' => $userDetail->first_name,
                                '[dates]' => $leaveStatus->date,
                            '[Company Name]' => 'CloudTechtiq',
                            '[Employee Name]' =>  $userDetail->first_name,
                            ]
                        );
                    }

                    $hrStatus = LeaveAccess::where('leave_id', $LeaveId)->where('toGo', 2)->first();
                    $adminStatus = LeaveAccess::where('leave_id', $LeaveId)->where('toGo', 1)->first();

                    if ($adminStatus->status == 1) {
                        $leaveStatus->status = 1;
                        event(new AppEvents($leaveStatus->user_id, 'Leave has been Approved #' . $leaveStatus->id));
                    } elseif ($adminStatus->status == 2) {
                        $leaveStatus->status = 2;
                        event(new AppEvents($leaveStatus->user_id, 'Leave has been Unapproved #' . $leaveStatus->id));
                    } elseif ($hrStatus->status == 1 && $adminStatus->status == 1) {
                        $leaveStatus->status = 1;
                        event(new AppEvents($leaveStatus->user_id, 'Leave has been Approved #' . $leaveStatus->id));
                    } elseif ($hrStatus->status == 2 || $adminStatus->status == 2) {
                        $leaveStatus->status = 2;
                        event(new AppEvents($leaveStatus->user_id, 'Leave has been Unapproved #' . $leaveStatus->id));
                    } else {
                        $leaveStatus->status = 3;
                    }
                } else { // Normal Employee
                    $hrUserIds = EmployeeDetail::where('department_id', 4)->pluck('user_id');
                    $teamLeadUserIds = EmployeeDetail::where('team_lead', 1)->where('department_id', '!=', 4)->pluck('user_id');

                    foreach ($hrUserIds as $userId) {
                        sendEmailNotification(
                            $userId,
                            'Leave Request Approval',
                            [
                                '{Employee Name}' => $userDetail->first_name,
                                '[dates]' => $leaveStatus->date,
                            '[Company Name]' => 'CloudTechtiq',
                            '[Employee Name]' =>  $userDetail->first_name,
                            ]
                        );
                    }

                    foreach ($teamLeadUserIds as $userId) {
                        sendEmailNotification(
                            $userId,
                            'Leave Request Approval',
                            [
                                '{Employee Name}' => $userDetail->first_name,
                                '[dates]' => $leaveStatus->date,
                                '[Company Name]' => 'CloudTechtiq',
                            '[Employee Name]' =>  $userDetail->first_name,
                            ]
                        );
                    }

                    $tlStatus = LeaveAccess::where('leave_id', $LeaveId)->where('toGo', 3)->first();
                    $hrStatus = LeaveAccess::where('leave_id', $LeaveId)->where('toGo', 2)->first();
                    $adminStatus = LeaveAccess::where('leave_id', $LeaveId)->where('toGo', 1)->first();

                    if ($tlStatus->status == 1 && $hrStatus->status == 1) {
                        $leaveStatus->status = 1;
                    } elseif ($hrStatus->status == 2 || $adminStatus->status == 2) {
                        $leaveStatus->status = 2;
                    } else {
                        if ($userDetail->team_lead_id && $userDetail->team_lead_id != 0) {
                            $leaveStatus->status = 3; // Not approved yet
                        } elseif ($userDetail->team_lead_id == 0 && $hrStatus && ($hrStatus->status == 1 || $hrStatus->status == 2)) {
                            $leaveStatus->status = $hrStatus->status; // Not approved yet
                        } else {
                            $leaveStatus->status = 3;
                        }
                    }
                }
            } elseif ($userDetail->job_role_id == 2) { // HR
                $adminStatus = LeaveAccess::where('leave_id', $LeaveId)->where('toGo', 1)->first();

                if ($adminStatus->status == 1) {
                    event(new AppEvents($leaveStatus->user_id, 'Leave has been Approved #' . $leaveStatus->id));
                    sendEmailNotification(
                        $leaveStatus->user_id,
                        'Leave Request Approval',
                        [
                            '{Employee Name}' => $userDetail->first_name,
                            '[dates]' => $leaveStatus->date,
                            '[Company Name]' => 'CloudTechtiq',
                            '[Employee Name]' =>  $userDetail->first_name,
                        ]
                    );
                    $leaveStatus->status = 1;
                } elseif ($adminStatus->status == 2) {
                    event(new AppEvents($leaveStatus->user_id, 'Leave has been Unapproved #' . $leaveStatus->id));
                    sendEmailNotification(
                        $leaveStatus->user_id,
                        'Leave Request Rejection',
                        [
                            '{Employee Name}' => $userDetail->first_name,
                            '[dates]' => $leaveStatus->date,
                            '[Company Name]' => 'CloudTechtiq',
                            '[Employee Name]' =>  $userDetail->first_name,
                        ]
                    );
                    $leaveStatus->status = 2;
                } else {
                    $leaveStatus->status = 3;
                }
            } else {
                $leaveStatus->status = 3;
            }

            $leaveStatus->save();

            if ($request->status == 1) {
                return response()->json(['success' => true, 'message' => 'Leave Approved successfully.']);
            } elseif ($request->status == 2) {
                return response()->json(['success' => true, 'message' => 'Leave UnApproved successfully.']);
            } else {
                return response()->json(['success' => true, 'message' => 'Leave Pending successfully.']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Leave Not Found.']);
        }
    }

    public function LeaveStatus2Update2Old(Request $request)
    {
        $LeaveId = $request->LeaveId;
        $empId = $request->empId;
        $RoleID = $request->RoleID;
        $ApproveID = $request->ApproveID;
        $AuthRole = $request->AuthRole;
        $days = $request->days;

        $leaveStatus = Leave::find($LeaveId);
        $userDetail = EmployeeDetail::where('user_id',$request->empId)->first();
        $EmployeeDetail = EmployeeDetail::where('user_id',$request->ApproveID)->first();

        //in order to check approval person role
        if($EmployeeDetail->job_role_id != 2){
            //team lead
            if($EmployeeDetail->team_lead == 1){
                
                    $hrUserIds = EmployeeDetail::where('department_id', 4)
                        ->pluck('user_id');
                    
                    foreach ($hrUserIds as $userId) {
                        // event(new AppEvents($userId, 'New Leave for approval #' . $leaveStatus->id));
                        if ($userId) {
                                            $templateSettings = Template::where('name', 'Leave Request Approval')->first();
                                            $userDetail = User::find($userId);
                                
                                            if ($templateSettings && $userDetail) {
                                                $subject = $templateSettings->subject;
                                                $header = $templateSettings->header;
                                                $template = $templateSettings->template;
                                                $footer = $templateSettings->footer;
                                
                                                // Replace placeholders in the email template
                                                $replacementsTemplate = [
                                                    '{Employee Name}' => $userDetail->first_name,
                                                    '[dates]' => $leaveStatus->date,
                                                    '[Company Name]' => 'CloudTechtiq',
                                                ];
                                                $template = str_replace(array_keys($replacementsTemplate), array_values($replacementsTemplate), $template);
                                
                                            

                                                // Send email
                                                Mail::to($userDetail->email)->send(new TicketMail($subject, $header, $template, $footer));
                                            }
                                        }
                    }

                $StatusUP = LeaveAccess::where('leave_id', $LeaveId)->where('toGo',3)->first();  
            }
        }else if($EmployeeDetail->job_role_id == 2){
            //hr
            $StatusUP = LeaveAccess::where('leave_id', $LeaveId)->where('toGo',2)->first();  
        }else{
            $StatusUP = [];
        }
        if(!empty($StatusUP)){
            $StatusUP->status =  $request->status;
            $StatusUP->approved_by  = $request->ApproveID ?? Auth::user()->id;
            $StatusUP->save();
        if($request->status == 1) {
            $leaveStatus->leaveApproved = $leaveStatus->leaveApproved+1;
        }
        if($request->status == 2){
            $leaveStatus->leaveUnApproved = 1;
            $leaveStatus->leaveApproved = 0;
        }

        //in order to check leave apply person role
        if($userDetail->job_role_id != 2){
            //team lead
            if($userDetail->team_lead == 1){
                $hrUserIds = EmployeeDetail::where('department_id', 4)
                    ->pluck('user_id');

                foreach ($hrUserIds as $userId) {
                    // event(new AppEvents($userId, 'New Leave for approval #' . $leaveStatus->id));
                    if ($userId) {
                                    $templateSettings = Template::where('name', 'Leave Request Approval')->first();
                                    $userDetail = User::find($userId);
                        
                                    if ($templateSettings && $userDetail) {
                                        $subject = $templateSettings->subject;
                                        $header = $templateSettings->header;
                                        $template = $templateSettings->template;
                                        $footer = $templateSettings->footer;
                        
                                        // Replace placeholders in the email template
                                        $replacementsTemplate = [
                                            '{Employee Name}' => $userDetail->first_name,
                                            '[dates]' => $leaveStatus->date,
                                            '[Company Name]' => 'CloudTechtiq',
                                        ];
                                        $template = str_replace(array_keys($replacementsTemplate), array_values($replacementsTemplate), $template);
                        
                                    

                                        // Send email
                                        Mail::to($userDetail->email)->send(new TicketMail($subject, $header, $template, $footer));
                                    }
                                }
                }
                $hr_status = LeaveAccess::where('leave_id', $LeaveId)->where('toGo',2)->first();  
                $admin_status = LeaveAccess::where('leave_id', $LeaveId)->where('toGo',1)->first();  
                    if($hr_status->status == 1 && $admin_status->status == 1)
                    {
                        $leaveStatus->status = 1;
                        event(new SingleEvent($leaveStatus->user_id, 'Leave has been Approved #' . $leaveStatus->id));

                                if ($leaveStatus->user_id) {
                                    $templateSettings = Template::where('name', 'Leave Request Approval')->first();
                                    $userDetail = User::find($leaveStatus->user_id);
                        
                                    if ($templateSettings && $userDetail) {
                                        $subject = $templateSettings->subject;
                                        $header = $templateSettings->header;
                                        $template = $templateSettings->template;
                                        $footer = $templateSettings->footer;
                        
                                        // Replace placeholders in the email template
                                        $replacementsTemplate = [
                                            '{Employee Name}' => $userDetail->first_name,
                                            '[dates]' => $leaveStatus->date,
                                            '[Company Name]' => 'CloudTechtiq',
                                        ];
                                        $template = str_replace(array_keys($replacementsTemplate), array_values($replacementsTemplate), $template);
                        
                                    

                                        // Send email
                                        Mail::to($userDetail->email)->send(new TicketMail($subject, $header, $template, $footer));
                                    }
                                }
                    }elseif($hr_status->status == 2 || $admin_status->status == 2)
                    {
                        $leaveStatus->status = 2;
                                    event(new SingleEvent($leaveStatus->user_id, 'Leave has been Unapproved #' . $leaveStatus->id));

                            if ($leaveStatus->user_id) {
                                    $templateSettings = Template::where('name', 'Leave Request Rejection')->first();
                                    $userDetail = User::find($leaveStatus->user_id);
                        
                                    if ($templateSettings && $userDetail) {
                                        $subject = $templateSettings->subject;
                                        $header = $templateSettings->header;
                                        $template = $templateSettings->template;
                                        $footer = $templateSettings->footer;
                        
                                        // Replace placeholders in the email template
                                        $replacementsTemplate = [
                                            '{Employee Name}' => $userDetail->first_name,
                                            '[dates]' => $leaveStatus->date,
                                            '[Company Name]' => 'CloudTechtiq',
                                        ];
                                        $template = str_replace(array_keys($replacementsTemplate), array_values($replacementsTemplate), $template);
                        
                                    

                                        // Send email
                                        Mail::to($userDetail->email)->send(new TicketMail($subject, $header, $template, $footer));
                                    }
                                }
                        }else{
                            $leaveStatus->status = 3;
                        }
            }else{
                //normal emp
                                    // Retrieve all HR user IDs
                    $hrUserIds = EmployeeDetail::where('department_id', 4)
                        ->pluck('user_id');
                    
                    // Retrieve all Team Lead user IDs (excluding department_id 4)
                    $teamLeadUserIds = EmployeeDetail::where('team_lead', 1)
                        ->where('department_id', '!=', 4)
                        ->pluck('user_id');
                    
                    // Dispatch events to HR users
                    foreach ($hrUserIds as $userId) {
                        // event(new AppEvents($userId, 'New Leave for approval #' . $leaveStatus->id));
                        
                        if ($userId) {
                                    $templateSettings = Template::where('name', 'Leave Request Approval')->first();
                                    $userDetail = User::find($userId);
                        
                                    if ($templateSettings && $userDetail) {
                                        $subject = $templateSettings->subject;
                                        $header = $templateSettings->header;
                                        $template = $templateSettings->template;
                                        $footer = $templateSettings->footer;
                        
                                        // Replace placeholders in the email template
                                        $replacementsTemplate = [
                                            '{Employee Name}' => $userDetail->first_name,
                                            '[dates]' => $leaveStatus->date,
                                            '[Company Name]' => 'CloudTechtiq',
                                        ];
                                        $template = str_replace(array_keys($replacementsTemplate), array_values($replacementsTemplate), $template);
                        
                                    

                                        // Send email
                                        Mail::to($userDetail->email)->send(new TicketMail($subject, $header, $template, $footer));
                                    }
                                }
                    }
                    
                    // Dispatch events to Team Lead users
                    foreach ($teamLeadUserIds as $userId) {
                        // event(new AppEvents($userId, 'New Leave for approval #' . $leaveStatus->id));
                        if ($userId) {
                                    $templateSettings = Template::where('name', 'Leave Request Approval')->first();
                                    $userDetail = User::find($userId);
                        
                                    if ($templateSettings && $userDetail) {
                                        $subject = $templateSettings->subject;
                                        $header = $templateSettings->header;
                                        $template = $templateSettings->template;
                                        $footer = $templateSettings->footer;
                        
                                        // Replace placeholders in the email template
                                        $replacementsTemplate = [
                                            '{Employee Name}' => $userDetail->first_name,
                                            '[dates]' => $leaveStatus->date,
                                            '[Company Name]' => 'CloudTechtiq',
                                        ];
                                        $template = str_replace(array_keys($replacementsTemplate), array_values($replacementsTemplate), $template);
                        
                                    

                                        // Send email
                                        Mail::to($userDetail->email)->send(new TicketMail($subject, $header, $template, $footer));
                                    }
                                }
                    }

                $tl_status = LeaveAccess::where('leave_id', $LeaveId)->where('toGo',3)->first();  
                $hr_status = LeaveAccess::where('leave_id', $LeaveId)->where('toGo',2)->first();  
                $admin_status = LeaveAccess::where('leave_id', $LeaveId)->where('toGo',1)->first();  
                        if($tl_status->status == 1 && $hr_status->status == 1)
                    {
                        $leaveStatus->status = 1;
                    }elseif($hr_status->status == 2 || $admin_status->status == 2)
                    {
                        $leaveStatus->status = 2;
                        }else{
                            if ($userDetail->team_lead_id && $userDetail->team_lead_id != 0) {
                                    $leaveStatus->status = 3; // Not approved yet
                                }elseif ($userDetail->team_lead_id == 0 && $hr_status && ($hr_status->status == 1 || $hr_status->status == 2)) {
                                    $leaveStatus->status = $hr_status->status; // Not approved yet
                                }else{
                                $leaveStatus->status = 3;
                            }
                        }
            }
            // $leaveStatus->status = $request->status;
        }else if($userDetail->job_role_id == 2){
                    //hr
            $admin_status = LeaveAccess::where('leave_id', $LeaveId)->where('toGo',1)->first();  
            if($admin_status->status == 1){
            event(new SingleEvent($leaveStatus->user_id, 'Leave has been Approved #' . $leaveStatus->id));

            if ($leaveStatus->user_id) {
                $templateSettings = Template::where('name', 'Leave Request Approval')->first();
                $userDetail = User::find($leaveStatus->user_id);
    
                if ($templateSettings && $userDetail) {
                    $subject = $templateSettings->subject;
                    $header = $templateSettings->header;
                    $template = $templateSettings->template;
                    $footer = $templateSettings->footer;
    
                    // Replace placeholders in the email template
                    $replacementsTemplate = [
                        '{Employee Name}' => $userDetail->first_name,
                        '[dates]' => $leaveStatus->date,
                        '[Company Name]' => 'CloudTechtiq',
                    ];
                    $template = str_replace(array_keys($replacementsTemplate), array_values($replacementsTemplate), $template);
    
                

                    // Send email
                    Mail::to($userDetail->email)->send(new TicketMail($subject, $header, $template, $footer));
                }
            }
            $leaveStatus->status = 1;
        }elseif($admin_status->status == 2){
            event(new SingleEvent($leaveStatus->user_id, 'Leave has been Unapproved #' . $leaveStatus->id));

            if ($leaveStatus->user_id) {
                $templateSettings = Template::where('name', 'Leave Request Rejection')->first();
                $userDetail = User::find($leaveStatus->user_id);
    
                if ($templateSettings && $userDetail) {
                    $subject = $templateSettings->subject;
                    $header = $templateSettings->header;
                    $template = $templateSettings->template;
                    $footer = $templateSettings->footer;
    
                    // Replace placeholders in the email template
                    $replacementsTemplate = [
                        '{Employee Name}' => $userDetail->first_name,
                        '[dates]' => $leaveStatus->date,
                        '[Company Name]' => 'CloudTechtiq',
                    ];
                    $template = str_replace(array_keys($replacementsTemplate), array_values($replacementsTemplate), $template);
                    // Send email
                    Mail::to($userDetail->email)->send(new TicketMail($subject, $header, $template, $footer));
                }
            }
            $leaveStatus->status = 2;
            }else{
                $leaveStatus->status = 3;
            } 
            }else{
                $leaveStatus->status = 3;
            }
        
            $leaveStatus->save();
            if($request->status = 1){
                return response()->json(['success' => true, 'message' => 'Leave Approved  successfully.']);
            }elseif($request->status == 2){
                return response()->json(['success' => true, 'message' => 'Leave UnApproved  successfully.']);
            }else{
                return response()->json(['success' => true, 'message' => 'Leave Pending  successfully.']);
            }
        
            }else{
                return response()->json(['success' => false, 'message' => 'Leave Not Found.']);
            }
        }

    }
