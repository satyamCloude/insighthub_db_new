<?php

namespace App\Http\Controllers\admin;

use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;
use App\Models\TaskCategory;
use App\Models\Task;
use Illuminate\Http\Request;
use Hash;
use Auth;

class TaskCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
       //home page
public function home(Request $request)
{

     $TaskCategory = TaskCategory::orderBy('created_at', 'desc')->get();
     return view('admin.TaskCategory.home', compact('TaskCategory'));
    
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.TaskCategory.create'); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $Task = $request->all();
            $Task['user_id'] = Auth::user()->id;
            TaskCategory::create($Task);
            return redirect()->back()->with('success', 'Task added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(TaskCategory $taskCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaskCategory $taskCategory ,$id)
    {
         $TaskCategory = TaskCategory::find($id);
       
        return view('admin.TaskCategory.edit',compact('TaskCategory','id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id, TaskCategory $taskCategory)
    {
         $data = TaskCategory::find($id);
            $data->user_id = auth()->user()->id;
            $data->category_name = $request->category_name;
            $data->save();
            return redirect()->back()->with('success', 'Task updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(TaskCategory $taskCategory,$id)
    {
         TaskCategory::find($id)->delete();
        return redirect()->back()->with('success', "Task Deleted Successfully");
    }
}
