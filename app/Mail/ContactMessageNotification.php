<?php

namespace App\Mail;

use App\Models\ContactMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMessageNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $contactMessage;

    public function __construct(ContactMessage $contactMessage)
    {
        $this->contactMessage = $contactMessage;
    }

    public function build()
    {
        return $this->subject('New Inquiry from ' . $this->contactMessage->name . ' - ' . $this->contactMessage->subject)
            ->view('emails.contact-message-notification')
            ->replyTo($this->contactMessage->email, $this->contactMessage->name)
            ->from(config('mail.from.address'), $this->contactMessage->name . ' via Website');
    }
}
