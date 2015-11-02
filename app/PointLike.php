<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PointLike extends Model
{
  protected $table = 'point_likes';
  protected $fillable = ['id', 'point_id', 'user_id'];

  public function user()
  {
      return $this->hasOne('App\User', 'id');
  }

  public function point()
  {
      return $this->hasOne('App\Point', 'id');
  }
}
