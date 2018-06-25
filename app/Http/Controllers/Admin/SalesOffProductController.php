<?php

namespace App\Http\Controllers\Admin;

use App\SalesOffProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalesOffProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!$request->has('product-ids')) {
            return back();
        }
        $ids = $request->get('product-ids');
        foreach($ids as $id) {
            $sales_off_product = new SalesOffProduct();
            $sales_off_product->product_id = $id;
            $sales_off_product->sales_off_id = $request->get('sales-off-child-id');
            $sales_off_product->save();
        }

        return back()->with('success', 'Thêm thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $sales_off_product = SalesOffProduct::findOrFail($id);
        $sales_off_product->product_id = $request->get('product-id');
        $sales_off_product->update();

        return back()->with('success', 'Cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if (!$request->has('sales-off-product-ids')) {
            return back();
        }
        $ids = $request->get('sales-off-product-ids');
        SalesOffProduct::destroy($ids);

        return back()->with('success', 'Xóa thành công.');
    }
}
