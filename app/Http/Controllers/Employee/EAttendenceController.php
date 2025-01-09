<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Collection;
use App\Models\AttendenceDetails;
use Jenssegers\Agent\Agent;
use App\Models\EmployeeDetail;
use App\Models\TimeShift;
use App\Models\LogActivity;
use Illuminate\Support\Str;
use App\Models\Attendence;
use App\Models\User;
use Carbon\Carbon;
use Hash;
use Auth;
use DB;
use DateTime;
use DateInterval;



class EAttendenceController extends Controller
{   
//home page
public function home(Request $request)
{

// Get the current month and year or the selected month and year from the request
    $currentMonth = Carbon::now()->month;
    $currentYear = Carbon::now()->year;

    $selectedMonth = $request->input('month', $currentMonth);
    $selectedYear = $request->input('year', $currentYear);

    // Calculate start and end dates for the selected month and year
    $startDate = Carbon::create($selectedYear, $selectedMonth)->startOfMonth()->toDateString();
    $endDate = Carbon::create($selectedYear, $selectedMonth)->endOfMonth()->toDateString();
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

    if($RoleAccess[array_search('Attendence', array_column($RoleAccess, 'per_name'))]['view'] == 1)
    {
         // Get user data
    $currentMonth = Carbon::now()->month;
    $currentYear = Carbon::now()->year;

    $selectedMonth = $request->input('month', $currentMonth);
    $selectedYear = $request->input('year', $currentYear);

    $startDate = Carbon::create($selectedYear, $selectedMonth)->startOfMonth()->toDateString();
    $endDate = Carbon::create($selectedYear, $selectedMonth)->endOfMonth()->toDateString();

    // Fetch data from database
    $User = DB::table('attendences as a')
        ->leftJoin('employee_details as e', 'a.emp_id', '=', 'e.user_id')
        ->leftJoin('time_shifts as ts', 'ts.id', '=', 'e.shift_id')
        ->leftJoin('users as us', 'us.id', '=', 'e.user_id')
        ->where('us.type', 4)
        ->where('a.emp_id', '!=', '1')
        ->whereBetween('a.punch_date', [$startDate, $endDate])
        ->select(
            'a.emp_id',
            'us.first_name',
            'us.last_name',
            'e.jobrole_id',
            'us.profile_img',
            DB::raw('SUM(TIMESTAMPDIFF(SECOND, a.punch_in, a.punch_out)) as total_seconds')
        )
        ->groupBy('a.emp_id')
        ->get();

    // Calculate breaks manually
    foreach ($User as $row) {
        $breakTime = $this->calculateBreakTime($row->emp_id, $startDate, $endDate);
        $row->break_seconds = $breakTime;
    }

    // Calculate average working hours
    $averageWorkingHoursData = DB::table('attendences as a')
        ->leftJoin('employee_details as e', 'a.emp_id', '=', 'e.user_id')
        ->leftJoin('time_shifts as ts', 'ts.id', '=', 'e.shift_id')
        ->leftJoin('users as us', 'us.id', '=', 'e.user_id')
        ->where('us.type', 4)
        ->whereBetween('a.punch_date', [$startDate, $endDate])
        ->select(
            DB::raw('SUM(TIMESTAMPDIFF(SECOND, a.punch_in, a.punch_out)) as total_seconds'),
            DB::raw('COUNT(DISTINCT a.emp_id) as total_employees')
        )
        ->first();

    $totalEmployees = $averageWorkingHoursData->total_employees;
    $totalWorkingHours = $averageWorkingHoursData->total_seconds;
    $averageWorkingHours = $totalEmployees > 0 ? $totalWorkingHours / $totalEmployees : 0;

    $averageHours = floor($averageWorkingHours / 3600);
    $averageMinutes = floor(($averageWorkingHours % 3600) / 60);
    $averageSeconds = $averageWorkingHours % 60;
    $averageWorkingHours = "{$averageHours}h {$averageMinutes}min {$averageSeconds}sec";

    // Calculate average check-in and check-out times
    $averageCheckInTime = DB::table('attendences as a')
        ->leftJoin('employee_details as e', 'a.emp_id', '=', 'e.user_id')
        ->leftJoin('time_shifts as ts', 'ts.id', '=', 'e.shift_id')
        ->leftJoin('users as us', 'us.id', '=', 'e.user_id')
        ->where('us.type', 4)
        ->whereBetween('a.punch_date', [$startDate, $endDate])
        ->select(DB::raw('TIME_FORMAT(AVG(TIME(a.punch_in)), "%H:%i:%s") AS average_check_in'))
        ->first()
        ->average_check_in;

    $averageCheckOutTime = DB::table('attendences as a')
        ->leftJoin('employee_details as e', 'a.emp_id', '=', 'e.user_id')
        ->leftJoin('time_shifts as ts', 'ts.id', '=', 'e.shift_id')
        ->leftJoin('users as us', 'us.id', '=', 'e.user_id')
        ->where('us.type', 4)
        ->whereBetween('a.punch_date', [$startDate, $endDate])
        ->select(DB::raw('TIME_FORMAT(AVG(TIME(a.punch_out)), "%H:%i:%s") AS average_check_out'))
        ->first()
        ->average_check_out;

    // Calculate on-time arrivals
    $onTimeArrivals = DB::table('attendences as a')
        ->leftJoin('employee_details as e', 'a.emp_id', '=', 'e.user_id')
        ->leftJoin('time_shifts as ts', 'ts.id', '=', 'e.shift_id')
        ->leftJoin('users as us', 'us.id', '=', 'e.user_id')
        ->where('us.type', 4)
        ->whereBetween('a.punch_date', [$startDate, $endDate])
        ->whereRaw('TIME(a.punch_in) <= TIME(ts.StartTime)')
        ->count();

    // Calculate total overtime
    $totalOvertimeData = DB::table('attendences as a')
        ->leftJoin('employee_details as e', 'a.emp_id', '=', 'e.user_id')
        ->leftJoin('time_shifts as ts', 'ts.id', '=', 'e.shift_id')
        ->leftJoin('users as us', 'us.id', '=', 'e.user_id')
        ->where('us.type', 4)
        ->whereBetween('a.punch_date', [$startDate, $endDate])
        ->whereNotNull('a.punch_out')
        ->whereRaw('TIME(a.punch_out) > TIME(ts.EndTime)')
        ->select(DB::raw('SUM(TIMESTAMPDIFF(SECOND, ts.EndTime, a.punch_out)) as total_overtime_seconds'))
        ->first();

    $totalOvertimeSeconds = $totalOvertimeData->total_overtime_seconds;
    $totalOvertimeInHours = floor($totalOvertimeSeconds / 3600);
    $totalOvertimeInMinutes = floor(($totalOvertimeSeconds % 3600) / 60);
    $totalOvertimeInSeconds = $totalOvertimeSeconds % 60;
    $totalOvertime = "{$totalOvertimeInHours}h {$totalOvertimeInMinutes}min {$totalOvertimeInSeconds}sec";

    // Calculate total production hours
    $totalProductionData = DB::table('attendences as a')
        ->leftJoin('employee_details as e', 'a.emp_id', '=', 'e.user_id')
        ->leftJoin('time_shifts as ts', 'ts.id', '=', 'e.shift_id')
        ->leftJoin('users as us', 'us.id', '=', 'e.user_id')
        ->where('us.type', 4)
        ->whereBetween('a.punch_date', [$startDate, $endDate])
        ->select(DB::raw('SUM(TIMESTAMPDIFF(SECOND, a.punch_in, a.punch_out)) as total_production_seconds'))
        ->first();

    $totalProductionSeconds = $totalProductionData->total_production_seconds;
    $totalProductionHours = floor($totalProductionSeconds / 3600);
    $totalProductionMinutes = floor(($totalProductionSeconds % 3600) / 60);
    $totalProductionSeconds = $totalProductionSeconds % 60;
    $totalProductionHours = "{$totalProductionHours}h {$totalProductionMinutes}min {$totalProductionSeconds}sec";

        
    }

    if($RoleAccess[array_search('Attendence', array_column($RoleAccess, 'per_name'))]['view'] == 2)
    {
         // Get user data
        $User = DB::table('attendences as a')
            ->leftJoin('employee_details as e', 'a.emp_id', '=', 'e.user_id')
            ->leftJoin('time_shifts as ts', 'ts.id', '=', 'e.shift_id')
            ->leftJoin('users as us', 'us.id', '=', 'e.user_id')
            ->where('us.type', 4)
            ->where('a.emp_id','!=','1')
            ->whereBetween('a.punch_date', [$startDate, $endDate])
            ->select(
                DB::raw('MIN(ts.working_hours) as shifthours'),
                'a.punch_in',
                'a.punch_out',
                'a.emp_id',
                'us.first_name',
                'us.last_name',
                'us.profile_img',
                'us.email',
                'e.jobrole_id',
                'ts.EndTime',
                DB::raw('(MAX(a.punch_out) - MIN(a.punch_in)) / 3600 as total_hours'), // Convert seconds to hours
                DB::raw('SUM(TIMESTAMPDIFF(MINUTE, a.punch_in, a.punch_out)) / 60 as actualworkinghours') // Convert minutes to hours
            )
            ->groupBy('a.emp_id')
        ->where('e.user_id',Auth::user()->id)
        ->get();

              // Calculate average working hours
        $averageWorkingHoursData = DB::table('attendences as a')
            ->leftJoin('employee_details as e', 'a.emp_id', '=', 'e.user_id')
            ->leftJoin('time_shifts as ts', 'ts.id', '=', 'e.shift_id')
            ->leftJoin('users as us', 'us.id', '=', 'e.user_id')
            ->where('us.type', 4)
            ->whereBetween('a.punch_date', [$startDate, $endDate])
            ->select(
                DB::raw('MIN(ts.working_hours) as shifthours'),
                'a.emp_id',
                'us.first_name',
                'us.profile_img',
                'us.email',
                DB::raw('(MAX(TIMESTAMP(a.punch_date, a.punch_out)) - MIN(TIMESTAMP(a.punch_date, a.punch_in))) as total_hours'),
                DB::raw('SUM(TIMESTAMPDIFF(MINUTE, TIMESTAMP(a.punch_date, a.punch_in), TIMESTAMP(a.punch_date, a.punch_out)) / 60) as actualworkinghours')
            )
            ->groupBy('a.emp_id')
            ->where('e.user_id',Auth::user()->id)
            ->get();
    
        $totalEmployees = $averageWorkingHoursData->count();
        if ($totalEmployees > 0) {
            $totalWorkingHours = $averageWorkingHoursData->sum('actualworkinghours');
            $averageWorkingHours = $totalWorkingHours / $totalEmployees;
        } else {
            $averageWorkingHours = 0;
        }
        
        
        // Convert the average working hours to hours and minutes
        $averageHours = floor($averageWorkingHours);
        $averageMinutes = round(($averageWorkingHours - $averageHours) * 60);
    
        // Format the average working hours as a string
        $averageWorkingHours = "{$averageHours}h {$averageMinutes}min";
    
        // Calculate average check-in time
        $averageCheckInTime = DB::table('attendences as a')
            ->leftJoin('employee_details as e', 'a.emp_id', '=', 'e.user_id')
            ->leftJoin('time_shifts as ts', 'ts.id', '=', 'e.shift_id')
            ->leftJoin('users as us', 'us.id', '=', 'e.user_id')
            ->where('us.type', 4)
            ->whereBetween('a.punch_date', [$startDate, $endDate])
            ->where('e.user_id',Auth::user()->id)
            ->select(
                DB::raw('TIME_FORMAT(AVG(TIME(a.punch_in)), "%h:%i %p") AS average_check_in')
            )
            ->first();
    
        $averageCheckInTime = $averageCheckInTime ? $averageCheckInTime->average_check_in : null;
    
        // Calculate on-time arrivals
        $onTimeArrivals = DB::table('attendences as a')
            ->leftJoin('employee_details as e', 'a.emp_id', '=', 'e.user_id')
            ->leftJoin('time_shifts as ts', 'ts.id', '=', 'e.shift_id')
            ->leftJoin('users as us', 'us.id', '=', 'e.user_id')
            ->where('us.type', 4)
            ->groupBy('a.emp_Id')
            ->whereBetween('a.punch_date', [$startDate, $endDate])
            ->whereRaw('TIME(a.punch_in) <= TIME(ts.StartTime)')
            ->where('e.user_id',Auth::user()->id)
            ->count();
    
        // Calculate average check-out time
        $averageCheckOutTime = DB::table('attendences as a')
            ->leftJoin('employee_details as e', 'a.emp_id', '=', 'e.user_id')
            ->leftJoin('time_shifts as ts', 'ts.id', '=', 'e.shift_id')
            ->leftJoin('users as us', 'us.id', '=', 'e.user_id')
            ->where('us.type', 4)
            ->whereBetween('a.punch_date', [$startDate, $endDate])
            ->where('e.user_id',Auth::user()->id)
            ->select(
                DB::raw('TIME_FORMAT(AVG(TIME(a.punch_out)), "%h:%i %p") AS average_check_out')
            )
            ->first();
    
        $averageCheckOutTime = $averageCheckOutTime ? $averageCheckOutTime->average_check_out : null;
    
        // Get total overtime for the selected month
        $totalOvertime = DB::table('attendences as a')
            ->leftJoin('employee_details as e', 'a.emp_id', '=', 'e.user_id')
            ->leftJoin('time_shifts as ts', 'ts.id', '=', 'e.shift_id')
            ->leftJoin('users as us', 'us.id', '=', 'e.user_id')
            ->select(DB::raw('SUM(TIMESTAMPDIFF(SECOND, ts.EndTime, a.punch_out)) as total_overtime_seconds'))
            ->where('us.type', 4)
            ->whereBetween('a.punch_date', [$startDate, $endDate])
            ->whereNotNull('a.punch_out')
            ->whereRaw('TIME(a.punch_out) > TIME(ts.EndTime)')
            ->where('e.user_id',Auth::user()->id)
            ->first();
    
        // Convert total overtime seconds to hours and minutes
        $totalOvertimeSeconds = $totalOvertime->total_overtime_seconds;
        $totalOvertimeInHours = floor($totalOvertimeSeconds / 3600);
        $totalOvertimeInMinutes = floor(($totalOvertimeSeconds % 3600) / 60);
    
        // Format the overtime as a string
        $totalOvertime = "{$totalOvertimeInHours}h {$totalOvertimeInMinutes}min";
        
         // Calculate total production hours for the selected month
        $totalProductionHoursData = DB::table('attendences as a')
            ->leftJoin('employee_details as e', 'a.emp_id', '=', 'e.user_id')
            ->leftJoin('time_shifts as ts', 'ts.id', '=', 'e.shift_id')
            ->leftJoin('users as us', 'us.id', '=', 'e.user_id')
            ->where('us.type', 4)
            ->whereBetween('a.punch_date', [$startDate, $endDate])
            ->where('e.user_id',Auth::user()->id)
            ->select(
                DB::raw('SUM(TIMESTAMPDIFF(MINUTE, TIMESTAMP(a.punch_date, a.punch_in), TIMESTAMP(a.punch_date, a.punch_out))) as total_production_minutes')
            )
            ->first();
    
        // Convert the total production minutes to hours and minutes
        $totalProductionMinutes = $totalProductionHoursData->total_production_minutes;
        $totalProductionHours = floor($totalProductionMinutes / 60);
        $totalProductionRemainingMinutes = $totalProductionMinutes % 60;
    
        // Format the total production hours as a string
        $totalProductionHours = "{$totalProductionHours}h {$totalProductionRemainingMinutes}min";

    // return $totalProductionHours;     
    }

    return view('Employee.Humanesources.Attendence.home', compact('User','RoleAccess', 'averageWorkingHours', 'averageCheckInTime', 'onTimeArrivals', 'averageCheckOutTime', 'totalOvertime', 'selectedMonth', 'selectedYear', 'totalProductionHours','startDate','endDate'));
}

private function calculateBreakTime($emp_id, $startDate, $endDate)
{
    // Fetch all punches for the employee
    $punches = DB::table('attendences')
        ->where('emp_id', $emp_id)
        ->whereBetween('punch_date', [$startDate, $endDate])
        ->orderBy('punch_in')
        ->get();

    $breakTime = 0;
    $lastPunchOut = null;

    foreach ($punches as $punch) {
        if ($lastPunchOut) {
            $breakTime += max(0, strtotime($punch->punch_in) - strtotime($lastPunchOut));
        }
        $lastPunchOut = $punch->punch_out;
    }

    return $breakTime;
}

public function punch_out(Request $request, $id){
    $data = Attendence::find($id);

    if (!$data) {
        return response()->json(['error' => 'Attendance record not found.'], 404);
    }

    $data->emp_Id = $request->user_id;
    $data->punch_out = $request->punch_out;
    $data->punch_date = $request->punch_out; // Assuming punch_date should be updated as well

    $data->save();

    return response()->json(['message' => 'Punch-out details updated successfully.']);
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
    $Log['subject'] = "Attendence Create Page is View By " . Auth::user()->first_name;
    $Log['url'] = url('/') . '/Employee/Attendence/Create';
    $Log['method'] = "Get";
    $Log['browser'] = $browser . "-" . $version;
    LogActivity::create($Log);

            $Employee = User::
             leftjoin('employee_details','employee_details.user_id','users.id')
             ->leftjoin('roles','roles.id','employee_details.job_role_id')
             ->select('users.first_name','users.last_name','users.profile_img','roles.name as jobrole','users.id')
             ->where('users.type',4)
             ->get();
    return view('Employee.Humanesources.Attendence.create',compact('Employee')); 
}


//home page
public function store(Request $req)
{

    $data = $req->all();
    Attendence::create($data);
    
    $agent = new Agent();
    $browser = $agent->browser();
    $version = $agent->version($browser);
    $Log = $req->all();
    $Log['user_id'] = Auth::user()->id;
    $Log['ip'] = $req->ip();
    $Log['subject'] = "Attendence Data Store By " . Auth::user()->first_name;
    $Log['url'] = url('/') . '/Employee/Attendence/store';
    $Log['method'] = "Post";
    $Log['browser'] = $browser . "-" . $version;
    LogActivity::create($Log);    

    return redirect('Employee/Attendence/home')->with('success', "New Attendence Added Successfully");
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
    $Log['subject'] = "Attendence Edit Page is View By " . Auth::user()->first_name;
    $Log['url'] = url('/') . '/Employee/Attendence/edit/'.$id;
    $Log['method'] = "Get";
    $Log['browser'] = $browser . "-" . $version;
    LogActivity::create($Log);

    $Attendence = Attendence::find($id);
        $Employee = User::
             leftjoin('employee_details','employee_details.user_id','users.id')
             ->leftjoin('roles','roles.id','employee_details.job_role_id')
             ->select('users.first_name','users.last_name','roles.name as jobrole','users.id')
             ->where('users.type',4)
             ->get();
    return view('Employee.Humanesources.Attendence.edit',compact('Attendence','Employee'));
}
public function View(Request $req, $id)
{
    // Get the current or selected month and year
    $currentMonth = Carbon::now()->month;
    $currentYear = Carbon::now()->year;

    $selectedMonth = $req->input('month', $currentMonth);
    $selectedYear = $req->input('year', $currentYear);

    $startDate = Carbon::create($selectedYear, $selectedMonth)->startOfMonth()->toDateString();
    $endDate = Carbon::create($selectedYear, $selectedMonth)->endOfMonth()->toDateString();

    $user = User::join('employee_details', 'users.id', 'employee_details.user_id')
        ->select('users.*', 'employee_details.jobrole_id')
        ->where('users.id', $id)
        ->first();

    $Attendence = Attendence::where('punch_date', date('Y-m-d'))->where('emp_Id', $id)->first();
    $employee = EmployeeDetail::where('user_id', $id)->first();
    $TimeShift = TimeShift::find($employee->shift_id);
    $officeStartTime = $TimeShift->StartTime;
    $officeEndTime = $TimeShift->EndTime;
    $totalOfficeHours = Carbon::parse($officeEndTime)->diffInMinutes(Carbon::parse($officeStartTime)) / 60;

    $daysInMonth = Carbon::now()->daysInMonth;
    $totalPossibleHours = $totalOfficeHours * $daysInMonth;

    $lastWeekStartDate = Carbon::now()->startOfWeek()->subWeek()->toDateString();
    $lastWeekEndDate = Carbon::now()->startOfWeek()->subWeek()->endOfWeek()->toDateString();

    $lastWeekAvgWorkingHours = DB::table('attendences as a')
        ->select(
            DB::raw('AVG(TIMESTAMPDIFF(MINUTE, a.punch_in, a.punch_out) / 60) as avg_working_hours')
        )
        ->where('a.emp_id', $id)
        ->whereBetween('a.punch_date', [$lastWeekStartDate, $lastWeekEndDate])
        ->first();

    $officeTime = DB::table('attendences as a')
        ->select(
            DB::raw('SUM(TIMESTAMPDIFF(MINUTE, a.punch_in, a.punch_out) / 60) as actualworkinghours')
        )
        ->where('a.emp_id', $id)
        ->whereMonth('a.punch_date', $currentMonth)
        ->get();

    $totalActualWorkingHours = $officeTime->sum('actualworkinghours');
    $percentage = $totalPossibleHours > 0 ? number_format(($totalActualWorkingHours / $totalPossibleHours) * 100, 2) : 0.00;

    $currentMonth = new DateTime('first day of this month');
    $months = [];

    for ($i = 0; $i < 6; $i++) {
        $month = clone $currentMonth;
        $month->sub(new DateInterval('P' . $i . 'M'));
        $months[] = $month->format('F');
    }

    $months = array_reverse($months);
    $attendancePercentages = [];
    $attendanceData = [];

    foreach ($months as $monthName) {
        $monthStartDate = Carbon::parse('first day of ' . $monthName)->startOfMonth()->format('Y-m-d');
        $monthEndDate = Carbon::parse('last day of ' . $monthName)->format('Y-m-d');

        $attendanceCount = DB::table('attendences as a')
            ->leftJoin('employee_details as e', 'a.emp_id', '=', 'e.user_id')
            ->leftJoin('time_shifts as ts', 'ts.id', '=', 'e.shift_id')
            ->leftJoin('users as us', 'us.id', '=', 'e.user_id')
            ->where('us.type', 4)
            ->whereBetween('a.punch_date', [$monthStartDate, $monthEndDate])
            ->count();

        $totalWorkingDays = Carbon::parse('first day of ' . $monthName)->endOfMonth()->diffInWeekdays(Carbon::parse('first day of ' . $monthName)->startOfMonth()) + 1;
        $attendancePercentage = ($attendanceCount / $totalWorkingDays) * 100;
        $attendancePercentages[] = number_format($attendancePercentage, 2);

        $attendanceData[] = [
            'month' => $monthName,
            'percentage' => number_format($attendancePercentage, 2)
        ];
    }

    $attendances = Attendence::join('employee_details as e', 'attendences.emp_id', '=', 'e.user_id')
        ->join('time_shifts as ts', 'e.shift_id', '=', 'ts.id')
        ->whereYear('attendences.punch_date', date('Y'))
        ->whereMonth('attendences.punch_date', date('m'))
        ->select('attendences.*', 'ts.working_hours as ts_working_hrs',
            DB::raw('(TIMESTAMPDIFF(MINUTE, attendences.punch_in, attendences.punch_out) / 60) as working_hours')
        )
        ->where('attendences.emp_id', Auth::user()->id)
        ->paginate(10);

    $attendance = DB::table('attendences as a')
        ->leftJoin('employee_details as e', 'a.emp_id', '=', 'e.user_id')
        ->leftJoin('time_shifts as ts', 'ts.id', '=', 'e.shift_id')
        ->leftJoin('users as us', 'us.id', '=', 'e.user_id')
        ->where('us.type', 4)
        ->where('a.emp_id', '!=', '1')
        ->whereBetween('a.punch_date', [$startDate, $endDate])
        ->select(
            DB::raw('MIN(ts.working_hours) as shifthours'),
            'a.*',
            'us.first_name',
            'us.last_name',
            'us.profile_img',
            'us.email',
            'e.jobrole_id',
            'ts.working_hours as ts_working_hrs',
            'ts.EndTime',
            DB::raw('(MAX(a.punch_out) - MIN(a.punch_in)) / 3600 as total_hours'),
            DB::raw('SUM(TIMESTAMPDIFF(MINUTE, a.punch_in, a.punch_out)) / 60 as actualworkinghours')
        )
        ->groupBy('a.emp_id')
        ->where('a.emp_id', Auth::user()->id)
        ->paginate(10);

    $averageWorkingHoursData = DB::table('attendences as a')
        ->leftJoin('employee_details as e', 'a.emp_id', '=', 'e.user_id')
        ->leftJoin('time_shifts as ts', 'ts.id', '=', 'e.shift_id')
        ->leftJoin('users as us', 'us.id', '=', 'e.user_id')
        ->where('us.type', 4)
        ->whereBetween('a.punch_date', [$startDate, $endDate])
        ->select(
            DB::raw('MIN(ts.working_hours) as shifthours'),
            'a.emp_id',
            'us.first_name',
            'us.profile_img',
            'us.email',
            DB::raw('(MAX(TIMESTAMP(a.punch_date, a.punch_out)) - MIN(TIMESTAMP(a.punch_date, a.punch_in))) as total_hours'),
            DB::raw('SUM(TIMESTAMPDIFF(MINUTE, TIMESTAMP(a.punch_date, a.punch_in), TIMESTAMP(a.punch_date, a.punch_out)) / 60) as actualworkinghours')
        )
        ->groupBy('a.emp_id')
        ->where('e.user_id', Auth::user()->id)
        ->get();

    $totalEmployees = $averageWorkingHoursData->count();
    $averageWorkingHours = $totalEmployees > 0
        ? $averageWorkingHoursData->sum('actualworkinghours') / $totalEmployees
        : 0;

    $averageHours = floor($averageWorkingHours);
    $averageMinutes = round(($averageWorkingHours - $averageHours) * 60);
    $averageWorkingHours = "{$averageHours}h {$averageMinutes}min";

    $averageCheckInTime = DB::table('attendences as a')
        ->leftJoin('employee_details as e', 'a.emp_id', '=', 'e.user_id')
        ->leftJoin('time_shifts as ts', 'ts.id', '=', 'e.shift_id')
        ->leftJoin('users as us', 'us.id', '=', 'e.user_id')
        ->where('us.type', 4)
        ->whereBetween('a.punch_date', [$startDate, $endDate])
        ->where('e.user_id', Auth::user()->id)
        ->select(
            DB::raw('TIME_FORMAT(AVG(TIME(a.punch_in)), "%h:%i %p") AS average_check_in')
        )
        ->first();
    $averageCheckInTime = $averageCheckInTime ? $averageCheckInTime->average_check_in : null;

    $onTimeArrivals = DB::table('attendences as a')
        ->leftJoin('employee_details as e', 'a.emp_id', '=', 'e.user_id')
        ->leftJoin('time_shifts as ts', 'ts.id', '=', 'e.shift_id')
        ->leftJoin('users as us', 'us.id', '=', 'e.user_id')
        ->where('us.type', 4)
        ->whereBetween('a.punch_date', [$startDate, $endDate])
        ->where('a.punch_in', '<=', 'ts.StartTime')
        ->where('e.user_id', Auth::user()->id)
        ->select(
            DB::raw('COUNT(*) AS on_time_arrivals')
        )
        ->first();
    $onTimeArrivals = $onTimeArrivals ? $onTimeArrivals->on_time_arrivals : 0;

    $attendanceDataSummary = DB::table('attendences as a')
        ->leftJoin('employee_details as e', 'a.emp_id', '=', 'e.user_id')
        ->leftJoin('time_shifts as ts', 'ts.id', '=', 'e.shift_id')
        ->leftJoin('users as us', 'us.id', '=', 'e.user_id')
        ->where('us.type', 4)
        ->whereBetween('a.punch_date', [$startDate, $endDate])
        ->where('e.user_id', Auth::user()->id)
        ->select(
            DB::raw('SUM(TIMESTAMPDIFF(MINUTE, a.punch_in, a.punch_out) / 60) AS total_working_hours'),
            DB::raw('MIN(ts.working_hours) AS shift_hours'),
            DB::raw('COUNT(*) AS total_working_days')
        )
        ->first();

    $attendanceDataSummary->total_working_hours = $attendanceDataSummary->total_working_hours ?? 0;
    $attendanceDataSummary->total_working_days = $attendanceDataSummary->total_working_days ?? 0;
   $user = User::join('employee_details','users.id','employee_details.user_id')
        ->select('users.*','employee_details.jobrole_id')
        ->where('users.id',$id)
        ->first();
            $months = [];
        
        for ($i = 0; $i < 6; $i++) {
            $month = clone $currentMonth;
            $month->sub(new DateInterval('P' . $i . 'M')); 
            $months[] = $month->format('F'); 
        }
        
        $months = array_reverse($months);
        
        $attendancePercentages = [];
        $attendanceData = [];
        foreach ($months as $monthName) {
            $monthStartDate = Carbon::parse('first day of ' . $monthName)->startOfMonth()->format('Y-m-d');
            $monthEndDate = Carbon::parse('last day of ' . $monthName)->format('Y-m-d');
            
            $attendanceCount = DB::table('attendences as a')
                ->leftJoin('employee_details as e', 'a.emp_id', '=', 'e.user_id')
                ->leftJoin('time_shifts as ts', 'ts.id', '=', 'e.shift_id')
                ->leftJoin('users as us', 'us.id', '=', 'e.user_id')
                ->where('us.type', 4)
                ->whereBetween('a.punch_date', [$monthStartDate, $monthEndDate])
                ->count();
                
            $totalWorkingDays = Carbon::parse('first day of ' . $monthName)->endOfMonth()->diffInWeekdays(Carbon::parse('first day of ' . $monthName)->startOfMonth()) + 1;
            
            $attendancePercentage = ($attendanceCount / $totalWorkingDays) * 100;
            $attendancePercentages[] = number_format($attendancePercentage, 2);
            
            $attendanceData[] = [
                'month' => $monthName,
                'percentage' => number_format($attendancePercentage, 2)
            ];
        }
        
        $attendances = Attendence::join('employee_details as e', 'attendences.emp_id', '=', 'e.user_id')
        ->join('time_shifts as ts', 'e.shift_id', '=', 'ts.id')
        ->whereYear('attendences.punch_date', date('Y'))
        ->whereMonth('attendences.punch_date', date('m'))
        ->select('attendences.*', 'ts.working_hours as ts_working_hrs',
            DB::raw('(TIMESTAMPDIFF(MINUTE, attendences.punch_in, attendences.punch_out) / 60) as working_hours')
        )
        ->where('attendences.emp_id', $id)
        ->paginate(10);

         $attendance2 = DB::table('attendences as a')
    ->leftJoin('employee_details as e', 'a.emp_id', '=', 'e.user_id')
    ->leftJoin('time_shifts as ts', 'ts.id', '=', 'e.shift_id')
    ->leftJoin('users as us', 'us.id', '=', 'e.user_id')
    ->where('us.type', 4)
    ->where('a.emp_id', '!=', '1')
    ->whereBetween('a.punch_date', [$startDate, $endDate])
    ->where('a.emp_id', $id)
    ->select(
        'a.*',
        'us.first_name',
        'us.last_name',
        'us.profile_img',
        'us.email',
        'e.jobrole_id',
        'ts.working_hours as ts_working_hrs',
        'ts.EndTime',
        DB::raw('TIMESTAMPDIFF(SECOND, ts.EndTime, a.punch_out) as overtime_seconds'), // Calculate overtime in seconds
        DB::raw('MIN(ts.working_hours) as shifthours'), // Ensure this field is included
        DB::raw('SUM(TIMESTAMPDIFF(SECOND, a.punch_in, a.punch_out)) / 3600 as total_hours'), // Total hours
        DB::raw('SUM(TIMESTAMPDIFF(MINUTE, a.punch_in, a.punch_out)) / 60 as actualworkinghours') // Actual working hours
    )
    ->groupBy('a.punch_date', 'a.emp_id', 'a.id', 'us.first_name', 'us.last_name', 'us.profile_img', 'us.email', 'e.jobrole_id', 'ts.working_hours', 'ts.EndTime') // Ensure to include all selected fields in the group by
    ->get();
    return view('Employee.Humanesources.Attendence.view')->with([
        'Attendence' => $Attendence,
        'user' => $user,
        'endDate' => $endDate,
        'id' => $id,
        'startDate' => $startDate,
        'attendanceData' => $attendanceData,
        'attendance2' => $attendance2,
        'attendance' => $attendance,
        'employee' => $employee,
        'averageWorkingHours' => $averageWorkingHours,
        'averageCheckInTime' => $averageCheckInTime,
        'onTimeArrivals' => $onTimeArrivals,
        'totalPossibleHours' => $totalPossibleHours,
        'percentage' => $percentage,
        'officeTime' => $officeTime,
        'daysInMonth' => $daysInMonth,
        'lastWeekAvgWorkingHours' => $lastWeekAvgWorkingHours,
        'attendancePercentages' => $attendancePercentages,
        'attendanceDataSummary' => $attendanceDataSummary
    ]);
}

//GetMonthYearData
public function GetMonthYearData(Request $request)
{
    $year = $request->year;
        $month = $request->month;

        $Attendence  = Attendence::where('emp_Id', $request->id)->where('punch_date', 'LIKE', "$year-$month%")
                      ->orderBy('created_at', 'desc')
                      ->get();
    return view('Employee.Humanesources.Attendence.GetMonthYearData',compact('Attendence'));
}




//updated
public function update(Request $req,$id)
{
 
    $data =Attendence::find($id);
    $data['emp_Id'] = $req->emp_Id;
    $data['punch_date'] = $req->punch_date;
    $data['punch_in'] = $req->punch_in;
    $data['punch_out'] = $req->punch_out;
    $data->save();    

    $agent = new Agent();
    $browser = $agent->browser();
    $version = $agent->version($browser);
    $Log = $req->all();
    $Log['user_id'] = Auth::user()->id;
    $Log['ip'] = $req->ip();
    $Log['subject'] = "Attendence Data Updated  By " . Auth::user()->first_name;
    $Log['url'] = url('/') . '/Employee/Attendence/update/'.$id;
    $Log['method'] = "Post";
    $Log['browser'] = $browser . "-" . $version;
    LogActivity::create($Log);

    return redirect('Employee/Attendence/home')->with('success', "Attendence Edit Successfully");
}

 public function delete(Request $request,$id)
{
    $agent = new Agent();
    $browser = $agent->browser();
    $version = $agent->version($browser);
    $Log = $request->all();
    $Log['user_id'] = Auth::user()->id;
    $Log['ip'] = $request->ip();
    $Log['subject'] = "Attendence Data Deleted  By " . Auth::user()->first_name;
    $Log['url'] = url('/') . '/Employee/Attendence/delete/'.$id;
    $Log['method'] = "Get";
    $Log['browser'] = $browser . "-" . $version;
    LogActivity::create($Log);

    Attendence::find($id)->delete();
    return redirect('Employee/Attendence/home')->with('success', "Attendence Deleted Successfully");
}
  
    public function filterAttendance(Request $request,$id){
        $attendances = Attendence::join('employee_details as e', 'attendences.emp_id', '=', 'e.user_id')
                    ->join('time_shifts as ts', 'e.shift_id', '=', 'ts.id')
                    ->select('attendences.*','ts.working_hours as ts_working_hrs',
                        DB::raw('(TIMESTAMPDIFF(MINUTE, attendences.punch_in, attendences.punch_out) / 60) as working_hours')
                    )
                    ->whereYear('attendences.punch_date', $request->year)
                    ->whereMonth('attendences.punch_date', $request->month)
                    ->where('attendences.emp_id', $id)
                    ->paginate(10);
                    
        return view('Employee.Humanesources.Attendence.attendance',compact('attendances'));
    }



}
