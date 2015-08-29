<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    protected $table = 'tags';
	  protected $fillable = ['id', 'name'];
    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];
    public $timestamps = false;

    /**
     * A Category has many Points
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
     public function point()
     {
         return $this->hasMany('App\Point');
     }





}
