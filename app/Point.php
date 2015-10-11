<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
#use Illuminate\Database\Eloquent\SoftDeletingTrait;

/**
 * Class Point
 * @package App
 */
class Point extends model
{

	#use SoftDeletingTrait;
    /**
     *  Table
     */
    protected $table = 'points';

    /**
     * Fillable fields
     * @var array
     */
    protected $fillable = ['id', 'name','description','latitude', 'longitude', 'created_by', 'updated_by'];

    /**
     * Hidden fields
     * @var array
     */
    protected $hidden = ['deleted_at'];

    /**
     * A Point belongs to a User
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
    	return $this->belongsTo('App\User', 'created_by');
    }

    /**
     * A Point has many Images
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function image()
    {
        return $this->hasMany('App\Image', 'point_id');
    }

    /**
     * A Point has many through point_tags
     * @return \Illuminate\Database\Eloquent\Relations\hasManyThrough
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tags', 'point_tag')->withPivot('id', 'tags_id');
    }

    public function hits()
    {
        return $this->hasMany('App\PointHit', 'point_id');
    }

}
