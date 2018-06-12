<?php

use Illuminate\Database\Seeder;

class ThuongHieuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('thuong_hieus')->insert([
            [
                'ten_thuong_hieu' => 'Dell'
            ],
            [
                'ten_thuong_hieu' => 'Asus'
            ],
            [
                'ten_thuong_hieu' => 'HP'
            ],
            [
                'ten_thuong_hieu' => 'Acer'
            ],
            [
                'ten_thuong_hieu' => 'Lenovo'
            ],
            [
                'ten_thuong_hieu' => 'LG'
            ],
        ]);
    }
}
