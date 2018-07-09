<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(\App\Order::all() as $order) {
            for($i=1; $i<=4; $i++) {
                do {
                    $product_id = random_int(1, \App\Product::count());
                    $product_quantity = \App\Product::find($product_id)->getQuantity();
                    $order_quantity = \App\OrderProduct::where('product_id', $product_id)->sum('quantity');
                } while((\App\OrderProduct::where('product_id', $product_id)->where('order_id', $order->id)->count() > 0)
                        || ($order_quantity + 1 > $product_quantity));
                $cost = \App\Product::find($product_id)->currentPrice();
                DB::table('order_products')->insert([
                    [
                        'order_id' => $order->id,
                        'product_id' => $product_id,
                        'quantity' => 1,
                        'price' => $cost,
                        'total_of_price' => $cost,
                        'sales_off_percent' => 0
                    ]
                ]);
            }
        }
        foreach(\App\Quantity::all() as $quantity) {
            $quantity->quantity -= \App\OrderProduct::where('product_id', $quantity->product_id)->sum('quantity');
            $quantity->update();
        }
    }
}
