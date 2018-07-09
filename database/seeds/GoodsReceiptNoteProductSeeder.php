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
        foreach(\App\GoodsReceiptNote::all() as $grn) {
            for($i=1; $i<=3; $i++) {
                do {
                    $product_id = random_int(1, \App\Product::count());
                } while($grn->matchedProduct($product_id));
                $quantity = 3;
                $cost = \App\Product::find($product_id)->currentPrice() - 3000000;
                $row = [
                    'goods_receipt_note_id' => $grn->id,
                    'product_id' => $product_id,
                    'cost' => $cost,
                    'quantity' => $quantity,
                    'quantity_updated' => $quantity,
                    'total_of_cost' => $quantity * $cost
                ];
                DB::table('goods_receipt_note_products')->insert($row);
            }
        }
    }
}
