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
                'name' => 'Laptop',
                'icon' => 'ui laptop icon',
                'slug' => str_slug('Laptop')
            ],
            [
                'name' => 'Điện thoại',
                'icon' => 'ui mobile icon',
                'slug' => str_slug('Điện thoại')
            ],
            [
                'name' => 'Máy tính bảng',
                'icon' => 'ui tablet icon',
                'slug' => str_slug('Máy tính bảng')
            ]
        ]);
    }
}
