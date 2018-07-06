<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatictisController extends Controller
{
    public function order(Request $request) {
        $order_quantities = [
            'total_of_quantity' => 0,
            'unapprove' => 0,
            'approved' => 0,
            'complete' => 0,
            'total_of_price' => 0
        ];
        $date = $request->get('today');
        $orders = Order::whereBetween('order_created_at', [$date, date('Y-m-d')])->get();
        foreach ($orders as $order) {
            $order_quantities['total_of_quantity']++;
            $order_quantities['total_of_price'] += $order->getPrice();
            if ($order->getStatus() == 0) {
                $order_quantities['unapprove']++;
            }
            elseif($order->getStatus() == 1) {
                $order_quantities['approved']++;
            }
            else {
                $order_quantities['complete']++;
            }
        }

        return view('admin.statictis.order.index', compact(['order_quantities', 'date']));
    }

    public function getOrderByYear() {

    }
}
