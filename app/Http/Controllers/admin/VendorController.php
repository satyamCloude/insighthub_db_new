<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use League\Flysystem\Filesystem;
use Jenssegers\Agent\Agent;
use App\Models\StorageSetting;
use App\Models\VendorDetail;
use App\Models\CompanyLogin;
use App\Models\LogActivity;
use App\Models\Employee;
use App\Models\Country;
use App\Models\Status;
use App\Models\State;
use App\Models\City;
use App\Models\User;
use Hash;
use Auth;
use Log;

class VendorController extends Controller
{   
    //home page
    public function home(Request $request)
    {
        try {
            $query = $request->input('search');
    
            $users = User::select(
                    'users.status',
                    'users.profile_img',
                    'users.id',
                    'company_logins.company_name',
                    'users.created_at',
                    'users.email',
                    'users.first_name'
                )
                ->join('vendor_details', 'vendor_details.user_id', '=', 'users.id')
                ->join('company_logins', 'company_logins.id', '=', 'vendor_details.company_id')
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
    
            $TotalVendor = User::select(
                    'users.status',
                    'users.profile_img',
                    'users.id',
                    'company_logins.company_name',
                    'users.created_at',
                    'users.email',
                    'users.first_name'
                )
                ->join('vendor_details', 'vendor_details.user_id', '=', 'users.id')
                ->join('company_logins', 'company_logins.id', '=', 'vendor_details.company_id')
                ->where('users.type', '3')
                ->get();
    
            $TotalVendor2 = $TotalVendor->count();
            $Active = $TotalVendor->where('status', '1')->count();
            $InActive = $TotalVendor->where('status', '2')->count();
            $Closed = $TotalVendor->where('status', '3')->count();
    
            return view('admin.user.Vendor.home', compact('users', 'TotalVendor', 'TotalVendor2', 'Active', 'InActive', 'Closed', 'query'));
        } catch (\Exception $e) {
            // Log or handle the exception
            dd($e->getMessage());
        }
    } 

    
    //home page
    public function Create(Request $request)
    {   
        $Country = Country::get();
        $Employee = User::select('first_name','last_name','profile_img','id')->where('type',4)->get();
        // $Company = CompanyLogin::select('id','company_name')->get();
        $company = CompanyLogin::where('user_id', Auth::user()->id)->first();
    
        $Status = Status::get();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Vendor Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Vendor/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('admin.user.Vendor.create',compact('Country','Employee','company','Status')); 
    }


    //home page
    public function store(Request $req)
    {
        // Validate input data
        $validator = Validator::make($req->all(), [
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'first_name' => 'required',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }
        
        $url = url('/') . '/public/images/';
        $StorageSetting = StorageSetting::find(1);
        $rand = Str::random(4);
        $User = $req->all();
           
        // Handle profile image
        $profileFilename = 'default_profile.jpg';
        if ($StorageSetting->status == 0 && $req->hasFile('profile_img')) {
            $file = $req->file('profile_img');
            $extension = $file->getClientOriginalExtension();
            $profileFilename = 'profile_' . $rand . '.' . $extension;
            $file->move(public_path('images'), $profileFilename);
            $User['profile_img'] = $url . $profileFilename;
        } elseif ($StorageSetting->status == 1 && $req->hasFile('profile_img')) {
            $file = $req->file('profile_img');
            $extension = $file->getClientOriginalExtension();
            $profileFilename = 'profile_' . $rand . '.' . $extension;
            $url = $this->Upload($StorageSetting, $profileFilename, $file);
            $User['profile_img'] = $url;
        }
    
        $User['password'] = Hash::make($req->password);
        $User['type'] = '3';
       
        try {
            // Log User data before creation
            Log::info('User data before creation: ' . json_encode($User));
    
            // Create User
            $Vendoid = User::create($User);
            Log::info('User created successfully with ID: ' . $Vendoid->id);
    
            // Prepare VendorDetail data
            $VendorDetail = $req->only([
                'company_id', 'address_1', 'address_2', 'country', 'state',
                'city', 'pincode', 'gstin', 'pen_ten_no', 'cin', 'tds',
                'portal_login_url', 'services_offered'
            ]);
            $VendorDetail['user_id'] = $Vendoid->id;
    
            // Create VendorDetail
            VendorDetail::create($VendorDetail);
            Log::info('VendorDetail created successfully: ' . json_encode($VendorDetail));
    
            // Log activity
            $agent = new Agent();
            $browser = $agent->browser();
            $version = $agent->version($browser);
    
            $Log = [
                'user_id' => Auth::user()->id,
                'ip' => $req->ip(),
                'subject' => "Vendor Data Store By " . Auth::user()->first_name,
                'url' => url('/') . '/admin/Vendor/store',
                'method' => "Post",
                'browser' => $browser . "-" . $version,
            ];
            LogActivity::create($Log);
            
            // echo "Successfully";die;
            return redirect('admin/Vendor/home')->with('success', "New Vendor Added Successfully");
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error adding new vendor: ' . $e->getMessage());
            return redirect()->back()->withInput()->withErrors(['error' => 'Failed to add new vendor. Please try again.']);
        }
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
        $Employee = User::select('first_name','last_name','profile_img','id')->where('type',4)->get();
        // $Company = CompanyLogin::select('id','company_name')->get();
        $company = CompanyLogin::where('user_id',Auth::user()->id)->first();
        
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Vendor Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Vendor/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('admin.user.Vendor.edit',compact('Country','user','State','City','Employee','company','Status','VendorDetail'));
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
        return view('admin.user.Vendor.view',compact('Country','user','State','City','Company','VendorDetail'));
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
        $User['status'] = $req->status;

        $url = url('/').'/public/images/';
        $StorageSetting = StorageSetting::find(1);
        $rand = Str::random(4);
        if ($StorageSetting->status == 0) {
            $profileFilename = 'default_profile.jpg';
            if ($req->hasFile('profile_img')) {
                $file = $req->file('profile_img');
                $extension = $file->getClientOriginalExtension();
                $profileFilename = 'profile_'.$rand.'.'.$extension;
                $file->move('public/images/', $profileFilename);
                $User['profile_img'] = $url . $profileFilename;
                }
        }

        if ($StorageSetting->status == 1) {
            $profileFilename = 'default_profile.jpg';
            if ($req->hasFile('profile_img')) {
                $file = $req->file('profile_img');
                $extension = $file->getClientOriginalExtension();
                $profileFilename = 'profile_'.$rand.'.'.$extension;
                $url = $this->Upload($StorageSetting, $profileFilename, $file);
                $User['profile_img'] = $url; 
            }
        }
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
        $Log['url'] = url('/') . '/admin/Vendor/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('admin/Vendor/home')->with('success', "success");
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
        $Log['url'] = url('/') . '/admin/Vendor/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        User::find($id)->delete();
        User::where('user_id',$id)->delete();
        return redirect('admin/Vendor/home')->with('success', "Vendor Deleted Successfully");
    }

    public function Upload($StorageSetting, $fileName, $file)
    {
        config([
            'filesystems.disks.s3.key' => $StorageSetting->AWS_ACCESS_KEY_ID,
            'filesystems.disks.s3.secret' => $StorageSetting->AWS_SECRET_ACCESS_KEY,
            'filesystems.disks.s3.region' => $StorageSetting->AWS_DEFAULT_REGION,
            'filesystems.disks.s3.bucket' => $StorageSetting->AWS_BUCKET,
        ]);

        $basePath = 'images/'.date('y').'/'.date('m').'/' . $fileName;
        
        $path = Storage::disk('s3')->put($basePath, $file);

        $url =  $StorageSetting->S3_BASE_URL. '/' . $path;
        return $url;
    }


}
