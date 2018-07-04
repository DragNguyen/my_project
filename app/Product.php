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

    public function salesOffProducts() {
        return $this->hasMany(SalesOffProduct::class);
    }

    public function quantities() {
        return $this->hasMany(Quantity::class);
    }

    public function productTypeTrademark() {
        return $this->belongsTo(ProductTypeTrademark::class);
    }

    public function goodsReceiptNoteProducts() {
        return $this->hasMany(GoodsReceiptNoteProduct::class);
    }

    public function orderProducts() {
        return $this->hasMany(OrderProduct::class);
    }

    public function shoppingCartProducts() {
        return $this->hasMany(ShoppingCartProduct::class);
    }

    public function status() {
        if ($this->is_deleted) {
            return 'Ngừng kinh doanh';
        }
        return ($this->is_activated) ? 'Đang bán' : 'Tạm hết hàng';
    }

    public function currentPrice() {
        return $this->prices->max()->price;
    }

    public function getQuantity() {
        return $this->quantities->first()->quantity;
    }

    public function isSalesOff() {
        return $this->salesOffProducts()->count() > 0;
    }

    public function getSalesOffPercent() {
        return ($this->isSalesOff()) ? $this->salesOffProducts()->first()->salesOff->value : 0;
    }

    public function getSalesOffPrice() {
        return $this->currentPrice() - ($this->currentPrice() * $this->getSalesOffPercent() / 100);
    }

    public function getChangedQuantity($quantity) {
        $changed_quantity = $this->getQuantity() + $quantity;
        return ($changed_quantity > 0) ? $changed_quantity : 0;
    }

    public function matchedName($product_name) {
        return Product::where('slug', str_slug($product_name))->count() > 0;
    }

    public function canDelete() {
        if (($this->goodsReceiptNoteProducts->count() > 0) || ($this->orderProducts->count() > 0)
            || ($this->shoppingCartProducts->count() > 0)) {
            return false;
        }
        return true;
    }

    public function getProductTypeName() {
        return $this->productTypeTrademark->getProductTypeName();
    }

    public function getTrademarkName() {
        return $this->productTypeTrademark->getTrademarkName();
    }
}
