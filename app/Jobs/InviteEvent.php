<?php

namespace App\Jobs;

use App\Mail\InviteEventMail;
use App\Models\Event;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class InviteEvent implements ShouldQueue
{
    private Event $event;
    private array $emails;
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @param Event $event
     * @param $emails
     */
    public function __construct(Event $event, $emails)
    {
        $this->event = $event;
        $this->emails = $emails;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->emails as $email) {
            Mail::to($email)->send(new InviteEventMail($this->event));
        }
    }
}
