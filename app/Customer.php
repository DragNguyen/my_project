<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Customer extends Authenticatable
{
    protected $guard = 'customer';

    protected $fillable = [
        'email',
        'name',
        'password',
        'phone',
        'gender'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
