<?php

namespace App\Listeners;

use App\Events\UserRegistration;
use App\Notifications\UserRegistered;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\NewUser;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

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
        // notify admins
        $admins = User::where('admin', 1)->get();
        Notification::send($admins, new UserRegistered($event->user));

        // send an email to the user
        Mail::to($event->user)->send(new NewUser($event->user));
    }
}
