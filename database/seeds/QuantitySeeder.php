<?php

use Illuminate\Database\Seeder;

class QuantitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = [];

        foreach(\App\Product::all() as $product) {
            $rows[] = [
                'product_id' => $product->id,
                'quantity' => \App\GoodsReceiptNoteProduct::where('product_id', $product->id)->sum('quantity')
            ];
        }
        DB::table('quantities')->insert($rows);
    }
}
