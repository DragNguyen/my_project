<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
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
}
