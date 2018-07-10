<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\GoodsReceiptNoteCost;
use App\OrderStatus;
use App\Product;
use App\Quantity;
use App\Trademark;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    public function index() {
        $order_cost = DB::table('order_prices')
            ->join('order_statuses', 'order_prices.order_id', 'order_statuses.order_id')
            ->where('status', 2)->sum('price');
        $general = [
            'product' => Product::count(),
            'product_out' => Quantity::where('quantity', 0)->count(),
            'order_unapprove' => OrderStatus::where('status', 0)->count(),
            'cost' => $order_cost - GoodsReceiptNoteCost::sum('cost')
        ];
        $orders = [
            [
                'Chưa duyệt', OrderStatus::where('status', 0)->count()
            ],
            [
                'Đã duyệt', OrderStatus::where('status', 1)->count()
            ],
            [
                'Đã giao hàng', OrderStatus::where('status', 2)->count()
            ]
        ];
        $trademarks = [];
        foreach (Trademark::all() as $trademark) {
            $quantity = DB::table('trademarks')
                ->join('product_type_trademarks', 'trademarks.id', 'trademark_id')
                ->join('products', 'product_type_trademarks.id', 'product_type_trademark_id')
                ->where('trademarks.id', $trademark->id)
                ->count();
            array_push($trademarks, [$trademark->name, $quantity]);
        }

        return view('admin.index', compact(['general', 'orders', 'trademarks']));
    }

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
        $newPassword = $request->get('password');
        $admin = Admin::findOrFail($id);
        if (!password_verify($oldPassword, Auth::user()->getAuthPassword())) {
            return back()->with('error', 'Mật khẩu cũ không chính xác.');
        }
        if ($oldPassword == $newPassword) {
            return back()->with('error', 'Bạn đã nhập lại mật khẩu cũ!');
        }
        $admin->password = bcrypt($newPassword);
        $admin->update();

        return back()->with('success', 'Đổi mật khẩu thành công.');
    }
}
