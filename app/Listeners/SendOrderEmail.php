<?php

namespace Alley\Listeners;

use Alley\Events\NewProductOrder;
use Alley\Modules\Account\Models\User;
use Alley\Modules\Vendor\Models\Order;
use Illuminate\Support\Facades\Mail;

class SendOrderEmail
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(NewProductOrder $event,Order $order,User $user)
    {
        $this->NewProductOrder = $event;
        $this->order = $order;
        $this->user  = $user;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(NewProductOrder $event)
    {
        // send ordered product email to the vendor

        $order = $event->order;
        $user  = $event->user;
        Mail::send('order', ['order' => $order], function ($message) use ($order,$user) {
            $message->from($this->order->email);
            $message->subject('I NEED THIS PRODUCT');
            $message->to($user->email);
        });
    }
}
