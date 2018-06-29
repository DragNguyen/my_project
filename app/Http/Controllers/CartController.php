<?php

namespace App\Http\Controllers;

use App\Product;
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
        $id = $request->get('product-id');
        $rowId = $this->getRowId($id);
        $quantity = $request->get('quantity');
        $product = Product::find($id);
        $cart_quantity = empty($rowId) ? 0 : Cart::get($rowId)->qty;
        if ($cart_quantity == 5) {
            return back()->with('error', 'Chỉ cho phép mua tối đa số lượng 5 trên mỗi sản phẩm!');
        }
        if ($quantity + $cart_quantity >= 5) {
            Cart::add($id, $product->name, 5 - $cart_quantity, 0);
            return back()->with('success', 'Thêm vào giỏ hàng thành công.');
        }
        dd($quantity + $cart_quantity);
        Cart::add($id, $product->name, $quantity, 0);

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
            return back()->with('error', 'Chỉ cho phép mua tối đa số lượng 5 trên mỗi sản phẩm!');
        }
        if ($quantity == 0) {
            return back();
        }
        Cart::update($rowId, $quantity);

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
                'address' => array('required', 'max:200', "regex:/^\w[\wÀ-ỹ \.,-]*[\wÀ-ỹ]$/"),
                'note' => array('required', 'max:100', "regex:/^[[:alpha:]][\wÀ-ỹ \.]*$/")
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
