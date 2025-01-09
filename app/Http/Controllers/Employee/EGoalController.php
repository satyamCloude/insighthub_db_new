<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use App\Models\LogActivity;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Str;
use App\Models\Currency;
use App\Models\Jobroles;
use App\Models\Month;
use App\Models\User;
use App\Models\Goal;
use Hash;
use DB;
use Auth;

class EGoalController extends Controller
{   
        //home page
    public function home(Request $request)
    {
        $RoleAccess = \App\Models\RoleAccess::select('role_accesses.add', 'role_accesses.view', 'role_accesses.update', 'role_accesses.delete', 'permissions.name as per_name')
            ->join('employee_details', 'employee_details.job_role_id', '=', 'role_accesses.role_id')
            ->leftJoin('permissions', 'permissions.id', '=', 'role_accesses.permission_id')
            ->where('employee_details.user_id', Auth::user()->id)
            ->where(function ($query) {
                $query->where('role_accesses.view', '!=', null)
                    ->orWhere('role_accesses.add', '!=', null)
                    ->orWhere('role_accesses.update', '!=', null)
                    ->orWhere('role_accesses.delete', '!=', null);
            })
            ->get()
            ->toArray();
    
        $canViewGoal = array_search('Goal', array_column($RoleAccess, 'per_name')) !== false 
            && $RoleAccess[array_search('Goal', array_column($RoleAccess, 'per_name'))]['view'] > 0;
    
        if ($canViewGoal) {
            $searchTerm = $request->has('search') ? $request->input('search') : '';
    
            // Goals query
            $query = Goal::select(
                    'users.first_name',
                    'users.profile_img',
                    'users.email',
                    'goals.status',
                    'goals.employee_id',
                    'goals.id',
                    'goals.goal_value',
                    'goals.archieved_value',
                    'jobroles.name as job_name',
                    'goals.months_id as goalCreateMonth'
                )
                ->join('jobroles', 'jobroles.id', '=', 'goals.job_role_id')
                ->join('users', 'users.id', '=', 'goals.employee_id')
                ->where('goals.employee_id', Auth::user()->id) // Filter by authenticated user
                // ->join(DB::raw('(SELECT employee_id, MAX(date) as latest_created_at FROM goals GROUP BY employee_id) latest_goals'), function ($join) {
                //     $join->on('goals.employee_id', '=', 'latest_goals.employee_id')
                //         ->on('goals.date', '=', 'latest_goals.latest_created_at');
                // })
                ->groupBy('goals.employee_id', 'users.first_name', 'users.profile_img', 'users.email', 'goals.status', 'goals.id', 'jobroles.name', 'goals.months_id')
                ->latest('goals.date');
                
            // Search filter
            if ($searchTerm) {
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('users.first_name', 'like', '%' . $searchTerm . '%')
                        ->orWhere('goals.status', 'like', '%' . $searchTerm . '%')
                        ->orWhere('goals.goal_value', 'like', '%' . $searchTerm . '%')
                        ->orWhere('goals.archieved_value', 'like', '%' . $searchTerm . '%')
                        ->orWhere('jobroles.name', 'like', '%' . $searchTerm . '%');
                });
            }
    
            // Date range filter
            if ($request->has('from') && $request->has('to')) {
                $query->whereBetween('goals.date', [
                    $request->from . ' 00:00:00',
                    $request->to . ' 23:59:59'
                ]);
            }
    
            $Goal = $query->paginate(10);
            $Goal->appends(['search' => $searchTerm, 'from' => $request->from, 'to' => $request->to]);
    
            // Monthly Achiever query
            $currentMonth = date('m');

            // Monthly Achiever query
            $currentMonth = date('m'); // Get the current month in 'm' format (e.g., '12' for December)

            $monthlyAchiever = Goal::select(
                'users.first_name',
                'users.profile_img',
                'goals.employee_id',
                DB::raw('SUM(goals.goal_value) as total_goal_value'),
                DB::raw('SUM(goals.archieved_value) as total_archieved_value')
            )
            ->join('users', 'users.id', '=', 'goals.employee_id')
            ->where('goals.employee_id', Auth::user()->id) // Filter by authenticated user
            ->where('goals.months_id', '=', $currentMonth) // Filter by current month
            ->whereRaw('goals.archieved_value >= goals.goal_value') // Only consider entries where achieved value >= goal value
            ->groupBy('users.id', 'users.first_name', 'users.profile_img', 'goals.employee_id')
            ->orderByDesc('total_archieved_value') // Order by the highest achieved value
            ->first();

            // dd($monthlyAchiever);

            // Annual Achiever query
            $year = date('Y');

            $annualAchiever = Goal::select(
                    'users.first_name',
                    'users.profile_img',
                    'goals.employee_id',
                    DB::raw('SUM(goals.goal_value) as total_goal_value'),
                    DB::raw('SUM(goals.archieved_value) as total_achieved_value')
                )
                ->join('users', 'users.id', '=', 'goals.employee_id')
                ->where('goals.employee_id', Auth::user()->id) // Filter by authenticated user
                ->whereYear('goals.date', $year) // Filter for the current year
                ->whereRaw('goals.archieved_value >= goals.goal_value') // Only consider entries where achieved value >= goal value
                ->groupBy('goals.employee_id', 'users.first_name', 'users.profile_img') // Include selected columns in GROUP BY
                ->orderByDesc('total_goal_value') // Order by the highest goal value
                ->limit(1) // Limit to the top achiever
                ->first();

                $total_goal_value=0;
                $total_achieve_value=0;
                foreach ($Goal as $goal) {
                    // Access the sum for each row
                    $total_goal_value += $goal->goal_value;
                    $total_achieve_value += $goal->archieved_value;
                    // Do something with $total_goal_value
                }

                if($total_achieve_value > 0 && $total_goal_value >0){
                    $status = number_format(($total_achieve_value/$total_goal_value)*100,2);
                }else{
                    $status=0;
                }
    
            // Goal counts
            $TotalGoal = Goal::where('employee_id', Auth::user()->id)->count(); // Only count the user's goals
            $faild = Goal::where('employee_id', Auth::user()->id)->where('status', '1')->count();
            $inprogress = Goal::where('employee_id', Auth::user()->id)->where('status', '2')->count();
            $acheived = Goal::where('employee_id', Auth::user()->id)->where('status', '3')->count();
        }
    
        return view('Employee.sales.Goal.home', compact(
            'RoleAccess', 'Goal', 'monthlyAchiever', 'annualAchiever', 'status',
            'TotalGoal', 'total_goal_value', 'total_achieve_value', 'faild', 'inprogress', 'acheived', 'searchTerm'
        ));
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
        $Log['subject'] = "Goal Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Goal/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);
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

        $Currency = Currency::get();
        $Months = Month::get();
        $Employee = User::select('users.*','jobroles.name as desname')
            ->leftjoin('employee_details', 'employee_details.user_id','users.id')
            ->leftJoin('jobroles', 'jobroles.id', 'employee_details.jobrole_id')
            ->where('type',4)
            ->get();
            
        // return $Employee;
        $Jobroles = Jobroles::get();
        return view('Employee.sales.Goal.create',compact('Currency','Currency','Months','Employee','Jobroles','RoleAccess')); 
    }


        //home page
    public function store(Request $req)
    {
        $data = $req->all();
        $data['user_id'] = Auth::user()->id;
        $data['status'] = '1';

        $findJob = Jobroles::whereRaw("FIND_IN_SET(?, assign_emp_id)", [$req->employee_id])->first();
        $data['job_role_id'] = $findJob->id ?? null;

        // Assuming you have a column named 'months_id' in your $data array
        $monthsToAdd = $data['months_id'] ?? 1;
        // Use now() to get the current date and replace the month with monthsToAdd
        $data['date'] = now()->setMonth($monthsToAdd)->toDateString();

        Goal::create($data);

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Goal Data Store By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Goal/store';
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('Employee/Goal/home')->with('success', "New Goal Added Successfully");
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
        $Log['subject'] = "Goal Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Goal/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);
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
        $Goal = Goal::find($id);
        $Currency = Currency::get();
        $Months = Month::get();
        $Employee = User::select('first_name','id')->where('type',4)->get();
        $Jobroles = Jobroles::get();
        return view('Employee.sales.Goal.edit',compact('Goal','Currency','Months','Employee','Jobroles','RoleAccess')); 
    }

        //View
    public function view(Request $req,$id,$Empid)
    {
         $view = Goal::select('users.first_name','users.profile_img','goals.status','goals.months_id','goals.id','goals.employee_id','goals.goal_value','goals.archieved_value','jobroles.name as job_name','months.name as month_name')
            ->join('months','months.id','goals.months_id')
            ->join('jobroles','jobroles.id','goals.job_role_id')
            ->join('users','users.id','goals.employee_id')
            ->where('goals.id',$id)
            ->first();

         $Goal = Goal::select('users.first_name','users.profile_img','users.email','goals.status','goals.months_id','goals.id','goals.employee_id','goals.goal_value','goals.archieved_value','jobroles.name as job_name','months.name as month_name')
            ->join('jobroles','jobroles.id','goals.job_role_id')
            ->join('months','months.id','goals.months_id')
            ->join('users','users.id','goals.employee_id')
            ->orderBy('goals.created_at', 'desc')
            ->where('goals.employee_id',$Empid)
            ->get(); 
            $id = $id;
            $Empid = $Empid;

            $user = Goal::find($id);
        return view('Employee.sales.Goal.view',compact('user','view','Goal','Empid','id'));
    }
    
    public function getGoalDataDateWise(Request $request)
    {

        $fromDate = $request->input('fromDate');
        $toDate = $request->input('toDate');
        $Empid = $request->input('Empid');
        $id = $request->input('id');
        $goalData = Goal::select('users.first_name','users.profile_img','goals.status','goals.months_id','goals.id','goals.employee_id','goals.goal_value','goals.archieved_value','jobroles.name as job_name','months.name as month_name')
        ->join('jobroles','jobroles.id','goals.job_role_id')
        ->join('users','users.id','goals.employee_id')
        ->join('months','months.id','goals.months_id')
        ->where('goals.employee_id', $Empid)
        ->whereBetween('goals.date', [$fromDate, $toDate])
        ->orderBy('goals.created_at', 'desc')
        ->get();
        $view = Goal::select('users.first_name','users.profile_img','goals.status','goals.months_id','goals.id','goals.employee_id','goals.goal_value','goals.archieved_value','jobroles.name as job_name')
        ->join('jobroles','jobroles.id','goals.job_role_id')
        ->join('users','users.id','goals.employee_id')
        ->where('goals.id',$id)
        ->first();

        $Goal = Goal::select('users.first_name','users.profile_img','users.email','goals.status','goals.months_id','goals.id','goals.employee_id','goals.goal_value','goals.archieved_value','jobroles.name as job_name')
        ->join('jobroles','jobroles.id','goals.job_role_id')
        ->join('users','users.id','goals.employee_id')
        ->orderBy('goals.created_at', 'desc')
        ->where('goals.employee_id',$Empid)
        ->get(); 

        $data['fromDate']=$fromDate;
        $data['toDate']=$toDate;
        $data['id']=$id;
        $data['Empid']=$Empid;
        $data['goalData']=$goalData;
        $data['Goal']=$Goal;
        $data['view']=$view;

        return response()->json(array('data'=> $data), 200);

           // return view('Employee.sales.Goal.view',compact('view','Goal','goalData','Empid','id'));
    }

    public function editView(Request $req,$id,$Empid)
    {
         $agent = new Agent();
            $browser = $agent->browser();
            $version = $agent->version($browser);
            $Log = $req->all();
            $Log['user_id'] = Auth::user()->id;
            $Log['ip'] = $req->ip();
            $Log['subject'] = "Goal Edit Page is View By " . Auth::user()->first_name;
            $Log['url'] = url('/') . '/Employee/Goal/edit/'.$id;
            $Log['method'] = "Get";
            $Log['browser'] = $browser . "-" . $version;
            LogActivity::create($Log);

            $Goal = Goal::find($id);
            $Currency = Currency::get();
            $Months = Month::get();
            $Employee = User::select('first_name','id')->where('type',4)->get();
            $Jobroles = Jobroles::get();
            return view('Employee.sales.Goal.editView',compact('Goal','Currency','Months','Employee','Jobroles')); 
    }

        //updated
    public function update(Request $req,$id)
    {

        $goal_value = $req->goal_value;
        $archieved_value = $req->archieved_value;

        if ($goal_value != 0) {
            $percentage = ($archieved_value / $goal_value) * 100;
        } else {
            $percentage = 0;
        }

        $data =Goal::find($id);
        $data['employee_id'] = $req->employee_id;
        $data['job_role_id'] = $req->job_role_id;
        $data['goal_value'] = $req->goal_value;
        $data['currency_id'] = $req->currency_id;
        $data['months_id'] = $req->months_id;
        if ($percentage >= 100) {
            $data['status'] = '3';
        } elseif ($percentage > 2 && $percentage <= 99) {
            $data['status'] = '2';
        } elseif ($percentage == 1 || $percentage == 0) {
            $data['status'] = '1';
        }
        $data['archieved_value'] = $req->archieved_value;
        $data['note'] = $req->note;

        $findJob = Jobroles::whereRaw("FIND_IN_SET(?, assign_emp_id)", [$req->employee_id])->first();
        $data['job_role_id'] = $findJob->id ?? null;

        $data->save();    

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Goal Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Goal/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);    


        return redirect('Employee/Goal/home')->with('success', "Goal Edited Successfully");
    }

        // delete Goal
    public function delete(Request $request,$id)
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Goal Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Goal/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        Goal::find($id)->delete();
        return redirect('Employee/Goal/home')->with('success', "Goal Deleted Successfully");
    }

    
    public function FromToDate(Request $request)
    {

        $Goal = Goal::select('users.first_name','users.profile_img', 'goals.status', 'goals.id', 'goals.goal_value', 'goals.archieved_value', 'jobroles.name as job_name')
        ->join('jobroles', 'jobroles.id', 'goals.job_role_id')
        ->join('users', 'users.id', 'goals.employee_id')
            ->whereBetween('goals.date', [$request->fromDate, $request->toDate]) // Use whereBetween for date range
        ->orderBy('goals.created_at', 'desc')
        ->groupBy('goals.employee_id')
        ->get();

        return view('Employee.sales.Goal.Show_leads_yeardata', compact('Goal'));
    }

      // get_Goal_data Goal
    public function get_Goal_data(Request $request)
    {
        $year = $request->year;
        $month = $request->month;
        $Empid = $request->Empid;

        $Goal  = Goal::select('users.first_name','users.profile_img','goals.status','goals.id','goals.goal_value','goals.archieved_value','jobroles.name as job_name')
        ->join('jobroles','jobroles.id','goals.job_role_id')
        ->join('users','users.id','goals.employee_id')
        ->where('goals.date', 'LIKE', "$year-$month%")
        ->orderBy('goals.created_at', 'desc')
        ->where('goals.employee_id',$Empid)
        ->get();
                return view('Employee.sales.Goal.Show_leads_yeardata', compact('Goal'))->with('success', "Data of: $year-$month Fetched Successfully");
    }

}


