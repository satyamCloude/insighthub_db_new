<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use App\Models\VendorDetail;
use App\Models\CompanyLogin;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use App\Models\Employee;
use App\Models\Country;
use App\Models\Status;
use App\Models\State;
use App\Models\City;
use App\Models\User;
use Hash;
use Auth;


class EVendorController extends Controller
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
                    
        if($RoleAccess[array_search('Vendor', array_column($RoleAccess, 'per_name'))]['view'] == 1)
        {
            $query = $request->input('search');

            $users = User::select('users.status', 'users.id', 'company_logins.company_name', 'users.created_at', 'users.email', 'users.first_name')
                ->join('vendor_details', 'vendor_details.user_id', 'users.id')
                ->join('company_logins', 'company_logins.id', 'vendor_details.company_id')
                ->where('users.type', '3')
                ->when($query, function ($query) use ($request) {
                    $query->where(function ($q) use ($request) {
                        $q->where('users.first_name', 'like', '%' . $request->input('search') . '%')
                            ->orWhere('users.email', 'like', '%' . $request->input('search') . '%')
                            ->orWhere('company_logins.company_name', 'like', '%' . $request->input('search') . '%');
                    });
                })
                ->orderBy('users.created_at', 'desc')
                ->paginate(10);
            $users->appends(['search' => $query]);    

            $TotalVendor = User::where('type', '3')->count();
            $Active = User::where('status', '1')->where('type', '3')->count();
            $InActive = User::where('status', '2')->where('type', '3')->count();
            $Closed = User::where('status', '3')->where('type', '3')->count();
        }

        if($RoleAccess[array_search('Vendor', array_column($RoleAccess, 'per_name'))]['view'] == 2)
        {
            $query = $request->input('search');

            $users = User::select('users.status', 'users.id', 'company_logins.company_name', 'users.created_at', 'users.email', 'users.first_name')
                ->join('vendor_details', 'vendor_details.user_id', 'users.id')
                ->join('company_logins', 'company_logins.id', 'vendor_details.company_id')
                ->where('users.type', '3')
                ->where('users.user_id', auth::user()->id)
                ->when($query, function ($query) use ($request) {
                    $query->where(function ($q) use ($request) {
                        $q->where('users.first_name', 'like', '%' . $request->input('search') . '%')
                            ->orWhere('users.email', 'like', '%' . $request->input('search') . '%')
                            ->orWhere('company_logins.company_name', 'like', '%' . $request->input('search') . '%');
                    });
                })
                ->orderBy('users.created_at', 'desc')
                ->paginate(10);
            $users->appends(['search' => $query]);    

            $TotalVendor = User::where('user_id', auth::user()->id)->where('type', '3')->count();
            $Active = User::where('user_id', auth::user()->id)->where('status', '1')->where('type', '3')->count();
            $InActive = User::where('user_id', auth::user()->id)->where('status', '2')->where('type', '3')->count();
            $Closed = User::where('user_id', auth::user()->id)->where('status', '3')->where('type', '3')->count();

        }
            return view('Employee.user.Vendor.home', compact('RoleAccess','users', 'TotalVendor', 'Active', 'InActive', 'Closed','query'));
    }





    //home page
    public function Create(Request $request)
    {   
        $Country = Country::get();
        $Employee = User::select('first_name','id')->where('type',4)->get();
        $Company = CompanyLogin::select('id','company_name')->get();
        $Status = Status::get();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Vendor Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Vendor/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('Employee.user.Vendor.create',compact('Country','Employee','Company','Status')); 
    }


    //home page
    public function store(Request $req)
    {
       
         $url = url('/').'/public/images/';
        
        // Process profile_img
        $profileFilename = 'default_profile.jpg';
        if ($req->hasFile('profile_img')) {
            $rand = Str::random(4);
            $file = $req->file('profile_img');
            $extension = $file->getClientOriginalExtension();
            $profileFilename = 'profile_'.$rand.'.'.$extension;
            $file->move('public/images/', $profileFilename);
        }
         
        $User = $req->all();
        $User['profile_img'] = $url . $profileFilename;
        $User['password'] = Hash::make($req->password);
        $User['user_id'] = Auth::user()->id;
        $User['type'] = '3';
        $Vendoid = User::create($User);   

        $VendorDetail = $req->all();
        $VendorDetail['user_id'] = $Vendoid->id;
        VendorDetail::create($VendorDetail);

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Vendor Data Store By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Vendor/store';
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);


        return redirect('Employee/Vendor/home')->with('success', "New Vendor Added Successfully");
    }

    //get state data thorugh ajex
    public function Get_StateData(Request $req)
    {
        $State = State::where('country_id',$req->countryid)->get();
        return response()->json(['status'=>200,'success'=>true,'states'=>$State]); 
    }
    //get city data thorugh ajex
    public function Get_CityData(Request $req)
    {
        $City = City::where('state_id',$req->stateid)->get();
        return response()->json(['status'=>200,'success'=>true,'citys'=>$City]); 
    }

    //edit
    public function edit(Request $req,$id)
    {
        $user = User::find($id);
        $VendorDetail = VendorDetail::where('user_id',$id)->first();
        $Status = Status::get();
        $Country = Country::get();
        $State = State::find($VendorDetail->state);
        $City = City::find($VendorDetail->city);
        $Employee = User::select('first_name','id')->where('type',4)->get();
        $Company = CompanyLogin::select('id','company_name')->get();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Vendor Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Vendor/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('Employee.user.Vendor.edit',compact('Country','user','State','City','Employee','Company','Status','VendorDetail'));
    }

    //View
    public function view(Request $req,$id)
    {
        $user = User::find($id);
        $VendorDetail = VendorDetail::where('user_id',$id)->first();
        $Country = Country::find($VendorDetail->country);
        $State = State::find($VendorDetail->state);
        $City = City::find($VendorDetail->city);
        $Company = CompanyLogin::select('company_name')->where('id',$VendorDetail->company_id)->first();
        return view('Employee.user.Vendor.view',compact('Country','user','State','City','Company','VendorDetail'));
    }

    //updated
    public function update(Request $req,$id)
    {
     
        $User =User::find($id);
        $User['first_name'] = $req->first_name;
        $User['email'] = $req->email;
        $User['phone_number'] = $req->phone_number;
        $User['password'] = Hash::make($req->password);
        $User['login_email'] = $req->login_email;
        $User['type'] = '3';
        $User['user_id'] = Auth::user()->id;
        $User['status'] = $req->status;
        $User->save();    

        $Vendor =VendorDetail::where('user_id',$id)->first();
        $Vendor['company_id'] = $req->company_id;
        $Vendor['address_1'] = $req->address_1;
        $Vendor['address_2'] = $req->address_2;
        $Vendor['country'] = $req->country;
        $Vendor['state'] = $req->state;
        $Vendor['city'] = $req->city;
        $Vendor['pincode'] = $req->pincode;
        $Vendor['gstin'] = $req->gstin;
        $Vendor['pen_ten_no'] = $req->pen_ten_no;
        $Vendor['cin'] = $req->cin;
        $Vendor['tds'] = $req->tds;
        $Vendor['portal_login_url'] = $req->portal_login_url;
        $Vendor['access_security'] = $req->access_security;
        $Vendor['services_offered'] = $req->services_offered;
        $Vendor->save();    


        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Vendor Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Vendor/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('Employee/Vendor/home')->with('success', "success");
    }

     public function delete(Request $request,$id)
    {
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Vendor Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Vendor/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        User::find($id)->delete();
        User::where('user_id',$id)->delete();
        return redirect('Employee/Vendor/home')->with('success', "Vendor Deleted Successfully");
    }


}
