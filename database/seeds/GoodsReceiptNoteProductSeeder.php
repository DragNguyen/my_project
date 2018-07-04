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
                'price' => 11011000,
                'quantity' => 5,
                'quantity_updated' => 5
            ],
            [
                'goods_receipt_note_id' => 1,
                'product_id' => 3,
                'price' => 29000000,
                'quantity' => 15,
                'quantity_updated' => 15
            ],
            [
                'goods_receipt_note_id' => 1,
                'product_id' => 4,
                'price' => 7000000,
                'quantity' => 12,
                'quantity_updated' => 12
            ],
            [
                'goods_receipt_note_id' => 1,
                'product_id' => 6,
                'price' => 12000000,
                'quantity' => 2,
                'quantity_updated' => 2
            ],
            [
                'goods_receipt_note_id' => 1,
                'product_id' => 7,
                'price' => 14000000,
                'quantity' => 7,
                'quantity_updated' => 7
            ]
        ]);
    }
}
