<?php

namespace App\Http\Controllers\user;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use App\Models\Department;
use App\Models\MailSettings;
use App\Models\Template;
use App\Models\Product;
use App\Models\ClientDetail;
use App\Models\TotalService;
use App\Models\Notification;
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
use App\Models\Chat;
use App\Models\ProductNew;
use App\Models\Ticket;
use App\Models\User;
use Hash;
use Auth;
use App\Mail\TicketMail;
use Illuminate\Support\Facades\Mail;
use App\Notifications\SendNotification;
use Illuminate\Support\Facades\Notification as Notify;

use App\Events\AppEvents;

class UTicketController extends Controller
{
  /**
   * Store a newly created resource in storage.
   */
    public function store(Request $request)
    {
        $Ticket = $request->all();
        $Ticket['date'] = date('Y-m-d');
        $Ticket['client_id'] = Auth::user()->id;
        $Ticket['user_id'] = Auth::user()->id;
        $ticketId = Ticket::create($Ticket);
        $subject = $ticketId->subject;
        
        $chat                = new Chat;
        $chat->clientId     = Auth::user()->id;
        $chat->departmentId  = $request->department_id;
        $chat->ticket_id     = $ticketId->id;
        $chat->message       = $request->message;
        $chat->save();
    
        $email =  Department::find($request->department_id);
        $TemplateSettings = Template::where('name', 'Ticket Assigned to Support Agent')->first();
   

        $subject  = $TemplateSettings->subject;
        $header   = $TemplateSettings->header;
        $template = $TemplateSettings->template;
        $footer   = $TemplateSettings->footer;

        $replacementsTemplate = array(
            '{$client_name}' => Auth::user()->first_name,
            '{$ticket_number}' => $ticketId->id,
            '{$ticket_subject}' => $request->subject,
            '[Company Name]' => 'CloudTechtiq',
        );
        $messageReplacementsTemplate = $template;
        $template = str_replace(array_keys($replacementsTemplate), array_values($replacementsTemplate), $messageReplacementsTemplate);
    
        $replacementsSubject = array(
            '{$ticket_subject}' => $request->subject,
        );
        $messageReplacementsSubject = $subject;
        $subject = str_replace(array_keys($replacementsSubject), array_values($replacementsSubject), $messageReplacementsSubject);
        
        $logData = [
            'user_id' => auth()->id(),
            'type' => 'ticket',
            'to' => $request->department_id,
            'ip' => $request->ip(),
            'subject' => $ticketId->subject,
            'status' => 'New ticket (#'.$ticketId->id.') has been created by '.auth()->user()->first_name .'('.auth::user()->id.')'
        ];

        LogActivity::create($logData);
    
        Mail::to($email)->send(new TicketMail($subject, $header, $template, $footer));
        event(new AppEvents($request->department_id,'A new ticket has been created with ID #'.$ticketId->id));
        
        $this->sendNotification();

        return redirect('user/userTicket')->with('success', 'Ticket Generated Successfully');
    }

    public function view(Request $request)
    {
        if ($request->ticketId) {
          $ticketId = $request->ticketId;
          $overview = Ticket::find($ticketId);
          if ($overview) {
            $assignEmp = User::find($overview->ccid);
            $assignEmpName = isset($assignEmp) ? ucfirst($assignEmp->first_name) : '';
          } else {
            $assignEmp = '';
            $assignEmpName = '';
          }
          $ticket = Ticket::join('users', 'tickets.client_id','users.id')
                    ->join('departments', 'tickets.department_id', 'departments.id')
                    // ->where('tickets.client_id', Auth::user()->id)
                    ->where('tickets.id', $ticketId)
                    ->select('users.profile_img', 'users.first_name', 'departments.name as department_name', 'users.type', 'tickets.*')
                    ->first();
    
        } else {
          $ticketId = '';
          $assignEmp = '';
          $assignEmpName = '';
          $overview = '';
          $ticket = Ticket::join('users', 'tickets.client_id', '=', 'users.id')
            ->select('users.profile_img', 'users.first_name', 'tickets.*')
            ->where('tickets.client_id', Auth::user()->id)
            ->where('tickets.client_id', 1)
            ->first();
        }

        $chats = Chat::with('client','department')->where('ticket_id', $ticketId)->orderBy('id','DESC')->get();
        // return $chats;
        $companyName = ClientDetail::Join('users', 'client_details.company_id', 'users.id')->where('client_details.user_id', Auth::user()->id)->select('users.first_name', 'users.profile_img')->first();
        $tickets = Ticket::join('users', 'tickets.client_id', '=', 'users.id')
          ->select('users.profile_img', 'users.first_name', 'tickets.*')
          ->where('tickets.client_id', Auth::user()->id)
          ->get();
          
        $logData = [
            'user_id' => auth()->id(),
            'type' => 'ticket',
            'to' => $overview->department_id,
            'ip' => $request->ip(),
            'subject' => $overview->subject,
            'status' => 'Ticket (#'.$overview->id.') viewed by '.auth()->user()->first_name .'('.auth()->id().')'
        ];

        LogActivity::create($logData);
    
        return view('user.userTicket.ticketChat', compact('tickets', 'ticket', 'ticketId', 'chats', 'companyName', 'overview', 'assignEmpName'));
    }
  ////////chat insert
  public function chatInsert(Request $request)
  {
    // return $request->all();
    $url = $request->url;

      if ($request->hasFile('fileinput')) {
        $rand = rand(100, 9999);
        $file = $request->file('fileinput');
        $extension = $file->getClientOriginalExtension();
        $profileFilename = 'chat_' . $rand . '.' . $extension;
        $file->move('public/chat/', $profileFilename);
        $image = $profileFilename;
        $extension = $extension;
      } else {
        $image = '';
        $extension = '';
      }
      $departMentId = Ticket::find($request->ticket_id);
      // echo "<pre>"; print_r($departMentId); exit;
      if ($departMentId->status == 3) {
        $departMentId->status = 1;
        $departMentId->save();
      }
      $chat  = new Chat;
      $chat->clientId = Auth::user()->id;
      $chat->departmentId  = $departMentId->department_id;
      $chat->ticket_id  = $request->ticket_id;
      $chat->image  = $image;
      $chat->extension  = $extension;
      $chat->message  = $request->message;
      // return $chat;
      $chat->save();

      $notification = new Notification;
      $notification->user_id = Auth::user()->id;
      $notification->message = $request->message;
      $notification->subject = $departMentId->subject;
      $notification->departmentId = $departMentId->department_id;
      $notification->sender = '0';
      $notification->save();

      if ($departMentId) {
        $email = Department::find($departMentId->department_id);
        $email = $email->email;
        if ($email) {
          $subject = $departMentId->subject;
         
            // Mail::to($email)->send(new TicketMail($request->ticket_id,$request->message,$subject));                
        }
      }
      
        $logData = [
            'user_id' => auth()->id(),
            'type' => 'ticket',
            'to' => $departMentId->department_id,
            'ip' => $request->ip(),
            'subject' => $departMentId->subject,
            'status' => 'Ticket (#'.$request->ticket_id.') New reply generated by the '.auth()->user()->first_name.'('.auth()->user()->id.')',
        ];

        LogActivity::create($logData);
        
        return redirect("$url");
    }

public function create()
{
    $Client = User::select('id', 'first_name')->where('type', '2')->get();
    $CCID = User::select('id', 'first_name')->where('type', '4')->get();
    $Department = Department::get();
    
    // Get all services bought by the logged-in user
    $userId = Auth::user()->id;
    $services = TotalService::where('user_id', $userId)->get();
    
    $activeServices = collect();
    $uniqueProducts = [];

    $classMap = [
        4 => BareMetal::class,
        5 => CloudHosting::class,
        6 => CloudServices::class,
        7 => DedicatedServer::class,
        8 => AwsService::class,
        9 => Azure::class,
        10 => GoogleWorkSpace::class,
        11 => MicrosoftOffice365::class,
        12 => OneTimeSetup::class,
        13 => MonthelySetup::class,
        14 => SSLCertificate::class,
        15 => Antivirus::class,
        16 => Licenses::class,
        17 => Acronis::class,
        18 => TsPlus::class,
        25 => Switchs::class,
        26 => Firewall::class,
    ];

    foreach ($services as $service) {
        $class = $classMap[$service->category_id] ?? null;

        if ($class) {
            $categoryService = $class::where('invoice_id', $service->invoice_id)
                                     ->whereNull('terminate_date')
                                     ->first();

            if ($categoryService) {
                $product = ProductNew::where('id', $categoryService->product_id)->first();

                if ($product && !isset($uniqueProducts[$service->category_id][$product->id])) {
                    $uniqueProducts[$service->category_id][$product->id] = true;
                    $activeServices->push([
                        'service' => $service,
                        'product' => $product,
                    ]);
                }
            }
        }
    }

    return view('user.userTicket.create', compact('Client', 'Department', 'activeServices', 'CCID'));
}




  public function edit(Request $request, $id)
  {
    $Ticket = Ticket::find($id);
    $Client = User::select('id', 'first_name')->where('type', '2')->get();
    $Department = Department::select('id', 'name')->get();
    $Product = Product::select('id', 'product_name')->get();
    $CCID = User::select('id', 'first_name')->where('type', '4')->get();
    return view('users.userTicket.edit', compact('Ticket', 'Client', 'Department', 'Product', 'CCID'));
  }
  public function update(Request $request, $id)
  {
    $Ticket = Ticket::find($id);
    $Ticket->client_id = $request->client_id;
    $Ticket->ccid = $request->ccid;
    $Ticket->department_id = $request->department_id;
    $Ticket->priority_id = $request->priority_id;
    $Ticket->product_service_id = $request->product_service_id;
    $Ticket->subject = $request->subject;
    $Ticket->task = $request->task;
    $Ticket->save();
    
    $logData = [
        'user_id' => auth()->id(),
        'type' => 'ticket',
        'to' => $Ticket->department_id,
        'ip' => $request->ip(),
        'subject' => $Ticket->subject,
        'status' => 'Ticket (#'.$Ticket->id.') modified by the '.auth()->user()->first_name .'('.auth()->id().')',
    ];

    LogActivity::create($logData);
        
    return redirect('user/userTicket')->with('success', 'Ticket Edit Generated Successfully');
  }
  public function delete(Request $request, $id)
  {
    Ticket::find($id)->delete();
    return redirect('user/userTicket')->with('success', 'Ticket Deleted Successfully');
  }


  public function sendNotification()
  {
    $user = auth()->user(); // Assuming you have a user
    Notify::send($user, new SendNotification());

    return response()->json(['message' => 'Notification sent']);
  }
}
