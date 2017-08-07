<?php

namespace App\Listeners;

use App\Events\NewPremiumPayment;
use App\Mail\NewPremium;
use App\Notifications\NewPremiumUser;
use App\Notifications\UserRegistered;
use App\Repositories\UserRepository;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class NotifyAboutAboutNewPremiumUser
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
     * @param  NewPremiumPayment  $event
     * @return void
     */
    public function handle(NewPremiumPayment $event)
    {
        $admins = UserRepository::getAllAdmins();
        Notification::send($admins, new NewPremiumUser($event->user));

        Mail::to($event->user)->send(new NewPremium($event->user));
    }
}
