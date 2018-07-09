<?php

use Illuminate\Database\Seeder;

class GoodsReceiptNoteCostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('goods_receipt_note_costs')->insert([
            [
                'goods_receipt_note_id' => 1,
                'cost' => \App\GoodsReceiptNoteProduct::where('goods_receipt_note_id', 1)->sum('total_of_cost')
            ]
        ]);
    }
}
