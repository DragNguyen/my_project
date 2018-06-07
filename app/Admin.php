<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $guard = 'admin';

    protected $fillable = [
      'email',
      'name',
      'username',
      'password',
      'phone',
    ];

    protected $hidden = [
      'password', 'remember_token',
    ];
}
