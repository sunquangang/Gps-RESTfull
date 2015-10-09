<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    protected $table = 'tags';
	  protected $fillable = ['id', 'tag', 'created_by'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    public $timestamps = false;

    /**
     * A Category has many Points
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
     public function points()
     {
         return $this->belongsToMany('App\Point', 'point_tag')->withPivot('id', 'point_id');
     }





}
