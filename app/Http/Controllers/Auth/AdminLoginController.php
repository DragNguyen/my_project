<?php

namespace App\Http\Controllers\Auth;

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
        if (Auth::guard('admin')->attempt(['email' => $request->username,
            'password' => $request->password])) {
            return redirect()->intended(route('admin.tong-quan'));
        }
//        return redirect()->back()->withInput($request->only('email'));
        return view('admin.error');
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}
