<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PointTag extends Model
{
    protected $table = 'point_tags';
    protected $fillable = ['point_id', 'tag_id'];

    public function tags()
    {
        return $this->belongsToMany('\App\Tag', 'tag_id');
    }

    public function point()
    {
        return $this->belongsToMany('\App\Point', 'point_id');
    }

}
