<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $guard = 'admin';

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

    public function goodsReceiptNotes() {
        return $this->hasMany(GoodsReceiptNote::class);
    }

    public function orderStatus() {
        return $this->hasMany(OrderStatus::class);
    }

    public function canDelete() {
        return ($this->goodsReceiptNotes->count() == 0) && ($this->orderStatus->count() == 0);
    }

    public function getRole() {
        return ($this->role == 0) ? 'Admin' : 'Nhân viên';
    }

    public function getGender() {
        return ($this->gender == 1) ? 'Nam' : 'Nữ';
    }
}
