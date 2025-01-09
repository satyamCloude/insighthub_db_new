<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use App\Models\Template;
use App\Models\User;
use Hash;
use Auth;


class ETemplateController extends Controller
{   
    //home page
  public function home(Request $request)
{
    $query = Template::orderBy('created_at', 'desc');

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

    $Template = $query->paginate(10);
     $Template->appends(['search' => $searchTerm]);

    $Total = Template::count();
    $active = Template::where('status',1)->count();
    $Inactive = Template::where('status',2)->count();

    return view('Employee.settings.Template.home', compact('Template','active','Inactive','searchTerm','Total'));
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
        $Log['subject'] = "Template Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Template/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('Employee.settings.Template.create'); 
    }


    //home page
    public function store(Request $req)
    {

        $data = $req->all();
        $data['user_id'] = Auth::user()->id;
        Template::create($data);
        
            $agent = new Agent();
            $browser = $agent->browser();
            $version = $agent->version($browser);
            $Log = $req->all();
            $Log['user_id'] = Auth::user()->id;
            $Log['ip'] = $req->ip();
            $Log['subject'] = "Template Data Store By " . Auth::user()->first_name;
            $Log['url'] = url('/') . '/Employee/Template/store';
            $Log['method'] = "Post";
            $Log['browser'] = $browser . "-" . $version;
            LogActivity::create($Log);
    

        return redirect('Employee/Template/home')->with('success', "New Template Added Successfully");
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
        $Log['subject'] = "Template Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Template/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        $Template = Template::find($id);
        return view('Employee.settings.Template.edit',compact('Template'));
    }

    //updated
    public function update(Request $req,$id)
    {
     
        $data =Template::find($id);
        $data['name'] = $req->name;
        $data['status'] = $req->status;
        $data['subject'] = $req->subject;
        $data['template'] = $req->template;
        $data['template2'] = $req->template2;
        $data->save();    

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Template Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Template/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('Employee/Template/home')->with('success', "Template Edit Successfully");
    }

     public function delete(Request $request,$id)
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Template Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Template/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        Template::find($id)->delete();
        return redirect('Employee/Template/home')->with('success', "Template Deleted Successfully");
    }


}
