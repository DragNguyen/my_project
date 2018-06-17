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
            $ext = $request->file('avatar-upload')->clientExtension();
            $path = $request->file('avatar-upload')->move('assets\img\avatar', "avatar-$id.$ext");
            $admin = Admin::findOrFail($id);
            $oldPath = $admin->avatar;
            $admin->avatar = $path->getPathname();
            if ($admin->save()) {
                File::delete($oldPath);
            }
            return back()->with('success', 'Cập nhật ảnh đại diện thành công.');
        }
    }
}
