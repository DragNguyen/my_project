<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed products
 */
class Trademark extends Model
{

    public function productTypeTrademarks() {
        return $this->hasMany(ProductTypeTrademark::class);
    }

    public function canDelete() {
        return $this->productTypeTrademarks->count() == 0;
    }

    public function matchedProductType($id) {
        return $this->productTypeTrademarks()->where('product_type_id', $id)->count() > 0;
    }
}
