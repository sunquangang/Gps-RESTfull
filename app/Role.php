<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
      protected $table = 'role_user';

      //protected $fillable = ['id', 'name', 'email', 'password', 'remember_token'];

      /**
       * The attributes excluded from the model's JSON form.
       *
       * @var array
       */
      protected $hidden = [];

      public function user()
      {
          return $this->hasOne('App\User', 'id');
      }

}
