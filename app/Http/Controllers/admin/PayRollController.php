<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Jenssegers\Agent\Agent;
use App\Exports\PayRollExport;
use App\Models\LogActivity;
use App\Models\PayRollIncrement;
use App\Models\Attendence;
use App\Models\TimeShift;
use App\Models\LeaveType;
use App\Models\EmployeeDetail;
use App\Models\LeaveAccess;
use App\Models\PayRoll;
use App\Models\Jobroles;
use App\Models\Currency;
use App\Models\User;
use App\Models\Leave;
use App\Models\Rule;
use App\Models\Role;
use App\Models\Department;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Auth;
use Hash;

use DB;

class PayRollController extends Controller
{

    public function home(Request $request)
    {
        $currentYear = date('Y');
        $currentMonth = date('m');

        $data = $this->getCardData($currentYear,$currentMonth);
        // return $data;
        $totalEmp = $data['totalEmp'];
        $empTotalPercent = $data['empTotalPercent'];
        $totalWorkingHours = $data['totalWorkingHours'];
        $empTotalWorkHrs = $data['empTotalWorkHrs'];
        $totalPayrollCost = $data['totalPayrollCost'];
        $payrollCostChange = $data['payrollCostChange'];
        $totalNetSalary = $data['totalNetSalary'];
        $netSalaryChange = $data['netSalaryChange'];
        $totalNetDeduction = $data['totalNetDeduction'];
        $netDeductionChange = $data['netDeductionChange'];
        $totalNetTds = $data['totalNetTds'];
        $netTdsChange = $data['netTdsChange'];

        // Fetch rules data
        $Rules = Rule::findOrFail(1);
        $currency = Currency::where('is_default', 1)->first();
        // Fetch payroll data for the current month
        $search = $request->has('search') ? $request->search : '';

        $payrolls = PayRoll::select(
                'users.first_name',
                'users.last_name',
                'users.profile_img',
                'users.email',
                'pay_rolls.net_salary',
                'pay_rolls.net_paid',
                'pay_rolls.id',
                'roles.name as user_role',
                'pay_rolls.tds',
                'pay_rolls.deduction',
                'users.id as user_id',
                DB::raw('SUM(TIMESTAMPDIFF(MINUTE, attendences.punch_in, attendences.punch_out) / 60) as total_working_hours')
            )
            ->join('users', 'users.id', 'pay_rolls.emp_id')
            ->leftjoin('employee_details', 'users.id', 'employee_details.user_id')
            ->leftjoin('roles', 'roles.id', 'employee_details.job_role_id')
            ->leftjoin('attendences', 'users.id', 'attendences.user_id')
            ->where('users.type', 4)
            ->whereYear('pay_rolls.date', $currentYear)
            ->whereMonth('pay_rolls.date', $currentMonth)
            ->when($search, function ($query) use ($search) {
                $query->where('users.first_name', 'like', '%' . $search . '%');
            })
            ->groupBy('users.id')
            ->orderBy('pay_rolls.id', 'desc')
            ->paginate(10);


        // Return the view with all the data
        return view('admin.Humanesources.PayRoll.home', compact('payrolls', 'Rules', 'totalEmp', 'empTotalPercent', 'totalWorkingHours', 'empTotalWorkHrs', 'totalPayrollCost', 'payrollCostChange', 'totalNetSalary', 'netSalaryChange', 'totalNetDeduction', 'netDeductionChange', 'totalNetTds', 'netTdsChange', 'currency'));
    }
    
    public function view(Request $request,$id){
        $user_id = $id;
        $payrolls = PayRoll::where('pay_rolls.emp_id',$id)
                    ->join('users', 'users.id', 'pay_rolls.emp_id')
                    ->select('pay_rolls.*','users.first_name')
                    ->get();
        
        $employee = User::join('employee_details','employee_details.user_id','users.id')
                    ->where('users.id',$user_id)
                    ->select('users.*','employee_details.job_role_id','employee_details.department_id')
                    ->first();
        $role = Role::where('id',$employee->job_role_id)->value('name');
        $department = Department::where('id',$employee->department_id)->value('name');
        
       
        // Calculate the total payroll cost
        $totalPayrollCost = PayRoll::where('users.type', 4)
            ->join('users', 'users.id', 'pay_rolls.emp_id')
            ->where('pay_rolls.emp_id', $user_id)
            // ->whereYear('pay_rolls.date', $currentYear)
            // ->whereMonth('pay_rolls.date', $currentMonth)
            ->sum('pay_rolls.net_paid');
            
        // Calculate the total net salary cost
        $totalNetSalary = PayRoll::where('users.type', 4)
            ->join('users', 'users.id', 'pay_rolls.emp_id')
            ->where('pay_rolls.emp_id', $user_id)
            // ->whereYear('pay_rolls.date', $currentYear)
            // ->whereMonth('pay_rolls.date', $currentMonth)
            ->sum('pay_rolls.net_salary');
            
        $totalNetDeduction = PayRoll::where('users.type', 4)
            ->join('users', 'users.id', 'pay_rolls.emp_id')
            ->where('pay_rolls.emp_id', $user_id)
            // ->whereYear('pay_rolls.date', $currentYear)
            // ->whereMonth('pay_rolls.date', $currentMonth)
            ->sum('pay_rolls.deduction');


        // return $totalPayrollCost;
        $currency = Currency::where('is_default', 1)->first();
        return view('admin.Humanesources.PayRoll.view',compact('payrolls','user_id','currency','employee','role','department','totalPayrollCost','totalNetSalary','totalNetDeduction'));
    }
    
    public function getEmpPayroll(Request $request)
    {
        $year = $request->year;
        $month = $request->month;
        $payrolls = PayRoll::join('users', 'users.id', 'pay_rolls.emp_id')
                    ->whereYear('pay_rolls.date', $year)
                    ->whereMonth('pay_rolls.date', $month)
                    ->where('pay_rolls.emp_id',$request->id)
                    ->select('pay_rolls.*','users.first_name')
                    ->get();
        // return $payrolls;

        return view('admin.Humanesources.PayRoll.empPayroll', compact('payrolls'))->with('success', "Data of: $year-$month Fetched Successfully");
        
    }


    public function getCardData($currentYear,$currentMonth){
        // Get current year and month
        

        // Calculate start and end dates for the last quarter
        $startDate = date('Y-m-d', strtotime("-3 months", strtotime("$currentYear-$currentMonth-01")));
        $endDate = date('Y-m-t', strtotime("-1 months", strtotime("$currentYear-$currentMonth-01")));

        // Calculate total employees joined in the current month
        $currentMonthJoiners = User::where('type', 4)
            ->join('employee_details', 'users.id', '=', 'employee_details.user_id')
            ->whereYear('employee_details.date_of_joining', '=', $currentYear)
            ->whereMonth('employee_details.date_of_joining', '=', $currentMonth)
            ->whereNull('employee_details.date_of_relieving')
            ->count();

        // Calculate total employees joined in the last quarter
        $previousThreeMonthsEmployees = User::where('type', 4)
            ->join('employee_details', 'users.id', '=', 'employee_details.user_id')
            ->whereYear('employee_details.date_of_joining', '=', $currentYear)
            ->whereMonth('employee_details.date_of_joining', '<=', date('m', strtotime($endDate)))
            ->whereMonth('employee_details.date_of_joining', '>=', date('m', strtotime($startDate)))
            ->whereNotNull('employee_details.date_of_relieving')
            ->count();

        // Calculate total employees (active and joined in the last quarter)
        $totalEmp = User::where('type', 4)
            ->join('employee_details', 'users.id', '=', 'employee_details.user_id')
            ->whereNull('employee_details.date_of_relieving')
            ->count();

        // Calculate percentage change in total employees since the last quarter
        $empTotalPercent = 0;
        if ($totalEmp !== 0) {
            $empTotalPercent = (($currentMonthJoiners - $previousThreeMonthsEmployees) / $totalEmp) * 100;
        }

        // Calculate total working hours for the current month
        $totalWorkingHours = DB::table('attendences')
            ->select(DB::raw('IF(SUM(TIMESTAMPDIFF(MINUTE, punch_in, punch_out) / 60) > 0, SUM(TIMESTAMPDIFF(MINUTE, punch_in, punch_out) / 60), 0) as total_hours'))
            ->whereYear('punch_date', $currentYear)
            ->whereMonth('punch_date', $currentMonth)
            ->value('total_hours');


        // Calculate total working hours for the last quarter
        $totalWorkingHoursLastThreeMonths = DB::table('attendences')
            ->select(DB::raw('SUM(TIMESTAMPDIFF(MINUTE, punch_in, punch_out) / 60) as total_hours'))
            ->whereYear('punch_date', $currentYear)
            ->whereBetween('punch_date', [$startDate, $endDate])
            ->value('total_hours');

        // Calculate total working hours (current month and last quarter)
        $totalCurrentAndPrevious = $totalWorkingHours + $totalWorkingHoursLastThreeMonths;

        // Calculate percentage change in total working hours since the last quarter
        $empTotalWorkHrs = 0;
        if ($totalWorkingHoursLastThreeMonths !== 0 && $totalCurrentAndPrevious > 0) {
            $empTotalWorkHrs = (($totalWorkingHours - $totalWorkingHoursLastThreeMonths) / $totalCurrentAndPrevious) * 100;
        }

      // Calculate the total payroll cost
$totalPayrollCost = PayRoll::where('users.type', 4)
    ->join('users', 'users.id', 'pay_rolls.emp_id')
    ->whereYear('pay_rolls.date', $currentYear)
    ->whereMonth('pay_rolls.date', $currentMonth)
    ->sum('pay_rolls.net_paid');

// Get the total payroll cost for the last month
$totalPayrollCostLastMonth = PayRoll::where('users.type', 4)
    ->join('users', 'users.id', 'pay_rolls.emp_id')
    ->whereYear('pay_rolls.date', $currentYear)
    ->whereMonth('pay_rolls.date', $currentMonth - 1)
    ->sum('pay_rolls.net_paid');

// Calculate the percentage change in net Payroll cost
$payrollCostChange = 0;

// Check to ensure we do not divide by zero
if ($totalPayrollCostLastMonth > 0) {
    $payrollCostChange = (($totalPayrollCost - $totalPayrollCostLastMonth) / $totalPayrollCostLastMonth) * 100;
}

// If last month's payroll cost is zero, handle it as a special case
if ($totalPayrollCostLastMonth == 0 && $totalPayrollCost > 0) {
    $payrollCostChange = 100; // This indicates a 100% increase as there was no payroll last month
} elseif ($totalPayrollCostLastMonth == 0 && $totalPayrollCost == 0) {
    $payrollCostChange = 0; // No change as both months have no payroll cost
}
        // Calculate the total net salary cost
        $totalNetSalary = PayRoll::where('users.type', 4)
            ->join('users', 'users.id', 'pay_rolls.emp_id')
            ->whereYear('pay_rolls.date', $currentYear)
            ->whereMonth('pay_rolls.date', $currentMonth)
            ->sum('pay_rolls.net_salary');

        // Get the total net salary cost for the last month
        $totalNetSalaryLastMonth = PayRoll::where('users.type', 4)
            ->join('users', 'users.id', 'pay_rolls.emp_id')
            ->whereYear('pay_rolls.date', $currentYear)
            ->whereMonth('pay_rolls.date', $currentMonth - 1)
            ->sum('pay_rolls.net_salary');

        // Calculate the percentage change in net salary cost
        $netSalaryChange = 0;
        if ($totalNetSalaryLastMonth !== 0) {
            $netSalaryChange = (($totalNetSalary - $totalNetSalaryLastMonth) / $totalNetSalaryLastMonth) * 100;
        }

        // Calculate the total net deductions
        $totalNetDeduction = PayRoll::where('users.type', 4)
            ->join('users', 'users.id', 'pay_rolls.emp_id')
            ->whereYear('pay_rolls.date', $currentYear)
            ->whereMonth('pay_rolls.date', $currentMonth)
            ->sum('pay_rolls.deduction');

        // Get the total net deductions for the last month
        $totalNetDeductionLastMonth = PayRoll::where('users.type', 4)
            ->join('users', 'users.id', 'pay_rolls.emp_id')
            ->whereYear('pay_rolls.date', $currentYear)
            ->whereMonth('pay_rolls.date', $currentMonth - 1)
            ->sum('pay_rolls.deduction');

        // Calculate the percentage change in net deductions
        $netDeductionChange = 0;
        if ($totalNetDeductionLastMonth !== 0) {
            $netDeductionChange = (($totalNetDeduction - $totalNetDeductionLastMonth) / $totalNetDeductionLastMonth) * 100;
        }


        // Calculate the total net deductions
        $totalNetTds = PayRoll::where('users.type', 4)
            ->join('users', 'users.id', 'pay_rolls.emp_id')
            ->whereYear('pay_rolls.date', $currentYear)
            ->whereMonth('pay_rolls.date', $currentMonth)
            ->sum('pay_rolls.tds');

        // Get the total net Tdss for the last month
        $totalNetTdsLastMonth = PayRoll::where('users.type', 4)
            ->join('users', 'users.id', 'pay_rolls.emp_id')
            ->whereYear('pay_rolls.date', $currentYear)
            ->whereMonth('pay_rolls.date', $currentMonth - 1)
            ->sum('pay_rolls.tds');

        // Calculate the percentage change in net Tdss
        $netTdsChange = 0;
        if ($totalNetTdsLastMonth !== 0) {
            $netTdsChange = (($totalNetTds - $totalNetTdsLastMonth) / $totalNetTdsLastMonth) * 100;
        }

        $data = [
            'totalEmp' => $totalEmp,
            'empTotalPercent' => $empTotalPercent,
            'totalWorkingHours' => $totalWorkingHours,
            'empTotalWorkHrs' => $empTotalWorkHrs,
            'totalPayrollCost' => $totalPayrollCost,
            'payrollCostChange' => $payrollCostChange,
            'totalNetSalary' => $totalNetSalary,
            'netSalaryChange' => $netSalaryChange,
            'totalNetDeduction' => $totalNetDeduction,
            'netDeductionChange' => $netDeductionChange,
            'totalNetTds' => $totalNetTds,
            'netTdsChange' => $netTdsChange,
        ];

        return $data;
    }
    
    public function home2()
    {
        $currentYear = date('Y');
        $currentMonth = date('m');

        $startDate = date('Y-m-d', strtotime("-3 months", strtotime("$currentYear-$currentMonth-01")));
        $endDate = date('Y-m-t', strtotime("-1 months", strtotime("$currentYear-$currentMonth-01")));

        $currentMonthJoiners = User::where('type', 4)
            ->join('employee_details', 'users.id', '=', 'employee_details.user_id')
            ->whereYear('employee_details.date_of_joining', '=', $currentYear)
            ->whereMonth('employee_details.date_of_joining', '=', $currentMonth)
            ->whereNull('employee_details.date_of_relieving')
            ->count();

        $previousThreeMonthsEmployees = User::where('type', 4)
            ->join('employee_details', 'users.id', '=', 'employee_details.user_id')
            ->whereYear('employee_details.date_of_joining', '=', $currentYear)
            ->whereMonth('employee_details.date_of_joining', '<=', date('m', strtotime($endDate)))
            ->whereMonth('employee_details.date_of_joining', '>=', date('m', strtotime($startDate)))
            ->whereNotNull('employee_details.date_of_relieving')
            ->count();

        $totalCurrentAndPrevious = $currentMonthJoiners + $previousThreeMonthsEmployees;
        $EmpTotalPercent = 0;

        if ($totalCurrentAndPrevious !== 0) {
            $EmpTotalPercent = (($currentMonthJoiners - $previousThreeMonthsEmployees) / $totalCurrentAndPrevious) * 100;
        }

        $EmpTotalPercent = number_format($EmpTotalPercent, 2);

        $totalWorkingHours = DB::table('attendences')
            ->select(DB::raw('SUM(TIMESTAMPDIFF(MINUTE, punch_in, punch_out) / 60) as total_hours'))
            ->whereYear('punch_date', $currentYear)
            ->whereMonth('punch_date', date('m'))
            ->value('total_hours');

        $totalWorkingHours = number_format($totalWorkingHours, 2);

        $totalWorkingHoursLastThreeMonths = DB::table('attendences')
            ->select(DB::raw('SUM(TIMESTAMPDIFF(MINUTE, punch_in, punch_out) / 60) as total_hours'))
            ->whereYear('punch_date', $currentYear)
            ->whereBetween('punch_date', [$startDate, $endDate])
            ->value('total_hours');
        $totalCurrentAndPrevious2 = $totalWorkingHours + $totalWorkingHoursLastThreeMonths;
        $EmpTotalWorkHrs = 0;
        if ($totalWorkingHoursLastThreeMonths !== 0 && $totalCurrentAndPrevious2 > 0) {
            $EmpTotalWorkHrs = (($totalWorkingHours - $totalWorkingHoursLastThreeMonths) / $totalCurrentAndPrevious2) * 100;
        }

        $EmpTotalWorkHrs = number_format($EmpTotalWorkHrs, 2);

        $PayRoll = PayRoll::select('users.first_name', 'users.profile_img', 'users.email', 'pay_rolls.net_salary', 'pay_rolls.net_paid', 'pay_rolls.id')
            ->join('users', 'users.id', 'pay_rolls.emp_id')
            ->where('users.type', 4)
            ->whereYear('pay_rolls.date', $currentYear)
            ->whereMonth('pay_rolls.date', $currentMonth)
            ->orderBy('pay_rolls.created_at', 'desc')
            ->paginate(10);

        $total_emp = User::where('type', 4)
            ->join('employee_details', 'users.id', '=', 'employee_details.user_id')
            ->whereNull('employee_details.date_of_relieving')
            ->count();

        $Rules = Rule::where('id', 1)->first();

        return view('admin.Humanesources.PayRoll.home2', compact('PayRoll', 'Rules', 'total_emp', 'EmpTotalPercent', 'totalWorkingHours', 'EmpTotalWorkHrs'));
    }





public function GenerateSellary(Request $request)
{
    $currentYear = date('Y');
    $currentMonth = date('m');
    $totalSalary = 0.00;

    $PayR = PayRoll::whereYear('date', $currentYear)
        ->whereMonth('date', $currentMonth)
        ->count();

    if ($PayR == 0) {
        $User = User::select('users.id', 'employee_details.admin_type_id', 'employee_details.net_salary', 'employee_details.shift_id', 'employee_details.weekly_off_id')
            ->join('employee_details', 'employee_details.user_id', 'users.id')
            ->where('users.type', 4)
            ->orderBy('users.id', 'desc')
            ->get();

        $no_of_leave = LeaveType::sum('no_of_leave');
        $id = 1;
        $ruleWiseDiduction = Rule::findOrFail($id);
        $perWiseBasic = isset($ruleWiseDiduction) ? $ruleWiseDiduction->basic : '0';
        $totalTDS = isset($ruleWiseDiduction) ? $ruleWiseDiduction->tds : '0';
        $perWiseHra = isset($ruleWiseDiduction) ? $ruleWiseDiduction->hra : '0';
        $totalPerWise = $perWiseBasic + $perWiseHra + $totalTDS;
        $totalConveyanceWise = isset($ruleWiseDiduction) ? $ruleWiseDiduction->conveyance : '0';
        $totalMedicalWise = isset($ruleWiseDiduction) ? $ruleWiseDiduction->medical : '0';
        $totalCMWise = $totalConveyanceWise + $totalMedicalWise;

        foreach ($User as $userData) {
            $TimeShift = TimeShift::find($userData->shift_id);
            $TimeShift = isset($TimeShift) ? date('H', strtotime($TimeShift->working_hours)) : '9';

            $attendanceTime = Attendence::where('emp_Id', $userData->id)
                ->whereMonth('punch_date', $currentMonth)
                ->get();

            $totalTimePerDay = [];
            $totalTimeOverNineHours = 0; // Variable to hold total time greater than 9 hours

            foreach ($attendanceTime as $attendance) {
                $date = $attendance->punch_date; // Assuming 'punch_date' holds the date information

                // Ensure punch_in and punch_out are valid
                if ($attendance->punch_in && $attendance->punch_out) {
                    $start = Carbon::createFromFormat('H:i:s', $attendance->punch_in);
                    $end = Carbon::createFromFormat('H:i:s', $attendance->punch_out);

                    $diffInSeconds = $end->diffInSeconds($start);

                    // Calculate hours and minutes for the current attendance record
                    $hours = floor($diffInSeconds / 3600);
                    $minutes = floor(($diffInSeconds % 3600) / 60);

                    $totalTimePerDay[$date]['hours'] = isset($totalTimePerDay[$date]['hours']) ? $totalTimePerDay[$date]['hours'] + $hours : $hours;
                    $totalTimePerDay[$date]['minutes'] = isset($totalTimePerDay[$date]['minutes']) ? $totalTimePerDay[$date]['minutes'] + $minutes : $minutes;

                    // Check if total time is greater than 9 hours
                    $totalTime = $hours + ($minutes / 60); // Convert minutes to hours
                    if ($totalTime > $TimeShift) {
                        $totalTimeOverNineHours += $totalTime - $TimeShift;
                        $totalTimePerDay[$date]['hours'] = $TimeShift; // Set total time to 9 hours
                        $totalTimePerDay[$date]['minutes'] = 0; // Reset minutes to 0
                    }
                }
            }

            // Now you have the total time per day in $totalTimePerDay array
            // You also have total time over nine hours in $totalTimeOverNineHours variable
            $totalTime = 0;
            foreach ($totalTimePerDay as $date => $time) {
                $total_hours = $time['hours'];
                $total_minutes = $time['minutes'];

                $totalTime += $total_hours + ($total_minutes / 60); // Convert minutes to hours
            }

            $totalTime = $totalTime;

            $countedDays = $this->countDaysDynamically($totalTime);

            $totalperWiseBasic = $userData->net_salary * $perWiseBasic / 100;
            $totalperWiseHra = $userData->net_salary * $perWiseHra / 100;
            $totalperTds = $userData->net_salary * $totalTDS / 100;
            $prDayWiseSalary = $userData->net_salary / 30;

            $netSalary = $userData->net_salary * $totalPerWise / 100;

            $totalNetS = $totalCMWise + $netSalary;

            $netSalary = $userData->net_salary - $totalNetS;

            $TotalLeave = Leave::where('emp_id', $userData->id)->whereMonth('date', $currentMonth)->sum('days');
            $prDayWiseSallery = number_format($userData->net_salary / 30, 2);

            if ($userData->job_role_id == 2) {
                $approvedCountLeave = Leave::whereMonth('date', $currentMonth)->where('emp_id', $userData->id)->where('status',1)->sum('days');
                $UnApprovedCountLeave = Leave::whereMonth('date', $currentMonth)->where('emp_id', $userData->id)->where('status',2)->sum('days');
            } else {
                $approvedCountLeave = Leave::where('emp_id', $userData->id)->whereMonth('date', $currentMonth)->where('status',1)->sum('days');
                $UnApprovedCountLeave = Leave::where('emp_id', $userData->id)->whereMonth('date', $currentMonth)->where('status', 2)->sum('days');
            }

            $year = date('Y');
            $month = date('m');
            $weekly_off_id = EmployeeDetail::whereNotNull('weekly_off_id')->where('user_id', $userData->id)->count();
            if ($weekly_off_id > 0) {
                $weekly_off_id = $this->countSpecificDayInMonth($year, $month, $userData->weekly_off_id);
            } else {
                $weekly_off_id = '0';
            }
            $additional_week_off_first = EmployeeDetail::whereNotNull('additional_week_off_first')->where('user_id', $userData->id)->count();
            $additional_week_off_second = EmployeeDetail::whereNotNull('additional_week_off_second')->where('user_id', $userData->id)->count();
            $additional_week_off_third = EmployeeDetail::whereNotNull('additional_week_off_third')->where('user_id', $userData->id)->count();
            $additional_week_off_fourth = EmployeeDetail::whereNotNull('additional_week_off_fourth')->where('user_id', $userData->id)->count();
            $countHoliday = $weekly_off_id + $additional_week_off_first + $additional_week_off_second + $additional_week_off_third + $additional_week_off_fourth;

            $currentMonth = Carbon::now()->month; // Get the current month
            $daysInMonth = Carbon::now()->daysInMonth; // Get the number of days in the current month

            $checkAttendence = Attendence::where('emp_id', $userData->id)
                ->whereMonth('punch_date', $currentMonth)
                ->groupBy('punch_date')
                ->get();

            $checkAttendence = count($checkAttendence);
            $monthDays = "30";
            $leaves = $monthDays - $checkAttendence;

            $salaryDays = $checkAttendence + $countHoliday;

            if ($salaryDays == '30' || $salaryDays == '31' || $salaryDays == '28'|| $salaryDays == '29' || $salaryDays > '0') {

                if (is_numeric($salaryDays) && is_numeric($prDayWiseSalary) && is_numeric($totalNetS)) {
                    $totalSalary = round(($salaryDays * $prDayWiseSalary));


                }
               else {
                    $totalSalary = '0:00';
                }

            } else {
                if ($approvedCountLeave > 0 && $UnApprovedCountLeave > 0) {
                    if ($salaryDays < 30 && $approvedCountLeave == 0) {
                        if (is_numeric($salaryDays) && is_numeric($prDayWiseSalary) && is_numeric($totalNetS)) {
                            $totalSalary1 = round(($salaryDays * $prDayWiseSalary));
                        }
                    } else {
                        $totalSalary1 = "0";
                    }

                    if ($no_of_leave >= $approvedCountLeave && $UnApprovedCountLeave = 0) {
                        $salaryDays = $salaryDays + $approvedCountLeave;
                        if (is_numeric($salaryDays) && is_numeric($prDayWiseSalary) && is_numeric($totalNetS)) {
                            $totalSalary1 = round(($salaryDays * $prDayWiseSalary));
                        } else {
                            $totalSalary1 = '0:00';
                        }
                    } else if ($approvedCountLeave > 0 && $no_of_leave < $approvedCountLeave && $UnApprovedCountLeave = 0) {
                        $salaryDays = $salaryDays + $no_of_leave;
                        if (is_numeric($salaryDays) && is_numeric($prDayWiseSalary) && is_numeric($totalNetS)) {
                            $totalSalary1 = round(($salaryDays * $prDayWiseSalary));
                        } else {
                            $totalSalary1 = '0:00';
                        }
                    } else {
                        $totalSalary1 = "0:00";
                    }
                } else {
                    if ($approvedCountLeave > 0 && $UnApprovedCountLeave == 0) {
                        if ($no_of_leave >= $approvedCountLeave) {
                            $salaryDays = $salaryDays + $approvedCountLeave;
                            if (is_numeric($salaryDays) && is_numeric($prDayWiseSalary) && is_numeric($totalNetS)) {
                                $totalSalary1 = round(($salaryDays * $prDayWiseSalary) - $totalNetS);
                            } else {
                                $totalSalary1 = '0:00';
                            }
                        } else {
                            $salaryDays = $salaryDays + $no_of_leave;
                            if (is_numeric($salaryDays) && is_numeric($prDayWiseSalary) && is_numeric($totalNetS)) {
                                $totalSalary1 = round(($salaryDays * $prDayWiseSalary) - $totalNetS);
                            } else {
                                $totalSalary1 = '0:00';
                            }
                        }
                    } else if ($approvedCountLeave == 0 && $UnApprovedCountLeave > 0) {
                        $salaryDays = $salaryDays - $UnApprovedCountLeave;
                        if (is_numeric($salaryDays) && is_numeric($prDayWiseSalary) && is_numeric($totalNetS)) {
                            $totalSalary1 = round(($salaryDays * $prDayWiseSalary) - $totalNetS);
                        } else {
                            $totalSalary1 = '0:00';
                        }
                    } else if ($approvedCountLeave > 0 && $UnApprovedCountLeave > 0) {
                        if ($no_of_leave >= $approvedCountLeave) {
                            $salaryDays = $salaryDays + $approvedCountLeave - $UnApprovedCountLeave;
                            if (is_numeric($salaryDays) && is_numeric($prDayWiseSalary) && is_numeric($totalNetS)) {
                                $totalSalary1 = round(($salaryDays * $prDayWiseSalary) - $totalNetS);
                            } else {
                                $totalSalary1 = '0:00';
                            }
                        } else {
                            $salaryDays = $salaryDays + $no_of_leave - $UnApprovedCountLeave;
                            if (is_numeric($salaryDays) && is_numeric($prDayWiseSalary) && is_numeric($totalNetS)) {
                                $totalSalary1 = round(($salaryDays * $prDayWiseSalary) - $totalNetS);
                            } else {
                                $totalSalary1 = '0:00';
                            }
                        }
                    } else {
                        $totalSalary1 = "0:00";
                    }
                }
            }
       // echo "salaryDays -- ".$salaryDays.'<br>';
                // echo "totalNetS -- ".$totalNetS.'<br>';
                // echo "totalperWiseHra -- ".$totalperWiseHra.'<br>';
                // echo "prDayWiseSalary -- ".$prDayWiseSalary.'<br>';
                // echo "totalSalary -- ".$totalSalary.'<br>';
                // echo '------<br>'; exit; 

                if ($totalSalary > 0) {
                    $net_paid = $totalSalary;
                    if (is_numeric($userData->net_salary) && is_numeric($totalSalary)) {
                        $deduction = $userData->net_salary - $totalSalary;
                    } else {
                        $deduction = "0";
                    }
                } else {
                    $net_paid = "0:00";
                    $deduction = $userData->net_salary;
                }

                // echo "totalSalary -- ".$totalSalary.'<br>'; 
                // echo "UnApprovedCountLeave -- ".$UnApprovedCountLeave.'<br>'; 
                // echo "approvedCountLeave -- ".$approvedCountLeave.'<br>'; exit;
                // echo  $totalSalary; exit;

                $Increment = PayRollIncrement::where('user_id', $userData->id)->first();
                $netSalary = ($Increment) ? $Increment->Total_salary : $userData->net_salary;
                $PayRoll = new PayRoll;
                $PayRoll->net_salary = $netSalary;
                $PayRoll->basic = $totalperWiseBasic;
                $PayRoll->hra = $totalperWiseHra;
                $PayRoll->conveyance = $totalConveyanceWise;
                $PayRoll->leaves = $leaves;
                $PayRoll->workingdays = $checkAttendence;
                $PayRoll->deduction = $deduction;
                $PayRoll->allowance = $request->allowance;
                $PayRoll->net_paid = $net_paid;
                $PayRoll->tds = $totalperTds;
                $PayRoll->medical_allowance = $totalMedicalWise;
                $PayRoll->emp_id = $userData->id;
                $PayRoll->date = now();
                $PayRoll->save();
            }
            return redirect()->back()->with('success', 'Payroll generated successfully.');
        } else {

            return redirect()->back()->with('error', "This month's data has already been generated.");
        }
    }


    //Salary
    public function edit(Request $req)
    {
        $PayRoll = PayRoll::find($req->id);
        $User = User::select('first_name')->where('id', $PayRoll->emp_id)->where('type', 4)->first();
        return view('admin.Humanesources.PayRoll.edit', compact('PayRoll', 'User'));
    }

    public function Salary(Request $req)
    {
        // Get the current year and month
        $currentYear = date('Y');
        $currentMonth = date('m');

        $PayRoll = PayRoll::select('users.first_name', 'pay_rolls.net_salary', 'pay_rolls.net_paid', 'pay_rolls.id')
            ->join('users', 'users.id', 'pay_rolls.emp_id')
            ->where('users.type', 4)
            ->whereYear('pay_rolls.date', $currentYear)
            ->whereMonth('pay_rolls.date', $currentMonth)
            ->orderBy('pay_rolls.created_at', 'desc')
            ->paginate(10);

        return view('admin.Humanesources.PayRoll.Salary', compact('PayRoll'));
    }

    //Deduction
    public function Deduction(Request $req)
    {
        // Get the current year and month
        $currentYear = date('Y');
        $currentMonth = date('m');

        $PayRoll = PayRoll::select('users.first_name', 'pay_rolls.deduction', 'pay_rolls.id')
            ->join('users', 'users.id', 'pay_rolls.emp_id')
            ->where('users.type', 4)
            ->whereYear('pay_rolls.date', $currentYear)
            ->whereMonth('pay_rolls.date', $currentMonth)
            ->orderBy('pay_rolls.created_at', 'desc')
            ->paginate(10);
        return view('admin.Humanesources.PayRoll.Deduction', compact('PayRoll'));
    }

    //TDS
    public function TDS(Request $req)
    {
        // Get the current year and month
        $currentYear = date('Y');
        $currentMonth = date('m');

        $PayRoll = PayRoll::select('users.first_name', 'pay_rolls.tds', 'pay_rolls.id')
            ->join('users', 'users.id', 'pay_rolls.emp_id')
            ->where('users.type', 4)
            ->whereYear('pay_rolls.date', $currentYear)
            ->whereMonth('pay_rolls.date', $currentMonth)
            ->orderBy('pay_rolls.created_at', 'desc')
            ->paginate(10);

        return view('admin.Humanesources.PayRoll.TDS', compact('PayRoll'));
    }

    //RuleUpdate
    public function update(Request $req, $id)
    {
        $rule = PayRoll::find($id);
        $rule['net_salary'] = $req->net_salary;
        $rule['basic'] = $req->basic;
        $rule['hra'] = $req->hra;
        $rule['conveyance'] = $req->conveyance;
        $rule['leaves'] = $req->leaves;
        $rule['workingdays'] = $req->workingdays;
        $rule['deduction'] = $req->deduction;
        $rule['allowance'] = $req->allowance;
        $rule['tds'] = $req->tds;
        $rule['net_paid'] = $req->net_paid;
        $rule['medical_allowance'] = $req->medical_allowance;
        $rule->save();
        return redirect()->back()->with('success', "This Months PayRoll Update Successfully");
    }

    public function RuleUpdate(Request $req, $id)
    {
        $rule = Rule::find($id);
        $rule['basic'] = $req->basic;
        $rule['hra'] = $req->hra;
        $rule['conveyance'] = $req->conveyance;
        $rule['medical'] = $req->medical;
        $rule->save();

        $currentYear = date('Y');
        $currentMonth = date('m');

        $PayR = PayRoll::whereYear('date', $currentYear)
            ->whereMonth('date', $currentMonth)
            ->update([
                'basic' => $req->basic,
                'hra' => $req->hra,
                'conveyance' => $req->conveyance,
                'medical_allowance' => $req->medical
            ]);


        return redirect('admin/PayRoll/home')->with('success', "This Rules Update Successfully");
    }

    public function get_SallaryData(Request $request)
    {
        $year = $request->year;
        $month = $request->month;
        $PayRoll = PayRoll::select('users.first_name', 'pay_rolls.net_salary', 'pay_rolls.net_paid', 'pay_rolls.id')
            ->join('users', 'users.id', 'pay_rolls.emp_id')
            ->where('users.type', 4)
            ->where('date', 'LIKE', "$year-$month%")
            ->orderBy('pay_rolls.created_at', 'desc')
            ->paginate(10);

        $html = view('admin.Humanesources.PayRoll.ShowSallary', compact('PayRoll'))->with('success', "Data of: $year-$month Fetched Successfully");


        $data = $this->getCardData($year,$month);

        return response()->json([
            'success'=>true,
            'html'=>$html,
            'data'=>$data
        ]);
    }

    

    public function get_TdsData(Request $request)
    {
        $year = $request->year;
        $month = $request->month;
        $PayRoll = PayRoll::select('users.first_name', 'pay_rolls.tds', 'pay_rolls.id')
            ->join('users', 'users.id', 'pay_rolls.emp_id')
            ->where('users.type', 4)
            ->where('date', 'LIKE', "$year-$month%")
            ->orderBy('pay_rolls.created_at', 'desc')
            ->paginate(10);

        return view('admin.Humanesources.PayRoll.ShowTDS', compact('PayRoll'))->with('success', "Data of: $year-$month Fetched Successfully");
    }

    public function get_deductionData(Request $request)
    {
        $year = $request->year;
        $month = $request->month;
        $PayRoll = PayRoll::select('users.first_name', 'pay_rolls.deduction', 'pay_rolls.id')
            ->join('users', 'users.id', 'pay_rolls.emp_id')
            ->where('users.type', 4)
            ->where('date', 'LIKE', "$year-$month%")
            ->orderBy('pay_rolls.created_at', 'desc')
            ->paginate(10);

        return view('admin.Humanesources.PayRoll.ShowDeduction', compact('PayRoll'))->with('success', "Data of: $year-$month Fetched Successfully");
    }

    public function SallarySlip(Request $request, $id)
    {


        $PayRoll = PayRoll::select('users.first_name', 'users.last_name', 'users.profile_img', 'pay_rolls.workingdays', 'pay_rolls.basic', 'pay_rolls.deduction', 'pay_rolls.leaves', 'pay_rolls.net_salary', 'pay_rolls.net_paid', 'pay_rolls.id', 'pay_rolls.hra', 'pay_rolls.tds', 'pay_rolls.allowance', 'pay_rolls.conveyance', 'pay_rolls.medical_allowance')
            ->join('users', 'users.id', 'pay_rolls.emp_id')
            ->join('jobroles', 'users.id', 'pay_rolls.emp_id')
            ->where('users.type', 4)
            ->where('pay_rolls.id', $id)
            ->first();

        $JobRole = Jobroles::select('name')->where('assign_emp_id', 'LIKE', '%' . $id . '%')->first();

        return view('admin.Humanesources.PayRoll.SallarySlip', compact('PayRoll', 'JobRole'));
    }

    // ExportCSV
    public function EXPORTCSV(Request $request)
    {
        $agent = new Agent();

        // Get user agent information
        $browser = $agent->browser();
        $version = $agent->version($browser); // Pass the browser name as an argument

        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "PayRoll CSV Export  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/PayRoll/EXPORTCSV';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return Excel::download(new PayRollExport, 'PayRoll.csv');
    }
    ///////////GET SUNDAY OF PER MONTH
    function countSpecificDayInMonth($year, $month, $dayOfWeek)
    {
        $numDays = 0;

        $firstDay = new DateTime("$year-$month-01");
        $lastDay = new DateTime("$year-$month-" . date('t', strtotime("$year-$month-01")));

        $interval = new DateInterval('P1D');
        $period = new DatePeriod($firstDay, $interval, $lastDay->modify('+1 day'));

        foreach ($period as $day) {
            if ($day->format('N') == $dayOfWeek) {
                $numDays++;
            }
        }

        return $numDays;
    }
    function countDaysDynamically($value)
    {
        if ($value - floor($value) >= 0.5) {
            return floor($value) + 0.5;
        } else {
            return floor($value);
        }
    }
}