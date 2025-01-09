<?php

namespace App\Http\Controllers\admin;

use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\LogActivity;
use App\Models\User;
use Hash;

class LogActivityController extends Controller
{
    public function home(Request $request)
    {
        $query = LogActivity::join('users','users.id','log_activities.user_id')
            ->where('log_activities.type','login')
            ->select('users.first_name','log_activities.*')
            ->orderBy('created_at', 'desc');
        $searchTerm = '';
        // Check if a search term is provided
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('log_activities.ip', 'like', '%' . $searchTerm . '%')
                  ->orWhere('log_activities.subject', 'like', '%' . $searchTerm . '%')
                  ->orWhere('log_activities.url', 'like', '%' . $searchTerm . '%')
                  ->orWhere('log_activities.method', 'like', '%' . $searchTerm . '%')
                  ->orWhere('log_activities.browser', 'like', '%' . $searchTerm . '%')
                  ->orWhere('log_activities.created_at', 'like', '%' . $searchTerm . '%');
            });
        }
        $LogActivity = $query->paginate(10);
        $LogActivity->appends(['search' => $searchTerm]);
        return view('admin.settings.LogActivity.home', compact('LogActivity','searchTerm'));
    }


    /**
     * Display a listing of the resource.
     */
    public function ticket(Request $request)
    {
        $query = LogActivity::join('departments','departments.id','log_activities.to')
        // ->join('users','users.id','log_activities.user_id')
            ->where('log_activities.type','ticket')
            ->select('log_activities.*','departments.name')
            ->orderBy('log_activities.created_at', 'desc');
        $searchTerm = '';
        // Check if a search term is provided
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('log_activities.ip', 'like', '%' . $searchTerm . '%')
                  ->orWhere('log_activities.subject', 'like', '%' . $searchTerm . '%')
                  ->orWhere('log_activities.created_at', 'like', '%' . $searchTerm . '%');
            });
        }
        $LogActivity = $query->paginate(10);
         $LogActivity->appends(['search' => $searchTerm]);
        return view('admin.settings.LogActivity.ticket', compact('LogActivity','searchTerm'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function invoice(Request $request)
    {
        $query = LogActivity::join('users','users.id','log_activities.user_id')
            ->where('log_activities.type','invoice')
            ->select('log_activities.*','users.email')
            ->orderBy('log_activities.created_at', 'desc');
        $searchTerm = '';
        // Check if a search term is provided
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('log_activities.ip', 'like', '%' . $searchTerm . '%')
                  ->orWhere('log_activities.subject', 'like', '%' . $searchTerm . '%')
                  ->orWhere('log_activities.created_at', 'like', '%' . $searchTerm . '%');
            });
        }
        $LogActivity = $query->paginate(10);
         $LogActivity->appends(['search' => $searchTerm]);
         
        //  return $LogActivity;
        return view('admin.settings.LogActivity.invoice', compact('LogActivity','searchTerm'));
    }
    
    //lead log
    public function lead(Request $request)
    {
        $query = LogActivity::join('users','users.id','log_activities.user_id')
            ->where('log_activities.type','lead')
            ->select('log_activities.*','users.email')
            ->orderBy('log_activities.created_at', 'desc');
        $searchTerm = '';
        // Check if a search term is provided
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('log_activities.ip', 'like', '%' . $searchTerm . '%')
                  ->orWhere('log_activities.subject', 'like', '%' . $searchTerm . '%')
                  ->orWhere('log_activities.created_at', 'like', '%' . $searchTerm . '%');
            });
        }
        $LogActivity = $query->paginate(10);
         $LogActivity->appends(['search' => $searchTerm]);
         
        //  return $LogActivity;
        return view('admin.settings.LogActivity.lead', compact('LogActivity','searchTerm'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(LogActivity $logActivity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(LogActivity $logActivity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, LogActivity $logActivity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(LogActivity $logActivity)
    {
        //
    }
}
