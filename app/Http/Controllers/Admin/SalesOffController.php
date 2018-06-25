<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\SalesOff;
use App\SalesOffProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalesOffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales_offs = SalesOff::where('is_deleted', false)
            ->where('sales_off_id', null)->paginate(10);

        return view('admin.sales-off.parent.index', compact(['sales_offs']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sales_off_name = $request->get('sales-off-name');
        $begin_at = $request->get('begin-at');
        $end_at = $request->get('end-at');
        if (SalesOff::where('name', $sales_off_name)
                ->where('begin_at', $begin_at)
                ->where('end_at', $end_at)->count() > 0)
        {
            return back()->with('error', 'Khuyến mãi đã tồn tại!');
        }

        $sales_off = new SalesOff();
        $sales_off->name = $sales_off_name;
        $sales_off->begin_at = $begin_at;
        $sales_off->end_at = $end_at;
        $sales_off->save();

        if ($request->has('values')) {
            $values = $request->get('values');
            foreach($values as $value) {
                $sales_off_child = new SalesOff();
                $sales_off_child->sales_off_id = $sales_off->id;
                $sales_off_child->value = $value;
                $sales_off_child->save();
            }
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
        $sales_off = SalesOff::find($id);
        $sales_off_childs = $sales_off->salesOffs()->paginate(10);

        return view('admin.sales-off.child.index', compact(['sales_off','sales_off_childs']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sales_off_child = SalesOff::find($id);
        $sales_off_products = $sales_off_child->salesOffProducts()->paginate(10);
        $products = Product::all();

        return view('admin.sales-off.product.index',
            compact(['sales_off_child', 'sales_off_products', 'products']));
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
        $sales_off = SalesOff::findOrFail($id);
        $sales_off->name = $request->get('sales-off-name');
        $sales_off->begin_at = $request->get('begin-at');
        $sales_off->end_at = $request->get('end-at');
        $sales_off->update();

        return back()->with('success', 'Cập nhật thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->has('sales-off-ids')) {
            $ids = $request->get('sales-off-ids');
            foreach($ids as $id) {
                $sales_off = SalesOff::findOrFail($id);
                if ($sales_off->canDelete()) {
                    $sales_off->delete();
                }
                else {
                    $sales_off->is_deleted = true;
                    $sales_off->update();
                }
            }

            return back()->with('success', 'Xóa thành công.');
        }
        if ($request->has('sales-off-child-ids')) {
            $ids = $request->get('sales-off-child-ids');
            SalesOff::destroy($ids);

            return back()->with('success', 'Xóa thành công.');
        }
        return back();
    }

    public function validation($request) {

    }
}
