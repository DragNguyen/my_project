<?php

namespace App\Http\Controllers\Admin\Restore;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductRestoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::where('is_deleted', true)->paginate(10);

        return view('admin.restore.product.index', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->has('product-ids')) {
            return back();
        }
        $ids = $request->get('product-ids');
        foreach($ids as $id) {
            $product = Product::findOrFail($id);
            $product->is_deleted = false;
            $product->update();
        }

        return back()->with('success', 'Phục hồi thành công.');
    }
}
