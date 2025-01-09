<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Jenssegers\Agent\Agent;
use App\Models\Leads;
use App\Models\User;
use App\Models\Task;
use App\Models\ModuleSetting;
use App\Models\Invoice;
use App\Models\TaskTimer;
use App\Models\Ticket;
use App\Models\Department;
use App\Models\Leave;
use App\Models\Calendar;
use App\Models\LeaveType;
use App\Models\Attendence;
use App\Models\EmployeeDetail;
use App\Models\TimeShift;
use App\Models\Notice;
use App\Models\LeadsFollowup;
use App\Models\Transaction;
use App\Models\TimeSheet;
use App\Models\Project;
use App\Models\PayRoll;
use App\Models\Product;
use App\Models\Orders;
use App\Models\BareMetal;
use App\Models\CloudHosting;
use App\Models\CloudServices;
use App\Models\DedicatedServer;
use App\Models\AwsService;
use App\Models\Azure;
use App\Models\GoogleWorkSpace;
use App\Models\MicrosoftOffice365;
use App\Models\OneTimeSetup;
use App\Models\MonthelySetup;
use App\Models\PerformanceRating;
use App\Models\PerformanceCategory;
use App\Models\SSLCertificate;
use App\Models\Licenses;
use App\Models\Acronis;
use App\Models\TsPlus;
use App\Models\Antivirus;
use App\Models\Currency;
use App\Models\ProductNew;
use Carbon\Carbon;
use Str;
use Session;
use Auth;
use DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {

        $User = EmployeeDetail::select('shift_id')->where('user_id', Auth::user()->id)->first();
        $Attendence = Attendence::select('punch_in', 'punch_out')->where('emp_Id', auth::user()->id)->where('punch_date', date('Y-m-d'))->get();
        if ($User && $User->shift_id) {
            $TimeShift = TimeShift::select('working_hours', 'shift_name', 'Colorname')->where('id', $User->shift_id)->first();
        } else {
            $TimeShift = '';
        }
        $CheckInTime = Attendence::select('punch_in')->where('emp_Id', auth::user()->id)->where('punch_date', date('Y-m-d'))->first();
        $OpenTicket = Ticket::where('status', 1)->count();
        $TTask = Task::whereNotIn('status_id', ['2', '4'])->count();
        $showTTask = Task::count();
        $OpenTask = Task::where('status_id', 1)->count();
        $TasksOverDue = Task::where('status_id', 3)->count();
        $moduleSetting = ModuleSetting::where('user_id', auth()->id())->first();
        $TProJect = Project::whereNotIn('status_id', ['2', '4'])->count();
        $showTProJect = Project::count();
        $TaskD = Task::select('id', 'task_name', 'status_id', 'deadline', 'endDate')->orderBy('id', 'desc')->limit(6)->get();
        $ProJectGoingoN = Project::where('status_id', 1)->count();
        $Order = Orders::select(
            'orders.id as order_number',
            'orders.order_status',
            'orders.is_payment_recieved',
            'orders.total_amt',
            'orders.amount',
            'users.first_name',
            'users.profile_img',
            'users.company_name',
            'users.id as user_id',
            'currencies.prefix',
            'currencies.code',
            'users.email'
        )
            ->leftJoin('users', 'users.id', '=', 'orders.user_id')
            ->leftJoin('currencies', 'currencies.id', '=', 'orders.currency')
            ->where('orders.user_id','!=',1)
            ->limit(10)
            ->get();
            
        $Invoice = Invoice::select('invoices.*', 'users.first_name', 'users.id as user_id', 'users.last_name', 'users.profile_img', 'users.email','currencies.prefix','currencies.code', 'users.company_name')
            ->leftJoin('users', 'users.id', 'invoices.client_id')
            ->leftJoin('orders', 'orders.id', 'invoices.order_id')
            ->leftJoin('currencies', 'currencies.id', '=', 'orders.currency')
            ->limit(10)->get();
        $ProJectOverDue = Project::where('status_id', 3)->count();
        $OnLeaves = Leave::select('users.first_name', 'users.profile_img', 'leaves.status', 'departments.name as dptname')
            ->where('leaves.date', date('Y-m-d'))
            ->leftJoin('users', 'leaves.user_id', '=', 'users.id')
            ->leftJoin('employee_details as ed1', 'leaves.user_id', '=', 'ed1.user_id')
            ->leftJoin('departments', 'ed1.department_id', '=', 'departments.id')
            ->limit(7)
            ->get();
        $LTicket = Ticket::select('id', 'subject', 'date', 'status')->orderBy('id', 'desc')->limit(6)->get();
        $Profilestatus = User::select('id', 'first_name', 'email', 'company_name', 'created_at')->where('profile_status', 0)->where('payment_status', 1)->where('id', '!=', '1')->get();


        $cancelRequests = $this->getCancellationRequest();
        $currentDate = Carbon::now()->toDateString(); // Get the current date
        
        $totalOvertime = DB::table('attendences as a')
            ->leftJoin('employee_details as e', 'a.emp_id', '=', 'e.user_id')
            ->leftJoin('time_shifts as ts', 'ts.id', '=', 'e.shift_id')
            ->leftJoin('users as us', 'us.id', '=', 'e.user_id')
            ->select(DB::raw('SUM(TIMESTAMPDIFF(SECOND, ts.EndTime, a.punch_out)) as total_overtime_seconds'))
            ->where('us.type', 4)
            ->where('a.emp_Id', Auth::user()->id) // Filter by the current date
            ->where('a.punch_date', $currentDate) // Filter by the current date
            ->whereNotNull('a.punch_out')
            ->whereRaw('TIME(a.punch_out) > TIME(ts.EndTime)')
            ->first();
     
        // Convert total overtime seconds to hours and minutes
        $totalOvertimeSeconds = $totalOvertime->total_overtime_seconds;
        $totalOvertimeInHours = floor($totalOvertimeSeconds / 3600);
        $totalOvertimeInMinutes = floor(($totalOvertimeSeconds % 3600) / 60);
        
        // Format the overtime as a string with leading zeros
        $totalOvertime = sprintf("%02d:%02d", $totalOvertimeInHours, $totalOvertimeInMinutes);
                        
        // Retrieve the logged-in user
        $user = Auth::user();
        
        // Retrieve the shift information for the logged-in user
        $shiftInfo = DB::table('employee_details as e')
            ->leftJoin('time_shifts as ts', 'ts.id', '=', 'e.shift_id')
            ->where('e.user_id', $user->id) // Assuming the user ID is stored in the 'emp_id' field
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
                $shiftDuration = "N/A";
                $shiftDurationInSeconds = 0; // Set default value
            }
            
            // Retrieve punch-in and punch-out times for the logged-in user
            $punchTimes = DB::table('attendences')
                ->where('emp_id', $user->id)
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

            // Convert total break time to hours and minutes
            $totalBreakHours = floor($totalBreakSeconds / 3600);
            $totalBreakMinutes = floor(($totalBreakSeconds % 3600) / 60);
            
            // Format the total break time as a string with leading zeros
            $totalBreakTime = sprintf("%02d:%02d", $totalBreakHours, $totalBreakMinutes);
            
        // Get the current month and year
    $currentMonth = Carbon::now()->month;
    $currentYear = Carbon::now()->year;

    // Retrieve tickets created in the current month and year with their first responses
    $tickets = Ticket::whereMonth('created_at', $currentMonth)
        ->whereYear('created_at', $currentYear)
        ->with(['firstResponse' => function ($query) {
            $query->select('ticket_id', 'created_at')->orderBy('created_at', 'asc');
        }])
        ->get();

    // Calculate the response time for each ticket
    $responseTimes = [];
    foreach ($tickets as $ticket) {
        if ($ticket->firstResponse) {
            $ticketCreationTime = Carbon::parse($ticket->created_at);
            $firstResponseTime = Carbon::parse($ticket->firstResponse->created_at);
            $responseTimes[] = $firstResponseTime->diffInSeconds($ticketCreationTime);
        }
    }

    if (count($responseTimes) > 0) {
        $averageResponseTimeInSeconds = array_sum($responseTimes) / count($responseTimes);
        $averageResponseTime = gmdate('H:i', $averageResponseTimeInSeconds); // Format as H:i (Hours:Minutes)
    } else {
        $averageResponseTime = 'N/A';
    }
    
            $Notices = Notice::whereNull('deleted_at')->orderBy('id', 'desc')->limit(10)->get();
            $upcomingEvents = Calendar::leftJoin('users', 'users.id', '=', 'calendars.user_id')
                        ->select('calendars.*', 'users.first_name', 'users.last_name')
                        ->where('calendars.start', '>', Carbon::today()) // Events starting after today
                        ->orWhere('calendars.end', '>', Carbon::today())   // Events ending after today
                        ->orderBy('calendars.start', 'ASC') // Order by start date
                        ->limit(3) // Limit the results to 5 events
                        ->get();
                        
            $calenderEvents = Calendar::whereMonth('start', date('m'))->whereDay('start', date('d'))->get();
                // Define the date range for the previous month
    $previousMonth = date('m', strtotime('-1 month'));
    $previousYear = date('Y', strtotime('-1 month'));
    $startDate = date("$previousYear-$previousMonth-01");
    $endDate = date("Y-m-t", strtotime($startDate));

    $highestRating = 0;
    $bestEmployee = null;
    $Performance = User::select('users.first_name','users.last_name','users.id','users.email','users.profile_img','departments.name as departments_name','employee_details.jobrole_id')
                        ->leftjoin('employee_details','employee_details.user_id','users.id')
                        ->leftjoin('departments','departments.id','employee_details.department_id')
                        ->where('users.type', 4)
                        ->paginate(10);

        $PerformanceCategory = PerformanceCategory::get();
        $PerformanceRating = PerformanceRating::get();
    // Assuming Performance is a list of users
    foreach($Performance as $user) {
        // Calculate Ticket Rating
        $assignedTickets = DB::table('tickets')
                            ->where('ccid', $user->id)
                            ->whereBetween('date', [$startDate, $endDate])
                            ->count();
        $resolvedTickets = DB::table('tickets')
                            ->where('ccid', $user->id)
                            ->whereBetween('date', [$startDate, $endDate])
                            ->where('status', '3')
                            ->count();
        $ticketRating = '--';
        if ($assignedTickets > 0) {
            $resolvedPercentage = ($resolvedTickets / $assignedTickets) * 100;
            $ticketRating = ($resolvedPercentage == 100) ? 5 : (($resolvedPercentage >= 75) ? 4 : (($resolvedPercentage >= 50) ? 3 : (($resolvedPercentage >= 25) ? 2 : 1)));
        }

        // Calculate Punctuality Rating
        $onTimeArrivals = DB::table('attendences')
                            ->leftJoin('employee_details', 'attendences.emp_id', '=', 'employee_details.user_id')
                            ->leftJoin('time_shifts', 'time_shifts.id', '=', 'employee_details.shift_id')
                            ->leftJoin('users', 'users.id', '=', 'employee_details.user_id')
                            ->where('users.type', 4)
                            ->where('attendences.emp_Id', $user->id)
                            ->whereBetween('attendences.punch_date', [$startDate, $endDate])
                            ->whereRaw('TIME(attendences.punch_in) <= TIME(time_shifts.StartTime)')
                            ->count();
        $totalWorkingDays = DB::table('attendences')
                              ->where('emp_id', $user->id)
                              ->whereBetween('punch_date', [$startDate, $endDate])
                              ->distinct()
                              ->count('punch_date');
        $punctualityRating = ($totalWorkingDays > 0) ? round(($onTimeArrivals / $totalWorkingDays) * 100) : 1;

        // Calculate Working Hours Rating
                 // Calculate Working Hours Rating
                        $workingHoursData = DB::table('attendences as a')
                                              ->leftJoin('employee_details as e', 'a.emp_id', '=', 'e.user_id')
                                              ->leftJoin('time_shifts as ts', 'ts.id', '=', 'e.shift_id')
                                              ->leftJoin('users as us', 'us.id', '=', 'e.user_id')
                                              ->where('us.type', 4)
                                              ->where('a.emp_id', $user->id)
                                              ->whereBetween('a.punch_date', [$startDate, $endDate])
                                              ->select(
                                                  DB::raw('SUM(TIMESTAMPDIFF(MINUTE, a.punch_in, a.punch_out) / 60) as total_hours'),
                                                  DB::raw('COUNT(DISTINCT a.punch_date) as working_days'),
                                                  DB::raw('MIN(ts.working_hours) as shift_hours')
                                              )
                                              ->groupBy('a.emp_id')
                                              ->first();
                        $workingHoursRating = '--';
                       // return $workingHoursData->shift_hours;
                        if ($workingHoursData && $workingHoursData->working_days > 0) {
                            $averageHoursPerDay = $workingHoursData->total_hours / $workingHoursData->working_days;
                            // Assume $workingHoursData->shift_hours is in the format 'HH:MM:SS'
                           // Use the fully qualified name for DateTime
                                $shiftHoursString = $workingHoursData->shift_hours ?? '00:00:00';
                                
                                // Convert the time string to a DateTime object
                                $shiftHoursDateTime = new \DateTime($shiftHoursString);
                                
                                // Extract the hours part as an integer
                                $shiftHours = (int)$shiftHoursDateTime->format('H');

                            if ($shiftHours > 0) {
                                $workingHoursRating = ($averageHoursPerDay >= $shiftHours) ? 5 : (($averageHoursPerDay >= 0.75 * $shiftHours) ? 4 : (($averageHoursPerDay >= 0.5 * $shiftHours) ? 3 : (($averageHoursPerDay >= 0.25 * $shiftHours) ? 2 : 1)));
                            }
                        }

        // Calculate Attendance Rating
        $attendanceDays = DB::table('attendences')
                            ->where('emp_Id', $user->id)
                            ->whereBetween('punch_date', [$startDate, $endDate])
                            ->distinct('punch_date')
                            ->count();
        $attendanceRating = ($attendanceDays >= 30) ? 5 : (($attendanceDays >= 20) ? 4 : (($attendanceDays >= 10) ? 3 : (($attendanceDays >= 2) ? 2 : 1)));

        // Calculate Average Rating
        if ($ticketRating !== '--' && $punctualityRating !== '--' && $workingHoursRating !== '--' && $attendanceRating !== '--') {
            $averageRating = round(($ticketRating + $punctualityRating + $workingHoursRating + $attendanceRating) / 4);
        } else {
            $averageRating = '--';
        }

        // Determine the best employee
        if ($averageRating > $highestRating) {
            $highestRating = $averageRating;
            $bestEmployee = $user;
        }
    }

     $bestEmployee = $bestEmployee;
        return view('admin.dashboard.index', compact('Notices', 'Profilestatus','bestEmployee','shiftDuration','upcomingEvents','averageResponseTime','calenderEvents','totalBreakTime', 'LTicket','totalOvertime', 'TaskD', 'OnLeaves', 'TimeShift', 'Attendence', 'CheckInTime', 'OpenTicket', 'OpenTask', 'TasksOverDue', 'moduleSetting', 'TTask', 'TProJect', 'ProJectGoingoN', 'ProJectOverDue', 'showTTask', 'showTProJect', 'Order', 'Invoice', 'cancelRequests'));
    }
    
     function getEmployeeOfTheMonth()
{
    // Define the date range for the previous month
    $previousMonth = date('m', strtotime('-1 month'));
    $previousYear = date('Y', strtotime('-1 month'));
    $startDate = date("$previousYear-$previousMonth-01");
    $endDate = date("Y-m-t", strtotime($startDate));

    $highestRating = 0;
    $bestEmployee = null;

    // Assuming Performance is a list of users
    foreach($Performance as $user) {
        // Calculate Ticket Rating
        $assignedTickets = DB::table('tickets')
                            ->where('ccid', $user->id)
                            ->whereBetween('date', [$startDate, $endDate])
                            ->count();
        $resolvedTickets = DB::table('tickets')
                            ->where('ccid', $user->id)
                            ->whereBetween('date', [$startDate, $endDate])
                            ->where('status', '3')
                            ->count();
        $ticketRating = '--';
        if ($assignedTickets > 0) {
            $resolvedPercentage = ($resolvedTickets / $assignedTickets) * 100;
            $ticketRating = ($resolvedPercentage == 100) ? 5 : (($resolvedPercentage >= 75) ? 4 : (($resolvedPercentage >= 50) ? 3 : (($resolvedPercentage >= 25) ? 2 : 1)));
        }

        // Calculate Punctuality Rating
        $onTimeArrivals = DB::table('attendences')
                            ->leftJoin('employee_details', 'attendences.emp_id', '=', 'employee_details.user_id')
                            ->leftJoin('time_shifts', 'time_shifts.id', '=', 'employee_details.shift_id')
                            ->leftJoin('users', 'users.id', '=', 'employee_details.user_id')
                            ->where('users.type', 4)
                            ->where('attendences.emp_Id', $user->id)
                            ->whereBetween('attendences.punch_date', [$startDate, $endDate])
                            ->whereRaw('TIME(attendences.punch_in) <= TIME(time_shifts.StartTime)')
                            ->count();
        $totalWorkingDays = DB::table('attendences')
                              ->where('emp_id', $user->id)
                              ->whereBetween('punch_date', [$startDate, $endDate])
                              ->distinct()
                              ->count('punch_date');
        $punctualityRating = ($totalWorkingDays > 0) ? round(($onTimeArrivals / $totalWorkingDays) * 100) : 1;

        // Calculate Working Hours Rating
        $workingHoursData = DB::table('attendences as a')
                              ->leftJoin('employee_details as e', 'a.emp_id', '=', 'e.user_id')
                              ->leftJoin('time_shifts as ts', 'ts.id', '=', 'e.shift_id')
                              ->leftJoin('users as us', 'us.id', '=', 'e.user_id')
                              ->where('us.type', 4)
                              ->where('a.emp_id', $user->id)
                              ->whereBetween('a.punch_date', [$startDate, $endDate])
                              ->select(
                                  DB::raw('SUM(TIMESTAMPDIFF(MINUTE, a.punch_in, a.punch_out) / 60) as total_hours'),
                                  DB::raw('COUNT(DISTINCT a.punch_date) as working_days'),
                                  DB::raw('MIN(ts.working_hours) as shift_hours')
                              )
                              ->groupBy('a.emp_id')
                              ->first();
        $workingHoursRating = '--';
        if ($workingHoursData && $workingHoursData->working_days > 0) {
            $averageHoursPerDay = $workingHoursData->total_hours / $workingHoursData->working_days;
            $shiftHours = $workingHoursData->shift_hours ?? 0;
            if ($shiftHours > 0) {
                $workingHoursRating = ($averageHoursPerDay >= $shiftHours) ? 5 : (($averageHoursPerDay >= 0.75 * $shiftHours) ? 4 : (($averageHoursPerDay >= 0.5 * $shiftHours) ? 3 : (($averageHoursPerDay >= 0.25 * $shiftHours) ? 2 : 1)));
            }
        }

        // Calculate Attendance Rating
        $attendanceDays = DB::table('attendences')
                            ->where('emp_Id', $user->id)
                            ->whereBetween('punch_date', [$startDate, $endDate])
                            ->distinct('punch_date')
                            ->count();
        $attendanceRating = ($attendanceDays >= 30) ? 5 : (($attendanceDays >= 20) ? 4 : (($attendanceDays >= 10) ? 3 : (($attendanceDays >= 2) ? 2 : 1)));

        // Calculate Average Rating
        if ($ticketRating !== '--' && $punctualityRating !== '--' && $workingHoursRating !== '--' && $attendanceRating !== '--') {
            $averageRating = round(($ticketRating + $punctualityRating + $workingHoursRating + $attendanceRating) / 4);
        } else {
            $averageRating = '--';
        }

        // Determine the best employee
        if ($averageRating > $highestRating) {
            $highestRating = $averageRating;
            $bestEmployee = $user;
        }
    }

    return $bestEmployee;
}

  public function fetchData(Request $req)
{
    $userId = auth()->id(); // Get the logged-in user's ID

    // Fetch calendar events
    $calendarEvents = Calendar::all();
    $holidayEvents = Holiday::all();

    // Fetch Employee of the Month
    $employeeOfTheMonth = $this->getEmployeeOfTheMonth();

    // Fetch birthdays and anniversaries
    $birthdays = Calendar::where('event_type', 'birthday')->whereMonth('date', date('m'))->whereDay('date', date('d'))->get();
    $anniversaries = Calendar::where('event_type', 'anniversary')->whereMonth('date', date('m'))->whereDay('date', date('d'))->get();
    $goalAchievers = Calendar::where('event_type', 'goal_achiever')->whereMonth('date', date('m'))->whereDay('date', date('d'))->get();

    // Fetch notifications sent to the user
    $notificationsSent = DB::table('event_notifications')
                            ->where('user_id', $userId)
                            ->whereMonth('notification_date', date('m'))
                            ->whereDay('notification_date', date('d'))
                            ->pluck('type')
                            ->toArray();

    // Determine if any modal should be shown
    $showModal = false;
    $modalContent = [];

    if ($employeeOfTheMonth) {
        $showModal = true;
        $modalContent['type'] = 'employee_of_the_month';
        $modalContent['data'] = $employeeOfTheMonth;
    } elseif ($birthdays->count() > 0) {
        $showModal = true;
        $modalContent['type'] = 'birthday';
        $modalContent['data'] = $birthdays;
    } elseif ($anniversaries->count() > 0) {
        $showModal = true;
        $modalContent['type'] = 'anniversary';
        $modalContent['data'] = $anniversaries;
    } elseif ($goalAchievers->count() > 0) {
        $showModal = true;
        $modalContent['type'] = 'goal_achiever';
        $modalContent['data'] = $goalAchievers;
    }

    return response()->json([
        'calendarEvents' => $calendarEvents,
        'holidayEvents' => $holidayEvents,
        'employeeOfTheMonth' => $employeeOfTheMonth,
        'birthdays' => $birthdays,
        'anniversaries' => $anniversaries,
        'goalAchievers' => $goalAchievers,
        'notificationsSent' => $notificationsSent,
        'showModal' => $showModal,
        'modalContent' => $modalContent
    ]);
}

    public function Advanced(Request $request)
    {
        if (Session::get('TabViews') == '' || Session::get('TabViews') == null) {
            Session::put('TabViews', 'Overview');
        }

        return view('admin.dashboard.Advanced');
    }

    public function ClockStatusUpdate(Request $request)
    {
        try {
            $currentDate = date('Y-m-d');
            $currentTime = date('H:i:s');

            $user = User::find($request->id);

            if (!$user) {
                return response()->json(['status' => 404, 'success' => false, 'message' => 'User not found']);
            }

            $user->clock_status = $user->clock_status == 1 ? 0 : 1;
            $user->save();

            if ($request->value == 'clockin') {
                $attendance = new Attendence;
                $attendance->emp_Id = Auth::user()->id;
                $attendance->punch_date = $currentDate;
                $attendance->punch_in = $currentTime;
                $attendance->save();
            } elseif ($request->value == 'clockout') {
                $attendance = Attendence::where('emp_Id', Auth::user()->id)
                    ->where('punch_date', $currentDate)
                    ->whereNull('punch_out')
                    ->first();

                if ($attendance) {
                    $attendance->punch_out = $currentTime;
                    $attendance->save();
                } else {
                    return response()->json(['status' => 400, 'success' => false, 'message' => 'Clock-out record not found']);
                }
            }

            return response()->json(['status' => 200, 'success' => true, 'data' => $user]);
        } catch (\Exception $e) {
            return response()->json(['status' => 500, 'success' => false, 'message' => $e->getMessage()]);
        }
    }
 public function TabView(Request $request)
    {
        
        if ($request->type == 'Overview') {
            Session::put('TabViews', 'Overview');
            $currentDate = date('Y-m-d');

            $moduleSetting = ModuleSetting::where('user_id', auth()->id())->first();
            $TClient = User::where('type', 2)->where('status', 1)->count();
            $TOEMP = User::where('type', 4)->where('status', 1)->count();
            $TProJect = Project::count();
            $totalProjectHrs = TaskTimer::select(DB::raw('SEC_TO_TIME(SUM(TIME_TO_SEC(TIMEDIFF(stop_time, start_time)))) AS total_time'))
                ->where('user_id', Auth::user()->id)
                ->first();
            $totalTimeFormatted = $totalProjectHrs ? $totalProjectHrs->total_time : '00:00:00';
            $DueInvoices = Invoice::where('is_payment_recieved', 0)->count();
            $PendingTasksC = Task::where('status_id', 3)->count();
            $attendanceCount = DB::table('attendences')->where('punch_date', '=', $currentDate)->groupBy('emp_Id')->count();
            $TimeSheet  = TimeShift::select('id', 'shift_name', 'StartTime', 'EndTime', 'working_hours')
                    ->orderBy('created_at', 'desc')->limit(3)->get();
            $countOpenTkt = Ticket::where('status', 1)->count();
           
                $RecentFollowUp = LeadsFollowup::leftjoin('users', 'leads_followups.follow_up_by', '=', 'users.id')
                ->leftjoin('leads', 'leads_followups.leads_id', '=', 'leads.id')
                ->select('leads_followups.*', 'users.first_name', 'users.profile_img', 'users.last_name', 'users.email','leads.phone_number','leads.requirement','leads.first_name as leads_client_first_name','leads.last_name as leads_client_last_name')
                ->limit(5)
                ->get();
            $PendingLeaves = Leave::where('leaves.status', 3)
                ->leftjoin('users', 'leaves.user_id', '=', 'users.id')
                ->leftjoin('leave_types', 'leave_types.id', '=', 'leaves.leavetype_id')
                ->leftjoin('employee_details', 'employee_details.user_id', '=', 'leaves.user_id')
                ->leftJoin('jobroles', 'jobroles.id', 'employee_details.jobrole_id')
                ->select('leaves.*', 'leave_types.*', 'users.first_name', 'employee_details.admin_type_id', 'users.profile_img','users.id as emp_id', 'users.last_name', 'users.email', 'jobroles.name as desname')
                ->limit(5)
                ->get();
            $PendingTasks = Task::where('status_id', 3)->limit(5)->get();
            $LeadsFollowup = LeadsFollowup::orderBy('created_at', 'desc')->limit(5)->get();
            $ProActiTime = Project::select(
                'client_details.id as client_details_id',
                'users.profile_img as client_img',
                'users.first_name as client_name',
                'users.last_name as client_lst_name',
                'users.id as client_id',
                'users.company_name as company_name',
                'projects.status_id',
                'projects.project_name'
            )
                ->leftjoin('users', 'users.id', '=', 'projects.client_id')
                ->leftjoin('client_details', 'client_details.user_id', '=', 'users.id')
                ->orderBy('projects.created_at', 'desc')
                ->whereNull('users.deleted_at')
                ->whereNull('projects.deleted_at')
                ->limit(5)
                ->get();

            $UserActTime = User::select('users.profile_img', 'users.email', 'users.first_name', 'log_activities.user_id', 'log_activities.subject', 'log_activities.ip', 'employee_details.admin_type_id')
                ->join('employee_details', 'employee_details.user_id', 'users.id')
                ->join('log_activities', 'log_activities.user_id', 'users.id')
                ->where('users.type', 4)
                ->limit(5)
                ->orderBy('log_activities.created_at', 'desc')
                ->get();
                $OpenTicket = Ticket::leftJoin('users', 'users.id', '=', 'tickets.ccid')
        ->leftJoin('employee_details', 'employee_details.user_id', '=', 'users.id')
        ->leftJoin('jobroles', 'jobroles.id', '=', 'employee_details.jobrole_id')
        ->where('tickets.status', '=', 1) 
        ->whereNull('users.deleted_at')
        ->whereNull('tickets.deleted_at')
        ->select('tickets.*', 'tickets.status', 'users.first_name', 'jobroles.name as job_role_name', 'users.first_name', 'users.last_name', 'users.profile_img', 'users.email', 'users.id as emp_id')
        ->orderBy('tickets.id','desc') 
        ->limit(5)
        ->get();
            return view('admin.dashboard.Overview', compact('moduleSetting', 'RecentFollowUp', 'TClient', 'TOEMP', 'TProJect', 'DueInvoices', 'totalTimeFormatted', 'PendingTasksC', 'attendanceCount', 'attendanceCount', 'TimeSheet', 'PendingLeaves', 'PendingTasks', 'LeadsFollowup', 'ProActiTime', 'UserActTime', 'countOpenTkt', 'OpenTicket'));
        }
        if ($request->type == 'Project') {
            Session::put('TabViews', 'Project');
            $InProgressProject = Project::where('status_id', 1)->count();
            $CompletedProject = Project::where('status_id', 2)->count();
            $OverDueProject = Project::where('status_id', 3)->count();
            $CancelProject = Project::where('status_id', 4)->count();
            $ProjectPeding = Project::select(
                'users.company_name',
                'users.profile_img as project_manager_picture',
                'users.first_name as project_manager_name',
                'users.last_name as project_manager_lst_name',
                'users.id as project_manager_id',
                'projects.status_id',
                'projects.project_name'
            )
                ->leftjoin('users', 'users.id', '=', 'projects.client_id')
                ->orderBy('projects.created_at', 'desc')
                ->where('projects.status_id', 1)
                ->limit(5)
                ->get();
            $LeadsCountByStatus = Leads::select('generated_user.first_name as generated_by_first_name', 'generated_user.profile_img', 'generated_user.email', 'leads.first_name', 'leads.phone_number', 'leads.requirement', 'leads.status', 'leads.id', 'leads.assignedto')
                ->join('users as generated_user', 'generated_user.id', 'leads.generated_by')
                ->orderBy('leads.created_at', 'desc')
                ->limit(4)
                ->get();
            $ProActiTime = Project::select(
                'users.company_name',
                'users.profile_img as project_manager_picture',
                'users.id as project_manager_id',
                'users.first_name as project_manager_name',
                'users.first_name as project_manager_lst_name',
                'projects.status_id',
                'projects.project_name'
            )
                ->leftjoin('users', 'users.id', '=', 'projects.client_id')
                ->orderBy('projects.created_at', 'desc')
                ->limit(5)
                ->get();

            return view('admin.dashboard.Project', compact('InProgressProject', 'CompletedProject', 'OverDueProject', 'CancelProject', 'ProjectPeding', 'LeadsCountByStatus', 'ProActiTime'));
        }

        if ($request->type == 'Client') {
            Session::put('TabViews', 'Client');
            $TClient = User::where('type', 2)->where('status', 1)->whereNull('users.deleted_at')->count();
            $TotalLeads = Leads::count();
            $win = Leads::where('status', '3')->count();
            $loss = Leads::where('status', '4')->count();
            $progress = Leads::where('status', '1')->count();
            $LeadsCountByStatus = Leads::select('generated_user.first_name as generated_by_first_name','generated_user.last_name as generated_by_last_name','generated_user.id as generated_by_id', 'generated_user.profile_img', 'generated_user.email', 'leads.first_name','leads.last_name', 'leads.phone_number', 'leads.requirement', 'leads.status', 'leads.id', 'leads.assignedto')
                ->join('users as generated_user', 'generated_user.id', 'leads.generated_by')
                ->orderBy('leads.created_at', 'desc')
                ->limit(4)
                ->get();

            $LeadsCountByStatusSource = Leads::select('generated_user.first_name as generated_by_first_name','generated_user.last_name as generated_by_last_name','generated_user.id as generated_by_id', 'generated_user.profile_img', 'generated_user.email', 'leads.first_name','leads.last_name', 'leads.phone_number', 'leads.requirement', 'leads.status', 'leads.id', 'leads.assignedto', 'lead_sources.id as lead_source_id', 'lead_sources.name as lead_source_name')
                ->join('users as generated_user', 'generated_user.id', 'leads.generated_by')
                ->leftJoin('lead_sources', 'lead_sources.id', '=', 'leads.lead_source') // Adding the left join with lead_sources
                ->orderBy('leads.created_at', 'desc')
                ->limit(4)
                ->get();


            $CClient = User::select('users.status', 'users.profile_img', 'users.id', 'users.company_name', 'users.created_at', 'users.email', 'users.first_name', 'users.last_name')
                ->where('users.type', '2')
                ->whereNull('users.deleted_at')
                ->where('status', 1)
                ->get();


            $CRecentLogin = User::select('users.profile_img', 'users.email', 'users.first_name','users.company_name','users.last_name','users.id', 'log_activities.user_id', 'log_activities.subject', 'log_activities.ip')
                ->join('log_activities', 'log_activities.user_id', 'users.id')
                ->where('users.type', '2')
                ->orderBy('log_activities.id','desc')
                ->limit(5)
                ->get();


            return view('admin.dashboard.Client', compact('TClient', 'LeadsCountByStatusSource', 'TotalLeads', 'win', 'loss', 'progress', 'LeadsCountByStatus', 'CClient', 'CRecentLogin'));
        }

      if ($request->type == 'HR') {
                    Session::put('TabViews', 'HR');
                
                    $today = Carbon::today();
                    $Leaveapproved = Leave::where('status', 1)->count();
                    $TOEMP = User::where('type', 4)->where('status', 1)->count();
                    $Active = User::where('status', '1')->where('type', '4')->count();
                    $Suspended = User::where('status', '2')->where('type', '4')->count();
                    $Terminated = User::where('status', '3')->where('type', '4')->count();
                    
                    $HREmpDepartment = EmployeeDetail::select('users.first_name','users.id as emp_id', 'users.email', 'users.profile_img', 'departments.name as dptname','jobroles.name as jobrole')
                        ->leftJoin('users', 'users.id', '=', 'employee_details.user_id')
                        ->leftJoin('departments', 'departments.id', '=', 'employee_details.department_id')
                        ->leftjoin('jobroles','jobroles.id','employee_details.jobrole_id')
                        ->where('users.type', '4')
                        ->orderBy('employee_details.created_at', 'desc')
                        ->limit(5)
                        ->get();
                
                    $HREmpDesignation = User::select('users.first_name','users.id as emp_id', 'users.email', 'users.profile_img', 'jobroles.name as desname')
                        ->leftJoin('employee_details', 'employee_details.user_id', 'users.id')
                        ->leftJoin('jobroles', 'jobroles.id', 'employee_details.jobrole_id')
                        ->where('users.type', '4')
                        ->orderBy('employee_details.created_at', 'desc')
                        ->limit(5)
                        ->get();
                
                    $HREmpRole = EmployeeDetail::select('users.first_name','users.id as emp_id', 'users.email', 'users.profile_img', 'roles.name as rolename', 'jobroles.name as desname')
                        ->leftJoin('users', 'users.id', '=', 'employee_details.user_id')
                        ->leftJoin('roles', 'roles.id', '=', 'employee_details.job_role_id')
                        ->leftJoin('jobroles', 'jobroles.id', 'employee_details.jobrole_id')
                        ->where('users.type', '4')
                        ->orderBy('employee_details.created_at', 'desc')
                        ->limit(5)
                        ->get();
                
                    $HREmpLeave = Leave::select('users.profile_img','users.id as emp_id', 'users.email', 'users.first_name','users.last_name', 'leaves.duration', 'leaves.date','jobroles.name as desname')
                        ->leftJoin('users', 'leaves.user_id', 'users.id')
                        ->leftJoin('employee_details', 'employee_details.user_id', 'leaves.user_id')
                        ->leftJoin('leave_types', 'leaves.leavetype_id', 'leave_types.id')
                         ->leftJoin('jobroles', 'jobroles.id', 'employee_details.jobrole_id')
                        ->whereDate('leaves.start_date', '<=', $today)
                        ->whereDate('leaves.end_date', '>=', $today)
                        ->orderBy('leaves.created_at', 'desc')
                        ->limit(5)
                        ->get();
                   
                    
                    $HRLateattendence = DB::table('attendences as a')
                        ->leftJoin('employee_details as e', 'a.emp_id', '=', 'e.user_id')
                        ->leftJoin('time_shifts as ts', 'ts.id', '=', 'e.shift_id')
                        ->leftJoin('users as us', 'us.id', '=', 'e.user_id')
                        ->leftJoin('jobroles', 'jobroles.id', 'e.jobrole_id')
                        ->where('a.punch_date',$today)
                        ->select(
                            DB::raw('MIN(ts.working_hours) as shifthours'),
                            'a.emp_id',
                            'us.first_name',
                            'us.last_name',
                            'us.profile_img',
                            'us.email',
                            'jobroles.name as desname',
                            DB::raw('(MAX(a.punch_out) - MIN(a.punch_in)) as total_hours'),
                            DB::raw('SUM(TIMESTAMPDIFF(MINUTE, a.punch_in, a.punch_out) / 60) as actualworkinghours')
                        )
                        ->groupBy('a.emp_id')
                        ->orderBy(DB::raw('MAX(a.punch_out)'), 'desc')
                        ->limit(5)
                        ->get();
                
                    // $AllEmployee = EmployeeDetail::select('users.first_name','users.id as emp_id', 'users.status', 'users.email', 'users.profile_img')
                    //     ->leftJoin('users', 'users.id', '=', 'employee_details.user_id')
                    //     ->where('users.type', '4')
                    //     ->orderBy('employee_details.created_at', 'desc')
                    //     ->limit(5)
                    //     ->get();
                        
                  $AllEmployee =      User::
            leftjoin('employee_details','employee_details.user_id','users.id')
            ->leftjoin('jobroles','jobroles.id','employee_details.jobrole_id')
            ->where('users.type', '4')
            ->select('users.*','jobroles.name as jobrole')
            ->limit(5)
                        ->get();
                
                    $HREmpEvent = EmployeeDetail::select('users.first_name','users.id as emp_id', 'users.email', 'users.profile_img', 'employee_details.dob','jobroles.name as jobrole')
                        ->leftJoin('users', 'users.id', '=', 'employee_details.user_id')
                        ->leftJoin('departments', 'departments.id', '=', 'employee_details.department_id') 
                        ->leftjoin('jobroles','jobroles.id','employee_details.jobrole_id')
                        ->where('users.type', '4')
                        ->where('employee_details.dob', date('Y-m-d'))
                        ->orderBy('employee_details.created_at', 'desc')
                        ->limit(5)
                        ->get();
                        
                        
                    $LeaveType = LeaveType::get();
                   if ($request->filter == 'today') {
                        $startDate = Carbon::today();
                        $endDate = Carbon::today();
                    }
                    elseif ($request->filter == 'yesterday') {
                        $startDate = Carbon::yesterday();
                        $endDate = Carbon::yesterday();
                    }
                    elseif ($request->filter == 'last-7-days') {
                        $startDate = Carbon::now()->subDays(7);
                        $endDate = Carbon::now();
                    }
                    elseif ($request->filter == 'last-30-days') {
                        $startDate = Carbon::now()->subDays(30);
                        $endDate = Carbon::now();
                    }
                    elseif ($request->filter == 'current-month') {
                        $startDate = Carbon::now()->startOfMonth();
                        $endDate = Carbon::now();
                    }
                    elseif ($request->filter == 'last-month') {
                        $startDate = Carbon::now()->subMonth()->startOfMonth();
                        $endDate = Carbon::now()->subMonth()->endOfMonth();
                    }
                    else {
                        // Default to the current month
                        $startDate = Carbon::now()->startOfMonth();
                        $endDate = Carbon::now();
                    }
                
                    // Retrieve the leave type counts within the date range
                    $leaveTypeCounts = Leave::select('leavetype_id', DB::raw('COUNT(*) as count'))
                        ->whereBetween('date', [$startDate, $endDate])
                        ->groupBy('leavetype_id')
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
                        
                        
                        
                    
                         
                $approveCount = Leave::where('leaves.status', '1')->count();
    
                $unapproveCount = Leave::where('leaves.status', '2')->count();
      
                $PendingCount = Leave::where('leaves.status', '3')->count();
    
    
                $allLeaves = Leave::select('users.first_name', 'users.email', 'users.profile_img', 'users.last_name', 'leaves.*')
                  ->join('users', 'users.id', '=', 'leaves.user_id')
                  ->orderBy('leaves.created_at', 'desc')
                  ->get();

                
                    return view('admin.dashboard.HR', compact(
                        'Leaveapproved', 
                        'TOEMP', 
                        'AllEmployee', 
                        'Suspended', 
                        'Terminated', 
                        'Active', 
                        'HREmpDepartment', 
                        'HREmpDesignation', 
                        'HREmpRole', 
                        'HREmpLeave', 
                        'HRLateattendence', 
                        'HREmpEvent',
                        'approveCount',
                        'unapproveCount',
                        'PendingCount',
                        'allLeaves',
                        'totalPercentage'
                    ));
        }
        if ($request->type == 'Ticket') {
            Session::put('TabViews', 'Ticket');
            $Open = Ticket::where('status', 1)->count();
            $InProgress = Ticket::where('status', 2)->count();
            $Pending = Ticket::where('status', 3)->count();
            $LTicket = Ticket::select('id', 'subject', 'date', 'status')->limit(5)->orderBy('id', 'desc')->get();
           
              $chartData = [];

        // Loop through each status and construct the data array
        for ($i = 0; $i < 5; $i++) {
            $chartData[$i] = [
                'id' => $i + 1,
                'chart_data' => [],
                // Initialize an array to store ticket counts for each month
            ];
            for ($j = 0; $j < 9; $j++) {
                // Calculate ticket count for each month
                $chartData[$i]['chart_data'][] = Ticket::where('status', $i + 1)
                    ->whereMonth('created_at', $j + 1)
                    ->whereYear('created_at', date('Y'))
                    ->count();
            }
            // Determine the maximum value in chart_data
            $maxValue = max($chartData[$i]['chart_data']);
            
            // Get the index of the maximum value
            $maxIndex = array_keys($chartData[$i]['chart_data'], $maxValue)[0];

            // Assign the index of the max value to active_option
            $chartData[$i]['active_option'] = $maxIndex;
        }

        // Encode $chartData as JSON
        $ticketCounts = json_encode(['data' => $chartData]);
           $OpenTicket = Ticket::leftJoin('users', 'users.id', '=', 'tickets.ccid')
        ->leftJoin('employee_details', 'employee_details.user_id', '=', 'users.id')
        ->leftJoin('jobroles', 'jobroles.id', '=', 'employee_details.jobrole_id')
        ->where('tickets.status', '=', 1) 
        ->whereNull('users.deleted_at')
        ->select('tickets.*', 'tickets.status', 'users.first_name', 'jobroles.name as job_role_name', 'users.first_name', 'users.last_name', 'users.profile_img', 'users.email', 'users.id as emp_id')
        ->orderByDesc('tickets.id') 
        ->limit(5)
        ->get();

            $PendingTicket = Ticket::leftjoin('users','users.id','tickets.ccid')->leftjoin('employee_details','employee_details.user_id','users.id')->leftjoin('jobroles','jobroles.id','employee_details.jobrole_id')
                ->where('tickets.status', 3)->whereNull('users.deleted_at')->select('tickets.*','users.first_name','jobroles.name as job_role_name','users.last_name','users.profile_img','users.email','users.id as emp_id')->limit(5)->orderBy('tickets.id', 'desc')->get();
            $InProgressTicket = Ticket::leftjoin('users','users.id','tickets.ccid')->leftjoin('employee_details','employee_details.user_id','users.id')->leftjoin('jobroles','jobroles.id','employee_details.jobrole_id')
                ->where('tickets.status', 2)->whereNull('users.deleted_at')->select('tickets.*','users.first_name','jobroles.name as job_role_name','users.last_name','users.profile_img','users.email','users.id as emp_id')->limit(5)->orderBy('tickets.id', 'desc')->get();
        $departments = Department::withCount('tickets')->get();
    
            return view('admin.dashboard.Ticket', compact('Open', 'InProgress', 'Pending', 'LTicket', 'OpenTicket', 'PendingTicket', 'InProgressTicket','departments','ticketCounts'));
        }
            if ($request->type == 'Sales') {
            Session::put('TabViews', 'Sales');
            $TClient = User::where('type', 2)->where('status', 1)->count();

            $currentMonth = now()->format('m');
            $currentYear = now()->year;
            $previousYear = now()->subYear()->year;

           
            $TotalSales = round(Invoice::sum('final_total_amt'));

            $currentMonthInvoices = Invoice::leftJoin('quotes', 'quotes.id', 'invoices.Quotesid')
                ->where('invoices.Quotesid', '!=', '0')
                ->where('quotes.user_id', '!=', '1')
                ->where('invoices.is_payment_recieved', 1)
                ->whereNull('invoices.deleted_at')
                ->whereMonth('invoices.created_at', $currentMonth)
                ->whereYear('invoices.created_at', $currentYear)
                ->get();

            $totalSalesCurrentMonth = Orders::leftJoin('quotes', 'quotes.id', 'orders.quotes_id')
                ->leftJoin('invoices', 'invoices.id', 'orders.invoice_id')
                ->whereNull('orders.deleted_at')
                ->whereMonth('orders.created_at', $currentMonth)
                ->whereYear('orders.created_at', $currentYear)
                ->get();

            $totalSalesCurrentMonthPrice = 0.00;

            foreach ($totalSalesCurrentMonth as $invoice) {
                // Convert final_total_amt to float, or set to 0.00 if NaN or null
                $finalTotalAmt = (is_numeric($invoice->total_amt)) ? (float) $invoice->total_amt : 0.00;
                $totalSalesCurrentMonthPrice += $finalTotalAmt;
            }

            $totalClientCount = User::where('type', '4')->whereNull('deleted_at')->count();

            $totalRevenueCurrentMonth = Invoice::leftJoin('quotes', 'quotes.id', 'invoices.Quotesid')
                ->whereNull('invoices.deleted_at')
                ->whereMonth('invoices.created_at', $currentMonth)
                ->whereYear('invoices.created_at', $currentYear)
                ->get();

            $totalRevenueCurrentMonthPrice = 0.00;

            foreach ($totalRevenueCurrentMonth as $invoice) {
                // Convert final_total_amt to float, or set to 0.00 if NaN or null
                $finalTotalAmt = (is_numeric($invoice->final_total_amt)) ? (float) $invoice->final_total_amt : 0.00;
                $totalRevenueCurrentMonthPrice += $finalTotalAmt;
            }

            $previousYearInvoices = Invoice::leftJoin('quotes', 'quotes.id', 'invoices.Quotesid')
                ->where('invoices.Quotesid', '!=', '0')
                ->where('quotes.user_id', '!=', '1')
                ->where('invoices.is_payment_recieved', 1)
                ->whereNull('invoices.deleted_at')
                ->whereYear('invoices.created_at', $previousYear)
                ->get();

            // Group by user_id and calculate the total amount for the current month
            $currentMonthBestSeller = $currentMonthInvoices->groupBy('user_id')
                ->map(function ($invoices) {
                    return $invoices->sum('final_total_amt');
                })->sortDesc()->toArray();

            // Group by user_id and calculate the total amount for the previous year
            $previousYearBestSeller = $previousYearInvoices->groupBy('user_id')
                ->map(function ($invoices) {
                    return $invoices->sum('final_total_amt');
                })->sortDesc()->toArray();

            // Fetch employee details
            $currentMonthBestSellerEmployeeId = $currentMonthBestSeller ? array_key_first($currentMonthBestSeller) : null;
            $previousYearBestSellerEmployeeId = $previousYearBestSeller ? array_key_first($previousYearBestSeller) : null;

            $currentMonthBestSellerEmployee = $currentMonthBestSellerEmployeeId ? User::find($currentMonthBestSellerEmployeeId) : null;
            $previousYearBestSellerEmployee = $previousYearBestSellerEmployeeId ? User::find($previousYearBestSellerEmployeeId) : null;

            if ($currentMonthBestSellerEmployee) {
                $currentMonthEmpPrice = $currentMonthBestSeller[$currentMonthBestSellerEmployeeId];
            } else {
                $currentMonthEmpPrice = 0.00;
            }
            if ($previousYearBestSellerEmployee) {
                $currentYearEmpPrice = $previousYearBestSeller[$previousYearBestSellerEmployeeId];
            } else {
                $currentYearEmpPrice = 0.00;
            }

           if ($request->filter2 == 'current-month-report') {
                $startDates = Carbon::now()->startOfMonth();
                $endDates = Carbon::now();
                $filter2 = 'Of Current Month';
            } elseif ($request->filter2 == 'last-year-report') {
                $startDates = Carbon::now()->startOfYear(); // Start of current year
                $endDates = Carbon::now(); // End of today
                $filter2 = 'Of Current Year';
            } else {
                // Default to the current month
                $startDates = Carbon::now()->startOfMonth();
                $endDates = Carbon::now();
                $filter2 = 'Of Current Month';
            }

            if ($request->filter == 'today') {
                $startDate = Carbon::today();
                $endDate = Carbon::today();
                $filter = 'Of Todays';
            } elseif ($request->filter == 'yesterday') {
                $startDate = Carbon::yesterday();
                $endDate = Carbon::yesterday();
                $filter = 'Of Yesterday';
            } elseif ($request->filter == 'last-7-days') {
                $startDate = Carbon::now()->subDays(7);
                $endDate = Carbon::now();
                $filter = 'Of Last 7 Days';
            } elseif ($request->filter == 'last-30-days') {
                $startDate = Carbon::now()->subDays(30);
                $endDate = Carbon::now();
                $filter = 'Of Last 30 Days';
            } elseif ($request->filter == 'current-month') {
                $startDate = Carbon::now()->startOfMonth();
                $endDate = Carbon::now();
                $filter = 'Of Current Month';
            } elseif ($request->filter == 'last-month') {
                $startDate = Carbon::now()->subMonth()->startOfMonth();
                $endDate = Carbon::now()->subMonth()->endOfMonth();
                $filter = 'Of Last Month';
            } else {
                // Default to the current month
                $startDate = Carbon::now()->startOfMonth();
                $endDate = Carbon::now();
                $filter = 'Of Current Month';
            }

            $PayExpenses = PayRoll::whereBetween('created_at', [$startDate, $endDate])
                ->sum('net_paid');
           

            $PayExpensesTotal = PayRoll::whereBetween('created_at', [$startDate, $endDate])
                ->sum('net_salary');

            
            // Fetching data with date filters
            $TotalSales = round(Invoice::whereBetween('created_at', [$startDates, $endDates])->sum('final_total_amt'));

            $StaSales = round(Invoice::whereBetween('created_at', [$startDate, $endDate])
                ->whereNull('deleted_at')
                ->sum('final_total_amt'));

            $StaCustomer = User::where('type', 2)
                ->whereMonth('created_at', $currentMonth)
                ->whereYear('created_at', $currentYear)
                ->whereBetween('created_at', [$startDates, $endDates])
                ->count();

            $StaProducts = Invoice::where('is_payment_recieved', 1)
                ->whereMonth('created_at', $currentMonth)
                ->whereYear('created_at', $currentYear)
                ->whereBetween('created_at', [$startDates, $endDates])
                ->whereNull('deleted_at')
                ->groupBy('product_id')
                ->count();

            $StaRevenue = round(Invoice::where('is_payment_recieved', 1)
                ->whereMonth('created_at', $currentMonth)
                ->whereYear('created_at', $currentYear)
                ->whereBetween('created_at', [$startDates, $endDates])
                ->whereNull('deleted_at')
                ->sum('final_total_amt'));


            $previousMonthAmount = round(Invoice::where('is_payment_recieved', 1)
                ->whereMonth('created_at', now()->subMonth()->month)
                ->whereYear('created_at', $currentYear)->whereNull('deleted_at')
                ->sum('amount'));

            $LeadsGenerated = Leads::whereMonth('created_at', $currentMonth)
                ->whereYear('created_at', $currentYear)
                ->count();

            $LeadsProgress = Leads::where('status', 1)
                ->whereMonth('created_at', $currentMonth)
                ->whereYear('created_at', $currentYear)
                ->count();

            $LeadsWin = Leads::where('status', 2)
                ->whereMonth('created_at', $currentMonth)
                ->whereYear('created_at', $currentYear)
                ->count();

            $LeadsLoss = Leads::where('status', 3)
                ->whereMonth('created_at', $currentMonth)
                ->whereYear('created_at', $currentYear)
                ->count();

            $default_currency = Currency::where('is_default', 1)->first();

            $PopularProducts = DB::table('product_news')
                ->leftJoin('product_pricing', function ($join) use ($default_currency) {
                    $join->on('product_pricing.product_id', '=', 'product_news.id')
                        ->where('product_pricing.currency_id', '=', $default_currency->id);
                })
                ->leftJoin('invoices', 'invoices.product_id', '=', 'product_news.id')
                ->select(
                    'product_news.id',
                    'product_news.product_name',
                    'product_news.product_image',
                    'product_pricing.price',
                    'product_news.product_tag_line',
                    DB::raw('COUNT(invoices.product_id) as purchase_count')
                )
                ->groupBy('product_news.id')
                ->having('purchase_count', '>', 0)
                ->orderBy('purchase_count', 'desc')
                ->limit(10)
                ->get();

            $TotalTransation = Transaction::select('users.first_name', 'users.profile_img', 'users.email', 'transactions.status', 'transactions.amount')
                ->leftJoin('invoices', 'invoices.id', 'transactions.invoice_id')
                ->leftJoin('users', 'users.id', 'invoices.client_id')
                ->whereMonth('transactions.created_at', $currentMonth)
                ->whereYear('transactions.created_at', $currentYear)
                ->limit(6)
                ->get();

            $TotalIncome = Project::whereBetween('created_at', [$startDates, $endDates])
                ->sum('project_value');

            $PreviousTotalIncome = Project::whereBetween('created_at', [$startDates, $endDates])
                ->sum('project_value');

            $PreviousTotalExpenses = PayRoll::whereBetween('created_at', [$startDates, $endDates])
                ->sum('net_paid');
                
            $PayExpenses2 = PayRoll::whereBetween('created_at', [$startDates, $endDates])
                ->sum('net_salary');
            $StaSales2 = round(Invoice::whereBetween('created_at', [$startDates, $endDates])
                ->whereNull('deleted_at')
                ->sum('final_total_amt'));

                
            $PayExpenses = PayRoll::whereBetween('created_at', [$startDate, $endDate])
                ->sum('net_paid');
           

            $PayExpensesTotal = PayRoll::whereBetween('created_at', [$startDate, $endDate])
                ->sum('net_salary');
            return view('admin.dashboard.Sales', compact(
                'TotalSales', 'StaSales', 'StaCustomer', 'StaProducts', 'filter', 'StaRevenue','StaSales2','PayExpensesTotal','filter2','PayExpenses','PayExpenses2', 'default_currency', 'PayExpenses', 'PayExpensesTotal',
                'previousMonthAmount', 'LeadsGenerated', 'LeadsProgress', 'LeadsWin', 'LeadsLoss', 'PopularProducts',
                'TotalTransation', 'TotalIncome', 'PreviousTotalIncome', 'TClient', 'PreviousTotalExpenses',
                'currentMonthBestSellerEmployee', 'previousYearBestSellerEmployee', 'previousYear', 'currentMonthEmpPrice', 'currentYearEmpPrice', 'totalSalesCurrentMonthPrice', 'totalClientCount', 'totalRevenueCurrentMonthPrice'
            ));
        }
 

    }


    public function subsApproveUn(Request $request,$id, $category_id, $status)
    {
         // return $id .' '. $category_id .' '. $status;
        if ($category_id == 4) {
            $serviceData = BareMetal::find($id);
            // return $serviceData;
        } elseif ($category_id == 5) {
            $serviceData = CloudHosting::find($id);
        } elseif ($category_id == 6) {
            $serviceData = CloudServices::find($id);
        } elseif ($category_id == 7) {
            $serviceData = DedicatedServer::find($id);
        } elseif ($category_id == 8) {
            $serviceData = AwsService::find($id);
        } elseif ($category_id == 9) {
            $serviceData = Azure::find($id);
        } elseif ($category_id == 10) {
            $serviceData = GoogleWorkSpace::find($id);
        } elseif ($category_id == 11) {
            $serviceData = MicrosoftOffice365::find($id);
        } elseif ($category_id == 12) {
            $serviceData = OneTimeSetup::find($id);
        } elseif ($category_id == 13) {
            $serviceData = MonthelySetup::find($id);
        } elseif ($category_id == 14) {
            $serviceData = SSLCertificate::find($id);
        } elseif ($category_id == 15) {
            $serviceData = Antivirus::find($id);
        } elseif ($category_id == 16) {
            $serviceData = Licenses::find($id);
        } elseif ($category_id == 17) {
            $serviceData = Acronis::find($id);
        } elseif ($category_id == 18) {
            $serviceData = TsPlus::find($id);
        }
        $serviceData->status = $status;
        // return $serviceData;
        $check = $serviceData->save();
        return redirect()->back();
    }



    public function CancelRequests(){
      $cancelRequests = $this->getCancellationRequest();
// return $cancelRequests;
      return view('admin.CancelRequest.home',compact('cancelRequests'));
    }


    private function getCancellationRequest($value = '')
    {
        $categories = [
            4 => BareMetal::class,
            5 => CloudHosting::class,
            6 => CloudServices::class,
            7 => DedicatedServer::class,
            8 => AwsService::class,
            9 => Azure::class,
            10 => GoogleWorkSpace::class,
            11 => MicrosoftOffice365::class,
            12 => OneTimeSetup::class,
            13 => MonthelySetup::class,
            14 => SSLCertificate::class,
            15 => Antivirus::class,
            16 => Licenses::class,
            17 => Acronis::class,
            18 => TsPlus::class,
        ];

        // return $categories;

        // $cancelRequests = [];
        foreach ($categories as $categoryId => $categoryClass) {
            switch ($categoryId) {
                case 4:
                    $cancelRequests[] = $categoryClass::join('product_news', 'product_news.id', '=', 'bare_metals.product_id')
                        ->join('users', 'users.id', '=', 'bare_metals.customer_id')
                        ->select('bare_metals.id', 'product_news.category_id', 'bare_metals.status', 'users.first_name', 'product_news.product_name')
                        ->where('bare_metals.status', 4)
                        ->get();

                    break;
                case 5:
                    $cancelRequests[] = $categoryClass::join('product_news', 'product_news.id', '=', 'cloud_hostings.product_id')
                        ->join('users', 'users.id', '=', 'cloud_hostings.customer_id')
                        ->select('cloud_hostings.id', 'product_news.category_id', 'cloud_hostings.status', 'users.first_name', 'product_news.product_name')
                        ->where('cloud_hostings.status', 4)
                        ->get();
                    break;
                case 6:
                    $cancelRequests[] = $categoryClass::join('product_news', 'product_news.id', '=', 'cloud_services.product_id')
                        ->join('users', 'users.id', '=', 'cloud_services.customer_id')
                        ->select('cloud_services.id', 'product_news.category_id', 'cloud_services.status', 'users.first_name', 'product_news.product_name')
                        ->where('cloud_services.status', 4)
                        ->get();
                    break;
                case 7:
                    $cancelRequests[] = $categoryClass::join('product_news', 'product_news.id', '=', 'dedicated_servers.product_id')
                        ->join('users', 'users.id', '=', 'dedicated_servers.customer_id')
                        ->select('dedicated_servers.id', 'product_news.category_id', 'dedicated_servers.status', 'users.first_name', 'product_news.product_name')
                        ->where('dedicated_servers.status', 4)
                        ->get();
                    break;
                case 8:
                    $cancelRequests[] = $categoryClass::join('product_news', 'product_news.id', '=', 'aws_services.product_id')
                        ->join('users', 'users.id', '=', 'aws_services.customer_id')
                        ->select('aws_services.id', 'product_news.category_id', 'aws_services.status', 'users.first_name', 'product_news.product_name')
                        ->where('aws_services.status', 4)
                        ->get();
                    break;
                case 9:
                    $cancelRequests[] = $categoryClass::join('product_news', 'product_news.id', '=', 'azures.product_id')
                        ->join('users', 'users.id', '=', 'azures.customer_id')
                        ->select('azures.id', 'product_news.category_id', 'azures.status', 'users.first_name', 'product_news.product_name')
                        ->where('azures.status', 4)
                        ->get();
                    break;
                case 10:
                    $cancelRequests[] = $categoryClass::join('product_news', 'product_news.id', '=', 'google_work_spaces.product_id')
                        ->join('users', 'users.id', '=', 'google_work_spaces.customer_id')
                        ->select('google_work_spaces.id', 'product_news.category_id', 'google_work_spaces.status', 'users.first_name', 'product_news.product_name')
                        ->where('google_work_spaces.status', 4)
                        ->get();
                    break;
                case 11:
                    $cancelRequests[] = $categoryClass::join('product_news', 'product_news.id', '=', 'microsoft_office365s.product_id')
                        ->join('users', 'users.id', '=', 'microsoft_office365s.customer_id')
                        ->select('microsoft_office365s.id', 'product_news.category_id', 'microsoft_office365s.status', 'users.first_name', 'product_news.product_name')
                        ->where('microsoft_office365s.status', 4)
                        ->get();
                    break;
                case 12:
                    $cancelRequests[] = $categoryClass::join('product_news', 'product_news.id', '=', 'one_time_setups.product_id')
                        ->join('users', 'users.id', '=', 'one_time_setups.customer_id')
                        ->select('one_time_setups.id', 'product_news.category_id', 'one_time_setups.status', 'users.first_name', 'product_news.product_name')
                        ->where('one_time_setups.status', 4)
                        ->get();
                    break;
                case 13:
                    $cancelRequests[] = $categoryClass::join('product_news', 'product_news.id', '=', 'monthely_setups.product_id')
                        ->join('users', 'users.id', '=', 'monthely_setups.customer_id')
                        ->select('monthely_setups.id', 'product_news.category_id', 'monthely_setups.status', 'users.first_name', 'product_news.product_name')
                        ->where('monthely_setups.status', 4)
                        ->get();
                    break;
                case 14:
                    $cancelRequests[] = $categoryClass::join('product_news', 'product_news.id', '=', 's_s_l_certificates.product_id')
                        ->join('users', 'users.id', '=', 's_s_l_certificates.customer_id')
                        ->select('s_s_l_certificates.id', 'product_news.category_id', 's_s_l_certificates.status', 'users.first_name', 'product_news.product_name')
                        ->where('s_s_l_certificates.status', 4)
                        ->get();
                    break;
                case 15:
                    $cancelRequests[] = $categoryClass::join('product_news', 'product_news.id', '=', 'antiviri.product_id')
                        ->join('users', 'users.id', '=', 'antiviri.customer_id')
                        ->select('antiviri.id', 'product_news.category_id', 'antiviri.status', 'users.first_name', 'product_news.product_name')
                        ->where('antiviri.status', 4)
                        ->get();
                    break;
                case 16:
                    $cancelRequests[] = $categoryClass::join('product_news', 'product_news.id', '=', 'licenses.product_id')
                        ->join('users', 'users.id', '=', 'licenses.customer_id')
                        ->select('licenses.id', 'product_news.category_id', 'licenses.status', 'users.first_name', 'product_news.product_name')
                        ->where('licenses.status', 4)
                        ->get();
                    break;
                case 17:
                    $cancelRequests[] = $categoryClass::join('product_news', 'product_news.id', '=', 'acronis.product_id')
                        ->join('users', 'users.id', '=', 'acronis.customer_id')
                        ->select('acronis.id', 'product_news.category_id', 'acronis.status', 'users.first_name', 'product_news.product_name')
                        ->where('acronis.status', 4)
                        ->get();
                    break;
                case 18:
                    $cancelRequests[] = $categoryClass::join('product_news', 'product_news.id', '=', 'ts_pluses.product_id')
                        ->join('users', 'users.id', '=', 'ts_pluses.customer_id')
                        ->select('ts_pluses.id', 'product_news.category_id', 'ts_pluses.status', 'users.first_name', 'product_news.product_name')
                        ->where('ts_pluses.status', 4)
                        ->get();
                    break;
                default:
                    $cancelRequests = [];
            }
        }

        return $cancelRequests;
    }
}
