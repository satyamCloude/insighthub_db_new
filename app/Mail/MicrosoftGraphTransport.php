<?php

namespace App\Mail;

use Illuminate\Mail\Transport\Transport;
use GuzzleHttp\Client as HttpClient;
use Illuminate\Support\Facades\Mail;

class MicrosoftGraphTransport extends Transport
{
    protected $http;

    public function __construct(HttpClient $http)
    {
        $this->http = $http;
    }

    public function send($message)
    {
        $this->beforeSendPerformed($message);

        $this->http->post('https://graph.microsoft.com/v1.0/me/sendmail', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->getToken(),
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
            'json' => [
                'message' => [
                    'subject' => $message->getSubject(),
                    'body' => [
                        'contentType' => 'Text',
                        'content' => $message->getBody(),
                    ],
                    'toRecipients' => collect($message->getTo())->map(function ($recipient) {
                        return ['emailAddress' => ['address' => $recipient[0]]];
                    })->values()->toArray(),
                ],
            ],
        ]);

        $this->sendPerformed($message);
    }

    protected function getToken()
    {
        $response = $this->http->post('https://login.microsoftonline.com/common/oauth2/v2.0/token', [
            'form_params' => [
                'grant_type' => 'client_credentials',
                'client_id' => config('mail.microsoft_graph.options.clientId'),
                'client_secret' => config('mail.microsoft_graph.options.clientSecret'),
                'scope' => 'https://graph.microsoft.com/.default',
            ],
        ]);

        return json_decode($response->getBody())->access_token;
    }
}
