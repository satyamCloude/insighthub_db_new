<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EventNotification extends Mailable
{
    public $subject;
    public $header;
    public $template;
    public $footer;
    public $title;

    public function __construct($subject, $header, $template, $footer,$title)
    {

        $this->subject = $subject;
        $this->header = $header;
        $this->template = $template;
        $this->footer = $footer;
        $this->title = $title;
    }

    public function build()
{
    return $this->subject($this->subject)
                ->view('emails.eventNotification')
                ->with([
                    'header' => $this->header,
                    'template' => $this->template,
                    'footer' => $this->footer,
                    'title' => $this->title
                ]);
}
}
