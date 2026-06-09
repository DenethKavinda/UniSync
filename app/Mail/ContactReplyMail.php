<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactReplyMail extends Mailable
{
    use Queueable, SerializesModels;

    public $replyMessage;
    public $originalMessage;
    public $studentName;

    public function __construct($replyMessage, $originalMessage, $studentName)
    {
        $this->replyMessage = $replyMessage;
        $this->originalMessage = $originalMessage;
        $this->studentName = $studentName;
    }

    public function build()
    {
        return $this->markdown('emails.contactReply')
            ->subject('Response to Your Inquiry - UniSync');
    }
}
