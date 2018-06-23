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

    public function getProductType() {
        return $this->productType->name;
    }

    public function getTrademark() {
        return $this->trademark->name;
    }
}
