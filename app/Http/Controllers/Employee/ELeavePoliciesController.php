<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Collection;
use App\Models\LeavePolicies;
use App\Models\LogActivity;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Str;
use App\Models\LeaveType;
use App\Models\Leave;
use App\Models\User;
use Hash;
use Auth;


class ELeavePoliciesController extends Controller
{   
    //home page
   public function home()
    {
        $LeavePolicies = LeavePolicies::orderBy('created_at', 'desc')->paginate(10);
        return view('Employee.Humanesources.LeavePolicies.home', compact('LeavePolicies'));
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
        $Log['subject'] = "LeavePolicies Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/LeavePolicies/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('Employee.Humanesources.LeavePolicies.create'); 
    }


    //home page
    public function store(Request $req)
    {

        $data = $req->all();
        $data['user_id'] = Auth::user()->id;
        LeavePolicies::create($data);
            
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "LeavePolicies Data Store By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/LeavePolicies/store';
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);    

        return redirect('Employee/LeavePolicies/home')->with('success', "New Leave Policies Added Successfully");
    }

    //edit
    public function edit(Request $req,$id)
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "LeavePolicies Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/LeavePolicies/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        $LeavePolicies = LeavePolicies::find($id);
        return view('Employee.Humanesources.LeavePolicies.edit',compact('LeavePolicies'));
    }

    //updated
    public function update(Request $req,$id)
    {
     
        $data =LeavePolicies::find($id);
        $data['title'] = $req->title;
        $data['effective_date'] = $req->effective_date;
        $data['policies'] = $req->policies;
        $data->save();    

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "LeavePolicies Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/LeavePolicies/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('Employee/LeavePolicies/home')->with('success', "Leave Policies Edit Successfully");
    }

     public function delete(Request $request,$id)
    {
        LeavePolicies::find($id)->delete();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "LeavePolicies Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/LeavePolicies/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);
        
        return redirect('Employee/LeavePolicies/home')->with('success', "Leave Policies Deleted Successfully");
    }

    // get_leads_yeardata leads
           public function view(Request $request)
        {
           $LeavePolicies =LeavePolicies::find($request->id);
            return view('Employee.Humanesources.LeavePolicies.view', compact('LeavePolicies'));
        }


}
