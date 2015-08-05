<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Category extends Model
{
	//use SoftDeletingTrait;
    protected $table = 'categories';
	protected $fillable = [];
    protected $hidden = [];

    public function point()
    {
        return $this->hasMany('App\Point');
    }

}
