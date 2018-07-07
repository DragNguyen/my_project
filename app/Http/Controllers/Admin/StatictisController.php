<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class StatictisController extends Controller
{
    public function order(Request $request) {
        $date = '';
        $table_quantities = [];
        $table_prices = [];
        $years = [];
        $year = '';
        foreach(Order::all() as $order) {
            if ($year != date_format(date_create($order->order_created_at), 'Y')) {
                $year = date_format(date_create($order->order_created_at), 'Y');
                array_push($years, $year);
            }
        }
        if ($request->has('dashboard')) {
            $date = $request->get('dashboard');
        }
        $order_quantities = $this->getOrderToday($request);
        $this->getOrderTable($request,$years,$table_quantities,$table_prices );

        return view('admin.statictis.order.index',
            compact(['order_quantities', 'date', 'test', 'table_quantities', 'table_prices', 'years']));
    }

    public function getOrderToday($request) {
        $order_quantities = [
            'total_of_quantity' => 0,
            'unapprove' => 0,
            'approved' => 0,
            'complete' => 0,
            'total_of_price' => 0
        ];
        if ($request->has('dashboard')) {
            $date = $request->get('dashboard');
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
        }
        return $order_quantities;
    }

    public function getOrderTable($request, $years, &$table_quantities, &$table_prices) {
        $static_table = $request->get('static-table');
        if ($static_table == 'year') {
            foreach($years as $year) {
                array_push($table_quantities, [
                    'year' => $year,
                    'unapprove' => DB::table('orders')->join('order_statuses', 'orders.id', 'order_id')
                        ->whereYear('order_created_at', $year)->where('status', 0)->count(),
                    'approved' => DB::table('orders')->join('order_statuses', 'orders.id', 'order_id')
                        ->whereYear('order_created_at', $year)->where('status', 1)->count(),
                    'complete' => DB::table('orders')->join('order_statuses', 'orders.id', 'order_id')
                        ->whereYear('order_created_at', $year)->where('status', 2)->count()
                ]);
                array_push($table_prices, [
                    'year' => $year,
                    'unapprove' => DB::table('orders')
                        ->join('order_statuses', 'orders.id', 'order_statuses.order_id')
                        ->join('order_prices', 'orders.id', 'order_prices.order_id')
                        ->whereYear('order_created_at', $year)
                        ->where('status', 0)->sum('price'),
                    'approved' => DB::table('orders')
                        ->join('order_statuses', 'orders.id', 'order_statuses.order_id')
                        ->join('order_prices', 'orders.id', 'order_prices.order_id')
                        ->whereYear('order_created_at', $year)
                        ->where('status', 1)->sum('price'),
                    'complete' => DB::table('orders')
                        ->join('order_statuses', 'orders.id', 'order_statuses.order_id')
                        ->join('order_prices', 'orders.id', 'order_prices.order_id')
                        ->whereYear('order_created_at', $year)
                        ->where('status', 2)->sum('price')
                ]);
            }
        }
    }
}
