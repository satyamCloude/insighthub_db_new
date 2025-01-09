<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccountTerminated extends Mailable
{
    use Queueable, SerializesModels;


    public $subject;
    public $header;
    public $template;
    public $footer;

    public function __construct($subject, $header, $template, $footer)
    {
        $this->subject = $subject;
        $this->header = $header;
        $this->template = $template;
        $this->footer = $footer;
    }

    public function build()
{
    return $this->subject($this->subject)
                ->view('emails.AccountTerminated')
                ->with([
                    'header' => $this->header,
                    'template' => $this->template,
                    'footer' => $this->footer
                ]);
}
}
