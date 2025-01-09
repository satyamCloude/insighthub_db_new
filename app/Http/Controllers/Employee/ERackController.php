<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use App\Models\LeadSource;
use App\Models\Countrys;
use App\Models\RackUnit;
use App\Models\Currency;
use App\Models\Country;
use App\Models\Leads;
use App\Models\State;
use App\Models\City;
use App\Models\Rack;
use App\Models\User;
use Hash;
use Auth;


class ERackController extends Controller
{   
    //home page
   public function home(Request $request)
{
     $RoleAccess = \App\Models\RoleAccess::select('role_accesses.add','role_accesses.view','role_accesses.update','role_accesses.delete','permissions.name as per_name')
                    ->join('employee_details','employee_details.job_role_id','role_accesses.role_id')
                    ->leftjoin('permissions','permissions.id','role_accesses.permission_id')
                    ->where('employee_details.user_id', Auth::user()->id)
                    ->where(function($query) {
                        $query->where('role_accesses.view', '!=', null)
                            ->orWhere('role_accesses.add', '!=', null)
                            ->orWhere('role_accesses.update', '!=', null)
                            ->orWhere('role_accesses.delete', '!=', null);
                    })
                    ->get()
                    ->toArray();
                    
    if($RoleAccess[array_search('Rack', array_column($RoleAccess, 'per_name'))]['view'] == 1)
    {
        $query = Rack::orderBy('created_at', 'desc');
        $searchTerm ='';
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('rack_id', 'like', '%' . $searchTerm . '%')
                  ->orWhere('rack_bandwidth', 'like', '%' . $searchTerm . '%')
                  ->orWhere('rack_capacity', 'like', '%' . $searchTerm . '%');
            });
        }
        $Rack = $query->paginate(10);
        $Rack->appends(['search' => $searchTerm]);
        $Total = Rack::count();
        $totalActive = Rack::where('status', '1')->count();
        $totalSuspended = Rack::where('status', '2')->count();
        $totalTerminated = Rack::where('status', '3')->count();
    }

    if($RoleAccess[array_search('Rack', array_column($RoleAccess, 'per_name'))]['view'] == 2)
    {
       $query = Rack::where('user_id',auth::user()->id)->orderBy('created_at', 'desc');
        $searchTerm ='';
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('rack_id', 'like', '%' . $searchTerm . '%')
                  ->orWhere('rack_bandwidth', 'like', '%' . $searchTerm . '%')
                  ->orWhere('rack_capacity', 'like', '%' . $searchTerm . '%');
            });
        }
        $Rack = $query->paginate(10);
        $Rack->appends(['search' => $searchTerm]);
        $Total = Rack::where('user_id',auth::user()->id)->count();
        $totalActive = Rack::where('user_id',auth::user()->id)->where('status', '1')->count();
        $totalSuspended = Rack::where('user_id',auth::user()->id)->where('status', '2')->count();
        $totalTerminated = Rack::where('user_id',auth::user()->id)->where('status', '3')->count(); 
    }

    

    return view('Employee.NetworkManagement.Rack.home', compact('RoleAccess','Rack', 'totalActive', 'totalSuspended', 'totalTerminated','searchTerm','Total'));
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
        $Log['subject'] = "Rack Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Rack/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        $client = User::select('id','first_name')->where('type','2')->get();
        $Vendor = User::select('id','first_name')->where('type','3')->get();
        return view('Employee.NetworkManagement.Rack.create',compact('client','Vendor')); 
    }


    public function store(Request $req)
    {
        $data = $req->all();
        $data['user_id'] = Auth::user()->id;
        $rack = Rack::create($data);

        // Ensure that $req->rack_id is a valid positive integer
        $rackIdCount = intval($req->rack_id);

        for ($i = 0; $i < $rackIdCount; $i++) {
            $rackUnit = new RackUnit;
            $rackUnit->rack_id = $rack->id;
            $rackUnit->user_id = Auth::user()->id;
            $rackUnit->unit_no = $i + 1;
            $rackUnit->save();
        }

            $agent = new Agent();
            $browser = $agent->browser();
            $version = $agent->version($browser);
            $Log = $req->all();
            $Log['user_id'] = Auth::user()->id;
            $Log['ip'] = $req->ip();
            $Log['subject'] = "Rack Data Store By " . Auth::user()->first_name;
            $Log['url'] = url('/') . '/Employee/Rack/store';
            $Log['method'] = "Post";
            $Log['browser'] = $browser . "-" . $version;
            LogActivity::create($Log);

        return redirect('Employee/Rack/home')->with('success', "New Rack Added Successfully");
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
        $Log['subject'] = "Rack Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Rack/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        $Rack = Rack::find($id);
        $client = User::select('id','first_name')->where('type','2')->get();
        $Vendor = User::select('id','first_name')->where('type','3')->get();
        $rack_unit = RackUnit::where('rack_id',$id)->get();
        return view('Employee.NetworkManagement.Rack.edit',compact('Rack','client','Vendor','rack_unit'));
    }

    //updated
    public function update(Request $req,$id)
    {
     
        $data =Rack::find($id);
        $data['customer_id'] = $req->customer_id;
        $data['vendor_id'] = $req->vendor_id;
        $data['rack_id'] = $req->rack_id;
        $data['user_id']  = Auth::user()->id;
        $data['rack_power_unit'] = $req->rack_power_unit;
        $data['rack_bandwidth'] = $req->rack_bandwidth;
        $data['rack_capacity'] = $req->rack_capacity;
        $data['dc_floor'] = $req->dc_floor;
        $data['dc_area_zone'] = $req->dc_area_zone;
        $data['rack_note'] = $req->rack_note;
        $data['status'] = $req->status;
        $data->save(); 

        RackUnit::where('rack_id',$id)->delete();
        
        $rackIdCount = intval($req->rack_id);

        if($rackIdCount >= $req->unit_no){
        for ($i = 0; $i < $rackIdCount; $i++) { 
                $rackUnit = new RackUnit;
                $rackUnit->rack_id = $data->id;
                $rackUnit->unit_no = $i + 1;
                $rackUnit->user_id = Auth::user()->id;
                $rackUnit->serial_no =  $req->serial_no[$i];
                $rackUnit->serial_tag = $req->serial_tag[$i];
                $rackUnit->save();
            }
        }else{


           for ($i = 0; $i < $rackIdCount; $i++) {
                    $rackUnit = new RackUnit;
                    $rackUnit->rack_id = $data->id;
                    $rackUnit->unit_no = $i + 1;
                    if (isset($req->serial_no[$i])) {
                        $rackUnit->serial_no = $req->serial_no[$i];
                    } else {
                        $rackUnit->serial_no = 0;
                    }
                    if (isset($req->serial_tag[$i])) {
                        $rackUnit->serial_tag = $req->serial_tag[$i];
                    } else {
                        $rackUnit->serial_tag = "";
                    }

                    $rackUnit->save();
                }

        }
        
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Rack Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Rack/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);        

        
        return redirect('Employee/Rack/home')->with('success', "Rack Edited Successfully");
    }
    // delete leads
     public function delete(Request $request,$id)
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Rack Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Rack/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        Rack::find($id)->delete();
        return redirect('Employee/Rack/home')->with('success', "Rack Deleted Successfully");
    }

}
