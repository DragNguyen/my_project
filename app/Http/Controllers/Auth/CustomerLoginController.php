<?php

namespace App\Http\Controllers\Auth;

use App\Customer;
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
                'email' => 'required|email|max:100',
                'address' => array('required', 'max:200', "regex:/^\w[\wÀ-ỹ \.,-]*[\wÀ-ỹ]$/"),
                'password' => array('required', 'min:6', 'max:30', 'regex:/^[\w\!@#\$&]*$/'),
                'password-confirm' => 'required'
            ],
            [
                'required' => ':attribute không được bỏ trống!',
                'max' => ':attribute không được vượt quá :max ký tự!',
                'regex' => ':attribute không hợp lệ!',
                'email' => ':attribute không hợp lệ!',
                'min' => ':attribute không được nhỏ hơn :min ký tự!'
            ],
            [
                'name' => 'Tên nhân viên',
                'phone' => 'Số điện thoại',
                'email' => 'Email',
                'password' => 'Mật khẩu',
                'password-confirm' => 'Mật khẩu nhập lại',
                'address' => 'Địa chỉ'
            ]
        );
        if ($validate->fails()) {
            return back()->with('error', 'Đăng ký thất bại!')->withInput($request->all())->withErrors($validate);
        }

        $password = $request->get('password');
        $password_confirm = $request->get('password-confirm');
        $phone = $request->get('phone');
        $email = $request->get('email');

        if ($password != $password_confirm) {
            return back()->with('error', 'Đăng ký thất bại!')
                ->withInput($request->all())->withErrors(['password-confirm' => 'Mật khẩu nhập lại không chính xác!']);
        }
        if (Customer::where('email', $email)->count() > 0) {
            return back()->with('error', 'Đăng ký thất bại!')
                ->withInput($request->all())->withErrors(['email' => 'Email đã tồn tại!']);
        }


        $customer = new Customer();
        $customer->name = $request->get('name');
        $customer->phone = $phone;
        $customer->email = $email;
        $customer->address = $request->get('address');
        $customer->password = bcrypt($password);
        $customer->gender = $request->get('gender');
        $customer->save();

        // Create shopping cart
        $shopping_cart = new ShoppingCart();
        $shopping_cart->customer_id = $customer->id;
        $shopping_cart->save();

        return back()->with('success', 'Đăng ký thành công.');
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
        $shopping_cart = ShoppingCart::where('customer_id', Auth::guard('customer')->user()->id)->first();
        if (Cart::content()->count() > 0) {
            foreach(Cart::content() as $cart) {
                if (!$shopping_cart->matchedProduct($cart->id)) {
                    $cart_product = new ShoppingCartProduct();
                    $cart_product->product_id = $cart->id;
                    $cart_product->shopping_cart_id = $shopping_cart->id;
                    $cart_product->quantity = $cart->qty;
                    $cart_product->save();
                }
            }
        }
        Cart::destroy();
        $cart_products = $shopping_cart->getCartProduct();
        foreach($cart_products as $cart_product) {
            $product = Product::find($cart_product->product_id);
            Cart::add($product->id, $product->name, $cart_product->quantity, 0);
        }
    }
}
