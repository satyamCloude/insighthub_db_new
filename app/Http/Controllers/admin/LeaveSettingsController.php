<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LeaveSettings;
use Auth;

class LeaveSettingsController extends Controller
{   
    public function home(Request $request)
    {
        $LeaveSettings = LeaveSettings::where('user_id', Auth::user()->id)->first();
        return view('admin.settings.LeaveSettings.home', compact('LeaveSettings'));
    }

    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $LeaveSettings = LeaveSettings::where('user_id', $user_id)->first();
        if (!$LeaveSettings) {
            $LeaveSettings = new LeaveSettings();
        }
            $LeaveSettings->user_id = $user_id;
            $LeaveSettings->count_leave_from = $request->count_leave_from;
            $LeaveSettings->start_year_from = $request->start_year_from ? $request->start_year_from:null;
            $LeaveSettings->leave_approval_permission = $request->leave_approval_permission ? $request->leave_approval_permission:null;
            $LeaveSettings->save();

        return redirect()->back()->with('success', 'Leave settings updated successfully');
    }
}
