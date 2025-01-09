<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Collection;
use App\Models\OperatingSysten;
use App\Models\PaymentMethod;   
use Illuminate\Http\Request;
use App\Exports\TaskExport; 
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use Illuminate\Support\Str;
use App\Models\IPAddress;
use App\Models\Countrys;
use App\Models\EmployeeDetail;
use App\Models\Currency;   
use App\Models\Firewall;
use App\Models\Product;
use App\Models\Switchs;
use App\Models\Status;
use App\Models\ProjectCategory;
use App\Models\Department;
use App\Models\User;
use App\Models\Rack;
use App\Models\Project;
use App\Models\Task; 
use App\Models\StorageSetting;
use Illuminate\Support\Facades\Storage;  
use Hash;
use Auth;

class EProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
    
        if($RoleAccess[array_search('Project', array_column($RoleAccess, 'per_name'))]['view'] == 1)
        {
            $query = Project::select(
                                    'client_details.id as client_details_id',
                                    'company_logins.company_name',
                                    'users.profile_img as project_manager_picture',
                                    'users.first_name as project_manager_name',
                                    'projects.deadline',
                                    'projects.start_date',
                                    'projects.status_pro',
                                    'projects.team_id',
                                    'projects.id',
                                    'projects.deadline',
                                    'projects.status_id',
                                    'projects.project_name'
                                )
                                ->leftjoin('users', 'users.id', '=', 'projects.client_id')
                                ->leftjoin('client_details', 'client_details.user_id', '=', 'users.id')
                                ->leftjoin('company_logins', 'client_details.company_id', '=', 'company_logins.id')
                                ->orderBy('projects.created_at', 'desc');


                $search = '';    

                // Check if there is a search query
                if ($request->has('search')) {
                    $search = $request->input('search');
                    $query->where(function ($q) use ($search) {
                        $q->where('users.first_name', 'LIKE', '%' . $search . '%')
                            ->orWhere('projects.project_name', 'LIKE', '%' . $search . '%')
                            ->orWhere('projects.deadline', 'LIKE', '%' . $search . '%')
                            ->orWhere('projects.is_public', 'LIKE', '%' . $search . '%');
                    });
                }

                $Task = $query->paginate(10);
                $Task->appends(['search' => $search]);    

                $InProgress = Project::where('status_id', 1)->count();
                $Completed = Project::where('status_id', 2)->count();
                $OverDue = Project::where('status_id', 3)->count();
                $Cancel = Project::where('status_id', 4)->count();
                
            
        }

        if($RoleAccess[array_search('Project', array_column($RoleAccess, 'per_name'))]['view'] == 2)
        {
            $query = Project::select(
                                    'client_details.id as client_details_id',
                                    'company_logins.company_name',
                                    'users.profile_img as project_manager_picture',
                                    'users.first_name as project_manager_name',
                                    'projects.deadline',
                                    'projects.start_date',
                                    'projects.status_pro',
                                    'projects.team_id',
                                    'projects.id',
                                    'projects.deadline',
                                    'projects.status_id',
                                    'projects.project_name'
                                )
                                ->leftjoin('users', 'users.id', '=', 'projects.client_id')
                                ->leftjoin('client_details', 'client_details.user_id', '=', 'users.id')
                                ->leftjoin('company_logins', 'client_details.company_id', '=', 'company_logins.id')
                                ->where('projects.user_id',Auth::user()->id)
                                ->orderBy('projects.created_at', 'desc');


                $search = '';    

                // Check if there is a search query
                if ($request->has('search')) {
                    $search = $request->input('search');
                    $query->where(function ($q) use ($search) {
                        $q->where('users.first_name', 'LIKE', '%' . $search . '%')
                            ->orWhere('projects.project_name', 'LIKE', '%' . $search . '%')
                            ->orWhere('projects.deadline', 'LIKE', '%' . $search . '%')
                            ->orWhere('projects.is_public', 'LIKE', '%' . $search . '%');
                    });
                }

                $Task = $query->paginate(10);
                $Task->appends(['search' => $search]);    

                $InProgress = Project::where('user_id',Auth::user()->id)->where('status_id', 1)->count();
                $Completed = Project::where('user_id',Auth::user()->id)->where('status_id', 2)->count();
                $OverDue = Project::where('user_id',Auth::user()->id)->where('status_id', 3)->count();
                $Cancel = Project::where('user_id',Auth::user()->id)->where('status_id', 4)->count();
                
                    
        }
                return view('Employee.Project.home', compact('RoleAccess','Task', 'InProgress', 'Completed', 'OverDue', 'Cancel','search'));
            }




    //home page
    public function Create(Request $request)
    {   
        $Vendor = User::select('id','first_name')->where('type','3')->get();
        $Client = User::select('id','first_name')->where('type','2')->get();
        $Employee = User::select('first_name','id')->where('type',4)->get();
        $ProjectCategory = ProjectCategory::all();
        $Department = Department::all();
        $Project = EmployeeDetail::select('users.first_name','users.id')->join('users','users.id','employee_details.user_id')->where('employee_details.team_lead','1')->get();


        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Task Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Task/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('Employee.Project.create',compact('Vendor','Employee','Client','Project','ProjectCategory','Department')); 
    }



  public function store(Request $request)
{
        $StorageSetting = StorageSetting::find(1);
        $project = $request->all();

        if ($request->hasFile('Document')) {
            $Document = 'profile_' . Str::random(4) . '.' . $request->file('Document')->getClientOriginalExtension();

            if ($StorageSetting->status == 0) {
                $request->file('Document')->move(public_path('images/'), $Document);
                $project['Document'] = url('public/images') . '/' . $Document;
            } else {
                $project['Document'] = $this->uploadToS3($StorageSetting, $Document, $request->file('Document'));
            }
        }

        $project['user_id'] = auth()->user()->id;
        $teamMembers = implode(',', $request->input('team_id'));
        $project['team_id'] = $teamMembers;

        Project::create($project);

        return redirect('Employee/Project/home')->with('success', 'Project added successfully');
}

private function uploadToS3($StorageSetting, $fileName, $file)
{
    config([
        'filesystems.disks.s3.key' => $StorageSetting->AWS_ACCESS_KEY_ID,
        'filesystems.disks.s3.secret' => $StorageSetting->AWS_SECRET_ACCESS_KEY,
        'filesystems.disks.s3.region' => $StorageSetting->AWS_DEFAULT_REGION,
        'filesystems.disks.s3.bucket' => $StorageSetting->AWS_BUCKET,
    ]);

    $basePath = 'images/' . date('y') . '/' . date('m') . '/' . $fileName;
    $path = Storage::disk('s3')->put($basePath, $file, 'public');
    $url = $StorageSetting->S3_BASE_URL . '/' . $path;

    return $url;
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
    //edit
    public function edit(Request $req,$id)
    {
        $Task = Project::find($id);
        $Department = Department::all();
        $Vendor = User::select('id','first_name')->where('type','3')->get();
        $Client = User::select('id','first_name')->where('type','2')->get();
        $Employee = User::select('first_name','id')->where('type',4)->get();
        $Project = EmployeeDetail::select('users.first_name','users.id')->join('users','users.id','employee_details.user_id')->where('employee_details.team_lead','1')->get();
        $ProjectCategory = ProjectCategory::all();
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Task Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/Employee/Task/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return view('Employee.Project.edit',compact('Task','Vendor','Employee','Client','Project','ProjectCategory','Department','id'));
    }




public function update(Request $request, $id)
{
            $StorageSetting = StorageSetting::find(1);
            $data = Project::find($id);
            $project = $request->all();

            if ($request->hasFile('Document')) {
                $Document = 'profile_' . Str::random(4) . '.' . $request->file('Document')->getClientOriginalExtension();

                if ($StorageSetting->status == 0) {
                    $request->file('Document')->move(public_path('images/'), $Document);
                    $project['Document'] = url('public/images') . '/' . $Document;
                } else {
                    $project['Document'] = $this->uploadToS3($StorageSetting, $Document, $request->file('Document'));
                }
            } else {
                // Handle case where no new document is uploaded, retain existing URL or handle as needed
            }

            $project['user_id'] = auth()->user()->id;
            $teamMembers = implode(',', $request->input('team_id'));
            $project['team_id'] = $teamMembers;

            $data->update($project);
            return redirect('Employee/Project/home')->with('success', 'Project updated successfully');
        }

   

     public function delete(Request $request,$id)
    {
       

        Project::find($id)->delete();
        return redirect('Employee/Project/home')->with('success', "Project Deleted Successfully");
    }

      // ExportCSV
    public function EXPORTCSV(Request $request)
    {
         $agent = new Agent();
            $browser = $agent->browser();
            $version = $agent->version($browser);
            $Log = $request->all();
            $Log['user_id'] = Auth::user()->id;
            $Log['ip'] = $request->ip();
            $Log['subject'] = "Task CSV Export  By " . Auth::user()->first_name;
            $Log['url'] = url('/') . '/Employee/Task/EXPORTCSV';
            $Log['method'] = "Get";
            $Log['browser'] = $browser . "-" . $version;
            LogActivity::create($Log);


        return Excel::download(new TaskExport, 'Task.csv');
    }

      // UpdateStatus
    public function UpdateStatus(Request $request)
    {
        

        if($request->status == "progress")
        {
            $Task = Project::find($request->id);
            $Task->status_pro = $request->status_pro;
            if($request->status_pro == 100)
            {
                $Task->status_id = 2; 
            }else
            {
                $Task->status_id = 1; 

            }
            $Task->save();

        }elseif($request->status == "stu"){
            $Task = Project::find($request->id);
             $Task->status_id = $request->status_pro;
            $Task->save();
        }
        


        return response()->json(['success',true]);
         
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        //
    }

    public function view() {
        return view('Employee/Project/view');
    }
}
