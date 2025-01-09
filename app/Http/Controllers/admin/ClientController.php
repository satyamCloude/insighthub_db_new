<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use League\Flysystem\Filesystem;
use Jenssegers\Agent\Agent;
use App\Models\StorageSetting;
use App\Models\PaymentMethod;
use App\Models\CompanyLogin;
use App\Models\ClientDetail;
use App\Models\LogActivity;
use App\Models\Ticket;
use App\Models\Project;
use App\Models\Orders;
use App\Models\Currency;
use App\Models\Task;
use App\Models\Country;
use App\Models\Quotes;
use App\Models\MailSettings;
use App\Models\Status;
use App\Models\State;
use App\Models\Role;
use App\Models\Template;
use App\Models\User;
use App\Models\City;
use App\Models\TeamMember;
use App\Models\Credit;
use App\Models\Invoice;
use App\Models\ProductNew;
use App\Models\BareMetal;
use App\Models\CloudHosting;
use App\Models\CloudServices;
use App\Models\DedicatedServer;
use App\Models\AwsService;
use App\Models\Azure;
use App\Models\GoogleWorkSpace;
use App\Models\MicrosoftOffice365;
use App\Models\OneTimeSetup;
use App\Models\MonthelySetup;
use App\Models\SSLCertificate;
use App\Models\Antivirus;
use App\Models\Licenses;
use App\Models\Acronis;
use App\Models\TsPlus;
use App\Models\Switchs;
use App\Models\Firewall;
use App\Models\Jobroles;
use App\Mail\AccountTerminated;
use App\Mail\AccountSuspended;
use App\Mail\ClientAuthEmail;
use Hash;
use Auth;

class ClientController extends Controller
{
    //home page
    public function home(Request $request)
    {
        try {
            $query = $request->input('search');
            $users = User::select('users.status','users.payment_status','users.profile_img', 'users.id', 'users.company_name', 'users.created_at', 'users.email', 'users.first_name')
            ->where('type', '2')
            ->when($query, function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('users.first_name', 'like', '%' . $request->input('search') . '%')
                        ->orWhere('users.email', 'like', '%' . $request->input('search') . '%')
                        ->orWhere('users.company_name', 'like', '%' . $request->input('search') . '%');
                });
            })
            ->orderBy('users.created_at', 'desc')
            ->paginate(10);
                
            $users->appends(['search' => $query]);
            $Totalclient = User::where('type', '2')->count();
            $TotalProject = Project::where('status_id', '1')->count();
            $Active = User::where('status', '1')->where('type', '2')->count();
            $InActive = User::where('status', '2')->where('type', '2')->count();
            $Closed = User::where('status', '3')->where('type', '2')->count();
            $getData = User::find(Auth::user()->accountManager);
            return view('admin.user.client.home', compact('users', 'Totalclient', 'TotalProject', 'Active', 'InActive', 'Closed','query','getData'));
        } catch (\Exception $e) {
            // Log or handle the exception
            dd($e->getMessage());
        }
    }
    //home page
    public function Create(Request $request)
    {
        $Country = Country::get();
        $Currency = Currency::get();
        $Company = CompanyLogin::select('id','company_name')->get();
        $Status = Status::get();
        $PaymentMethod = PaymentMethod::get();
        $Role = Role::get();
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Client Create Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Client/Create';
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);
        $accountManagers = User::
            leftjoin('employee_details','employee_details.user_id','users.id')
            ->leftjoin('jobroles','jobroles.id','employee_details.jobrole_id')
            ->where('users.type', '4')
            ->select('users.*','jobroles.name as jobrole')
            ->get();
        
        return view('admin.user.client.create',compact('Country','Currency','Company','Status','PaymentMethod','Role','accountManagers'));
    }


    //home page
    public function store(Request $req)
    {
        try {
            // Validate request
            $validatedData = $req->validate([
                'email' => 'required|email|unique:users,email',
                'accountManager' => 'nullable|exists:users,id',
                'gstin' => [
                    'required',
                    'string',
                    'max:15',
                    'regex:/^(\d{2}[A-Z]{5}\d{4}[A-Z]{1}[A-Z\d]{1}[Z]{1}[A-Z\d]{1})$/',
                    function ($attribute, $value, $fail) {
                        // Custom validation to check if GSTIN already exists
                        if (\App\Models\ClientDetail::where('gstin', $value)->exists()) {
                            $fail('The GSTIN has already been taken.');
                        }
                    },
                ],
                'hsn_sac' => 'required|numeric|digits_between:1,8',
                'tds' => 'required|numeric|digits_between:1,8',
                'payment_method' => 'required|exists:payment_methods,id',
            ]);

            // Storage settings
            $StorageSetting = StorageSetting::find(1);
            $url = url('/') . '/public/images/';
            $rand = Str::random(4);

            // Initialize data arrays
            $User = $req->all();
            $ClientDetail = $req->all();

            // Profile image handling
            if ($req->hasFile('profile_img')) {
                $file = $req->file('profile_img');
                $extension = $file->getClientOriginalExtension();
                $profileFilename = 'profile_' . $rand . '.' . $extension;

                if ($StorageSetting->status == 0) {
                    $file->move('public/images/', $profileFilename);
                    $User['profile_img'] = $url . $profileFilename;
                } else {
                    $User['profile_img'] = $this->Upload($StorageSetting, $profileFilename, $file);
                }
            } else {
                $User['profile_img'] = $url . 'default_profile.jpg';
            }

            // Document verification handling
            if ($req->hasFile('doc_verify')) {
                $file = $req->file('doc_verify');
                $extension = $file->getClientOriginalExtension();
                $docVerifyFilename = 'doc_' . $rand . '.' . $extension;

                if ($StorageSetting->status == 0) {
                    $file->move('public/images/', $docVerifyFilename);
                    $ClientDetail['doc_verify'] = $url . $docVerifyFilename;
                } else {
                    $ClientDetail['doc_verify'] = $this->Upload($StorageSetting, $docVerifyFilename, $file);
                }
            } else {
                $ClientDetail['doc_verify'] = $url . 'default_doc.jpg';
            }

            // User creation
            $User['password'] = Hash::make($req->password);
            $User['type'] = '2';
            $User['email_verified_at'] = now();
            $User['payment_status'] = 1;
            $User['profile_status'] = 1;
            $User['status'] = 1;

            $UserModel = new User();
            $Clientid = $UserModel->create($User);

            // Client detail creation
            $ClientDetail['user_id'] = $Clientid->id;

            // Optional fields handling
            $optionalFields = ['all_emails', 'invoices', 'support', 'services', 'over_due_invoice', 'tax_exampt', 'projects', 'merge_same_due_date'];
            foreach ($optionalFields as $field) {
                if ($req->$field) {
                    $ClientDetail[$field] = '1';
                }
            }

            $ClientDetailModel = new ClientDetail();
            $ClientDetailModel->create($ClientDetail);

            // Account manager assignment
            if ($req->filled('accountManager')) {
                $accountManager = User::find($Clientid->id);
                if ($accountManager) {
                    $accountManager->accountManager = $req->accountManager;
                    $accountManager->save();
                }
            }

            // Log activity
            $agent = new Agent();
            $browser = $agent->browser();
            $version = $agent->version($browser);

            $Log = $req->all();
            $Log['user_id'] = Auth::user()->id;
            $Log['ip'] = $req->ip();
            $Log['subject'] = "Client Data Store By " . Auth::user()->first_name;
            $Log['url'] = url('/') . '/admin/Client/store';
            $Log['method'] = "Post";
            $Log['browser'] = $browser . "-" . $version;

            LogActivity::create($Log);

            // $company = CompanyLogin::find(1);

            // $replacementsSubject = [
            //     '[Company Name]' => $company->company_name,
            // ];
            // $subject = str_replace(array_keys($replacementsSubject), array_values($replacementsSubject), $subject);
    
            // $replacementsFooter = [
            //     '[Company Name]' => $company->company_name,
            // ];
            // $footer = str_replace(array_keys($replacementsFooter), array_values($replacementsFooter), $footer);
    
            // $replacementsTemplate = [
            //     '{$client_name}' => $Clientid->first_name,
            //     '[Your Company Name]' => $company->company_name,
            //     '{$client_username}' => $Clientid->email,
            //     '[automatically generated password or instructions to set up a password]' => $req->password,
            // ];

            // Email notification
            $TemplateSettings = Template::where('name', 'Successfully Registered')->first();
            if ($TemplateSettings) {
                $subject = $TemplateSettings->subject;
                $header = $TemplateSettings->header;
                $template = $TemplateSettings->template;
                $footer = $TemplateSettings->footer;

                $replacementsTemplate = [
                    '{$client_name}' => $Clientid->first_name,
                    '[Your Company Name]' => $req->company_name,
                    '{$client_username}' => $Clientid->email,
                    '[automatically generated password or instructions to set up a password]' => $req->password,
                ];
                $template = str_replace(array_keys($replacementsTemplate), array_values($replacementsTemplate), $template);

                // dd($replacementsTemplate);
                \Mail::to($Clientid->email)->send(new ClientAuthEmail($subject, $header, $template, $footer));
            }

            return redirect('admin/Client/home')->with('success', "New Client Added Successfully");
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
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
    
    public function storeTeam(Request $request){
        
        TeamMember::create($request->all());
        return redirect()->back()->with('success','Team member added successfully.');
    }
    
    public function updateTeam(Request $request){
        // return $request->all();
        $member = TeamMember::find($request->id);
        $member->update($request->all());
        return redirect()->back()->with('success','Team member updated successfully.');
    }
    
    public function storeCredits(Request $request){
        Credit::create($request->all());
        return redirect()->back()->with('success','Amount credited successfully.');
    }
    
    public function getCredit(Request $request,$client_id){
        $credit = Credit::where('client_id',$client_id)->sum('amount');
        return number_format($credit,2);
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
        $ClientDetail = ClientDetail::where('user_id',$id)->first();
        $Role = Role::get();
        $Country = Country::get();
        $State = State::find($ClientDetail->state);
        $City = City::find($ClientDetail->city);
        $Currency = Currency::get();
        $Company = CompanyLogin::select('id','company_name')->get();
        $Status = Status::get();
        $PaymentMethod = PaymentMethod::get();

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Client Edit Page is View By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Client/edit/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);
         $accountManagers = User::
            leftjoin('employee_details','employee_details.user_id','users.id')
            ->leftjoin('jobroles','jobroles.id','employee_details.jobrole_id')
            ->where('users.type', '4')
            ->select('users.*','jobroles.name as jobrole')
            ->get();
        // return $user;
        return view('admin.user.client.edit',compact('Country','user','State','City','Currency','Company','Status','PaymentMethod','ClientDetail','Role','accountManagers'));
    }
    
    public function editTeam(Request $req,$id)
    {
        $teamMember = TeamMember::find($id); 
        return $teamMember;
    }
    
    

    //View
    public function view(Request $req,$id)
    {
        $user_id = Auth::user()->id;
        $user = User::find($id);
        $ClientDetail = ClientDetail::where('user_id',$id)->first();
        $countries=Country::get();
        $teamMembers=TeamMember::where('team_id',$id)->get();
        $credits=Credit::where('client_id',$id)->get();
        $currency=Currency::where('is_default',1)->first();
        if($user && $user->accountManager){
        $accountManager=User::find($user->accountManager);
        $accountRole = Jobroles::whereRaw("FIND_IN_SET(?, assign_emp_id)", [$user->accountManager])->value('name');
        }else{
            $accountManager = [];
            $accountRole = '';
        }
        $Invoice = Invoice::select(
            'invoices.*',
            'currencies.prefix',
            'orders.quantity',
            'users.first_name',
            'users.last_name',
            'users.profile_img',
            'users.email',
            'projects.project_name',
            'projects.id as projects_id',
            'product_news.product_name',
            'product_news.id as products_id',
            'company_logins.company_name',
            'roles.name as post_name'
        )
        ->leftJoin('users', 'users.id', 'invoices.client_id')
        ->leftJoin('projects', 'projects.id', 'invoices.project_id')
        ->leftJoin('orders', 'orders.invoice_id', '=', 'invoices.id')
        ->leftJoin('product_news', 'product_news.id', 'orders.product_id')
        ->leftJoin('client_details', 'client_details.user_id', 'users.id')
        ->leftJoin('company_logins', 'company_logins.id', 'client_details.company_id')
        ->leftJoin('roles', 'roles.id', 'client_details.role_id')
        ->leftJoin('currencies', 'currencies.id', 'invoices.currency')
        ->where('invoices.client_id',$id)
        ->groupBy('invoices.id')
        ->orderBy('invoices.created_at', 'desc')
        ->get();
        
        $amounts = Invoice::selectRaw("
                SUM(CASE WHEN paid_amount > 0 THEN paid_amount ELSE 0 END) AS total_paid,
                SUM(CASE WHEN is_payment_recieved = 0 THEN final_total_amt - paid_amount ELSE 0 END) AS total_unpaid,
                SUM(CASE WHEN is_payment_recieved = 0 AND due_date < CURRENT_DATE() THEN final_total_amt - paid_amount ELSE 0 END) AS total_due
            ")
            ->where('invoices.deleted_at', null)
            ->where('currency', $currency->id)
            ->where('client_id', $id)
            ->first();
        
       
        // return $Invoice;
        if($ClientDetail){
            $Country = Country::find($ClientDetail->country);
            $State = State::find($ClientDetail->state);
            $City = City::find($ClientDetail->city);
            $Company = CompanyLogin::select('company_name')->where('id',$ClientDetail->company_id)->first();
            $quotes = Quotes::where('company_id', $ClientDetail->company_id)->where('status', 1)->get();
            $tasks = Task::leftJoin('projects', 'projects.id', '=', 'tasks.project_id')
            ->where('tasks.client_id', $id)
            ->get();
        }else{
            $ClientDetail = ClientDetail::where('id',1)->first();
            $Country = Country::find(1);
            $State = State::find(1);
            $City = City::find(1);
            $Company = CompanyLogin::select('company_name')->where('id',1)->first();
            $quotes = Quotes::where('company_id', 1)->where('status', 1)->get();
            $tasks = Task::leftJoin('projects', 'projects.id', '=', 'tasks.project_id')
            ->where('tasks.client_id', $id)
            ->get();
        }
        
        $Ticket = Ticket::where('client_id', $id)->get();
        $TotalProject = Project::where('client_id', $id)->count();
        $projects = Project::where('client_id', $id)->get();
        $LastLog = LogActivity::where('user_id', $id)->first();
        $LogActivity = LogActivity::where('user_id', $id)->get();
        $LastloginLogActivity = LogActivity::where('user_id', $id)->orderBy('created_at', 'desc')->first();
        $Services = Orders::select('products.product_name','products.product_image','invoices.is_payment_recieved','products.product_tag_line')
                    ->leftJoin('invoices','invoices.id','orders.invoice_id')
                    ->leftJoin('products','products.id','orders.product_id')
                    ->where('invoices.client_id',$id)->get();
                      $paidInvoicesCount = Invoice::leftjoin('orders','orders.invoice_id','invoices.id')->where('invoices.is_payment_recieved', 1)->where('orders.client_id', $id)->orWhere('invoices.user_id', $id)->count();
        $unpaidInvoicesCount = Invoice::leftjoin('orders','orders.invoice_id','invoices.id')->where('invoices.is_payment_recieved', 0)->where('orders.client_id', $id)->orWhere('invoices.user_id', $id)->count();
        
        $invoices = Invoice::select('invoices.*', 'currencies.prefix', 'users.first_name', 'users.last_name', 'users.profile_img', 'users.email','transactions.razorpay_payment_id')
        ->leftJoin('users', 'users.id', '=', 'invoices.client_id')
        ->leftJoin('transactions', 'invoices.id', '=', 'transactions.invoice_id')
        ->leftJoin('client_details', 'client_details.user_id', '=', 'users.id')
        ->leftJoin('currencies', 'currencies.id', '=', 'invoices.currency')
        ->where('invoices.is_payment_recieved', '1')
        ->where('invoices.client_id',$id)
        ->orderBy('invoices.created_at', 'desc')
        ->groupBy('transactions.id')
        ->paginate(10);
        
        
        
        $InVls = Orders::
                    leftJoin('product_news', 'product_news.id', 'orders.product_id')
                    ->where('orders.is_payment_recieved', 1)
                    ->where('orders.user_id', $id)
                    ->select('orders.*', 'product_news.category_id', 'product_news.product_name')
                    // ->orderBy('created_at', 'desc')
                    ->get();

                $services  = [];
                $product_data = [];
               
                foreach ($InVls as $orders) {
                $findProduct = ProductNew::find($orders->product_id);
                if($orders->category_id === 4){
                   $product_data[]= BareMetal::leftjoin('product_news','product_news.id','bare_metals.product_id')->where('product_id',$orders->product_id)->select('bare_metals.*','product_news.product_name','product_news.category_id')->where('customer_id',$id)->latest()->first();
                }if ($orders->category_id === 5) {
                     $product_data[]=  CloudHosting::leftjoin('product_news','product_news.id','cloud_hostings.product_id')->where('product_id',$orders->product_id)->select('cloud_hostings.*','product_news.product_name','product_news.category_id')->where('customer_id',$id)->latest()->first();
                }if ($orders->category_id === 6) {
                     $product_data[]=  CloudServices::leftjoin('product_news','product_news.id','cloud_services.product_id')->where('product_id',$orders->product_id)->select('cloud_services.*','product_news.product_name','product_news.category_id')->where('customer_id',$id)->latest()->first();
                }if ($orders->category_id === 7) {
                     $product_data[]=  DedicatedServer::leftjoin('product_news','product_news.id','dedicated_servers.product_id')->where('product_id',$orders->product_id)->select('dedicated_servers.*','product_news.product_name','product_news.category_id')->where('customer_id',$id)->latest()->first();
                }if ($orders->category_id === 8) {
                     $product_data[]=  AwsService::leftjoin('product_news','product_news.id','aws_services.product_id')->where('product_id',$orders->product_id)->select('aws_services.*','product_news.product_name','product_news.category_id')->where('customer_id',$id)->latest()->first();
                }if ($orders->category_id === 9) {
                     $product_data[]=  Azure::leftjoin('product_news','product_news.id','azures.product_id')->where('product_id',$orders->product_id)->select('azures.*','product_news.product_name','product_news.category_id')->where('customer_id',$id)->latest()->first();
                }if ($orders->category_id === 10) {
                     $product_data[]=  GoogleWorkSpace::leftjoin('product_news','product_news.id','google_work_spaces.product_id')->where('product_id',$orders->product_id)->select('google_work_spaces.*','product_news.product_name','product_news.category_id')->where('customer_id',$id)->latest()->first();
                }if ($orders->category_id === 11) {
                     $product_data[]=  MicrosoftOffice365::leftjoin('product_news','product_news.id','microsoft_office365s.product_id')->where('product_id',$orders->product_id)->select('microsoft_office365s.*','product_news.product_name','product_news.category_id')->where('customer_id',$id)->latest()->first();
                }if ($orders->category_id === 12) {
                     $product_data[]=  OneTimeSetup::leftjoin('product_news','product_news.id','one_time_setups.product_id')->where('product_id',$orders->product_id)->select('one_time_setups.*','product_news.product_name','product_news.category_id')->where('customer_id',$id)->latest()->first();
                }if ($orders->category_id === 13) {
                     $product_data[]=  MonthelySetup::leftjoin('product_news','product_news.id','monthely_setups.product_id')->where('product_id',$orders->product_id)->select('monthely_setups.*','product_news.product_name','product_news.category_id')->where('customer_id',$id)->latest()->first();
                }if ($orders->category_id === 14) {
                     $product_data[]=  SSLCertificate::leftjoin('product_news','product_news.id','s_s_l_certificates.product_id')->where('product_id',$orders->product_id)->select('s_s_l_certificates.*','product_news.product_name','product_news.category_id')->where('customer_id',$id)->latest()->first();
                }if ($orders->category_id === 15) {
                     $product_data[]=  Antivirus::leftjoin('product_news','product_news.id','antiviri.product_id')->where('product_id',$orders->product_id)->select('antiviri.*','product_news.product_name','product_news.category_id')->where('customer_id',$id)->latest()->first();
                }if ($orders->category_id === 16) {
                     $product_data[]=  Licenses::leftjoin('product_news','product_news.id','licenses.product_id')->where('product_id',$orders->product_id)->select('licenses.*','product_news.product_name','product_news.category_id')->where('customer_id',$id)->latest()->first();
                }if ($orders->category_id === 17) {
                     $product_data[]=  Acronis::leftjoin('product_news','product_news.id','acronis.product_id')->where('product_id',$orders->product_id)->select('acronis.*','product_news.product_name','product_news.category_id')->where('customer_id',$id)->latest()->first();
                }if ($orders->category_id === 18) {
                     $product_data[]=  TsPlus::leftjoin('product_news','product_news.id','ts_pluses.product_id')->where('product_id',$orders->product_id)->select('ts_pluses.*','product_news.product_name','product_news.category_id')->where('customer_id',$id)->latest()->first();
                }if ($orders->category_id === 25) {
                     $product_data[]=  Switchs::leftjoin('product_news','product_news.id','switchs.product_id')->where('product_id',$orders->product_id)->select('switchs.*','product_news.product_name','product_news.category_id')->where('customer_id',$id)->latest()->first();
                }if ($orders->category_id === 26) {
                     $product_data[]=  Firewall::leftjoin('product_news','product_news.id','firewalls.product_id')->where('product_id',$orders->product_id)->select('firewalls.*','product_news.product_name','product_news.category_id')->where('customer_id',$id)->latest()->first();
                }
            }
                usort($product_data, function ($a, $b) {
                    if ($a === null || $b === null) {
                        return 0; // Return 0 to maintain current order if either $a or $b is null
                    }
                    return strtotime($b->created_at) - strtotime($a->created_at);
                });
                $product_data = array_filter($product_data);
                $product_data = array_slice($product_data, 0, 5);
                
        
        return view('admin.user.client.view',compact('accountRole','accountManager','id','LastloginLogActivity', 'LogActivity', 'paidInvoicesCount', 'unpaidInvoicesCount', 'LastLog', 'quotes', 'tasks', 'projects','Country','user','State','City','ClientDetail','Company','TotalProject','id','Ticket','Services','countries','teamMembers','credits','currency','Invoice','amounts','invoices','product_data'));
    }

   

    //updated
    public function update(Request $req,$id)
    {
     
      // Validate request
        $validatedData = $req->validate([
            // 'accountManager' => 'required',
            'gstin' => [
                'required',
                'string',
                'max:15',
                'regex:/^(\d{2}[A-Z]{5}\d{4}[A-Z]{1}[A-Z\d]{1}[Z]{1}[A-Z\d]{1})$/',
                function ($attribute, $value, $fail) use ($id) {
                    // Custom validation to check if GSTIN already exists for another user
                    $existingGSTIN = \App\Models\ClientDetail::where('gstin', $value)
                        ->where('user_id', '!=', $id) // Exclude the current user
                        ->exists();
                    if ($existingGSTIN) {
                        $fail('The GSTIN has already been taken.');
                    }
                },
            ],
            'hsn_sac' => 'required|numeric|digits_between:1,8',
            'tds' => 'required|numeric|digits_between:1,8',
            'payment_method' => 'required|exists:payment_methods,id',
        ]);

            $StorageSetting = StorageSetting::find(1);
            $User =User::find($id);
            $Clidet =ClientDetail::where('user_id',$id)->first();
            $rand = Str::random(4);
            $url = url('/').'/public/images/';

            if ($StorageSetting->status == 0) {
            // Process profile_img
            $profileFilename = 'default_profile.jpg';
            if ($req->hasFile('profile_img')) {
                $file = $req->file('profile_img');
                $extension = $file->getClientOriginalExtension();
                $profileFilename = 'profile_'.$rand.'.'.$extension;
                $file->move('public/images/', $profileFilename);
                $User['profile_img'] = $url . $profileFilename;
            }

            // Process doc_verify
            $docVerifyFilename = 'default_doc.jpg';
            if ($req->hasFile('doc_verify')) {
                $file = $req->file('doc_verify');
                $extension = $file->getClientOriginalExtension();
                $docVerifyFilename = 'doc_'.$rand.'.'.$extension;
                $file->move('public/images/', $docVerifyFilename);
                $Clidet['doc_verify'] = $url . $docVerifyFilename;
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

            // Process doc_verify
            $docVerifyFilename = 'default_doc.jpg';
            if ($req->hasFile('doc_verify')) {
                $file = $req->file('doc_verify');
                $extension = $file->getClientOriginalExtension();
                $docVerifyFilename = 'doc_'.$rand.'.'.$extension;
                $url = $this->Upload($StorageSetting, $docVerifyFilename, $file);
                $Clidet['doc_verify'] = $url;
            }
        }
       
           
        $User['gender'] = $req->gender;
        $User['first_name'] = $req->first_name;
        $User['last_name'] = $req->last_name;
        $User['email'] = $req->email;
        $User['phone_number'] = $req->phone_number;
        if($req->password){
            $User['password'] = Hash::make($req->password);  
            $User->password_updateDate = now();
          }
        $User['type'] = '2';
        $User['status'] = $req->status;
        $User['accountManager'] = $req->accountManager ?? $User->accountManager;
        $User['company_name'] = $req->company_name;
        $User->save();


       

        $Clidet['company_id'] = $req->company_id;
        $Clidet['address_1'] = $req->address_1;
        $Clidet['address_2'] = $req->address_2;
        $Clidet['country'] = $req->country;
        $Clidet['state'] = $req->state;
        $Clidet['city'] = $req->city;
        $Clidet['pincode'] = $req->pincode;
        $Clidet['gstin'] = $req->gstin;
        $Clidet['role_id'] = $req->role_id;
        $Clidet['hsn_sac'] = $req->hsn_sac;
        $Clidet['tds'] = $req->tds;
        $Clidet['payment_method'] = $req->payment_method;
        $Clidet['currency'] = $req->currency;
        $Clidet['all_emails'] = $req->input('all_emails') ? 1 : 0;
        $Clidet['invoices'] = $req->input('invoices') ? 1 : 0;
        $Clidet['support'] = $req->input('support') ? 1 : 0;
        $Clidet['services'] = $req->input('services') ? 1 : 0;
        $Clidet['over_due_invoice'] = $req->input('over_due_invoice') ? 1 : 0;
        $Clidet['merge_same_due_date'] = $req->input('merge_same_due_date') ? 1 : 0;
        $Clidet['tax_exampt'] = $req->input('tax_exampt') ? 1 : 0;
        $Clidet['projects'] = $req->input('projects') ? 1 : 0;
        $Clidet->save();  
          

        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $req->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $req->ip();
        $Log['subject'] = "Client Data Updated  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Client/update/'.$id;
        $Log['method'] = "Post";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);
          if($req->status == 3)
          {
               $TemplateSettings = Template::where('name', 'Account Termination Notice')->first();
          }
        if($req->status == 2)
          {
              $TemplateSettings = Template::where('name', 'Account Suspended')->first();
          }
                $MailSettings = MailSettings::where('type','Bulk')->where('id',1)->first();
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
                        if($req->status == 3 || $req->status ==2)
                     {
                        $subject = $TemplateSettings->subject;
                        $header = $TemplateSettings->header;
                        $template = $TemplateSettings->template;
                        $footer = $TemplateSettings->footer;

                

                 $replacementsTemplate = array(
                 '{$client_name}' => $req->first_name,
                 '[Company Name]' => Auth::user()->first_name,
                  );
                 $messageReplacementsTemplate = $template;
                 $template = str_replace(array_keys($replacementsTemplate), array_values($replacementsTemplate),$messageReplacementsTemplate);


                 $replacementsFooter = array(
                '[Company Name]' => Auth::user()->first_name,
                 );
                $messagefooter = $footer;
                $footer = str_replace(array_keys($replacementsFooter), array_values($replacementsFooter), $messagefooter);
            }
                if($req->status == 3)
                {
                  \Mail::to($req->email)->send(new AccountTerminated($subject,$header,$template,$footer));
                }
                if($req->status == 2)
               {
                  \Mail::to($req->email)->send(new AccountSuspended($subject,$header,$template,$footer));
               }
                
                }

        return redirect('admin/Client/home')->with('success', "Client Edit Successfully");
    }



    //updated
    //updated
    public function changePassword(Request $request,$id)
    {
     
        $user =User::find($id);
        // Validate the form data
        $request->validate([
            'newPassword' => 'required',
            'confirmPassword' => 'required|same:newPassword',
        ]);

        // Update the user's password
        $user->update([
            'password' => Hash::make($request->input('newPassword')),
            'password_updateDate' => now(),
        ]);


        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();

        $Log['user_id'] = $id; // Use the obtained $id value here
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Task Edit Page is Viewed By " . $user->first_name;
        $Log['url'] = url('/') . '/admin/Task/edit/' . $id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);
        return redirect('admin/Client/home')->with('success', "Password changed Successfully");
    }


    public function delete(Request $request,$id)
    {
        User::find($id)->delete();
        ClientDetail::where('user_id',$id)->delete();
        $agent = new Agent();
        $browser = $agent->browser();
        $version = $agent->version($browser);
        $Log = $request->all();
        $Log['user_id'] = Auth::user()->id;
        $Log['ip'] = $request->ip();
        $Log['subject'] = "Client Data Deleted  By " . Auth::user()->first_name;
        $Log['url'] = url('/') . '/admin/Client/delete/'.$id;
        $Log['method'] = "Get";
        $Log['browser'] = $browser . "-" . $version;
        LogActivity::create($Log);
        
        return redirect('admin/Client/home')->with('success', "Client Deleted Successfully");
    } 
    
    public function deleteTeam(Request $request,$id)
    {
        TeamMember::find($id)->delete();
        return redirect()->back()->with('success', "The team member has been deleted successfully.");
    }
    
    

    ////checkGstNumber

    public function checkGstNumber(Request $request)
    {
        $gstNumber = $request->input('gstNumber');
    
            $gstExists = ClientDetail::where('gstin', $gstNumber)->exists();
    
            if ($gstExists) {
                return response()->json(['status' => 'exists']);
            } else {
                return response()->json(['status' => 'not_exists']);
            }
    }

    public function enable(Request $request)
    {
        $user = User::find($request->id);
        try {
            $user->google2fa_enabled = 1;
            $user->save();
            return redirect()->back()->with('success','Two factor authentication enabled successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error',$th->getMessage());
        }
    } 
    
    public function disable(Request $request)
    {
        $user = User::find($request->id);
        try {
            $user->google2fa_enabled = 0;
            $user->twoFA_via = 0;
            $user->rand_otp = 0;
            $user->save();
            return redirect()->back()->with('success','Two factor authentication disabled successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error',$th->getMessage());
        }
    }



}
