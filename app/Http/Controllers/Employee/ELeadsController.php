<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use App\Models\CompanyLogin;
use App\Models\LogActivity;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use App\Models\LeadSource;
use App\Models\LeadStatus;
use App\Models\Employee;
use App\Models\Currency;
use App\Models\LeadsFollowup;
use App\Models\LeadFile;
use App\Models\StorageSetting;
use Illuminate\Support\Facades\Storage;
use App\Models\Country;
use App\Models\Category;
use App\Models\Leads;
use App\Models\State;
use App\Models\City;
use App\Models\User;
use Hash;
use Auth;
use Carbon\Carbon;
use Validator;


class ELeadsController extends Controller
{   
    //home page
public function home(Request $request)
{

    $RoleAccess = \App\Models\RoleAccess::select('role_accesses.add', 'role_accesses.view', 'role_accesses.update', 'role_accesses.delete', 'permissions.name as per_name')
        ->leftJoin('employee_details', 'employee_details.job_role_id', 'role_accesses.role_id')
        ->leftjoin('permissions', 'permissions.id', 'role_accesses.permission_id')
        ->where('employee_details.user_id', Auth::user()->id)
        ->where(function ($query) {
            $query->where('role_accesses.view', '!=', null)
                ->orWhere('role_accesses.add', '!=', null)
                ->orWhere('role_accesses.update', '!=', null)
                ->orWhere('role_accesses.delete', '!=', null);
        })
        ->get()
        ->toArray();

    $query = Leads::select('generated_user.first_name as generated_by_first_name','generated_user.last_name as generated_by_last_name','jobroles.name as desgname','generated_user.id as generated_by_id', 'generated_user.profile_img', 'generated_user.email', 'leads.first_name','leads.last_name','leads.company_name', 'leads.phone_number', 'leads.requirement', 'leads.status', 'lead_statuses.label_color as leadStatusColor', 'leads.id', 'leads.assignedto', 'roles.name as post_name')
                    ->leftJoin('users as generated_user', 'generated_user.id', 'leads.generated_by')
                    ->leftJoin('lead_statuses', 'lead_statuses.id', 'leads.leadStatus')
                    ->leftJoin('employee_details', 'employee_details.user_id', 'generated_user.id')
                    ->leftJoin('roles', 'roles.id', 'employee_details.admin_type_id')
                    ->leftJoin('jobroles', 'jobroles.id', 'employee_details.jobrole_id')
                    ->leftJoin('users as assigned_user', 'assigned_user.id', 'leads.assignedto')
        ->where(function ($query) {
            $query->orWhere('leads.assignedto', Auth::user()->id)
                ->orWhere('leads.generated_by', Auth::user()->id);
        })
        ->orderBy('leads.created_at', 'desc');

    // Filter by month if selected
    if ($request->has('month')) {
        $query->whereMonth('leads.created_at', $request->month);
    }
      // Filter by date range if provided and not empty
    if ($request->filled('from') && $request->filled('to')) {
        $from = $request->input('from');
        $to = $request->input('to');

        $query->whereDate('leads.created_at', '>=', $from)
              ->whereDate('leads.created_at', '<=', $to);
    }


    $searchTerm = '';
    if ($request->has('search')) {
        $searchTerm = $request->input('search');
        $query->where(function ($q) use ($searchTerm) {
            $q->where('leads.first_name', 'like', '%' . $searchTerm . '%')
                ->orWhere('assigned_user.first_name', 'like', '%' . $searchTerm . '%')
                ->orWhere('generated_user.first_name', 'like', '%' . $searchTerm . '%')
                ->orWhere('leads.requirement', 'like', '%' . $searchTerm . '%')
                ->orWhere('leads.phone_number', 'like', '%' . $searchTerm . '%');
        });
    }

    $users = $query->paginate(10);
    $users->appends(['search' => $searchTerm]);

    $TotalLeads = Leads::where(function ($query) {
        $query->orWhere('assignedto', Auth::user()->id)
            ->orWhere('generated_by', Auth::user()->id);
    });

    // Filter by month if selected
    if ($request->has('month')) {
        $TotalLeads->whereMonth('created_at', $request->month);
    }

    $TotalLeads = $TotalLeads->count();

    // Count leads based on status
    $progress = Leads::where('status', '1')->where(function ($query) {
        $query->orWhere('assignedto', Auth::user()->id)
            ->orWhere('generated_by', Auth::user()->id);
    });

    // Filter by month if selected
    if ($request->has('month')) {
        $progress->whereMonth('created_at', $request->month);
    }

    $progress = $progress->count();

    // Similarly, count leads for win and loss
    $win = Leads::where('status', '3')->where(function ($query) {
        $query->orWhere('assignedto', Auth::user()->id)
            ->orWhere('generated_by', Auth::user()->id);
    });

    // Filter by month if selected
    if ($request->has('month')) {
        $win->whereMonth('created_at', $request->month);
    }

    $win = $win->count();

    $loss = Leads::where('status', '4')->where(function ($query) {
        $query->orWhere('assignedto', Auth::user()->id)
            ->orWhere('generated_by', Auth::user()->id);
    });

    // Filter by month if selected
    if ($request->has('month')) {
        $loss->whereMonth('created_at', $request->month);
    }

    $loss = $loss->count();

    $Employee = User::select('users.first_name', 'users.id', 'users.profile_img', 'roles.name as post_name')
        ->where('users.type', 4)
        ->leftJoin('employee_details', 'employee_details.user_id', 'users.id')
        ->leftJoin('roles', 'roles.id', 'employee_details.admin_type_id')
        ->get();

    return view('Employee.sales.Leads.home', compact('Employee', 'RoleAccess', 'users', 'TotalLeads', 'progress', 'win', 'loss', 'searchTerm'));
}


  // Leads update notes leads
           public function LeadNotesUpdate(Request $request)
            {
                $Update = Leads::find($request->lead_id);
                $Update->note = $request->note;
                $Update->save();
    
                     return redirect('Employee/Leads/home')->with('success', "Leads Notes Updated Successfully");
    
    
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
        $Log['type'] = 'lead';
        $Log['subject'] = "Create page is opened";
        $Log['url'] = url('/') . '/admin/Leads/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);
        $Country = Country::all();
        $leads = LeadSource::get();
        $categories = Category::select('id','category_name','faIcon')->get();
        $Employee =  User::
            leftjoin('employee_details','employee_details.user_id','users.id')
            ->leftjoin('jobroles','jobroles.id','employee_details.jobrole_id')
            ->where('users.type', '4')
            ->select('users.*','jobroles.name as jobrole')
            ->get();
         $Company = CompanyLogin::select('id','company_name')->get();


        return view('Employee.sales.Leads.create',compact('leads','Employee','Company','categories')); 
    }


    //home page
    public function store(Request $req)
    {

         $validator = Validator::make($req->all(), [
            'requirement' => 'required',
           
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } 
        $leadStatus = LeadStatus::where('is_default', 1)->first();
        $data = $req->all();
        $data['status'] = $leadStatus->id;
        $data['leadStatusColor'] = $leadStatus->label_color;
        $data['leadStatus'] = $leadStatus->id;
        $data['generated_by'] = Auth::user()->id;
        
        // Create lead
        $lead = Leads::create($data);
        
               
            $StorageSetting = StorageSetting::find(1);
            $storageLocal = $StorageSetting->status == 0;

            // File storage path
            $storagePath = 'lead_files/';
        
                    // Process file uploads if files are present
                if ($req->hasFile('file')) {
                    foreach ($req->file('file') as $key => $file) {
                        // Generate unique filename
                        $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                        $extension = $file->getClientOriginalExtension();
                        $profileFilename = $originalFileName . '_' . Str::random(4) . '.' . $extension;

                        if ($storageLocal) {
                            // Move file to local storage
                            $file->move(public_path($storagePath), $profileFilename);
                            $fileUrl = url($storagePath . $profileFilename);
                        } else {
                            // Upload file to S3
                            $fileUrl = $this->Upload($StorageSetting, $profileFilename, $file);
                        }

                        // Save file details to database
                        $leadFile = new LeadFile;
                        $leadFile->file = $fileUrl;
                        $leadFile->file_name = $originalFileName;
                        $leadFile->leads_id = $lead->id;
                        $leadFile->user_id = Auth::user()->id;
                        $leadFile->save();
                    }
            }

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "(#".$lead->id.") Lead Created";
        $Log['type'] = "lead";
        $Log['url'] = url('/') . '/Employee/Leads/store';
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('Employee/Leads/home')->with('success', "New Lead Added Successfully");
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
public function getleadsYearfilterdata(Request $request)
{
    $year = $request->year;
    $month = $request->month;
    $userId = Auth::user()->id;

    // Filter leads based on the selected month and year and assigned/generated by current user
    $TotalLeads = Leads::whereYear('created_at', $year)
                        ->whereMonth('created_at', $month)
                        ->where(function ($query) use ($userId) {
                            $query->where('assignedto', $userId)
                                  ->orWhere('generated_by', $userId);
                        })
                        ->count();

    $progress = Leads::whereYear('created_at', $year)
                     ->whereMonth('created_at', $month)
                     ->where('status', '1')
                     ->where(function ($query) use ($userId) {
                         $query->where('assignedto', $userId)
                               ->orWhere('generated_by', $userId);
                     })
                     ->count();

    $win = Leads::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->where('status', '3')
                ->where(function ($query) use ($userId) {
                    $query->where('assignedto', $userId)
                          ->orWhere('generated_by', $userId);
                })
                ->count();

    $loss = Leads::whereYear('created_at', $year)
                 ->whereMonth('created_at', $month)
                 ->where('status', '4')
                 ->where(function ($query) use ($userId) {
                     $query->where('assignedto', $userId)
                           ->orWhere('generated_by', $userId);
                 })
                 ->count();

    $LeadsFollowup = LeadsFollowup::whereYear('created_at', $year)
                                  ->whereMonth('created_at', $month)
                                  ->whereIn('leads_id', function ($query) use ($userId) {
                                      $query->select('id')
                                            ->from('leads')
                                            ->where('assignedto', $userId)
                                            ->orWhere('generated_by', $userId);
                                  })
                                  ->get();

    return response()->json([
        'status' => 200,
        'success' => true,
        'TotalLeads' => $TotalLeads,
        'progress' => $progress,
        'win' => $win,
        'loss' => $loss,
        'LeadsFollowup' => $LeadsFollowup
    ]);
}


public function ShowFollowUp(Request $req)
{
    $today = Carbon::today()->toDateString();
    $tomorrow = Carbon::tomorrow()->toDateString();
    $thisMonthStart = Carbon::now()->startOfMonth()->toDateString();
    $thisMonthEnd = Carbon::now()->endOfMonth()->toDateString();

    // Query for today's follow-ups
    $today = LeadsFollowup::leftJoin('leads', 'leads.id', 'leads_followups.leads_id')
    ->select(
        'leads_followups.*',
        'leads.first_name',
        'leads.last_name',
        'leads.id as leads_id',
        'leads.requirement',
        'leads.status as leads_status',
        'leads.phone_number',
        'leads.action_schedule'
    )
    ->whereDate('leads_followups.follow_up_next', $today)
    ->get();
    
    // Query for tomorrow's follow-ups
    $tomorrow = LeadsFollowup::leftJoin('leads', 'leads.id', 'leads_followups.leads_id')
    ->select(
        'leads_followups.*',
        'leads.first_name',
        'leads.last_name',
        'leads.id as leads_id',
        'leads.requirement',
        'leads.status as leads_status',
        'leads.phone_number',
        'leads.action_schedule'
    )
    ->whereDate('leads_followups.follow_up_next', $tomorrow)
    ->get();
    
    // Query for this month's follow-ups
    $thisMonth = LeadsFollowup::leftJoin('leads', 'leads.id', 'leads_followups.leads_id')
    ->select(
        'leads_followups.*',
        'leads.first_name',
        'leads.last_name',
        'leads.id as leads_id',
        'leads.requirement',
        'leads.status as leads_status',
        'leads.phone_number',
        'leads.action_schedule'
    )
    ->whereBetween('leads_followups.follow_up_next', [$thisMonthStart, $thisMonthEnd])
    ->get();

    // Fetch employee data if needed
    $Employee = User::select('users.first_name', 'users.id', 'users.profile_img', 'roles.name as post_name')
        ->where('users.type', 4)
        ->leftJoin('employee_details', 'employee_details.user_id', 'users.id')
        ->leftJoin('roles', 'roles.id', 'employee_details.admin_type_id')
        ->paginate(10);

    return view('Employee.sales.Leads.all_follow_up', compact('today','tomorrow','thisMonth','Employee'));
}
 // get_follow_up_type leads
        public function get_follow_up_type(Request $req)
        {
            $leadType = $req->leadType;
            if ($leadType === 'All') {
                    $LeadsFollowup  = LeadsFollowup::leftjoin('leads', 'leads.id', 'leads_followups.leads_id')
                        ->select('leads_followups.*', 'leads.first_name', 'leads.requirement', 'leads.status', 'leads.phone_number')
                        ->orderBy('leads_followups.created_at', 'desc');
                        
                        //  $LeadsFollowup = $LeadsFollowup->paginate(10);
                    $Employee = User::select('users.first_name', 'users.id', 'users.profile_img', 'roles.name as post_name')
                        ->where('users.type', 4)
                        ->leftJoin('employee_details', 'employee_details.user_id', 'users.id')
                        ->leftJoin('roles', 'roles.id', 'employee_details.admin_type_id')
                        ->paginate(10);
            
            } else {
                    $LeadsFollowup  = LeadsFollowup::leftjoin('leads', 'leads.id', 'leads_followups.leads_id')
                        ->select('leads_followups.*', 'leads.first_name', 'leads.requirement', 'leads.status', 'leads.phone_number')
                        ->where('leads.action_schedule', $leadType)
                        ->orderBy('leads_followups.created_at', 'desc');
                        
                        //  $LeadsFollowup = $LeadsFollowup->paginate(10);
                    $Employee = User::select('users.first_name', 'users.id', 'users.profile_img', 'roles.name as post_name')
                        ->where('users.type', 4)
                        ->leftJoin('employee_details', 'employee_details.user_id', 'users.id')
                        ->leftJoin('roles', 'roles.id', 'employee_details.admin_type_id')
                        ->paginate(10);
            }
            
            if ($req->filterVal == 'month') {
                $LeadsFollowup->whereMonth('leads_followups.follow_up_next', date('m'));
            }
            if ($req->filterVal == 'today') {
                $LeadsFollowup->where('leads_followups.follow_up_next', date('Y-m-d'));
            }
            if ($req->filterVal == 'tomorrow') {
                $LeadsFollowup->where('leads_followups.follow_up_next', date('Y-m-d', strtotime('+1 day')));
            } 
            
            if ($req->statusFilter == '0') {
                $LeadsFollowup->where('leads_followups.status', 0);
            } 
            if ($req->statusFilter == '1') {
                $LeadsFollowup->where('leads_followups.status', 1);
            } 
            if ($req->statusFilter == '2') {
                $LeadsFollowup->where('leads_followups.status', 2);
            }
            
            $LeadsFollowup = $LeadsFollowup->paginate(10);
            
            return view('Employee.sales.Leads.Show_follow_up_type', compact('LeadsFollowup', 'Employee'))->with('success', "Type of: $leadType Fetched Successfully");
        }
  //ShowLeads
    public function ShowLeads(Request $request)
    {
                           
                        $query = Leads::select('generated_user.first_name as generated_by_first_name','generated_user.last_name as generated_by_last_name','jobroles.name as desgname','generated_user.id as generated_by_id', 'generated_user.profile_img', 'generated_user.email', 'leads.first_name','leads.last_name','leads.company_name', 'leads.phone_number', 'leads.requirement', 'leads.status', 'lead_statuses.label_color as leadStatusColor', 'leads.id', 'leads.assignedto', 'roles.name as post_name')
                    ->leftJoin('users as generated_user', 'generated_user.id', 'leads.generated_by')
                    ->leftJoin('lead_statuses', 'lead_statuses.id', 'leads.leadStatus')
                    ->leftJoin('employee_details', 'employee_details.user_id', 'generated_user.id')
                    ->leftJoin('roles', 'roles.id', 'employee_details.admin_type_id')
                    ->leftJoin('jobroles', 'jobroles.id', 'employee_details.jobrole_id')
                    ->leftJoin('users as assigned_user', 'assigned_user.id', 'leads.assignedto')
        ->where(function ($query) {
            $query->orWhere('leads.assignedto', Auth::user()->id)
                ->orWhere('leads.generated_by', Auth::user()->id);
        })
        ->orderBy('leads.created_at', 'desc');
                    
                        $searchTerm = '';
                    
                        // Check if a search term is provided
                        if ($request->has('search')) {
                            $searchTerm = $request->input('search');
                            $query->where(function ($q) use ($searchTerm) {
                                $q->where('leads.first_name', 'like', '%' . $searchTerm . '%')
                                  ->orWhere('assigned_user.first_name', 'like', '%' . $searchTerm . '%') // Use assigned_user alias here
                                  ->orWhere('generated_user.first_name', 'like', '%' . $searchTerm . '%')
                                  ->orWhere('leads.requirement', 'like', '%' . $searchTerm . '%')
                                  ->orWhere('leads.phone_number', 'like', '%' . $searchTerm . '%')
                                  ->orWhere('leads.created_at', 'like', '%' . $searchTerm . '%');
                            });
                        }
                    
                        // Filter by date range if provided and not empty
                        if ($request->filled('from') && $request->filled('to')) {
                            $from = $request->input('from');
                            $to = $request->input('to');
                    
                            $query->whereDate('leads.created_at', '>=', $from)
                                  ->whereDate('leads.created_at', '<=', $to);
                        }
                    
                        $users = $query->paginate(10);
                        $users->appends(['search' => $searchTerm]);
                    
                        $TotalLeads = Leads::count();
                        $progress = Leads::where('status', '1')->count();
                        $win = Leads::where('status', '2')->count();
                        $loss = Leads::where('status', '3')->count();
                        $LeadsFollowup = LeadsFollowup::get();
                        $Employee = User::select('users.first_name','users.id','users.profile_img','roles.name as post_name')
                                        ->where('users.type', 4)
                                        ->leftJoin('employee_details', 'employee_details.user_id', 'users.id')
                                        ->leftJoin('roles', 'roles.id', 'employee_details.admin_type_id')
                                        ->get();
                                         $RoleAccess = \App\Models\RoleAccess::select('role_accesses.add','role_accesses.view','role_accesses.update','role_accesses.delete','permissions.name as per_name')
                                ->leftjoin('employee_details','employee_details.job_role_id','role_accesses.role_id')
                                ->leftjoin('permissions','permissions.id','role_accesses.permission_id')
                                ->where('employee_details.user_id',Auth::user()->id)
                                ->where('role_accesses.view','!=',null)
                                ->orWhere('role_accesses.add','!=',null)
                                ->orWhere('role_accesses.update','!=',null)
                                ->orWhere('role_accesses.delete','!=',null)
                                ->get()
                                ->toArray();
                        return view('Employee.sales.Leads.all_leads', compact('users', 'TotalLeads', 'LeadsFollowup', 'progress', 'win', 'loss', 'searchTerm', 'Employee','RoleAccess'));
    }
     //get all follow ups
        public function recent_follow_ups(Request $req)
        {
            // Retrieve input data
            $month = $req->input('months');
            $year = $req->input('year');
            $from = $req->input('from');
            $to = $req->input('to');
            $search = $req->input('search');
        
            // Build query for fetching leads follow-up data
            $leadsFollowupQuery = LeadsFollowup::leftjoin('leads', 'leads.id', 'leads_followups.leads_id')
                ->select('leads_followups.*', 'leads.first_name', 'leads.requirement', 'leads.last_name', 'leads.phone_number')
                ->orderBy('leads_followups.created_at', 'desc');
        
            // Apply filters
            if ($month && $year) {
                $leadsFollowupQuery->whereMonth('leads_followups.created_at', $month)
                    ->whereYear('leads_followups.created_at', $year);
            }
        
            if ($from && $to) {
                $leadsFollowupQuery->whereBetween('leads_followups.created_at', [$from, $to]);
            }
        
            if ($search) {
                $leadsFollowupQuery->where(function($query) use ($search) {
                    $query->where('leads.first_name', 'like', '%'.$search.'%')
                          ->orWhere('leads.last_name', 'like', '%'.$search.'%')
                          ->orWhere('leads.requirement', 'like', '%'.$search.'%');
                });
            }
        
            // Paginate the results
            $LeadsFollowup = $leadsFollowupQuery->paginate(10);
        
            // Fetch employee data if needed
            $Employee = User::select('users.first_name','users.id','users.profile_img','roles.name as post_name')
                            ->where('users.type', 4)
                            ->leftJoin('employee_details', 'employee_details.user_id', 'users.id')
                            ->leftJoin('roles', 'roles.id', 'employee_details.admin_type_id')
                            ->paginate(10);
         
            // Return the view with the data
            return view('Employee.sales.Leads.recent_follow_ups', compact('LeadsFollowup', 'Employee'));
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
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "(#".$id.") Lead Edit Page Opened";
        $Log['url'] = url('/') . '/Employee/Leads/edit/'.$id;
        $Log['method'] = "Get";
        $Log['type'] = "lead";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

      $leadStatus  = LeadStatus::get();
            $leads = LeadSource::get();
            $user = Leads::find($id);
            $Employee =User::
            leftjoin('employee_details','employee_details.user_id','users.id')
            ->leftjoin('jobroles','jobroles.id','employee_details.jobrole_id')
            ->where('users.type', '4')
            ->select('users.*','jobroles.name as jobrole')
            ->get();
              $Company = CompanyLogin::select('id','company_name')->get();
        return view('Employee.sales.Leads.edit',compact('user','Employee','leads','Company','leadStatus'));
    }

     //View
        public function view(Request $req,$id)
        {
            $LeadsFollowup = LeadsFollowup::where('leads_id',$id)->get();
            // $user = Leads::find($id);
            $LeadFile = LeadFile::where('leads_id',$id)->get();
           $user= Leads::select('leads.*', 'lead_statuses.label_color as leadStatusColor')
                    ->leftJoin('lead_statuses', 'lead_statuses.id', 'leads.leadStatus')
                    ->where('leads.id',$id)->first();
                    
            return view('Employee.sales.Leads.view',compact('user','LeadFile','LeadsFollowup','id'));
    }

   public function update(Request $req, $id)
    {

            $leadStatus = LeadStatus::where('id', $req->status)->first();
            $data = Leads::find($id);
            $StorageSetting = StorageSetting::find(1);
            $storageLocal = $StorageSetting->status == 0;

            if($req->requirement){
                  $requirement = $req->requirement;
            }else{
                   $requirement = $data->requirement;
            }if($req->assignedto){
                  $assignedto = $req->assignedto;
            }else{
                   $assignedto = $data->assignedto;
            }
            $data['gender']  = $req->gender;
            $data['first_name'] = $req->first_name;
            $data['last_name'] = $req->last_name;
            $data['email']     = $req->email;
            $data['phone_number'] = $req->phone_number;
            $data['company_name'] = $req->company_name;
            $data['lead_source'] = $req->lead_source;
            $data['action_schedule'] = $req->action_schedule;
            $data['date'] = $req->date;
            $data['time'] = $req->time;
            $data['assignedto'] = $assignedto;
            $data['requirement'] = $requirement;
            $data['note'] = $req->note;
            $data['status'] = $req->status;
            $data['leadStatus'] = $req->status;
            $data['leadStatusColor'] = $leadStatus->label_color;
            $data->save();    
        
        
                 
            // Create lead
            $lead = $data;
            
            // File storage path
            $storagePath = 'lead_files/';

            // Process file uploads if files are present
            if ($req->hasFile('file')) {
                foreach ($req->file('file') as $key => $file) {
                    // Generate unique filename
                    $originalFileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $profileFilename = $originalFileName . '_' . Str::random(4) . '.' . $extension;

                    if ($StorageSetting->status == 0) {
                        // Move file to local storage
                        $file->storeAs($storagePath, $profileFilename);

                        // Save file details to database
                        $leadFile = new LeadFile;
                        $leadFile->file = $storagePath . $profileFilename;
                        $leadFile->file_name = $originalFileName;
                        $leadFile->leads_id = $data->id;
                        $leadFile->user_id = Auth::user()->id;
                        $leadFile->save();
                    } elseif ($StorageSetting->status == 1) {
                        // Upload file to S3
                        $fileUrl = $this->Upload($StorageSetting, $profileFilename, $file);

                        // Save file details to database
                        $leadFile = new LeadFile;
                        $leadFile->file = $fileUrl;
                        $leadFile->file_name = $originalFileName;
                        $leadFile->leads_id = $data->id;
                        $leadFile->user_id = Auth::user()->id;
                        $leadFile->save();
                    }
                }
            }

    
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "(#".$id.") Lead Modified";
        $Log['type'] = "lead";
        $Log['url'] = url('/') . '/Employee/Leads/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        return redirect('Employee/Leads/home')->with('success', "Leads Edited Successfully");
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
        $Log['subject'] = "(#".$id.") Lead Deleted";
        $Log['url'] = url('/') . '/Employee/Leads/delete/'.$id;
        $Log['type'] = "lead";
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);

        Leads::find($id)->delete();
        return redirect('Employee/Leads/home')->with('success', "Leads Deleted Successfully");
    }

    // get_leads_yeardata leads
           public function get_leads_yeardata(Request $request)
        {
            $RoleAccess = \App\Models\RoleAccess::select('role_accesses.add','role_accesses.view','role_accesses.update','role_accesses.delete','permissions.name as per_name')
                                ->leftjoin('employee_details','employee_details.job_role_id','role_accesses.role_id')
                                ->leftjoin('permissions','permissions.id','role_accesses.permission_id')
                                ->where('employee_details.user_id',Auth::user()->id)
                                ->where('role_accesses.view','!=',null)
                                ->orWhere('role_accesses.add','!=',null)
                                ->orWhere('role_accesses.update','!=',null)
                                ->orWhere('role_accesses.delete','!=',null)
                                ->get()
                                ->toArray();
        if($RoleAccess[array_search('Leads', array_column($RoleAccess, 'per_name'))]['view'] == 1 )
        {
            $year = $request->year;
            $month = $request->month;

            $users  = Leads::where('date', 'LIKE', "$year-$month%")
                      ->orderBy('created_at', 'desc')
                      ->paginate(10);

        }
        if($RoleAccess[array_search('Leads', array_column($RoleAccess, 'per_name'))]['view'] == 2 )
        {
            $year = $request->year;
            $month = $request->month;

            $users  = Leads::where('date', 'LIKE', "$year-$month%")
                      ->orderBy('created_at', 'desc')
                       ->where(function ($query) {
            $query->orWhere('leads.assignedto', Auth::user()->id)
                ->orWhere('leads.generated_by', Auth::user()->id);
        })
                      ->paginate(10);


        }


                 $Employee = User::select('users.first_name','users.id','users.profile_img','roles.name as post_name')
                        ->where('users.type', 4)
                        ->leftJoin('employee_details', 'employee_details.user_id', 'users.id')
                        ->leftJoin('roles', 'roles.id', 'employee_details.admin_type_id')
                        ->get();

      
            return view('Employee.sales.Leads.Show_leads_yeardata', compact('users','Employee','RoleAccess'))->with('success', "Data of: $year-$month Fetched Successfully");
        }




}
