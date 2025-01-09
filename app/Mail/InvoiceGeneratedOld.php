<?php 

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceGenerated extends Mailable
{
    use Queueable, SerializesModels;

    public $msg;
    public $pdfFilePath;

    public function __construct($msg, $pdfFilePath)
    {
        $this->msg = $msg;
        $this->pdfFilePath = $pdfFilePath;
    }

    public function build()
    {
        $this->subject('Invoice Generated')
             ->attach($this->pdfFilePath);

        // Include the content directly in the email
        $this->html($this->msg);

        return $this;
    }
}
