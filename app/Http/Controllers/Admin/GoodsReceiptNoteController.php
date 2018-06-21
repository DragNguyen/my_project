<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\GoodsReceiptNote;
use App\GoodsReceiptNoteProduct;
use App\Product;
use App\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GoodsReceiptNoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $goods_receipt_notes = GoodsReceiptNote::paginate(10);
        $suppliers = Supplier::all();
        $admins = Admin::all();

        return view('admin.goods-receipt-note.index.index',
            compact(['goods_receipt_notes', 'suppliers', 'admins']));
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
        $goods_receipt_note = new GoodsReceiptNote();
        $goods_receipt_note->name = Admin::find($request->get('name'))->name;
        $goods_receipt_note->date = $request->get('date');
        $goods_receipt_note->admin_id = Auth::user()->id;
        $goods_receipt_note->supplier_id = $request->get('supplier');
        $goods_receipt_note->supplier_name = Supplier::find($request->get('supplier'))->name;
        $goods_receipt_note->save();

        return back()->with('success', 'Thêm đơn nhập hàng thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $goods_receipt_note = GoodsReceiptNote::find($id);
        $goods_receipt_note_products = GoodsReceiptNoteProduct::where('goods_receipt_note_id', $id)->paginate(10);
        $products = Product::all();

        return view('admin.goods-receipt-note.product.index',
            compact(['goods_receipt_note', 'goods_receipt_note_products', 'products']));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $ids = $request->get('goods-receipt-note-id');

        GoodsReceiptNote::destroy($ids);

        return back()->with('success', 'Xóa thành công.');
    }
}
