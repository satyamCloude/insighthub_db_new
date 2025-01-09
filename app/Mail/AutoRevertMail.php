<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AutoRevertMail extends Mailable
{
    use Queueable, SerializesModels;

    public $image;
    public $footer;
    public $subject;
    public $message2;

    public function __construct($image,$footer,$subject,$message2)
    {                          
        $this->image = $image;
        $this->footer = $footer;
        $this->subject = $subject;
        $this->message2 = $message2;
    }

    public function build()
    {
        return $this->from('Cloudtechtiq@gmail.com', 'Cloudtechtiq')
                     ->subject($this->subject)
                    ->view('emails.autoRevert')
                     ->with([
                    'footer' => $this->footer,
                    'data' => $this->message2
                ]);   
                // ->attach($this->image);
    }
}

