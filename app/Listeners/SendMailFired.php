<?php

namespace App\Listeners;

use App\Events\SendMail;
use App\Models\Company;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\User;
use Mail;

class SendMailFired
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
     * @param  \App\Events\SendMail  $event
     * @return void
     */
    public function handle(SendMail $event)
    {
        $mail = $event->mail;
        Mail::send('company.mail',[] ,function($message) use ($mail) {
            $message->to($mail);
            $message->subject('New Company Registered!');
        });

    }
}
