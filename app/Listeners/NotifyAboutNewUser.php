<?php

namespace App\Listeners;

use App\Events\UserRegistration;
use App\Mail\UserNotifyAdmin;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\NewUser;
use Illuminate\Support\Facades\Mail;

class NotifyAboutNewUser
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
     * @param  UserRegistration  $event
     * @return void
     */
    public function handle(UserRegistration $event)
    {
        //$username = $event->user->first_name . ' ' . $event->user->last_name;
        //Mail::to(env('ADMIN_EMAIL'))->send(new UserNotifyAdmin($username));

        Mail::to($event->user)->send(new NewUser($event->user));
    }
}
