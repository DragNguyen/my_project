<?php

namespace App\Http\Controllers\Admin;

use App\GoodsReceiptNoteCost;
use App\GoodsReceiptNoteProduct;
use App\Product;
use App\Quantity;
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
        $validate = $this->validationStore($request);
        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput($request->all());
        }

        $cost = str_replace(',', '', $request->get('cost'));
        $quantity = $request->get('quantity');
        if ($cost > 100000000) {
            return back()->withErrors(['cost' => 'Đơn giá không được vượt quá 100,000,000đ !'])
                ->withInput($request->all());
        }
        if ($cost < 1000) {
            return back()->withErrors(['cost' => 'Đơn giá không được nhỏ hơn 1,000đ !'])
                ->withInput($request->all());
        }

        $goods_receipt_note_product = new GoodsReceiptNoteProduct();
        $goods_receipt_note_product->goods_receipt_note_id = $request->get('id');
        $goods_receipt_note_product->product_id = $request->get('product-name');
        $goods_receipt_note_product->quantity = $quantity;
        $goods_receipt_note_product->cost = $cost;
        $goods_receipt_note_product->total_of_cost = $cost * $quantity;
        $goods_receipt_note_product->quantity_updated = $quantity;

        if ($goods_receipt_note_product->save()) {
            $product = Product::findOrFail($goods_receipt_note_product->product_id);
            $product_quantity = Quantity::where('product_id', $product->id)->first();
            $product_quantity->quantity = $product->getQuantity() + $quantity;
            $product_quantity->update();

            $goods_receipt_note_cost = GoodsReceiptNoteCost::where('goods_receipt_note_id',
                $goods_receipt_note_product->goods_receipt_note_id)->first();
            $goods_receipt_note_cost->cost += $goods_receipt_note_product->total_of_cost;
            $goods_receipt_note_cost->update();
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
        $validate = $this->validationUpdate($request, $id);
        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput($request->all());
        }

        $quantity = $request->get("quantity-$id");
        $cost = str_replace(',', '', $request->get("cost-$id"));
        if ($cost > 100000000) {
            return back()->withErrors(["cost-$id" => 'Đơn giá không được vượt quá 100,000,000đ !'])
                ->withInput($request->all());
        }
        if ($cost < 1000) {
            return back()->withErrors(["cost-$id" => 'Đơn giá không được nhỏ hơn 1,000đ !'])
                ->withInput($request->all());
        }

        $goods_receipt_note_product = GoodsReceiptNoteProduct::findOrFail($id);
        if (($goods_receipt_note_product->cost == $cost) && ($goods_receipt_note_product->quantity == $quantity)) {
            return back();
        }

        $quantity_changed = $quantity - $goods_receipt_note_product->quantity_updated;
        $old_total_of_cost = $goods_receipt_note_product->total_of_cost;

        $goods_receipt_note_product->product_id = $request->get('product-name');
        $goods_receipt_note_product->quantity = $quantity;
        $goods_receipt_note_product->cost = $cost;
        $goods_receipt_note_product->total_of_cost = $cost * $quantity;
        $goods_receipt_note_product->quantity_updated = $quantity;

        if ($goods_receipt_note_product->update()) {
            $product = Product::findOrFail($goods_receipt_note_product->product_id);
            $product_quantity = Quantity::where('product_id', $product->id)->first();
            $product_quantity->quantity = $product->getChangedQuantity($quantity_changed);
            $product_quantity->update();

            $goods_receipt_note_cost = GoodsReceiptNoteCost::where('goods_receipt_note_id',
                $goods_receipt_note_product->goods_receipt_note_id)->first();
            $goods_receipt_note_cost->cost += ($goods_receipt_note_product->total_of_cost - $old_total_of_cost);
            $goods_receipt_note_cost->update();
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
        $ids = $request->get('goods-receipt-note-product-ids');

        foreach ($ids as $id) {
            $goods_receipt_note_product = GoodsReceiptNoteProduct::findOrFail($id);
            $product = $goods_receipt_note_product->product;
            $quantity_changed = - $goods_receipt_note_product->quantity_updated;

            $product_quantity = Quantity::findOrFail($product->id);
            $product_quantity->quantity = $product->getChangedQuantity($quantity_changed);
            $product_quantity->update();

            $goods_receipt_note_cost = GoodsReceiptNoteCost::where('goods_receipt_note_id',
                $goods_receipt_note_product->goods_receipt_note_id)->first();
            $goods_receipt_note_cost->cost -= $goods_receipt_note_product->total_of_cost;
            $goods_receipt_note_cost->update();

            $goods_receipt_note_product->delete();
        }

        return back()->with('success', 'Xóa thành công.');
    }

    public function validationStore($request) {
        $validate = Validator::make($request->all(),
            [
                'quantity' => 'required|integer|min:1|max:500',
                'cost' => array('required', 'regex:/^(([1-9]\d*)|([1-9]\d{0,2}(,\d{3})*))$/')
            ],
            [
                'required' => ':attribute không được bỏ trống!',
                'min' => ':attribute không được nhỏ hơn :min!',
                'max' => ':attribute không được lớn hơn :max!',
                'regex' => ':attribute sai định dạng!',
                'integer' => ':attribute phải là số nguyên!'
            ],
            [
                'product-name' => 'Tên sản phẩm',
                'quantity' => 'Số lượng',
                'cost' => 'Đơn giá'
            ]
        );

        return $validate;
    }

    public function validationUpdate($request, $id) {
        $validate = Validator::make($request->all(),
            [
                "quantity-$id" => 'required|integer|min:1|max:500',
                "cost-$id" => array('required', 'regex:/^(([1-9]\d*)|([1-9]\d{1,2}(,\d{3})*))$/')
            ],
            [
                'required' => ':attribute không được bỏ trống!',
                'min' => ':attribute không được nhỏ hơn :min!',
                'max' => ':attribute không được lớn hơn :max!',
                'regex' => ':attribute sai định dạng!',
                'integer' => ":attribute phải là số nguyên!"
            ],
            [
                'product-name' => 'Tên sản phẩm',
                "quantity-$id" => 'Số lượng',
                "cost-$id" => 'Đơn giá'
            ]
        );

        return $validate;
    }
}
