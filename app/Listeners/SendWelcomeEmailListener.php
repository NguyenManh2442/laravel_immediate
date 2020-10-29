<?php

namespace App\Listeners;

use App\Events\CreatedUser;
use App\Jobs\SendEmail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
        SendEmail::dispatch($event->user);
    }
}
