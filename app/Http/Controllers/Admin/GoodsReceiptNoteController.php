<?php

namespace App\Http\Controllers\Admin;

use App\GoodsReceiptNote;
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

        return view('admin.goods-receipt-note.parent-index.index',
            compact(['goods_receipt_notes', 'suppliers']));
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
        $goods_receipt_note->name = $request->get('name');
        $goods_receipt_note->date = $request->get('date');
        $goods_receipt_note->admin_id = Auth::user()->id;
        $goods_receipt_note->save();

        if ($request->has('supplier'))
        {
            foreach($request->get('supplier') as $supplier)
            {
                $goods_receipt_note_child = new GoodsReceiptNote();
                $goods_receipt_note_child->goods_receipt_note_id = $goods_receipt_note->id;
                $goods_receipt_note_child->date = $goods_receipt_note->date;
                $goods_receipt_note_child->name = $goods_receipt_note->name;
                $goods_receipt_note_child->supplier_id = $supplier;
                $goods_receipt_note_child->admin_id = $goods_receipt_note->admin_id;
                $goods_receipt_note_child->save();
            }
        }

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
