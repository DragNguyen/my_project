<?php

namespace App\Http\Controllers\Admin;

use App\NhaCungCap;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NhaCungCapController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nha_cung_caps = NhaCungCap::paginate(10);

        return view('admin.nha-cung-cap.index', compact('nha_cung_caps'));
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
        $nha_cung_cap = new NhaCungCap();
        $nha_cung_cap->ten_ncc = $request->get('ten-ncc');
        $nha_cung_cap->so_dien_thoai = $request->get('so-dien-thoai');
        $nha_cung_cap->dia_chi = $request->get('dia-chi');
        $nha_cung_cap->website = $request->get('website');
        $nha_cung_cap->save();

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
        $nha_cung_cap = NhaCungCap::findOrFail($id);
        $nha_cung_cap->ten_ncc = $request->get('ten-ncc');
        $nha_cung_cap->so_dien_thoai = $request->get('so-dien-thoai');
        $nha_cung_cap->dia_chi = $request->get('dia-chi');
        $nha_cung_cap->website = $request->get('website');

        $nha_cung_cap->update();

        return back()->with();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $ids = $request->get('nha-cung-cap-id');

        NhaCungCap::destroy($ids);

        return back();
    }
}
