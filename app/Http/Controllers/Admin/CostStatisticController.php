<?php

namespace App\Http\Controllers\Admin;

use App\GoodsReceiptNote;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CostStatisticController extends Controller
{
    public function index(Request $request) {
        $today = $this->getToday($request);
        $years = [];
        $costs = [];
        $type = 'Năm';
        foreach(GoodsReceiptNote::all() as $grn) {
            array_push($years, date_format(date_create($grn->date), 'Y'));
        }
        foreach(Order::all() as $order) {
            array_push($years, date_format(date_create($order->order_created_at), 'Y'));
        }
        $years = array_unique($years);
        $years = array_sort($years);
        $static_table = $request->get('type');
        if ($static_table == 'date') {
            $costs = $this->getDate($request, $today);
            $type = 'Ngày';
        }
        elseif ($static_table == 'trimester') {
            $costs = $this->getTrimester($request, $today);
            $type = 'Quý';
        }
        elseif ($static_table == 'month') {
            $costs = $this->getMonth($request, $today);
            $type = 'Tháng';
        }
        elseif($static_table == 'year') {
            $costs = $this->getYear($years, $today);
        }

        return view('admin.statictis.cost.index',
            compact(['today', 'years', 'costs', 'type']));
    }

    public function getToday($request) {
        $today = [
            'in' => 0,
            'out' => 0,
            'minus' => 0
        ];
        $date = $request->has('dashboard') ? $request->get('dashboard') : date('Y-m-d');
        $today['out'] = DB::table('goods_receipt_notes')
            ->join('goods_receipt_note_costs', 'goods_receipt_notes.id', 'goods_receipt_note_id')
            ->where('date', '>=', $date)->sum('cost');
        $today['in'] = DB::table('orders')
            ->join('order_products', 'orders.id', 'order_products.order_id')
            ->join('order_statuses', 'orders.id', 'order_statuses.order_id')
            ->where('order_created_at', '>=', $date)
            ->where('status', 2)->sum('price');
        $today['minus'] = $today['in'] - $today['out'];
        return $today;
    }

    public function getYear($years, &$today) {
        $costs = [];
        $today = [
            'in' => 0,
            'out' => 0,
            'minus' => 0
        ];
        foreach($years as $year) {
            $out = DB::table('goods_receipt_notes')
                ->join('goods_receipt_note_costs', 'goods_receipt_notes.id', 'goods_receipt_note_id')
                ->whereYear('date', $year)->sum('cost');
            $in = DB::table('orders')
                ->join('order_products', 'orders.id', 'order_products.order_id')
                ->join('order_statuses', 'orders.id', 'order_statuses.order_id')
                ->whereYear('order_created_at', $year)
                ->where('status', 2)->sum('price');
            $cost = array($year, $out/1000000, $in/1000000);
            $today['in'] += $in;
            $today['out'] += $out;
            $today['minus'] += $in - $out;
            array_push($costs, $cost);
        }
        return $costs;
    }

    public function getTrimester($request, &$today) {
        $costs = [];
        $year = $request->get('year');
        $count = 1;
        $today = [
            'in' => 0,
            'out' => 0,
            'minus' => 0
        ];
        for($i=1; $i<=10; $i=$i+3) {
            $out = DB::table('goods_receipt_notes')
                ->join('goods_receipt_note_costs', 'goods_receipt_notes.id', 'goods_receipt_note_id')
                ->whereYear('date', $year)->whereMonth('date', '>=', $i)
                ->whereMonth('date', '<', $i+3)->sum('cost');
            $in = DB::table('orders')
                ->join('order_products', 'orders.id', 'order_products.order_id')
                ->join('order_statuses', 'orders.id', 'order_statuses.order_id')
                ->whereYear('order_created_at', $year)->whereMonth('order_created_at', '>=', $i)
                ->whereMonth('order_created_at', '<', $i+3)
                ->where('status', 2)->sum('price');
            $cost = array($count++, $out/1000000, $in/1000000);
            $today['in'] += $in;
            $today['out'] += $out;
            $today['minus'] += $in - $out;
            array_push($costs, $cost);
        }
        return $costs;
    }

    public function getMonth($request, &$today) {
        $costs = [];
        $year = $request->get('year');
        $begin = $request->get('begin-month');
        $end = $request->get('end-month');
        $today = [
            'in' => 0,
            'out' => 0,
            'minus' => 0
        ];
        for($i=$begin; $i<=$end; $i++) {
            $out = DB::table('goods_receipt_notes')
                ->join('goods_receipt_note_costs', 'goods_receipt_notes.id', 'goods_receipt_note_id')
                ->whereYear('date', $year)->whereMonth('date', $i)->sum('cost');
            $in = DB::table('orders')
                ->join('order_products', 'orders.id', 'order_products.order_id')
                ->join('order_statuses', 'orders.id', 'order_statuses.order_id')
                ->whereYear('order_created_at', $year)->whereMonth('order_created_at', $i)
                ->where('status', 2)->sum('price');
            $cost = array($i, $out/1000000, $in/1000000);
            $today['in'] += $in;
            $today['out'] += $out;
            $today['minus'] += $in - $out;
            array_push($costs, $cost);
        }
        return $costs;
    }

    public function getDate($request, &$today) {
        $costs = [];
        $year = $request->get('year');
        $month = $request->get('month');
        $begin = $request->get('begin');
        $end = $request->get('end');
        $today = [
            'in' => 0,
            'out' => 0,
            'minus' => 0
        ];
        for($i=$begin; $i<=$end; $i++) {
            $out = DB::table('goods_receipt_notes')
                ->join('goods_receipt_note_costs', 'goods_receipt_notes.id', 'goods_receipt_note_id')
                ->whereYear('date', $year)->whereMonth('date', $month)
                ->whereDay('date', $i)->sum('cost');
            $in = DB::table('orders')
                ->join('order_products', 'orders.id', 'order_products.order_id')
                ->join('order_statuses', 'orders.id', 'order_statuses.order_id')
                ->whereYear('order_created_at', $year)->whereMonth('order_created_at', $month)
                ->whereDay('order_created_at', $i)->where('status', 2)->sum('price');
            $cost = array($i, $out/1000000, $in/1000000);
            $today['in'] += $in;
            $today['out'] += $out;
            $today['minus'] += $in - $out;
            array_push($costs, $cost);
        }
        return $costs;
    }
}
