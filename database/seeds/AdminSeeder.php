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
           [
               'name' => 'Nguyễn Đình Trọng',
               'email' => 'nguyentrongcp@gmail.com',
               'password' => bcrypt('635982359'),
               'phone' => '01639883047',
               'gender' => 1,
               'role' => 0
           ],
            [
                'name' => 'Nguyễn Văn Lộc',
                'email' => 'nguyenloc@gmail.com',
                'password' => bcrypt('635982359'),
                'phone' => '01634224567',
                'gender' => 1,
                'role' => 1
            ],
            [
                'name' => 'Phạm hoài An',
                'email' => 'phaman@gmail.com',
                'password' => bcrypt('635982359'),
                'phone' => '01639094836',
                'gender' => 1,
                'role' => 1
            ],
            [
                'name' => 'Nguyễn Tấn Phát',
                'email' => 'nguyenphat@gmail.com',
                'password' => bcrypt('635982359'),
                'phone' => '01234556204',
                'gender' => 1,
                'role' => 1
            ],
        ]);
    }
}
