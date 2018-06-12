<?php

namespace App\Http\Controllers\Admin;

use App\GiaTien;
use App\SanPham;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SanPhamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $san_phams = SanPham::paginate(10);

        return view('admin.san-pham.index.index', compact('san_phams'));
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
        $san_pham = new SanPham();
        $san_pham->ten_san_pham = $request->get('ten-san-pham');
        $san_pham->loai_san_pham_id = $request->get('ten-loai');
        $san_pham->thuong_hieu_id = $request->get('ten-thuong-hieu');
        $san_pham->save();

        $gia = str_replace(' ', '', $request->get('gia'));
        $gia_tien = new GiaTien();
        $gia_tien->gia = $gia;
        $gia_tien->san_pham_id = $san_pham->id;
        $gia_tien->save();

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
