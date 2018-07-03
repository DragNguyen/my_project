<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    public function products() {
        return $this->hasMany(Product::class);
    }

    public function specificationProductTypes() {
        return $this->hasMany(SpecificationProductType::class);
    }

    public function canDelete() {
        return $this->products->count() == 0;
    }

    public function matchedSpecification($id) {
        return $this->specificationProductTypes()->where('specification_id', $id)->count() > 0;
    }
}
