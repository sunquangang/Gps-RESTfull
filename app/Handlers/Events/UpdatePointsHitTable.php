<?php

namespace App\Handlers\Events;

use App\Events\PointWasViewed;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdatePointsHitTable
{
    /**
     * Create the event handler.
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
     * @param  PointWasViewed  $event
     * @return void
     */
    public function handle(PointWasViewed $event)
    {
        //
        try {
          dd($event);
            $hit = new \App\PointHit();
            $hit->point_id = $point_id;
            if (!$hit->save()) {
                return $this->respondInternalError();
            }
            return $hit;

        } catch (Exception $e) {
            return $this->respondWithError();
        }
    }
}
