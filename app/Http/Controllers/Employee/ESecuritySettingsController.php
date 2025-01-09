<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller; 
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use App\Models\MailSettings;
use App\Models\OneTimeSetup;
use App\Models\LogActivity;
use App\Models\Security;
use App\Models\User;
use Hash;
use Auth;


class ESecuritySettingsController extends Controller
{   
    //home page
  public function home(Request $request)
{
        $Bulk = MailSettings::select('smtp','chimps','microsoft')->where('user_id',Auth::user()->id)->where('id',1)->first();
        $Complete = MailSettings::select('smtp','chimps','microsoft')->where('user_id',Auth::user()->id)->where('id',2)->first();

    return view('Employee.settings.SecuritySettings.home', compact('Complete','Bulk'));
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
        $Log['url'] = url('/') . '/Employee/Security/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('Employee.settings.SecuritySettings.create'); 
    }


public function confirm_password(Request $request)
{
    // Retrieve password and user_id from the request
    $confirm_password = $request->input('password');
    $user_id = $request->input('user_id');

    // Find the user by user_id
    $user = User::find($user_id);

    // Check if the user exists
    if (!$user) {
        return response()->json([
            'status' => 'fail',
            'message' => 'User not found',
        ]);
    }

    // Check if the provided password matches the hashed password in the database
    if (Hash::check($confirm_password, $user->password)) {

        // Check if OneTimeSetup record exists for the user
        $oneTimeSetup = OneTimeSetup::where('user_id', $user_id)->first();

        if ($oneTimeSetup) {
            // Update existing record
            $oneTimeSetup->is_authentication_enabled = 1;
            $oneTimeSetup->save();
        } else {
            // Create a new record
            $oneTimeSetup = new OneTimeSetup;
            $oneTimeSetup->user_id = $user_id;
            $oneTimeSetup->is_authentication_enabled = 1;
            $oneTimeSetup->save();
        }

        // Password is correct
        return response()->json([
            'status' => 'success',
            'message' => 'Password is correct',
            'id' => $user->id,
        ]);
    } else {
        // Password is incorrect
        return response()->json([
            'status' => 'fail',
            'message' => 'Password is incorrect',
        ]);
    }
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
            $Log['url'] = url('/') . '/Employee/Security/store';
            $Log['method'] = "Post";
            $Log['browser'] = $browser . "-" . $version;
            LogActivity::create($Log);
    

        return redirect('Employee/Security/home')->with('success', "New Security Added Successfully");
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
        $Log['url'] = url('/') . '/Employee/Security/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        $Security = Security::find($id);
        return view('Employee.settings.SecuritySettings.edit',compact('Security'));
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
        $Log['url'] = url('/') . '/Employee/Security/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('Employee/Security/home')->with('success', "Security Edit Successfully");
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
        $Log['url'] = url('/') . '/Employee/Security/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        Security::find($id)->delete();
        return redirect('Employee/Security/home')->with('success', "Security Deleted Successfully");
    }  
      public function mail_setup(Request $request)
    {
       // return redirect('Employee/Security/home')->with('success', "Security Deleted Successfully");
    }


}
