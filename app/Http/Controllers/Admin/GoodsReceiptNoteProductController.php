<?php

namespace App\Http\Controllers\Admin;

use App\GoodsReceiptNoteProduct;
use App\Product;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodsReceiptNoteProductController extends Controller
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
        $validate = $this->validation($request);

        if ($validate->fails()) {
            return back()->withErrors($validate);
        }

        $price = str_replace(',', '', $request->get('price'));
        if ($price > 100000000) {
            return back()->with('error', 'Giá tiền không được vượt quá 100,000,000đ !');
        }
        if ($price < 1000) {
            return back()->with('error', 'Giá tiền không được nhỏ quá 1,000đ !');
        }
        $quantity = $request->get('quantity');
        $goods_receipt_note_product = new GoodsReceiptNoteProduct();
        $goods_receipt_note_product->goods_receipt_note_id = $request->get('id');
        $goods_receipt_note_product->product_id = $request->get('product-name');
        $goods_receipt_note_product->quantity = $quantity;
        $goods_receipt_note_product->price = $price;
        $goods_receipt_note_product->quantity_updated = $quantity;
        if ($goods_receipt_note_product->save()) {
            $product = Product::findOrFail($goods_receipt_note_product->product_id);
            $product->quantity += $quantity;
            $product->update();
        }

        return back()->with('success', 'Thêm sản phẩm cho phiếu nhập thành công.');
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
        $validate = $this->validation($request);
        if ($validate->fails()) {
            return back()->withErrors($validate);
        }

        $price = str_replace(',', '', $request->get('price'));
        if ($price > 100000000) {
            return back()->with('error', 'Đơn giá không được vượt quá 100,000,000đ !');
        }
        if ($price < 1000) {
            return back()->with('error', 'Đơn giá không được nhỏ hơn 1,000đ !');
        }

        $quantity = $request->get('quantity');

        $goods_receipt_note_product = GoodsReceiptNoteProduct::findOrFail($id);

        $quantity_changed = $quantity - $goods_receipt_note_product->quantity_updated;

        $goods_receipt_note_product->product_id = $request->get('product-name');
        $goods_receipt_note_product->quantity = $request->get('quantity');
        $goods_receipt_note_product->price = $price;
        $goods_receipt_note_product->quantity_updated = $quantity;

        if ($goods_receipt_note_product->update()) {
            $product = Product::findOrFail($goods_receipt_note_product->product_id);
            $product->quantity = $product->getChangedQuantity($quantity_changed);
            $product->update();
        }

        return back()->with('success', 'Sửa thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $ids = $request->get('goods-receipt-note-product-id');

        foreach ($ids as $id) {
            $product = Product::findOrFail($id);
            $goods_receipt_note_product = GoodsReceiptNoteProduct::find($id);
            $quantity_changed = - $goods_receipt_note_product->quantity_updated;
            $goods_receipt_note_product->delete();
            $product->quantity = $product->getChangedQuantity($quantity_changed);
            $product->update();
        }

        return back()->with('success', 'Xóa sản phẩm khỏi phiếu nhập thành công.');
    }

    public function validation($request) {
        $validate = Validator::make($request->all(),
            [
                'quantity' => 'required|numeric|min:1|max:500',
                'price' => array('required', 'regex:/^(\d|,)*$/')
            ],
            [
                'required' => ':attribute không được bỏ trống!',
                'min' => ':attribute không được nhỏ hơn :min!',
                'max' => ':attribute không được lớn hơn :max!',
                'regex' => ':attribute nhập không đúng định dạng!'
            ],
            [
                'product-name' => 'Tên sản phẩm',
                'quantity' => 'Số lượng',
                'price' => 'Đơn giá'
            ]
        );

        return $validate;
    }
}
