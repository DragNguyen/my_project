<?php

use Illuminate\Database\Seeder;

class ProductTypeTrademarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_type_trademarks')->insert([
            [
                'product_type_id' => 1,
                'trademark_id' => 1,
            ],
            [
                'product_type_id' => 1,
                'trademark_id' => 2,
            ],
            [
                'product_type_id' => 1,
                'trademark_id' => 3,
            ],
            [
                'product_type_id' => 1,
                'trademark_id' => 5,
            ],
            [
                'product_type_id' => 1,
                'trademark_id' => 7,
            ],
            [
                'product_type_id' => 2,
                'trademark_id' => 1,
            ],
            [
                'product_type_id' => 2,
                'trademark_id' => 4,
            ],
            [
                'product_type_id' => 2,
                'trademark_id' => 5,
            ],
            [
                'product_type_id' => 2,
                'trademark_id' => 6,
            ],
            [
                'product_type_id' => 2,
                'trademark_id' => 7,
            ],
            [
                'product_type_id' => 3,
                'trademark_id' => 8,
            ],
            [
                'product_type_id' => 3,
                'trademark_id' => 9,
            ],
            [
                'product_type_id' => 3,
                'trademark_id' => 10,
            ],
            [
                'product_type_id' => 1,
                'trademark_id' => 11,
            ],
            [
                'product_type_id' => 1,
                'trademark_id' => 12,
            ],
            [
                'product_type_id' => 1,
                'trademark_id' => 13,
            ],
            [
                'product_type_id' => 2,
                'trademark_id' => 14,
            ],
            [
                'product_type_id' => 2,
                'trademark_id' => 15,
            ],
        ]);
    }
}
