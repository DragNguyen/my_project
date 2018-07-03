<?php

use Illuminate\Database\Seeder;

class SpecificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specifications')->insert([
            [
                'name' => 'CPU'
            ],
            [
                'name' => 'RAM'
            ],
            [
                'name' => 'Ổ cứng'
            ],
            [
                'name' => 'Màn hình'
            ],
            [
                'name' => 'Card màn hình'
            ],
            [
                'name' => 'Cổng kết nối'
            ],
            [
                'name' => 'Hệ điều hành'
            ],
            [
                'name' => 'Kích thước'
            ],
            [
                'name' => 'Camera sau'
            ],
            [
                'name' => 'Camera trước'
            ],
            [
                'name' => 'Bộ nhớ trong'
            ],
            [
                'name' => 'Thẻ nhớ'
            ],
            [
                'name' => 'Thẻ sim'
            ]
        ]);
    }
}
