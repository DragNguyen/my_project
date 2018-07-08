<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductTypeTrademark extends Model
{
    public function productType() {
        return $this->belongsTo(ProductType::class);
    }

    public function trademark() {
        return $this->belongsTo(Trademark::class);
    }

    public function products() {
        return $this->hasMany(Product::class);
    }

    public function getProductTypeName() {
        return $this->productType->name;
    }

    public function getTrademarkName() {
        return $this->trademark->name;
    }
}
