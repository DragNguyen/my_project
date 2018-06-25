<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalesOff extends Model
{
    public function salesOffs() {
        return $this->hasMany(SalesOff::class);
    }

    public function salesOff() {
        return $this->belongsTo(SalesOff::class);
    }

    public function salesOffProducts() {
        return $this->hasMany(SalesOffProduct::class);
    }

    public function getTotalOfChild() {
        return $this->salesOffs->count();
    }

    public function matchedProduct($product_id) {
        return $this->salesOffProducts()->where('product_id', $product_id)->count() > 0;
    }

    public function matchedValue($value) {
        return $this->salesOffs()->where('value', $value)->count() > 0;
    }

    public function canDelete() {
        return $this->salesOffs()->count() == 0;
    }
}
