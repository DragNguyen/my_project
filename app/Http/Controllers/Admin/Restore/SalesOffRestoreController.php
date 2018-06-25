<?php

namespace App\Http\Controllers\Admin\Restore;

use App\SalesOff;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalesOffRestoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales_offs = SalesOff::where('is_deleted', true)->paginate(10);

        return view('admin.restore.sales-off.index', compact('sales_offs'));
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
        if (!$request->has('sales-off-restore-ids')) {
            return back();
        }
        $ids = $request->get('sales-off-restore-ids');
        foreach($ids as $id) {
            $sales_off = SalesOff::findOrFail($id);
            $sales_off->is_deleted = false;
            $sales_off->update();
        }

        return back()->with('success', 'Phục hồi thành công.');
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
