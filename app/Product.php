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

    public function productType() {
        return $this->belongsTo(ProductType::class);
    }

    public function trademark() {
        return $this->belongsTo(Trademark::class);
    }

    public function status() {
        return ($this->is_activated) ? 'Đang bán' : 'Ngừng kinh doanh';
    }

    public function currentPrice() {
        return $this->prices->max()->price;
    }
}
