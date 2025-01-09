<?php

namespace App\Http\Controllers\admin;

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


class PerformanceController extends Controller
{   
    //home page

    public function home()
    {
        $Performance = User::select('users.first_name','users.last_name','users.id','users.email','users.profile_img','departments.name as departments_name','employee_details.jobrole_id')
                        ->leftjoin('employee_details','employee_details.user_id','users.id')
                        ->leftjoin('departments','departments.id','employee_details.department_id')
                        ->where('users.type', 4)
                        ->paginate(10);

        $PerformanceCategory = PerformanceCategory::get();
        $PerformanceRating = PerformanceRating::get();
       
                
        return view('admin.Humanesources.Performance.home', compact('Performance','PerformanceCategory','PerformanceRating'));
    }
    public function home2()
    {
        // $Performance = Performance::groupBy('employee_id')
        // ->select('employee_id', \DB::raw('MAX(created_at) as max_created_at'))
        // ->whereNull('deleted_at')
        // ->orderBy('max_created_at', 'desc')
        // ->paginate(10);
        $Performance = User::select('users.first_name','users.id','users.email','users.profile_img','departments.name as departments_name')
                        ->leftjoin('employee_details','employee_details.user_id','users.id')
                        ->leftjoin('departments','departments.id','employee_details.department_id')
                        ->where('users.type',4)
                        ->paginate(10);


        $PerformanceCategory = PerformanceCategory::get();
        $PerformanceRating = PerformanceRating::get();
        return view('admin.Humanesources.Performance.home2', compact('Performance','PerformanceCategory','PerformanceRating'));
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
        $Log['url'] = url('/') . '/admin/Performance/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('admin.Humanesources.Performance.create',compact('Employee','PerformanceCategory','PerformanceRating')); 
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
            $Log['url'] = url('/') . '/admin/Performance/store';
            $Log['method'] = "Post";
            $Log['browser'] = $browser . "-" . $version;
            LogActivity::create($Log);

        return redirect('admin/Performance/home')->with('success', "New Performance Added Successfully");
    }



     public function view(Request $request,$id)
    {
        $id = $id;
        
          $Performance = User::select('users.first_name','users.id','users.email','users.profile_img','departments.name as departments_name')
                        ->leftjoin('employee_details','employee_details.user_id','users.id')
                        ->leftjoin('departments','departments.id','employee_details.department_id')
                        ->where('users.type', 4)
                        ->where('users.id',$id)
                        ->paginate(10);
        $user_details = User::find($id);
        $PerformanceCategory = PerformanceCategory::get();
        $PerformanceRating = PerformanceRating::get();
       
        $empname = User::select('users.first_name','employee_details.department_id','users.id','roles.name')
                    ->leftjoin('employee_details','employee_details.user_id','users.id')
                    ->leftjoin('roles','roles.id','employee_details.admin_type_id')
                    ->where('employee_details.user_id',$id)
                    ->first();
        $HR = User::select('first_name')->leftjoin('employee_details','employee_details.user_id','users.id')->where('employee_details.admin_type_id',2)->first();

        $Reviewer = User::select('first_name')->where('id',$id)->first();
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

       

        return view('admin.Humanesources.Performance.view',compact('empname','Departname','Reviewer','HR','TotalTaskComplete','TotalTaskAssigned','id','peroid','TotalProjectComplete','TotalProjectAssigned','TotalGoalComplete','TotalGoalAssigned','TotalLeadComplete','TotalLeadAssigned','TotalQuotesComplete','TotalQuotesAssigned','user_details','totalDays','TotalAttendence','PreS','id','Performance')); 
    }

      public function view2(Request $request,$id)
    {
        $empname = User::select('users.first_name','employee_details.department_id','users.id','roles.name')
                    ->leftjoin('employee_details','employee_details.user_id','users.id')
                    ->leftjoin('roles','roles.id','employee_details.admin_type_id')
                    ->where('employee_details.user_id',$id)
                    ->first();
        $HR = User::select('first_name')->leftjoin('employee_details','employee_details.user_id','users.id')->where('employee_details.admin_type_id',2)->first();

        $Reviewer = User::select('first_name')->where('id',$id)->first();
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

       

        return view('admin.Humanesources.Performance.view2',compact('empname','Departname','Reviewer','HR','TotalTaskComplete','TotalTaskAssigned','id','peroid','TotalProjectComplete','TotalProjectAssigned','TotalGoalComplete','TotalGoalAssigned','TotalLeadComplete','TotalLeadAssigned','TotalQuotesComplete','TotalQuotesAssigned','totalDays','TotalAttendence','PreS')); 
    }

   public function get_Performance_yeardata(Request $request)
    {
        $id = $request->userid;
        $year = $request->year;
        $currentDate = Carbon::now();

        $peroid = $request->month;
        $dateRangeStart = null;

        if ($peroid == "Quarterly1") {
            $dateRangeStart = Carbon::now()->subMonths(3);
        }elseif ($peroid == "Quarterly2") {
            $dateRangeStart = Carbon::now()->subMonths(6);
        }elseif ($peroid == "Quarterly3") {
            $dateRangeStart = Carbon::now()->subMonths(9);
        } elseif ($peroid == "Annual") {
            $dateRangeStart = Carbon::now()->subYear();
        }

        $TotalTaskComplete = Task::where('AssignedTo', 'LIKE', '%' . $id . '%')
            ->where('status_id', 2)
            ->whereBetween('startDate', [$dateRangeStart, $currentDate])
            ->whereYear('created_at', $year)
            ->count();

        $TotalTaskAssigned = Task::where('AssignedTo', 'LIKE', '%' . $id . '%')
            ->whereBetween('startDate', [$dateRangeStart, $currentDate])
            ->whereYear('created_at', $year)
            ->count();

        $TotalProjectComplete = Project::where('team_id', 'LIKE', '%' . $id . '%')
            ->where('status_id', 2)
            ->whereBetween('start_date', [$dateRangeStart, $currentDate])
            ->whereYear('created_at', $year)
            ->count();

        $TotalProjectAssigned = Project::where('team_id', 'LIKE', '%' . $id . '%')
            ->whereBetween('start_date', [$dateRangeStart, $currentDate])
            ->whereYear('created_at', $year)
            ->count();

        $TotalGoalComplete = Goal::where('employee_id', 'LIKE', '%' . $id . '%')
            ->where('status', 3)
            ->whereBetween('date', [$dateRangeStart, $currentDate])
            ->whereYear('created_at', $year)
            ->count();

        $TotalGoalAssigned = Goal::where('employee_id', 'LIKE', '%' . $id . '%')
            ->whereBetween('date', [$dateRangeStart, $currentDate])
            ->whereYear('created_at', $year)
            ->count();

        $TotalLeadComplete = Leads::where('assignedto', 'LIKE', '%' . $id . '%')
            ->where('status', 2)
            ->whereBetween('date', [$dateRangeStart, $currentDate])
            ->whereYear('created_at', $year)
            ->count();

        $TotalLeadAssigned = Leads::where('assignedto', 'LIKE', '%' . $id . '%')
            ->whereBetween('date', [$dateRangeStart, $currentDate])
            ->whereYear('created_at', $year)
            ->count();

        $TotalQuotesComplete = Quotes::where('user_id', 'LIKE', '%' . $id . '%')
            ->where('status', 5)
            ->whereBetween('date_created', [$dateRangeStart, $currentDate])
            ->whereYear('created_at', $year)
            ->count();


        $TotalQuotesAssigned = Quotes::where('user_id', 'LIKE', '%' . $id . '%')
            ->whereBetween('date_created', [$dateRangeStart, $currentDate])
            ->whereYear('created_at', $year)
            ->count();

         $TotalAttendence = Attendence::where('emp_Id', 'LIKE', '%' . $id . '%')
            ->whereBetween('punch_date', [$dateRangeStart, $currentDate])
            ->groupBy('punch_date')
            ->count();

        $totalDays = $currentDate->diffInDays($dateRangeStart);

        return view('admin.Humanesources.Performance.get_Performance_yeardata', compact('TotalTaskComplete', 'TotalTaskAssigned', 'peroid','TotalProjectComplete','TotalProjectAssigned','TotalGoalComplete','TotalGoalAssigned','TotalLeadComplete','TotalLeadAssigned','TotalQuotesComplete','TotalQuotesAssigned','totalDays','TotalAttendence'));
    }

  

}
