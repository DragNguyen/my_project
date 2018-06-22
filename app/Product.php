<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed prices
 * @property mixed name
 * @property mixed product_type_id
 * @property mixed trademark_id
 * @property mixed id
 */
class Product extends Model
{
    protected $table = 'products';

    public function prices() {
        return $this->hasMany(Price::class);
    }

    public function images() {
        return $this->hasMany(Image::class);
    }

    public function productTypeTrademark() {
        return $this->belongsTo(ProductTypeTrademark::class);
    }

    public function status() {
        return ($this->is_activated) ? 'Đang bán' : 'Ngừng kinh doanh';
    }

    public function getProductType() {
        return $this->productTypeTrademark->productType;
    }

    public function getTrademark() {
        return $this->productTypeTrademark->trademark;
    }

    public function currentPrice() {
        return $this->prices->max()->price;
    }

    public function getSpecValue($id) {
        $spec = SpecificationProduct::where('specification_id', $id)->where('product_id', $this->id)->first();
        return $spec->value;
    }

    public function getChangedQuantity($quantity) {
        $changed_quantity = $this->quantity + $quantity;
        return ($changed_quantity > 0) ? $changed_quantity : 0;
    }
}
