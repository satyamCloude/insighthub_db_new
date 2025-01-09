<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use App\Models\Template;
use App\Models\LeaveType;
use App\Models\Employee;
use App\Models\Leave;
use App\Models\User;
use App\Models\EmployeeDetail;
use App\Models\LeaveAccess;
use App\Events\SingleEvent;
use App\Mail\TicketMail;
use Illuminate\Support\Facades\Mail;
use Hash;
use Auth;
use DateTime;
use DB;

class LeaveController extends Controller
{   
    
    //home page
    public function home(Request $request)
    {
        $currentMonth = date('m');
        $currentYear = date('Y');

        $query = Leave::select('users.first_name', 'users.email', 'users.last_name', 'users.profile_img', 'leaves.duration', 'leaves.days', 'leaves.status', 'leaves.user_id', 'leaves.date', 'leave_types.leave_type', 'leaves.start_date', 'leaves.id', 'leaves.user_id', 'employee_details.job_role_id as RoleID', 'employee_details.jobrole_id as jobrole_id')
            ->leftjoin('users', 'leaves.user_id', 'users.id')
            ->leftjoin('employee_details', 'employee_details.user_id', 'leaves.user_id')
            ->leftjoin('leave_types', 'leaves.leavetype_id', 'leave_types.id')
            ->whereNull('users.deleted_at')
            ->whereMonth('leaves.date', $currentMonth)
            ->whereYear('leaves.date', $currentYear)
            ->orderBy('leaves.id', 'desc');
            
    
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
                ->orWhere('leaves.leaveApproved', 'like', '%' . $searchTerm . '%');
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


        $currentMonth = date('m');
        $currentYear = date('Y');
                
            
        $LeaveType = LeaveType::get();
                
                // Get current month's data for 'todayonleave'
                            
                            
        $todayonleave = Leave::select('users.first_name','users.email','users.last_name', 'users.profile_img', 'leaves.start_date', 'leaves.duration', 'leaves.date')
                    ->join('users', 'users.id', 'leaves.user_id')
                    ->where('leaves.apply_for', '1')
                    ->where(function ($query) {
                        // Filter by current date of the current month
                        $query->whereDate('leaves.date', now()->toDateString())
                            ->orWhereDate('leaves.start_date', now()->toDateString()); // Also consider start_date
                    })
                    ->orderBy('leaves.created_at', 'desc')
                    ->limit(5)
                    ->paginate(10);

        $workfromhome = Leave::select('users.first_name','users.email','users.last_name','users.profile_img','leaves.start_date','leaves.duration','leaves.date')
                        ->join('users','users.id','leaves.user_id')
                        ->where('leaves.apply_for','2')
                        ->orderBy('leaves.created_at', 'desc')
                        ->paginate(10);
        $AuthRoles = 1;
                
        $todayonleaveCount = Leave::select('users.first_name','leaves.start_date','leaves.duration','leaves.date')
                    ->join('users','users.id','leaves.user_id')
                    ->where('leaves.apply_for','1')
                    ->orderBy('leaves.created_at', 'desc')
                    ->count();
                        
                
                        
        $workfromhomeCount = Leave::select('users.first_name','users.email','users.last_name','leaves.start_date','leaves.duration','leaves.date')
                    ->join('users','users.id','leaves.user_id')
                    ->where('leaves.apply_for','2')
                    ->orderBy('leaves.created_at', 'desc')
                    ->count();
                
            
        
        $approveCount = Leave::where('leaves.status', '1')->count();
    
        $unapproveCount = Leave::where('leaves.status', '2')->count();
    
        $PendingCount = Leave::where('leaves.status', '3')->count();

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
                    // Round the percentage to two decimal places
                    $percentage = number_format($percentage, 2);
                    $leaveTypePercentages[$leaveTypeId] = $percentage;
                }
                $totalPercentage = array_sum($leaveTypePercentages);
                

        $allLeaves = Leave::select('users.first_name', 'users.email', 'users.profile_img', 'users.last_name', 'leaves.*')
                ->join('users', 'users.id', '=', 'leaves.user_id')
                ->orderBy('leaves.created_at', 'desc')
                ->get();

        $requestedLeaves = Leave::select('users.first_name', 'users.profile_img', 'users.email', 'users.last_name', 'leaves.*')
                        ->join('users', 'users.id', '=', 'leaves.user_id')
                        ->where('leaves.status', 3)
                        ->get();
        $ApproveLeaves = Leave::select('users.first_name', 'users.email', 'users.profile_img', 'users.last_name', 'leaves.*')
                    ->join('users', 'users.id', '=', 'leaves.user_id')
                    ->where('leaves.status', 1) // Assuming 1 is the status for pending leaves
                    ->get();

        $allEmp = User::select('users.id', 'users.first_name', 'users.email', 'users.last_name', 'users.status', 'users.profile_img')
            ->join('employee_details', 'employee_details.user_id', '=', 'users.id')
            ->where('users.type', 4)
            ->whereNull('users.deleted_at')
            ->get();
        return view('admin.Humanesources.Leave.home', compact('AuthRoles','allEmp', 'Leave','requestedLeaves', 'totalPercentage', 'LeaveType', 'todayonleave', 'searchTerm','workfromhome','workfromhomeCount','todayonleaveCount','approveCount','unapproveCount','leaveTypePercentages','PendingCount','allLeaves'));
    }

    public function views(Request $request, $id)
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
        $Log['url'] = url('/') . '/admin/Employee/edit/' . $id;
        $Log['method'] = 'Get';
        $Log['browser'] = $browser . '-' . $version;
        LogActivity::create($Log);

        return view('admin.Humanesources.Leave.view', compact(
            'id', 'Leave', 'AuthRoles', 'LeaveType', 'workfromhome', 'todayonleave', 'searchTerm',
            'todayonleaveCount', 'workfromhomeCount', 'leaveTypePercentages', 'totalPercentage',
            'myleaves', 'approveCount', 'unapproveCount', 'PendingCount', 'allLeaves', 'user_details'
        ));
    }


    public function home2(Request $request)
    {
        $query = Leave::select('users.profile_img','users.email','users.first_name','users.last_name','leaves.duration','leaves.days','leaves.user_id','leave_types.leave_type','leaves.start_date','leaves.id','leaves.user_id','leaves.status','employee_details.admin_type_id as RoleID')
            ->leftjoin('users','leaves.user_id','users.id')
            ->leftjoin('employee_details','employee_details.user_id','leaves.user_id')
            ->leftjoin('leave_types','leaves.leavetype_id','leave_types.id')
                    // ->leftjoin('leave_accesses','leaves.id','leave_accesses.leave_id')
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
                ->orWhere('leaves.approved_by', 'like', '%' . $searchTerm . '%');
            });
        }

        $Leave = $query->paginate(10);
        $Leave->appends(['search' => $searchTerm]);
            // echo "<pre>"; print_r($Leave); exit;
        $LeaveType = LeaveType::get();

        $workfromhome = Leave::select('users.first_name','leaves.start_date','leaves.duration','leaves.date')
        ->join('users','users.id','leaves.user_id')
        ->where('leaves.apply_for','2')
        ->orderBy('leaves.created_at', 'desc')
        ->paginate(10);

        $todayonleave = Leave::select('users.first_name','users.last_name','users.profile_img','users.email','leaves.start_date','leaves.duration','leaves.date')
        ->join('users','users.id','leaves.user_id')
        ->where('leaves.apply_for','1')
        ->orderBy('leaves.created_at', 'desc')
        ->paginate(10);
        $AuthRoles = 1;

        return view('admin.Humanesources.Leave.home2', compact('AuthRoles','Leave', 'LeaveType', 'workfromhome', 'todayonleave','searchTerm'));
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
        $Log['url'] = url('/') . '/admin/Leave/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        $Employee = User::select('first_name','id','last_name','profile_img')->where('type',4)->get();
        $LeaveType = LeaveType::get();
        return view('admin.Humanesources.Leave.create',compact('Employee','LeaveType')); 
    }


    //home page
    public function store(Request $req)
    {
        
        $data = $req->all();
        if($req->duration == 1){ 
            $data['days'] = 1;
        
        }elseif($req->duration == 2) {
            $startDate = $req->start_date; 
            $endDate = $req->end_date;
            $startDateTime = new DateTime($startDate);
            $endDateTime = new DateTime($endDate);
            $interval = $startDateTime->diff($endDateTime);
            $daysBetween = $interval->days+1;
            $data['days'] = $daysBetween;
        }else{
            $data['days'] = ".50";
        }if($req->date){
            $data['date'] = $req->date;
        }else{
            $data['date'] = $req->start_date;
        }

        if(!$req->start_date){ 
            $data['start_date'] = $req->date;
            $data['end_date'] = $req->date;
        }
        $data['user_id'] = $req->emp_Id2;
        // $data->status = $req->status;
        Leave::create($data);

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Leave Data Store By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Leave/store';
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);    

        return redirect('admin/Leave/home')->with('success', "New Leave Added Successfully");
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
        $Log['url'] = url('/') . '/admin/Leave/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('admin.Humanesources.Leave.edit',compact('Leave','Employee','LeaveType'));
    }

    //updated
    public function update(Request $req, $id)
    {
        // Find the leave record
        $data = Leave::find($id);
        
        // Update user_id and other basic fields
        $data->user_id = $data->user_id;
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

        // Log the update action
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Leave Data Updated By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Leave/update/' . $id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        // Redirect with success message
        return redirect('admin/Leave/home')->with('success', "Leave Edited Successfully");
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
        $Log['url'] = url('/') . '/admin/Leave/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('admin/Leave/home')->with('success', "Leave Deleted Successfully");
    }

        // get_leads_yeardata leads
    public function Show_leaves_yeardata(Request $request)
    {
        $year = $request->year;
        $month = $request->month;
        $AuthRoles = 1;

        $Leave = Leave::select('users.first_name','users.last_name','users.email','users.profile_img', 'leaves.duration', 'leaves.date', 'leave_types.leave_type', 'leaves.start_date', 'leaves.id','leaves.user_id', 'leaves.status','employee_details.job_role_id as RoleID')
        ->leftJoin('users', 'leaves.user_id', 'users.id')
        ->leftjoin('employee_details','employee_details.user_id','leaves.user_id')
        ->leftJoin('leave_types', 'leaves.leavetype_id', 'leave_types.id')
        ->whereYear('leaves.date', $year)
        ->whereMonth('leaves.date', $month)
        ->orWhere(function ($query) use ($year, $month) {
            $query->whereYear('leaves.start_date', $year)
            ->whereMonth('leaves.start_date', $month);
        })
        ->orderBy('leaves.created_at', 'desc')
        ->paginate(10);

        return view('admin.Humanesources.Leave.Show_leaves_yeardata', compact('Leave','AuthRoles'))
        ->with('success', "Data of: $year-$month Fetched Successfully");
        
        
    }  
      
        // Show_leaves_yeardata_single leads
    public function Show_leaves_yeardata_single(Request $request)
    {
        $year = $request->year;
        $month = $request->month;
        $id = $request->id;
        $checkLeave = Leave::find($id);
        $id = $checkLeave->user_id;
    
        $AuthRoles = 1;
        $Leave = Leave::select('users.first_name','users.last_name','users.email','users.profile_img', 'leaves.duration',  'leaves.start_date','leaves.end_date','leaves.*', 'leave_types.leave_type', 'leaves.start_date', 'leaves.id','leaves.user_id', 'leaves.status','employee_details.admin_type_id as RoleID')
            ->leftJoin('users', 'leaves.user_id', 'users.id')
            ->leftJoin('employee_details', 'employee_details.user_id', 'leaves.user_id')
            ->leftJoin('leave_types', 'leaves.leavetype_id', 'leave_types.id')
            ->where(function ($query) use ($year, $month, $id) {
                $query->whereYear('leaves.date', $year)
                    ->whereMonth('leaves.date', $month)
                    ->where('leaves.user_id', $id);
            })
            ->orWhere(function ($query) use ($year, $month, $id) {
                $query->whereYear('leaves.start_date', $year)
                    ->whereMonth('leaves.start_date', $month)
                    ->where('leaves.user_id', $id);
            })
            ->orderBy('leaves.created_at', 'desc')
            ->paginate(10);

        return view('admin.Humanesources.Leave.Show_leaves_yeardata_single', compact('Leave', 'AuthRoles'))
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

        $leaveData = Leave::find($LeaveId);
        if (!$leaveData) {
            return response()->json(['success' => false, 'message' => 'Leave Not Found.']);
        }

        $leaveStatus = Leave::find($LeaveId);
        $userDetail = EmployeeDetail::where('user_id', $empId)->first();
        $statusUP = LeaveAccess::where('leave_id', $LeaveId)->where('toGo', 1)->first();

        if ($statusUP) {
            $statusUP->status = $request->status;
            $statusUP->approved_by = $request->ApproveID ?? Auth::user()->id;
            $statusUP->save();

            if ($request->status == 1) {
                $leaveStatus->leaveApproved += 1;
            } elseif ($request->status == 2) {
                $leaveStatus->leaveUnApproved = 1;
                $leaveStatus->leaveApproved = 0;
            }

            // Determine leave status based on role and approval status
            $finalStatus = 3;
            if ($userDetail) {
                if ($userDetail->job_role_id != 2) {
                    // For non-HR roles
                    $hr_status = LeaveAccess::where('leave_id', $LeaveId)->where('toGo', 2)->first();
                    $admin_status = LeaveAccess::where('leave_id', $LeaveId)->where('toGo', 1)->first();
                    if ($admin_status && $admin_status->status == 1) {
                        if ($hr_status && $hr_status->status == 1) {
                            $finalStatus = 1;
                        } elseif ($hr_status && $hr_status->status == 2) {
                            $finalStatus = 2;
                        }
                    } elseif ($admin_status && $admin_status->status == 2) {
                        $finalStatus = 2;
                    }
                } elseif ($userDetail->job_role_id == 2) {
                    // For HR role
                    $admin_status = LeaveAccess::where('leave_id', $LeaveId)->where('toGo', 1)->first();
                    if ($admin_status && $admin_status->status == 1) {
                        $finalStatus = 1;
                    } elseif ($admin_status && $admin_status->status == 2) {
                        $finalStatus = 2;
                    }
                }
            }
            $leaveStatus->status = $finalStatus;
            $leaveStatus->save();

            // Trigger event and send email based on final status
            if ($finalStatus == 1) {
                event(new SingleEvent($leaveData->user_id, 'Leave has been Approved #' . $leaveData->id));
                $this->sendEmailNotification($leaveData->user_id, 'Leave Request Approval', $leaveStatus);
            } elseif ($finalStatus == 2) {
                event(new SingleEvent($leaveData->user_id, 'Leave has been Unapproved #' . $leaveData->id));
                $this->sendEmailNotification($leaveData->user_id, 'Leave Request Rejection', $leaveStatus);
            } else {
                return response()->json(['success' => true, 'message' => 'Leave Pending successfully.']);
            }
        } else {
            return response()->json(['success' => false, 'message' => 'Leave Not Found.']);
        }

        return response()->json(['success' => true, 'message' => $finalStatus == 1 ? 'Leave Approved successfully.' : 'Leave Unapproved successfully.']);
    }

    private function sendEmailNotification($userId, $templateName, $leaveStatus)
    {
        $templateSettings = Template::where('name', $templateName)->first();
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
