<?php

namespace App\Http\Controllers\Admin;

use App\GoodsReceiptNote;
use App\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoodsReceiptNoteChildController extends Controller
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
        if (!$request->has('supplier')) {
            return back();
        }
        $parent = GoodsReceiptNote::find($request->get('parent-id'));
        foreach($request->get('supplier') as $supplier) {
            $child = new GoodsReceiptNote();
            $child->goods_receipt_note_id = $parent->id;
            $child->name = $parent->name;
            $child->date = $parent->date;
            $supplier_name = Supplier::find($supplier)->name;
            $child->supplier_name = $supplier_name;
            $child->supplier_id = $supplier;

            $child->save();
        }

        return back()->with('success', 'Thêm các nhà cung cấp cho phiếu nhập thành công.');
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
