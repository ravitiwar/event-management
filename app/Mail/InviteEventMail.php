<?php

namespace App\Mail;

use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Queue\SerializesModels;

class InviteEventMail extends Mailable implements ShouldQueue
{
    private Event $event;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("You have been invited to an event: {$this->event->title}")->markdown('emails.invite-event',[
            'title' => $this->event->title,
            'description' => $this->event->title,
            'place' => $this->event->place,
        ]);
    }
}
