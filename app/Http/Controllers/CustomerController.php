<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function index() {
        $items = \App\Product::paginate(24);
        $home = true;

        return view('customer', compact(['items', 'menuItems', 'home']));
    }

    public function productTypeIndex($slug) {
        $items = DB::table('product_types')
            ->join('product_type_trademarks', 'product_types.id', 'product_type_id')
            ->join('products', 'product_type_trademark_id', 'product_type_trademarks.id')
            ->join('trademarks', 'trademark_id', 'trademarks.id')
            ->where('product_types.slug', $slug)
            ->select('products.id', 'product_types.slug')->get();
        $menuItems = \App\ProductType::all();

        return view('customer', compact(['items', 'menuItems']));
    }
}
