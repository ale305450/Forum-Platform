<?php

namespace App\Listeners;

use App\Core\Entities\User;
use App\Events\SendNewTopicNotificationEvent;
use App\Notifications\NewTopicCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class NewTopicCreatedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SendNewTopicNotificationEvent $event): void
    {
        $users = User::all();
        Notification::send($users, new NewTopicCreatedNotification($event->topic));
    }
}
