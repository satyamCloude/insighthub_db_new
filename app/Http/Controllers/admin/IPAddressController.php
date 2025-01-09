<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Collection;
use App\Exports\UsersExport;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use Illuminate\Support\Str;
use App\Models\LeadSource;
use App\Models\IPAddress;
use App\Models\Currency;
use App\Models\Countrys;
use App\Models\Country;
use App\Models\Leads;
use App\Models\State;
use App\Models\City;
use App\Models\User;
use Hash;
use Auth;



class IPAddressController extends Controller
{   
    //home page

        public function home(Request $request)
        {
            $query = IPAddress::select('users.first_name','users.profile_img','users.email', 'i_p_addresses.id', 'i_p_addresses.hostname_id', 'i_p_addresses.ip_address', 'i_p_addresses.status')
                ->leftjoin('users', 'users.id', '=', 'i_p_addresses.customer_id')
                ->where('i_p_addresses.subnet_network_id',0)
                ->whereNull('i_p_addresses.deleted_at')
                ->orderBy('i_p_addresses.created_at', 'desc');

             $searchTerm = '';   

            // Check if a search term is provided
            if ($request->has('search')) {
                $searchTerm = $request->input('search');
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('users.first_name', 'like', '%' . $searchTerm . '%')
                        ->orWhere('i_p_addresses.ip_address', 'like', '%' . $searchTerm . '%');
                });
            }

            $IPAddress = $query->paginate(10);
            $IPAddress->appends(['search' => $searchTerm]); // Append the search term to pagination links

            $Total = IPAddress::count();
            $publicIp = IPAddress::where('ip_type', '1')->count();
            $privateIp = IPAddress::where('ip_type', '2')->count();

            return view('admin.NetworkManagement.IPAddress.home', compact('IPAddress', 'publicIp', 'privateIp', 'searchTerm', 'Total'));
        }

    //home page
    public function Create(Request $request)
    {   
        $Countrys = Countrys::select('country_id','country_name')->get();
        $customer = User::select('id','first_name','last_name','company_name','profile_img')->where('type','2')->get();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "IPAddress Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/IPAddress/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('admin.NetworkManagement.IPAddress.create',compact('Countrys','customer')); 
    }


    //home page
    public function store(Request $req)
    {
        $data = $req->all();
        $data['user_id'] = Auth::user()->id;
        IPAddress::create($data);

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "IPAddress Data Store By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/IPAddress/store';
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('admin/IPAddress/home')->with('success', "New IPAddress Added Successfully");
    }

  
    //edit
    public function edit(Request $req,$id)
    {
        $IPAddress = IPAddress::find($id);
        $Countrys = Countrys::select('country_id','country_name')->get();
        $customer = User::select('id','first_name')->where('type','2')->get();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "IPAddress Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/IPAddress/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('admin.NetworkManagement.IPAddress.edit',compact('IPAddress','Countrys','customer'));
    }

    //updated
    public function update(Request $req,$id)
    {
     
        $data =IPAddress::find($id);
        $data['ip_address'] = $req->ip_address;
        $data['subnet_mask'] = $req->subnet_mask;
        $data['vlan'] = $req->vlan;
        $data['gateway'] = $req->gateway;
        $data['primary_name_server'] = $req->primary_name_server;
        $data['secondary_name_server'] = $req->secondary_name_server;
        $data['dc_location_id'] = $req->dc_location_id;
        $data['ip_type'] = $req->ip_type;
        $data['description'] = $req->description;
        $data['customer_id'] = $req->customer_id;
        $data['user_id'] = Auth::user()->id;
        $data['private_ip'] = $req->private_ip;
        $data->save();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "IPAddress Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/IPAddress/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('admin/IPAddress/home')->with('success', "IPAddress Edited Successfully");
    }
    // delete
     public function delete(Request $request,$id)
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "IPAddress Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/IPAddress/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        IPAddress::find($id)->delete();
        return redirect('admin/IPAddress/home')->with('success', "IPAddress Deleted Successfully");
    }

    // ExportCSV
    public function ExportCSV(Request $request)
        {
             $agent = new Agent();
            $browser = $agent->browser();
            $version = $agent->version($browser);
            $Log = $request->all();
            $Log['user_id'] = Auth::user()->id;
            $Log['ip'] = $request->ip();
            $Log['subject'] = "IPAddress CSV Export  By " . Auth::user()->first_name;
            $Log['url'] = url('/') . '/admin/IPAddress/EXPORTCSV';
            $Log['method'] = "Get";
            $Log['browser'] = $browser . "-" . $version;
            LogActivity::create($Log);

            return Excel::download(new UsersExport, 'IPAddress.csv');
        }


}
