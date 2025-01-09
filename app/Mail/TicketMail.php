<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class TicketMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $header;
    public $template;
    public $footer;
    public $attachmentPath;

    /**
     * Create a new message instance.
     *
     * @param string $subject
     * @param string $header
     * @param string $template
     * @param string $footer
     * @param string|null $attachmentPath
     * @return void
     */
    public function __construct($subject, $header, $template, $footer, $attachmentPath = null)
    {
        $this->subject = $subject;
        $this->header = $header;
        $this->template = $template;
        $this->footer = $footer;
        $this->attachmentPath = $attachmentPath;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->subject($this->subject)
                      ->view('emails.ticketEmail')
                      ->with([
                          'header' => $this->header,
                          'template' => $this->template,
                          'footer' => $this->footer,
                          'subject' => $this->subject
                      ]);

        // Attach the file if an attachment path is provided
        if ($this->attachmentPath) {
            $email->attach($this->attachmentPath);
        }

        return $email;
    }
}
