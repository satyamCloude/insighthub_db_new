<?php

namespace App\Http\Controllers\Employee;


use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller; 
use App\Models\PerformanceCategory;
use Illuminate\Support\Collection;
use App\Models\PerformanceRating;
use App\Models\PerformanceSettings;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use Illuminate\Support\Str;
use App\Models\Performance;
use App\Models\Attendence;
use App\Models\Project;
use App\Models\Employee;
use App\Models\Department;
use App\Models\User;
use App\Models\Task;
use App\Models\Leads;
use App\Models\Goal;
use App\Models\Leave;
use App\Models\Quotes;
use Carbon\Carbon;
use Hash;
use DB;
use Auth;


class EPerformanceController extends Controller
{   
    //home page
   public function home()
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
    
        if($RoleAccess[array_search('Performance', array_column($RoleAccess, 'per_name'))]['view'] == 1)
        {
               $Performance = Performance::groupBy('employee_id')
                ->select('employee_id', \DB::raw('MAX(created_at) as max_created_at'))
                ->whereNull('deleted_at')
                ->orderBy('max_created_at', 'desc')
                ->paginate(10);
            
        }

        if($RoleAccess[array_search('Performance', array_column($RoleAccess, 'per_name'))]['view'] == 2)
        {
               $Performance = Performance::groupBy('employee_id')
                ->select('employee_id', \DB::raw('MAX(created_at) as max_created_at'))
                ->whereNull('deleted_at')
                ->orderBy('max_created_at', 'desc')
                ->where('employee_id',Auth::user()->id)
                ->paginate(10);
                    
        }

        $PerformanceCategory = PerformanceCategory::get();
        $PerformanceRating = PerformanceRating::get();
        return view('Employee.Humanesources.Performance.home', compact('RoleAccess','Performance','PerformanceCategory','PerformanceRating'));
    }



    //home page
    public function Create(Request $request)
    {   
        $Employee = User::select('first_name','id')->where('type',4)->get();
         $PerformanceCategory = PerformanceCategory::get();
        $PerformanceRating = PerformanceRating::get();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Performance Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Performance/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('Employee.Humanesources.Performance.create',compact('Employee','PerformanceCategory','PerformanceRating')); 
    }


    //home page
    public function store(Request $req)
    {
        // return $req->all();

        $categorys = $req->categorytotal;
        $ratings = $req->ratingtotal;

        $total = $categorys * $ratings;
            $rating = 0 ;

        foreach ($req->comments as $key => $value) {
            $totalratiing = 'rating'.$key+1;
            $rating += $req->$totalratiing;
        }

        $data = $req->all();
        $data['totalrating'] = $rating.'/'.$total;
        $data['user_id'] = Auth::user()->id;
        $data['date'] = now();
        $data['comments'] = $req->has('comments') ? $req->input('comments') : [];
        $data['comments'] = implode(',', $data['comments']);
        Performance::create($data);

            $agent = new Agent();
            $browser = $agent->browser();
            $version = $agent->version($browser);
            $Log = $req->all();
            $Log['user_id'] = Auth::user()->id;
            $Log['ip'] = $req->ip();
            $Log['subject'] = "Performance Data Store By " . Auth::user()->first_name;
            $Log['url'] = url('/') . '/Employee/Performance/store';
            $Log['method'] = "Post";
            $Log['browser'] = $browser . "-" . $version;
            LogActivity::create($Log);

        return redirect('Employee/Performance/home')->with('success', "New Performance Added Successfully");
    }
public function view(Request $request,$id)
    {
        $id = $id;
          $Performance = User::select('users.first_name','users.last_name','users.id','users.email','users.profile_img','departments.name as departments_name')
                        ->leftjoin('employee_details','employee_details.user_id','users.id')
                        ->leftjoin('departments','departments.id','employee_details.department_id')
                        ->where('users.type', 4)
                        ->where('users.id',$id)
                        ->orderBy('users.id','desc')
                        ->paginate(10);
        $user_details = User::find($id);
        $PerformanceCategory = PerformanceCategory::get();
        $PerformanceRating = PerformanceRating::get();
       
        $empname = User::select('users.first_name','users.last_name','employee_details.department_id','users.id','roles.name')
                    ->leftjoin('employee_details','employee_details.user_id','users.id')
                    ->leftjoin('roles','roles.id','employee_details.admin_type_id')
                    ->where('employee_details.user_id',$id)
                    ->first();
        $HR = User::select('first_name','last_name')->leftjoin('employee_details','employee_details.user_id','users.id')->where('employee_details.admin_type_id',2)->first();

        $Reviewer = User::select('first_name','last_name')->where('id',$id)->first();
        $Departname = Department::select('name')->where('id',$empname->department_id)->first();

        $PreS = PerformanceSettings::where('id',1)->first();

        $currentDate = Carbon::now();
        if($PreS->status == 1)
        {
            $peroid = "Quarterly";
            $beforeSixMonthsDate = Carbon::now()->subMonths(3);
        }
        if($PreS->status == 2)
        {
            $peroid = "Annual";
            $beforeSixMonthsDate = Carbon::now()->subYear();
        }

        $TotalTaskComplete = Task::where('AssignedTo', 'LIKE', '%' . $id . '%')
            ->where('status_id', 2)
            ->whereBetween('startDate', [$beforeSixMonthsDate, $currentDate])
            ->count();

        $TotalTaskAssigned = Task::where('AssignedTo', 'LIKE', '%' . $id . '%')
            ->whereBetween('startDate', [$beforeSixMonthsDate, $currentDate])
            ->count();
        

        $TotalProjectComplete = Project::where('team_id', 'LIKE', '%' . $id . '%')
            ->where('status_id', 2)
            ->whereBetween('start_date', [$beforeSixMonthsDate, $currentDate])
            ->count();


        $TotalProjectAssigned = Project::where('team_id', 'LIKE', '%' . $id . '%')
            ->whereBetween('start_date', [$beforeSixMonthsDate, $currentDate])
            ->count();

        $TotalGoalComplete = Goal::where('employee_id', 'LIKE', '%' . $id . '%')
            ->where('status', 3)
            ->whereBetween('date', [$beforeSixMonthsDate, $currentDate])
            ->count();

        $TotalGoalAssigned = Goal::where('employee_id', 'LIKE', '%' . $id . '%')
            ->whereBetween('date', [$beforeSixMonthsDate, $currentDate])
            ->count();

        $TotalLeadComplete = Leads::where('assignedto', 'LIKE', '%' . $id . '%')
            ->where('status', 2)
            ->whereBetween('date', [$beforeSixMonthsDate, $currentDate])
            ->count();
        $TotalLeadAssigned = Leads::where('assignedto', 'LIKE', '%' . $id . '%')
            ->whereBetween('date', [$beforeSixMonthsDate, $currentDate])
            ->count();

        $TotalQuotesComplete = Quotes::where('user_id', 'LIKE', '%' . $id . '%')
            ->where('status', 5)
            ->whereBetween('date_created', [$beforeSixMonthsDate, $currentDate])
            ->count();

        $TotalQuotesAssigned = Quotes::where('user_id', 'LIKE', '%' . $id . '%')
            ->whereBetween('date_created', [$beforeSixMonthsDate, $currentDate])
            ->count();

        $TotalAttendence = Attendence::where('emp_Id', 'LIKE', '%' . $id . '%')
            ->whereBetween('punch_date', [$beforeSixMonthsDate, $currentDate])
            ->groupBy('punch_date')
            ->count();

        $threeMonthsAgo = $currentDate->clone()->subMonths(3);
        $totalDays = $currentDate->diffInDays($threeMonthsAgo);
        return view('Employee.Humanesources.Performance.view',compact('empname','Departname','Reviewer','HR','TotalTaskComplete','TotalTaskAssigned','id','peroid','TotalProjectComplete','TotalProjectAssigned','TotalGoalComplete','TotalGoalAssigned','TotalLeadComplete','TotalLeadAssigned','TotalQuotesComplete','TotalQuotesAssigned','user_details','totalDays','TotalAttendence','PreS','id','Performance')); 
       
}
     public function views2(Request $request,$id)
    {
        $Performance = Performance::where('employee_id',$id)->get();
        $Perf = Performance::where('employee_id',$id)->first();

        $empname = User::select('users.first_name','users.last_name','users.id','users.login_email','employee_details.department_id','jobroles.name as desg')
                    ->leftjoin('employee_details','employee_details.user_id','users.id')
                    ->leftjoin('jobroles','employee_details.jobrole_id','jobroles.id')
                    ->where('employee_details.user_id',$Perf->employee_id)
                    ->first();

        $Reviewer = User::select('first_name')->where('id',$Perf->user_id)->first();
        $Departname = Department::select('name')->where('id',$empname->department_id)->first();
        return view('Employee.Humanesources.Performance.view',compact('Performance','Perf','empname','Departname','Reviewer')); 
    }

     public function get_Performance_yeardata(Request $request)
     {
        $Perf = Performance::find($request->id);

        $year = $request->year;
            $month = $request->month;

            $Performance  = Performance::where('year', 'LIKE', "$year")->where('evaluation_period', 'LIKE', "$month")->orderBy('created_at', 'desc')->paginate(10);

        return view('Employee.Humanesources.Performance.get_Performance_yeardata',compact('Performance')); 
     }

}
