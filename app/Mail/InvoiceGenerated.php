<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceGenerated extends Mailable
{
    use Queueable, SerializesModels;

    public $pdfFilePath;
    public $subject;
    public $header;
    public $template;
    public $footer;
    public $data;

    public function __construct($pdfFilePath, $subject, $header, $template, $footer,$data)
    {
        $this->pdfFilePath = $pdfFilePath;
        $this->subject = $subject;
        $this->header = $header;
        $this->template = $template;
        $this->footer = $footer;
        $this->data = $data;
    }

    public function build()
{
    return $this->subject($this->subject)
                ->view('emails.invoice')
                ->with([
                    'header' => $this->header,
                    'template' => $this->template,
                    'footer' => $this->footer,
                    'data' => $this->data
                ])
                ->attach($this->pdfFilePath);
}
}
