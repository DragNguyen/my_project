<?php

use Illuminate\Database\Seeder;

class LoaiSPSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('loai_san_phams')->insert([
            [
                'ten_loai' => 'Laptop'
            ],
            [
                'ten_loai' => 'Điện thoại'
            ]
        ]);
    }
}
