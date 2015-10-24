<?php

namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class PointWasViewed extends Event
{
    use SerializesModels;

    public $point;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Point $point)
    {
        $this->point = $point;
    }

    /**
     * Get the channels the event should be broadcast on.
     *
     * @return array
     */
    public function broadcastOn()
    {
        return [];
    }
}
