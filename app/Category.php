<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Category extends Model
{
	//use SoftDeletingTrait;
    protected $table = 'categories';
	protected $fillable = ['name'];
    protected $hidden = [ 'created_by', 'created_at', 'updated_at', 'deleted_at'];

    public function point()
    {
        return $this->hasMany('App\Point');
    }

}
