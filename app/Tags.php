<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
	//use SoftDeletingTrait;
    protected $table = 'tags';
	  protected $fillable = ['id', 'name'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * A Category has many Points
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
     public function point()
     {
         return $this->hasMany('App\Point');
     }

     public function PointTags()
     {
         return $this->hasMany('App\PointTag', 'tag_id');
     }




}
