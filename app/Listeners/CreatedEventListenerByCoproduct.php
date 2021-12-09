<?php

namespace App\Listeners;

use App\Events\CreatedEventByCoproduct;
use App\Notifications\SendNotificationByCoproduct;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class CreatedEventListenerByCoproduct
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
     * @param  \App\Events\CreatedEventByCoproduct  $event
     * @return void
     */
    public function handle(CreatedEventByCoproduct  $event)
    {
        $user = Auth::user();
        $user->notify(new SendNotificationByCoproduct($event->product['name'], $event->product['description'],$event->product['image'],'created'));
    }
}
