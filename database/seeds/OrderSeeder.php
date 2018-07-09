<?php

use App\Order;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = json_decode(Info::INFO, true);
        $rows = [];
        for($i=1; $i<=250; $i++) {
            $date = GoodsReceiptNoteSeeder::getValidDate();
            do {
                $order_id = strtoupper(str_random(12));
            }
            while (Order::where('code', $order_id)->count() > 0);
            $row = [
                'code' => $order_id,
                'recipient' => $data[$i]['name'],
                'email' =>strtolower( $data[$i]['email']),
                'phone' => preg_replace('/(\s|\(|\))/i', '', $data[$i]['phone']),
                'address' => $data[$i]['address'],
                'order_created_at' => $date
            ];
            array_push($rows, $row);
        }
        DB::table('orders')->insert($rows);
        for($i=1; $i<=250; $i++) {
            $order = Order::find($i);
            if ($order->order_created_at <= date_format(date_modify(date_create(date('Y-m-d')), '-2 months'), 'Y-m-d')) {
                DB::table('order_statuses')->insert([
                    [
                        'status' => 2,
                        'approved_at' => $order->order_created_at,
                        'approver' => 'Nguyễn Đình Trọng',
                        'admin_id' => 1,
                        'order_id' => $order->id
                    ]
                ]);
            }
            elseif ($order->order_created_at <=
                date_format(date_modify(date_create(date('Y-m-d')), '-1 weeks'), 'Y-m-d')) {
                DB::table('order_statuses')->insert([
                    [
                        'status' => 1,
                        'approved_at' => $order->order_created_at,
                        'approver' => 'Nguyễn Đình Trọng',
                        'admin_id' => 1,
                        'order_id' => $order->id
                    ]
                ]);
            }
            else {
                DB::table('order_statuses')->insert([
                    [
                        'status' => 0,
                        'order_id' => $order->id
                    ]
                ]);
            }
        }
    }
}
