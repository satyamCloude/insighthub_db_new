<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Collection;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Str;
use App\Models\TimeShift;
use App\Models\LogActivity;
use App\Models\Employee;
use App\Models\EmployeeDetail;
use App\Models\User;
use Hash;
use Auth;

class TimeShiftController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home(Request $request)
    {
         $query = TimeShift::select('id', 'shift_name', 'StartTime', 'EndTime', 'working_hours','break_time')
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
        return view('admin.Humanesources.TimeShift.home', compact('TimeShift','searchTerm','shifts','shiftCount'));
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
        ->paginate(10);
        
        $days = [1,2,3,4,5,6,7];
        
        return view('admin.Humanesources.TimeShift.roaster',compact('TimeShift','days'));
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
        $Log['url'] = url('/') . '/admin/TimeShift/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);
        return view('admin.Humanesources.TimeShift.create'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {   
        $data = $req->all();
        
        $StartTime = $req->StartTime;  // Example: '08:00:00'
        $EndTime = $req->EndTime; // Example: '17:00:00'
        
        // Treat "00:00:00" as midnight (12:00 AM) if it is a special case
        if ($StartTime === '00:00:00') {
            $StartTime = '12:00:00';
        }
        if ($EndTime === '00:00:00') {
            $EndTime = '12:00:00';
        }
        $punchInTime = strtotime($StartTime);
        $punchOutTime = strtotime($EndTime);
        
        if ($punchInTime > $punchOutTime) {
            $punchOutTime += 86400;  // Add 24 hours (86400 seconds) to punch out time
        }
        
        // Calculate total seconds worked
        $totalSecondsWorked = max(0, $punchOutTime - $punchInTime); // Ensure non-negative value
        // Calculate hours, minutes, and seconds
        $totalHours = floor($totalSecondsWorked / 3600); // Hours
        $totalMinutes = floor(($totalSecondsWorked % 3600) / 60); // Minutes
        $totalSeconds = $totalSecondsWorked % 60; // Seconds
        $formattedWorkingHours = sprintf("%02d:%02d:%02d", $totalHours, $totalMinutes, $totalSeconds);
        // Store the result
        
        $data['working_hours'] = $formattedWorkingHours;

        TimeShift::create($data);
        
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "TimeShift Data Store By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/TimeShift/store';
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);        

        return redirect('admin/TimeShift/home')->with('success', "New TimeShift Added Successfully");
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
        $Log['url'] = url('/') . '/admin/TimeShift/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('admin.Humanesources.TimeShift.edit',compact('TimeShift'));
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
        $data['break_time'] = $req->break_time;

        $StartTime = $req->StartTime;  // Example: '08:00:00'
        $EndTime = $req->EndTime; // Example: '17:00:00'
        
        // Treat "00:00:00" as midnight (12:00 AM) if it is a special case
        if ($StartTime === '00:00:00') {
            $StartTime = '12:00:00';
        }
        if ($EndTime === '00:00:00') {
            $EndTime = '12:00:00';
        }
        $punchInTime = strtotime($StartTime);
        $punchOutTime = strtotime($EndTime);
        
        if ($punchInTime > $punchOutTime) {
            $punchOutTime += 86400;  // Add 24 hours (86400 seconds) to punch out time
        }
        
        // Calculate total seconds worked
        $totalSecondsWorked = max(0, $punchOutTime - $punchInTime); // Ensure non-negative value
        // Calculate hours, minutes, and seconds
        $totalHours = floor($totalSecondsWorked / 3600); // Hours
        $totalMinutes = floor(($totalSecondsWorked % 3600) / 60); // Minutes
        $totalSeconds = $totalSecondsWorked % 60; // Seconds
        // Format result as HH:MM:SS
        $formattedWorkingHours = sprintf("%02d:%02d:%02d", $totalHours, $totalMinutes, $totalSeconds);
        // Store the result
        $data['working_hours'] = $formattedWorkingHours;
        
        
        // dd($data['working_hours']);
        $data->save();    

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "TimeShift Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/TimeShift/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('admin/TimeShift/home')->with('success', "TimeShift Edit Successfully");
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
        $Log['url'] = url('/') . '/admin/TimeShift/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        TimeShift::find($id)->delete();
        return redirect('admin/TimeShift/home')->with('success', "TimeShift Deleted Successfully");
    }
}










