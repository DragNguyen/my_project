<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Admin::where('is_deleted', false)->paginate(10);

        return view('admin.employee.index', compact('employees'));
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

        $password = substr($request->get('employee-email'),
            0,strpos($request->get('employee-email'),'@'));
        $employee = new Admin();
        $employee->name = $request->get('employee-name');
        $employee->email = $request->get('employee-email');
        $employee->phone = $request->get('employee-phone');
        $employee->gender = $request->get('employee-gender');
        $employee->password = bcrypt($password.'123');
        $employee->save();

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
    public function edit(Request $request, $id)
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

        $employee = Admin::findOrFail($id);
        $employee_name = $request->get("employee-name-$id");
        $employee_phone = $request->get("employee-phone-$id");
        $employee_email = $request->get("employee-email-$id");
        $employee_gender = $request->get("employee-gender");
        if (($employee->name == $employee_name) && ($employee->phone == $employee_phone)
            && ($employee->email == $employee_email) && ($employee->gender == $employee_gender)) {
            return back();
        }

        $employee->name = $employee_name;
        $employee->phone = $employee_phone;
        $employee->email = $employee_email;
        $employee->gender = $employee_gender;
        $employee->update();

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
        if (!$request->has('employee-ids')) {
            return back();
        }

        $ids = $request->get('employee-ids');
        foreach($ids as $id) {
            $employee = Admin::findOrFail($id);
            if ($employee->canDelete()) {
                $employee->delete();
            }
            else {
                $employee->is_deleted = true;
                $employee->update();
            }
        }

        return back()->with('success', 'Xóa thành công.');
    }

    public function resetPassword(Request $request, $id) {
        $validate = Validator::make(
            $request->all(),
            [
                "employee-password-$id" => array('required', 'min:6', 'max:30', 'regex:/^[\w\!@#\$&]*$/'),
                "employee-password-confirm-$id" => 'required'
            ],
            [
                'required' => ':attribute không được bỏ trống!',
                'min' => ':attribute không được nhỏ hơn :min ký tự!',
                'max' => ':attribute không được vượt quá :max ký tự!',
                'regex' => ':attribute không đúng định dạng!'
            ],
            [
                "employee-password-$id" => 'Mật khẩu mới',
                "employee-password-confirm-$id" => 'Mật khẩu nhập lại'
            ]
        );
        if ($validate->fails()) {
            return back()->withErrors($validate);
        }
        return back();
    }

    public function validationStore(Request $request) {
        $validate = Validator::make(
            $request->all(),
            [
                'employee-name' => array('required', 'max:100', "regex:/^([A-Z][a-zA-ZÀ-ỹ]+)( [A-Z][a-zA-ZÀ-ỹ]+)+$/"),
                'employee-phone' => array('required', 'regex:/^[\d( )\.]*$/', 'max:20'),
                'employee-email' => 'required|email|max:100'
            ],
            [
                'required' => ':attribute không được bỏ trống!',
                'max' => ':attribute không được vượt quá :max ký tự!',
                'regex' => ':attribute không đúng định dạng!',
                'email' => ':attribute không đúng định dạng!'
            ],
            [
                'employee-name' => 'Tên nhân viên',
                'employee-phone' => 'Số điện thoại',
                'employee-email' => 'Email'
            ]
        );

        return $validate;
    }

    public function validationUpdate(Request $request, $id) {
        $validate = Validator::make(
            $request->all(),
            [
                "employee-name-$id" => array('required', 'max:100', "regex:/^([A-Z][a-zA-ZÀ-ỹ]+)( [A-Z][a-zA-ZÀ-ỹ]+)+$/"),
                "employee-phone-$id" => array('required', 'regex:/^[\d( )\.]*$/', 'max:20'),
                "employee-email-$id" => 'required|email|max:100'
            ],
            [
                'required' => ':attribute không được bỏ trống!',
                'max' => ':attribute không được vượt quá :max ký tự!',
                'regex' => ':attribute không đúng định dạng!',
                'email' => ':attribute không đúng định dạng!'
            ],
            [
                "employee-name-$id" => 'Tên nhân viên',
                "employee-phone-$id" => 'Số điện thoại',
                "employee-email-$id" => 'Email'
            ]
        );

        return $validate;
    }
}
