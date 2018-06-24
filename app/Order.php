<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    public function orderStatus() {
        return $this->hasMany(OrderStatus::class);
    }

    public function orderProducts() {
        return $this->hasMany(OrderProduct::class);
    }

    public function getTotalOfProduct() {
        return $this->orderProducts->count();
    }

    public function getStatus() {
        return $this->orderStatus->first()->status;
    }

    public function getApprover() {
        return $this->orderStatus->first()->approver;
    }
}
