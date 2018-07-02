<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use App\OrderProduct;
use App\OrderStatus;
use App\Product;
use App\Quantity;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::where('is_deleted', false)->paginate(10);

        return view('admin.order.index', compact('orders'));
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
        $product_ids = $request->get('product-ids');
        $total_of_money = 0;
        foreach ($product_ids as $product_id) {
            $total_of_money += Product::find($product_id)->currentPrice();
        }
        do {
            $order_id = strtoupper(str_random(12));
        }
        while (Order::where('code', $order_id)->count() > 0);

        $order = new Order();
        $order->code = $order_id;
        $order->recipient = $request->get('recipient');
        $order->email = $request->get('email');
        $order->phone = $request->get('phone');
        $order->address = $request->get('address');
        $order->price = $total_of_money;
        $order->save();

        $orderStatus = new OrderStatus();
        $orderStatus->order_id = $order->id;
        $orderStatus->save();

        foreach($product_ids as $product_id) {
            $order_product = new OrderProduct();
            $order_product->order_id = $order->id;
            $order_product->product_id = $product_id;
            $order_product->quantity = 1;
            $order_product->price = Product::find($product_id)->currentPrice();
            $order_product->save();
        }

        return back()->with('success', 'Thêm thành công.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        $order_products = OrderProduct::where('order_id', $id)->paginate(10);

        return view('admin.order.product', compact(['order','order_products']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $ids = $request->get('order-ids');
        foreach($ids as $id) {
            $order = Order::findOrFail($id);
            $order->is_deleted = true;
            $order->update();
        }

        return back()->with('success', 'Xóa đơn hàng thành công.');
    }

    public function orderDestroy($id) {
        $order = Order::findOrFail($id);
        if ($order->getStatus() == 0) {
            $order_products = OrderProduct::where('order_id', $id)->get();
            foreach($order_products as $order_product) {
                $product_quantity = Quantity::where('product_id', $order_product->product_id)->first();
                $product_quantity->quantity += $order_product->quantity;
                $product_quantity->update();
            }
            $order->delete();
        }
        else {
            $order_status = OrderStatus::where('order_id', $order->id)->first();
            $order_status->approved_at = null;
            $order_status->status = 0;
            $order_status->approver = null;
            $order_status->admin_id = null;
            $order_status->update();
        }

        return back()->with('success', 'Hủy đơn hàng thành công.');
    }

    public function orderApprove($id) {
        $order_status = OrderStatus::where('order_id', $id)->first();
        $order_status->status = 1;
        $order_status->approved_at = date('Y-m-d H:i:s');
        $order_status->approver = Auth::user()->name;
        $order_status->admin_id = Auth::user()->id;
        $order_status->update();

        return back()->with('success', 'Duyệt đơn hàng thành công.');
    }

    public function orderChangeStatus($id) {
        $order_status = OrderStatus::findOrFail(Order::find($id)->orderStatus->first()->id);
        if ($order_status->status == 1) {
            $order_status->status = 2;
        }
        else {
            $order_status->status = 1;
        }
        $order_status->update();

        return back()->with('success', 'Cập nhật thành công.');
    }
}
