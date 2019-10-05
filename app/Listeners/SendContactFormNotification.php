<?php

namespace App\Listeners;

use App\Events\ContactFormSubmitted;
use App\User;
use Illuminate\Support\Facades\Notification;

class SendContactFormNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param ContactFormSubmitted $event
     */
    public function handle(ContactFormSubmitted $event)
    {
        $admin = User::first();
        $admin->notify(new \App\Notifications\ContactFormSubmitted($event->contactForm));

        Notification::route('mail', $event->contactForm->email)
            ->notify(new \App\Notifications\ContactFormSubmitted($event->contactForm))
        ;
    }
}
