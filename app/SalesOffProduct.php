<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesOffProduct extends Model
{
    public function salesOff() {
        return $this->belongsTo(SalesOff::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function getProduct() {
        return $this->product->name;
    }
}
