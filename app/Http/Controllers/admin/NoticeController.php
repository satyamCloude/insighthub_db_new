<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Jenssegers\Agent\Agent;
use App\Models\Notice;
use Auth;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home(Request $request)
    {
        $searchTerm = $request->input('search');
        
        $Notice = Notice::where(function ($query) use ($searchTerm) {
                $query->where('Applieddate', 'LIKE', '%' . $searchTerm . '%')
                      ->orWhere('Tilldate', 'LIKE', '%' . $searchTerm . '%')
                      ->orWhere('status', 'LIKE', '%' . $searchTerm . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $Total = Notice::count();
        $Public = Notice::where('status',1)->count();
        $Private = Notice::where('status',2)->count();
        return view('admin.settings.Notice.home', compact('Notice', 'searchTerm','Total','Public','Private'));
    }
     public function showNotice(Request $request)
    {
        $searchTerm = $request->input('search');
        
        $Notice = Notice::where(function ($query) use ($searchTerm) {
                $query->where('Applieddate', 'LIKE', '%' . $searchTerm . '%')
                      ->orWhere('Tilldate', 'LIKE', '%' . $searchTerm . '%')
                      ->orWhere('status', 'LIKE', '%' . $searchTerm . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $Total = Notice::count();
        $Public = Notice::where('status',1)->count();
        $Private = Notice::where('status',2)->count();
        return view('admin.Notice.home', compact('Notice', 'searchTerm','Total','Public','Private'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('admin.settings.Notice.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $store = $request->all();
        $storep['user_id'] = Auth::user()->id;        
        Notice::create($store);
        return redirect()->back()->with('success',"Notice created Successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(Notice $notice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request,$id)
    {
        $edit = Notice::find($id);
        return view('admin.settings.Notice.edit',compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $Update = Notice::find($id);
        $Update->user_id = Auth::user()->id;
        $Update->Applieddate = $request->Applieddate;
        $Update->Tilldate = $request->Tilldate;
        $Update->status = $request->status;
        $Update->notice = $request->notice;
        $Update->save();
        return redirect()->back()->with('success',"Notice Update Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete($id)
    {
        Notice::find($id)->delete();
        return redirect()->back()->with('success',"Notice Delete Successfully");
    }
}
