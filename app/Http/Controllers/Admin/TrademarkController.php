<?php

namespace App\Http\Controllers\Admin;

use App\ProductType;
use App\ProductTypeTrademark;
use App\Trademark;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TrademarkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trademarks = Trademark::where('is_deleted', false)->paginate(10);
        $product_types = ProductType::all();

        return view('admin.trademark.index', compact(['trademarks', 'product_types']));
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
        $validate = $this->validationStore($request);
        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput($request->only('trademark-name'));
        }
        $trademark_name = $request->get('trademark-name');
        if (Trademark::where('name', $trademark_name)->count() > 0) {
            return back()->with('error', 'Tên thương hiệu đã tồn tại!');
        }

        $trademark = new Trademark();
        $trademark->name = $trademark_name;
        $trademark->save();

        foreach($request->get('product-type-id') as $product_type_id) {
            $product_type_trademark = new ProductTypeTrademark();
            $product_type_trademark->product_type_id = $product_type_id;
            $product_type_trademark->trademark_id = $trademark->id;
            $product_type_trademark->save();
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
        $validate = $this->validationUpdate($request, $id);
        if ($validate->fails()) {
            return back()->withErrors($validate);
        }
        $trademark = Trademark::findOrFail($id);
        $trademark_name = $request->get("trademark-name-$id");
        if ((Trademark::where('name', $trademark_name)->count() > 0) && ($trademark->name != $trademark_name)) {
            return back()->with('error', 'Tên thương hiệu đã tồn tại!');
        }
        if (!$trademark->canDelete()) {
            return back()->with('error', 'Còn sản phẩm thuộc thương hiệu này!');
        }
        $trademark->name = $trademark_name;
        $trademark->update();

        $trademark->productTypeTrademarks()->delete();
        foreach($request->get("product-type-id-$id") as $product_type_id) {
            $product_type_trademark = new ProductTypeTrademark();
            $product_type_trademark->product_type_id = $product_type_id;
            $product_type_trademark->trademark_id = $id;
            $product_type_trademark->save();
        }
        return back()->with('success', 'Sửa thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if (!$request->has('trademark-ids')) {
            return back();
        }

        $ids = $request->get('trademark-ids');
        foreach($ids as $id) {
            $trademark = Trademark::findOrFail($id);
            if ($trademark->canDelete()) {
                $trademark->delete();
            }
            else {
                $trademark->is_deleted = true;
                $trademark->update();
            }
        }

        return back()->with('success', 'Xóa thành công.');
    }

    public function validationStore($request) {
        $validate = Validator::make(
            $request->all(),
            [
                'trademark-name' => array('required', 'max:100', 'regex:/^[A-ỹ][a-zA-ZÀ-ỹ ]*$/')
            ],
            [
                'required' => ':attribute không được bỏ trống!',
                'max' => ':attribute không được vượt quá :max ký tự!',
                'regex' => ':attribute không hợp lệ!'
            ],
            [
                'trademark-name' => 'Tên thương hiệu'
            ]
        );

        return $validate;
    }

    public function validationUpdate($request, $id) {
        $validate = Validator::make(
            $request->all(),
            [
                "trademark-name-$id" => array('required', 'max:100', 'regex:/^[A-ỹ][a-zA-ZÀ-ỹ ]*$/')
            ],
            [
                'required' => ':attribute không được bỏ trống!',
                'max' => ':attribute không được vượt quá :max ký tự!',
                'regex' => ':attribute không hợp lệ!'
            ],
            [
                "trademark-name-$id" => 'Tên thương hiệu'
            ]
        );

        return $validate;
    }
}
