<?php

namespace App\Http\Controllers\admin;

use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;
use App\Models\OperatingSysten;
use App\Models\PaymentMethod;   
use Illuminate\Http\Request;
use App\Exports\TaskExport; 
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use Illuminate\Support\Str;
use App\Models\ProjectCategory;
use App\Models\PaymentDetail;
use Session;
use Hash;
use Auth;

class ProjectCategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function home(Request $request)
     {
               $ProjectCategory = ProjectCategory::orderBy('created_at', 'desc')->get();
                return view('admin.ProjectCategory.home', compact('ProjectCategory'));
        }


    /**
     * Show the form for creating a new resource.
     */
    public function Create(Request $request)
     {   

        return view('admin.ProjectCategory.create'); 
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
     {
            $project = $request->all();
            $project['user_id'] = Auth::user()->id;
            ProjectCategory::create($project);
      Session::put('TabViews', 'ProjectCategory');
        return redirect()->back()->with('success', "New Currency Added Successfully");
        }


    /**
     * Display the specified resource.
     */
    public function show(Request $req,$id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $req,$id)
     {
        $ProjectCategory = ProjectCategory::find($id);
       
        return view('admin.ProjectCategory.edit',compact('ProjectCategory','id'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id, ProjectCategory $projectCategory)
     {
            $data = ProjectCategory::find($id);
            $data->user_id = auth()->user()->id;
            $data->category_name = $request->category_name;
            $data->save();
            return redirect()->back()->with('success', 'Project updated successfully');
        }

    /**
     * Remove the specified resource from storage.
     */
     public function delete(Request $request,$id)
   {
       

        ProjectCategory::find($id)->delete();
        return redirect()->back()->with('success', "Project Deleted Successfully");
    }

}
