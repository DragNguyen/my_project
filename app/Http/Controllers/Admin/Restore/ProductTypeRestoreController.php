<?php

namespace App\Http\Controllers\Admin\Restore;

use App\ProductType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductTypeRestoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_types = ProductType::where('is_deleted', true)->paginate(10);

        return view('admin.restore.product-type.index', compact('product_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->has('product-type-ids')) {
            return back();
        }

        $ids = $request->get('product-type-ids');
        foreach($ids as $id) {
            $product_type = ProductType::findOrFail($id);
            $product_type->is_deleted = false;
            $product_type->update();
        }

        return back()->with('success', 'Phục hồi thành công.');
    }
}
