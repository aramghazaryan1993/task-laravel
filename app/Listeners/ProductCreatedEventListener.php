<?php

namespace App\Listeners;

use App\Events\ProductCreatedEvent;
use App\Notifications\SendNotificationByCoproduct;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

/**
 * Class ProductCreatedEventListener
 * @package App\Listeners
 */
class ProductCreatedEventListener
{
    /**
     * Handle the event.
     *
     * @param  \App\Events\ProductCreatedEvent  $event
     * @return void
     */
    public function handle(ProductCreatedEvent  $event)
    {
        $user = Auth::user();
        $user->notify(new SendNotificationByCoproduct($event->product->name, $event->product->description,$event->product->image,'created'));
    }
}
