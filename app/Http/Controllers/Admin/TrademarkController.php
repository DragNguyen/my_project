<?php

namespace App\Http\Controllers\Admin;

use App\Trademark;
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

        return view('admin.trademark.index', compact('trademarks'));
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

        $trademark = new Trademark();
        $trademark->name = $request->get('trademark-name');

        $trademark->save();

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
            return back()->withErrors($validate)
                ->withInput($request->only("trademark-name-$id"));
        }

        $trademark = Trademark::findOrFail($id);
        $trademark->name = $request->get("trademark-name-$id");

        $trademark->update();

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
                'trademark-name' => array('required', 'max:100', 'regex:/^[[:alpha:]][a-zA-ZÀ-ỹ ]*$/')
            ],
            [
                'required' => ':attribute không được bỏ trống!',
                'max' => ':attribute không được vượt quá :max ký tự!',
                'regex' => ':attribute không đúng định dạng!'
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
                "trademark-name-$id" => array('required', 'max:100', 'regex:/^[[:alpha:]][a-zA-ZÀ-ỹ ]*$/')
            ],
            [
                'required' => ':attribute không được bỏ trống!',
                'max' => ':attribute không được vượt quá :max ký tự!',
                'regex' => ':attribute không đúng định dạng!'
            ],
            [
                "trademark-name-$id" => 'Tên thương hiệu'
            ]
        );

        return $validate;
    }
}
