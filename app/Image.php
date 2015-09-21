<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Image extends Model
{
	//use SoftDeletingTrait;
    protected $table = 'images';
	protected $fillable = ['path', 'filename', 'ext', 'mime_type', 'point_id', 'created_by', 'updated_by', 'base64'];
    protected $hidden =['deleted_at', 'mime_type', 'point_id', 'created_at', 'updated_at', 'created_by', 'updated_by'];
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
