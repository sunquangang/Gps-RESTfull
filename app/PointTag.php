<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PointTag extends Model
{
    protected $table = 'point_tag';
    protected $fillable = ['point_id', 'tag_id'];
    public $timestamps = false;

    public function tags()
    {
        return $this->belongsToMany('\App\Tag', 'tag_id');
    }

    public function point()
    {
        return $this->belongsToMany('\App\Point', 'point_id');
    }

}
