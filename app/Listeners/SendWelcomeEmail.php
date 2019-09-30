<?php

namespace Alley\Listeners;

use Alley\Events\NewRegisteredVendor;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmail
{
    private $NewRegisteredVendor;
    /**
     * Create the event listener.
     ** @param  NewRegisteredVendor  $event
     * @return void
     */


    public function __construct(NewRegisteredVendor $event)
    {
        $this->NewRegisteredVendor=$event;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(NewRegisteredVendor $event)
    {
        //send the welcome email to the vendor
        $user = $event->user;
        Mail::send('welcome', ['user' => $user], function ($message) use ($user) {
            $message->from('alley@gmail.com');
            $message->subject('Welcome aboard to our application' .$user->first_name." ".$user->last_name);
            $message->to($user->email);
        });
    }
}
