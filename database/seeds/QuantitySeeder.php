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
        foreach(\App\Product::all() as $product) {
            DB::table('quantities')->insert([
                [
                    'product_id' => $product->id
                ]
            ]);
        }
    }
}
