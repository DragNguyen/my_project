<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed products
 */
class Trademark extends Model
{
    public function products() {
        return $this->hasMany(Product::class);
    }

    public function canDelete() {
        return $this->products->count() == 0;
    }
}
