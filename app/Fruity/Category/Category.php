<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Category extends Model
{
    //use SoftDeletingTrait;
    protected $table = 'categories';
	protected $fillable = ['name'];
	protected $hidden = ['created_at', 'updated_at', 'deleted_at']; 

	public function point()
	{
		return $this->hasMany('App\Point', 'category_id');
	}
}
