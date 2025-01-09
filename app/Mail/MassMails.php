<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MassMails extends Mailable
{
    use Queueable, SerializesModels;

    public $Name;
    public $Email;
    public $subject;
    public $description;
    public $Header;
    public $Footer;

    /**
     * Create a new message instance.
     *
     * @param  string  $subject
     * @param  string  $description
     * @return void
     */
    public function __construct($Name,$Email,$subject, $description, $Header, $Footer)
    {
        $this->Name = $Name;
        $this->Email = $Email;
        $this->subject = $subject;
        $this->description = $description;
        $this->Header = $Header;
        $this->Footer = $Footer;
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
                    ->view('emails.SendMassmail');
    }
}
