<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Collection;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Str;
use App\Models\TimeShift;
use App\Models\LogActivity;
use App\Models\EmployeeDetail;
use App\Models\Employee;
use App\Models\User;
use Hash;
use Auth;

class ETimeShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home(Request $request)
    {
         // $query = TimeShift::select('id', 'shift_name', 'StartTime', 'EndTime', 'working_hours')
         //        ->orderBy('created_at', 'desc');
            $searchTerm = '';

         //    // Check if a search term is provided
         //    if ($request->has('search')) {
         //        $searchTerm = $request->input('search');
         //        $query->where(function ($q) use ($searchTerm) {
         //            $q->where('shift_name', 'like', '%' . $searchTerm . '%')
         //              ->orWhere('time_in', 'like', '%' . $searchTerm . '%')
         //              ->orWhere('time_out', 'like', '%' . $searchTerm . '%')
         //              ->orWhere('working_hours', 'like', '%' . $searchTerm . '%');
         //        });
         //    }
         //     $TimeShift->appends(['search' => $searchTerm]);
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
                    if($RoleAccess[array_search('MassMail', array_column($RoleAccess, 'per_name'))]['view'] == 1)
                        {
                            $query = TimeShift::select('id', 'shift_name', 'StartTime', 'EndTime', 'working_hours')
                                    ->orderBy('created_at', 'desc');
                                $searchTerm = '';

                                // Check if a search term is provided
                                if ($request->has('search')) {
                                    $searchTerm = $request->input('search');
                                    $query->where(function ($q) use ($searchTerm) {
                                        $q->where('shift_name', 'like', '%' . $searchTerm . '%')
                                          ->orWhere('time_in', 'like', '%' . $searchTerm . '%')
                                          ->orWhere('time_out', 'like', '%' . $searchTerm . '%')
                                          ->orWhere('working_hours', 'like', '%' . $searchTerm . '%');
                                    });
                                }
                                $TimeShift = $query->paginate(10);
                                $TimeShift->appends(['search' => $searchTerm]);
                                
                                $shifts = $TimeShift->pluck('shift_name')->toArray();
                                $shiftCount= [];
                                foreach($TimeShift as $shift){
                                    $shiftCount[] = EmployeeDetail::where('shift_id',$shift->id)->count();
                                }  
                        }if($RoleAccess[array_search('MassMail', array_column($RoleAccess, 'per_name'))]['view'] == 2)
                        {
                            $query = TimeShift::select('time_shifts.id', 'time_shifts.shift_name', 'time_shifts.StartTime', 'time_shifts.EndTime', 'time_shifts.working_hours')
                                ->join('employee_details','employee_details.shift_id','time_shifts.id')
                            ->where('employee_details.user_id',Auth::user()->id)
                                    ->orderBy('time_shifts.created_at', 'desc');
                                $searchTerm = '';

                                // Check if a search term is provided
                                if ($request->has('search')) {
                                    $searchTerm = $request->input('search');
                                    $query->where(function ($q) use ($searchTerm) {
                                        $q->where('shift_name', 'like', '%' . $searchTerm . '%')
                                          ->orWhere('time_in', 'like', '%' . $searchTerm . '%')
                                          ->orWhere('time_out', 'like', '%' . $searchTerm . '%')
                                          ->orWhere('working_hours', 'like', '%' . $searchTerm . '%');
                                    });
                                }
                                $TimeShift = $query->paginate(10);
                                $TimeShift->appends(['search' => $searchTerm]);
                                
                                $shifts = $TimeShift->pluck('shift_name')->toArray();
                                $shiftCount= [];
                                foreach($TimeShift as $shift){
                                    $shiftCount[] = EmployeeDetail::where('shift_id',$shift->id)->count();
                                }

                        }
            // $TimeShift = TimeShift::select('time_shifts.id','time_shifts.shift_name','time_shifts.StartTime','time_shifts.EndTime','time_shifts.working_hours')->leftjoin('employee_details','employee_details.shift_id','time_shifts.id')->where('employee_details.user_id',Auth::user()->id)->paginate(10);

            return view('Employee.Humanesources.TimeShift.home', compact('RoleAccess','TimeShift','searchTerm','shifts','shiftCount'));
    }
public function roaster(Request $request){
        $TimeShift = TimeShift::join('employee_details', 'time_shifts.id', '=', 'employee_details.shift_id')
        ->join('users', 'users.id', '=', 'employee_details.user_id')
        ->select(
            'time_shifts.*',
            'users.first_name',
            'users.profile_img',
            'employee_details.weekly_off_id',
            'employee_details.additional_week_off_first',
            'employee_details.additional_week_off_second',
            'employee_details.additional_week_off_third',
            'employee_details.additional_week_off_fourth'
        )
        ->where('employee_details.user_id',Auth::user()->id)
        ->paginate(10);
        
        $days = [1,2,3,4,5,6,7];
        
        return view('Employee.Humanesources.TimeShift.roaster',compact('TimeShift','days'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "TimeShift Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/TimeShift/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);
        return view('Employee.Humanesources.TimeShift.create'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {   
        $data = $req->all();
        TimeShift::create($data);
        
            $agent = new Agent();
            $browser = $agent->browser();
            $version = $agent->version($browser);
            $Log = $req->all();
            $Log['user_id'] = Auth::user()->id;
            $Log['ip'] = $req->ip();
            $Log['subject'] = "TimeShift Data Store By " . Auth::user()->first_name;
            $Log['url'] = url('/') . '/Employee/TimeShift/store';
            $Log['method'] = "Post";
            $Log['browser'] = $browser . "-" . $version;
            LogActivity::create($Log);        

        return redirect('Employee/TimeShift/home')->with('success', "New TimeShift Added Successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(TimeShift $timeShift)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $req,$id)
    {
        $TimeShift = TimeShift::find($id);

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "TimeShift Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/TimeShift/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('Employee.Humanesources.TimeShift.edit',compact('TimeShift'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req,$id)
    {
     
        $data =TimeShift::find($id);

        $data['shift_name'] = $req->shift_name;
        $data['Colorname'] = $req->Colorname;
        $data['StartTime'] = $req->StartTime;
        $data['EndTime'] = $req->EndTime;
        $data['working_hours'] = $req->working_hours;
        $data['HalfdayMarkTime'] = $req->HalfdayMarkTime;
        $data['EarlyClockIn'] = $req->EarlyClockIn;
        $data['Latemarkafter'] = $req->Latemarkafter;
        $data['Maximumcheckinallowedinaday'] = $req->Maximumcheckinallowedinaday;
        $data['monday'] = $req->monday;
        $data['tuesday'] = $req->tuesday;
        $data['wednesday'] = $req->wednesday;
        $data['thursday'] = $req->thursday;
        $data['friday'] = $req->friday;
        $data['saturday'] = $req->saturday;
        $data['sunday'] = $req->sunday;
        $data->save();    

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "TimeShift Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/TimeShift/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('Employee/TimeShift/home')->with('success', "TimeShift Edit Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
     public function delete(Request $request,$id)
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "TimeShift Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/TimeShift/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        TimeShift::find($id)->delete();
        return redirect('Employee/TimeShift/home')->with('success', "TimeShift Deleted Successfully");
    }
}
