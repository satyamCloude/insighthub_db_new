<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use App\Models\LogActivity;
use App\Models\Department;
use App\Models\Chat;
use App\Models\Template;
use App\Models\StorageSetting;
use Illuminate\Support\Facades\Storage;
use App\Models\ProductNew;
use App\Models\MailSettings;
use App\Models\Product;
use App\Models\ClientDetail;
use App\Models\Notification;
use App\Models\Ticket;
use App\Models\EmployeeDetail;
use App\Models\User;
use App\Events\AppEvents;
use Hash;
use Auth;
use App\Mail\TicketMail;
use Illuminate\Support\Facades\Mail;
use DB;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home(Request $request)
    {
        $searchTerm = request('search');
        $fromDate = $request->input('from') ?? null;
        $toDate = $request->input('to') ?? null;

        $query = Ticket::join('users as clients', 'tickets.client_id', '=', 'clients.id')
            ->join('users as technicians', 'tickets.user_id', '=', 'technicians.id')
            ->join('departments', 'tickets.department_id', '=', 'departments.id')
            ->orderBy('tickets.id', 'desc')
            ->where(function ($q) use ($searchTerm, $fromDate, $toDate) {
                $q->where('tickets.id', 'LIKE', "%$searchTerm%")
                    ->orWhere('tickets.subject', 'LIKE', "%$searchTerm%")
                    ->orWhere('tickets.client_id', 'LIKE', "%$searchTerm%") // Filter by client_id
                    ->orWhereExists(function ($query) use ($searchTerm) {
                        // Subquery to filter by client name
                        $query->select(DB::raw(1))
                            ->from('users')
                            ->whereRaw('users.id = tickets.client_id')
                            ->where('users.first_name', 'LIKE', "%$searchTerm%");
                    })
                    ->orWhereExists(function ($query) use ($searchTerm) {
                        // Subquery to filter by department name
                        $query->select(DB::raw(1))
                            ->from('departments')
                            ->whereRaw('departments.id = tickets.department_id')
                            ->where('departments.name', 'LIKE', "%$searchTerm%");
                    });
            })->select('tickets.*', 'departments.name as department_name', 'clients.first_name as client_name', 'technicians.first_name as technician_name');

        if (isset($request->status) && $request->status != '') {
            $query->where('tickets.status', $request->status);
        }

        if ($fromDate && $toDate) {
            $query->whereBetween('tickets.created_at', [$fromDate, $toDate]);
        }

        $Ticket = $query->paginate(10);


        foreach ($Ticket as $key => $value) {
            $value->last_reply_date = Chat::where('ticket_id', $value->id)->latest()->value('created_at');
        }

        $Ticket->appends(['search' => $searchTerm]);
        $Open = Ticket::where('status', 1)->count();
        $InProgress = Ticket::where('status', 2)->count();
        // $Pending = Ticket::where('status',3)->count();
        $OnHold = Ticket::where('status', 3)->count();
        $Resolved = Ticket::where('status', 4)->count();
        $Closed = Ticket::where('status', 5)->count();
        
        


        return view('admin.Ticket.home', compact('Ticket', 'searchTerm', 'Open', 'InProgress', 'OnHold', 'Resolved', 'Closed'));
    }


public function overview(Request $request)
{
    // Get date range from request
    $startDate = $request->input('start_date');
    $endDate = $request->input('end_date');

    // Initialize an array to hold the data
    $chartData = [];

    // Loop through each status and construct the data array
    for ($i = 0; $i < 5; $i++) {
        $chartData[$i] = [
            'id' => $i + 1,
            'chart_data' => [],
        ];

        // Calculate ticket count for each month
        for ($j = 0; $j < 9; $j++) {
            $query = Ticket::where('status', $i + 1)
                           ->whereMonth('created_at', $j + 1)
                           ->whereYear('created_at', date('Y'));

            if ($startDate && $endDate) {
                $query->whereBetween('created_at', [$startDate, $endDate]);
            }

            $chartData[$i]['chart_data'][] = $query->count();
        }

        // Determine the maximum value in chart_data
        $maxValue = max($chartData[$i]['chart_data']);
        // Get the index of the maximum value
        $maxIndex = array_keys($chartData[$i]['chart_data'], $maxValue)[0];
        // Assign the index of the max value to active_option
        $chartData[$i]['active_option'] = $maxIndex;
    }

    // Encode $chartData as JSON
    $ticketCounts = json_encode(['data' => $chartData]);

    // Retrieve departments and their ticket counts
    $departments = Department::withCount(['tickets' => function ($query) use ($startDate, $endDate) {
        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }
    }])->get();

    // Initialize arrays to hold response and resolution times
    $responseTimes = [];
    $resolutionTimes = [];

    // Retrieve tickets created within the date range with their first response times
    $dailyTicketsQuery = Ticket::query();

    if ($startDate && $endDate) {
        $dailyTicketsQuery->whereBetween('created_at', [$startDate, $endDate]);
    }

    $dailyTickets = $dailyTicketsQuery->with(['firstResponse' => function ($query) {
        $query->select('ticket_id', 'created_at')->orderBy('created_at', 'asc');
    }])->get();

    // Process each ticket for response time calculation
    foreach ($dailyTickets as $ticket) {
        $created_at = $ticket->created_at;
        $first_response = $ticket->firstResponse ? $ticket->firstResponse->created_at : null;

        if ($first_response) {
            $response_time_minutes = $created_at->diffInMinutes($first_response);
            $responseTimes[] = $response_time_minutes; // Collect response times
        }
    }

    // Retrieve resolved tickets created within the date range with their last communication times
    $ticketsResolvedQuery = Ticket::where('status', 4); // Resolved tickets

    if ($startDate && $endDate) {
        $ticketsResolvedQuery->whereBetween('created_at', [$startDate, $endDate]);
    }

    $ticketsResolved = $ticketsResolvedQuery->with(['chat' => function ($query) {
        $query->select('ticket_id', 'created_at')->orderBy('created_at', 'desc');
    }])->get();

    // Process each resolved ticket for resolution time calculation
    foreach ($ticketsResolved as $ticket) {
        $created_at = $ticket->created_at;
        $last_chat = $ticket->chat->first(); // Get the latest chat record

        if ($last_chat) {
            $resolution_time_minutes = $created_at->diffInMinutes($last_chat->created_at);
            $resolutionTimes[] = $resolution_time_minutes; // Collect resolution times
        }
    }

    // Calculate average response time in hours
    if (count($responseTimes) > 0) {
        $averageResponseTimeMinutes = array_sum($responseTimes) / count($responseTimes);
        $averageResponseTimeHours = $averageResponseTimeMinutes / 60; // Convert to hours
        $averageResponseTime = number_format($averageResponseTimeHours, 2); // Format to 2 decimal places
    } else {
        $averageResponseTime = 'N/A';
    }

    // Calculate average resolution time in hours
    if (count($resolutionTimes) > 0) {
        $averageResolutionTimeMinutes = array_sum($resolutionTimes) / count($resolutionTimes);
        $averageResolutionTimeHours = $averageResolutionTimeMinutes / 60; // Convert to hours
        $averageResolutionTime = number_format($averageResolutionTimeHours, 2); // Format to 2 decimal places
    } else {
        $averageResolutionTime = 'N/A';
    }

    // Calculate average time spent by each department on overall assigned tickets
    $departments = Department::with(['tickets' => function ($query) use ($startDate, $endDate) {
        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [$startDate, $endDate]);
        }
    }])->get();

    foreach ($departments as $department) {
        $total_time_spent = 0;
        $ticket_count = 0;

        foreach ($department->tickets as $ticket) {
            $created_at = $ticket->created_at;
            $last_chat = $ticket->chat()->orderBy('created_at', 'desc')->first();

            if ($last_chat) {
                $time_spent = $created_at->diffInMinutes($last_chat->created_at);
                $total_time_spent += $time_spent;
                $ticket_count++;
            }
        }

        // Convert to hours and format to 2 decimal places
        $department->average_time_spent = $ticket_count > 0 ? number_format(($total_time_spent / $ticket_count) / 60, 2) : 'N/A';
    }

    // Convert response and resolution times arrays to JSON format
    $responseTimesJson = json_encode($responseTimes);
    $resolutionTimesJson = json_encode($resolutionTimes);

    // Return view with all necessary data
    return view('admin.Ticket.overview', compact('ticketCounts', 'departments', 'responseTimesJson', 'resolutionTimesJson', 'averageResponseTime', 'averageResolutionTime'));
}

    public function overviewsOld(Request $request)
    {
        // Initialize an array to hold the data
        $chartData = [];

        // Loop through each status and construct the data array
        for ($i = 0; $i < 5; $i++) {
            $chartData[$i] = [
                'id' => $i + 1,
                'chart_data' => [],
                // Initialize an array to store ticket counts for each month
            ];
            for ($j = 0; $j < 9; $j++) {
                // Calculate ticket count for each month
                $chartData[$i]['chart_data'][] = Ticket::where('status', $i + 1)
                    ->whereMonth('created_at', $j + 1)
                    ->whereYear('created_at', date('Y'))
                    ->count();
            }
            // Determine the maximum value in chart_data
            $maxValue = max($chartData[$i]['chart_data']);
            // Get the index of the maximum value
            $maxIndex = array_keys($chartData[$i]['chart_data'], $maxValue)[0];
            // Assign the index of the max value to active_option
            $chartData[$i]['active_option'] = $maxIndex;
        }

        // Encode $chartData as JSON
        $ticketCounts = json_encode(['data' => $chartData]);
        $departments = Department::withCount('tickets')->get();

        // Initialize arrays to hold response and resolution times
        $responseTimes = [];
        $resolutionTimes = [];

        // Handle tickets created today and their first response times
        $currentDate = now()->toDateString(); // Current date

        // Retrieve tickets created today with their first response times
        $dailyTickets = Ticket::whereDate('created_at', $currentDate)
            ->with(['firstResponse' => function ($query) {
                $query->select('ticket_id', 'created_at')->orderBy('created_at', 'asc');
            }])
            ->get();

        // Process each ticket for response time calculation
        foreach ($dailyTickets as $ticket) {
            $created_at = $ticket->created_at;
            $first_response = $ticket->firstResponse ? $ticket->firstResponse->created_at : null;

            if ($first_response) {
                $response_time_minutes = $created_at->diffInMinutes($first_response);
                $responseTimes[] = $response_time_minutes; // Collect response times
            }
        }

        // Retrieve resolved tickets created today with their last communication times
        $ticketsResolved = Ticket::whereDate('created_at', $currentDate)
            ->where('status', 4) // Resolved tickets
            ->with(['chat' => function ($query) {
                $query->select('ticket_id', 'created_at')->orderBy('created_at', 'desc');
            }])
            ->get();

        // Process each resolved ticket for resolution time calculation
        foreach ($ticketsResolved as $ticket) {
            $created_at = $ticket->created_at;
            $last_chat = $ticket->chat->first(); // Get the latest chat record

            if ($last_chat) {
                $resolution_time_minutes = $created_at->diffInMinutes($last_chat->created_at);
                $resolutionTimes[] = $resolution_time_minutes; // Collect resolution times
            }
        }

        // Calculate average response time in hours
        if (count($responseTimes) > 0) {
            $averageResponseTimeMinutes = array_sum($responseTimes) / count($responseTimes);
            $averageResponseTimeHours = $averageResponseTimeMinutes / 60; // Convert to hours
            $averageResponseTime = number_format($averageResponseTimeHours, 2); // Format to 2 decimal places
        } else {
            $averageResponseTime = 'N/A';
        }

        // Calculate average resolution time in hours
        if (count($resolutionTimes) > 0) {
            $averageResolutionTimeMinutes = array_sum($resolutionTimes) / count($resolutionTimes);
            $averageResolutionTimeHours = $averageResolutionTimeMinutes / 60; // Convert to hours
            $averageResolutionTime = number_format($averageResolutionTimeHours, 2); // Format to 2 decimal places
        } else {
            $averageResolutionTime = 'N/A';
        }

        // Convert response and resolution times arrays to JSON format
        $responseTimesJson = json_encode($responseTimes);
        $resolutionTimesJson = json_encode($resolutionTimes);

        // Return view with all necessary data
        return view('admin.Ticket.overview', compact('ticketCounts', 'departments', 'responseTimesJson', 'resolutionTimesJson', 'averageResponseTime', 'averageResolutionTime'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Client = User::select('id', 'first_name','last_name','profile_img','company_name')->where('type', '2')->get();
        $CCID = User::leftjoin('employee_details','employee_details.user_id','users.id')
            ->leftjoin('jobroles','jobroles.id','employee_details.jobrole_id')
            ->where('users.type', '4')
            ->select('users.*','jobroles.name as jobrole')
            ->get();
        $Department = Department::get();
        $Product = ProductNew::select('id', 'product_name')->groupBy('id')->get();
        return view('admin.Ticket.create', compact('Client', 'Department', 'Product', 'CCID'));
    }

    /**
     * Store a newly created resource in storage.
     */
   
public function store(Request $request)
{
    $storageSetting = StorageSetting::find(1);
    $storageLocal = $storageSetting->status == 0;

    $profileFilename = '';
    $url = url('/') . '/public/images/';
    $filePath = 'default_bill_attachment.jpg';
    if ($request->hasFile('fileinput')) {
        $file = $request->file('fileinput');
        $profileFilename = 'ticket_' . Str::random(4) . '.' . $file->getClientOriginalExtension();

        if ($storageLocal) {
        $file->move('public/images/', $profileFilename);
            $filePath = 'images/' . $profileFilename;
               $filePath =$url . $profileFilename;

        } else {
            $filePath = $this->Upload($storageSetting, $profileFilename, $file);
        }
    }
    
    
    

    $ticketData = $request->all();
    $ticketData['attachment'] = $filePath;
    $ticketData['date'] = date('Y-m-d');
    $ticketData['user_id'] = Auth::user()->id;

    $ticket = Ticket::create($ticketData);
    $userDetail = User::find($request->client_id);
    $TemplateSettings = Template::where('name', 'Ticket Assigned to Support Agent')->first();

    $subject = $TemplateSettings->subject;
    $header = $TemplateSettings->header;
    $template = $TemplateSettings->template;
    $footer = $TemplateSettings->footer;

    $replacementsTemplate = [
        '{$client_name}' => $userDetail->first_name,
        '{$ticket_number}' => $ticket->id,
        '{$ticket_subject}' => $ticket->subject,
        '[Company Name]' => 'CloudTechtiq',
    ];
    $template = str_replace(array_keys($replacementsTemplate), array_values($replacementsTemplate), $template);

    $replacementsSubject = [
        '{$ticket_subject}' => $ticket->subject,
    ];
    $subject = str_replace(array_keys($replacementsSubject), array_values($replacementsSubject), $subject);

    Mail::to($userDetail->email)->send(new TicketMail($subject, $header, $template, $footer, $filePath));
                    event(new AppEvents($ticket->department_id, 'Ticket Assigned to Support Agent #' . $ticket->id));

    $logData = [
        'user_id' => Auth::id(),
        'type' => 'ticket',
        'to' => $request->department_id,
        'ip' => $request->ip(),
        'subject' => $ticket->subject,
        'status' => 'New ticket (#' . $ticket->id . ') has been created by Admin'
    ];
    LogActivity::create($logData);

    event(new AppEvents($request->department_id, 'A new ticket has been created with ID #' . $ticket->id));

    $chat = new Chat;
    $chat->companyId = Auth::user()->id;
    $chat->departmentId = $request->department_id;
    $chat->ticket_id = $ticket->id;
    $chat->message = $request->task;
    $chat->save();

    return redirect('admin/Ticket/home')->with('success', 'Ticket Generated Successfully');
}

    /**
     * Display the specified resource.
     */
    public function view(Request $request, $id)
    {
        if ($request->ticketId) {
            $ticketId = $request->ticketId;
            $overview = Ticket::find($ticketId);
            $assignEmp = User::find($overview->ccid);
            $assignEmpName = isset($assignEmp) ? ucfirst($assignEmp->first_name) : '';
            $ticket = Ticket::join('users', 'tickets.client_id', '=', 'users.id')->join('departments', 'tickets.department_id', 'departments.id')
                ->select('users.profile_img', 'users.first_name', 'departments.name as department_name', 'users.type', 'tickets.*')
                // ->where('tickets.client_id',$overview->client_id)
                ->where('tickets.id', $ticketId)
                ->first();
        } else {
            $ticketId = '';
            $assignEmp = '';
            $assignEmpName = '';
            $overview = '';
            $ticket = '';
        }
        $chats = Chat::where('ticket_id', $ticketId)->orderBy('id','DESC')->get();
        $companyName = ClientDetail::Join('users', 'client_details.company_id', 'users.id')->where('client_details.user_id', $id)->select('users.first_name', 'users.profile_img')->first();

        $departments = Department::get();
        return view('admin.Ticket.ticketChat', compact( 'ticketId', 'chats', 'id', 'companyName', 'overview', 'assignEmpName', 'ticket', 'departments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $Ticket = Ticket::find($id);
        $Client = User::select('id', 'first_name','last_name','profile_img','company_name')->where('type', '2')->get();
        $Department = Department::select('id', 'name')->get();
        $Product = Product::select('id', 'product_name')->get();
        $CCIDs =User::
            leftjoin('employee_details','employee_details.user_id','users.id')
            ->leftjoin('jobroles','jobroles.id','employee_details.jobrole_id')
            ->where('users.type', '4')
            ->select('users.*','jobroles.name as jobrole')
            ->get();
            // return $CCIDs;
        return view('admin.Ticket.edit', compact('Ticket', 'Client', 'Department', 'Product', 'CCIDs'));
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, $id)
{
    try {
        // Find the ticket
        $ticket = Ticket::findOrFail($id);

        // Preserve the original client_id
        $originalClientId = $ticket->client_id;

        // Initialize variables
        $profileFilename = '';
        $filePath = '';

        // Handle file uploads
        if ($request->hasFile('fileinput')) {
            try {
                // Generate a unique filename
                $profileFilename = 'ticket_' . Str::random(4) . '.' . $request->file('fileinput')->getClientOriginalExtension();

                $storageSetting = StorageSetting::find(1);
                $storageLocal = $storageSetting->status == 0;

                if ($storageLocal) {
                    // Store in local public folder
                    $request->file('fileinput')->move(public_path('images'), $profileFilename);
                    $filePath = url('/images/' . $profileFilename);
                } else {
                    // Store in S3 or other cloud storage
                    $filePath = $this->Upload($storageSetting, $profileFilename, $request->file('fileinput'));
                }
            } catch (\Exception $e) {
                \Log::error('File upload error: ' . $e->getMessage());
                return redirect()->back()->with('error', 'An error occurred while uploading the file.');
            }
        }

        // Prepare ticket data
        $data = $request->except('client_id');
        $data['attachment'] = $filePath; // Store the file path
        $data['date'] = date('Y-m-d');

        // Update the ticket with request data
        if ($request->has('client_id')) {
            $client_id = $request->client_id;
        } else {
            $client_id = $originalClientId;
        }

        // Update ticket data
        $ticket->update($data);
        
        

        // Send email if required
        if ($request->has('ccid')) {
            $templateSettings = Template::where('name', 'Ticket Update')->first();
            $userDetail = User::find($client_id);

            if ($templateSettings && $userDetail) {
                $subject = $templateSettings->subject;
                $header = $templateSettings->header;
                $template = $templateSettings->template;
                $footer = $templateSettings->footer;

                // Replace placeholders in the email template
                $replacementsTemplate = [
                    '{$client_name}' => $userDetail->first_name,
                    '[Product/Service Name]' => $userDetail->first_name,
                    '[Company Name]' => 'CloudTechtiq',
                ];
                $template = str_replace(array_keys($replacementsTemplate), array_values($replacementsTemplate), $template);
                    // event(new AppEvents($ticket->department_id, 'Ticket Assigned #' . $ticket->id));

                $replacementsSubject = [
                    '{$ticket_subject}' => $request->subject,
                ];
                $subject = str_replace(array_keys($replacementsSubject), array_values($replacementsSubject), $subject);

                // Send email
                Mail::to($userDetail->email)->send(new TicketMail($subject, $header, $template, $footer, $filePath));
            }
        }

        // Log activity
        $logData = [
            'user_id' => auth()->id(),
            'type' => 'ticket',
            'to' => $ticket->department_id,
            'ip' => $request->ip(),
            'subject' => $ticket->subject,
            'status' => 'Ticket (#' . $ticket->id . ') modified by Admin',
        ];
        LogActivity::create($logData);

    } catch (\Exception $e) {
        \Log::error('Ticket update error: ' . $e->getMessage());
        return redirect()->back()->with('error', 'An error occurred while updating the ticket.');
    }

    return redirect('admin/Ticket/home')->with('success', 'Ticket updated successfully');
}



    /**
     * Remove the specified resource from storage.
     */
    public function delete(Request $request, $id)
    {
        $ticket = Ticket::find($id);
        
        $logData = [
            'user_id' => auth()->id(),
            'type' => 'ticket',
            'to' => $ticket->department_id,
            'ip' => $request->ip(),
            'subject' => $Ticket->subject,
            'status' => 'Ticket (#'.$Ticket->id.') deleted by Admin'
        ];
        
        $ticket->delete();

        LogActivity::create($logData);
            
        return redirect('admin/Ticket/home')->with('success', 'Ticket Deleted Successfully');
    }

    /**
     * ClientData the specified resource from storage.
     */
    public function ClientData(Request $request)
    {
        $Client = User::select('email', 'phone_number')->where('type', '2')->where('id', $request->id)->first();
        return response()->json(['status' => 200, 'success' => true, 'data' => $Client]);
    }

    /**
     * get_Ticket_yeardata the specified resource from storage.
     */
    public function get_Ticket_yeardata(Request $request)
    {
        if ($request->year || $month = $request->month) {
            $year = $request->year;
            $month = $request->month;
            $TotalTicket  = Ticket::where('date', 'LIKE', "$year-$month%")->count();
            $Open  = Ticket::where('status', 1)->where('date', 'LIKE', "$year-$month%")->count();
            $InProgress  = Ticket::where('status', 2)->where('date', 'LIKE', "$year-$month%")->count();
            $Pending  = Ticket::where('status', 3)->where('date', 'LIKE', "$year-$month%")->count();
            $OnHold  = Ticket::where('status', 4)->where('date', 'LIKE', "$year-$month%")->count();
            $Resolved  = Ticket::where('status', 5)->where('date', 'LIKE', "$year-$month%")->count();
            $Closed  = Ticket::where('status', 6)->where('date', 'LIKE', "$year-$month%")->count();
        } else {
            $TotalTicket = Ticket::count();
            $Open = Ticket::where('status', 1)->count();
            $InProgress = Ticket::where('status', 2)->count();
            $Pending = Ticket::where('status', 3)->count();
            $OnHold = Ticket::where('status', 4)->count();
            $Resolved = Ticket::where('status', 5)->count();
            $Closed = Ticket::where('status', 6)->count();
        }



        return view('admin.Ticket.Show_ticket_yeardata', compact('TotalTicket', 'Open', 'InProgress', 'Pending', 'OnHold', 'Resolved', 'Closed'));
    }
    /////// insert chat
    public function chatInsert(Request $request)
    {

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

            $departMentId        = Ticket::find($request->ticket_id);
            $chat                = new Chat;
            $chat->clientId     = Auth::user()->id;
            $chat->companyId     = Auth::user()->id;
            $chat->departmentId  = $departMentId->department_id;
            $chat->ticket_id     = $request->ticket_id;
            $chat->image  = $image;
            $chat->extension  = $extension;
            $chat->message       = $request->message;
            $chat->note       = $request->note;
            $chat->save();

            $notification = new Notification;
            $notification->user_id = $departMentId->client_id;
            $notification->message = $request->message;
            $notification->subject = $departMentId->subject;
            $notification->departmentId = $departMentId->department_id;
            $notification->sender = '1';
            $notification->save();

            if ($departMentId) {

                $email = User::find($departMentId->user_id);

                $email = $email->email;

                if ($email) {
                    $subject = $departMentId->subject;
                                                       event(new AppEvents($departMentId->department_id, 'New Chat on ticket #' . $request->ticket_id));

                        $subject = $subject;
                        $header = '<p><img src="https://www.cloudtechtiq.com/themes/cloudtechtiq/assets/imgs/logo.png" style="height:53px; width:200px" /></p>';
                        $template = $request->message;
                        $footer = '<p>Best regards,<br />CloudTechtiq</p>';
                        Mail::to($email)->send(new TicketMail($subject, $header, $template, $footer));
                    
                }
            }
            if($departMentId and $departMentId->ccid){
                                                                       event(new AppEvents($departMentId->ccid, 'New Chat on ticket #' . $request->ticket_id));

            }

            $logData = [
                'user_id' => auth()->id(),
                'type' => 'ticket',
                'to' => $departMentId->department_id,
                'ip' => $request->ip(),
                'subject' => $departMentId->subject,
                'status' => 'New chat created by Admin on Ticket (#' . $departMentId->id . ')'
            ];
            
           // $ticket->delete();

            return redirect("$url");
        
    }
    //////////update ticket status
    public function markAsClosed(Request $request)
    {
        $model = Ticket::find($request->ticketId);
        $model->status = $request->val;
        $model->save();
        
        $logData = [
            'user_id' => auth()->id(),
            'type' => 'ticket',
            'to' => $departMentId->department_id,
            'ip' => $request->ip(),
            'subject' => $departMentId->subject,
            'status' => 'Ticket closed (#' . $department->id . ')'
        ];
        
        $ticket->delete();
            
            
        if ($request->val == 3) {
            $userDetail = User::find($model->client_id);
            $TemplateSettings = Template::where('name', 'Ticket Resolved')->first();
            
                $subject  = $TemplateSettings->subject;
                $header   = $TemplateSettings->header;
                $template = $TemplateSettings->template;
                $footer   = $TemplateSettings->footer;

                $replacementsTemplate = array(
                    '{$client_name}' => $userDetail->first_name,
                    '{$ticket_number}' => $request->ticketId,
                    '{$ticket_subject}' => $model->subject,
                    '[Company Name]' => 'CloudTechtiq',
                );
                $messageReplacementsTemplate = $template;
                $template = str_replace(array_keys($replacementsTemplate), array_values($replacementsTemplate), $messageReplacementsTemplate);

                $replacementsSubject = array(
                    '{$ticket_subject}' => $model->subject,
                );
                $messageReplacementsSubject = $subject;
                $subject = str_replace(array_keys($replacementsSubject), array_values($replacementsSubject), $messageReplacementsSubject);

                Mail::to($userDetail->email)->send(new TicketMail($subject, $header, $template, $footer));
            
        }

        return response()->json(['message' => 'Status updated successfully'], 200);
    }
}
