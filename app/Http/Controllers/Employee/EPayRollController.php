<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PayRollExport;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Str;
use App\Models\LogActivity;
use App\Models\LeaveType;
use App\Models\PayRoll;
use App\Models\Jobroles;
use App\Models\RoleAccess;
use App\Models\User;
use App\Models\Rule;
use App\Models\EmployeeDetail;
use App\Models\Currency;
use Hash;
use Auth;
use DB;
use Illuminate\Support\Facades\Log;


class EPayRollController extends Controller
{   
    //home page
   public function home(Request $request)
    {
        $currentYear = date('Y');
        $currentMonth = date('m');

        $role = EmployeeDetail::where('user_id',Auth::user()->id)->value('job_role_id');

        if($role == 2){
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


                
                return view('Employee.Humanesources.PayRoll.HR.home',compact('payrolls', 'Rules', 'totalEmp', 'empTotalPercent', 'totalWorkingHours', 'empTotalWorkHrs', 'totalPayrollCost', 'payrollCostChange', 'totalNetSalary', 'netSalaryChange', 'totalNetDeduction', 'netDeductionChange', 'totalNetTds', 'netTdsChange', 'currency'));
        } else{
            $currentYear = date('Y');
        $currentMonth = date('m');

        $role = EmployeeDetail::where('user_id',Auth::user()->id)->value('job_role_id');

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
                                    ->where('pay_rolls.emp_id',Auth::user()->id)
            ->whereYear('pay_rolls.date', $currentYear)
            ->whereMonth('pay_rolls.date', $currentMonth)
            ->when($search, function ($query) use ($search) {
                $query->where('users.first_name', 'like', '%' . $search . '%');
            })
            ->groupBy('users.id')
            ->orderBy('pay_rolls.id', 'desc')
            ->paginate(10);


            
            return view('Employee.Humanesources.PayRoll.home', compact('payrolls', 'Rules', 'totalEmp', 'empTotalPercent', 'totalWorkingHours', 'empTotalWorkHrs', 'totalPayrollCost', 'payrollCostChange', 'totalNetSalary', 'netSalaryChange', 'totalNetDeduction', 'netDeductionChange', 'totalNetTds', 'netTdsChange', 'currency'));
        
        }
        
    }
    
    
    public function view(Request $request,$id){
        $user_id = $id;
        $payrolls = PayRoll::where('pay_rolls.emp_id',$id)
                    ->join('users', 'users.id', 'pay_rolls.emp_id')
                    ->select('pay_rolls.*','users.first_name')
                    ->get();
        return view('Employee.Humanesources.PayRoll.HR.view',compact('payrolls','user_id'));
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

        return view('Employee.Humanesources.PayRoll.HR.empPayroll', compact('payrolls'))->with('success', "Data of: $year-$month Fetched Successfully");
        
    }
    

public function getCardData($currentYear, $currentMonth) {
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
$totalCurrentAndPrevious = ($totalWorkingHours ?: 0) + ($totalWorkingHoursLastThreeMonths ?: 0);

// Calculate percentage change in total working hours since the last quarter
$empTotalWorkHrs = 0;
if ($totalWorkingHoursLastThreeMonths !== 0 && $totalCurrentAndPrevious > 0) {
    $empTotalWorkHrs = (($totalWorkingHours - $totalWorkingHoursLastThreeMonths) / $totalCurrentAndPrevious) * 100;
}

// Calculate the total payroll cost for the current month
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

// Log the values to check before calculation
Log::info('Total Payroll Cost: ' . $totalPayrollCost);
Log::info('Total Payroll Cost Last Month: ' . $totalPayrollCostLastMonth);

// Calculate the percentage change in net Payroll cost
$payrollCostChange = 0;
if ($totalPayrollCostLastMonth > 0) {
    $payrollCostChange = (($totalPayrollCost - $totalPayrollCostLastMonth) / $totalPayrollCostLastMonth) * 100;
} else {
    // Handle the case where $totalPayrollCostLastMonth is zero
    Log::warning('Total Payroll Cost Last Month is zero, division avoided.');
    // Depending on your business logic, you may want to handle this differently
    $payrollCostChange = ($totalPayrollCost > 0) ? 100 : 0; // Example: Set to 100% if there's an increase, or 0% if no cost
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

    // Log the values to check before calculation
    Log::info('Total Net Salary: ' . $totalNetSalary);
    Log::info('Total Net Salary Last Month: ' . $totalNetSalaryLastMonth);

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

    // Log the values to check before calculation
    Log::info('Total Net Deduction: ' . $totalNetDeduction);
    Log::info('Total Net Deduction Last Month: ' . $totalNetDeductionLastMonth);

    // Calculate the percentage change in net deductions
    $netDeductionChange = 0;
    if ($totalNetDeductionLastMonth !== 0) {
        $netDeductionChange = (($totalNetDeduction - $totalNetDeductionLastMonth) / $totalNetDeductionLastMonth) * 100;
    }

    // Calculate the total net TDS
    $totalNetTds = PayRoll::where('users.type', 4)
        ->join('users', 'users.id', 'pay_rolls.emp_id')
        ->whereYear('pay_rolls.date', $currentYear)
        ->whereMonth('pay_rolls.date', $currentMonth)
        ->sum('pay_rolls.tds');

    // Get the total net TDS for the last month
    $totalNetTdsLastMonth = PayRoll::where('users.type', 4)
        ->join('users', 'users.id', 'pay_rolls.emp_id')
        ->whereYear('pay_rolls.date', $currentYear)
        ->whereMonth('pay_rolls.date', $currentMonth - 1)
        ->sum('pay_rolls.tds');

    // Log the values to check before calculation
    Log::info('Total Net TDS: ' . $totalNetTds);
    Log::info('Total Net TDS Last Month: ' . $totalNetTdsLastMonth);

    // Calculate the percentage change in net TDS
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


    public function GenerateSellary()
    {

        // Get the current year and month
        $currentYear = date('Y');
        $currentMonth = date('m');

        $PayR = PayRoll::whereYear('date', $currentYear)
                ->whereMonth('date', $currentMonth)
                ->count();

            if($PayR == 0)
            {
              $User = User::select('users.id', 'employee_details.net_salary')
                ->join('employee_details', 'employee_details.user_id', 'users.id')
                ->where('users.type', 4)
                ->get();

                foreach ($User as $userData) {
                    $PayRoll = new PayRoll;
                    $PayRoll->net_salary = $userData->net_salary;
                    $PayRoll->emp_id = $userData->id;
                    $PayRoll->date = now();  // Set the current date
                    $PayRoll->save();
                }

                return redirect()->back()->with('success','Generate Data  Successfully');

            }else{

                return redirect()->back()->with('error','This Months Data Generated Already');
            
            }   
       
    }

    
    //Salary
    public function edit(Request $req)
    {
        $PayRoll = PayRoll::find($req->id);
        $User = User::select('first_name')->where('id',$PayRoll->emp_id)->where('type',4)->first();
        return view('Employee.Humanesources.PayRoll.edit',compact('PayRoll','User'));
    }

    public function Salary(Request $req)
    {
         // Get the current year and month
        $currentYear = date('Y');
        $currentMonth = date('m');
        
        $role = EmployeeDetail::where('user_id',Auth::user()->id)->value('job_role_id');


        if($role == 2){
            $PayRoll = PayRoll::select('users.first_name', 'pay_rolls.net_salary', 'pay_rolls.net_paid', 'pay_rolls.id')
            ->join('users', 'users.id', 'pay_rolls.emp_id')
            ->where('users.type', 4)
            ->whereYear('pay_rolls.date', $currentYear)
            ->whereMonth('pay_rolls.date', $currentMonth)
            ->orderBy('pay_rolls.created_at', 'desc')
            ->paginate(10);
            return view('Employee.Humanesources.PayRoll.HR.Salary',compact('PayRoll'));
        } else{
            $PayRoll = PayRoll::select('users.first_name', 'pay_rolls.net_salary', 'pay_rolls.net_paid', 'pay_rolls.id')
            ->join('users', 'users.id', 'pay_rolls.emp_id')
            ->where('users.type', 4)
            ->where('pay_rolls.emp_id',Auth::user()->id)
            ->whereYear('pay_rolls.date', $currentYear)
            ->whereMonth('pay_rolls.date', $currentMonth)
            ->orderBy('pay_rolls.created_at', 'desc')
            ->paginate(10);
            
             return view('Employee.Humanesources.PayRoll.Salary',compact('PayRoll'));
                    
        }
    }

    //Deduction
    public function Deduction(Request $req)
    {
         // Get the current year and month
        $currentYear = date('Y');
        $currentMonth = date('m');

        $role = EmployeeDetail::where('user_id',Auth::user()->id)->value('job_role_id');

        if($role == 2)
        {
            $PayRoll = PayRoll::select('users.first_name', 'pay_rolls.deduction','pay_rolls.id')
            ->join('users', 'users.id', 'pay_rolls.emp_id')
            ->where('users.type', 4)
            ->whereYear('pay_rolls.date', $currentYear)
            ->whereMonth('pay_rolls.date', $currentMonth)
            ->orderBy('pay_rolls.created_at', 'desc')
            ->paginate(10);
            return view('Employee.Humanesources.PayRoll.HR.Deduction',compact('PayRoll'));
        } else {
            $PayRoll = PayRoll::select('users.first_name', 'pay_rolls.deduction','pay_rolls.id')
            ->join('users', 'users.id', 'pay_rolls.emp_id')
            ->where('users.type', 4)
            ->where('pay_rolls.emp_id',Auth::user()->id)
            ->whereYear('pay_rolls.date', $currentYear)
            ->whereMonth('pay_rolls.date', $currentMonth)
            ->orderBy('pay_rolls.created_at', 'desc')
            ->paginate(10);
            return view('Employee.Humanesources.PayRoll.Deduction',compact('PayRoll'));
        }


        
        
    }

    //TDS
    public function TDS(Request $req)
    {
         // Get the current year and month
        $currentYear = date('Y');
        $currentMonth = date('m');
        
        $role = EmployeeDetail::where('user_id',Auth::user()->id)->value('job_role_id');

        if($role == 2)
        {
            $PayRoll = PayRoll::select('users.first_name', 'pay_rolls.tds','pay_rolls.id')
            ->join('users', 'users.id', 'pay_rolls.emp_id')
            ->where('users.type', 4)
            ->whereYear('pay_rolls.date', $currentYear)
            ->whereMonth('pay_rolls.date', $currentMonth)
            ->orderBy('pay_rolls.created_at', 'desc')
            ->paginate(10);
            
            return view('Employee.Humanesources.PayRoll.HR.TDS',compact('PayRoll'));
        }

        else
        {
            $PayRoll = PayRoll::select('users.first_name', 'pay_rolls.tds','pay_rolls.id')
            ->join('users', 'users.id', 'pay_rolls.emp_id')
            ->where('users.type', 4)
            ->where('pay_rolls.emp_id',Auth::user()->id)
            ->whereYear('pay_rolls.date', $currentYear)
            ->whereMonth('pay_rolls.date', $currentMonth)
            ->orderBy('pay_rolls.created_at', 'desc')
            ->paginate(10);

            return view('Employee.Humanesources.PayRoll.HR.TDS',compact('PayRoll'));    
        }

        

        
    }

    //RuleUpdate
    public function update(Request $req,$id)
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

    public function RuleUpdate(Request $req,$id)
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


        return redirect('Employee/PayRoll/home')->with('success', "This Rules Update Successfully");
    }

    public function get_SallaryData(Request $request)
     {
         $year = $request->year;
         $month = $request->month;

         $role = EmployeeDetail::where('user_id',Auth::user()->id)->value('job_role_id');

        if($role == 2){
           $year = $request->year;
        $month = $request->month;
        $PayRoll = PayRoll::select('users.first_name', 'pay_rolls.net_salary', 'pay_rolls.net_paid', 'pay_rolls.id')
            ->join('users', 'users.id', 'pay_rolls.emp_id')
            ->where('users.type', 4)
            ->where('date', 'LIKE', "$year-$month%")
            ->orderBy('pay_rolls.created_at', 'desc')
            ->paginate(10);

        $html = view('Employee.Humanesources.PayRoll.HR.ShowSallary', compact('PayRoll'))->with('success', "Data of: $year-$month Fetched Successfully");


        $data = $this->getCardData($year,$month);

        return response()->json([
            'success'=>true,
            'html'=>$html,
            'data'=>$data
        ]);
            
           
        }else{
            $PayRoll = PayRoll::select('users.first_name', 'pay_rolls.net_salary', 'pay_rolls.net_paid', 'pay_rolls.id')
            ->join('users', 'users.id', 'pay_rolls.emp_id')
            ->where('users.type', 4)
            ->where('pay_rolls.emp_id',Auth::user()->id)
            ->where('date', 'LIKE', "$year-$month%")
            ->orderBy('pay_rolls.created_at', 'desc')
            ->paginate(10);          
            
            return view('Employee.Humanesources.PayRoll.ShowSallary', compact('PayRoll'))->with('success', "Data of: $year-$month Fetched Successfully");
        }

         
     }

     public function get_TdsData(Request $request)
     {
         $year = $request->year;
         $month = $request->month;
       $PayRoll = PayRoll::select('users.first_name', 'pay_rolls.tds', 'pay_rolls.id')
            ->join('users', 'users.id', 'pay_rolls.emp_id')
            ->where('users.type', 4)
            ->where('date', 'LIKE', "$year-$month%")
            ->where('pay_rolls.emp_id',Auth::user()->id)
            ->orderBy('pay_rolls.created_at', 'desc')
            ->paginate(10);

         return view('Employee.Humanesources.PayRoll.ShowTDS', compact('PayRoll'))->with('success', "Data of: $year-$month Fetched Successfully");
     }

     public function get_deductionData(Request $request)
     {
         $year = $request->year;
         $month = $request->month;
       $PayRoll = PayRoll::select('users.first_name', 'pay_rolls.deduction', 'pay_rolls.id')
            ->join('users', 'users.id', 'pay_rolls.emp_id')
            ->where('users.type', 4)
            ->where('date', 'LIKE', "$year-$month%")
            ->where('pay_rolls.emp_id',Auth::user()->id)
            ->orderBy('pay_rolls.created_at', 'desc')
            ->paginate(10);

         return view('Employee.Humanesources.PayRoll.ShowDeduction', compact('PayRoll'))->with('success', "Data of: $year-$month Fetched Successfully");
     }

     public function SallarySlip(Request $request,$id)
     {
       
            
            $PayRoll = PayRoll::select('users.first_name','users.last_name','users.profile_img','pay_rolls.workingdays','pay_rolls.basic','pay_rolls.deduction','pay_rolls.leaves','pay_rolls.net_salary','pay_rolls.net_paid','pay_rolls.id','pay_rolls.hra','pay_rolls.tds','pay_rolls.allowance','pay_rolls.conveyance','pay_rolls.medical_allowance')
            ->join('users', 'users.id', 'pay_rolls.emp_id')
            ->join('jobroles', 'users.id', 'pay_rolls.emp_id')
            ->where('users.type', 4)
            ->where('pay_rolls.id',$id)
            ->first(); 

            $JobRole = JobRoles::select('name')->where('assign_emp_id', 'LIKE', '%' . $id . '%')->first();

         return view('Employee.Humanesources.PayRoll.SallarySlip', compact('PayRoll','JobRole'));
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
            $Log['url'] = url('/') . '/Employee/PayRoll/EXPORTCSV';
            $Log['method'] = "Get";
            $Log['browser'] = $browser . "-" . $version;
            LogActivity::create($Log);

            return Excel::download(new PayRollExport, 'PayRoll.csv');
        }


}
