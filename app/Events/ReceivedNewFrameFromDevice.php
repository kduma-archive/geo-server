<?php

namespace App\Events;

use App\DataFrame;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReceivedNewFrameFromDevice
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    
    /**
     * @var DataFrame
     */
    private $incomingData;

    /**
     * Create a new event instance.
     *
     * @param DataFrame $incomingData
     */
    public function __construct(DataFrame $incomingData)
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
     * @return DataFrame
     */
    public function getIncomingData(): DataFrame
    {
        return $this->incomingData;
    }
}
