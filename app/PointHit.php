<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PointHit extends Model
{
    protected $table = 'point_hits';

    /**
     * Fillable fields
     * @var array
     */
    protected $fillable = ['id', 'point_id'];

    public function point()
    {
        return $this->belongsTo('App\Point', 'point_id');
    }
}
