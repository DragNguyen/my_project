<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OrderStatictisController extends Controller
{
    public function index(Request $request) {
        $date = '';
        $table_quantities = [];
        $table_prices = [];
        $years = [];
        $year = '';
        $year_selected =  $request->get('static-year');
        $month_selected =  $request->get('static-month');
        $begin_selected =  $request->get('static-begin');
        $end_selected =  $request->get('static-end');
        $date = $request->get('dashboard');
        $order_quantities = $this->getOrderToday($request);
        foreach(Order::all() as $order) {
            if ($year != date_format(date_create($order->order_created_at), 'Y')) {
                $year = date_format(date_create($order->order_created_at), 'Y');
                array_push($years, $year);
            }
        }
        $static_table = $request->get('static-table');
        if($static_table == 'trimester') {
            $year = $request->get('static-year');
            $this->getOrderTableTrimester($year,$table_quantities,$table_prices );
            $table_header = 'Quý';
        }
        elseif($static_table == 'month') {
            $year = $request->get('static-year');
            $this->getOrderTableMonth($year,$table_quantities,$table_prices );
            $table_header = 'Tháng';
        }
        elseif($static_table == 'date') {
            $year = $request->get('static-year');
            $this->getOrderTableDate($request, $year,$table_quantities,$table_prices );
            $table_header = 'Ngày';
        }
        else {
            $this->getOrderTableYear($years,$table_quantities,$table_prices );
            $table_header = 'Năm';
        }

        return view('admin.statictis.order.index',
            compact(['order_quantities', 'date', 'table_quantities', 'table_prices',
                'year_selected', 'month_selected', 'begin_selected', 'end_selected',
                'years', 'static_table', 'table_header']));
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
            $orders = Order::where('order_created_at', '>=', $date)->get();
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

    public function getOrderTableYear($years, &$table_quantities, &$table_prices) {
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

    public function getOrderTableTrimester($year, &$table_quantities, &$table_prices) {
        for($i=1; $i<=10; $i=$i+3) {
            array_push($table_quantities, [
                'year' => '',
                'unapprove' => DB::table('orders')->join('order_statuses', 'orders.id', 'order_id')
                    ->whereYear('order_created_at', $year)->where('status', 0)
                    ->whereMonth('order_created_at', '>=', $i)
                    ->whereMonth('order_created_at', '<=', $i+2)->count(),
                'approved' => DB::table('orders')->join('order_statuses', 'orders.id', 'order_id')
                    ->whereYear('order_created_at', $year)->where('status', 1)
                    ->whereMonth('order_created_at', '>=', $i)
                    ->whereMonth('order_created_at', '<=', $i+2)->count(),
                'complete' => DB::table('orders')->join('order_statuses', 'orders.id', 'order_id')
                    ->whereYear('order_created_at', $year)->where('status', 2)
                    ->whereMonth('order_created_at', '>=', $i)
                    ->whereMonth('order_created_at', '<=', $i+2)->count(),
            ]);
            array_push($table_prices, [
                'year' => '',
                'unapprove' => DB::table('orders')
                    ->join('order_statuses', 'orders.id', 'order_statuses.order_id')
                    ->join('order_prices', 'orders.id', 'order_prices.order_id')
                    ->whereYear('order_created_at', $year)
                    ->whereMonth('order_created_at', '>=', $i)
                    ->whereMonth('order_created_at', '<=', $i+2)
                    ->where('status', 0)->sum('price'),
                'approved' => DB::table('orders')
                    ->join('order_statuses', 'orders.id', 'order_statuses.order_id')
                    ->join('order_prices', 'orders.id', 'order_prices.order_id')
                    ->whereYear('order_created_at', $year)
                    ->whereMonth('order_created_at', '>=', $i)
                    ->whereMonth('order_created_at', '<=', $i+2)
                    ->where('status', 1)->sum('price'),
                'complete' => DB::table('orders')
                    ->join('order_statuses', 'orders.id', 'order_statuses.order_id')
                    ->join('order_prices', 'orders.id', 'order_prices.order_id')
                    ->whereYear('order_created_at', $year)
                    ->whereMonth('order_created_at', '>=', $i)
                    ->whereMonth('order_created_at', '<=', $i+2)
                    ->where('status', 2)->sum('price')
            ]);
        }
    }

    public function getOrderTableMonth($year, &$table_quantities, &$table_prices) {
        for($i=1; $i<=12; $i++) {
            array_push($table_quantities, [
                'year' => '',
                'unapprove' => DB::table('orders')->join('order_statuses', 'orders.id', 'order_id')
                    ->whereYear('order_created_at', $year)->where('status', 0)
                    ->whereMonth('order_created_at', $i)->count(),
                'approved' => DB::table('orders')->join('order_statuses', 'orders.id', 'order_id')
                    ->whereYear('order_created_at', $year)->where('status', 1)
                    ->whereMonth('order_created_at', $i)->count(),
                'complete' => DB::table('orders')->join('order_statuses', 'orders.id', 'order_id')
                    ->whereYear('order_created_at', $year)->where('status', 2)
                    ->whereMonth('order_created_at', $i)->count(),
            ]);
            array_push($table_prices, [
                'year' => '',
                'unapprove' => DB::table('orders')
                    ->join('order_statuses', 'orders.id', 'order_statuses.order_id')
                    ->join('order_prices', 'orders.id', 'order_prices.order_id')
                    ->whereYear('order_created_at', $year)
                    ->whereMonth('order_created_at', $i)
                    ->where('status', 0)->sum('price'),
                'approved' => DB::table('orders')
                    ->join('order_statuses', 'orders.id', 'order_statuses.order_id')
                    ->join('order_prices', 'orders.id', 'order_prices.order_id')
                    ->whereYear('order_created_at', $year)
                    ->whereMonth('order_created_at', $i)
                    ->where('status', 1)->sum('price'),
                'complete' => DB::table('orders')
                    ->join('order_statuses', 'orders.id', 'order_statuses.order_id')
                    ->join('order_prices', 'orders.id', 'order_prices.order_id')
                    ->whereYear('order_created_at', $year)
                    ->whereMonth('order_created_at', $i)
                    ->where('status', 2)->sum('price')
            ]);
        }
    }

    public function getOrderTableDate($request, $year, &$table_quantities, &$table_prices) {
        $begin = $request->get('static-begin');
        $end = $request->get('static-end');
        $month = $request->get('static-month');
        for($i=(int)$begin; $i<=(int)$end; $i++) {
            array_push($table_quantities, [
                'year' => $i,
                'unapprove' => DB::table('orders')->join('order_statuses', 'orders.id', 'order_id')
                    ->whereYear('order_created_at', $year)->where('status', 0)
                    ->whereMonth('order_created_at', $month)
                    ->whereDate('order_created_at', $i)->count(),
                'approved' => DB::table('orders')->join('order_statuses', 'orders.id', 'order_id')
                    ->whereYear('order_created_at', $year)->where('status', 1)
                    ->whereMonth('order_created_at', $month)
                    ->whereDate('order_created_at', $i)->count(),
                'complete' => DB::table('orders')->join('order_statuses', 'orders.id', 'order_id')
                    ->whereYear('order_created_at', $year)->where('status', 2)
                    ->whereMonth('order_created_at', $month)
                    ->whereDate('order_created_at', $i)->count(),
            ]);
            array_push($table_prices, [
                'year' => $i,
                'unapprove' => DB::table('orders')
                    ->join('order_statuses', 'orders.id', 'order_statuses.order_id')
                    ->join('order_prices', 'orders.id', 'order_prices.order_id')
                    ->whereYear('order_created_at', $year)
                    ->whereMonth('order_created_at', $month)
                    ->whereDate('order_created_at', $i)
                    ->where('status', 0)->sum('price'),
                'approved' => DB::table('orders')
                    ->join('order_statuses', 'orders.id', 'order_statuses.order_id')
                    ->join('order_prices', 'orders.id', 'order_prices.order_id')
                    ->whereYear('order_created_at', $year)
                    ->whereMonth('order_created_at', $month)
                    ->whereDate('order_created_at', $i)
                    ->where('status', 1)->sum('price'),
                'complete' => DB::table('orders')
                    ->join('order_statuses', 'orders.id', 'order_statuses.order_id')
                    ->join('order_prices', 'orders.id', 'order_prices.order_id')
                    ->whereYear('order_created_at', $year)
                    ->whereMonth('order_created_at', $month)
                    ->whereDate('order_created_at', $i)
                    ->where('status', 2)->sum('price')
            ]);
        }
    }
}
