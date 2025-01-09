<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TwoStepAuthOtp extends Mailable
{
    use Queueable, SerializesModels;

    public $Name;
    public $Email;
    public $Otp;

    /**
     * Create a new message instance.
     *
     * @param  string  $subject
     * @param  string  $description
     * @return void
     */
    public function __construct($Name,$Email,$Otp)
    {
        $this->Name = $Name;
        $this->Email = $Email;
        $this->Otp = $Otp;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('Cloudtechtiq@gmail.com', 'Cloudtechtiq')
                    ->view('emails.SendTwostepauth');
    }
}
