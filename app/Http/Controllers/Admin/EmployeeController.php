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
        $employee_email = $request->get('employee-email');
        $employee_phone = $request->get('employee-phone');
        if (Admin::where('phone', $employee_phone)->count() > 0) {
            return back()->with('error', 'Số điện thoại đã tồn tại!')->withInput($request->all());
        }
        if (Admin::where('email', $employee_email)->count() > 0) {
            return back()->with('error', 'Email đã tồn tại!')->withInput($request->all());
        }

        $password = substr($request->get('employee-email'),
            0,strpos($request->get('employee-email'),'@'));
        $employee = new Admin();
        $employee->name = $request->get('employee-name');
        $employee->email = $employee_email;
        $employee->phone = $employee_phone;
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
        $employee_name = ucwords($request->get("employee-name-$id"));
        $employee_phone = $request->get("employee-phone-$id");
        $employee_email = $request->get("employee-email-$id");
        $employee_gender = $request->get("employee-gender");
        if (($employee->name == $employee_name) && ($employee->phone == $employee_phone)
            && ($employee->email == $employee_email) && ($employee->gender == $employee_gender)) {
            return back();
        }
        if (Admin::where('phone', $employee_phone)->count() > 0) {
            return back()->with('error', 'Số điện thoại đã tồn tại!')->withInput($request->all());
        }
        if (Admin::where('email', $employee_email)->count() > 0) {
            return back()->with('error', 'Email đã tồn tại!')->withInput($request->all());
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
                'regex' => ':attribute không hợp lệ!'
            ],
            [
                "employee-password-$id" => 'Mật khẩu mới',
                "employee-password-confirm-$id" => 'Mật khẩu nhập lại'
            ]
        );
        if ($validate->fails()) {
            return back()->withErrors($validate);
        }

        $password = $request->get("employee-password-$id");
        $password_confirm = $request->get("employee-password-confirm-$id");
        if($password != $password_confirm) {
            return back()->withErrors(["employee-password-confirm-$id" => 'Mật khẩu nhập lại không khớp!']);
        }
        $employee = Admin::findOrFail($id);
        if (password_verify($password, $employee->password)) {
            return back()->with('error', 'Bạn đã nhập lại mật khẩu cũ!');
        }
        $employee->password = bcrypt($password);
        $employee->update();

        return back()->with('success', 'Thay đổi thành công.');
    }

    public function validationStore(Request $request) {
        $validate = Validator::make(
            $request->all(),
            [
                'employee-name' => array('required', 'max:100',
                    "regex:/^[a-zA-ZÀ-ỹ]+ [a-zA-ZÀ-ỹ ]+$/"),
                'employee-phone' => array('required', 'regex:/^[\d( )\.]*$/', 'max:20'),
                'employee-email' => 'required|email|max:100'
            ],
            [
                'required' => ':attribute không được bỏ trống!',
                'max' => ':attribute không được vượt quá :max ký tự!',
                'regex' => ':attribute không hợp lệ!',
                'email' => ':attribute không hợp lệ!'
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
                "employee-name-$id" => array('required', 'max:100', "regex:/^[a-zA-ZÀ-ỹ]+ [a-zA-ZÀ-ỹ ]+$/"),
                "employee-phone-$id" => array('required', 'regex:/^[\d( )\.]*$/', 'max:20'),
                "employee-email-$id" => 'required|email|max:100'
            ],
            [
                'required' => ':attribute không được bỏ trống!',
                'max' => ':attribute không được vượt quá :max ký tự!',
                'regex' => ':attribute không hợp lệ!',
                'email' => ':attribute không hợp lệ!'
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
