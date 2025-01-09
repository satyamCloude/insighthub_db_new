<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Http\Controllers\Controller; 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Illuminate\Support\Collection;
use App\Models\AttendenceDetails;
use PHPMailer\PHPMailer\SMTP;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;
use App\Models\Attendence;
use App\Models\LogActivity;
use App\Models\Department;
use App\Models\TimeSheet;
use App\Models\Template;
use App\Models\Product;
use App\Models\Ticket;
use App\Models\MassMail;
use App\Mail\MassMails;
use App\Models\EmployeeDetail;
use App\Models\User;
use Carbon\Carbon; 
use App\Events\AppEvents;

use Mail;
use Hash;
use Auth;
use DB;

class ECronJobController extends Controller
{
    /**
     * For Track The Gmail Data the specified resource from Google Email Inbox storage.
     */
        public function readEmails()
        {
            try {
                // Connect to the Gmail IMAP server
                $mailbox = imap_open('{imap.gmail.com:993/imap/ssl}INBOX', 'b2infosoftofficial@gmail.com', 'csyincoigvwxlcce');

                if (!$mailbox) {
                    throw new Exception('Unable to connect to the mailbox');
                }

                // Search for all emails in the inbox
                $unseenMessages = imap_search($mailbox, 'All');

                if (!$unseenMessages) {
                    echo 'No new emails.';
                } else {
                    foreach ($unseenMessages as $messageNumber) {
                        // Fetch the entire email
                        $email = imap_fetchbody($mailbox, $messageNumber, '');

                        // Parse the email to extract plain text content
                        $plainTextContent = $this->extractPlainTextContent($email);

                        // Fetch the email header
                        $header = imap_fetchheader($mailbox, $messageNumber);

                        $emailInfo = $this->parseEmailHeader($header);

                        // Check if the record already exists based on certain criteria
                        $existingTicket = Ticket::where('department_id', $emailInfo['from'])
                            ->where('ccid', $emailInfo['to'])
                            ->where('subject', $emailInfo['subject'])
                            ->where('task', $plainTextContent)
                            ->first();

                        // If the record doesn't exist, create a new Ticket instance and save it
                        if (!$existingTicket) {
                            $ticket = new Ticket;
                            $ticket->department_id = $emailInfo['from'];
                            $ticket->ccid = $emailInfo['to'];
                            $ticket->subject = $emailInfo['subject'];
                            $ticket->task = $plainTextContent;
                            $ticket->date = date('Y-m-d', strtotime($emailInfo['date']));
                            $ticket->save();
                            
                             event(new AppEvents($ticket->department_id, 'Ticket Reply #' . $ticket->id));

                        }

                        // Mark the email as read
                        imap_setflag_full($mailbox, $messageNumber, '');
                    }

                }

                // Close the mailbox
                imap_close($mailbox);
            } catch (Exception $e) {
                echo 'Error: ' . $e->getMessage();
            }
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
                            $Template = Template::select('template','template2')->where('id',$MassMails->headfoot_id)->first();
                            $Name = $user->first_name;
                            $Email = $user->email;
                            $Header = $Template->template;
                            $Footer = $Template->template2;
                            $description = str_replace(array('{!!$Name!!}','{!!$Email!!}'),array($Name,$Email), $MassMails->description); 
                            \Mail::to($user->email)->send(new MassMails($Name,$Email,$subject,$description,$Header,$Footer));
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
              echo "shifthours:". $shifthours = $row->shifthours."</br>";
              echo "Empid:".  $empId = $row->emp_id."</br>";
              echo "totalhours:".$totalHours = $row->total_hours ."</br>";
              echo "actualWorkingHours:". $actualWorkingHours = $row->actualworkinghours."</br>";
                      $totalHours2 = floatval($totalHours) / 10000 ;
                        $actualWorkingHours2 = floatval(intval(floatval($actualWorkingHours) * 1000))/1000 ;
              echo "BreakTime:" . $BreakTime = floatval($totalHours2)-floatval($actualWorkingHours2) . "</br>";
                 $Breaksasd = floatval($actualWorkingHours2) - floatval($shifthours). "</br>";
                echo "OverTime:" . $OverTime = floatval($Breaksasd)-floatval($BreakTime) . "</br>";

            }   


        }
}
