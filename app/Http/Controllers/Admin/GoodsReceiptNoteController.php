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
        $goods_receipt_notes = GoodsReceiptNote::where('is_deleted', false)->paginate(10);
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
        if (!$request->has('date')) {
            return back()->with('error', 'Bạn chưa chọn ngày nhập hàng!');
        }
        $date = $request->get('date');
        $toDate = date('Y-m-d');
        if ($date < date_format(date_modify(date_create($toDate), '-30 days'), 'Y-m-d')) {
            return back()->with('error', 'Ngày nhập hàng không được trước 30 ngày so với ngày hiện tại!');
        }
        if ($date > $toDate) {
            return back()->with('error', 'Ngày nhập hàng không được vượt quá ngày hiện tại!');
        }
        $supplier_id = $request->get('supplier');
        $admin = Admin::find($request->get('admin'));
        if (GoodsReceiptNote::where('date', $date)->where('supplier_id', $supplier_id)->count() > 0) {
            $date = date_format(date_create($date), 'd/m/Y');
            return back()->with('error', "Ngày $date đã tồn tại phiếu nhập chứa nhà cung cấp đã chọn!");
        }

        $goods_receipt_note = new GoodsReceiptNote();
        $goods_receipt_note->name = $admin->name;
        $goods_receipt_note->date = $date;
        $goods_receipt_note->admin_id = $admin->id;
        $goods_receipt_note->supplier_id = $supplier_id;
        $goods_receipt_note->supplier_name = Supplier::find($supplier_id)->name;
        $goods_receipt_note->save();

        return back()->with('success', 'Thêm phiếu nhập hàng thành công.');
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
        if (!$request->has('date')) {
            return back()->with('error', 'Bạn chưa chọn ngày nhập hàng!');
        }
        $goods_receipt_note = GoodsReceiptNote::findOrFail($id);
        $date = $request->get('date');
        $supplier_id = $request->get('supplier');
        $old_date = $goods_receipt_note->date;
        $old_supplier = $goods_receipt_note->supplier_id;
        if (($date==$old_date) && ($supplier_id==$old_supplier)) {
            return back();
        }
        if ($date < date_format(date_modify(date_create($old_date), '-30 days'), 'Y-m-d')) {
            return back()->with('error', 'Ngày nhập hàng không được trước 30 ngày so với ngày trước đó!');
        }
        if ($date > date('Y-m-d')) {
            return back()->with('error', 'Ngày nhập hàng không được vượt quá ngày hiện tại!');
        }
        if (GoodsReceiptNote::where('date', $date)->where('supplier_id', $supplier_id)->count() > 0) {
            $date = date_format(date_create($date), 'd/m/Y');
            return back()->with('error', "Ngày $date đã tồn tại phiếu nhập chứa nhà cung cấp đã chọn!");
        }

        $goods_receipt_note->date = $date;
        $goods_receipt_note->supplier_id = $supplier_id;
        $goods_receipt_note->supplier_name = Supplier::find($supplier_id)->name;
        $goods_receipt_note->update();

        return back()->with('success', 'Sửa phiếu nhập hàng thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if (!$request->has('goods-receipt-note-id')) {
            return back();
        }
        $ids = $request->get('goods-receipt-note-id');

        foreach($ids as $id) {
            $goods_receipt_note = GoodsReceiptNote::findOrFail($id);
            if ($goods_receipt_note->canDelete()) {
                $goods_receipt_note->delete();
            }
            else {
                $goods_receipt_note->is_deleted = true;
                $goods_receipt_note->update();
            }
        }

        return back()->with('success', 'Xóa thành công.');
    }
}
