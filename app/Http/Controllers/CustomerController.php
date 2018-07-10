<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductType;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class CustomerController extends Controller
{
    public function index(Request $request) {

        $items = [];
        foreach (ProductType::all() as $product_type) {
            array_push($items, $this->getProductNew($product_type->id));
        }

        return view('customer', compact('items'));
    }

    public function productTypeIndex($slug, Request $request) {
        $items = [];
        foreach($this->getProductByType($slug) as $product_id) {
            array_push($items, [
                'id' => $product_id->id,
                'price' => Product::find($product_id->id)->getSalesOffPrice()
            ]);
        }
        if ($request->has('trademark')) {
            $items = [];
            foreach($this->getProductByTrademark($slug, $request->get('trademark')) as $product_id) {
                array_push($items, [
                    'id' => $product_id->id,
                    'price' => Product::find($product_id->id)->getSalesOffPrice()
                ]);
            }
        }
        if ($request->has('cost')) {
            $items = $this->getProductByCost($request, $items);
        }
        $items = $this->orderBy($items, $request->has('order-by')?'desc':'asc');
        $items = $this->getPaginate($request, $items);
        $trademarks = DB::table('product_types')
            ->join('product_type_trademarks', 'product_types.id', 'product_type_id')
            ->join('trademarks', 'product_type_trademarks.trademark_id', 'trademarks.id')
            ->where('slug', $slug)->select('trademarks.id', 'trademarks.name')->get();

        return view('customer.product.show', compact(['items', 'trademarks']));
    }

    public function getProductByType($slug) {
        $products = DB::table('product_types')
            ->join('product_type_trademarks', 'product_types.id', 'product_type_id')
            ->join('products', 'product_type_trademark_id', 'product_type_trademarks.id')
            ->where('product_types.slug', $slug)
            ->select('products.id')->get();

        return $products;
    }

    public function getProductNew($product_type_id) {
        $products = DB::table('product_types')
            ->join('product_type_trademarks', 'product_types.id', 'product_type_id')
            ->join('products', 'product_type_trademark_id', 'product_type_trademarks.id')
            ->where('product_types.id', $product_type_id)
            ->orderBy('product_created_at', 'desc')->get();

        return $products;
    }

    public function getProductByTrademark($slug, $trademark_id) {
        $products = DB::table('product_types')
            ->join('product_type_trademarks', 'product_types.id', 'product_type_id')
            ->join('products', 'product_type_trademark_id', 'product_type_trademarks.id')
            ->join('trademarks', 'trademark_id', 'trademarks.id')
            ->where('product_types.slug', $slug)->where('trademarks.id', $trademark_id)
            ->select('products.id')->get();

        return $products;
    }

    public function getProductByCost($request, $products) {
        $items = [];
        $costs = explode('-', $request->get('cost'));
        if (count($costs) == 1) {
            if ($costs[0] == 5) {
                foreach($products as $product) {
                    $product = Product::find($product['id']);
                    if ($product->getSalesOffPrice() <= 5000000) {
                        array_push($items, [
                            'id' => $product->id,
                            'price' => $product->getSalesOffPrice()
                        ]);
                    }
                }
            }
            else {
                foreach($products as $product) {
                    $product = Product::find($product['id']);
                    if ($product->getSalesOffPrice() >= 20000000) {
                        array_push($items, [
                            'id' => $product->id,
                            'price' => $product->getSalesOffPrice()
                        ]);
                    }
                }
            }
        }
        else {
            foreach($products as $product) {
                $product = Product::find($product['id']);
                if (($product->getSalesOffPrice() >= $costs[0] * 1000000)
                    && ($product->getSalesOffPrice() < $costs[1] * 1000000)) {
                    array_push($items, [
                        'id' => $product->id,
                        'price' => $product->getSalesOffPrice()
                    ]);
                }
            }
        }

        return $items;
    }

    public function orderBy($items, $order_by) {
        if ($order_by == 'asc') {
            $items = array_sort($items, function($item) {
                return $item['price'];
            });
        }
        else {
            $items = array_reverse(array_sort($items, function($item) {
                return $item['price'];
            }));
        }
        return $items;
    }

    public function getPaginate($request, $items) {
        $page = Input::get('page', 1);
        $offset = ($page * 12) - 12;
        $total = count($items);
        $items = new LengthAwarePaginator(array_slice($items, $offset, 12, true),
            $total, 12, $page,
            ['path' => $request->url(), 'query' => $request->query()]);

        return $items;
    }
}
