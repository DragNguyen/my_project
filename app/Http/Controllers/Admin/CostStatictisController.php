<?php

namespace App\Http\Controllers\Admin;

use App\GoodsReceiptNote;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CostStatictisController extends Controller
{
    public function index(Request $request) {
        $cost_today = $this->getToday($request);
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
        $static_table = $request->get('static-table');
        if ($static_table == 'date') {
            $costs = $this->getDate($request);
            $type = 'Ngày';
        }
        elseif ($static_table == 'trimester') {
            $costs = $this->getTrimester($request);
            $type = 'Quý';
        }
        elseif ($static_table == 'month') {
            $costs = $this->getMonth($request);
            $type = 'Tháng';
        }
        else {
            $costs = $this->getYear($years);
        }

        return view('admin.statictis.cost.index',
            compact(['cost_today', 'years', 'costs', 'type']));
    }

    public function getToday($request) {
        $cost_today = [
            'in' => 0,
            'out' => 0,
            'minus' => 0
        ];
        if ($request->has('dashboard')) {
            $date = $request->get('dashboard');
            $cost_today['out'] = DB::table('goods_receipt_notes')
                ->join('goods_receipt_note_products', 'goods_receipt_notes.id', 'goods_receipt_note_id')
                ->where('date', '>=', $date)->sum('price');
            $cost_today['in'] = DB::table('orders')
                ->join('order_products', 'orders.id', 'order_products.order_id')
                ->join('order_statuses', 'orders.id', 'order_statuses.order_id')
                ->where('order_created_at', '>=', $date)
                ->where('status', 2)->sum('price');
            $cost_today['minus'] = $cost_today['in'] - $cost_today['out'];
        }
        return $cost_today;
    }

    public function getYear($years) {
        $costs = [];
        foreach($years as $year) {
            $out = DB::table('goods_receipt_notes')
                ->join('goods_receipt_note_products', 'goods_receipt_notes.id', 'goods_receipt_note_id')
                ->whereYear('date', $year)->sum('price');
            $in = DB::table('orders')
                ->join('order_products', 'orders.id', 'order_products.order_id')
                ->join('order_statuses', 'orders.id', 'order_statuses.order_id')
                ->whereYear('order_created_at', $year)
                ->where('status', 2)->sum('price');
            $cost = array($year, $out/1000000, $in/1000000);
            array_push($costs, $cost);
        }
        return $costs;
    }

    public function getTrimester($request) {
        $costs = [];
        $year = $request->get('static-year');
        $count = 1;
        for($i=1; $i<=10; $i=$i+3) {
            $out = DB::table('goods_receipt_notes')
                ->join('goods_receipt_note_products', 'goods_receipt_notes.id', 'goods_receipt_note_id')
                ->whereYear('date', $year)->whereMonth('date', '>=', $i)
                ->whereMonth('date', '<', $i+3)->sum('price');
            $in = DB::table('orders')
                ->join('order_products', 'orders.id', 'order_products.order_id')
                ->join('order_statuses', 'orders.id', 'order_statuses.order_id')
                ->whereYear('order_created_at', $year)->whereMonth('order_created_at', '>=', $i)
                ->whereMonth('order_created_at', '<', $i+3)
                ->where('status', 2)->sum('price');
            $cost = array($count++, $out/1000000, $in/1000000);
            array_push($costs, $cost);
        }
        return $costs;
    }

    public function getMonth($request) {
        $costs = [];
        $year = $request->get('static-year');
        for($i=1; $i<=12; $i++) {
            $out = DB::table('goods_receipt_notes')
                ->join('goods_receipt_note_products', 'goods_receipt_notes.id', 'goods_receipt_note_id')
                ->whereYear('date', $year)->whereMonth('date', $i)->sum('price');
            $in = DB::table('orders')
                ->join('order_products', 'orders.id', 'order_products.order_id')
                ->join('order_statuses', 'orders.id', 'order_statuses.order_id')
                ->whereYear('order_created_at', $year)->whereMonth('order_created_at', $i)
                ->where('status', 2)->sum('price');
            $cost = array($i, $out/1000000, $in/1000000);
            array_push($costs, $cost);
        }
        return $costs;
    }

    public function getDate($request) {
        $costs = [];
        $year = $request->get('static-year');
        $month = $request->get('static-month');
        $begin = $request->get('static-begin');
        $end = $request->get('static-end');
        for($i=$begin; $i<=$end; $i++) {
            $out = DB::table('goods_receipt_notes')
                ->join('goods_receipt_note_products', 'goods_receipt_notes.id', 'goods_receipt_note_id')
                ->whereYear('date', $year)->whereMonth('date', $month)
                ->whereDay('date', $i)->sum('price');
            $in = DB::table('orders')
                ->join('order_products', 'orders.id', 'order_products.order_id')
                ->join('order_statuses', 'orders.id', 'order_statuses.order_id')
                ->whereYear('order_created_at', $year)->whereMonth('order_created_at', $month)
                ->whereDay('order_created_at', $i)->where('status', 2)->sum('price');
            $cost = array($i, $out/1000000, $in/1000000);
            array_push($costs, $cost);
        }
        return $costs;
    }
}
