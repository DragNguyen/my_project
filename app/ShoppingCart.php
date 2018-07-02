<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    public function shoppingCartProducts() {
        return $this->hasMany(ShoppingCartProduct::class);
    }

    public function getCartProduct() {
        return $this->shoppingCartProducts;
    }

    public function matchedProduct($product_id) {
        if ($this->shoppingCartProducts()->where('product_id', $product_id)->count() > 0) {
            return true;
        }
        else {
            return false;
        }
    }

    public function getCartProductById($product_id) {
        return $this->shoppingCartProducts()->where('product_id', $product_id)->first();
    }
}
