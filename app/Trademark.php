<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property mixed products
 */
class Trademark extends Model
{

    public function productTypeTrademarks() {
        return $this->hasMany(ProductTypeTrademark::class);
    }

    public function canDelete() {
        return DB::table('trademarks')
            ->join('product_type_trademarks', 'trademarks.id', 'trademark_id')
            ->join('products', 'product_type_trademarks.id', 'product_type_trademark_id')
            ->where('trademarks.id', $this->id)->count('products.id') == 0;
    }

    public function matchedProductType($id) {
        return $this->productTypeTrademarks()->where('product_type_id', $id)->count() > 0;
    }
}
