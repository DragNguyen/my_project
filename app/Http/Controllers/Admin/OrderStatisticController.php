<?php

namespace App\Http\Controllers\Admin;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class OrderStatisticController extends Controller
{
    public function index(Request $request) {
        $table_quantities = [];
        $table_costs = [];
        $years = [];
        $order_quantity = $this->getToday($request);
        foreach(Order::all() as $order) {
            $year = date_format(date_create($order->order_created_at), 'Y');
            array_push($years, $year);
        }
        $years = array_sort(array_unique($years));
        $type = $request->get('type');
        if($type == 'trimester') {
            $year = $request->get('year');
            $this->getTrimester($year,$table_quantities,$table_costs, $order_quantity );
            $table_header = 'Quý';
        }
        elseif($type == 'month') {
            $year = $request->get('year');
            $this->getMonth($request,$table_quantities,$table_costs, $order_quantity );
            $table_header = 'Tháng';
        }
        elseif($type == 'date') {
            $this->getDate($request, $table_quantities,$table_costs, $order_quantity );
            $table_header = 'Ngày';
        }
        elseif($type == 'year') {
            $this->getYear($years,$table_quantities,$table_costs, $order_quantity );
            $table_header = 'Năm';
        }

        return view('admin.statictis.order.index',
            compact(['order_quantity', 'table_quantities', 'table_costs',
                'years', 'table_header']));
    }

    public function getToday($request) {
        $order_quantity = [
            'total_of_quantity' => 0,
            'unapprove' => 0,
            'approved' => 0,
            'complete' => 0,
            'total_of_price' => 0
        ];
        $date = $request->has('today') ? $request->get('today') : date('Y-m-d');
        $orders = Order::where('order_created_at', '>=', $date)->get();
        foreach ($orders as $order) {
            $order_quantity['total_of_quantity']++;
            $order_quantity['total_of_price'] += $order->getPrice();
            if ($order->getStatus() == 0) {
                $order_quantity['unapprove']++;
            }
            elseif($order->getStatus() == 1) {
                $order_quantity['approved']++;
            }
            else {
                $order_quantity['complete']++;
            }
        }
        return $order_quantity;
    }

    public function getYear($years, &$table_quantities, &$table_costs, &$order_quantity) {
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
            array_push($table_costs, [
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
        $order_quantity = [
            'total_of_quantity' => 0,
            'unapprove' => 0,
            'approved' => 0,
            'complete' => 0,
            'total_of_price' => 0
        ];
        foreach($table_quantities as $table_quantity) {
            $order_quantity['unapprove'] += $table_quantity['unapprove'];
            $order_quantity['approved'] += $table_quantity['approved'];
            $order_quantity['complete'] += $table_quantity['complete'];
            $order_quantity['total_of_quantity'] += $table_quantity['unapprove'] + $table_quantity['approved']
                + $table_quantity['complete'];
        }
        foreach($table_costs as $table_cost) {
            $order_quantity['total_of_price'] += $table_cost['unapprove'] + $table_cost['approved']
                + $table_cost['complete'];
        }
    }

    public function getTrimester($year, &$table_quantities, &$table_costs, &$order_quantity) {
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
            array_push($table_costs, [
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
        $order_quantity = [
            'total_of_quantity' => 0,
            'unapprove' => 0,
            'approved' => 0,
            'complete' => 0,
            'total_of_price' => 0
        ];
        foreach($table_quantities as $table_quantity) {
            $order_quantity['unapprove'] += $table_quantity['unapprove'];
            $order_quantity['approved'] += $table_quantity['approved'];
            $order_quantity['complete'] += $table_quantity['complete'];
            $order_quantity['total_of_quantity'] += $table_quantity['unapprove'] + $table_quantity['approved']
                + $table_quantity['complete'];
        }
        foreach($table_costs as $table_cost) {
            $order_quantity['total_of_price'] += $table_cost['unapprove'] + $table_cost['approved']
                + $table_cost['complete'];
        }
    }

    public function getMonth($request, &$table_quantities, &$table_costs, &$order_quantity) {
        $year = $request->get('year');
        $begin = $request->get('begin-month');
        $end = $request->get('end-month');
        for($i=$begin; $i<=$end; $i++) {
            array_push($table_quantities, [
                'year' => $i,
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
            array_push($table_costs, [
                'year' => $i,
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
        $order_quantity = [
            'total_of_quantity' => 0,
            'unapprove' => 0,
            'approved' => 0,
            'complete' => 0,
            'total_of_price' => 0
        ];
        foreach($table_quantities as $table_quantity) {
            $order_quantity['unapprove'] += $table_quantity['unapprove'];
            $order_quantity['approved'] += $table_quantity['approved'];
            $order_quantity['complete'] += $table_quantity['complete'];
            $order_quantity['total_of_quantity'] += $table_quantity['unapprove'] + $table_quantity['approved']
                + $table_quantity['complete'];
        }
        foreach($table_costs as $table_cost) {
            $order_quantity['total_of_price'] += $table_cost['unapprove'] + $table_cost['approved']
                + $table_cost['complete'];
        }
    }

    public function getDate($request, &$table_quantities, &$table_costs, &$order_quantity) {
        $begin = $request->get('begin');
        $end = $request->get('end');
        $month = $request->get('month');
        $year = $request->get('year');
        for($i=$begin; $i<=$end; $i++) {
            array_push($table_quantities, [
                'year' => $i,
                'unapprove' => DB::table('orders')->join('order_statuses', 'orders.id', 'order_id')
                    ->whereYear('order_created_at', $year)->where('status', 0)
                    ->whereMonth('order_created_at', $month)
                    ->whereDay('order_created_at', $i)->count(),
                'approved' => DB::table('orders')->join('order_statuses', 'orders.id', 'order_id')
                    ->whereYear('order_created_at', $year)->where('status', 1)
                    ->whereMonth('order_created_at', $month)
                    ->whereDay('order_created_at', $i)->count(),
                'complete' => DB::table('orders')->join('order_statuses', 'orders.id', 'order_id')
                    ->whereYear('order_created_at', $year)->where('status', 2)
                    ->whereMonth('order_created_at', $month)
                    ->whereDay('order_created_at', $i)->count(),
            ]);
            array_push($table_costs, [
                'year' => $i,
                'unapprove' => DB::table('orders')
                    ->join('order_statuses', 'orders.id', 'order_statuses.order_id')
                    ->join('order_prices', 'orders.id', 'order_prices.order_id')
                    ->whereYear('order_created_at', $year)
                    ->whereMonth('order_created_at', $month)
                    ->whereDay('order_created_at', $i)
                    ->where('status', 0)->sum('price'),
                'approved' => DB::table('orders')
                    ->join('order_statuses', 'orders.id', 'order_statuses.order_id')
                    ->join('order_prices', 'orders.id', 'order_prices.order_id')
                    ->whereYear('order_created_at', $year)
                    ->whereMonth('order_created_at', $month)
                    ->whereDay('order_created_at', $i)
                    ->where('status', 1)->sum('price'),
                'complete' => DB::table('orders')
                    ->join('order_statuses', 'orders.id', 'order_statuses.order_id')
                    ->join('order_prices', 'orders.id', 'order_prices.order_id')
                    ->whereYear('order_created_at', $year)
                    ->whereMonth('order_created_at', $month)
                    ->whereDay('order_created_at', $i)
                    ->where('status', 2)->sum('price')
            ]);
        }
        $order_quantity = [
            'total_of_quantity' => 0,
            'unapprove' => 0,
            'approved' => 0,
            'complete' => 0,
            'total_of_price' => 0
        ];
        foreach($table_quantities as $table_quantity) {
            $order_quantity['unapprove'] += $table_quantity['unapprove'];
            $order_quantity['approved'] += $table_quantity['approved'];
            $order_quantity['complete'] += $table_quantity['complete'];
            $order_quantity['total_of_quantity'] += $table_quantity['unapprove'] + $table_quantity['approved']
                + $table_quantity['complete'];
        }
        foreach($table_costs as $table_cost) {
            $order_quantity['total_of_price'] += $table_cost['unapprove'] + $table_cost['approved']
                + $table_cost['complete'];
        }
    }
}
