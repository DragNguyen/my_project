<?php

namespace App\Http\Controllers\Auth;

use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => ['logout']]);
    }

    public function showLoginForm() {
        return view('auth.admin-login');
    }

    public function login (Request $request) {
        $validate = Validator::make($request->all(),
            [
                'email'   => 'required|email',
                'password' => 'required|min:6|max:32'
            ],
            [
                'required' => ':attribute không được bỏ trống!',
                'email' => ':attribute không hợp lệ!',
                'min' => ':attribute không được nhỏ hơn :min ký tự!',
                'max' => ':attribute không được lớn hơn :max ký tự!'
            ],
            [
                'password' => 'Mật khẩu',
                'email' => 'Email'
            ]
        );

        if ($validate->fails()) {
            return back()->withInput($request->only('username'))->withErrors($validate);
        }

        if (Auth::guard('admin')->attempt(['email' => $request->email,
            'password' => $request->password])) {
            return redirect()->intended(route('admin.index'));
        }
//        return redirect()->back()->withInput($request->only('email'));
        return back()->withInput($request->only('email'))->with('error', 'Tài khoản hoặc mật khẩu không chính xác!');
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}
