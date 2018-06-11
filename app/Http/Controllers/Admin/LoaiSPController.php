<?php

namespace App\Http\Controllers\Admin;

use App\LoaiSanPham;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoaiSPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loai_san_phams = LoaiSanPham::paginate(10);

        return view('admin.loai-san-pham.index', compact('loai_san_phams'));
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
        $loai_san_pham = new LoaiSanPham();
        $loai_san_pham->ten_loai = $request->get('ten-loai');

        $loai_san_pham->save();

        return back();
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
        $loai_san_pham = LoaiSanPham::findOrFail($id);
        $loai_san_pham->ten_loai = $request->get('ten-loai');

        $loai_san_pham->update();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $ids = $request->get('loai-san-pham-id');

        LoaiSanPham::destroy($ids);

        return back();
    }
}
