<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdatedEventByCoproduct
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var object $product
     */
    public object $product;

    /**
     * Create a new event instance.
     * UpdatedEventByCoproduct constructor.
     * @param  object $product
     * @return void
     */
    public function __construct(object $product)
    {
        $this->product = $product;
    }
}
