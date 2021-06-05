<?php

namespace Sparkouttech\UserAuth\App\Listeners;

use Sparkouttech\UserAuth\App\Mail\WelcomeNewUserMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class WelcomeNewUserListener implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        sleep(10);

        Mail::to($event->user->email)->send(new WelcomeNewUserMail());
    }
}
