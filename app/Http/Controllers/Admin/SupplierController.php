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
        $validate = $this->validationStore($request);

        if ($validate->fails())
        {
            return back()->withErrors($validate)->withInput($request->all());
        }

        $supplier = new Supplier();
        $supplier->name = $request->get('supplier-name');
        $supplier->phone = $request->get('supplier-phone');
        $supplier->address = $request->get('supplier-address');
        $supplier->website = $request->get('supplier-website');
        $supplier->save();

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

        if ($validate->fails())
        {
            return back()->withErrors($validate);
        }

        $supplier = Supplier::findOrFail($id);
        $supplier_name = $request->get("supplier-name-$id");
        $supplier_phone = $request->get("supplier-phone-$id");
        $supplier_address = $request->get("supplier-address-$id");
        $supplier_website = $request->get("supplier-website-$id");
        if (($supplier->name==$supplier_name) && ($supplier->phone==$supplier_phone)
            && ($supplier->address==$supplier_address) && ($supplier->website==$supplier_website)) {
            return back();
        }

        $supplier->name = $supplier_name;
        $supplier->phone = $supplier_phone;
        $supplier->address = $supplier_address;
        $supplier->website = $supplier_website;

        $supplier->update();

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

    public function validationStore(Request $request) {
        $validate = Validator::make(
            $request->all(),
            [
                'supplier-name' => array('required', 'max:100', "regex:/^[[:alpha:]][\wÀ-ỹ ]*$/"),
                'supplier-phone' => array('required', 'regex:/^[\d( )\.]*$/', 'max:20'),
                'supplier-address' => array('required', 'max:200', "regex:/^\w[\wÀ-ỹ \.,-]*[\wÀ-ỹ]$/"),
                'supplier-website' => array('required', 'max:50',
                    "regex:/^((http:\/\/)|(https:\/\/))?(www\.)?[a-z0-9]+(\.[a-z0-9]+)*(\.[a-z]+)+(\/[a-z0-9]*)*(\/|(\.php)|(\.html))?$/")
            ],
            [
                'required' => ':attribute không được bỏ trống!',
                'max' => ':attribute không được vượt quá :max ký tự!',
                'regex' => ':attribute không đúng định dạng!'
            ],
            [
                'supplier-name' => 'Tên nhà cung cấp',
                'supplier-phone' => 'Số điện thoại',
                'supplier-address' => 'Địa chỉ',
                'supplier-website' => 'Website'
            ]
        );

        return $validate;
    }

    public function validationUpdate(Request $request, $id) {
        $validate = Validator::make(
            $request->all(),
            [
                "supplier-name-$id" => array('required', 'max:100', "regex:/^[[:alpha:]][\wÀ-ỹ ]*$/"),
                "supplier-phone-$id" => array('required', 'regex:/^[\d( )\.]*$/', 'max:20'),
                "supplier-address-$id" => array('required', 'max:200', "regex:/^\w[\wÀ-ỹ \.,-]*[\wÀ-ỹ]$/"),
                "supplier-website-$id" => array('required', 'max:50',
                    "regex:/^((http:\/\/)|(https:\/\/))?(www\.)?[a-z0-9]+(\.[a-z0-9]+)*(\.[a-z]+)+(\/[a-z0-9]*)*(\/|(\.php)|(\.html))?$/")
            ],
            [
                'required' => ':attribute không được bỏ trống!',
                'max' => ':attribute không được vượt quá :max ký tự!',
                'regex' => ':attribute không đúng định dạng!'
            ],
            [
                "supplier-name-$id" => 'Tên nhà cung cấp',
                "supplier-phone-$id" => 'Số điện thoại',
                "supplier-address-$id" => 'Địa chỉ',
                "supplier-website-$id" => 'Website'
            ]
        );

        return $validate;
    }
}
