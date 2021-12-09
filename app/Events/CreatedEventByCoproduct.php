<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

/**
 * Class CreatedEventByCoproduct
 * @package App\Events
 * @param object $product
 */
class CreatedEventByCoproduct
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var object $product
     */
    public object $product;


    /**
     * Create a new event instance.
     * CreatedEventByCoproduct constructor.
     * @param  object $product
     * @return void
     */
    public function __construct(object $product)
    {
        $this->product = $product;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
