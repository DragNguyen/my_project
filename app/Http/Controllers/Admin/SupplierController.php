<?php

namespace App\Http\Controllers\Admin;

use App\Supplier;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::paginate(10);

        return view('admin.supplier.index', compact('suppliers'));
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
        $validate = $this->validation($request);

        if ($validate->fails())
        {
            return back()->withErrors($validate)->withInput($request->all());
        }

        $supplier = new Supplier();
        $supplier->name = $request->get('supplier-name');
        $supplier->phone = $request->get('phone');
        $supplier->address = $request->get('address');
        $supplier->website = $request->get('website');
        $supplier->save();

        return back()->with('success', 'Thêm nhà cung cấp thành công.');
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
        $validate = $this->validation($request);

        if ($validate->fails())
        {
            return back()->withErrors($validate)->withInput($request->all());
        }

        $supplier = Supplier::findOrFail($id);
        $supplier->name = $request->get('supplier-name');
        $supplier->phone = $request->get('phone');
        $supplier->address = $request->get('address');
        $supplier->website = $request->get('website');

        $supplier->update();

        return back()->with('success', 'Sửa nhà cung cấp thành công.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $ids = $request->get('supplier-id');

        Supplier::destroy($ids);

        return back();
    }

    public function validation(Request $request) {
        $character = 'áàảãạăắằẳẵặâấầẩẫậúùủũụứừửữựéèẻẽẹếềểễệíìỉĩịýỳỷỹỵóòỏõọốồổỗộớờởỡợ';
        $validate = Validator::make(
            $request->all(),
            [
                'supplier-name' => array('required', 'max:100', "regex:/^[\w$character ]*$/"),
                'phone' => array('required', 'regex:/^[\d( )\.]*$/', 'max:20'),
                'address' => array('required', 'max:200', "regex:/^[\w$character \.,-]*$/"),
                'website' => array('required', 'max:50', "regex:/^\w+(\.[a-z]+)+$/")
            ],
            [
                'required' => ':attribute không được bỏ trống!',
                'max' => ':attribute không được vượt quá :max ký tự!',
                'regex' => ':attribute không đúng định dạng!'
            ],
            [
                'supplier-name' => 'Tên nhà cung cấp',
                'phone' => 'Số điện thoại',
                'address' => 'Địa chỉ'
            ]
        );

        return $validate;
    }
}
