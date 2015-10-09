<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PointTag extends Model
{
    protected $table = 'point_tag';
    protected $fillable = ['point_id', 'tags_id', 'created_by'];
    public $timestamps = false;

    public function tags()
    {
        return $this->belongsToMany('\App\Tag', 'tags_id');
    }

    public function point()
    {
        return $this->belongsToMany('\App\Point', 'point_id');
    }

}
