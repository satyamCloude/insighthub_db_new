<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class SendQuotes extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $header;
    public $template;
    public $footer;
    public $title;
    public $pdfData;
    public $filename;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $header, $template, $footer, $title, $pdfData = null, $filename = null)
    {
        $this->subject = $subject;
        $this->header = $header;
        $this->template = $template;
        $this->footer = $footer;
        $this->title = $title;
        $this->pdfData = $pdfData;
        $this->filename = $filename;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('Cloudtechtiq@gmail.com', 'Cloudtechtiq')
                    ->subject($this->subject)
                    ->view('emails.SendQuotes')
                    ->with([
                        'header' => $this->header,
                        'template' => $this->template,
                        'footer' => $this->footer,
                        'title' => $this->title,
                    ])
                    ->attachData($this->pdfData, $this->filename, [
                        'mime' => 'application/pdf',
                    ]);
    }
}
