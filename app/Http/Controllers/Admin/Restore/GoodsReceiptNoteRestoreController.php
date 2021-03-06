<?php

namespace App\Http\Controllers\Admin\Restore;

use App\GoodsReceiptNote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodsReceiptNoteRestoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $goods_receipt_notes = GoodsReceiptNote::where('is_deleted', true)->paginate(10);

        return view('admin.restore.goods-receipt-note.index', compact('goods_receipt_notes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->has('goods-receipt-note-ids')) {
            return back();
        }
        $ids = $request->get('goods-receipt-note-ids');
        foreach($ids as $id) {
            $goods_receipt_note = GoodsReceiptNote::findOrFail($id);
            $goods_receipt_note->is_deleted = false;
            $goods_receipt_note->update();
        }

        return back()->with('success', 'Phục hồi thành công.');
    }
}
