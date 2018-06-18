<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed price
 * @property mixed product_id
 */
class Price extends Model
{
    protected $table = 'prices';

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
