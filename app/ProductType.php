<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    public function productTypeTrademarks() {
        return $this->hasMany(ProductTypeTrademark::class);
    }

    public function specificationProductTypes() {
        return $this->hasMany(SpecificationProductType::class);
    }

    public function canDelete() {
        return $this->productTypeTrademarks->count() == 0;
    }

    public function matchedSpecification($id) {
        return $this->specificationProductTypes()->where('specification_id', $id)->count() > 0;
    }
}
