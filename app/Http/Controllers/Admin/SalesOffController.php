<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\SalesOff;
use App\SalesOffProduct;
use Validator;
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
        $validate = $this->validationStore($request);
        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput($request->all());
        }

        $sales_off_name = $request->get('sales-off-name');
        $begin_at = $request->get('begin-at');
        $end_at = $request->get('end-at');
        if ($end_at < $begin_at) {
            return back()->with('error', 'Ngày kết thúc không được nhỏ hơn ngày bắt đầu!')
                ->withInput($request->all());
        }
        if (SalesOff::where('name', $sales_off_name)
                ->where('begin_at', $begin_at)
                ->where('end_at', $end_at)->count() > 0)
        {
            return back()->with('error', 'Khuyến mãi đã tồn tại!')->withInput($request->all());
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
            return back()->withErrors($validate)->withInput($request->all());
        }

        $sales_off = SalesOff::findOrFail($id);
        $sales_off_name = $request->get("sales-off-name-$id");
        $begin_at = $request->get("begin-at-$id");
        $end_at = $request->get("end-at-$id");

        if (($sales_off_name == $sales_off->name) && ($begin_at == $sales_off->begin_at)
            && ($end_at == $sales_off->end_at)) {
            return back();
        }
        if ($end_at < $begin_at) {
            return back()->with('error', 'Ngày kết thúc không được nhỏ hơn ngày bắt đầu!')
                ->withInput($request->all());
        }
        if (SalesOff::where('name', $sales_off_name)
                ->where('begin_at', $begin_at)
                ->where('end_at', $end_at)->count() > 0)
        {
            return back()->with('error', 'Khuyến mãi đã tồn tại!')->withInput($request->all());
        }

        $sales_off->name = $sales_off_name;
        $sales_off->begin_at = $begin_at;
        $sales_off->end_at = $end_at;
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
        if (!$request->has('sales-off-ids')) {
            return back();
        }
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

    public function validationStore($request) {
        $validate = Validator::make(
            $request->all(),
            [
                'sales-off-name' => array('required', 'max:100', 'regex:/^\w[\wÀ-ỹ\/,\- ]*[\wÀ-ỹ]$/'),
                'begin-at' => "required|after:yesterday",
                'end-at' => "required"
            ],
            [
                'required' => ':attribute không được bỏ trống!',
                'max' => ':attribute không được vượt quá :max ký tự!',
                'regex' => ':attribute không đúng định dạng!',
                'after' => ':attribute không được trước ngày hiện tại!'
            ],
            [
                'sales-off-name' => 'Tên khuyến mãi',
                'begin-at' => 'Ngày bắt đầu',
                'end-at' => 'Ngày kết thúc'
            ]
        );

        return $validate;
    }

    public function validationUpdate($request, $id) {
        $validate = Validator::make(
            $request->all(),
            [
                "sales-off-name-$id" => array('required', 'max:100', 'regex:/^\w[\wÀ-ỹ\/,\- ]*[\wÀ-ỹ]$/'),
                "begin-at-$id" => "required|after:yesterday",
                "end-at-$id" => "required"
            ],
            [
                'required' => ':attribute không được bỏ trống!',
                'max' => ':attribute không được vượt quá :max ký tự!',
                'regex' => ':attribute không đúng định dạng!',
                'after' => ':attribute không được trước ngày hiện tại!'
            ],
            [
                "sales-off-name-$id" => 'Tên khuyến mãi',
                "begin-at-$id" => 'Ngày bắt đầu',
                "end-at-$id" => 'Ngày kết thúc'
            ]
        );

        return $validate;
    }
}
