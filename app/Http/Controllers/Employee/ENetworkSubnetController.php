<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use App\Models\NetworkSubnet;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use Illuminate\Support\Str;
use App\Models\IPAddress;
use App\Models\LeadSource;
use App\Models\Currency;
use App\Models\Countrys;
use App\Models\Country;
use App\Models\EmployeeDetail;
use App\Models\Leads;
use App\Models\State;
use App\Models\User;
use App\Models\City;
use Hash;
use Auth;


class ENetworkSubnetController extends Controller
{   
    //home page
   public function home(Request $request)
{
    $emp = EmployeeDetail::where('user_id',Auth::user()->id)->first();

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
                    
     if($RoleAccess[array_search('NetworkSubnet', array_column($RoleAccess, 'per_name'))]['view'] == 1)
        {
            $query = NetworkSubnet::orderBy('created_at', 'desc');

            $searchTerm ='';

            // Check if a search term is provided
            if ($request->has('search')) {
                $searchTerm = $request->input('search');
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('network_subnet', 'like', '%' . $searchTerm . '%')
                      ->orWhere('gateway', 'like', '%' . $searchTerm . '%')
                      ->orWhere('private_ip', 'like', '%' . $searchTerm . '%');
                });
            }

            $NetworkSubnet = $query->paginate(10);
            $NetworkSubnet->appends(['search' => $query]);

            $Total = NetworkSubnet::count();
            $totalpublicpi = NetworkSubnet::where('ip_type', '1')->count();
            $totalprivatepi = NetworkSubnet::where('ip_type', '2')->count();


        }
     if($RoleAccess[array_search('NetworkSubnet', array_column($RoleAccess, 'per_name'))]['view'] == 2)
        {
            $query = NetworkSubnet::where('user_id',Auth::user()->id)->orderBy('created_at', 'desc');

            $searchTerm ='';

            // Check if a search term is provided
            if ($request->has('search')) {
                $searchTerm = $request->input('search');
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('network_subnet', 'like', '%' . $searchTerm . '%')
                      ->orWhere('gateway', 'like', '%' . $searchTerm . '%')
                      ->orWhere('private_ip', 'like', '%' . $searchTerm . '%');
                });
            }

            $NetworkSubnet = $query->paginate(10);
            $NetworkSubnet->appends(['search' => $query]);

            $Total = NetworkSubnet::where('user_id',Auth::user()->id)->count();
            $totalpublicpi = NetworkSubnet::where('user_id',Auth::user()->id)->where('ip_type', '1')->count();
            $totalprivatepi = NetworkSubnet::where('user_id',Auth::user()->id)->where('ip_type', '2')->count();


        }
    return view('Employee.NetworkManagement.NetworkSubnet.home', compact('RoleAccess','emp','NetworkSubnet', 'totalpublicpi', 'totalprivatepi','searchTerm','Total'));
}


       //home page
    public function views(Request $request,$id)
    {   
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "NetworkSubnet View is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/NetworkSubnet/view/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);
        $IPAddress = IPAddress::where('subnet_network_id', $id)->paginate(10);
        $NetworkSubnet = NetworkSubnet::find($id);

        $Countrys = Countrys::select('country_id','country_name')->get();
        return view('Employee.NetworkManagement.NetworkSubnet.view',compact('Countrys','IPAddress','NetworkSubnet','id')); 
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
        $Log['subject'] = "NetworkSubnet Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/NetworkSubnet/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        $Countrys = Countrys::select('country_id','country_name')->get();
        return view('Employee.NetworkManagement.NetworkSubnet.create',compact('Countrys')); 
    }


    //home page
    public function store(Request $req)
    {
        $data = $req->all();
        $data['user_id'] = Auth::user()->id;
        $data['private_ip'] = request()->ip();
        NetworkSubnet::create($data);   

         $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "NetworkSubnet Data Store By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/NetworkSubnet/store';
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);


        return redirect('Employee/NetworkSubnet/home')->with('success', "New NetworkSubnet Added Successfully");
    }

  
    //edit
    public function edit(Request $req,$id)
    {
        $NetworkSubnet = NetworkSubnet::find($id);
        $Countrys = Countrys::select('country_id','country_name')->get();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "NetworkSubnet Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/NetworkSubnet/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('Employee.NetworkManagement.NetworkSubnet.edit',compact('NetworkSubnet','Countrys'));
    }

    //updated
    public function update(Request $req,$id)
    {
     
        $data =NetworkSubnet::find($id);
        $data['network_subnet'] = $req->network_subnet;
        $data['subnet_mask'] = $req->subnet_mask;
        $data['vlan'] = $req->vlan;
        $data['gateway'] = $req->gateway;
        $data['primary_name_server'] = $req->primary_name_server;
        $data['secondary_name_server'] = $req->secondary_name_server;
        $data['dc_location_id'] = $req->dc_location_id;
        $data['ip_type'] = $req->ip_type;
        $data['description'] = $req->description;
        $data['user_id'] = Auth::user()->id;
        $data['private_ip'] = request()->ip();
        $data->save();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "NetworkSubnet Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/NetworkSubnet/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);  

        return redirect('Employee/NetworkSubnet/home')->with('success', "NetworkSubnet Edited Successfully");
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
        $Log['subject'] = "NetworkSubnet Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/NetworkSubnet/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        NetworkSubnet::find($id)->delete();
        return redirect('Employee/NetworkSubnet/home')->with('success', "NetworkSubnet Deleted Successfully");
    }

}
