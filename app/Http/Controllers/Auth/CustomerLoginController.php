<?php

namespace App\Http\Controllers\Auth;

use App\Product;
use App\ShoppingCart;
use App\ShoppingCartProduct;
use Gloudemans\Shoppingcart\Facades\Cart;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CustomerLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:customer', ['except' => ['logout']]);
    }

    public function showLoginForm() {
        return view('auth.customer-login');
    }

    public function showRegisterForm() {
        return view('auth.customer-register');
    }

    public function register(Request $request) {
        $validate = Validator::make($request->all(),
            [
                'name' => array('required', 'max:50',
                    "regex:/^[a-zA-ZÀ-ỹ]+ [a-zA-ZÀ-ỹ ]+$/"),
                'phone' => array('required', 'regex:/^[\d( )\.]*$/', 'max:20'),
                'email' => 'required|email|max:100'
            ],
            [
                'required' => ':attribute không được bỏ trống!',
                'max' => ':attribute không được vượt quá :max ký tự!',
                'regex' => ':attribute không hợp lệ!',
                'email' => ':attribute không hợp lệ!'
            ],
            [
                'name' => 'Tên nhân viên',
                'phone' => 'Số điện thoại',
                'email' => 'Email'
            ]
        );
    }

    public function login (Request $request) {
        $validate = Validator::make($request->all(),
            [
                'email'   => 'required|email',
                'password' => 'required|min:6|max:32'
            ],
            [
                'required' => ':attribute không được bỏ trống!',
                'email' => ':attribute không đúng định dạng!',
                'min' => ':attribute không được nhỏ hơn :min ký tự!',
                'max' => ':attribute không được vượt quá :max ký tự!'
            ],
            [
                'password' => 'Mật khẩu',
                'email' => 'Email'
            ]
        );

        if ($validate->fails()) {
            return back()->with('error', 'Đăng nhập thất bại!')
                ->withInput($request->only('email'))->withErrors($validate);
        }

        if (Auth::guard('customer')->attempt(['email' => $request->email,
            'password' => $request->password])) {
            $this->syncCart();
            return back()->with('success', 'Đăng nhập thành công.');
//            return redirect()->intended(route('customer.index'));
        }
//        return redirect()->back()->withInput($request->only('email'));
        return back()->withInput($request->only('email'))->with('error', 'Tài khoản hoặc mật khẩu không chính xác!');
    }

    public function logout() {
        Auth::guard('customer')->logout();
        return redirect('/');
    }

    public function syncCart() {
        Cart::destroy();
        $shopping_cart = ShoppingCart::where('customer_id', Auth::guard('customer')->user()->id)->first();
        $cart_products = ShoppingCartProduct::where('shopping_cart_id', $shopping_cart->id)->get();
        foreach($cart_products as $cart_product) {
            $product = Product::find($cart_product->product_id);
            Cart::add($product->id, $product->name, $cart_product->quantity, 0);
        }
    }
}
