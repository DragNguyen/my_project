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
        $rows = [];
        foreach(\App\GoodsReceiptNote::all() as $grn) {
            array_push($rows, [
                'goods_receipt_note_id' => $grn->id,
                'cost' => $grn->goodsReceiptNotes->sum('total_of_cost')
            ]);
        }
        DB::table('goods_receipt_note_costs')->insert($rows);
    }
}
