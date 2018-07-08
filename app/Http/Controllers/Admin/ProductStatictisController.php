<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\ProductType;
use App\SalesOffProduct;
use App\Trademark;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class ProductStatictisController extends Controller
{
    public function index(Request $request) {
        $trademarks = Trademark::all();
        $product_types = ProductType::all();
        $dashboard_products = $this->getDashboardProduct();
        if ($request->has('quantity')) {
            $product_hots = $this->getProductHot($request, $request->get('time'),
                $request->get('time-type'), $request->get('quantity'));
        }
        else {
            $product_hots = $this->getProductHot($request);
        }
        $product_outs = DB::table('products')->join('quantities', 'products.id', 'product_id')
            ->where('quantity', 0)->select('products.id', 'avatar', 'name')->paginate(10);

        return view('admin.statictis.product.index',
            compact(['trademarks', 'product_types', 'dashboard_products', 'product_hots', 'product_outs']));
    }

    public function getDashboardProduct() {
        $dashboard_products = [];
        array_push($dashboard_products, Product::count());
        array_push($dashboard_products,
            Product::where('product_created_at', '>=', date_modify(date_create(date('Y-m-d')), '-1 weeks'))->count()
        );
        array_push($dashboard_products, SalesOffProduct::count());
        array_push($dashboard_products,
            DB::table('products')->join('quantities', 'products.id', 'product_id')
                ->where('quantity', 0)->count()
        );
        array_push($dashboard_products, Product::where('is_deleted', true)->count());
        return $dashboard_products;
    }

    public function getProductHot($request, $time=1, $time_type='weeks', $quantity=5) {
        $product_hots = [];
        foreach(Product::all() as $product) {
            $product_hot = [
                'id' => $product->id,
                'buys' => DB::table('order_products')->join('orders', 'order_id', 'orders.id')
                    ->where('product_id', $product->id)
                    ->where('order_created_at', '>=',
                        date_format(date_modify(date_create(date('Y-m-d')), '-'.$time.' '.$time_type.'s'), 'Y-m-d'))
                    ->count('product_id')
            ];
            array_push($product_hots, $product_hot);
        }
        $product_hots = array_reverse(array_sort($product_hots, function ($product_hot) {
            return $product_hot['buys'];
        }));

        $page = Input::get('page', 1);
        $offset = ($page * 10) - 10;
        $total = ($quantity < count($product_hots)) ? $quantity : count($product_hots);
        $product_hots = new LengthAwarePaginator(array_slice($product_hots, $offset, 10, true),
            $total, 10, $page,
            ['path' => $request->url(), 'query' => $request->query()]);

        return $product_hots;
    }
}
