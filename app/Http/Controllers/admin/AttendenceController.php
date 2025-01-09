<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use App\Models\AttendenceDetails;
use App\Models\LogActivity;
use App\Models\Attendence;
use App\Models\EmployeeDetail;
use App\Models\TimeShift;
use App\Models\User;
use Carbon\Carbon;
use Jenssegers\Agent\Agent;
use Hash;
use Auth;
use DB;
use DateTime;
use DateInterval;


class AttendenceController extends Controller
{   
    public function home(Request $request)
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;
        $daysInMonth = Carbon::create($currentYear, $currentMonth)->daysInMonth;

        $selectedMonth = $request->input('month', $currentMonth);
        $selectedYear = $request->input('year', $currentYear);

        $startDate = date('Y-m-01');
        $endDate =date('Y-m-t');

        $shiftHours = 9 * 3600; // 9 hours in seconds
    
        // Fetch data from database
        $users = DB::table('attendences as a')
            ->leftJoin('employee_details as e', 'a.emp_id', '=', 'e.user_id')
            ->leftJoin('time_shifts as ts', 'ts.id', '=', 'e.shift_id')
            ->leftJoin('users as us', 'us.id', '=', 'e.user_id')
            ->where('us.type', 4)
            ->where('a.emp_id', '!=', '1')
            ->whereBetween('a.punch_date', [$startDate, $endDate])
            ->select(
                'a.emp_id',
                'a.break_time',
                'a.overtime',
                'a.punch_in',
                'a.punch_out',
                'us.first_name',
                'us.last_name',
                'e.jobrole_id',
                'us.profile_img',
                'ts.shift_name',
                'ts.working_hours as ts_working_hrs',
                DB::raw('SUM(TIMESTAMPDIFF(SECOND, a.punch_in, a.punch_out)) as total_seconds'),
                DB::raw('(TIMESTAMPDIFF(MINUTE, a.punch_in, a.punch_out) / 60) as working_hours')
            )
            ->groupBy('a.emp_id');
            // ->get();
        $users = $users->paginate(10);
        // dd($users);
        // Calculate breaks manually
        // foreach ($users as $user) {
        //     $breakTime = $this->calculateBreakTime_old($user->emp_id, $startDate, $endDate);
        //     $user->break_seconds = $breakTime;
        // }

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
        $averageWorkingHoursFormatted = "{$averageHours}h {$averageMinutes}min {$averageSeconds}sec";

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
        $totalOvertimeHours = floor($totalOvertimeSeconds / 3600);
        $totalOvertimeMinutes = floor(($totalOvertimeSeconds % 3600) / 60);
        $totalOvertimeSeconds = $totalOvertimeSeconds % 60;
        $totalOvertimeFormatted = "{$totalOvertimeHours}h {$totalOvertimeMinutes}min {$totalOvertimeSeconds}sec";

        $totalOvertime = $totalOvertimeFormatted;

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
        $totalProductionFormatted = "{$totalProductionHours}h {$totalProductionMinutes}min {$totalProductionSeconds}sec";
        $totalProductionHours = $totalProductionFormatted;

        return view('admin.Humanesources.Attendence.home', compact(
            'users', 
            'averageWorkingHours', // Add this line
            'averageWorkingHoursFormatted', 
            'averageCheckInTime', 
            'onTimeArrivals', 
            'totalProductionHours', 
            'averageCheckOutTime', 
            'totalOvertime', 
            'totalOvertimeFormatted', 
            'selectedMonth', 
            'selectedYear', 
            'totalProductionFormatted',
            'startDate',
            'endDate'
        ));
    }


    public function home2(Request $request)
    {
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

        return view('admin.Humanesources.Attendence.home', compact(
            'User', 
            'averageWorkingHours', 
            'averageCheckInTime', 
            'onTimeArrivals', 
            'averageCheckOutTime', 
            'totalOvertime', 
            'selectedMonth', 
            'selectedYear', 
            'totalProductionHours',
            'startDate',
            'endDate'
        ));
    }



    private function calculateBreakTime_old($emp_id, $startDate, $endDate)
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
        $Log['url'] = url('/') . '/admin/Attendence/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

         $Employee = User::
             leftjoin('employee_details','employee_details.user_id','users.id')
             ->leftjoin('roles','roles.id','employee_details.job_role_id')
             ->select('users.first_name','users.last_name','roles.name as jobrole','users.id')
             ->where('users.type',4)
             ->get();
        return view('admin.Humanesources.Attendence.create',compact('Employee')); 
    }


    //home page
    public function store(Request $req)
    {

        $data = $req->all();

        $getusershift = EmployeeDetail::where('user_id',$req->emp_Id)->first();
        $getshift = TimeShift::where('id',$getusershift->shift_id)->first();
        // dd($getusershift);
        $data['shift_id'] = $getusershift->shift_id;
        $data['break_time'] = $getshift->break_time;

        $punchInTime = Carbon::parse($req->punch_in);
        $punchOutTime = Carbon::parse($req->punch_out);
        $shiftDuration = Carbon::parse($getshift->working_hours);
        
        // Calculate total worked time and standard shift duration in seconds
        $totalSeconds = $punchInTime->diffInSeconds($punchOutTime);
        $shiftSeconds = $shiftDuration->hour * 3600 + $shiftDuration->minute * 60;
        
        // Calculate overtime if applicable
        $overtimeFormatted = $totalSeconds > $shiftSeconds 
            ? sprintf('%02dh %02dmin %02dsec', floor(($totalSeconds - $shiftSeconds) / 3600), floor((($totalSeconds - $shiftSeconds) % 3600) / 60), ($totalSeconds - $shiftSeconds) % 60)
            : '0h 00min 00sec';

        // dd($overtimeFormatted);
        $data['overtime'] = $overtimeFormatted;

        Attendence::create($data);
        
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Attendence Data Store By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Attendence/store';
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);    

        return redirect('admin/Attendence/home')->with('success', "New Attendence Added Successfully");
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
        $Log['url'] = url('/') . '/admin/Attendence/edit/'.$id;
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
        return view('admin.Humanesources.Attendence.edit',compact('Attendence','Employee'));
    }

    //View
    public function View(Request $req, $id)
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $selectedMonth = $req->input('month', $currentMonth);
        $selectedYear = $req->input('year', $currentYear);

        $startDate = Carbon::create($selectedYear, $selectedMonth)->startOfMonth()->toDateString();
        $endDate = Carbon::create($selectedYear, $selectedMonth)->endOfMonth()->toDateString();

        $user = User::join('employee_details','users.id','employee_details.user_id')
        ->select('users.*','employee_details.jobrole_id')
        ->where('users.id',$id)
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
        
        // $attendances = Attendence::join('employee_details as e', 'attendences.emp_id', '=', 'e.user_id')
        //             ->join('time_shifts as ts', 'e.shift_id', '=', 'ts.id')
        //             ->whereYear('attendences.punch_date', date('Y'))
        //             ->whereMonth('attendences.punch_date',  date('m'))
        //             ->select('attendences.*','ts.working_hours as ts_working_hrs',
        //                 DB::raw('(TIMESTAMPDIFF(MINUTE, attendences.punch_in, attendences.punch_out) / 60) as working_hours')
        //             )
        //             ->where('attendences.emp_id', $id)
        //             ->paginate(10);
                    
        $attendances = Attendence::join('employee_details as e', 'attendences.emp_id', '=', 'e.user_id')
            ->join('time_shifts as ts', 'e.shift_id', '=', 'ts.id')
            ->whereYear('attendences.punch_date', date('Y'))
            ->whereMonth('attendences.punch_date', date('m'))
            ->select('attendences.*', 'ts.working_hours as ts_working_hrs',
                DB::raw('(TIMESTAMPDIFF(MINUTE, attendences.punch_in, attendences.punch_out) / 60) as working_hours')
            )
            ->where('attendences.emp_id', $id)
            ->paginate(10);

        $query = DB::table('attendences as a')
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
            ->orderBy('punch_date','desc');
            // ->get();

        $attendance2 = $query->paginate(10);
        return view('admin.Humanesources.Attendence.view', compact('id', 'percentage','attendancePercentages','months','attendanceData','user','Attendence','attendances','attendance2'));

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
                    
        return view('admin.Humanesources.Attendence.attendance',compact('attendances'));
    }

    //GetMonthYearData
    public function GetMonthYearData(Request $request)
    {
        $year = $request->year;
        $month = $request->month;

        $Attendence  = Attendence::where('emp_Id', $request->id)->where('punch_date', 'LIKE', "$year-$month%")
                        ->orderBy('created_at', 'desc')
                        ->get();
        return view('admin.Humanesources.Attendence.GetMonthYearData',compact('Attendence'));
    }


    //updated
    public function update(Request $req,$id)
    {
        $getusershift = EmployeeDetail::where('user_id',$req->emp_Id)->first();
        $getshift = TimeShift::where('id',$getusershift->shift_id)->first();
     
        $data =Attendence::find($id);
        $data['emp_Id'] = $req->emp_Id;
        $data['punch_date'] = $req->punch_date;
        $data['punch_in'] = $req->punch_in;
        $data['punch_out'] = $req->punch_out;
        $data['break_time'] = $getshift->break_time;

        $punchInTime = Carbon::parse($req->punch_in);
        $punchOutTime = Carbon::parse($req->punch_out);
        $shiftDuration = Carbon::parse($getshift->working_hours);
        
        // Calculate total worked time and standard shift duration in seconds
        $totalSeconds = $punchInTime->diffInSeconds($punchOutTime);
        $shiftSeconds = $shiftDuration->hour * 3600 + $shiftDuration->minute * 60;
        
        // Calculate overtime if applicable
        $overtimeFormatted = $totalSeconds > $shiftSeconds 
            ? sprintf('%02dh %02dmin %02dsec', floor(($totalSeconds - $shiftSeconds) / 3600), floor((($totalSeconds - $shiftSeconds) % 3600) / 60), ($totalSeconds - $shiftSeconds) % 60)
            : '0h 00min 00sec';

        // dd($overtimeFormatted);
        $data['overtime'] = $overtimeFormatted;
        
        $data->save();    

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Attendence Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Attendence/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('admin/Attendence/home')->with('success', "Attendence Edit Successfully");
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
        $Log['url'] = url('/') . '/admin/Attendence/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        Attendence::find($id)->delete();
        return redirect('admin/Attendence/home')->with('success', "Attendence Deleted Successfully");
    }


    
    public function fetchAttendance()
    {
        $url = "https://smartattendance.paathshalaerp.com/api/smart/attendance";
    
        // Serial IDs for "in" and "out"
        $serials = [
            'E03C1CB49F4EAA02' => 'in',  // for "in"
            'E03C1CB49F9AAA02' => 'out' // for "out"
        ];
    
        // Get all active users
        $users = User::where('status',1)->where('deleted_at', NULL)->get(); // Fetch active users

        $userIds = $users->pluck('id')->toArray(); // Array of integers
        $userIds = array_map('strval', $userIds); // Convert to strings
    
        foreach ($serials as $serial => $type) {
            $response = \Http::post($url, [
                'serial' => $serial,
                'userId' => $userIds // Use the converted array
            ]);
    
            $apiResponse = $response->json();
            // dd($apiResponse);
            if (isset($apiResponse['action']) && $apiResponse['action'] === true) {
                $attendanceData = $apiResponse['attendanceData'];
    
                foreach ($attendanceData as $record) {
                    $userId = $record['UserId'];
                    $logDate = $record['LogDate'];
                    $logTime = Carbon::parse($logDate);
    
                    // Match user from User model
                    $user = $users->firstWhere('id', $userId);

                    if ($user) {
                        $existingRecords = Attendence::where('emp_Id', $user->id)
                            ->whereDate('punch_date', $logTime->toDateString())
                            ->get();

                        $getusershift = EmployeeDetail::where('user_id',$user->id)->first();
                        $getshift = TimeShift::where('id',$getusershift->shift_id)->first();

                        if ($existingRecords->isEmpty()) {
                            // Insert the first punch-in of the day
                            if ($type === 'in') {
                                Attendence::create([
                                    'emp_Id' => $user->id,
                                    'punch_date' => $logTime->toDateString(),
                                    'punch_in' => $logDate,
                                    'shift_id' => $getshift->id,
                                    'break_time' => NULL,
                                    'overtime' => '0h 00min 00sec',
                                ]);
                            }
                        } else {
                            // Update the last punch-out of the day and calculate break time & overtime
                            $attendance = $existingRecords->first();
                            
                            if ($type === 'in' || $type === 'out') {
                                $punchInTime = Carbon::parse($attendance->punch_in);
                                $punchOutTime = $attendance->punch_out ? Carbon::parse($attendance->punch_out) : null;
                                $shiftDuration = Carbon::parse($getshift->working_hours);

                                // Calculate time gap between punches and add to break_time if within shift
                                if ($punchOutTime && $logTime->greaterThan($punchInTime) && $logTime->lessThan($punchOutTime)) {
                                    $timeDiffInMinutes = $logTime->diffInMinutes($punchOutTime);
                                    $existingBreakTime = (int) $attendance->break_time;
                                    $newBreakTime = $existingBreakTime + $timeDiffInMinutes;
                                    $attendance->break_time = $newBreakTime;
                                    $attendance->save();
                                }

                                // Update punch-out, overtime, and break time if type is 'out'
                                if ($type === 'out') {
                                    $punchOutTime = $logDate;
                                    $totalSeconds = $punchInTime->diffInSeconds($punchOutTime);
                                    $shiftSeconds = $shiftDuration->hour * 3600 + $shiftDuration->minute * 60;

                                    $overtimeFormatted = $totalSeconds > $shiftSeconds 
                                        ? sprintf('%02dh %02dmin %02dsec', floor(($totalSeconds - $shiftSeconds) / 3600), 
                                        floor((($totalSeconds - $shiftSeconds) % 3600) / 60), ($totalSeconds - $shiftSeconds) % 60)
                                        : '0h 00min 00sec';

                                    $attendance->punch_out = $punchOutTime;
                                    $attendance->overtime = '0h 00min 00sec';
                                    $attendance->save();
                                }
                            }
                        }
                    }
                }
            }
        }
    
        return redirect('admin/Attendence/home')->with('success', "Today's attendance data fetched and updated successfully.");
    }

    

    









    private function calculateBreakTime($punchIn, $punchOut)
    {
        $breakStart = Carbon::parse('13:00'); // 1 PM
        $breakEnd = Carbon::parse('15:00'); // 3 PM
    
        $punchIn = Carbon::parse($punchIn);
        $punchOut = Carbon::parse($punchOut);
    
        if ($punchOut->between($breakStart, $breakEnd) || $punchIn->between($breakStart, $breakEnd)) {
            $overlapStart = $punchIn->max($breakStart);
            $overlapEnd = $punchOut->min($breakEnd);
            $breakDuration = $overlapStart->diffInSeconds($overlapEnd);
    
            return $this->formatTime($breakDuration);
        }
    
        return null;
    }
    

    private function formatTime($seconds)
    {
        $hours = floor($seconds / 3600);
        $minutes = floor(($seconds % 3600) / 60);
        $seconds = $seconds % 60;
    
        return sprintf('%02dh %02dmin %02dsec', $hours, $minutes, $seconds);
    }














    //View
    // public function View(Request $req, $id)
    // {
    //     $currentMonth = Carbon::now()->month;
    //     $currentYear = Carbon::now()->year;

    //     $employeeId = $id;

    //     $employee = EmployeeDetail::where('user_id', $id)->first();
    //     $TimeShift = TimeShift::find($employee->shift_id);

    //     $officeStartTime = $TimeShift->StartTime; // Office start time
    //     $officeEndTime = $TimeShift->EndTime;     // Office end time
    //     $totalOfficeHours = Carbon::parse($officeEndTime)->diffInMinutes(Carbon::parse($officeStartTime)) / 60; // Total office hours

    //     $daysInMonth = Carbon::now()->daysInMonth;
    //     $totalPossibleHours = $totalOfficeHours * $daysInMonth; // Total possible office hours in the month

    //     $officeTime = DB::table('attendences as a')
    //         ->select(
    //             DB::raw('SUM(TIMESTAMPDIFF(MINUTE, a.punch_in, a.punch_out) / 60) as WorkingHrs')
    //         )
    //         ->where('a.emp_id', $employeeId)
    //         ->whereMonth('a.punch_in', $currentMonth)
    //         ->groupBy(DB::raw('DATE(a.punch_in)')) // Group by date to get daily working hours
    //         ->get();

    //     $totalWorkingHrs = $officeTime->sum('WorkingHrs'); // Total actual working hours in the month

    //     if ($totalPossibleHours > 0) {
    //         $percentage = number_format(($totalWorkingHrs / $totalPossibleHours) * 100, 2);
    //     } else {
    //         $percentage = 0.00;
    //     }

    //     $Attendence = Attendence::where('punch_date', date('Y-m-d'))->where('emp_Id', $id)->first();

    //     return view('admin.Humanesources.Attendence.view', compact('Attendence', 'id', 'percentage'));
    // }
}








