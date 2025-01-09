<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Collection;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Str;
use App\Models\LogActivity;
use App\Models\Permission;
use App\Models\RoleAccess;
use App\Models\LeaveType;
use App\Models\Employee;
use App\Models\Role;
use App\Models\User;
use Hash;
use Auth;


class RoleController extends Controller
{   
    //home page
         public function home(Request $request)
        {
            $query = Role::orderBy('created_at', 'desc');

            $searchTerm = '';

            // Check if a search term is provided
            if ($request->has('search')) {
                $searchTerm = $request->input('search');
                $query->where('name', 'like', '%' . $searchTerm . '%');
            }

            $Role = $query->paginate(10);
            $Role->appends(['search' => $searchTerm]);

            $Total = Role::count();
            $active = Role::where('status', '1')->count();
            $Inactive = Role::where('status', '2')->count();

            return view('admin.settings.Role.home', compact('Role', 'active', 'Inactive','Total','searchTerm'));
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
        $Log['subject'] = "Role Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Role/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log); 

        $Permission = Permission::select('name','guard_name','id')->get();
        return view('admin.settings.Role.create',compact('Permission')); 
    }


    public function store(Request $req)
    {

        $dat = $req->all();
        
        $PermissionId = implode(",",$req->permission_id);
        $dat['user_id'] = Auth::User()->id;
        $dat['permission_id'] = $PermissionId;
        $Role = Role::create($dat);



        foreach ($req->permission_id as $key => $value) {
            $data['role_id'] = $Role->id;
            $data['permission_id'] = $value;
            $data['view'] = $req->view[$key];
            $data['add'] = $req->add[$key];
            $data['update'] = $req->update[$key];
            $data['delete'] = $req->delete[$key];
            RoleAccess::create($data);
        }

            $agent = new Agent();
            $browser = $agent->browser();
            $version = $agent->version($browser);
            $Log = $req->all();
            $Log['user_id'] = Auth::user()->id;
            $Log['ip'] = $req->ip();
            $Log['subject'] = "Role Data Store By " . Auth::user()->first_name;
            $Log['url'] = url('/') . '/admin/Role/store';
            $Log['method'] = "Post";
            $Log['browser'] = $browser . "-" . $version;
            LogActivity::create($Log);

        return redirect()->back()->with('success', "New Role Added Successfully");
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
        $Log['subject'] = "Role Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Role/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        $Role = Role::find($id);
        $RoleAccess = RoleAccess::
                        leftjoin('permissions','permissions.id','role_accesses.permission_id')
                        ->where('role_accesses.role_id',$id)
                        ->get();
        $Permission = Permission::select('name','guard_name','id')->get();
        return view('admin.settings.Role.edit',compact('Role','Permission','RoleAccess'));
    }

    //updated
    public function update(Request $req,$id)
    { 
        // return $req->all();

        $dat =Role::find($id);
        $dat['user_id'] = Auth::User()->id;
        $dat['name'] = $req->name;
        $dat['status'] = $req->status;
        $PermissionId = implode(",",$req->permission_id);
        $dat['permission_id'] = $PermissionId;
        $dat->save();    

        RoleAccess::where('role_id',$id)->delete();

        
        foreach ($req->permission_id as $key => $value) {
            
            $data['role_id'] = $dat->id;
            $data['permission_id'] = $value;
            $data['view'] = $req->view[$key];
            $data['add'] = $req->add[$key];
            $data['update'] = $req->update[$key];
            $data['delete'] = $req->delete[$key];
            RoleAccess::create($data);
        }

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Role Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Role/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);


        return redirect()->back()->with('success', "Role Edit Successfully");
    }

     public function delete(Request $request,$id)
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Role Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Role/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        Role::find($id)->delete();
        RoleAccess::where('role_id',$id)->delete();
        return redirect()->back()->with('success', "Role Deleted Successfully");
    }
}
