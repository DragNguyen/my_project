<?php

use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('suppliers')->insert([
            [
                'name' => 'Công ty TNHH Tin học Mai Hoàng',
                'address' => 'số 241 Phố Vọng, Hai Bà Trưng, Hà Nội',
                'phone' => '(04) 3.628 5868',
                'website' => 'http://maihoang.com.vn/'
            ],
            [
                'name' => 'Công ty TNHH Kỹ Nghệ Phúc Anh',
                'address' => '15 Xã Đàn, Đống Đa, Hà Nội',
                'phone' => '(04) 35737383',
                'website' => 'https://www.phucanh.vn/'
            ],
            [
                'name' => 'Công ty Cổ Phần Máy Tính Hà Nội - HANOICOMPUTER',
                'address' => '129 + 131 Lê Thanh Nghị, Đồng Tâm, Hai Bà Trưng, Hà nội',
                'phone' => '04. 36280886',
                'website' => 'www.hanoicomputer.vn'
            ],
            [
                'name' => 'Công ty Cổ Phần Thế Giới Số Trần Anh',
                'address' => '1174 Đường Láng, Đống Đa, Hà Nội',
                'phone' => '1900 545 546',
                'website' => 'https://www.trananh.vn/'
            ],
            [
                'name' => 'Công ty TNHH Máy Tính và Viễn Thông An Khang',
                'address' => 'số 210 Thái Hà, Trung Liệt, Đống Đa, Hà Nội',
                'phone' => '04 3537 9888',
                'website' => 'http://www.ankhang.vn/'
            ],
            [
                'name' => 'Trung tâm tin học và ứng dụng công nghệ Gia Hưng',
                'address' => '61 Khương Trung cũ, Thanh xuân, Hà Nội',
                'phone' => '0463.275.789',
                'website' => 'http://giahung.vn/Home.html'
            ],
            [
                'name' => 'Công ty TNHH Công Nghệ Thanh Long',
                'address' => 'Tổ 23, Yên Sở, Hoàng Mai, Hà Nội',
                'phone' => '0909 354 321',
                'website' => 'http://maytinhhanoi.com.vn/'
            ],
            [
                'name' => 'Công ty TNHH Thương Mại Dịch vụ An Phát',
                'address' => 'số 269 Chùa Bộc, Trung Liệt, Đống Đa, Hà Nội',
                'phone' => '0904 316 386',
                'website' => 'http://www.anphatpc.com.vn/'
            ],
            [
                'name' => 'Công Ty TNHH Máy Tính Hà Thành',
                'address' => '182 Lê Thanh Nghị, Đồng Tâm, Hai Bà Trưng, Hà Nội',
                'phone' => '047.303.1661',
                'website' => 'http://maytinhhathanh.com/'
            ],
        ]);
    }
}
