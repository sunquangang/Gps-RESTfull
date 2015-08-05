<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletingTrait;

class point extends model
{

	//use softdeletingtrait;
    protected $table = 'points';
	protected $fillable = ['latitude', 'longitude', 'created_by', 'created_at'];
    protected $hidden = ['deleted_at'];
    public function user()
    {
    	return $this->belongsTo('App\User', 'created_by');
    }
    public function image()
    {
        return $this->hasMany('App\Image');
    }

    public function category()
    {
        return $this->hasOne('App\Category', 'id', 'category_id');
    }
}
