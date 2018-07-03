<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specification extends Model
{
    public function specificationProducts() {
        return $this->hasMany(SpecificationProduct::class);
    }

    public function getValue($product_id) {
        if ($this->specificationProducts()->where('product_id', $product_id)->count() > 0) {
            return $this->specificationProducts()->where('product_id', $product_id)->first()->value;
        }
        else {
            return 'Chưa cập nhật';
        }
    }
}
