<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use Illuminate\Support\Facades\Auth;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function updateAvatar(Request $request, $id) {
        if (!$request->hasFile('avatar-upload')) {

        }
        else {
            $admin = Admin::findOrFail($id);
            $oldPath = $admin->avatar;
            dd($oldPath);
            if (!empty($oldPath)) {
                File::delete($oldPath);
            }
            $ext = $request->file('avatar-upload')->extension();
            $path = $request->file('avatar-upload')->move('assets\img\avatar', "avatar-$id.$ext");
            $admin->avatar = str_replace('\\', '/', $path->getPathname());
            $admin->update();

            return back()->with('success', 'Cập nhật ảnh đại diện thành công.');
        }
    }

    public function updatePassword(Request $request, $id) {
        $validate = Validator::make($request->all(),
            [
                'old-password' => 'required',
                "password" => array('required', 'min:6', 'confirmed', 'max:32', 'regex:/^[\w\!@#\$&]*$/'),
                'password_confirmation' => 'required'
            ],
            [
                'required' => ':attribute không được bỏ trống!',
                'min' => ':attribute không được nhỏ hơn :min ký tự!',
                'max' => ':attribute không được vượt quá :max ký tự!',
                'confirmed' => ':attribute nhập lại không chính xác!',
                'regex' => ':attribute không hợp lệ!'
            ],
            [
                'old-password' => 'Mật khẩu cũ',
                'password' => 'Mật khẩu mới',
                'password_confirmation' => 'Mật khẩu nhập lại'
            ]);

        if ($validate->fails()) {
            return back()->withErrors($validate);
        }
        $oldPassword = $request->get('old-password');
        $admin = Admin::findOrFail($id);
        if (!password_verify($oldPassword, Auth::user()->getAuthPassword())) {
            return back()->with('error', 'Mật khẩu cũ không chính xác.');
        }
        $admin->password = bcrypt($request->get('password'));
        $admin->update();

        return back()->with('success', 'Đổi mật khẩu thành công.');
    }
}
