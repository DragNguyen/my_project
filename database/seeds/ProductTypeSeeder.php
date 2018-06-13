<?php

use Illuminate\Database\Seeder;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_types')->insert([
            [
                'name' => 'Laptop'
            ],
            [
                'name' => 'Điện thoại'
            ]
        ]);
    }
}
