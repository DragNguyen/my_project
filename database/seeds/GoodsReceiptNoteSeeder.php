<?php

use Illuminate\Database\Seeder;

class GoodsReceiptNoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('goods_receipt_notes')->insert([
            [
                'name' => 'Nguyễn Đình Trọng',
                'date' => date('Y-m-d'),
                'admin_id' => 1,
                'supplier_name' => 'Công ty TNHH Tin học Mai Hoàng',
                'supplier_id' => 1
            ]
        ]);
    }
}
