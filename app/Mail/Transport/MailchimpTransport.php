<?php

namespace App\Mail\Transport;

use Illuminate\Mail\Transport\Transport;
use Swift_Mime_SimpleMessage;
use Illuminate\Support\Facades\Log;
use Newsletter;

class MailchimpTransport extends Transport
{
    public function send(Swift_Mime_SimpleMessage $message, &$failedRecipients = null)
    {
        $apiKey = config('mail.mailers.mailchimp.options.apiKey');
        $serverPrefix = config('mail.mailers.mailchimp.options.serverPrefix');

        // Implement the logic to interact with Mailchimp using the provided details
        // You can use the Mailchimp API or any other method to send emails through Mailchimp

        try {
            Newsletter::subscribe($message->getTo()[0]['address'], [
                'FNAME' => $message->getTo()[0]['name'],
                'LNAME' => '', // You can adjust this according to your needs
            ]);

            // You can also perform other Mailchimp operations if needed
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error interacting with Mailchimp: ' . $e->getMessage());

            // Log additional information if needed
            Log::info('Mailchimp details:', [
                'Email' => $message->getTo()[0]['address'],
                'Name' => $message->getTo()[0]['name'],
            ]);
        }

        return $this->numberOfRecipients($message);
    }
}
