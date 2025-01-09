<?php

namespace App\Http\Controllers\admin;

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
use App\Models\Orders;
use App\Models\Goal;
use Hash;
use Auth;
use DB;


class GoalController extends Controller
{   
    //home page
    public function home(Request $request)
    {
        
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
            ->join('jobroles', 'jobroles.id', 'goals.job_role_id')
            ->join('users', 'users.id', 'goals.employee_id')
            ->join(DB::raw('(SELECT employee_id, MAX(date) as latest_created_at FROM goals GROUP BY employee_id) latest_goals'), function($join) {
                $join->on('goals.employee_id', '=', 'latest_goals.employee_id')
                    ->on('goals.date', '=', 'latest_goals.latest_created_at');
            })
            ->groupBy('goals.employee_id')
            ->latest('goals.date');

            $searchTerm = $request->input('search');

            // Check if a search term is provided
            if ($searchTerm) {
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('users.first_name', 'like', '%' . $searchTerm . '%')
                    ->orWhere('goals.status', 'like', '%' . $searchTerm . '%')
                    ->orWhere('goals.goal_value', 'like', '%' . $searchTerm . '%')
                    ->orWhere('goals.archieved_value', 'like', '%' . $searchTerm . '%')
                    ->orWhere('jobroles.name', 'like', '%' . $searchTerm . '%');
                });
            }

                // Check if both from and to dates are provided
            if ($request->has('from') && $request->has('to')) {
                $query->whereBetween('goals.date', [
                    $request->from . ' 00:00:00',
                    $request->to . ' 23:59:59'
                ]);
            }

            $Goal = $query->paginate(10);
            $Goal->appends(['search' => $searchTerm, 'from' => $request->from, 'to' => $request->to]);

            $currentMonth = date('m'); // Get the current month as a number (01-12)
            
            $monthlyAchiever = Goal::select(
                    'users.first_name',
                    'users.profile_img',
                    'goals.employee_id',
                    DB::raw('SUM(goals.goal_value) as total_goal_value'),
                    DB::raw('SUM(goals.archieved_value) as total_archieved_value')
                )
                ->join('users', 'users.id', '=', 'goals.employee_id')
                ->where('goals.months_id', $currentMonth) // Filter for the current month
                ->groupBy('users.id', 'users.first_name', 'users.profile_img', 'goals.employee_id')
                ->havingRaw('SUM(goals.archieved_value) >= SUM(goals.goal_value)') // Condition for achieving or exceeding the goal
                ->orderByDesc('total_archieved_value') // Order by the highest achieved value
                ->first();

            $year = date('Y');
            // echo $currentMonth.'/'.$year;die;
            $annualAchiever = Goal::select(
                    'users.first_name',
                    'users.profile_img',
                    'goals.employee_id',
                    DB::raw('SUM(goals.goal_value) as total_goal_value'),
                    DB::raw('SUM(goals.archieved_value) as total_achieved_value')
                )
                ->join('users', 'users.id', '=', 'goals.employee_id')
                ->whereYear('goals.date', $year)
                ->groupBy('goals.employee_id', 'users.first_name', 'users.profile_img') // Include selected columns in GROUP BY
                ->havingRaw('SUM(goals.archieved_value) >= SUM(goals.goal_value)') // Condition for achieving or exceeding goal
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

            $TotalGoal = Goal::count();
            $faild = Goal::where('status', '1')->count();
            $inprogress = Goal::where('status', '2')->count();
            $acheived = Goal::where('status', '3')->count();

        return view('admin.sales.Goal.home', compact('status','annualAchiever','monthlyAchiever','total_goal_value','total_achieve_value','Goal', 'TotalGoal', 'faild', 'inprogress', 'acheived','searchTerm'));

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
        $Log['url'] = url('/') . '/admin/Goal/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);


        $Currency = Currency::get();
        $Months = Month::get();
        $Employee = User::select('users.*','jobroles.name as desname')
        ->leftjoin('employee_details', 'employee_details.user_id','users.id')
        ->leftJoin('jobroles', 'jobroles.id', 'employee_details.jobrole_id')
        ->where('type',4)
        ->get();
        
        // return $Employee;
        $Jobroles = Jobroles::get();
        return view('admin.sales.Goal.create',compact('Currency','Months','Employee','Jobroles')); 
    }


    //home page
    public function store(Request $req)
    {
        $data = $req->all();
        $data['user_id'] = Auth::user()->id;
        $data['status'] = '2';

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
        $Log['url'] = url('/') . '/admin/Goal/store';
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('admin/Goal/home')->with('success', "New Goal Added Successfully");
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
        $Log['url'] = url('/') . '/admin/Goal/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        $Goal = Goal::find($id);
        $Currency = Currency::get();
        $Months = Month::get();
        $Employee = User::select('first_name','id')->where('type',4)->get();
        $Jobroles = Jobroles::get();
        return view('admin.sales.Goal.edit',compact('Goal','Currency','Months','Employee','Jobroles')); 
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
         return view('admin.sales.Goal.view',compact('view','Goal','Empid','id'));
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
        $Log['url'] = url('/') . '/admin/Goal/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        $Goal = Goal::find($id);
        $Currency = Currency::get();
        $Months = Month::get();
        $Employee = User::select('first_name','id')->where('type',4)->get();
        $Jobroles = Jobroles::get();
        return view('admin.sales.Goal.editView',compact('Goal','Currency','Months','Employee','Jobroles')); 
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

           // return view('admin.sales.Goal.view',compact('view','Goal','goalData','Empid','id'));
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
        // $data['job_role_id'] = $req->job_role_id;
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
        $Log['url'] = url('/') . '/admin/Goal/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);    


        return redirect('admin/Goal/home')->with('success', "Goal Edited Successfully");
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
        $Log['url'] = url('/') . '/admin/Goal/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        Goal::find($id)->delete();
        return redirect('admin/Goal/home')->with('success', "Goal Deleted Successfully");
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
        return view('admin.sales.Goal.Show_leads_yeardata', compact('Goal'))->with('success', "Data of: $year-$month Fetched Successfully");
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

        return view('admin.sales.Goal.Show_leads_yeardata', compact('Goal'));
    }


}


