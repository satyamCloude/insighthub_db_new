<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use App\Models\NetworkSubnet;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use Illuminate\Support\Str;
use App\Models\LeadSource;
use App\Models\Currency;
use App\Models\Countrys;
use App\Models\Country;
use App\Models\Leads;
use App\Models\State;
use App\Models\User;
use App\Models\City;
use App\Models\IPAddress;
use Hash;
use Auth;


class NetworkSubnetController extends Controller
{   
    //home page
   public function home(Request $request)
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

    return view('admin.NetworkManagement.NetworkSubnet.home', compact('NetworkSubnet', 'totalpublicpi', 'totalprivatepi','searchTerm','Total'));
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
        $Log['url'] = url('/') . '/admin/NetworkSubnet/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        $Countrys = Countrys::select('country_id','country_name')->get();
        return view('admin.NetworkManagement.NetworkSubnet.create',compact('Countrys')); 
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
        $NetworkSubnet = NetworkSubnet::find($id);
        $IPAddress = IPAddress::where('subnet_network_id', $id)->paginate(10);

        $Countrys = Countrys::select('country_id','country_name')->get();
        return view('admin.NetworkManagement.NetworkSubnet.view',compact('Countrys','IPAddress','id','NetworkSubnet')); 
    }


    //home page
public function store(Request $req)
{
    // Extract subnet range from the request
    $range1 = $req->input('range1');
    $range2 = $req->input('range2');

    // Create NetworkSubnet record
    $data = $req->all();
    $data['user_id'] = Auth::user()->id;
    $data['private_ip'] = request()->ip();
    $subnetNetwork = NetworkSubnet::create($data);

    // Generate and save IP addresses within the subnet range
    $user_id = Auth::user()->id;
    for ($i = ip2long($range1); $i <= ip2long($range2); $i++) {
        $ip = long2ip($i);
        // Save IP address using the IPAddress model
        IPAddress::create([
            'user_id' => $user_id,
            'subnet_network_id' => $subnetNetwork->id,
            'ip_address' => $ip,
            // You can add other fields here if needed
        ]);
    }

    // Log activity
    $agent = new Agent();
    $browser = $agent->browser();
    $version = $agent->version($browser);
    $Log = $req->all();
    $Log['user_id'] = $user_id;
    $Log['ip'] = $req->ip();
    $Log['subject'] = "NetworkSubnet Data Store By " . Auth::user()->first_name;
    $Log['url'] = url('/') . '/admin/NetworkSubnet/store';
    $Log['method'] = "Post";
    $Log['browser'] = $browser . "-" . $version;
    LogActivity::create($Log);

    return redirect('admin/NetworkSubnet/home')->with('success', "New NetworkSubnet Added Successfully");
}



    // Calculate subnet mask based on CIDR notation
    // public function calculateSubnetRange($cidr)
    // {
    //     // Extract the network address and subnet mask length from CIDR notation
    //     list($network, $subnetMaskLength) = explode('/', $cidr);

    //     // Convert the subnet mask length to an integer
    //     $subnetMaskLength = intval($subnetMaskLength);

    //     // Calculate the subnet mask
    //     $subnetMask = 0xffffffff << (32 - $subnetMaskLength);

    //     // Convert network address to long format
    //     $networkLong = ip2long($network);

    //     // Calculate the first IP address in the range
    //     $firstIP = $networkLong & $subnetMask;

    //     // Calculate the last IP address in the range
    //     $lastIP = $firstIP | (~$subnetMask & 0xffffffff);

    //     // Convert long IP addresses to standard IP format
    //     $firstIP = long2ip($firstIP);
    //     $lastIP = long2ip($lastIP);

       

    //     return array($firstIP, $lastIP);
    // }


  
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
        $Log['url'] = url('/') . '/admin/NetworkSubnet/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('admin.NetworkManagement.NetworkSubnet.edit',compact('NetworkSubnet','Countrys'));
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
        $Log['url'] = url('/') . '/admin/NetworkSubnet/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);  

        return redirect('admin/NetworkSubnet/home')->with('success', "NetworkSubnet Edited Successfully");
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
        $Log['url'] = url('/') . '/admin/NetworkSubnet/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        NetworkSubnet::find($id)->delete();
        return redirect('admin/NetworkSubnet/home')->with('success', "NetworkSubnet Deleted Successfully");
    }

}
