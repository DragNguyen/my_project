<?php

use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            [
                'name' => 'Nguyễn Nguyễn',
                'email' => 'nguyennguyencp@gmail.com',
                'password' => bcrypt('635982359'),
                'phone' => '01628446973',
                'address' => 'Trên mặt đất / kế nhà tui'
            ]
        ]);
    }
}
