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
        $rows = [];
        for ($i=1; $i<=114; $i++) {
            $supplier_id = random_int(1, 9);
            $row = [
                'name' => 'Nguyễn Đình Trọng',
                'date' => Self::getValidDate(),
                'admin_id' => 1,
                'supplier_name' => \App\Supplier::find($supplier_id)->name,
                'supplier_id' => $supplier_id
            ];
            array_push($rows, $row);
        }
        $rows = array_sort($rows, function($row) {
            return $row['date'];
        });

        DB::table('goods_receipt_notes')->insert($rows);
    }

    public static function getValidDate() {
        $time = mt_rand(1388509200, time());
        $date = date('Y-m-d H:i:s', $time);
        return $date;
    }
}
