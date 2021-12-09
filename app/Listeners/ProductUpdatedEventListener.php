<?php

namespace App\Listeners;

use App\Events\ProductUpdatedEvent;
use App\Notifications\SendNotificationByCoproduct;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class UpdatedEventListenerByCoproduct
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\ProductUpdatedEvent  $event
     * @return void
     */
    public function handle(ProductUpdatedEvent $event)
    {
        $user = Auth::user();
        $user->notify(new SendNotificationByCoproduct($event->product->name, $event->product->description,$event->product->image,'updated'));
    }
}
