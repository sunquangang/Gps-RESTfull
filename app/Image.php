<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Image extends Model
{
	//use SoftDeletingTrait;
    protected $table = 'images';
	protected $fillable = ['path', 'point_id', 'created_at', 'updated_at'];
    /*
    *	A image has one Point
    */
    public function point()
    {
    	return $this->hasOne('App\Point'); 
    }
    
    
}
