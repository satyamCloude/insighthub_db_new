<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use App\Models\LeaveType;
use App\Models\Employee;
use App\Models\File;
use App\Models\User;
use Hash;
use Auth;


class FileController extends Controller
{   
    //home page
   public function home()
    {
        $File = File::orderBy('users.profile_img')
        ->join('users', 'users.id', 'files.employee_id')
        ->paginate(10);
        
        return view('admin.Humanesources.File.home', compact('File'));
    }



    //home page
    public function Create(Request $request)
    {   
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "File Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/File/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        $Employee = User::select('first_name','id')->where('type',4)->get();
        return view('admin.Humanesources.File.create',compact('Employee')); 
    }


    public function store(Request $req)
    {

        $url = url('/').'/public/images/';
        foreach ($req->employee_id as $key => $value) {
            $data = new File;
        
            $profileFilename = 'default_profile.jpg';
            if ($req->hasFile('documents')) {
                $rand = Str::random(4);
                $file = $req->file('documents')[$key];
                $extension = $file->getClientOriginalExtension();
                $profileFilename = 'file_doc_'.$rand.'.'.$extension;
                $file->move('public/images/', $profileFilename);
            }
            $data['documents'] = $url . $profileFilename;
            $data['employee_id'] = $value;
            $data['document_name'] = $req->document_name[$key];
            $data['user_id'] = Auth::User()->id;
            $data->save();


            $agent = new Agent();
            $browser = $agent->browser();
            $version = $agent->version($browser);
            $Log = $req->all();
            $Log['user_id'] = Auth::user()->id;
            $Log['ip'] = $req->ip();
            $Log['subject'] = "File Data Store By " . Auth::user()->first_name;
            $Log['url'] = url('/') . '/admin/File/store';
            $Log['method'] = "Post";
            $Log['browser'] = $browser . "-" . $version;
            LogActivity::create($Log);

        }
        return redirect('admin/File/home')->with('success', "New File Added Successfully");
    }


    //edit
    public function edit(Request $req,$id)
    {
        $File = File::find($id);
        $Employee = User::select('first_name','id')->where('type',4)->get();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "File Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/File/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('admin.Humanesources.File.edit',compact('File','Employee'));
    }

    //updated
    public function update(Request $req,$id)
    {
        $url = url('/').'/public/images/';
     
        $data =File::find($id);
        $data['employee_id'] = $req->employee_id;
        $data['document_name'] = $req->document_name;
        if ($req->hasFile('documents')) {
            $profileFilename = 'file_doc_' . Str::random(4) . '.' . $req->file('documents')->getClientOriginalExtension();
            $req->file('documents')->move('public/images/', $profileFilename);
            $data->documents = url('/public/images/') . '/' . $profileFilename;
        }
        $data['user_id'] = Auth::User()->id;
        $data->save();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "File Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/File/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);    

        return redirect('admin/File/home')->with('success', "File Edit Successfully");
    }

     public function delete(Request $request,$id)
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "File Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/File/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        File::find($id)->delete();
        return redirect('admin/File/home')->with('success', "File Deleted Successfully");
    }
}
