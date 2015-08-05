<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Image extends Model
{
	//use SoftDeletingTrait;
    protected $table = 'images';
	protected $fillable = ['path'];
    protected $hidden =[];
    /*
    *	A image has one Point
    */
    public function point()
    {
    	return $this->belongsTo('App\Point', 'point_id');
    }
    
    
}
