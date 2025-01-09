<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Collection;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use Illuminate\Support\Str;
use App\Models\Holiday;
use App\Models\User;
use Hash;
use Auth;


class EHolidayController extends Controller
{   
    //home page
  public function home(Request $request)
{
    $query = Holiday::orderBy('created_at', 'desc');

    $searchTerm = '';

    // Check if a search term is provided
    if ($request->has('search')) {
        $searchTerm = $request->input('search');
        $query->where(function ($q) use ($searchTerm) {
            $q->where('date', 'like', '%' . $searchTerm . '%')
              ->orWhere('id', 'like', '%' . $searchTerm . '%');
        });
    }

    $Holiday = $query->paginate(10);
    $Holiday->appends(['search' => $searchTerm]);

    return view('Employee.Humanesources.Holiday.home', compact('Holiday','searchTerm'));
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
        $Log['subject'] = "Holiday Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Holiday/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('Employee.Humanesources.Holiday.create'); 
    }


    //home page
    public function store(Request $req)
    {

        $data = $req->all();
        Holiday::create($data);
            
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Holiday Data Store By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Holiday/store';
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);



        return redirect('Employee/Holiday/home')->with('success', "New Holiday Added Successfully");
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
        $Log['subject'] = "Holiday Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Holiday/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        $Holiday = Holiday::find($id);
        return view('Employee.Humanesources.Holiday.edit',compact('Holiday'));
    }

    //updated
    public function update(Request $req,$id)
    {
     
        $data =Holiday::find($id);
        $data['date'] = $req->date;
        $data['description'] = $req->description;
        $data->save();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Holiday Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Holiday/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);    

        return redirect('Employee/Holiday/home')->with('success', "Holiday Edit Successfully");
    }

     public function delete(Request $request,$id)
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Holiday Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Holiday/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        Holiday::find($id)->delete();
        return redirect('Employee/Holiday/home')->with('success', "Holiday Deleted Successfully");
    }


}
