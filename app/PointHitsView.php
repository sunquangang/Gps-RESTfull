<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PointHitsView extends Model
{
    //
    protected $table = 'point_hits_view';

    public function point()
    {
        return $this->belongsTo('App\Point', 'point_id');
    }

    public function hits()
    {
        return $this->belongsTo('App\Hits', 'point_id');
    }
}
