<?php

namespace App\Listeners;

use App\Events\UpdatedEventByCoproduct;
use App\Notifications\SendNotificationByCoproduct;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class UpdatedEventListenerByCoproduct
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
     * @param  \App\Events\UpdatedEventByCoproduct  $event
     * @return void
     */
    public function handle(UpdatedEventByCoproduct $event)
    {
        $user = Auth::user();
        $user->notify(new SendNotificationByCoproduct($event->product['name'], $event->product['description'],$event->product['image'],'updated'));
    }
}
