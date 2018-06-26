<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\SalesOff;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SalesOffChildController extends Controller
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
        $validate = $this->validationStore($request);
        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput($request->all());
        }
        $values = explode(',', $request->get('sales-off-values'));
        $sales_off = SalesOff::find($request->get('sales-off-id'));
        $errors = array();
        $success = false;
        foreach($values as $value) {
            if (($sales_off->matchedValue($value)) || ($value <= 0) || ($value >= 100)) {
                array_push($errors,"Giá trị $value% không thể thêm!");
                continue;
            }
            $success = true;
            $sales_off_child = new SalesOff();
            $sales_off_child->sales_off_id = $sales_off->id;
            $sales_off_child->value = $value;
            $sales_off_child->save();
        }

        if(count($errors) == 0) {
            return back()->with('success', 'Thêm thành công.');
        }
        elseif($success) {
            return back()->with('success', 'Thêm thành công.')->withErrors($errors);
        }
        else {
            return back()->withErrors($errors);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sales_off_child = SalesOff::find($id);
        $sales_off_products = $sales_off_child->salesOffProducts()->paginate(10);
        $products = Product::all();

        return view('admin.sales-off.product.index',
            compact(['sales_off_child', 'sales_off_products', 'products']));
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
        $value = $request->get("sales-off-value-$id");

        $sales_off_child = SalesOff::find($id);
        if($sales_off_child->value == $value) {
            return back();
        }
        if (($value != $sales_off_child->value) && $sales_off_child->salesOff->matchedValue($value)) {
            return back()->with('error', 'Giá trị khuyến mãi đã tồn tại!');
        }
        $sales_off_child->value = $value;
        $sales_off_child->update();

        return back()->with('success', 'Sửa thành công.');
    }

    public function validationStore($request) {
        $validate = Validator::make(
            $request->all(),
            [
                'sales-off-values' => array('required', 'regex:/^\d[,\d]*$/')
            ],
            [
                'required' => ':attribute không được bỏ trống!',
                'regex' => ':attribute không đúng định dạng!'
            ],
            [
                'sales-off-values' => 'Giá trị khuyến mãi'
            ]
        );

        return $validate;
    }

    public function validationUpdate($request, $id) {
        $validate = Validator::make(
            $request->all(),
            [
                "sales-off-value-$id" => 'required|integer|min:1|max:99'
            ],
            [
                'required' => ':attribute không được bỏ trống!',
                'integer' => ':attribute phải là số nguyên!',
                'min' => ':attribute không được nhỏ hơn :max%!',
                'max' => ':attribute không được lớn hơn :min%!'
            ],
            [
                "sales-off-value-$id" => 'Giá trị khuyến mãi'
            ]
        );

        return $validate;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if (!$request->has('sales-off-child-ids')) {
            return back();
        }
        $ids = $request->get('sales-off-child-ids');
        SalesOff::destroy($ids);

        return back()->with('success', 'Xóa thành công.');
    }
}
