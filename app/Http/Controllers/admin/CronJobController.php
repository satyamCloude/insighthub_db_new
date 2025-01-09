<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;
use App\Models\AttendenceDetails;
use App\Models\Attendence;
use App\Models\LogActivity;
use App\Models\Department;
use App\Models\TimeSheet;
use App\Models\Template;
use App\Models\Product;
use App\Models\Ticket;
use App\Models\Holiday;
use App\Models\Calendar;
use App\Models\MailSettings;
use App\Models\MassMail;
use App\Models\Chat;
use App\Models\EmployeeDetail;
use App\Models\User;
use App\Models\Orders;
use App\Models\Invoice;
use App\Models\ProductNew;
use App\Models\InvoiceSettings;
use App\Models\ClientDetail;
use App\Models\TicketEmailSetting;
use App\Models\CompanyLogin;
use App\Mail\MassMails;
use App\Mail\SupportTicketNotOpened;
use App\Mail\AutoRevertMail;
use App\Mail\TicketMail;
use App\Mail\EventNotification;
use App\Mail\InvoiceReminder;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use App\Events\AppEvents;
use App\Events\Notification;
use Webklex\IMAP\Facades\Client;
use Jenssegers\Agent\Agent;
use Carbon\Carbon;
use Mail;
use Hash;
use Auth;
use DB;
use DateTime;


class CronJobController extends Controller
{
    /**
     * For Track The Gmail Data the specified resource from Google Email Inbox storage.
     */

    public function getMailUsingImapServer()
    {
        // Connect to the IMAP server
        $client = Client::account('default');
        $client->connect();

        // Get the inbox folder
        $inboxFolder = $client->getFolder('INBOX');

        // Get unseen messages
        $unseenMessages = $inboxFolder->messages()->unseen()->get();

        // Get seen messages
        $seenMessages = $inboxFolder->messages()->seen()->get();

        // Merge unseen and seen messages into a single variable
        $allMessages = array_merge($unseenMessages->all(), $seenMessages->all());

        // Process and display all messages
        foreach ($allMessages as $message) {

            $email = $message->to[0]->mailbox . "@" . $message->to[0]->host;
            $FromEmail = $message->getFrom()[0]->mail;
            $department_id = Department::where('email', $email)->select('id', 'company_id')->first();

            $userEmail = User::where('email', $FromEmail)->select('id', 'email', 'first_name')->first();

            $departmentId = isset($department_id->id) ? $department_id->id : '';
            $company_id = isset($department_id->company_id) ? $department_id->company_id : '';
            $userId = isset($userEmail->id) ? $userEmail->id : '';


            $emailSubject = $message->getSubject();



            if (Str::startsWith($emailSubject, 'Fwd:')) {
                $cleanedSubject = trim(str_ireplace('Fwd:', '', $emailSubject));
            }
            // Remove "Re:" if it exists
            elseif (Str::startsWith($emailSubject, 'Re:')) {
                $cleanedSubject = trim(str_ireplace('Re:', '', $emailSubject));
            } else {
                // Subject doesn't start with 'Fwd:' or 'Re:'
                $cleanedSubject = $emailSubject;
            }

            $existingTicket = Ticket::where('department_id', $departmentId)
                ->where('user_id', $userId)
                ->where('subject', $cleanedSubject)
                ->where('status', 1)
                // ->where('status',6)
                ->count();

            // echo "departmentId".$departmentId.'<br>';
            // echo "existingTicket".$existingTicket.'<br>';
            // echo "userId".$userId.'<br>'; 
            // echo "----------------------<br>"; 

            $plainTextContent = $message->getTextBody();

            $plainTextContent = trim(str_ireplace('Content-Transfer-Encoding: quoted-printable', '', $plainTextContent));



            if ($cleanedSubject != 'Delivery Status Notification (Failure)') {

                if ($existingTicket == 0 && $userId != '' && $departmentId != '') {

                    // echo "sdf"; exit;
                    $ticket = new Ticket;
                    $ticket->department_id = $departmentId;
                    $ticket->user_id = $userId;
                    $ticket->client_id = $userId;
                    $ticket->priority_id = '1';
                    $ticket->subject = $cleanedSubject;
                    $ticket->message = $plainTextContent;
                    $ticket->date = date('Y-m-d', strtotime($message->getDate()));
                    $ticket->save();

                    $chat = new Chat;
                    $chat->departmentId = $departmentId;
                    $chat->clientId = $userId;
                    $chat->ticket_id = $ticket->id;
                    $chat->message = $plainTextContent;
                    $chat->save();

                    $signature = EmployeeDetail::where('user_id', $company_id)->select('signature')->first();
                    $userName = User::find($userId);
                    $ticketId = $ticket->id;
                    $userName = $userName->first_name;


                    $TemplateSettings = Template::where('name', 'Ticket Submission Acknowledgment')->first();

                    $subject  = $TemplateSettings->subject;
                    $header   = $TemplateSettings->header;
                    $template = $TemplateSettings->template;
                    $footer   = $TemplateSettings->footer;


                    $replacementsTemplate = array(
                        '{$client_name}' => $userName,
                        '{$ticket_number}' => $ticketId,
                        '[Company Name]' => 'CloudTechtiq',
                    );
                    $messageReplacementsTemplate = $template;
                    $template = str_replace(array_keys($replacementsTemplate), array_values($replacementsTemplate), $messageReplacementsTemplate);
                             event(new AppEvents($ticket->department_id, 'Ticket Reply #' . $ticket->id));

                    Mail::to($FromEmail)->send(new TicketMail($subject, $header, $template, $footer));
                } else {
                    $existingTicketGet = Ticket::where('user_id', $userId)
                        ->where('subject', $cleanedSubject)
                        ->where('status', 1)
                        ->first();

                    $chatCheck = Chat::where('message', $plainTextContent)->where('clientId', $userId)->count();
                    if ($chatCheck == 0 && $existingTicketGet) {

                        $chat = new Chat;
                        $chat->departmentId = $departmentId;
                        $chat->clientId = $userId;
                        $chat->ticket_id = $existingTicketGet->id;
                        $chat->message = $plainTextContent;
                        $chat->save();
                        $existingTicketGet->status = ($existingTicketGet->status == 6) ? 1 : $existingTicketGet->status;
                        $existingTicketGet->save();
                        
                                                     event(new AppEvents($ticket->department_id, 'Ticket Reply #' . $ticket->id));

                    }
                }
            }
        }
        $client->disconnect();
    }

public function readEmails()
{
    try {
        $departments = Department::with('ticketEmailSettings')->where('allow_for_ticket', 1)->get();

        foreach ($departments as $department) {
            $ticketEmailSettings = $department->ticketEmailSettings;

            if ($ticketEmailSettings) {
                $mailbox = @imap_open(
                    '{imap.gmail.com:993/imap/ssl}INBOX',
                    $ticketEmailSettings->smtp_username,
                    $ticketEmailSettings->smtp_password
                );

                if ($mailbox === false) {
                    // Log the error
                    error_log('Error on mail credentials for department: ' . $department->name);
                    continue; // Skip this department and move to the next one
                }

                $unseenMessages = imap_search($mailbox, 'UNSEEN');

                if (!$unseenMessages) {
                    echo 'No new emails.';
                } else {
                    foreach ($unseenMessages as $messageNumber) {
                        $email = imap_fetchbody($mailbox, $messageNumber, '');
                        $header = imap_fetchheader($mailbox, $messageNumber);
                        $emailInfo = $this->parseEmailHeader($header);
                        $parsedHeader = imap_rfc822_parse_headers($header);
                        $FromEmail = $parsedHeader->from[0]->mailbox . "@" . $parsedHeader->from[0]->host;
                        $userEmail = User::where('email', $FromEmail)->first();

                        if ($FromEmail) {
                            $plainTextContent = $this->extractPlainTextContent($email);
                            $department_id = $department->id;

                            if (!$userEmail) {
                                $TemplateSettings = Template::where('name', 'Support Ticket Not Opened')->first();

                                $subject = $TemplateSettings->subject;
                                $header = $TemplateSettings->header;
                                $template = $TemplateSettings->template;
                                $footer = $TemplateSettings->footer;

                                $userName = ''; // Define $userName
                                $ticketId = ''; // Define $ticketId
                                $companyName = 'CloudTechtiq';

                                $replacementsData = array(
                                    '{$client_name}' => $userName,
                                    '{$ticket_number}' => $ticketId,
                                    '{$company_name}' => $companyName,
                                );

                                $subject = str_replace(array_keys($replacementsData), array_values($replacementsData), $subject);
                                $header = str_replace(array_keys($replacementsData), array_values($replacementsData), $header);
                                $template = str_replace(array_keys($replacementsData), array_values($replacementsData), $template);
                                $footer = str_replace(array_keys($replacementsData), array_values($replacementsData), $footer);

                                // Mail::to($FromEmail, $department->name)->send(new TicketMail($subject, $header, $template, $footer)); // Uncomment this line to send email

                            } else {
                                $userId = $userEmail->id;
                                $user = User::find($userId);

                                $userName = $user->first_name;
                                $companyName = 'CloudTechtiq';
                                $departmentId = $department->id;
                                $company_id = $department->company_id;
                                $cleanedSubject = $this->cleanSubject($emailInfo['subject']);
                                $existingTicketGet = Ticket::where('user_id', $userId)
                                    ->where('subject', $cleanedSubject)
                                    ->where('status', 1)
                                    ->first();

                                $chatCheck = Chat::where('message', $plainTextContent)->where('clientId', $userId)->count();
                                if ($existingTicketGet) {
                                    $chat = new Chat;
                                    $chat->departmentId = $departmentId;
                                    $chat->clientId = $userId;
                                    $chat->ticket_id = $existingTicketGet->id;
                                    $chat->message = $plainTextContent; // Store the email body
                                    $chat->save();
                                    $existingTicketGet->status = ($existingTicketGet->status == 6) ? 1 : $existingTicketGet->status;
                                    $existingTicketGet->save();

                                    $ticketId = $existingTicketGet->id;
                                    event(new AppEvents($chat->departmentId, 'Ticket Reply #' . $ticketId));

                                } else {
                                    $ticket = new Ticket;
                                    $ticket->department_id = $departmentId;
                                    $ticket->user_id = $userId;
                                    $ticket->client_id = $userId;
                                    $ticket->priority_id = '1';
                                    $ticket->subject = $cleanedSubject;
                                    $ticket->message = $plainTextContent; // Store the email body
                                    $ticket->date = date('Y-m-d', strtotime($emailInfo['date']));
                                    $ticket->save();
                                    event(new AppEvents($ticket->department_id, 'Ticket Reply #' . $ticket->id));

                                    $agent = new Agent();
                                    $browser = $agent->browser();
                                    $version = $agent->version($browser);
                                    $Log = $request->all();
                                    $Log['user_id'] = Auth::user()->id;
                                    $Log['to'] = $departmentId;
                                    $Log['ip'] = $request->ip();
                                    $Log['subject'] = $cleanedSubject;
                                    $Log['status'] = 'The system imported the ticket successfully.';
                                    LogActivity::create($Log);

                                    $ticketId = $ticket->id;

                                    $chat = new Chat;
                                    $chat->departmentId = $departmentId;
                                    $chat->clientId = $userId;
                                    $chat->ticket_id = $ticket->id;
                                    $chat->message = $plainTextContent; // Store the email body
                                    $chat->save();

                                    $images = User::find($company_id);
                                    $TemplateDesign = Template::where('template_type', 'TicketModule')
                                        ->select('footer', 'template', 'subject')
                                        ->first();
                                    $signature = EmployeeDetail::where('user_id', $company_id)->select('signature')->first();

                                    $notification = new Notification;
                                    $notification->user_id = $userId;
                                    $notification->subject = $cleanedSubject;
                                    $notification->message = $plainTextContent; // Store the email body
                                    $notification->departmentId = $departmentId;
                                    $notification->sender = '1';
                                    $notification->save();
                                }

                                $TemplateSettings = Template::where('name', 'Ticket Submission Acknowledgment')->first();
                                $subject = $TemplateSettings->subject;
                                $header = $TemplateSettings->header;
                                $template = $TemplateSettings->template;
                                $footer = $TemplateSettings->footer;

                                $replacementsData = array(
                                    '{$client_name}' => $userName,
                                    '{$ticket_number}' => $ticketId,
                                    '{$company_name}' => $companyName,
                                    '{$ticket_subject}' => $cleanedSubject,
                                );

                                $subject = str_replace(array_keys($replacementsData), array_values($replacementsData), $subject);
                                $header = str_replace(array_keys($replacementsData), array_values($replacementsData), $header);
                                $template = str_replace(array_keys($replacementsData), array_values($replacementsData), $template);
                                $footer = str_replace(array_keys($replacementsData), array_values($replacementsData), $footer);

                                Mail::to($FromEmail, $department->name)
                                    ->send(new TicketMail($subject, $header, $template, $footer));

                                imap_delete($mailbox, $messageNumber);
                            }

                            imap_setflag_full($mailbox, $messageNumber, '');
                        }
                    }
                    imap_expunge($mailbox);
                }
                imap_close($mailbox);
            }
        }
    } catch (Exception $e) {
        echo 'Error: ' . $e->getMessage();
    }
}

    public function readEmails2Old()
    {
        try {
            $departments = Department::with('ticketEmailSettings')->where('allow_for_ticket', 1)->get();

            foreach ($departments as $department) {
                $ticketEmailSettings = $department->ticketEmailSettings;

               
            if ($ticketEmailSettings) {
                $mailbox = @imap_open(
                    '{imap.gmail.com:993/imap/ssl}INBOX',
                    $ticketEmailSettings->smtp_username,
                    $ticketEmailSettings->smtp_password
                );

                if ($mailbox === false) {
                    // Log the error
                    error_log('Error on mail credentials for department: ' . $department->name);
                    continue; // Skip this department and move to the next one
                }

                $unseenMessages = imap_search($mailbox, 'UNSEEN');

                if (!$unseenMessages) {
                    echo 'No new emails.';
                } else {
                    foreach ($unseenMessages as $messageNumber) {
                            $email = imap_fetchbody($mailbox, $messageNumber, '');
                            $header = imap_fetchheader($mailbox, $messageNumber);
                            $emailInfo = $this->parseEmailHeader($header);
                            $parsedHeader = imap_rfc822_parse_headers($header);
                            $FromEmail = $parsedHeader->from[0]->mailbox . "@" . $parsedHeader->from[0]->host;
                            $userEmail = User::where('email', $FromEmail)->first();

                            if ($FromEmail) {
                                $plainTextContent = $this->extractPlainTextContent($email);
                                $department_id = $department->id;

                                if (!$userEmail) {

                                    $TemplateSettings = Template::where('name', 'Support Ticket Not Opened')
                                        ->first();

                                    $subject  = $TemplateSettings->subject;
                                    $header   = $TemplateSettings->header;
                                    $template = $TemplateSettings->template;
                                    $footer   = $TemplateSettings->footer;

                                    // Retrieve necessary data for template replacement
                                    $userName = ''; // You need to define $userName
                                    $ticketId = ''; // You need to define $ticketId
                                    $companyName = 'CloudTechtiq';

                                    $replacementsData = array(
                                        '{$client_name}' => $userName,
                                        '{$ticket_number}' => $ticketId,
                                        '{$company_name}' => $companyName,
                                    );

                                    // Debug str_replace()
                                    $subject = str_replace(array_keys($replacementsData), array_values($replacementsData), $subject);
                                    $header = str_replace(array_keys($replacementsData), array_values($replacementsData), $header);
                                    $template = str_replace(array_keys($replacementsData), array_values($replacementsData), $template);
                                    $footer = str_replace(array_keys($replacementsData), array_values($replacementsData), $footer);

                                    // Mail::to($FromEmail, $department->name)->send(new TicketMail($subject, $header, $template, $footer)); //mail continue send to client due to this commented this line by K.P.
                                    
                                } else {
                                    $userId = $userEmail->id;
                                    $user = User::find($userId);

                                    $userName = $user->first_name;
                                    $companyName = 'CloudTechtiq';
                                    $departmentId = $department->id;
                                    $company_id = $department->company_id;
                                    $cleanedSubject = $this->cleanSubject($emailInfo['subject']);
                                    $existingTicketGet = Ticket::where('user_id', $userId)
                                        ->where('subject', $cleanedSubject)
                                        ->where('status', 1)
                                        ->first();

                                    $chatCheck = Chat::where('message', $plainTextContent)->where('clientId', $userId)->count();
                                    if ($existingTicketGet) {
                                        $chat = new Chat;
                                        $chat->departmentId = $departmentId;
                                        $chat->clientId = $userId;
                                        $chat->ticket_id = $existingTicketGet->id;
                                        $chat->message = $plainTextContent;
                                        $chat->save();
                                        $existingTicketGet->status = ($existingTicketGet->status == 6) ? 1 : $existingTicketGet->status;
                                        $existingTicketGet->save();

                                        $ticketId = $existingTicketGet->id;
                                        
                                                                     event(new AppEvents($chat->departmentId, 'Ticket Reply #' . $ticketId));

                                    } else {
                                        $ticket = new Ticket;
                                        $ticket->department_id = $departmentId;
                                        $ticket->user_id = $userId;
                                        $ticket->client_id = $userId;
                                        $ticket->priority_id = '1';
                                        $ticket->subject = $cleanedSubject;
                                        $ticket->message = $plainTextContent;
                                        $ticket->date = date('Y-m-d', strtotime($emailInfo['date']));
                                        $ticket->save();
                                                                     event(new AppEvents($ticket->department_id, 'Ticket Reply #' . $ticket->id));

                                        $agent = new Agent();
                                        $browser = $agent->browser();
                                        $version = $agent->version($browser);
                                        $Log = $request->all();
                                        $Log['user_id'] = Auth::user()->id;
                                        $Log['to'] = $departmentId;
                                        $Log['ip'] = $request->ip();
                                        $Log['subject'] = $cleanedSubject;
                                        $Log['status'] = 'The system imported the ticket successfully.';
                                        LogActivity::create($Log); 

                                        $ticketId = $ticket->id;

                                        $chat = new Chat;
                                        $chat->departmentId = $departmentId;
                                        $chat->clientId = $userId;
                                        $chat->ticket_id = $ticket->id;
                                        $chat->message = $plainTextContent;
                                        $chat->save();

                                        $images = User::find($company_id);
                                        $TemplateDesign = Template::where('template_type', 'TicketModule')
                                            ->select('footer', 'template', 'subject')
                                            ->first();
                                        $signature = EmployeeDetail::where('user_id', $company_id)->select('signature')->first();


                                        $notification = new Notification;
                                        $notification->user_id = $userId;
                                        $notification->subject = $cleanedSubject;
                                        $notification->message = $plainTextContent;
                                        $notification->departmentId = $departmentId;
                                        $notification->sender = '1';
                                        $notification->save();
                                    }

                                    $TemplateSettings = Template::where('name', 'Ticket Submission Acknowledgment')->first();
                                    $subject  = $TemplateSettings->subject;
                                    $header   = $TemplateSettings->header;
                                    $template = $TemplateSettings->template;
                                    $footer   = $TemplateSettings->footer;

                                    $replacementsData = array(
                                        '{$client_name}' => $userName,
                                        '{$ticket_number}' => $ticketId,
                                        '{$company_name}' => $companyName,
                                        '{$ticket_subject}' => $cleanedSubject,
                                    );

                                    $subject = str_replace(array_keys($replacementsData), array_values($replacementsData), $subject);
                                    $header = str_replace(array_keys($replacementsData), array_values($replacementsData), $header);
                                    $template = str_replace(array_keys($replacementsData), array_values($replacementsData), $template);
                                    $footer = str_replace(array_keys($replacementsData), array_values($replacementsData), $footer);

                                    Mail::to($FromEmail, $department->name)
                                        ->send(new TicketMail($subject, $header, $template, $footer));

                                    imap_delete($mailbox, $messageNumber);
                                }

                                imap_setflag_full($mailbox, $messageNumber, '');
                            }
                        }
                        imap_expunge($mailbox);
                    }
                    imap_close($mailbox);
                }


            }
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    private function cleanSubject($subject)
    {
        $cleanedSubject = $subject;
        if (Str::startsWith($subject, 'Fwd:') || Str::startsWith($subject, 'Re:')) {
            $cleanedSubject = trim(str_ireplace(['Fwd:', 'Re:'], '', $subject));
        }
        return $cleanedSubject;
    }


    private function extractPlainTextContent($message)
    {
        // Find the start of the plain text content
        $start = strpos($message, 'Content-Type: text/plain');

        if ($start !== false) {
            // Find the end of the plain text content
            $start = strpos($message, "\n", $start) + 1;
            $end = strpos($message, '--', $start);

            // Extract the plain text content
            $plainText = trim(substr($message, $start, $end - $start));

            // Find and replace inline images
            $plainText = preg_replace_callback('/<img.*?src=[\'"](cid:.*?)["\'].*?>/i', function ($matches) use ($message) {
                $imageData = $this->getInlineImage($message, $matches[1]);
                $imageSrc = 'data:image/png;base64,' . base64_encode($imageData);
                return '<img src="' . $imageSrc . '">';
            }, $plainText);

            // Decode the quoted-printable content
            $plainText = quoted_printable_decode($plainText);

            return $plainText;
        }

        return '';
    }

    private function getInlineImage($message, $contentId)
    {
        // Find the position of the inline image
        $start = strpos($message, 'Content-ID: <' . $contentId . '>');
        $start = strpos($message, "\r\n\r\n", $start) + 4;
        $end = strpos($message, "\r\n\r\n", $start);

        // Extract the inline image data
        $imageData = substr($message, $start, $end - $start);

        return base64_decode($imageData);
    }

    private function parseEmailHeader($header)
    {
        $emailInfo = [];
        $lines = explode("\r\n", $header);

        foreach ($lines as $line) {
            if (strpos($line, 'From:') === 0) {
                $emailInfo['from'] = trim(substr($line, 5));
            } elseif (strpos($line, 'To:') === 0) {
                $emailInfo['to'] = trim(substr($line, 3));
            } elseif (strpos($line, 'Subject:') === 0) {
                $emailInfo['subject'] = trim(substr($line, 8));
            } elseif (strpos($line, 'Date:') === 0) {
                $emailInfo['date'] = trim(substr($line, 5));
            }
        }

        return $emailInfo;
    }

    /**
     *E-mail Schedule 
     */
    public function SendScheduleMassMail()
    {
        $currentDateTime = Carbon::now();
        $MassMails = MassMail::where('schedule_date', '>=', $currentDateTime)->get();

        foreach ($MassMails as $MassMail) {
            $toIds = explode(',', $MassMail->to_id);
            $subject = $MassMail->subject;
            $description = $MassMail->description;

            foreach ($toIds as $toId) {
                $user = User::where('id', $toId)->where('type', 2)->first();

                try {
                    if ($user) {
                        $Template = Template::select('template', 'template2')->where('id', $MassMails->headfoot_id)->first();
                        $Name = $user->first_name;
                        $Email = $user->email;
                        $Header = $Template->template;
                        $Footer = $Template->template2;
                        $description = str_replace(array('{!!$Name!!}', '{!!$Email!!}'), array($Name, $Email), $MassMails->description);
                        \Mail::to($user->email)->send(new MassMails($Name, $Email, $subject, $description, $Header, $Footer));
                    }
                } catch (\Exception $e) {
                    $MassMail->update(['status' => 4]);
                }
            }

            // Update schedule_date to null for the processed MassMail record
            $MassMail->update(['schedule_date' => null]);
        }
    }

    /**
     * User daily Attendence's Count the production_hours, break_time, over_time 
     */
    public function AttendenceDailyCount()
    {
        $result = DB::table('attendences as a')
            ->leftJoin('employee_details as e', 'a.emp_id', '=', 'e.user_id')
            ->leftJoin('time_sheets as ts', 'ts.id', '=', 'e.shift_id')
            ->select(
                DB::raw('MIN(ts.working_hours) as shifthours'),
                'a.emp_id',
                DB::raw('(MAX(a.punch_out) - MIN(a.punch_in)) as total_hours'),
                DB::raw('SUM(TIMESTAMPDIFF(MINUTE, a.punch_in, a.punch_out) / 60) as actualworkinghours')
            )
            ->groupBy('a.emp_id')
            ->get();

        foreach ($result as $row) {
            echo "shifthours:" . $shifthours = $row->shifthours . "</br>";
            echo "Empid:" .  $empId = $row->emp_id . "</br>";
            echo "totalhours:" . $totalHours = $row->total_hours . "</br>";
            echo "actualWorkingHours:" . $actualWorkingHours = $row->actualworkinghours . "</br>";
            $totalHours2 = floatval($totalHours) / 10000;
            $actualWorkingHours2 = floatval(intval(floatval($actualWorkingHours) * 1000)) / 1000;
            echo "BreakTime:" . $BreakTime = floatval($totalHours2) - floatval($actualWorkingHours2) . "</br>";
            $Breaksasd = floatval($actualWorkingHours2) - floatval($shifthours) . "</br>";
            echo "OverTime:" . $OverTime = floatval($Breaksasd) - floatval($BreakTime) . "</br>";
        }
    }



    /////send auto generated mail before dute date according to given days
    public function sendReminderMail()
    {
        $orders = Orders::select('invoice_id', 'product_id', 'id', 'client_id')
            ->where('invoice_id', '!=', 0)
            ->get();
        foreach ($orders as $order) {
            $invoice = Invoice::where('due_date', '>', date('Y-m-d'))
            ->select('id', 'invoice_number2','before_frequency_counter', 'issue_date', 'due_date', 'final_total_amt', 'client_id')
            ->find($order->invoice_id);
            // Check if the invoice exists and has a due date
            $invoiceSetting = InvoiceSettings::first();
            if ($invoice && $invoice->due_date && $invoice->before_frequency_counter < $invoiceSetting->reminder_frequency) {
                $days = $invoiceSetting->send_reminder_before;
                $before_frequency_counter = $invoice->before_frequency_counter;
                // Calculate the reminder date
                $dueDate = new DateTime($invoice->due_date);
                $reminderDate = $dueDate->modify("-$days day")->format('Y-m-d');

                if ($reminderDate == date('Y-m-d')) {
                    // return $reminderDate;
                    // Get product name and user information
                    $productName = ProductNew::find($order->product_id);
                    $user = User::find($invoice->client_id);
                    $companyName = CompanyLogin::where('id',1)->value('company_name');

                    // Check if user exists
                    if ($user) {
                        // Get mail settings
                        $TemplateSettings = Template::where('name', 'Invoice Reminder')->first();
                        // Prepare email content
                        $subject = $TemplateSettings->subject;
                        $header = $TemplateSettings->header;
                        $template = $TemplateSettings->template;
                        $footer = $TemplateSettings->footer;
                        $title = 'Invoice Reminder';

                        // Replace placeholders in subject
                        $subject = str_replace('[{$invoice_number}]', $invoice->invoice_number2, $subject);

                        // Replace placeholders in template
                        $replacementsTemplate = [
                            '[Client Name]' => $user->first_name,
                            '{$invoice_number}' => $invoice->invoice_number2,
                            '{$invoice_date}' => $invoice->issue_date,
                            '{$due_date}' => $invoice->due_date,
                            '{$total_amount_due}' => $invoice->final_total_amt,
                            '[Your Name]' => $companyName,
                            '[Product/Service Name]' => isset($productName) ? $productName->product_name : '',
                        ];
                        $template = str_replace(array_keys($replacementsTemplate), array_values($replacementsTemplate), $template);

                        // Check if today is the reminder date and send the email
                        $ClientDetail = ClientDetail::where('user_id',$user->id)->first();
        
                        if($ClientDetail){
                            if($ClientDetail->all_emails == 1){
                                Mail::to($user->email)->send(new InvoiceReminder($subject, $header, $template, $footer, $title));
                            }
                        }else{ 
                          Mail::to($user->email)->send(new InvoiceReminder($subject, $header, $template, $footer, $title));
                        }

                        $invoice->before_frequency_counter = $before_frequency_counter+1;
                        $invoice->save();
                    }
                }
            }
        }
        return 'Successfully sent reminder email for invoice before due date.';
    } 
    
    


   
    /////send auto mail for holiday or event of calender


public function sendCalenderEvent()
{
    $tomorrow = Carbon::tomorrow()->format('Y-m-d');
    $today = Carbon::today()->format('Y-m-d');

    // Fetch calendar events for tomorrow
    $calendarEvents = Calendar::whereDate('start', $tomorrow)
        ->orWhereDate('end', $tomorrow)
        ->get();
    
    // Fetch holidays for tomorrow
    $holidayEvents = Holiday::whereDate('date', $tomorrow)->get();

    // Fetch users to notify
    $users = User::where('type', 4)->whereNull('deleted_at')->get();
    $companyName = CompanyLogin::where('id', 1)->value('company_name');

    foreach ($users as $user) {
        // Notify about holidays
        if ($holidayEvents->isNotEmpty()) {
            foreach ($holidayEvents as $holidayEvent) {
                $TemplateSettings = Template::where('name', 'Holiday Announcement')->first();
                if ($TemplateSettings) {
                    $subject = $TemplateSettings->subject;
                    $header = $TemplateSettings->header;
                    $template = $TemplateSettings->template;
                    $footer = $TemplateSettings->footer;
                    $title = 'Holiday Announcement';

                    // Replace placeholders in template
                    $replacementsTemplate = [
                        '[Client Name]' => $user->first_name,
                        '[Event]' => $holidayEvent->title,
                        '[date]' => $holidayEvent->date->format('Y-m-d'),
                        '[Your Name]' => $companyName,
                        '[Company Name]' => 'CloudTechtiq',
                    ];
                    $template = str_replace(array_keys($replacementsTemplate), array_values($replacementsTemplate), $template);

                    if ($user->email) {
                        // Mail::to('nilanjana@b2y.in')->send(new EventNotification($subject, $header, $template, $footer, $title));
                        Mail::to($user->email)->send(new EventNotification($subject, $header, $template, $footer, $title));
                    }
                }
            }
        }

        // Notify about calendar events
        if ($calendarEvents->isNotEmpty()) {
            foreach ($calendarEvents as $calendarEvent) {
                $TemplateSettings = Template::where('name', 'Upcoming Event Notification')->first();
                if ($TemplateSettings) {
                    $subject = $TemplateSettings->subject;
                    $header = $TemplateSettings->header;
                    $template = $TemplateSettings->template;
                    $footer = $TemplateSettings->footer;
                    $title = 'Upcoming Event Notification';

                    // Convert start date to Carbon if it's a string
                    $eventStart = Carbon::parse($calendarEvent->start);

                    // Replace placeholders in template
                    $replacementsTemplate = [
                        '[Client Name]' => $user->first_name,
                        '[Event]' => $calendarEvent->title,
                        '[date]' => $calendarEvent->start,
                        '[Your Name]' => $companyName,
                        '[Company Name]' => 'CloudTechtiq',
                    ];
                    $template = str_replace(array_keys($replacementsTemplate), array_values($replacementsTemplate), $template);
                    if ($user->email) {
                                                // Mail::to('nilanjana@b2y.in')->send(new EventNotification($subject, $header, $template, $footer, $title));

                        Mail::to($user->email)->send(new EventNotification($subject, $header, $template, $footer, $title));
                    }
                }
            }
        }
    }

    return 'Successfully sent reminder of calendar events and holidays.';
}



 private function sendHolidayNotification($user, $holidays)
    {
        $data = [
            'holidays' => $holidays,
        ];

        Mail::to($user->email)->send(new EventNotification($data));
    }

    private function sendEventNotification($user, $events)
    {
        $data = [
            'events' => $events,
        ];

        Mail::to($user->email)->send(new EventNotification($data));
    }
    //send mail after given days according to due date
    public function sendOverdueMail()
    {
        $orders = Orders::where('invoice_id', '!=', 0)->get(['invoice_id', 'product_id', 'client_id']);
        
        foreach ($orders as $order) {
            $invoice = Invoice::where('id', $order->invoice_id)
                ->where('due_date', '<', date('Y-m-d'))
                ->first(['id','invoice_number2', 'issue_date','after_frequency_counter', 'due_date', 'final_total_amt', 'client_id']);

            $invoiceSetting = InvoiceSettings::first();
            if ($invoice &&  $invoice->due_date && $invoice->after_frequency_counter < $invoiceSetting->reminder_frequency) {
                $days = $invoiceSetting->send_reminder_after;
                $after_frequency_counter = $invoice->after_frequency_counter;
                // Calculate the overdue date
                $dueDate = new DateTime($invoice->due_date);
                $yesterday = $dueDate->modify("+$days day")->format('Y-m-d');

                if ($yesterday === date('Y-m-d')) {
                    $productName = ProductNew::find($order->product_id);
                    $client = User::find($invoice->client_id);
                    $companyName = CompanyLogin::where('id',1)->value('company_name');

                    if ($client) {
                        $templateSettings = Template::where('name', 'Invoice Overdue Notice')->first();
                        $productName = $productName ? $productName->product_name : '';
                        $clientName = $client->first_name;
                        $subject = $templateSettings->subject;
                        $header = $templateSettings->header;
                        $template = $templateSettings->template;
                        $footer = $templateSettings->footer;
                        $title = 'Invoice Overdue Notice';

                        // Replace placeholders in subject
                        $subject = str_replace('[{$invoice_number}]', $invoice->invoice_number2, $subject);

                        // Replace placeholders in template
                        $replacementsTemplate = [
                            '[Client Name]' => $client->first_name,
                            '[{$invoice_number}]' => $invoice->invoice_number2,
                            '{$invoice_date}' => $invoice->issue_date,
                            '{$due_date}' => $invoice->due_date,
                            '{$total_amount_due}' => $invoice->final_total_amt,
                            '[Your Name]' => $companyName,
                            '[Product/Service Name]' => $productName,
                        ];
                        $template = str_replace(array_keys($replacementsTemplate), array_values($replacementsTemplate), $template);
                        // Check if today is the reminder date and send the email
                        $ClientDetail = ClientDetail::where('user_id',$client->id)->first();

                        if ($ClientDetail && $ClientDetail->all_emails == 1) {
                            Mail::to($client->email)->send(new InvoiceReminder($subject, $header, $template, $footer, $title));
                        } else {
                            Mail::to($client->email)->send(new InvoiceReminder($subject, $header, $template, $footer, $title));
                        }

                        $invoice->after_frequency_counter = $after_frequency_counter+1;
                        $invoice->save();
                    }
                }
            }
        }
        return 'Successfully sent reminder email for invoice after due date.';
    }

}
