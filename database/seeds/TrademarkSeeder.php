<?php

use Illuminate\Database\Seeder;

class TrademarkSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trademarks')->insert([
            [
                'name' => 'Dell'
            ],
            [
                'name' => 'Macbook'
            ],
            [
                'name' => 'Asus'
            ],
            [
                'name' => 'Iphone'
            ],
            [
                'name' => 'Mobiistar'
            ],
            [
                'name' => 'HTC'
            ],
            [
                'name' => 'Nokia'
            ],
            [
                'name' => 'Ipad'
            ],
            [
                'name' => 'Samsung'
            ],
            [
                'name' => 'Huawei'
            ],
            [
                'name' => 'MSI'
            ],
            [
                'name' => 'HP'
            ]
        ]);
    }
}
