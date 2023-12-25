<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Workbench\Database\Model\Bill\PayerBill;

class InboxNote
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $PayerBill;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(PayerBill $PayerBill)
    {
        $this->PayerBill = $PayerBill;
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
