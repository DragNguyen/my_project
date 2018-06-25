<?php

namespace App\Http\Controllers\Admin;

use App\GoodsReceiptNote;
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
        $suppliers = Supplier::where('is_deleted', false)->paginate(10);

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
        if (!$request->has('supplier-ids')) {
            return back();
        }
        $ids = $request->get('supplier-ids');

        foreach($ids as $id) {
            $supplier = Supplier::findOrFail($id);
            if ($supplier->canDelete()) {
                $supplier->delete();
            }
            else {
                $supplier->is_deleted = true;
                $supplier->update();
            }
        }

        return back()->with('success', 'Xóa thành công.');
    }

    public function validation(Request $request) {
        $validate = Validator::make(
            $request->all(),
            [
                'supplier-name' => array('required', 'max:100', "regex:/^[[:alpha:]][\wÀ-ỹ ]*$/"),
                'phone' => array('required', 'regex:/^[\d( )\.]*$/', 'max:20'),
                'address' => array('required', 'max:200', "regex:/^\w[\wÀ-ỹ \.,-]*[\wÀ-ỹ]$/"),
                'website' => array('required', 'max:50',
                    "regex:/^((http:\/\/)|(https:\/\/))?(www\.)?[a-z0-9]+(\.[a-z0-9]+)*(\.[a-z]+)+(\/[a-z0-9]*)*(\/|(\.php)|(\.html))?$/")
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
