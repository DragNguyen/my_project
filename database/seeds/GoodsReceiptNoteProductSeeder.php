<?php

use Illuminate\Database\Seeder;

class GoodsReceiptNoteProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('goods_receipt_note_products')->insert([
            [
                'goods_receipt_note_id' => 1,
                'product_id' => 1,
                'cost' => 11011000,
                'quantity' => 5,
                'quantity_updated' => 5,
                'total_of_cost' => 11011000 * 5
            ],
            [
                'goods_receipt_note_id' => 1,
                'product_id' => 3,
                'cost' => 29000000,
                'quantity' => 15,
                'quantity_updated' => 15,
                'total_of_cost' => 29000000 * 15
            ],
            [
                'goods_receipt_note_id' => 1,
                'product_id' => 4,
                'cost' => 7000000,
                'quantity' => 12,
                'quantity_updated' => 12,
                'total_of_cost' => 7000000 * 12
            ],
            [
                'goods_receipt_note_id' => 1,
                'product_id' => 6,
                'cost' => 12000000,
                'quantity' => 2,
                'quantity_updated' => 2,
                'total_of_cost' => 12000000 * 2
            ],
            [
                'goods_receipt_note_id' => 1,
                'product_id' => 7,
                'cost' => 14000000,
                'quantity' => 7,
                'quantity_updated' => 7,
                'total_of_cost' => 14000000 * 7
            ]
        ]);
    }
}
