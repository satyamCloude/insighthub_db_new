<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use App\Models\Security;
use App\Models\User;
use Hash;
use Auth;


class SecurityController extends Controller
{   
    //home page
  public function home(Request $request)
{
    $query = Security::orderBy('created_at', 'desc');

    $searchTerm = '';

    // Check if a search term is provided
    if ($request->has('search')) {
        $searchTerm = $request->input('search');
        $query->where(function ($q) use ($searchTerm) {
            $q->where('User_ip_address', 'like', '%' . $searchTerm . '%')
              ->orWhere('status', 'like', '%' . $searchTerm . '%')
              ->orWhere('id', 'like', '%' . $searchTerm . '%');
        });
    }

    $Security = $query->paginate(10);
     $Security->appends(['search' => $searchTerm]);

    $Total = Security::count();
    $active = Security::where('status',1)->count();
    $Inactive = Security::where('status',2)->count();

    return view('admin.settings.Security.home', compact('Security','active','Inactive','searchTerm','Total'));
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
        $Log['subject'] = "Security Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Security/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('admin.settings.Security.create'); 
    }


    //home page
    public function store(Request $req)
    {

        $data = $req->all();
        Security::create($data);
        
            $agent = new Agent();
            $browser = $agent->browser();
            $version = $agent->version($browser);
            $Log = $req->all();
            $Log['user_id'] = Auth::user()->id;
            $Log['ip'] = $req->ip();
            $Log['subject'] = "Security Data Store By " . Auth::user()->first_name;
            $Log['url'] = url('/') . '/admin/Security/store';
            $Log['method'] = "Post";
            $Log['browser'] = $browser . "-" . $version;
            LogActivity::create($Log);
    

        return redirect()->back()->with('success', "New Security Added Successfully");
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
        $Log['subject'] = "Security Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Security/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        $Security = Security::find($id);
        return view('admin.settings.Security.edit',compact('Security'));
    }

    //updated
    public function update(Request $req,$id)
    {
     
        $data =Security::find($id);
        $data['User_ip_address'] = $req->User_ip_address;
        $data['status'] = $req->status;
        $data->save();    

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Security Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Security/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect()->back()->with('success', "Security Edit Successfully");
    }

     public function delete(Request $request,$id)
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Security Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Security/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        Security::find($id)->delete();
        return redirect()->back()->with('success', "Security Deleted Successfully");
    }


}
