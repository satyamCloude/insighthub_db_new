<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\Models\MassMail;
use App\Models\User;
use App\Models\Template;
use App\Models\MailSettings;
use Auth;
use Mail;
use Session;
use App\Mail\MassMails;


class EMassMailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
    if($RoleAccess[array_search('MassMail', array_column($RoleAccess, 'per_name'))]['view'] == 1)
    {
        $query = $request->get('search');
        
        $MassMail = MassMail::select('subject','id','status','created_at','star','to_id')
            ->where(function($q) use ($query) {
                $q->where('subject', 'LIKE', "%$query%")
                  ->orWhere('schedule_date', 'LIKE', "%$query%");
            })
            ->where(function ($q) {
                $q->where('status', 1);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $MassMail->appends(['search' => $query]);
                
        $Sent = MassMail::where('status', 1)->orWhere('status', 4)->count();
        $Draft = MassMail::where('status', 2)->count();
        $Star = MassMail::where('star', 1)->count();
        $Trash = MassMail::onlyTrashed()->count();
        $schedule = MassMail::where('schedule_date','!=',null)->count();

        $Client = User::select('id','first_name','profile_img')->where('type','2')->get();
        $Template = Template::select('id','name')->where('status','1')->get();

        $Name = '{!!$Name!!}';
        $Email = '{!!$Email!!}';


    }

        if($RoleAccess[array_search('MassMail', array_column($RoleAccess, 'per_name'))]['view'] == 2)
        {
            $query = $request->get('search');
            
            $MassMail = MassMail::select('subject','id','status','created_at','star','to_id')
                ->where(function($q) use ($query) {
                    $q->where('subject', 'LIKE', "%$query%")
                      ->orWhere('schedule_date', 'LIKE', "%$query%");
                })
                ->where(function ($q) {
                    $q->where('status', 1);
                })
                ->orderBy('created_at', 'desc')
                ->where('user_id',Auth::user()->id)
                ->paginate(10);

            $MassMail->appends(['search' => $query]);
                    
            $Sent = MassMail::where('user_id',Auth::user()->id)->where('status', 1)->orWhere('status', 4)->count();
            $Draft = MassMail::where('user_id',Auth::user()->id)->where('status', 2)->count();
            $Star = MassMail::where('user_id',Auth::user()->id)->where('star', 1)->count();
            $Trash = MassMail::where('user_id',Auth::user()->id)->onlyTrashed()->count();
            $schedule = MassMail::where('user_id',Auth::user()->id)->where('schedule_date','!=',null)->count();

            $Client = User::select('id','first_name','profile_img')->where('type','4')->whereNull('deleted_at')->get();
            $Template = Template::select('id','name')->where('status','1')->get();

            $Name = '{!!$Name!!}';
            $Email = '{!!$Email!!}';
            

        }


         
        return view('Employee.sales.MassMail.home', compact('Template','MassMail','Email','Name','Trash','Sent','Draft','query','Star','Client','schedule'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('Employee.sales.MassMail.add', compact('Client'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $email = $request->input('to_id', []);
        $subject = $request->subject;

        $MailSettings = MailSettings::where('type','Bulk')->where('id',1)->first();

        $storeData = $request->all();

        if($request->id == '' || $request->id == null)
        {

           if ($request->has('send') && $request->send == 'public') {
            $storeData['user_id'] = Auth::user()->id;
            $storeData['to_id'] = implode(",", $request->input('to_id', []));
            foreach ($email as $value) {
               $mail = User::select('email','first_name')->where('id',$value)->where('type',2)->first();
               $Template = Template::select('template','template2')->where('id',$request->headfoot_id)->first();
                $Name = $mail->first_name;
                $Email = $mail->email;
                $Header = $Template->template;
                $Footer = $Template->template2;
                 $description = str_replace(array('{!!$Name!!}','{!!$Email!!}'),array($Name,$Email), $request->description);

                if ($MailSettings->smtp == '1') 

                {
                config([
                    'mail.driver'     => $MailSettings->smtp_mailer,
                    'mail.host'       => $MailSettings->smtp_host,
                    'mail.port'       => $MailSettings->smtp_port,
                    'mail.username'   => $MailSettings->smtp_user_name,
                    'mail.password'   => $MailSettings->smtp_password,
                    'mail.encryption' => $MailSettings->smtp_encryption,
                ]);
                \Mail::to($mail->email)->send(new MassMails($Name,$Email,$subject,$description,$Header,$Footer));
                } 
            }
            $storeData['status'] = '1';
            $storeData['description'] = $description;
            $storeData['schedule_date'] = null;
            MassMail::create($storeData);

             return redirect('Employee/MassMail/home')->with('success', "MassMail Send Successfully");

            }

            if ($request->has('save_draft') && $request->save_draft == 'draft') {
                $storeData['user_id'] = Auth::user()->id;
                $storeData['to_id'] = implode(",", $request->input('to_id', []));
                $storeData['status'] = '2';
                $storeData['schedule_date'] = null;
                MassMail::create($storeData);

            return redirect('Employee/MassMail/home')->with('success', "MassMail Save to Draft Successfully");
            }

            if ($request->has('Schedule') && $request->Schedule == 'date') {
                $storeData['user_id'] = Auth::user()->id;
                $storeData['to_id'] = implode(",", $request->input('to_id', []));
                $storeData['status'] = '3';
                MassMail::create($storeData);

            return redirect('Employee/MassMail/home')->with('success', "MassMail Scheduled Successfully");
            } 
        }

         if($request->id != '' || $request->id != null)
        {
            if ($request->has('send') && $request->send == 'public') {
                $Update = MassMail::find($request->id);
                $Update['to_id'] = implode(",",$request->to_id); 
                $Update['subject'] = $request->subject;
                $Update['headfoot_id'] = $request->headfoot_id;
                $Update['schedule_date'] = null;

                     foreach ($email as $value) {
                    $mail = User::select('email','first_name')->where('id',$value)->where('type',2)->first();
                    $Template = Template::select('template','template2')->where('id',$request->headfoot_id)->first();
                    $Name = $mail->first_name;
                    $Email = $mail->email;
                    $Header = $Template->template;
                    $Footer = $Template->template2;
                     $description = str_replace(array('{!!$Name!!}','{!!$Email!!}'),array($Name,$Email), $request->description); 
                    \Mail::to($mail->email)->send(new MassMails($Name,$Email,$subject,$description,$Header,$Footer));
                }
                
                $Update['status'] = '1';
                $Update['description'] = $description;
                $Update->save();

             return redirect('Employee/MassMail/home')->with('success', "MassMail Send Successfully");
            }

            if ($request->has('save_draft') && $request->save_draft == 'draft') {
                $Update = MassMail::find($request->id);
                $Update['to_id'] = implode(",",$request->to_id); 
                $Update['subject'] = $request->subject;
                $Update['headfoot_id'] = $request->headfoot_id;
                $Update['schedule_date'] = null;
                $Update['status'] = '2';
                $Update['description'] = $request->description;
                $Update->save();

            return redirect('Employee/MassMail/home')->with('success', "MassMail Save to Draft Successfully");
            }

            if ($request->has('Schedule') && $request->Schedule == 'date') {
                $Update = MassMail::find($request->id);
                $Update['to_id'] = implode(",",$request->to_id); 
                $Update['subject'] = $request->subject;
                $Update['schedule_date'] = $request->schedule_date;
                $Update['headfoot_id'] = $request->headfoot_id;
                $Update['status'] = '3';
                $Update['description'] = $request->description;
                $Update->save();

            return redirect('Employee/MassMail/home')->with('success', "MassMail Scheduled Successfully");
            } 

           

        }

        

        return redirect('Employee/MassMail/home')->with('success', "New MassMail Added Successfully");
    }


    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
         $Show = MassMail::find($request->id);
         $Template = Template::select('template','template2')->where('id',$Show->headfoot_id)->first();
         $Header = $Template->template;
         $Footer = $Template->template2;
         return view('Employee.sales.MassMail.ViewMails', compact('Show','Header','Footer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function Edit(Request $request)
    {
        $Edit = MassMail::find($request->id);
        if($Edit){
            return response()->json(['status'=>200 , 'success'=>true ,'data'=>$Edit]);
        }else{
            return response()->json(['success'=>false]);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $Update = MassMail::find($id);
        $Update['to_id'] = implode(",",$request->to_id); 
        $Update['subject'] = $request->subject;
        $Update['schedule_date'] = $request->schedule_date;
        $Update['status'] = $request->status;
        $Update['description'] = $request->description;
        $Update->save();
        return redirect('Employee/MassMail/home')->with('success', "MassMail Update Successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
   public function delete(Request $request)
    {
        if ($request->types == 'all') {
            MassMail::whereIn('id', $request->id)->delete();
        } else {
            MassMail::find($request->id)->delete();
        }
        session()->flash('success', 'MassMail Deleted Successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
        public function Restore(Request $request)
        {
            if ($request->types == 'all') {
                $restore = MassMail::withTrashed()->whereIn('id', $request->id)->restore();
                if ($restore) {
                    session()->flash('success', 'MassMail Record(s) restored successfully');
                } else {
                    session()->flash('error', 'MassMail Record(s) not restored');
                }
            } else {
                $restore = MassMail::withTrashed()->find($request->id)->restore();
                if ($restore) {
                    session()->flash('success', 'MassMail Record restored successfully');
                } else {
                    session()->flash('error', 'MassMail Record not restored');
                }
            }
        }

    /**
     * Remove the specified resource from storage.
     */
        public function ForceDelete(Request $request)
        {
            if ($request->types == 'all') {
                $forceDelete = MassMail::withTrashed()->whereIn('id', $request->id)->forceDelete();
                if ($forceDelete) {
                    session()->flash('success', 'MassMail Permanently Deleted Successfully');
                } else {
                    session()->flash('error', 'MassMail Not Deleted');
                }
            } else {
                $forceDelete = MassMail::withTrashed()->find($request->id)->forceDelete();
                if ($forceDelete) {
                    session()->flash('success', 'MassMail Permanently Deleted Successfully');
                } else {
                    session()->flash('error', 'MassMail Not Deleted');
                }
            }
        }



    /**
     * Trash the specified Restore from storage.
     */
    public function Trash(Request $request)
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

    if($RoleAccess[array_search('MassMail', array_column($RoleAccess, 'per_name'))]['view'] == 1)
    {
        Session::put('tab','trash');
        $Trash = MassMail::onlyTrashed()->orderBy('created_at', 'desc')->paginate(10);
    }

    if($RoleAccess[array_search('MassMail', array_column($RoleAccess, 'per_name'))]['view'] == 2)
    {
        Session::put('tab','trash');
        $Trash = MassMail::onlyTrashed()->orderBy('created_at', 'desc')->where('user_id', Auth::user()->id)->paginate(10);
    }


        return view('Employee.sales.MassMail.Trash', compact('Trash'));
    }

    /**
     * SentMails the specified resource for get all send mails.
     */
   public function SentMails(Request $request)
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

        if($RoleAccess[array_search('MassMail', array_column($RoleAccess, 'per_name'))]['view'] == 1)
        {
            Session::put('tab','sent');
            $SentMails = MassMail::select('subject', 'star', 'id', 'status', 'to_id', 'created_at')
            ->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        }

        if($RoleAccess[array_search('MassMail', array_column($RoleAccess, 'per_name'))]['view'] == 2)
        {
            Session::put('tab','sent');
            $SentMails = MassMail::select('subject', 'star', 'id', 'status', 'to_id', 'created_at')
            ->where('status', 1)
            ->where('user_id', Auth::user()->id) 
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        }                  

        

        return view('Employee.sales.MassMail.SentMails', compact('SentMails'));
    }


    /**
     * DraftMails the specified resource for get all send mails.
     */
    public function DraftMails(Request $request)
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
                            
        if($RoleAccess[array_search('MassMail', array_column($RoleAccess, 'per_name'))]['view'] == 1)
        {
             Session::put('tab', 'draft');
            $DraftMails = MassMail::select('subject','star','id','status','to_id','created_at')->where('status',2)->orderBy('created_at', 'desc')->paginate(10);
        }

        if($RoleAccess[array_search('MassMail', array_column($RoleAccess, 'per_name'))]['view'] == 2)
        {
             Session::put('tab', 'draft');
            $DraftMails = MassMail::select('subject','star','id','status','to_id','created_at')->where('user_id',Auth::user()->id)->where('status',2)->orderBy('created_at', 'desc')->paginate(10);
        }                 


       
       return view('Employee.sales.MassMail.DraftMails', compact('DraftMails'));
    }

    /**
     * Email Star the specified resource for get all send mails.
     */
    public function StarMails(Request $request)
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
                            
        if($RoleAccess[array_search('MassMail', array_column($RoleAccess, 'per_name'))]['view'] == 1)
        {
              Session::put('tab', 'star');
            $StarMails = MassMail::select('subject','star','id','status','to_id','created_at')->where('star',1)->orderBy('created_at', 'desc')->paginate(10);
        }

        if($RoleAccess[array_search('MassMail', array_column($RoleAccess, 'per_name'))]['view'] == 2)
        {
             Session::put('tab', 'star');
        $StarMails = MassMail::select('subject','star','id','status','to_id','created_at')->where('user_id',Auth::user()->id)->where('star',1)->orderBy('created_at', 'desc')->paginate(10);
        } 

       
       return view('Employee.sales.MassMail.StarMails', compact('StarMails'));
    }

    /**
     * Schedule the specified resource for get all Schedule mails.
     */
    public function Schedule(Request $request)
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
                            
        if($RoleAccess[array_search('MassMail', array_column($RoleAccess, 'per_name'))]['view'] == 1)
        {
            Session::put('tab', 'schedule');
            $Schedule = MassMail::select('subject','schedule_date','star','id','status','to_id','created_at')->where('status',3)->where('schedule_date','!=',null)->orderBy('created_at', 'desc')->paginate(10);
        }

        if($RoleAccess[array_search('MassMail', array_column($RoleAccess, 'per_name'))]['view'] == 2)
        {
            Session::put('tab', 'schedule');
            $Schedule = MassMail::select('subject','schedule_date','star','id','status','to_id','created_at')->where('user_id',Auth::user()->id)->where('status',3)->where('schedule_date','!=',null)->orderBy('created_at', 'desc')->paginate(10);
        } 

       return view('Employee.sales.MassMail.Schedule', compact('Schedule'));
    }

    /**
     * SendM the specified resource for get all send mails.
     */
    public function SendM(Request $request)
    {
        $SendM = MassMail::find($request->id);
        $toIds = explode(',', $SendM->to_id); 
        $subject = $SendM->subject;
        $description = $SendM->description;
        foreach ($toIds as $value) {
            $userId = trim($value); 
            $mail = User::select('email')->where('id', $userId)->where('type', 2)->first();
            if ($mail) {
                $Template = Template::select('template','template2')->where('id',$SendM->headfoot_id)->first();
                $Name = $mail->first_name;
                $Email = $mail->email;
                $Header = $Template->template;
                $Footer = $Template->template2;
                $description = str_replace(array('{!!$Name!!}','{!!$Email!!}'),array($Name,$Email), $SendM->description); 
                \Mail::to($mail->email)->send(new MassMails($Name,$Email,$subject,$description,$Header,$Footer));
            }
        }
        $SendM->status = 1;
        $SendM->save();

        if ($SendM) {
            session()->flash('success', 'MassMail Send Successfully');
        } else {
            session()->flash('success', 'MassMail Not Send');
        }

    }

    /**
     * StarUpdate the specified resource for get all send mails.
     */
    public function StarUpdate(Request $request)
    {
        if (isset($request->id)) {
            $StarUpdate = MassMail::find($request->id);

            if ($StarUpdate->star == '1') {
                $StarUpdate->star = '0';
                $StarUpdate->save();
                session()->flash('success', 'MassMail Removed From Starred');
            } elseif ($StarUpdate->star == '0') {
                $StarUpdate->star = '1';
                $StarUpdate->save();
                session()->flash('success', 'MassMail Added To Starred');
            }
        }

    }

    /**
     * LoadMore the specified resource for get all send mails.
     */
    public function LoadMore(Request $request)
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
                            
        if($RoleAccess[array_search('MassMail', array_column($RoleAccess, 'per_name'))]['view'] == 1)
        {
            if($request->type == 'draft'){
         $DraftMails = MassMail::select('subject','star','id','status','to_id','created_at')->where('status',2)->orderBy('created_at', 'desc')->paginate(10);
         return view('Employee.sales.MassMail.DrafMore', compact('DraftMails'));
        }

        if($request->type == 'star'){
         $StarMails = MassMail::select('subject','star','id','status','to_id','created_at')->where('star',1)->orderBy('created_at', 'desc')->paginate(10);
         return view('Employee.sales.MassMail.StarMore', compact('StarMails'));
        }

        if($request->type == 'trash'){
          $Trash = MassMail::onlyTrashed()->orderBy('created_at', 'desc')->paginate(10); 
          return view('Employee.sales.MassMail.TrashMore', compact('Trash'));
        }

        if($request->type == 'schedule'){
          $Schedule = MassMail::select('subject','schedule_date','star','id','status','to_id','created_at')->where('status',3)->where('schedule_date','!=',null)->orderBy('created_at', 'desc')->paginate(10);
            return view('Employee.sales.MassMail.ScheduleMore', compact('Schedule'));
        }

        if($request->type == 'sent'){
           $SentMails = MassMail::select('subject', 'star', 'id', 'status', 'to_id', 'created_at')
            ->where('status', 1)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

            return view('Employee.sales.MassMail.SentMore', compact('SentMails'));
        }
          
        }

        if($RoleAccess[array_search('MassMail', array_column($RoleAccess, 'per_name'))]['view'] == 2)
        {
            if($request->type == 'draft'){
         $DraftMails = MassMail::select('subject','star','id','status','to_id','created_at')->where('status',2)->where('user_id',Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);
         return view('Employee.sales.MassMail.DrafMore', compact('DraftMails'));
        }

        if($request->type == 'star'){
         $StarMails = MassMail::select('subject','star','id','status','to_id','created_at')->where('star',1)->where('user_id',Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);
         return view('Employee.sales.MassMail.StarMore', compact('StarMails'));
        }

        if($request->type == 'trash'){
          $Trash = MassMail::onlyTrashed()->where('user_id',Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10); 
          return view('Employee.sales.MassMail.TrashMore', compact('Trash'));
        }

        if($request->type == 'schedule'){
          $Schedule = MassMail::select('subject','schedule_date','star','id','status','to_id','created_at')->where('status',3)->where('schedule_date','!=',null)->where('user_id',Auth::user()->id)->orderBy('created_at', 'desc')->paginate(10);
            return view('Employee.sales.MassMail.ScheduleMore', compact('Schedule'));
        }

        if($request->type == 'sent'){
           $SentMails = MassMail::select('subject', 'star', 'id', 'status', 'to_id', 'created_at')
            ->where('status', 1)
            ->where('user_id',Auth::user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

            return view('Employee.sales.MassMail.SentMore', compact('SentMails'));
        }
           
        } 

    }

}
