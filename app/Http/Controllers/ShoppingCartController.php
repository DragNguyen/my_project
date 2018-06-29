<?php

namespace App\Http\Controllers;

use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    public function showProduct($slug) {
        $product = Product::where('slug', $slug)->first();

        return view('customer.product.index', compact('product'));
    }

    public function addProduct($id, Request $request) {
        $product = Product::find($id);
        $quantity = $request->get('quantity');
        Cart::add($id, $product->name, $quantity, 0);

        return back();
    }

    public function cartGet() {
        dd(Cart::content());
    }

    public function cartIndex() {
        $cart_products = Cart::content();

        return view('customer.shopping-cart.index', compact('cart_products'));
    }

    public function cartUpdate($rowId, Request $request) {
        $quantity = $request->get('quantity');
        if ($quantity > 5) {
            return back()->with('error', 'Chỉ cho phép mua tối đa số lượng 5 trên mỗi sản phẩm!');
        }
        if ($quantity == 0) {
            return back();
        }
        Cart::update($rowId, $quantity);

        return back();
    }

    public function cartRemove($rowId) {
        Cart::remove($rowId);

        return back();
    }
}
