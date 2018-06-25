<?php

namespace App\Http\Controllers\Admin;

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
        $validate = Validator::make(
            $request->all(),
            [
                'values' => array('required', 'regex:/^\d[,\d]*$/')
            ],
            [
                'required' => ':attribute không được bỏ trống!',
                'regex' => ':attribute không đúng định dạng!'
            ],
            [
                'values' => 'Giá trị khuyến mãi'
            ]
        );
        if ($validate->fails()) {
            return back()->withErrors($validate);
        }

        if (!$request->has('values')) {
            return back();
        }
        $values = explode(',', $request->get('values'));
        $sales_off = SalesOff::find($request->get('sales-off-id'));
        foreach($values as $value) {
            if (($sales_off->matchedValue($value)) || ($value <= 0) || ($value >= 100)) {
                continue;
            }
            $sales_off_child = new SalesOff();
            $sales_off_child->sales_off_id = $sales_off->id;
            $sales_off_child->value = $value;
            $sales_off_child->save();
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
        $validate = Validator::make(
            $request->all(),
            [
                'value' => 'required|numeric|min:1|max:99'
            ],
            [
                'required' => ':attribute không được bỏ trống!',
                'min' => ':attribute không được nhỏ hơn :min%!',
                'max' => ':attribute không được vượt quá :max%!'
            ],
            [
                'value' => 'Giá trị khuyến mãi'
            ]
        );
        if ($validate->fails()) {
            return back()->withErrors($validate);
        }
        $value = $request->get('value');
        $sales_off_child = SalesOff::find($id);
        if ($sales_off_child->salesOff->matchedValue($value)) {
            return back()->with('error', 'Giá trị khuyến mãi đã tồn tại!');
        }
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
