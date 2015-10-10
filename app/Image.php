<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
#use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Image extends Model
{
    #use SoftDeletingTrait;
    protected $table = 'images';
	protected $fillable = ['point_id', 'filename','mime_type', 'created_by', 'updated_by', 'base64'];
    protected $hidden =[];
    /**
    *	A image belongs to a Point
    */
    public function point()
    {
        return $this->belongsTo('App\Point', 'point_id');
    }

    /**
     * A image belongs to a User
     */
    public function user()
    {
        return $this->belongsTo('App\User', 'created_by');
    }


}
