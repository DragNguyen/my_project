<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\ProductType;
use App\Specification;
use App\SpecificationProductType;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $product_types = ProductType::where('is_deleted', false)->paginate(10);
        $specifications = Specification::all();

        return view('admin.product-type.index', compact(['product_types', 'specifications']));
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
            return back()->withErrors($validate)->withInput($request->only('product-type-name'));
        }

        $product_type = new ProductType();
        $product_type->name = $request->get('product-type-name');

        $product_type->save();

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
        if (!$request->has("specification")) {
            return back()->withErrors(["specification" => 'Thông số kỹ thuật không được bỏ trống!']);
        }

        $product_type = ProductType::findOrFail($id);
        $product_type->name = $request->get("product-type-name-$id");
        $product_type->update();

        $product_type->specificationProductTypes()->delete();

        foreach($request->get("specification") as $spec_id) {
            $specification_product_type = new SpecificationProductType();
            $specification_product_type->specification_id = $spec_id;
            $specification_product_type->product_type_id = $id;
            $specification_product_type->save();
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
        if (!$request->has('product-type-ids')) {
            return back();
        }

        $ids = $request->get('product-type-ids');
        foreach($ids as $id) {
            $product_type = ProductType::findOrFail($id);
            if ($product_type->canDelete()) {
                $product_type->delete();
            }
            else {
                $product_type->is_deleted = true;
                $product_type->update();
            }
        }

        return back()->with('success', 'Xóa thành công.');
    }

    public function validationStore($request) {
        $validate = Validator::make(
            $request->all(),
            [
                'product-type-name' => array('required', 'max:100', 'regex:/^[A-ỹ][a-zA-ZÀ-ỹ ]*$/')
            ],
            [
                'required' => ':attribute không được bỏ trống!',
                'max' => ':attribute không được vượt quá :max ký tự!',
                'regex' => ':attribute không đúng định dạng!'
            ],
            [
                'product-type-name' => 'Tên loại sản phẩm'
            ]
        );

        return $validate;
    }

    public function validationUpdate($request, $id) {
        $validate = Validator::make(
            $request->all(),
            [
                "product-type-name-$id" => array('required', 'max:100', 'regex:/^[A-ỹ][a-zA-ZÀ-ỹ ]*$/')
            ],
            [
                'required' => ':attribute không được bỏ trống!',
                'max' => ':attribute không được vượt quá :max ký tự!',
                'regex' => ':attribute không đúng định dạng!'
            ],
            [
                "product-type-name-$id" => 'Tên loại sản phẩm'
            ]
        );

        return $validate;
    }
}
