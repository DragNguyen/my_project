<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderPrice;
use App\OrderProduct;
use App\OrderStatus;
use App\Product;
use App\Quantity;
use App\ShoppingCart;
use App\ShoppingCartProduct;
use Illuminate\Support\Facades\Auth;
use Validator;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart_products = Cart::content();

        return view('customer.shopping-cart.index', compact('cart_products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id = $request->get('product-id');
        $rowId = $this->getRowId($id);
        $quantity = $request->get('quantity');
        $product = Product::find($id);
        $cart_quantity = empty($rowId) ? 0 : Cart::get($rowId)->qty;
        if ($quantity + $cart_quantity > 5) {
            return back()->with('error', 'Chỉ cho phép thêm số lượng tối đa 5 trên mỗi sản phẩm!');
        }

        Cart::add($id, $product->name, $quantity, 0);
        if (Auth::guard('customer')->check()) {
            $cart = ShoppingCart::where('customer_id', Auth::guard('customer')->user()->id)->first();
            if ($cart_quantity == 0) {
                $cart_product = new ShoppingCartProduct();
                $cart_product->shopping_cart_id = $cart->id;
                $cart_product->product_id = $id;
                $cart_product->quantity = $quantity;
                $cart_product->save();
            }
            else {
                $cart_product = $cart->getCartProductById($id);
                $cart_product->quantity = $quantity + $cart_quantity;
                $cart_product->update();
            }
        }
        return back()->with('success', 'Thêm vào giỏ hàng thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $rowId)
    {
        $quantity = $request->get('quantity');
        if ($quantity > 5) {
            return back()->with('error', 'Chỉ cho phép mua số lượng tối đa 5 trên mỗi sản phẩm!');
        }
        if ($quantity == 0) {
            return back();
        }
        Cart::update($rowId, $quantity);

        if (Auth::guard('customer')->check()) {
            $cart = ShoppingCart::where('customer_id', Auth::guard('customer')->user()->id)->first();
            $cart_product = $cart->getCartProductById(Cart::get($rowId)->id);
            $cart_product->quantity = $quantity;
            $cart_product->update();
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($rowId)
    {
        Cart::remove($rowId);

        $cart = ShoppingCart::where('customer_id', Auth::guard('customer')->user()->id)->first();

        foreach($cart->getCartProduct() as $cart_product) {
            $cart_product->delete();
        }

        return back();
    }

    public function checkoutStore() {

    }

    public function validation($request) {
        $validate = Validator::make(
            $request->all(),
            [
                'name' => array('required', 'max:50', "regex:/^[a-zA-ZÀ-ỹ]+ [a-zA-ZÀ-ỹ ]+$/"),
                'email' => 'required|email|max:100',
                'phone' => array('required', 'regex:/^[\d( )\.]*$/', 'max:20'),
                'address' => array('required', 'max:200', "regex:/^\w[\wÀ-ỹ \.,-]*[\wÀ-ỹ]$/")
            ],
            [
                'required' => ':attribute không được bỏ trống!',
                'max' => ':attribute không được vượt quá :max ký tự!',
                'regex' => ':attribute không hợp lệ!',
                'email' => ':attribute không hợp lệ'
            ],
            [
                'name' => 'Tên khách hàng',
                'email' => 'Email',
                'phone' => 'Số điện thoại',
                'address' => 'Địa chỉ',
                'note' => 'Ghi chú'
            ]
        );

        return $validate;
    }

    public function orderStore(Request $request) {
        $validate = $this->validation($request);
        if ($validate->fails()) {
            return back()->withErrors($validate)->withInput($request->all());
        }

        do {
            $order_id = strtoupper(str_random(12));
        }
        while (Order::where('code', $order_id)->count() > 0);

        $order = new Order();
        $order->code = $order_id;
        $order->recipient = $request->get('name');
        $order->email = $request->get('email');
        $order->phone = $request->get('phone');
        $order->address = $request->get('address');
        $order->order_created_at = date('Y-m-d H:i:s');
        $order->save();

        $orderStatus = new OrderStatus();
        $orderStatus->order_id = $order->id;
        $orderStatus->save();

        $cart_products = Cart::content();
        $total_of_money = 0;
        foreach($cart_products as $cart_product) {
            $product = Product::find($cart_product->id);
            $price = $product->getSalesOffPrice();
            $total_of_money += $price;

            $order_product = new OrderProduct();
            $order_product->order_id = $order->id;
            $order_product->product_id = $product->id;
            $order_product->quantity = $cart_product->qty;
            $order_product->price = $price;
            $order_product->sales_off_percent = $product->getSalesOffPercent();
            $order_product->save();

            $quantity = Quantity::where('product_id', $product->id)->first();
            $quantity->quantity = $product->getQuantity() - $cart_product->qty;
            $quantity->update();
        }

        $order_price = new OrderPrice();
        $order_price->price = $total_of_money;
        $order_price->order_id = $order->id;
        $order_price->save();

        // Remove cart

        Cart::destroy();

        return redirect('/')->with('success', 'Đặt hàng thành công.');
    }

    public function checkoutIndex() {
        $cart_products = Cart::content();

        return view('customer.shopping-cart.checkout', compact('cart_products'));
    }

    public function getRowId($id) {
        foreach(Cart::content() as $product) {
            if ($product->id == $id) {
                return $product->rowId;
            }
        }
    }
}
