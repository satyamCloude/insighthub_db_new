<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceReminder;
use App\Models\MailSettings;
use App\Models\Template;
use App\Models\ProductNew;
use App\Models\Orders;

class SendInvoiceReminder extends Command
{
    protected $signature = 'reminder:send';
    protected $description = 'Send invoice reminder email';

    public function handle()
    {

        // $orders = Orders::select('invoice_id','product_id')->where('invoice_id','!=','0')->get();
        // foreach($orders as $order)
        // {
        $inId = "119";
        $invoices = Invoice::select('invoice_number2','invoice_date','due_date','total_amount_due')->where('id',$inId)->first();
        $product_id = '6';
        $productName = ProductNew::find($orders->product_id);
        // $findUser = User::find($orders->client_id);
        $id = "136";
        $findUser = User::find($id);
        $MailSettings = MailSettings::where('type', 'Bulk')->where('id', 1)->first();
                    $TemplateSettings = Template::where('name', 'Invoice Reminder')->first();

                    if ($MailSettings->smtp == '1' && $TemplateSettings) {
                        config([
                            'mail.driver'     => $MailSettings->smtp_mailer,
                            'mail.host'       => $MailSettings->smtp_host,
                            'mail.port'       => $MailSettings->smtp_port,
                            'mail.username'   => $MailSettings->smtp_user_name,
                            'mail.password'   => $MailSettings->smtp_password,
                            'mail.encryption' => $MailSettings->smtp_encryption,
                        ]);
                      
                        $productName = $productName->product_name;
                        $clientName = $findUser->first_name;
                        $subject = $TemplateSettings->subject;
                        $header = $TemplateSettings->header;
                        $template = $TemplateSettings->template;
                        $footer = $TemplateSettings->footer;
                        $title = 'Invoice Reminder';
       $replacementssubject = array(
            '[{$invoice_number}]' => $invoices->invoice_number2,
        );
            $message = $subject;
            $subject = str_replace(array_keys($replacementssubject), array_values($replacementssubject), $message);
            

             $replacementsTemplate = array(
            '[Client Name]' => $findUser->first_name,
            '[{$invoice_number}]' => $invoices->invoice_number2,
            '{$invoice_date}' => $invoices->issue_date,
            '{$due_date}' => $invoices->due_date,
            '{$total_amount_due}' => $invoices->final_total_amt,
            '[Your Name]' => 'CloudTechtiq',
            '[Product/Service Name]' =>$productName,
             );
            $messageReplacementsTemplate = $template;
            $template = str_replace(array_keys($replacementsTemplate), array_values($replacementsTemplate), $messageReplacementsTemplate);

           

           
                        Mail::to($emails)->send(new InvoiceReminder($subject, $header, $template, $footer,$title));
                    }
                // }
        // $invoices = Invoice::whereDate('due_date', now()->addDay())->get();

        // foreach ($invoices as $invoice) {
        //     Mail::to($invoice->customer->email)->send(new InvoiceReminder($invoice));
        // }

        $this->info('Invoice reminders sent successfully.');
    }
}
