<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Jenssegers\Agent\Agent;
use App\Models\Leads;
use App\Models\User;
use App\Models\Task;
use App\Models\Ticket;
use App\Models\Leave;
use App\Models\Invoice;
use App\Models\ProductNew;
use App\Models\Quotes;
use App\Models\PayRoll;
use App\Models\Product;
use App\Models\PerformanceRating;
use App\Models\PerformanceCategory;
use App\Models\Transaction;
use App\Models\Currency;
use App\Models\Azure;
use App\Models\Project;
use App\Models\Antivirus;
use App\Models\SSLCertificate;
use App\Models\MonthelySetup;
use App\Models\OneTimeSetup;
use App\Models\Licenses;
use App\Models\Acronis;
use App\Models\MicrosoftOffice365;
use App\Models\TsPlus;
use App\Models\GoogleWorkSpace;
use App\Models\AwsService;
use App\Models\DedicatedServer;
use App\Models\CloudServices;
use App\Models\CloudHosting;
use App\Models\BareMetal;
use App\Models\LeaveType;
use App\Models\TimeSheet;
use App\Models\Attendence;
use App\Models\Goal;
use App\Models\Orders;
use App\Models\EmployeeDetail;
use App\Models\TimeShift;
use App\Models\LeadsFollowup;
use App\Models\Calendar;
use App\Models\Holiday;
use App\Models\Notice;
use Carbon\Carbon;
use App\Events\AppEvents;
use Auth;
use DB;

class EDashboardController extends Controller
{
    
    public function index(Request $request)
    {
        $userId = Auth::id();
        $userId = Auth::user()->id;
        $EmpDetail = \App\Models\EmployeeDetail::where('user_id', Auth::user()->id)->first();
        $isDepartment3 = $EmpDetail && $EmpDetail->department_id == 3;
        $default_currency = Currency::where('is_default',1)->first();
        $AuthRole = EmployeeDetail::select('admin_type_id','department_id')->where('user_id',Auth::user()->id)->first();
        $currentMonth = Carbon::now()->month;
        $currentDate = Carbon::now()->toDateString();
        $User = EmployeeDetail::select('shift_id')->where('user_id',Auth::user()->id)->first();
        //job_role_id 
        $UserRole = EmployeeDetail::leftjoin('roles','roles.id','employee_details.job_role_id')->select('roles.name')->where('employee_details.user_id',Auth::user()->id)->first();
        $Attendence = Attendence::select('punch_in','punch_out')->where('emp_Id',auth::user()->id)->where('punch_date',date('Y-m-d'))->get();
        $TimeShift = TimeShift::select('working_hours','shift_name','Colorname')->where('id',$User->shift_id)->first();
        $CheckInTime = Attendence::select('punch_in')->where('emp_Id',auth::user()->id)->where('punch_date',date('Y-m-d'))->first();
                    $previousMonth = date('m', strtotime('-1 month'));
                    $previousYear = date('Y', strtotime('-1 month'));
                    $startDate = date("$previousYear-$previousMonth-01");
                    $endDate = date("Y-m-t", strtotime($startDate));
                
                    $highestRating = 0;
                    $bestEmployee = null;
                            // Determine the previous month's start and end dates

                    // Query to find the employee with the highest goal achievement for the previous month
                    $highestGoalAchiever = Goal::select('users.first_name', 'users.last_name', 'users.id', 'users.email', 'users.profile_img', DB::raw('SUM(goals.archieved_value) as total_archieved_value'))
                                               ->join('users', 'users.id', '=', 'goals.employee_id')
                                               ->whereBetween('goals.date', [$startDate, $endDate])
                                               ->groupBy('users.id', 'users.first_name', 'users.last_name', 'users.email', 'users.profile_img')
                                               ->orderByDesc('total_archieved_value')
                                               ->first();
                

                    
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
        // for technical support
        if($AuthRole->department_id == 1)
        {
            $totalTicket = Ticket::count();
            $currentMonthTicket = Ticket::whereMonth('created_at', $currentMonth)->count();
            $todayTicket = Ticket::whereDate('created_at', $currentDate)->count();
            $pendingTicket = Ticket::whereDate('created_at', $currentDate)->count();
            $OpenTicket = Ticket::where('status', 1)->count();
            $TimeSheet  = TimeShift::select('id', 'shift_name', 'StartTime', 'EndTime', 'working_hours')
            ->orderBy('created_at', 'desc')->limit(7)->get();
            
            $assignProject = Task::where('AssignedTo', 'LIKE', '%' . Auth::user()->id . '%')->limit(10)->get();
            $project = Project::select('projects.project_name','projects.deadline','projects.start_date','projects.status_id')->limit(5)->get();
            $completeEfficiency = Goal::where('status',3)->where('employee_id',Auth::user()->id)->sum('archieved_value');            
            $inProgressEfficiency = Goal::where('status',2)->where('employee_id',Auth::user()->id)->sum('goal_value');
            $teamLeads = EmployeeDetail::Join('users','employee_details.user_id','=','users.id')->leftjoin('departments','employee_details.department_id','=','departments.id')->select('departments.name','users.first_name','users.profile_img','users.id')->where('employee_details.team_lead',1)->get();
            $leaves = LeaveType::get();     
            $ticketWithoutReply =Ticket::leftJoin('chats', 'tickets.id', '=', 'chats.ticket_id')
            ->whereNull('chats.ticket_id')
            ->whereMonth('tickets.created_at', $currentMonth)
            ->count(); 
            
            $ticketsWithFirstChat = Ticket::leftJoin('chats', 'tickets.id', '=', 'chats.ticket_id')
            ->select(DB::raw('TIMESTAMPDIFF(MINUTE, tickets.created_at, chats.created_at) AS time_diff_sum'))
            ->groupBy('chats.ticket_id')
            ->orderBy('chats.id', 'ASC')
            ->get();
            $kra = EmployeeDetail::where('user_id',Auth::user()->id)->select('kra')->first();
            $currentMonth = now()->format('m');
            $currentYear = now()->year;
            $previousYear = now()->subYear()->year;
            
            // Fetch all invoices that meet the criteria for the current month
            $currentMonthInvoices = Invoice::leftJoin('quotes', 'quotes.id', 'invoices.Quotesid')
            ->where('invoices.Quotesid', '!=', '0')
            ->where('quotes.user_id',Auth::user()->id)
            ->where('invoices.is_payment_recieved', 1)
            ->whereNull('invoices.deleted_at')
            ->whereMonth('invoices.created_at', $currentMonth)
            ->whereYear('invoices.created_at', $currentYear)
            ->get();
            
         
            
            
            
            $previousYearInvoices = Invoice::leftJoin('quotes', 'quotes.id', 'invoices.Quotesid')
            ->where('invoices.Quotesid', '!=', '0')
            ->where('quotes.user_id',Auth::user()->id)
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
            $StaSales = round(Invoice::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)->whereNull('deleted_at')
            ->sum('final_total_amt'));
            $totalSalesCurrentMonth = Orders::leftJoin('quotes', 'quotes.id', 'orders.quotes_id')
            ->leftJoin('invoices', 'invoices.id', 'orders.invoice_id')
            ->whereNull('orders.deleted_at')
            ->where('orders.user_id',Auth::user()->id)
            ->whereMonth('orders.created_at', $currentMonth)
            ->whereYear('orders.created_at', $currentYear)
            ->get();
            
            $totalSalesCurrentMonthPrice = $totalSalesCurrentMonth->sum('total_amt');
            $StaCustomer = User::where('type', 2)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();
            $StaProducts = Invoice::where('is_payment_recieved', 1)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)->whereNull('deleted_at')
            ->groupBy('product_id')
            ->count();
            
            $TClient = User::where('type', 2)->where('status', 1)->count();
            $StaRevenue = round(Invoice::where('is_payment_recieved', 1)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)->whereNull('deleted_at')
            ->sum('final_total_amt'));
            
            
            $totalRevenueCurrentMonth = Invoice::leftJoin('quotes', 'quotes.id', 'invoices.Quotesid')
            ->whereNull('invoices.deleted_at')
            ->where('invoices.user_id',Auth::user()->id)
            ->whereMonth('invoices.created_at', $currentMonth)
            ->whereYear('invoices.created_at', $currentYear)
            ->get();
            
            $totalRevenueCurrentMonthPrice = $totalRevenueCurrentMonth->sum('final_total_amt');
            $PayExpenses = PayRoll::whereMonth('created_at', $currentMonth)
            ->where('emp_Id',Auth::user()->id)
            ->whereYear('created_at', $currentYear)
            ->sum('net_paid');
            
            $PayExpensesTotal = PayRoll::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->sum('net_salary');
            $previousMonthAmount = round(Invoice::where('is_payment_recieved', 1)
            ->whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', $currentYear)->whereNull('deleted_at')
            ->sum('amount'));
            $LeadsGenerated = Leads::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();
            $PreviousTotalIncome = Project::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', $currentYear)
            ->sum('project_value');
            $PreviousTotalExpenses = PayRoll::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', $currentYear)
            ->sum('net_paid');
            $TotalIncome = Project::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->sum('project_value');
            
            
            $default_currency = Currency::where('is_default', 1)->first();
            
            $PopularProducts = ProductNew::leftJoin('product_pricing', function ($join) use ($default_currency) {
                $join->on('product_pricing.product_id', '=', 'product_news.id')
                ->where('product_pricing.currency_id', '=', $default_currency->id); // Condition for default currency
            })
            ->select('product_news.id', 'product_news.product_name', 'product_news.product_image', 'product_pricing.price', 'product_news.product_tag_line')
            ->orderBy('product_news.order_count', 'desc') // Order by order_count to get popular products
            ->orderBy('product_news.created_at', 'desc') // Order by created_at to get latest products
            ->groupBy('product_news.id') // Group by product_news.id to avoid duplicate entries
            ->limit(10) // Limit to 10 products
            ->get();
            $TProJect = Project::whereNotIn('status_id', ['2', '4'])->count();
            $OpenTicket = Ticket::where('status', 1)->count();
            $TTask = Task::whereNotIn('status_id', ['2', '4'])->count();
            $showTTask = Task::count();
            $OpenTask = Task::where('status_id', 1)->count();
            $TasksOverDue = Task::where('status_id', 3)->count();
            $currentMonth = Carbon::now()->month;
            $currentYear = Carbon::now()->year;
            
            
            $previousYear = now()->subYear()->year;
            
            // Fetch all invoices that meet the criteria for the current month
            $currentMonthInvoices = Invoice::leftJoin('quotes', 'quotes.id', 'invoices.Quotesid')
            ->where('invoices.Quotesid', '!=', '0')
            ->where('quotes.user_id',Auth::user()->id)
            ->where('invoices.is_payment_recieved', 1)
            ->whereNull('invoices.deleted_at')
            ->whereMonth('invoices.created_at', $currentMonth)
            ->whereYear('invoices.created_at', $currentYear)
            ->get();
            
            
            $totalSalesCurrentMonth = Orders::leftJoin('quotes', 'quotes.id', 'orders.quotes_id')
            ->leftJoin('invoices', 'invoices.id', 'orders.invoice_id')
            ->whereNull('orders.deleted_at')
            ->where('orders.user_id',Auth::user()->id)
            ->whereMonth('orders.created_at', $currentMonth)
            ->whereYear('orders.created_at', $currentYear)
            ->get();
            
                              $totalSalesCurrentMonth = Orders::where('orders.user_id', Auth::user()->id)
                        ->whereMonth('orders.created_at', $currentMonth)
                        ->whereYear('orders.created_at', $currentYear)
                        ->get();
                    
                    // Calculate total sales amount, ensuring only numeric values are summed
                    $totalSalesCurrentMonthPrice = $totalSalesCurrentMonth->sum(function($order) {
                        return is_numeric($order->total_amt) ? (float) $order->total_amt : 0;
                    });
                    
                    // Get the total client count
                    $totalClientCount = User::where('type', '4')->whereNull('deleted_at')->count();
                    
                    // Get the total revenue for the current month
                    $totalRevenueCurrentMonth = Invoice::leftJoin('quotes', 'quotes.id', 'invoices.Quotesid')
                        ->whereNull('invoices.deleted_at')
                        ->whereMonth('invoices.created_at', $currentMonth)
                        ->whereYear('invoices.created_at', $currentYear)
                        ->get();
                    
                    // Calculate total revenue amount, ensuring only numeric values are summed
                    $totalRevenueCurrentMonthPrice = $totalRevenueCurrentMonth->sum(function($invoice) {
                        return is_numeric($invoice->final_total_amt) ? (float) $invoice->final_total_amt : 0;
                    });
                                
               
         
            $default_currency = Currency::where('is_default', 1)->first();
            
            $PopularProducts = ProductNew::leftJoin('product_pricing', function ($join) use ($default_currency) {
                $join->on('product_pricing.product_id', '=', 'product_news.id')
                ->where('product_pricing.currency_id', '=', $default_currency->id); // Condition for default currency
            })
            ->select('product_news.id', 'product_news.product_name', 'product_news.product_image', 'product_pricing.price', 'product_news.product_tag_line')
            ->orderBy('product_news.order_count', 'desc') // Order by order_count to get popular products
            ->orderBy('product_news.created_at', 'desc') // Order by created_at to get latest products
            ->groupBy('product_news.id') // Group by product_news.id to avoid duplicate entries
            ->limit(10) // Limit to 10 products
            ->get();
            $TProJect = Project::whereNotIn('status_id', ['2', '4'])->count();
            $OpenTicket = Ticket::where('status', 1)->count();
            $TTask = Task::whereNotIn('status_id', ['2', '4'])->count();
            $showTTask = Task::count();
            $OpenTask = Task::where('status_id', 1)->count();
            $TasksOverDue = Task::where('status_id', 3)->count();
            $currentMonth = Carbon::now()->month;
            $currentYear = Carbon::now()->year;
            
            // Retrieve tickets created in the current month and year with their first responses
            $tickets = Ticket::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->where('ccid', Auth::user()->id)
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
                $averageResponseTime = '0.00';
            }
            
            
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
                $shiftDuration = "0.00";
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
            $LeadsProgress  = Leads::where('status', 1)->whereMonth('created_at', $currentMonth)->whereYear('created_at', now()->year)->count();
            
            $previousYearInvoices = Invoice::leftJoin('quotes', 'quotes.id', 'invoices.Quotesid')
            ->where('invoices.Quotesid', '!=', '0')
            ->where('quotes.user_id',Auth::user()->id)
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
            
            $Performance = User::select('users.first_name','users.id','users.email','users.profile_img','departments.name as departments_name')
            ->leftjoin('employee_details','employee_details.user_id','users.id')
            ->leftjoin('departments','departments.id','employee_details.department_id')
            ->where('users.type', 4)
            ->where('users.id',$userId)
            ->paginate(10);
            $user_details = User::find($userId);
            $PerformanceCategory = PerformanceCategory::get();
            $PerformanceRating = PerformanceRating::get();
            
            // Initialize arrays to store counts for each month
            $joinedEmployees = array_fill(0, 12, 0);
            $resignedEmployees = array_fill(0, 12, 0);
            
            // Loop through each month to get the data
            for ($month = 1; $month <= 12; $month++) {
                // Count joined employees
                $joinedEmployees[$month - 1] = User::whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $month)
                ->whereIn('status', [1, 2, 3])
                ->count();
                
                // Count resigned employees
                $resignedEmployees[$month - 1] = User::whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $month)
                ->whereIn('status', [4,5])
                ->count();
            }
            $userId = Auth::id();
            
            // Retrieve leaves for the logged-in user
            $leaves = Leave::where('user_id', $userId)->get();
            
            // Retrieve leave types to get their themes and allowed counts
            $leaveTypes = LeaveType::all();
            
            // Calculate leave counts per type for the logged-in user
            $leaveTypeCounts = [];
            foreach ($leaves as $leave) {
                if (!isset($leaveTypeCounts[$leave->leavetype_id])) {
                    $leaveTypeCounts[$leave->leavetype_id] = 0;
                }
                $leaveTypeCounts[$leave->leavetype_id] += $leave->days; // Assuming days field represents the number of leaves taken
            }
            
            // Prepare data for the view
            $leaveStatus = [];
            foreach ($leaveTypes as $type) {
                $leaveTypeId = $type->id;
                $allowedLeaves = $type->no_of_leave;
                $theme = $type->theme;
                
                $takenLeaves = isset($leaveTypeCounts[$leaveTypeId]) ? $leaveTypeCounts[$leaveTypeId] : 0;
                $percentage = $allowedLeaves > 0 ? ($takenLeaves / $allowedLeaves) * 100 : 0;
                $percentage = number_format($percentage, 2);
                
                // Determine color based on theme
                $colorClass = '';
                if ($theme === 'info') {
                    $colorClass = 'bg-info';
                } elseif ($theme === 'warning') {
                    $colorClass = 'bg-warning';
                } elseif ($theme === 'danger') {
                    $colorClass = 'bg-danger';
                } else {
                    $colorClass = 'bg-primary'; // Default color
                }
                
                $leaveStatus[] = [
                    'type' => $type->leave_type,
                    'allowed' => $allowedLeaves, // Ensure this field is available in the LeaveType model
                    'taken' => $takenLeaves,
                    'percentage' => $percentage,
                    'colorClass' => $colorClass
                ];
            }
            
            $StaRevenue = round(Invoice::where('is_payment_recieved', 1)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)->whereNull('deleted_at')
            ->sum('final_total_amt'));
            $default_currency = Currency::where('is_default', 1)->first();
            // Fetch all invoices that meet the criteria for the current month
            $currentMonthInvoices = Invoice::leftJoin('quotes', 'quotes.id', 'invoices.Quotesid')
            ->where('invoices.Quotesid', '!=', '0')
            ->where('quotes.user_id',Auth::user()->id)
            ->where('invoices.is_payment_recieved', 1)
            ->whereNull('invoices.deleted_at')
            ->whereMonth('invoices.created_at', $currentMonth)
            ->whereYear('invoices.created_at', $currentYear)
            ->get();
            
            
            $totalSalesCurrentMonth = Orders::leftJoin('quotes', 'quotes.id', 'orders.quotes_id')
            ->leftJoin('invoices', 'invoices.id', 'orders.invoice_id')
            ->whereNull('orders.deleted_at')
            ->where('orders.user_id',Auth::user()->id)
            ->whereMonth('orders.created_at', $currentMonth)
            ->whereYear('orders.created_at', $currentYear)
            ->get();
            
            $totalSalesCurrentMonthPrice = $totalSalesCurrentMonth->sum('total_amt');
            
            $totalClientCount = User::where('type','4')->whereNull('deleted_at')->count();
            
            $totalRevenueCurrentMonth = Invoice::leftJoin('quotes', 'quotes.id', 'invoices.Quotesid')
            ->whereNull('invoices.deleted_at')
            ->whereMonth('invoices.created_at', $currentMonth)
            ->whereYear('invoices.created_at', $currentYear)
            ->get();
            
            
            // Total revenue for the current month
            $totalRevenueCurrentMonthPrice = Invoice::leftJoin('quotes', 'quotes.id', 'invoices.Quotesid')
            ->whereNull('invoices.deleted_at')
            ->whereMonth('invoices.created_at', $currentMonth)
            ->whereYear('invoices.created_at', $currentYear)
            ->sum('final_total_amt');
            
            // Total sales for the current month
            $totalSalesCurrentMonthPrice = Orders::leftJoin('quotes', 'quotes.id', 'orders.quotes_id')
            ->leftJoin('invoices', 'invoices.id', 'orders.invoice_id')
            ->whereNull('orders.deleted_at')
            ->whereMonth('orders.created_at', $currentMonth)
            ->whereYear('orders.created_at', $currentYear)
            ->sum('total_amt');
            
            // Total client count
            $totalClientCount = User::where('type', '4')
            ->whereNull('deleted_at')
            ->count();
            
            // Default currency
            $default_currency = Currency::where('is_default', 1)->first();
            $unresolvedTicketCount = \DB::table('tickets')
            ->leftJoin('chats', 'tickets.id', '=', 'chats.ticket_id')
            ->select('tickets.id')
            ->whereNull('chats.ticket_id')
            ->distinct()
            ->count('tickets.id');
            $UpcommingFollowups = LeadsFollowup::leftJoin('leads', 'leads.id', '=', 'leads_followups.leads_id')
            ->select('leads_followups.*')
            ->whereDate('leads_followups.follow_up_next', Carbon::today())
            ->orderBy('leads_followups.follow_up_next', 'DESC')
            ->limit(5)
            ->get(); 
            
            $upcomingEvents = Calendar::leftJoin('users', 'users.id', '=', 'calendars.user_id')
            ->select('calendars.*', 'users.first_name', 'users.profile_img', 'users.last_name')
            ->where('calendars.start', '>', Carbon::today()) // Events starting after today
            ->orWhere('calendars.end', '>', Carbon::today())   // Events ending after today
            ->orderBy('calendars.start', 'ASC') // Order by start date
            ->limit(3) // Limit the results to 5 events
            ->get();
                                    $calenderEvents = Calendar::whereMonth('start', date('m'))->whereDay('start', date('d'))->get();

            return view('Employee.dashDepartmentType.Support', compact('AuthRole','highestGoalAchiever','bestEmployee','calenderEvents','UserRole','upcomingEvents','UpcommingFollowups','unresolvedTicketCount','default_currency','totalRevenueCurrentMonthPrice','StaRevenue','leaveStatus','joinedEmployees','resignedEmployees','previousYearBestSellerEmployee','Performance','totalOvertime','shiftDuration','currentMonthEmpPrice','OpenTicket','OpenTask','totalBreakTime','averageResponseTime','totalTicket','Attendence','TimeShift','currentMonthTicket','todayTicket','pendingTicket','OpenTicket','TimeSheet','assignProject','completeEfficiency','inProgressEfficiency','teamLeads','leaves','ticketWithoutReply','ticketsWithFirstChat','kra','CheckInTime','project')); 
        }
        
        // for sales
        if($AuthRole->department_id == 2)
        {
            
            $monthlyData = Orders::select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(amount) as total'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();
            $teamLeads = EmployeeDetail::Join('users','employee_details.user_id','=','users.id')->leftjoin('departments','employee_details.department_id','=','departments.id')->select('departments.name','users.first_name','users.profile_img')->where('employee_details.team_lead',1)->limit(10)->get();
            $completeEfficiency = Goal::where('status',3)->where('employee_id',Auth::user()->id)->sum('archieved_value');      
            $inProgressEfficiency = Goal::where('status',2)->where('employee_id',Auth::user()->id)->sum('goal_value');
            $leaves = LeaveType::select('leave_types.id','leave_types.leave_type','leave_types.no_of_leave','leave_types.theme')->get(); 
            $LeadsWin   = Leads::where('status',2)->whereMonth('created_at', $currentMonth)->count();
            $LeadsLoss  = Leads::where('status',3)->whereMonth('created_at', $currentMonth)->count(); 
            $totalLeads  = Leads::whereMonth('created_at', $currentMonth)->count(); 
            
            $OnLeaves = Leave::select('users.first_name', 'users.profile_img', 'leaves.status', 'departments.name as dptname')
            ->where('leaves.date', date('Y-m-d'))
            ->leftJoin('users', 'leaves.emp_id', '=', 'users.id')
            ->leftJoin('employee_details as ed1', 'leaves.emp_id', '=', 'ed1.user_id')
            ->leftJoin('departments', 'ed1.department_id', '=', 'departments.id')
            ->limit(7)
            ->get();
            
            $currentMonth = now()->format('m');
            $currentYear = now()->year;
            $previousYear = now()->subYear()->year;
            
            // Fetch all invoices that meet the criteria for the current month
            $currentMonthInvoices = Invoice::leftJoin('quotes', 'quotes.id', 'invoices.Quotesid')
            ->where('invoices.Quotesid', '!=', '0')
            ->where('quotes.user_id',Auth::user()->id)
            ->where('invoices.is_payment_recieved', 1)
            ->whereNull('invoices.deleted_at')
            ->whereMonth('invoices.created_at', $currentMonth)
            ->whereYear('invoices.created_at', $currentYear)
            ->get();
            
            
            $totalSalesCurrentMonth = Orders::leftJoin('quotes', 'quotes.id', 'orders.quotes_id')
            ->leftJoin('invoices', 'invoices.id', 'orders.invoice_id')
            ->whereNull('orders.deleted_at')
            ->where('orders.user_id',Auth::user()->id)
            ->whereMonth('orders.created_at', $currentMonth)
            ->whereYear('orders.created_at', $currentYear)
            ->get();
            
            $totalSalesCurrentMonthPrice = $totalSalesCurrentMonth->sum('total_amt');
            
            $totalClientCount = User::where('type','4')->whereNull('deleted_at')->count();
            
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
            ->where('quotes.user_id',Auth::user()->id)
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
            
            $query = Goal::select('goals.status','goals.date','goals.goal_value','goals.archieved_value')
            ->groupBy('employee_id')
            ->latest('date')->paginate(10);
            $thisMonthSale = Orders::where('is_payment_recieved',1)->whereMonth('created_at', $currentMonth)->sum('total_amt'); 
            $totalSale = Orders::where('is_payment_recieved',1)->sum('total_amt');
            $pendingDeals = Orders::Join('product_news','orders.product_id','product_news.id')
            ->leftjoin('users','orders.user_id','=','users.id')
            ->select('users.first_name','product_news.product_name','orders.total_amt','orders.created_at')->limit(6)->get();
            
            $kra = EmployeeDetail::where('user_id',Auth::user()->id)->select('kra')->first();
            $StaSales = round(Invoice::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)->whereNull('deleted_at')
            ->sum('final_total_amt'));
            $totalSalesCurrentMonth = Orders::leftJoin('quotes', 'quotes.id', 'orders.quotes_id')
            ->leftJoin('invoices', 'invoices.id', 'orders.invoice_id')
            ->whereNull('orders.deleted_at')
            ->where('orders.user_id',Auth::user()->id)
            ->whereMonth('orders.created_at', $currentMonth)
            ->whereYear('orders.created_at', $currentYear)
            ->get();
            
            $totalSalesCurrentMonthPrice = $totalSalesCurrentMonth->sum('total_amt');
            $StaCustomer = User::where('type', 2)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();
            $StaProducts = Invoice::where('is_payment_recieved', 1)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)->whereNull('deleted_at')
            ->groupBy('product_id')
            ->count();

            $EmpDtl = EmployeeDetail::where('user_id',Auth::user()->id)->first();

            $TClient = User::where('type', 2)->where('status', 1)->where('user_id', Auth::user()->id)->count();
            $totalSaledInv = Invoice::where('user_id', Auth::user()->id)->where('is_payment_recieved', 1)->count();
            $totalSaledQuotes = Quotes::where('quotes.user_id', Auth::user()->id)->leftjoin('invoices','invoices.Quotesid','quotes.id')->where('invoices.is_payment_recieved', 1)->count();
            $totalOpenTickets = Ticket::where('department_id', $EmpDtl->department_id)->count();
            $totalSaledProducts = $totalSaledInv + $totalSaledQuotes;
            $StaRevenue = round(Invoice::where('is_payment_recieved', 1)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)->whereNull('deleted_at')
            ->sum('final_total_amt'));
            
            
            $totalRevenueCurrentMonth = Invoice::leftJoin('quotes', 'quotes.id', 'invoices.Quotesid')
            ->whereNull('invoices.deleted_at')
            ->where('invoices.user_id',Auth::user()->id)
            ->whereMonth('invoices.created_at', $currentMonth)
            ->whereYear('invoices.created_at', $currentYear)
            ->get();
            
            $totalRevenueCurrentMonthPrice = $totalRevenueCurrentMonth->sum('final_total_amt');
            $PayExpenses = PayRoll::whereMonth('created_at', $currentMonth)
            ->where('emp_Id',Auth::user()->id)
            ->whereYear('created_at', $currentYear)
            ->sum('net_paid');
            
            $PayExpensesTotal = PayRoll::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->sum('net_salary');
            $previousMonthAmount = round(Invoice::where('is_payment_recieved', 1)
            ->whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', $currentYear)->whereNull('deleted_at')
            ->sum('amount'));
            $LeadsGenerated = Leads::whereMonth('created_at', $currentMonth)
            ->where('generated_by', Auth::user()->id)
            ->whereYear('created_at', $currentYear)
            ->count();
            $PreviousTotalIncome = Project::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', $currentYear)
            ->sum('project_value');
            $PreviousTotalExpenses = PayRoll::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', $currentYear)
            ->sum('net_paid');
            $TotalIncome = Project::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->sum('project_value');
            
            
            $default_currency = Currency::where('is_default', 1)->first();
            
            $PopularProducts = ProductNew::leftJoin('product_pricing', function ($join) use ($default_currency) {
                $join->on('product_pricing.product_id', '=', 'product_news.id')
                ->where('product_pricing.currency_id', '=', $default_currency->id); // Condition for default currency
            })
            ->select('product_news.id', 'product_news.product_name', 'product_news.product_image', 'product_pricing.price', 'product_news.product_tag_line')
            ->orderBy('product_news.order_count', 'desc') // Order by order_count to get popular products
            ->orderBy('product_news.created_at', 'desc') // Order by created_at to get latest products
            ->groupBy('product_news.id') // Group by product_news.id to avoid duplicate entries
            ->limit(10) // Limit to 10 products
            ->get();
            
            $TProJect = Project::whereNotIn('status_id', ['2', '4'])->count();
            $OpenTicket = Ticket::where('status', 1)->count();
            $TTask = Task::whereNotIn('status_id', ['2', '4'])->count();
            $showTTask = Task::count();
            $OpenTask = Task::where('status_id', 1)->count();
            $TasksOverDue = Task::where('status_id', 3)->count();
            $currentMonth = Carbon::now()->month;
            $currentYear = Carbon::now()->year;
            
            // Retrieve tickets created in the current month and year with their first responses
            $tickets = Ticket::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->where('ccid',Auth::user()->id)
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
                $averageResponseTime = 0.00;
            }
              $leaveTypes = LeaveType::all();
            
            // Calculate leave counts per type for the logged-in user
            $leaveTypeCounts = [];
            foreach ($leaves as $leave) {
                if (!isset($leaveTypeCounts[$leave->leavetype_id])) {
                    $leaveTypeCounts[$leave->leavetype_id] = 0;
                }
                $leaveTypeCounts[$leave->leavetype_id] += $leave->days; // Assuming days field represents the number of leaves taken
            }
            
            // Prepare data for the view
            $leaveStatus = [];
            foreach ($leaveTypes as $type) {
                $leaveTypeId = $type->id;
                $allowedLeaves = $type->no_of_leave;
                $theme = $type->theme;
                
                $takenLeaves = isset($leaveTypeCounts[$leaveTypeId]) ? $leaveTypeCounts[$leaveTypeId] : 0;
                $percentage = $allowedLeaves > 0 ? ($takenLeaves / $allowedLeaves) * 100 : 0;
                $percentage = number_format($percentage, 2);
                
                // Determine color based on theme
                $colorClass = '';
                if ($theme === 'info') {
                    $colorClass = 'bg-info';
                } elseif ($theme === 'warning') {
                    $colorClass = 'bg-warning';
                } elseif ($theme === 'danger') {
                    $colorClass = 'bg-danger';
                } else {
                    $colorClass = 'bg-primary'; // Default color
                }
                
                $leaveStatus[] = [
                    'type' => $type->leave_type,
                    'allowed' => $allowedLeaves, // Ensure this field is available in the LeaveType model
                    'taken' => $takenLeaves,
                    'percentage' => $percentage,
                    'colorClass' => $colorClass
                ];
            }
            
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
                $shiftDuration = 0.00;
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
            $LeadsProgress  = Leads::where('status', 1)->whereMonth('created_at', $currentMonth)->whereYear('created_at', now()->year)->count();
            
            $Performance = User::select('users.first_name','users.id','users.email','users.profile_img','departments.name as departments_name')
            ->leftjoin('employee_details','employee_details.user_id','users.id')
            ->leftjoin('departments','departments.id','employee_details.department_id')
            ->where('users.type', 4)
            ->where('users.id',$userId)
            ->paginate(10);
            $user_details = User::find($userId);
            $PerformanceCategory = PerformanceCategory::get();
            $PerformanceRating = PerformanceRating::get();
            // $UpcommingFollowups = LeadsFollowup::leftJoin('leads', 'leads.id', '=', 'leads_followups.leads_id')
            // ->select('leads_followups.*')
            // ->whereDate('leads_followups.follow_up_next', Carbon::today())
            // ->orderBy('leads_followups.follow_up_next', 'DESC')
            // ->limit(5)
            // ->get();
               // Get filter dates from the request, or default to today
                $fromDate = $request->input('from_date', Carbon::today()->startOfDay());
                $toDate = $request->input('to_date', Carbon::today()->endOfDay());
            
                // Fetch the follow-ups within the date range
                $UpcommingFollowups = LeadsFollowup::leftJoin('leads', 'leads.id', '=', 'leads_followups.leads_id')
                    ->select('leads_followups.*')
                    ->whereBetween('leads_followups.follow_up_next', [$fromDate, $toDate])
                    ->orderBy('leads_followups.follow_up_next', 'DESC')
                    ->limit(5)
                    ->get();
            $paidOrders = Orders::where('is_payment_recieved',1)->groupBy('id')->count();
            $upcomingEvents = Calendar::leftJoin('users', 'users.id', '=', 'calendars.user_id')
            ->select('calendars.*', 'users.first_name', 'users.profile_img', 'users.last_name')
            ->where('calendars.start', '>', Carbon::today()) // Events starting after today
            ->orWhere('calendars.end', '>', Carbon::today())   // Events ending after today
            ->orderBy('calendars.start', 'ASC') // Order by start date
            ->limit(3) // Limit the results to 5 events
            ->get();
            $calenderEvents = Calendar::whereMonth('start', date('m'))->whereDay('start', date('d'))->get();
                       // Get the first and last date of the previous month
            $firstDayOfPreviousMonth = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
            $lastDayOfPreviousMonth = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');
            
            $bestSaleMan = DB::table('quotes')
                ->join('invoices', 'invoices.Quotesid', '=', 'quotes.id')
                ->join('users', 'users.id', '=', 'quotes.user_id')
                ->where('invoices.is_payment_recieved', 1)
                ->whereBetween('invoices.created_at', [$firstDayOfPreviousMonth, $lastDayOfPreviousMonth])
                ->select('users.id as user_id', 'users.first_name as user_name','users.first_name', DB::raw('COUNT(quotes.id) as quotes_count'))
                ->groupBy('users.id', 'users.first_name')
                ->orderBy('quotes_count', 'DESC')
                ->first();
              //  return $bestSaleMan;
            $previousMonth = date('m', strtotime('-1 month'));
                    $previousYear = date('Y', strtotime('-1 month'));
                    $startDate = date("$previousYear-$previousMonth-01");
                    $endDate = date("Y-m-t", strtotime($startDate));
                
                    $highestRating = 0;
                    $bestEmployee = null;
                            // Determine the previous month's start and end dates

                    // Query to find the employee with the highest goal achievement for the previous month
                    $highestGoalAchiever = Goal::select('users.first_name', 'users.last_name', 'users.id', 'users.email', 'users.profile_img', DB::raw('SUM(goals.archieved_value) as total_archieved_value'))
                                               ->join('users', 'users.id', '=', 'goals.employee_id')
                                               ->whereBetween('goals.date', [$startDate, $endDate])
                                               ->groupBy('users.id', 'users.first_name', 'users.last_name', 'users.email', 'users.profile_img')
                                               ->orderByDesc('total_archieved_value')
                                               ->first();
                

                    
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
                      $EmpDtl = EmployeeDetail::where('user_id',Auth::user()->id)->first();

            $totalSaledInv = Invoice::where('user_id', Auth::user()->id)->where('is_payment_recieved', 1)->count();
            $totalSaledQuotes = Quotes::where('quotes.user_id', Auth::user()->id)->leftjoin('invoices','invoices.Quotesid','quotes.id')->where('invoices.is_payment_recieved', 1)->count();
            $totalOpenTickets = Ticket::where('department_id', $EmpDtl->department_id)->count();
            $totalSaledProducts = $totalSaledInv + $totalSaledQuotes;
            //  $TClient = User::where('type', '2')->where('accountManager', $userId)->count(); //condition only for accounting dissucss and verify via vrun on 3 sept 2024
            $TClient = User::where('type',2)->whereNull('deleted_at')->count();

            $teamLeads = EmployeeDetail::Join('users','employee_details.user_id','=','users.id')->leftjoin('departments','employee_details.department_id','=','departments.id')->select('departments.name','users.first_name','users.profile_img')->where('employee_details.team_lead',1)->get();
            return view('Employee.dashDepartmentType.Sales', compact('teamLeads','totalSaledProducts','TClient','highestGoalAchiever','bestEmployee','bestSaleMan','totalSaledProducts','leaveTypes','leaveStatus','totalOpenTickets','calenderEvents','teamLeads','UserRole','upcomingEvents','paidOrders','UpcommingFollowups','OpenTask','Performance','shiftDurationInSeconds','shiftDuration','totalOvertime','averageResponseTime','totalBreakTime','TProJect','LeadsProgress','OpenTicket','default_currency','PopularProducts','PreviousTotalIncome','TotalIncome','PreviousTotalExpenses','LeadsGenerated','StaProducts','previousMonthAmount','PayExpensesTotal','totalRevenueCurrentMonthPrice','PayExpenses','StaRevenue','StaSales','StaCustomer','previousYearBestSellerEmployee','currentMonthEmpPrice','OpenTicket','OpenTask','totalBreakTime','averageResponseTime','totalSalesCurrentMonthPrice','currentMonthBestSellerEmployee','currentMonthEmpPrice','Attendence','TimeShift','CheckInTime', 'completeEfficiency', 'inProgressEfficiency', 'leaves', 'LeadsWin', 'LeadsLoss', 'totalLeads', 'thisMonthSale', 'pendingDeals', 'kra','totalSale','query','OnLeaves','monthlyData')); 
        }
        
        // for account
        if($AuthRole->department_id == 3)
        {
            $totalTicket = Ticket::count();
            $currentMonthTicket = Ticket::whereMonth('created_at', $currentMonth)->count();
            $todayTicket = Ticket::whereDate('created_at', $currentDate)->count();
            $pendingTicket = Ticket::whereDate('created_at', $currentDate)->count();
            $OpenTicket = Ticket::where('status', 1)->count();
            $TimeSheet  = TimeShift::select('id', 'shift_name', 'StartTime', 'EndTime', 'working_hours')
            ->orderBy('created_at', 'desc')->limit(7)->get();
            
            $assignProject = Task::where('AssignedTo', 'LIKE', '%' . Auth::user()->id . '%')->limit(10)->get();
            $project = Project::select('projects.project_name','projects.deadline','projects.start_date','projects.status_id')->limit(5)->get();
            $completeEfficiency = Goal::where('status',3)->where('employee_id',Auth::user()->id)->sum('archieved_value');            
            $inProgressEfficiency = Goal::where('status',2)->where('employee_id',Auth::user()->id)->sum('goal_value');
            $teamLeads = EmployeeDetail::Join('users','employee_details.user_id','=','users.id')->leftjoin('departments','employee_details.department_id','=','departments.id')->select('departments.name','users.first_name','users.profile_img')->where('employee_details.team_lead',1)->get();
            $leaves = LeaveType::get();     
            $ticketWithoutReply =Ticket::leftJoin('chats', 'tickets.id', '=', 'chats.ticket_id')
            ->whereNull('chats.ticket_id')
            ->whereMonth('tickets.created_at', $currentMonth)
            ->count(); 
            
            $ticketsWithFirstChat = Ticket::leftJoin('chats', 'tickets.id', '=', 'chats.ticket_id')
            ->select(DB::raw('TIMESTAMPDIFF(MINUTE, tickets.created_at, chats.created_at) AS time_diff_sum'))
            ->groupBy('chats.ticket_id')
            ->orderBy('chats.id', 'ASC')
            ->get();
            // return $ticketsWithFirstChat;
            $kra = EmployeeDetail::where('user_id',Auth::user()->id)->select('kra')->first();
            
            $currentMonth = now()->format('m');
            $currentYear = now()->year;
            $previousYear = now()->subYear()->year;
            
            // Fetch all invoices that meet the criteria for the current month
            $currentMonthInvoices = Invoice::leftJoin('quotes', 'quotes.id', 'invoices.Quotesid')
            ->where('invoices.Quotesid', '!=', '0')
            ->where('quotes.user_id',Auth::user()->id)
            ->where('invoices.is_payment_recieved', 1)
            ->whereNull('invoices.deleted_at')
            ->whereMonth('invoices.created_at', $currentMonth)
            ->whereYear('invoices.created_at', $currentYear)
            ->get();
            
            
            $totalSalesCurrentMonth = Orders::leftJoin('quotes', 'quotes.id', 'orders.quotes_id')
            ->leftJoin('invoices', 'invoices.id', 'orders.invoice_id')
            ->whereNull('orders.deleted_at')
            ->where('orders.user_id',Auth::user()->id)
            ->whereMonth('orders.created_at', $currentMonth)
            ->whereYear('orders.created_at', $currentYear)
            ->get();
            
            $totalSalesCurrentMonthPrice = $totalSalesCurrentMonth->sum('total_amt');
            
            $totalClientCount = User::where('type','4')->whereNull('deleted_at')->count();
            
            $totalRevenueCurrentMonth = Invoice::leftJoin('quotes', 'quotes.id', 'invoices.Quotesid')
            ->whereNull('invoices.deleted_at')
            ->whereMonth('invoices.created_at', $currentMonth)
            ->whereYear('invoices.created_at', $currentYear)
            ->get();
            
            $totalRevenueCurrentMonthPrice = $totalRevenueCurrentMonth->sum('final_total_amt');
            
            
            
            $previousYearInvoices = Invoice::leftJoin('quotes', 'quotes.id', 'invoices.Quotesid')
            ->where('invoices.Quotesid', '!=', '0')
            ->where('quotes.user_id',Auth::user()->id)
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
            
            $query = Goal::select('goals.status','goals.date','goals.goal_value','goals.archieved_value')
            ->groupBy('employee_id')
            ->latest('date')->paginate(10);
            $thisMonthSale = Orders::where('is_payment_recieved',1)->whereMonth('created_at', $currentMonth)->sum('total_amt'); 
            $totalSale = Orders::where('is_payment_recieved',1)->sum('total_amt');
            $pendingDeals = Orders::Join('product_news','orders.product_id','product_news.id')
            ->leftjoin('users','orders.user_id','=','users.id')
            ->select('users.first_name','product_news.product_name','orders.total_amt','orders.created_at')->limit(6)->get();
            
            $kra = EmployeeDetail::where('user_id',Auth::user()->id)->select('kra')->first();
            $StaSales = round(Invoice::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)->whereNull('deleted_at')
            ->sum('final_total_amt'));
            $totalSalesCurrentMonth = Orders::leftJoin('quotes', 'quotes.id', 'orders.quotes_id')
            ->leftJoin('invoices', 'invoices.id', 'orders.invoice_id')
            ->whereNull('orders.deleted_at')
            ->where('orders.user_id',Auth::user()->id)
            ->whereMonth('orders.created_at', $currentMonth)
            ->whereYear('orders.created_at', $currentYear)
            ->get();
            
            $totalSalesCurrentMonthPrice = $totalSalesCurrentMonth->sum('total_amt');
            $StaCustomer = User::where('type', 2)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();
            $StaProducts = Invoice::where('is_payment_recieved', 1)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)->whereNull('deleted_at')
            ->groupBy('product_id')
            ->count();
            
            $TClient = User::where('type', 2)->where('status', 1)->count();
            $StaRevenue = round(Invoice::where('is_payment_recieved', 1)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)->whereNull('deleted_at')
            ->sum('final_total_amt'));
            
            
            $totalRevenueCurrentMonth = Invoice::leftJoin('quotes', 'quotes.id', 'invoices.Quotesid')
            ->whereNull('invoices.deleted_at')
            ->where('invoices.user_id',Auth::user()->id)
            ->whereMonth('invoices.created_at', $currentMonth)
            ->whereYear('invoices.created_at', $currentYear)
            ->get();
            
            $totalRevenueCurrentMonthPrice = $totalRevenueCurrentMonth->sum('final_total_amt');
            $PayExpenses = PayRoll::whereMonth('created_at', $currentMonth)
            ->where('emp_Id',Auth::user()->id)
            ->whereYear('created_at', $currentYear)
            ->sum('net_paid');
            
            $PayExpensesTotal = PayRoll::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->sum('net_salary');
            $previousMonthAmount = round(Invoice::where('is_payment_recieved', 1)
            ->whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', $currentYear)->whereNull('deleted_at')
            ->sum('amount'));
            $LeadsGenerated = Leads::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();
            $PreviousTotalIncome = Project::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', $currentYear)
            ->sum('project_value');
            $PreviousTotalExpenses = PayRoll::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', $currentYear)
            ->sum('net_paid');
            $TotalIncome = Project::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->sum('project_value');
            
            
            $default_currency = Currency::where('is_default', 1)->first();
            
            $PopularProducts = ProductNew::leftJoin('product_pricing', function ($join) use ($default_currency) {
                $join->on('product_pricing.product_id', '=', 'product_news.id')
                ->where('product_pricing.currency_id', '=', $default_currency->id); // Condition for default currency
            })
            ->select('product_news.id', 'product_news.product_name', 'product_news.product_image', 'product_pricing.price', 'product_news.product_tag_line')
            ->orderBy('product_news.order_count', 'desc') // Order by order_count to get popular products
            ->orderBy('product_news.created_at', 'desc') // Order by created_at to get latest products
            ->groupBy('product_news.id') // Group by product_news.id to avoid duplicate entries
            ->limit(10) // Limit to 10 products
            ->get();
            $TProJect = Project::whereNotIn('status_id', ['2', '4'])->count();
            $OpenTicket = Ticket::where('status', 1)->count();
            $TTask = Task::whereNotIn('status_id', ['2', '4'])->count();
            $showTTask = Task::count();
            $OpenTask = Task::where('status_id', 1)->count();
            $TasksOverDue = Task::where('status_id', 3)->count();
            $currentMonth = Carbon::now()->month;
            $currentYear = Carbon::now()->year;
            
            // Retrieve tickets created in the current month and year with their first responses
            $tickets = Ticket::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->where('ccid',Auth::user()->id)
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
                $averageResponseTime = 0.00;
            }
            
            
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
                $shiftDuration = "0.00";
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
            $PreviousTotalIncome = Project::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', $currentYear)
            ->sum('project_value');
            $PreviousTotalExpenses = PayRoll::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', $currentYear)
            ->sum('net_paid');
            $TotalIncome = Project::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->sum('project_value');
            $LeadsWin   = Leads::where('status',2)->whereMonth('created_at', $currentMonth)->count();
            $LeadsLoss  = Leads::where('status',3)->whereMonth('created_at', $currentMonth)->count(); 
            $totalLeads  = Leads::whereMonth('created_at', $currentMonth)->count();      
            $LeadsProgress  = Leads::where('status', 1)->whereMonth('created_at', $currentMonth)->whereYear('created_at', now()->year)->count();
            $Performance = User::select('users.first_name','users.id','users.email','users.profile_img','departments.name as departments_name')
            ->leftjoin('employee_details','employee_details.user_id','users.id')
            ->leftjoin('departments','departments.id','employee_details.department_id')
            ->where('users.type', 4)
            ->where('users.id',$userId)
            ->paginate(10);
            // Retrieve leaves for the logged-in user
            $leaves = Leave::where('user_id', $userId)->get();
            
            // Retrieve leave types to get their themes and allowed counts
            $leaveTypes = LeaveType::all();
            
            // Calculate leave counts per type for the logged-in user
            $leaveTypeCounts = [];
            foreach ($leaves as $leave) {
                if (!isset($leaveTypeCounts[$leave->leavetype_id])) {
                    $leaveTypeCounts[$leave->leavetype_id] = 0;
                }
                $leaveTypeCounts[$leave->leavetype_id] += $leave->days; // Assuming days field represents the number of leaves taken
            }
            
            // Prepare data for the view
            $leaveStatus = [];
            foreach ($leaveTypes as $type) {
                $leaveTypeId = $type->id;
                $allowedLeaves = $type->no_of_leave;
                $theme = $type->theme;
                
                $takenLeaves = isset($leaveTypeCounts[$leaveTypeId]) ? $leaveTypeCounts[$leaveTypeId] : 0;
                $percentage = $allowedLeaves > 0 ? ($takenLeaves / $allowedLeaves) * 100 : 0;
                $percentage = number_format($percentage, 2);
                
                // Determine color based on theme
                $colorClass = '';
                if ($theme === 'info') {
                    $colorClass = 'bg-info';
                } elseif ($theme === 'warning') {
                    $colorClass = 'bg-warning';
                } elseif ($theme === 'danger') {
                    $colorClass = 'bg-danger';
                } else {
                    $colorClass = 'bg-primary'; // Default color
                }
                
                $leaveStatus[] = [
                    'type' => $type->leave_type,
                    'allowed' => $allowedLeaves, // Ensure this field is available in the LeaveType model
                    'taken' => $takenLeaves,
                    'percentage' => $percentage,
                    'colorClass' => $colorClass
                ];
            }
            
            $user_details = User::find($userId);
            $PerformanceCategory = PerformanceCategory::get();
            $PerformanceRating = PerformanceRating::get(); //'Performance','user_details','PerformanceCategory','PerformanceRating',
            // PHP logic (adjustments)
            $currentMonth = date('m');
            $currentYear = date('Y');
            
            $currentMonthLeaves = Leave::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();
            
            // Example of chart data calculation
            $monthlyRegistrationCounts = [];
            
            // Initialize arrays to store counts for each month
            $joinedEmployees = array_fill(0, 12, 0);
            $resignedEmployees = array_fill(0, 12, 0);
            
            // Loop through each month to get the data
            for ($month = 1; $month <= 12; $month++) {
                // Count joined employees
                $joinedEmployees[$month - 1] = User::whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $month)
                ->whereIn('status', [1, 2, 3])
                ->count();
                
                // Count resigned employees
                $resignedEmployees[$month - 1] = User::whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $month)
                ->whereIn('status', [4,5])
                ->count();
            }
            
            $TEmp = User::where('type',4)->count();
            $TGenderMale = User::where('gender',1)->count();
            $TGenderFeMale = User::where('gender',2)->count();
            $today = Carbon::today()->format('Y-m-d');
        
            // Count the number of employees on leave today
            $TLeave = Leave::where('apply_for', 1) // Apply for leave
                ->whereDate('start_date', '<=', $today) // Start date is before or on today
                ->whereDate('end_date', '>=', $today) // End date is after or on today
                ->count();
            $Team = User::select('users.profile_img','users.first_name','users.id','users.last_name','users.status')->where('type',4)->limit(5)->get();
            $TimeSheet  = TimeShift::select('id', 'shift_name', 'StartTime', 'EndTime', 'working_hours')
            ->orderBy('created_at', 'desc')->limit(7)->get();
            //return $averageResponseTime;
            $tasks = Task::select('task_name', 'deadline', 'startDate', 'endDate', 'status_id', 'id', 'AssignedTo')
            ->limit(5)
            ->get();
            foreach ($tasks as $task) {
                $assignedToIds = explode(',', $task->AssignedTo);
                $userNames = User::whereIn('id', $assignedToIds)->pluck('id')->toArray();
                $task->assigned_user_id = implode(', ', $userNames);
            }
            $PreviousTotalIncome = Project::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', $currentYear)
            ->sum('project_value');
            $PreviousTotalExpenses = PayRoll::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', $currentYear)
            ->sum('net_paid');
            $TotalIncome = Project::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->sum('project_value');
            
            
            $default_currency = Currency::where('is_default', 1)->first();
            
            $PopularProducts = ProductNew::leftJoin('product_pricing', function ($join) use ($default_currency) {
                $join->on('product_pricing.product_id', '=', 'product_news.id')
                ->where('product_pricing.currency_id', '=', $default_currency->id); // Condition for default currency
            })
            ->select('product_news.id', 'product_news.product_name', 'product_news.product_image', 'product_pricing.price', 'product_news.product_tag_line')
            ->orderBy('product_news.order_count', 'desc') // Order by order_count to get popular products
            ->orderBy('product_news.created_at', 'desc') // Order by created_at to get latest products
            ->groupBy('product_news.id') // Group by product_news.id to avoid duplicate entries
            ->limit(10) // Limit to 10 products
            ->get();
            $unresolvedTicketCount = \DB::table('tickets')
            ->leftJoin('chats', 'tickets.id', '=', 'chats.ticket_id')
            ->select('tickets.id')
            ->whereNull('chats.ticket_id')
            ->distinct()
            ->count('tickets.id');
            $upcomingEvents = Calendar::leftJoin('users', 'users.id', '=', 'calendars.user_id')
            ->select('calendars.*', 'users.first_name', 'users.profile_img', 'users.last_name')
            ->where('calendars.start', '>', Carbon::today()) // Events starting after today
            ->orWhere('calendars.end', '>', Carbon::today())   // Events ending after today
            ->orderBy('calendars.start', 'ASC') // Order by start date
            ->limit(3) // Limit the results to 5 events
            ->get();
            
            $calenderEvents = Calendar::whereMonth('start', date('m'))->whereDay('start', date('d'))->get();

             
            $kra = EmployeeDetail::where('user_id',Auth::user()->id)->select('kra')->first();
            $StaSales = round(Invoice::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)->whereNull('deleted_at')
            ->sum('final_total_amt'));
            $totalSalesCurrentMonth = Orders::leftJoin('quotes', 'quotes.id', 'orders.quotes_id')
            ->leftJoin('invoices', 'invoices.id', 'orders.invoice_id')
            ->whereNull('orders.deleted_at')
            ->where('orders.user_id',Auth::user()->id)
            ->where('invoices.is_payment_recieved',1)
            ->whereMonth('orders.created_at', $currentMonth)
            ->whereYear('orders.created_at', $currentYear)
            ->get();
            
            $totalSalesCurrentMonthPrice = $totalSalesCurrentMonth->sum('total_amt');
            $StaCustomer = User::where('type', 2)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();
            $StaProducts = Invoice::where('is_payment_recieved', 1)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)->whereNull('deleted_at')
            ->groupBy('product_id')
            ->count();

            $EmpDtl = EmployeeDetail::where('user_id',Auth::user()->id)->first();

            $totalSaledInv = Invoice::where('user_id', Auth::user()->id)->where('is_payment_recieved', 1)->count();
            $totalSaledQuotes = Quotes::where('quotes.user_id', Auth::user()->id)->leftjoin('invoices','invoices.Quotesid','quotes.id')->where('invoices.is_payment_recieved', 1)->count();
            $totalOpenTickets = Ticket::where('department_id', $EmpDtl->department_id)->count();
            $totalSaledProducts = $totalSaledInv + $totalSaledQuotes;
            $StaRevenue = round(Invoice::where('is_payment_recieved', 1)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)->whereNull('deleted_at')
            ->sum('final_total_amt'));
             $paidOrders = Orders::where('is_payment_recieved',1)->groupBy('id')->count();
            $upcomingEvents = Calendar::leftJoin('users', 'users.id', '=', 'calendars.user_id')
            ->select('calendars.*', 'users.first_name', 'users.profile_img', 'users.last_name')
            ->where('calendars.start', '>', Carbon::today()) // Events starting after today
            ->orWhere('calendars.end', '>', Carbon::today())   // Events ending after today
            ->orderBy('calendars.start', 'ASC') // Order by start date
            ->limit(3) // Limit the results to 5 events
            ->get();
            $calenderEvents = Calendar::whereMonth('start', date('m'))->whereDay('start', date('d'))->get();
                       // Get the first and last date of the previous month
            $firstDayOfPreviousMonth = Carbon::now()->subMonth()->startOfMonth()->format('Y-m-d');
            $lastDayOfPreviousMonth = Carbon::now()->subMonth()->endOfMonth()->format('Y-m-d');
            $EmpDtl = EmployeeDetail::where('user_id',Auth::user()->id)->first();
            // $TClient = User::where('type', 2)->where('status', 1)->where('user_id', Auth::user()->id)->count();
            $totalSaledInv = Invoice::where('user_id', Auth::user()->id)->where('is_payment_recieved', 1)->count();
            $totalSaledQuotes = Quotes::where('quotes.user_id', Auth::user()->id)->leftjoin('invoices','invoices.Quotesid','quotes.id')->where('invoices.is_payment_recieved', 1)->count();
            $totalOpenTickets = Ticket::where('department_id', $EmpDtl->department_id)->count();
            $totalSaledProducts = $totalSaledInv + $totalSaledQuotes;
           $authId = Auth::user()->id;
            $TClient = User::where('type', '2')->where('user_id', $authId)->orWhere('accountmanager', $authId)->get();
            $TClient = count($TClient);
            $tCust = User::where('type', '2')->where('user_id', $authId)->orWhere('accountmanager', $authId)->count();
                        // $tCust = User::where('type',2)->where('accountManager',Auth::user()->id)->count();

            return view('Employee.dashDepartmentType.Accounting', compact('leaveStatus','totalSaledProducts','totalOpenTickets','totalSalesCurrentMonth','totalOpenTickets','totalSaledProducts','tCust','paidOrders','UserRole','bestEmployee','highestGoalAchiever','upcomingEvents','calenderEvents','unresolvedTicketCount','TotalIncome','tasks','TEmp','Team','TGenderFeMale','TGenderMale','TLeave','joinedEmployees','resignedEmployees','Performance','user_details','PerformanceCategory','PerformanceRating','AuthRole','previousYearBestSellerEmployee','PreviousTotalIncome','LeadsProgress','LeadsWin','LeadsLoss','totalLeads','PreviousTotalExpenses','StaSales','TClient','PayExpenses','PayExpensesTotal','previousMonthAmount','totalRevenueCurrentMonthPrice','LeadsGenerated','default_currency','StaCustomer','StaProducts','StaRevenue','totalSalesCurrentMonthPrice','totalOvertime','shiftDuration','currentMonthEmpPrice','OpenTicket','OpenTask','totalBreakTime','averageResponseTime','totalTicket','Attendence','TimeShift','currentMonthTicket','todayTicket','pendingTicket','OpenTicket','TimeSheet','assignProject','completeEfficiency','inProgressEfficiency','teamLeads','leaves','ticketWithoutReply','ticketsWithFirstChat','averageResponseTime','kra','CheckInTime','project','totalBreakTime')); 
        }
        
        //for HR
        if($AuthRole->department_id == 4)
        {
            $TEmp = User::where('type',4)->count();
            $TGenderMale = User::where('gender',1)->count();
            $TGenderFeMale = User::where('gender',2)->count();
            // Get today's date
            $today = Carbon::today()->format('Y-m-d');
        
            // Count the number of employees on leave today
            $TLeave = Leave::where('apply_for', 1) // Apply for leave
                ->whereDate('start_date', '<=', $today) // Start date is before or on today
                ->whereDate('end_date', '>=', $today) // End date is after or on today
                ->count();

            
            $Team = User::leftJoin('employee_details', 'employee_details.user_id', '=', 'users.id')
            ->leftJoin('jobroles', 'employee_details.jobrole_id', '=', 'jobroles.id')
            ->where('employee_details.working_type_id', 2)
            ->where('users.type', 4)
            ->select('users.profile_img','users.id','jobroles.name as jobrole', 'users.first_name', 'users.last_name','users.id', 'users.status')
            ->orderBy('users.id','desc')
            ->limit(5)
            ->get();
            
            
            $TimeSheet  = TimeSheet::select('time_sheets.id','time_sheets.emp_id', 'tasks.task_name as taskname','time_sheets.start_time', 'time_sheets.end_time','time_sheets.total_hours')
            ->leftjoin('tasks','time_sheets.task_id','tasks.id')->orderBy('time_sheets.created_at', 'desc')->limit(7)->get();
            
            $assignProject = Task::where('AssignedTo', 'LIKE', '%' . Auth::user()->id . '%')->limit(10)->get();
            $project = Project::select('projects.project_name','projects.deadline','projects.start_date','projects.status_id')->limit(5)->get();
            $completeEfficiency = Goal::where('status',3)->where('employee_id',Auth::user()->id)->sum('archieved_value');            
            $inProgressEfficiency = Goal::where('status',2)->where('employee_id',Auth::user()->id)->sum('goal_value');
            $teamLeads = EmployeeDetail::
            leftjoin('users','employee_details.user_id','=','users.id')
            ->leftJoin('jobroles', 'employee_details.jobrole_id', '=', 'jobroles.id')
            ->leftjoin('departments','employee_details.department_id','=','departments.id')
            ->select('departments.name','users.first_name','users.last_name','users.id','users.profile_img','jobroles.name as jobrole')
            ->where('employee_details.team_lead',1)->get();
            
            $leaves = LeaveType::get();    
            $ticketWithoutReply =Ticket::leftJoin('chats', 'tickets.id', '=', 'chats.ticket_id')
            ->whereNull('chats.ticket_id')
            ->whereMonth('tickets.created_at', $currentMonth)
            ->count(); 
            
            $ticketsWithFirstChat = Ticket::leftJoin('chats', 'tickets.id', '=', 'chats.ticket_id')
            ->select(DB::raw('SUM(TIMESTAMPDIFF(MINUTE, tickets.created_at, chats.created_at)) AS time_diff_sum'))
            ->groupBy('chats.ticket_id')
            ->orderBy('chats.created_at', 'asc');
            // return $ticketsWithFirstChat;
            $kra = EmployeeDetail::where('user_id',Auth::user()->id)->select('kra')->first();
            
            $currentMonth = now()->format('m');
            $currentYear = now()->year;
            $previousYear = now()->subYear()->year;
            
            // Fetch all invoices that meet the criteria for the current month
            $currentMonthInvoices = Invoice::leftJoin('quotes', 'quotes.id', 'invoices.Quotesid')
            ->where('invoices.Quotesid', '!=', '0')
            ->where('quotes.user_id',Auth::user()->id)
            ->where('invoices.is_payment_recieved', 1)
            ->whereNull('invoices.deleted_at')
            ->whereMonth('invoices.created_at', $currentMonth)
            ->whereYear('invoices.created_at', $currentYear)
            ->get();
            
            
            $totalSalesCurrentMonth = Orders::leftJoin('quotes', 'quotes.id', 'orders.quotes_id')
            ->leftJoin('invoices', 'invoices.id', 'orders.invoice_id')
            ->whereNull('orders.deleted_at')
            ->where('orders.user_id',Auth::user()->id)
            ->whereMonth('orders.created_at', $currentMonth)
            ->whereYear('orders.created_at', $currentYear)
            ->get();
            
            $totalSalesCurrentMonthPrice = (float) $totalSalesCurrentMonth->sum('total_amt');
            $totalClientCount = User::where('type','4')->whereNull('deleted_at')->count();
                             $totalSalesCurrentMonth = Orders::leftJoin('quotes', 'quotes.id', 'orders.quotes_id')
                        ->leftJoin('invoices', 'invoices.id', 'orders.invoice_id')
                        ->whereNull('orders.deleted_at')
                        ->where('orders.user_id', Auth::user()->id)
                        ->whereMonth('orders.created_at', $currentMonth)
                        ->whereYear('orders.created_at', $currentYear)
                        ->get();
                    
                    $totalSalesCurrentMonthPrice = (float) $totalSalesCurrentMonth->sum(function($order) {
                        return is_numeric($order->total_amt) ? (float) $order->total_amt : 0;
                    });
                    
                    $totalClientCount = User::where('type', '4')->whereNull('deleted_at')->count();
                    
                    $totalRevenueCurrentMonth = Invoice::leftJoin('quotes', 'quotes.id', 'invoices.Quotesid')
                        ->whereNull('invoices.deleted_at')
                        ->whereMonth('invoices.created_at', $currentMonth)
                        ->whereYear('invoices.created_at', $currentYear)
                        ->get();
                    
                    $totalRevenueCurrentMonthPrice = (float) $totalRevenueCurrentMonth->sum(function($invoice) {
                        return is_numeric($invoice->final_total_amt) ? (float) $invoice->final_total_amt : 0;
                    });
                    
                                
                                
            
            
            $previousYearInvoices = Invoice::leftJoin('quotes', 'quotes.id', 'invoices.Quotesid')
            ->where('invoices.Quotesid', '!=', '0')
            ->where('quotes.user_id',Auth::user()->id)
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
            
            $query = Goal::select('goals.status','goals.date','goals.goal_value','goals.archieved_value')
            ->groupBy('employee_id')
            ->latest('date')->paginate(10);
            $thisMonthSale = Orders::where('is_payment_recieved',1)->whereMonth('created_at', $currentMonth)->sum('total_amt'); 
            $totalSale = Orders::where('is_payment_recieved',1)->sum('total_amt');
            $pendingDeals = Orders::Join('product_news','orders.product_id','product_news.id')
            ->leftjoin('users','orders.user_id','=','users.id')
            ->select('users.first_name','product_news.product_name','orders.total_amt','orders.created_at')->limit(6)->get();
            
            $kra = EmployeeDetail::where('user_id',Auth::user()->id)->select('kra')->first();
            $StaSales = round(Invoice::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)->whereNull('deleted_at')
            ->sum('final_total_amt'));
            $totalSalesCurrentMonth = Orders::leftJoin('quotes', 'quotes.id', 'orders.quotes_id')
            ->leftJoin('invoices', 'invoices.id', 'orders.invoice_id')
            ->whereNull('orders.deleted_at')
            ->where('orders.user_id',Auth::user()->id)
            ->whereMonth('orders.created_at', $currentMonth)
            ->whereYear('orders.created_at', $currentYear)
            ->get();
            
            $totalSalesCurrentMonthPrice = $totalSalesCurrentMonth->sum('total_amt');
            $StaCustomer = User::where('type', 2)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();
            $StaProducts = Invoice::where('is_payment_recieved', 1)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)->whereNull('deleted_at')
            ->groupBy('product_id')
            ->count();
            
            $TClient = User::where('type', 2)->where('status', 1)->count();
            $StaRevenue = round(Invoice::where('is_payment_recieved', 1)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)->whereNull('deleted_at')
            ->sum('final_total_amt'));
            
            
            $totalRevenueCurrentMonth = Invoice::leftJoin('quotes', 'quotes.id', 'invoices.Quotesid')
            ->whereNull('invoices.deleted_at')
            ->where('invoices.user_id',Auth::user()->id)
            ->whereMonth('invoices.created_at', $currentMonth)
            ->whereYear('invoices.created_at', $currentYear)
            ->get();
            
            $totalRevenueCurrentMonthPrice = $totalRevenueCurrentMonth->sum('final_total_amt');
          
        
            
            $PayExpenses = PayRoll::whereMonth('created_at', $currentMonth)
            ->where('emp_Id',Auth::user()->id)
            ->whereYear('created_at', $currentYear)
            ->sum('net_paid');
            
            $PayExpensesTotal = PayRoll::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->sum('net_salary');
            $previousMonthAmount = round(Invoice::where('is_payment_recieved', 1)
            ->whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', $currentYear)->whereNull('deleted_at')
            ->sum('amount'));
            $LeadsGenerated = Leads::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();
            $PreviousTotalIncome = Project::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', $currentYear)
            ->sum('project_value');
            $PreviousTotalExpenses = PayRoll::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', $currentYear)
            ->sum('net_paid');
            $TotalIncome = Project::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->sum('project_value');
            
            
            $default_currency = Currency::where('is_default', 1)->first();
            
            $PopularProducts = ProductNew::leftJoin('product_pricing', function ($join) use ($default_currency) {
                $join->on('product_pricing.product_id', '=', 'product_news.id')
                ->where('product_pricing.currency_id', '=', $default_currency->id); // Condition for default currency
            })
            ->select('product_news.id', 'product_news.product_name', 'product_news.product_image', 'product_pricing.price', 'product_news.product_tag_line')
            ->orderBy('product_news.order_count', 'desc') // Order by order_count to get popular products
            ->orderBy('product_news.created_at', 'desc') // Order by created_at to get latest products
            ->groupBy('product_news.id') // Group by product_news.id to avoid duplicate entries
            ->limit(10) // Limit to 10 products
            ->get();
            $TProJect = Project::whereNotIn('status_id', ['2', '4'])->count();
            $OpenTicket = Ticket::where('status', 1)->count();
            $TTask = Task::whereNotIn('status_id', ['2', '4'])->count();
            $showTTask = Task::count();
            $OpenTask = Task::where('status_id', 1)->count();
            $TasksOverDue = Task::where('status_id', 3)->count();
            $currentMonth = Carbon::now()->month;
            $currentYear = Carbon::now()->year;
            
            // Retrieve tickets created in the current month and year with their first responses
            $tickets = Ticket::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->where('ccid', Auth::user()->id)
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
                $averageResponseTime = '0.00';
            }
            
            
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
                $shiftDuration = "0.00";
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
            $LeadsProgress  = Leads::where('status', 1)->whereMonth('created_at', $currentMonth)->whereYear('created_at', now()->year)->count();
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
            
            if($RoleAccess[array_search('Task', array_column($RoleAccess, 'per_name'))]['view'] == 1)
            {
                // Fetch tasks with limited fields
                $tasks = Task::select('task_name', 'deadline', 'startDate', 'endDate', 'status_id', 'id', 'AssignedTo')
                ->limit(5)
                ->get();
            }else{
                $authId = Auth::id();
                $tasks = Task::select('task_name', 'deadline', 'startDate', 'endDate', 'status_id', 'id', 'AssignedTo')
                ->where('AssignedTo', 'LIKE', '%' . $authId . '%')
                ->limit(5)
                ->get();
            }
            // Iterate over tasks to get user names for AssignedTo field
            
            foreach ($tasks as $task) {
                $assignedToIds = explode(',', $task->AssignedTo);
                $userNames = User::whereIn('id', $assignedToIds)->pluck('id')->toArray();
                $task->assigned_user_id = implode(', ', $userNames);
            }
            // PHP logic (adjustments)
            $currentMonth = date('m');
            $currentYear = date('Y');
            
            $currentMonthLeaves = Leave::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();
            
            // Example of chart data calculation
            $monthlyRegistrationCounts = [];
            
            // Initialize arrays to store counts for each month
            $joinedEmployees = array_fill(0, 12, 0);
            $resignedEmployees = array_fill(0, 12, 0);
            
            // Loop through each month to get the data
            for ($month = 1; $month <= 12; $month++) {
                // Count joined employees
                $joinedEmployees[$month - 1] = User::whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $month)
                ->whereIn('status', [1, 2, 3])
                ->count();
                
                // Count resigned employees
                $resignedEmployees[$month - 1] = User::whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $month)
                ->whereIn('status', [4,5])
                ->count();
            }
            $userId = Auth::id();
            
            // Retrieve leaves for the logged-in user
            $leaves = Leave::where('user_id', $userId)->get();
            
            // Retrieve leave types to get their themes and allowed counts
            $leaveTypes = LeaveType::all();
            
            // Calculate leave counts per type for the logged-in user
            $leaveTypeCounts = [];
            foreach ($leaves as $leave) {
                if (!isset($leaveTypeCounts[$leave->leavetype_id])) {
                    $leaveTypeCounts[$leave->leavetype_id] = 0;
                }
                $leaveTypeCounts[$leave->leavetype_id] += $leave->days; // Assuming days field represents the number of leaves taken
            }
            
            // Prepare data for the view
            $leaveStatus = [];
            foreach ($leaveTypes as $type) {
                $leaveTypeId = $type->id;
                $allowedLeaves = $type->no_of_leave;
                $theme = $type->theme;
                
                $takenLeaves = isset($leaveTypeCounts[$leaveTypeId]) ? $leaveTypeCounts[$leaveTypeId] : 0;
                $percentage = $allowedLeaves > 0 ? ($takenLeaves / $allowedLeaves) * 100 : 0;
                $percentage = number_format($percentage, 2);
                
                // Determine color based on theme
                $colorClass = '';
                if ($theme === 'info') {
                    $colorClass = 'bg-info';
                } elseif ($theme === 'warning') {
                    $colorClass = 'bg-warning';
                } elseif ($theme === 'danger') {
                    $colorClass = 'bg-danger';
                } else {
                    $colorClass = 'bg-primary'; // Default color
                }
                
                $leaveStatus[] = [
                    'type' => $type->leave_type,
                    'allowed' => $allowedLeaves, // Ensure this field is available in the LeaveType model
                    'taken' => $takenLeaves,
                    'percentage' => $percentage,
                    'colorClass' => $colorClass
                ];
            }
            
                 $fromDate = request()->input('fromDate', null);
                $toDate = request()->input('toDate', null);
            $Performance = User::select('users.first_name','users.id','users.email','users.profile_img','departments.name as departments_name')
            ->leftjoin('employee_details','employee_details.user_id','users.id')
            ->leftjoin('departments','departments.id','employee_details.department_id')
            ->where('users.type', 4)
            ->where('users.id',$userId)
            ->paginate(10);
            $user_details = User::find($userId);
            $PerformanceCategory = PerformanceCategory::get();
            $PerformanceRating = PerformanceRating::get();
            $UpcommingFollowups = LeadsFollowup::leftJoin('leads', 'leads.id', '=', 'leads_followups.leads_id')
            ->select('leads_followups.*')
            ->whereDate('leads_followups.follow_up_next', Carbon::today())
            ->orderBy('leads_followups.follow_up_next', 'DESC')
            ->limit(5)
            ->get();
                $year = $request->year;
                $month = $request->month;
                
                $requestedLeaves = Leave::select(
                    'users.first_name', 
                    'users.profile_img', 
                    'users.email', 
                    'users.id as usersids', 
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
                ->leftJoin('leave_accesses', 'leave_accesses.leave_id', '=', 'leaves.id')
                ->whereMonth('leaves.date', date('m'))
                ->whereYear('leaves.date', date('Y'))
                 ->where('leave_accesses.toGo', 2)
                 ->whereNull('leaves.deleted_at')
                 ->where('leaves.user_id', '!=', Auth::id())
                ->where('leave_accesses.approved_by', '!=', Auth::id())
                ->when($fromDate && $toDate, function ($query) use ($fromDate, $toDate) {
                    $query->whereBetween('leaves.date', [$fromDate, $toDate]);
                })
                ->orderBy('leaves.id', 'desc')
                ->groupBy('leaves.id')
                ->limit(3) // Limit the results to 3 rows
                ->get();

            $upcomingEvents = Calendar::leftJoin('users', 'users.id', '=', 'calendars.user_id')
            ->select('calendars.*', 'users.first_name', 'users.profile_img', 'users.last_name')
            ->where('calendars.start', '>', Carbon::today()) // Events starting after today
            ->orWhere('calendars.end', '>', Carbon::today())   // Events ending after today
            ->orderBy('calendars.start', 'ASC') // Order by start date
            ->limit(3) // Limit the results to 5 events
            ->get();
            $calenderEvents = Calendar::whereMonth('start', date('m'))->whereDay('start', date('d'))->get();
            $LeaveType = LeaveType::all();

            return view('Employee.dashDepartmentType.HR',compact('previousYearBestSellerEmployee','upcomingEvents','LeaveType','highestGoalAchiever','bestEmployee','calenderEvents','UserRole','PayExpenses','requestedLeaves','UpcommingFollowups','resignedEmployees','joinedEmployees','currentMonthEmpPrice','Performance','currentMonthLeaves','leaveStatus','currentMonth','monthlyRegistrationCounts','shiftDuration','OpenTicket','totalOvertime','TimeSheet','Attendence','TimeShift','assignProject','CheckInTime','completeEfficiency','inProgressEfficiency','teamLeads','leaves','ticketWithoutReply','ticketsWithFirstChat','kra','project','TEmp','OpenTask','Team','averageResponseTime','TLeave','TGenderMale','totalBreakTime','TGenderFeMale','tasks')); 
        }
        //for Web Development
        if($AuthRole->department_id == 5 )
        {
            $monthlyData = Orders::select(DB::raw('MONTH(created_at) as month'), DB::raw('SUM(amount) as total'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->get();
            $teamLeads = EmployeeDetail::Join('users','employee_details.user_id','=','users.id')->leftjoin('departments','employee_details.department_id','=','departments.id')->select('departments.name','users.first_name','users.profile_img')->where('employee_details.team_lead',1)->limit(10)->get();
            $completeEfficiency = Goal::where('status',3)->where('employee_id',Auth::user()->id)->sum('archieved_value');      
            $inProgressEfficiency = Goal::where('status',2)->where('employee_id',Auth::user()->id)->sum('goal_value');
            $leaves = LeaveType::select('leave_types.id','leave_types.leave_type','leave_types.no_of_leave','leave_types.theme')->get(); 
            $LeadsWin   = Leads::where('status',2)->whereMonth('created_at', $currentMonth)->count();
            $LeadsLoss  = Leads::where('status',3)->whereMonth('created_at', $currentMonth)->count(); 
            $totalLeads  = Leads::whereMonth('created_at', $currentMonth)->count(); 
            $project = Project::select('projects.project_name', 'projects.deadline', 'projects.start_date', 'projects.status_id')
            ->where(function ($query) {
                $query->where('team_id', Auth::user()->id)
                ->orWhereRaw("FIND_IN_SET(?, team_id)", Auth::user()->id);
            })
            ->limit(5)
            ->get();
            
            $tasks = Task::select('task_name', 'deadline', 'startDate', 'status_id')
            ->where(function ($query) {
                $query->where('AssignedTo', Auth::user()->id)
                ->orWhereRaw("FIND_IN_SET(?, AssignedTo)", Auth::user()->id);
            })
            ->limit(5)
            ->get();
            
            $OnLeaves = Leave::select('users.first_name', 'users.profile_img', 'leaves.status', 'departments.name as dptname')
            ->where('leaves.date', date('Y-m-d'))
            ->leftJoin('users', 'leaves.emp_id', '=', 'users.id')
            ->leftJoin('employee_details as ed1', 'leaves.emp_id', '=', 'ed1.user_id')
            ->leftJoin('departments', 'ed1.department_id', '=', 'departments.id')
            ->limit(7)
            ->get();
            
            $query = Goal::select('goals.status','goals.date','goals.goal_value','goals.archieved_value')
            ->groupBy('employee_id')
            ->latest('date')->paginate(10);
            $thisMonthSale = Orders::where('is_payment_recieved',1)->whereMonth('created_at', $currentMonth)->sum('total_amt'); 
            $totalSale = Orders::where('is_payment_recieved',1)->sum('total_amt');
            $pendingDeals = Orders::Join('product_news','orders.product_id','product_news.id')
            ->leftjoin('users','orders.user_id','=','users.id')
            ->select('users.first_name','product_news.product_name','orders.total_amt','orders.created_at')->limit(6)->get();
            $currentMonth = now()->format('m');
            $currentYear = now()->year;
            
            $kra = EmployeeDetail::where('user_id',Auth::user()->id)->select('kra')->first();
            
            $currentMonth = now()->format('m');
            $currentYear = now()->year;
            $previousYear = now()->subYear()->year;
            
            // Fetch all invoices that meet the criteria for the current month
            $currentMonthInvoices = Invoice::leftJoin('quotes', 'quotes.id', 'invoices.Quotesid')
            ->where('invoices.Quotesid', '!=', '0')
            ->where('quotes.user_id',Auth::user()->id)
            ->where('invoices.is_payment_recieved', 1)
            ->whereNull('invoices.deleted_at')
            ->whereMonth('invoices.created_at', $currentMonth)
            ->whereYear('invoices.created_at', $currentYear)
            ->get();
            
            
            $totalSalesCurrentMonth = Orders::leftJoin('quotes', 'quotes.id', 'orders.quotes_id')
            ->leftJoin('invoices', 'invoices.id', 'orders.invoice_id')
            ->whereNull('orders.deleted_at')
            ->where('orders.user_id',Auth::user()->id)
            ->whereMonth('orders.created_at', $currentMonth)
            ->whereYear('orders.created_at', $currentYear)
            ->get();
            $totalSalesCurrentMonthPrice = $totalSalesCurrentMonth->sum('total_amt');
            $totalClientCount = User::where('type','4')->whereNull('deleted_at')->count();
            $totalRevenueCurrentMonth = Invoice::leftJoin('quotes', 'quotes.id', 'invoices.Quotesid')
            ->whereNull('invoices.deleted_at')
            ->whereMonth('invoices.created_at', $currentMonth)
            ->whereYear('invoices.created_at', $currentYear)
            ->get();
            $totalRevenueCurrentMonthPrice = $totalRevenueCurrentMonth->sum('final_total_amt');
            $previousYearInvoices = Invoice::leftJoin('quotes', 'quotes.id', 'invoices.Quotesid')
            ->where('invoices.Quotesid', '!=', '0')
            ->where('quotes.user_id',Auth::user()->id)
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
            
            $query = Goal::select('goals.status','goals.date','goals.goal_value','goals.archieved_value')
            ->groupBy('employee_id')
            ->latest('date')->paginate(10);
            $thisMonthSale = Orders::where('is_payment_recieved',1)->whereMonth('created_at', $currentMonth)->sum('total_amt'); 
            $totalSale = Orders::where('is_payment_recieved',1)->sum('total_amt');
            $pendingDeals = Orders::Join('product_news','orders.product_id','product_news.id')
            ->leftjoin('users','orders.user_id','=','users.id')
            ->select('users.first_name','product_news.product_name','orders.total_amt','orders.created_at')->limit(6)->get();
            
            $kra = EmployeeDetail::where('user_id',Auth::user()->id)->select('kra')->first();
            $StaSales = round(Invoice::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)->whereNull('deleted_at')
            ->sum('final_total_amt'));
            $totalSalesCurrentMonth = Orders::leftJoin('quotes', 'quotes.id', 'orders.quotes_id')
            ->leftJoin('invoices', 'invoices.id', 'orders.invoice_id')
            ->whereNull('orders.deleted_at')
            ->where('orders.user_id',Auth::user()->id)
            ->whereMonth('orders.created_at', $currentMonth)
            ->whereYear('orders.created_at', $currentYear)
            ->get();
            
            $totalSalesCurrentMonthPrice = $totalSalesCurrentMonth->sum('total_amt');
            $StaCustomer = User::where('type', 2)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();
            $StaProducts = Invoice::where('is_payment_recieved', 1)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)->whereNull('deleted_at')
            ->groupBy('product_id')
            ->count();
            
            $TClient = User::where('type', 2)->where('status', 1)->count();
            $StaRevenue = round(Invoice::where('is_payment_recieved', 1)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)->whereNull('deleted_at')
            ->sum('final_total_amt'));
            
            $totalRevenueCurrentMonth = Invoice::leftJoin('quotes', 'quotes.id', 'invoices.Quotesid')
            ->whereNull('invoices.deleted_at')
            ->where('invoices.user_id',Auth::user()->id)
            ->whereMonth('invoices.created_at', $currentMonth)
            ->whereYear('invoices.created_at', $currentYear)
            ->get();
            
            $totalRevenueCurrentMonthPrice = $totalRevenueCurrentMonth->sum('final_total_amt');
            $PayExpenses = PayRoll::whereMonth('created_at', $currentMonth)
            ->where('emp_Id',Auth::user()->id)
            ->whereYear('created_at', $currentYear)
            ->sum('net_paid');
            
            $PayExpensesTotal = PayRoll::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->sum('net_salary');
            $previousMonthAmount = round(Invoice::where('is_payment_recieved', 1)
            ->whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', $currentYear)->whereNull('deleted_at')
            ->sum('amount'));
            $LeadsGenerated = Leads::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();
            $PreviousTotalIncome = Project::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', $currentYear)
            ->sum('project_value');
            $PreviousTotalExpenses = PayRoll::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', $currentYear)
            ->sum('net_paid');
            $TotalIncome = Project::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->sum('project_value');
            
            
            $default_currency = Currency::where('is_default', 1)->first();
            
            $PopularProducts = ProductNew::leftJoin('product_pricing', function ($join) use ($default_currency) {
                $join->on('product_pricing.product_id', '=', 'product_news.id')
                ->where('product_pricing.currency_id', '=', $default_currency->id); // Condition for default currency
            })
            ->select('product_news.id', 'product_news.product_name', 'product_news.product_image', 'product_pricing.price', 'product_news.product_tag_line')
            ->orderBy('product_news.order_count', 'desc') // Order by order_count to get popular products
            ->orderBy('product_news.created_at', 'desc') // Order by created_at to get latest products
            ->groupBy('product_news.id') // Group by product_news.id to avoid duplicate entries
            ->limit(10) // Limit to 10 products
            ->get();
            $TProJect = Project::whereNotIn('status_id', ['2', '4'])->count();
            $OpenTicket = Ticket::where('status', 1)->count();
            $TTask = Task::whereNotIn('status_id', ['2', '4'])->count();
            $showTTask = Task::count();
            $OpenTask = Task::where('status_id', 1)->count();
            $TasksOverDue = Task::where('status_id', 3)->count();
            $currentMonth = Carbon::now()->month;
            $currentYear = Carbon::now()->year;
            
            $tickets = Ticket::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->where('ccid', Auth::user()->id)
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
                $averageResponseTime = gmdate('H:i', $averageResponseTimeInSeconds);
            } else {
                $averageResponseTime = '00:00';
            }
            
            
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
                $shiftDuration = "00.00";
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
            $LeadsProgress  = Leads::where('status', 1)->whereMonth('created_at', $currentMonth)->whereYear('created_at', now()->year)->count();
            //  return $shiftDuration;  // return $averageResponseTime;
            
            $Performance = User::select('users.first_name','users.id','users.email','users.profile_img','departments.name as departments_name')
            ->leftjoin('employee_details','employee_details.user_id','users.id')
            ->leftjoin('departments','departments.id','employee_details.department_id')
            ->where('users.type', 4)
            ->where('users.id',$userId)
            ->paginate(10);
            $user_details = User::find($userId);
            $PerformanceCategory = PerformanceCategory::get();
            $PerformanceRating = PerformanceRating::get(); 
            $currentMonth = date('m');
            $currentYear = date('Y');
            
            $currentMonthLeaves = Leave::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();
            
            // Example of chart data calculation
            $monthlyRegistrationCounts = [];
            
            // Initialize arrays to store counts for each month
            $joinedEmployees = array_fill(0, 12, 0);
            $resignedEmployees = array_fill(0, 12, 0);
            
            // Loop through each month to get the data
            for ($month = 1; $month <= 12; $month++) {
                // Count joined employees
                $joinedEmployees[$month - 1] = User::whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $month)
                ->whereIn('status', [1, 2, 3])
                ->count();
                
                // Count resigned employees
                $resignedEmployees[$month - 1] = User::whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $month)
                ->whereIn('status', [4,5])
                ->count();
            }
            
            $TEmp = User::where('type',4)->count();
            $TGenderMale = User::where('gender',1)->count();
            $TGenderFeMale = User::where('gender',2)->count();
           $today = Carbon::today()->format('Y-m-d');
        
            // Count the number of employees on leave today
            $TLeave = Leave::where('apply_for', 1) // Apply for leave
                ->whereDate('start_date', '<=', $today) // Start date is before or on today
                ->whereDate('end_date', '>=', $today) // End date is after or on today
                ->count();
            $Team = User::select('users.profile_img','users.first_name','users.last_name','users.status','users.id')->where('type',4)->limit(5)->get();
            $TimeSheet  = TimeShift::select('id', 'shift_name', 'StartTime', 'EndTime', 'working_hours')
            ->orderBy('created_at', 'desc')->limit(7)->get();
            //return $averageResponseTime;
            $tasks = Task::select('task_name', 'deadline', 'startDate', 'endDate', 'status_id', 'id', 'AssignedTo')
            ->limit(5)
            ->get();
            foreach ($tasks as $task) {
                $assignedToIds = explode(',', $task->AssignedTo);
                $userNames = User::whereIn('id', $assignedToIds)->pluck('id')->toArray();
                $task->assigned_user_id = implode(', ', $userNames);
            }
            // Retrieve leave types to get their themes and allowed counts
            $leaveTypes = LeaveType::all();
            
            // Calculate leave counts per type for the logged-in user
            $leaveTypeCounts = [];
            foreach ($leaves as $leave) {
                if (!isset($leaveTypeCounts[$leave->leavetype_id])) {
                    $leaveTypeCounts[$leave->leavetype_id] = 0;
                }
                $leaveTypeCounts[$leave->leavetype_id] += $leave->days; // Assuming days field represents the number of leaves taken
            }
            
            // Prepare data for the view
            $leaveStatus = [];
            foreach ($leaveTypes as $type) {
                $leaveTypeId = $type->id;
                $allowedLeaves = $type->no_of_leave;
                $theme = $type->theme;
                
                $takenLeaves = isset($leaveTypeCounts[$leaveTypeId]) ? $leaveTypeCounts[$leaveTypeId] : 0;
                $percentage = $allowedLeaves > 0 ? ($takenLeaves / $allowedLeaves) * 100 : 0;
                $percentage = number_format($percentage, 2);
                
                // Determine color based on theme
                $colorClass = '';
                if ($theme === 'info') {
                    $colorClass = 'bg-info';
                } elseif ($theme === 'warning') {
                    $colorClass = 'bg-warning';
                } elseif ($theme === 'danger') {
                    $colorClass = 'bg-danger';
                } else {
                    $colorClass = 'bg-primary'; // Default color
                }
                
                $leaveStatus[] = [
                    'type' => $type->leave_type,
                    'allowed' => $allowedLeaves, // Ensure this field is available in the LeaveType model
                    'taken' => $takenLeaves,
                    'percentage' => $percentage,
                    'colorClass' => $colorClass
                ];
            }           

            $TClient = User::where('type',2)->whereNull('deleted_at')->count();
            $CompletedProjects = Project::where('department_id',5)->where('status_id',3)->whereNull('deleted_at')->count();
            $InProgrsProjects = Project::where('department_id',5)->where('status_id',2)->whereNull('deleted_at')->count();
            $TotalProjects = Project::whereNull('deleted_at')->count();
            $TotalAsgProjects = Project::where('department_id',5)->whereNull('deleted_at')->count();
            // return $currentMonthEmpPrice;
            $upcomingEvents = Calendar::leftJoin('users', 'users.id', '=', 'calendars.user_id')
            ->select('calendars.*', 'users.first_name', 'users.last_name')
            ->where('calendars.start', '>', Carbon::today()) // Events starting after today
            ->orWhere('calendars.end', '>', Carbon::today())   // Events ending after today
            ->orderBy('calendars.start', 'ASC') // Order by start date
            ->limit(3) // Limit the results to 5 events
            ->get();
            $calenderEvents = Calendar::whereMonth('start', date('m'))->whereDay('start', date('d'))->get();
            return view('Employee.dashDepartmentType.Development', compact('leaveStatus','bestEmployee','highestGoalAchiever','upcomingEvents','calenderEvents','TotalAsgProjects','TotalProjects','tasks','CompletedProjects','InProgrsProjects','TEmp','Team','TClient','TGenderFeMale','TGenderMale','TLeave','joinedEmployees','resignedEmployees','Performance','user_details','UserRole','PerformanceCategory','PerformanceRating','AuthRole','project','previousYearBestSellerEmployee','shiftDuration','currentMonthEmpPrice','OpenTicket','totalOvertime','OpenTask','totalBreakTime','averageResponseTime','tasks','teamLeads','Attendence','TimeShift','CheckInTime', 'completeEfficiency', 'inProgressEfficiency', 'leaves', 'LeadsWin', 'LeadsLoss', 'totalLeads', 'thisMonthSale', 'pendingDeals', 'kra','totalSale','query','OnLeaves','monthlyData')); 
        }
        //for general
        else
        {
            $TEmp = User::where('type',4)->count();
            $TGenderMale = User::where('gender',1)->count();
            $TGenderFeMale = User::where('gender',2)->count();
            $today = Carbon::today()->format('Y-m-d');
        
            // Count the number of employees on leave today
            $TLeave = Leave::where('apply_for', 1) // Apply for leave
                ->whereDate('start_date', '<=', $today) // Start date is before or on today
                ->whereDate('end_date', '>=', $today) // End date is after or on today
                ->count();
            $Team = User::select('users.profile_img','users.first_name','users.last_name','users.status')->where('type',4)->limit(5)->get();
            $TimeSheet  = TimeShift::select('id', 'shift_name', 'StartTime', 'EndTime', 'working_hours')
            ->orderBy('created_at', 'desc')->limit(7)->get();
            
            $assignProject = Task::where('AssignedTo', 'LIKE', '%' . Auth::user()->id . '%')->limit(10)->get();
            $project = Project::select('projects.project_name','projects.deadline','projects.start_date','projects.status_id')->limit(5)->get();
            $completeEfficiency = Goal::where('status',3)->where('employee_id',Auth::user()->id)->sum('archieved_value');            
            $inProgressEfficiency = Goal::where('status',2)->where('employee_id',Auth::user()->id)->sum('goal_value');
            $teamLeads = EmployeeDetail::Join('users','employee_details.user_id','=','users.id')->leftjoin('departments','employee_details.department_id','=','departments.id')->select('departments.name','users.first_name','users.profile_img')->where('employee_details.team_lead',1)->get();
            $leaves = LeaveType::get();    
            $ticketWithoutReply = Ticket::leftJoin('chats', 'tickets.id', '=', 'chats.ticket_id')
            ->whereNull('chats.ticket_id')
            ->whereMonth('tickets.created_at', $currentMonth)
            ->count(); 
            
            $ticketsWithFirstChat = Ticket::leftJoin('chats', 'tickets.id', '=', 'chats.ticket_id')
            ->select(DB::raw('SUM(TIMESTAMPDIFF(MINUTE, tickets.created_at, chats.created_at)) AS time_diff_sum'))
            ->groupBy('chats.ticket_id')
            ->orderBy('chats.created_at', 'asc');
            // return $ticketsWithFirstChat;
            $kra = EmployeeDetail::where('user_id',Auth::user()->id)->select('kra')->first();
            
            $currentMonth = now()->format('m');
            $currentYear = now()->year;
            $previousYear = now()->subYear()->year;
            
            // Fetch all invoices that meet the criteria for the current month
            $currentMonthInvoices = Invoice::leftJoin('quotes', 'quotes.id', 'invoices.Quotesid')
            ->where('invoices.Quotesid', '!=', '0')
            ->where('quotes.user_id',Auth::user()->id)
            ->where('invoices.is_payment_recieved', 1)
            ->whereNull('invoices.deleted_at')
            ->whereMonth('invoices.created_at', $currentMonth)
            ->whereYear('invoices.created_at', $currentYear)
            ->get();
            
            
            $totalSalesCurrentMonth = Orders::leftJoin('quotes', 'quotes.id', 'orders.quotes_id')
            ->leftJoin('invoices', 'invoices.id', 'orders.invoice_id')
            ->whereNull('orders.deleted_at')
            ->where('orders.user_id',Auth::user()->id)
            ->whereMonth('orders.created_at', $currentMonth)
            ->whereYear('orders.created_at', $currentYear)
            ->get();
            
            $totalSalesCurrentMonthPrice = $totalSalesCurrentMonth->sum('total_amt');
            
            $totalClientCount = User::where('type','4')->whereNull('deleted_at')->count();
            
            $totalRevenueCurrentMonth = Invoice::leftJoin('quotes', 'quotes.id', 'invoices.Quotesid')
            ->whereNull('invoices.deleted_at')
            ->whereMonth('invoices.created_at', $currentMonth)
            ->whereYear('invoices.created_at', $currentYear)
            ->get();
            
            $totalRevenueCurrentMonthPrice = $totalRevenueCurrentMonth->sum('final_total_amt');
            
            
            
            $previousYearInvoices = Invoice::leftJoin('quotes', 'quotes.id', 'invoices.Quotesid')
            ->where('invoices.Quotesid', '!=', '0')
            ->where('quotes.user_id',Auth::user()->id)
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
            
            $query = Goal::select('goals.status','goals.date','goals.goal_value','goals.archieved_value')
            ->groupBy('employee_id')
            ->latest('date')->paginate(10);
            $thisMonthSale = Orders::where('is_payment_recieved',1)->whereMonth('created_at', $currentMonth)->sum('total_amt'); 
            $totalSale = Orders::where('is_payment_recieved',1)->sum('total_amt');
            $pendingDeals = Orders::Join('product_news','orders.product_id','product_news.id')
            ->leftjoin('users','orders.user_id','=','users.id')
            ->select('users.first_name','product_news.product_name','orders.total_amt','orders.created_at')->limit(6)->get();
            
            $kra = EmployeeDetail::where('user_id',Auth::user()->id)->select('kra')->first();
            $StaSales = round(Invoice::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)->whereNull('deleted_at')
            ->sum('final_total_amt'));
            $totalSalesCurrentMonth = Orders::leftJoin('quotes', 'quotes.id', 'orders.quotes_id')
            ->leftJoin('invoices', 'invoices.id', 'orders.invoice_id')
            ->whereNull('orders.deleted_at')
            ->where('orders.user_id',Auth::user()->id)
            ->whereMonth('orders.created_at', $currentMonth)
            ->whereYear('orders.created_at', $currentYear)
            ->get();
            
            $totalSalesCurrentMonthPrice = $totalSalesCurrentMonth->sum('total_amt');
            $StaCustomer = User::where('type', 2)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();
            $StaProducts = Invoice::where('is_payment_recieved', 1)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)->whereNull('deleted_at')
            ->groupBy('product_id')
            ->count();
            
            $TClient = User::where('type', 2)->where('status', 1)->count();
            $StaRevenue = round(Invoice::where('is_payment_recieved', 1)
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)->whereNull('deleted_at')
            ->sum('final_total_amt'));
            
            
            $totalRevenueCurrentMonth = Invoice::leftJoin('quotes', 'quotes.id', 'invoices.Quotesid')
            ->whereNull('invoices.deleted_at')
            ->where('invoices.user_id',Auth::user()->id)
            ->whereMonth('invoices.created_at', $currentMonth)
            ->whereYear('invoices.created_at', $currentYear)
            ->get();
            
            $totalRevenueCurrentMonthPrice = $totalRevenueCurrentMonth->sum('final_total_amt');
            $PayExpenses = PayRoll::whereMonth('created_at', $currentMonth)
            ->where('emp_Id',Auth::user()->id)
            ->whereYear('created_at', $currentYear)
            ->sum('net_paid');
            
            $PayExpensesTotal = PayRoll::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->sum('net_salary');
            $previousMonthAmount = round(Invoice::where('is_payment_recieved', 1)
            ->whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', $currentYear)->whereNull('deleted_at')
            ->sum('amount'));
            $LeadsGenerated = Leads::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->count();
            $PreviousTotalIncome = Project::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', $currentYear)
            ->sum('project_value');
            $PreviousTotalExpenses = PayRoll::whereMonth('created_at', now()->subMonth()->month)
            ->whereYear('created_at', $currentYear)
            ->sum('net_paid');
            $TotalIncome = Project::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->sum('project_value');
            
            
            $default_currency = Currency::where('is_default', 1)->first();
            $PopularProducts = ProductNew::leftJoin('product_pricing', function ($join) use ($default_currency) {
                $join->on('product_pricing.product_id', '=', 'product_news.id')
                ->where('product_pricing.currency_id', '=', $default_currency->id); // Condition for default currency
            })
            ->select('product_news.id', 'product_news.product_name', 'product_news.product_image', 'product_pricing.price', 'product_news.product_tag_line')
            ->orderBy('product_news.order_count', 'desc') // Order by order_count to get popular products
            ->orderBy('product_news.created_at', 'desc') // Order by created_at to get latest products
            ->groupBy('product_news.id') // Group by product_news.id to avoid duplicate entries
            ->limit(10) // Limit to 10 products
            ->get();
            $TProJect = Project::whereNotIn('status_id', ['2', '4'])->count();
            $OpenTicket = Ticket::where('status', 1)->count();
            $TTask = Task::whereNotIn('status_id', ['2', '4'])->count();
            $showTTask = Task::count();
            $OpenTask = Task::where('status_id', 1)->count();
            $TasksOverDue = Task::where('status_id', 3)->count();
            $currentMonth = Carbon::now()->month;
            $currentYear = Carbon::now()->year;
            
            // Retrieve tickets created in the current month and year with their first responses
            $tickets = Ticket::whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->where('ccid',Auth::user()->id)
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
                $averageResponseTime = '0.00';
            }
            
            
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
                $shiftDuration = "0.00";
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
            $LeadsProgress  = Leads::where('status', 1)->whereMonth('created_at', $currentMonth)->whereYear('created_at', now()->year)->count();
            $Performance = User::select('users.first_name','users.id','users.email','users.profile_img','departments.name as departments_name')
            ->leftjoin('employee_details','employee_details.user_id','users.id')
            ->leftjoin('departments','departments.id','employee_details.department_id')
            ->where('users.type', 4)
            ->where('users.id',$userId)
            ->paginate(10);
            $user_details = User::find($userId);
            $PerformanceCategory = PerformanceCategory::get();
            $PerformanceRating = PerformanceRating::get(); //'Performance','user_details','PerformanceCategory','PerformanceRating',
            $upcomingEvents = Calendar::leftJoin('users', 'users.id', '=', 'calendars.user_id')
            ->select('calendars.*', 'users.first_name', 'users.last_name')
            ->where('calendars.start', '>', Carbon::today()) // Events starting after today
            ->orWhere('calendars.end', '>', Carbon::today())   // Events ending after today
            ->orderBy('calendars.start', 'ASC') // Order by start date
            ->limit(3) // Limit the results to 5 events
            ->get();
            $calenderEvents = Calendar::whereMonth('start', date('m'))->whereDay('start', date('d'))->get();
            
            return view('Employee.dashDepartmentType.General',compact('Performance','bestEmployee','calenderEvents','highestGoalAchiever','upcomingEvents','user_details','PerformanceCategory','UserRole','PerformanceRating','TimeSheet','previousYearBestSellerEmployee','shiftDuration','currentMonthEmpPrice','OpenTicket','totalOvertime','OpenTask','totalBreakTime','averageResponseTime','Attendence','TimeShift','assignProject','CheckInTime','completeEfficiency','inProgressEfficiency','teamLeads','leaves','ticketWithoutReply','ticketsWithFirstChat','kra','project','TEmp','Team','TLeave','TGenderMale','TGenderFeMale')); 
        }
    }
    public function Advanced(Request $request)
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
        
        if($RoleAccess[array_search('Advanced_Dashboard', array_column($RoleAccess, 'per_name'))]['view'] == 1)
        {
            
            $TClient = User::where('type', 2)->where('status', 1)->count();
            $TOEMP = User::where('type', 4)->where('status', 1)->count();
            $TProJect = Task::count();
            $TPEnding = Task::count();
            $PendingLeaves = Leave::where('leaves.status', 3)
            ->limit(5)
            ->leftjoin('users', 'leaves.emp_id', '=', 'users.id')
            ->leftjoin('leave_types', 'leave_types.id', '=', 'leaves.leavetype_id')
            ->select('leaves.*', 'leave_types.*', 'users.first_name', 'users.last_name', 'users.email')
            ->get();
            $OpenTicket = Ticket::where('status', 1)->limit(5)->get();
            $PendingTasks = Task::where('status_id', 3)->limit(5)->get();
        }
        
        if($RoleAccess[array_search('Advanced_Dashboard', array_column($RoleAccess, 'per_name'))]['view'] == 2)
        {
            
            $TClient = User::where('user_id',Auth::user()->id)->where('type', 2)->where('status', 1)->count();
            $TOEMP = User::where('user_id',Auth::user()->id)->where('type', 4)->where('status', 1)->count();
            $TProJect = Task::where('AssignedTo', 'LIKE', '%' . Auth::user()->id . '%')->count();
            $TPEnding = Task::where('AssignedTo', 'LIKE', '%' . Auth::user()->id . '%')->count();
            $PendingLeaves = Leave::where('leaves.status', 3)
            ->limit(5)
            ->leftjoin('users', 'leaves.emp_id', '=', 'users.id')
            ->leftjoin('leave_types', 'leave_types.id', '=', 'leaves.leavetype_id')
            ->select('leaves.*', 'leave_types.*', 'users.first_name', 'users.last_name', 'users.email')
            ->where('leaves.emp_Id', Auth::user()->id)
            ->get();
            $OpenTicket = Ticket::where('ccid', 'LIKE', '%' . Auth::user()->id . '%')->where('status', 1)->limit(5)->get();
            $PendingTasks = Task::where('AssignedTo', 'LIKE', '%' . Auth::user()->id . '%')->where('status_id', 3)->limit(5)->get();
        }
        
        return view('Employee.dashboard.Advanced', compact('TClient', 'TOEMP', 'TProJect', 'PendingLeaves', 'OpenTicket', 'PendingTasks'));
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
            
            // Toggle clock status
            $user->clock_status = $user->clock_status == 1 ? 0 : 1;
            if (!$user->save()) {
                return response()->json(['status' => 500, 'success' => false, 'message' => 'Failed to update user status']);
            }
            
            if ($request->action == 'clockin') {
                $attendance = new Attendence;
                $attendance->emp_Id = Auth::user()->id;
                $attendance->punch_date = $currentDate;
                $attendance->punch_in = $currentTime;
                
                if (!$attendance->save()) {
                    return response()->json(['status' => 500, 'success' => false, 'message' => 'Failed to save clock-in record']);
                }
                
                return response()->json(['status' => 200, 'success' => true, 'data' => $attendance]);
                
            } elseif ($request->action == 'clockout') {
                $attendance = Attendence::where('emp_Id', Auth::user()->id)
                ->where('punch_date', $currentDate)
                ->whereNull('punch_out')
                ->first();
                
                if ($attendance) {
                    $attendance->punch_out = $currentTime;
                    
                    if (!$attendance->save()) {
                        return response()->json(['status' => 500, 'success' => false, 'message' => 'Failed to save clock-out record']);
                    }
                    
                    return response()->json(['status' => 200, 'success' => true, 'data' => $attendance]);
                } else {
                    return response()->json(['status' => 400, 'success' => false, 'message' => 'Clock-out record not found']);
                }
            }
            
            return response()->json(['status' => 200, 'success' => true, 'data' => $user]);
            
        } catch (\Exception $e) {
            return response()->json(['status' => 500, 'success' => false, 'message' => $e->getMessage()]);
        }
    }
    
    ////DEPARTMENT ID WISE DASHBOARD 
    
    
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
                                                            