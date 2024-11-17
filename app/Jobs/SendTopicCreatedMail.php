<?php

namespace App\Jobs;

use App\Mail\TopicCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendTopicCreatedMail implements ShouldQueue
{
    use Queueable;

    protected $user;
    /**
     * Create a new job instance.
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->user)->send(new TopicCreated($this->user));
    }
}
