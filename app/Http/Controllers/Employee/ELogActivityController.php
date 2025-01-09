<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\LogActivity;
use App\Models\User;
use Hash;

class ELogActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home(Request $request)
    {
        $query = LogActivity::orderBy('created_at', 'desc');
        $searchTerm = '';
        // Check if a search term is provided
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('ip', 'like', '%' . $searchTerm . '%')
                  ->orWhere('subject', 'like', '%' . $searchTerm . '%')
                  ->orWhere('url', 'like', '%' . $searchTerm . '%')
                  ->orWhere('method', 'like', '%' . $searchTerm . '%')
                  ->orWhere('browser', 'like', '%' . $searchTerm . '%')
                  ->orWhere('created_at', 'like', '%' . $searchTerm . '%');
            });
        }
        $LogActivity = $query->paginate(10);
         $LogActivity->appends(['search' => $searchTerm]);
        return view('Employee.settings.LogActivity.home', compact('LogActivity','searchTerm'));
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
