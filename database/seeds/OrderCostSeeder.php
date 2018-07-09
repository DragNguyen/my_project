<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderCostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = [];
        foreach(\App\Order::all() as $order) {
            $row = [
                'price' => $order->orderProducts->sum('total_of_price'),
                'order_id' => $order->id
            ];
            array_push($rows, $row);
        }
        DB::table('order_prices')->insert($rows);
    }
}
