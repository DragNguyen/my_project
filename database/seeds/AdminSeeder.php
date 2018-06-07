<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
           'name' => 'Nguyễn Đình Trọng',
           'email' => 'nguyentrongcp@gmail.com',
           'username' => 'nguyentrongcp',
           'password' => bcrypt('635982359'),
           'phone' => '01639883047',
        ]);
    }
}
