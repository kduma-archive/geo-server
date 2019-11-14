<?php

namespace App\Events;

use App\IncomingData;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReceivedNewDataFromLocator
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    /**
     * @var IncomingData
     */
    private $incomingData;

    /**
     * Create a new event instance.
     *
     * @param IncomingData $incomingData
     */
    public function __construct(IncomingData $incomingData)
    {
        $this->incomingData = $incomingData;
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

    /**
     * @return IncomingData
     */
    public function getIncomingData(): IncomingData
    {
        return $this->incomingData;
    }
}
