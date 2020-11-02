<?php

namespace App\Listeners;

use App\Events\CreatedUser;
use App\Jobs\SendEmail;
use App\Mail\WelcomeUser;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmailListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  CreatedUser  $event
     * @return void
     */
    public function handle(CreatedUser $event)
    {
        Mail::to($event->user['mail'])->send(new WelcomeUser($event->user['name']));
    }
}
