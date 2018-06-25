<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesOffProduct extends Model
{
    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function getProduct() {
        return $this->product->name;
    }
}
