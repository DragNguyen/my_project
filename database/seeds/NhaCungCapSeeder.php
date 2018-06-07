<?php

use Illuminate\Database\Seeder;

class NhaCungCapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('nha_cung_caps')->insert([
            [
                'ten_ncc' => 'Công ty TNHH Tin học Mai Hoàng',
                'dia_chi' => 'số 241 Phố Vọng, Hai Bà Trưng, Hà Nội',
                'so_dien_thoai' => '(04) 3.628 5868',
                'website' => 'http://maihoang.com.vn/'
            ],
            [
                'ten_ncc' => 'Công ty TNHH Kỹ Nghệ Phúc Anh',
                'dia_chi' => '15 Xã Đàn, Đống Đa, Hà Nội',
                'so_dien_thoai' => '(04) 35737383',
                'website' => 'https://www.phucanh.vn/'
            ],
            [
                'ten_ncc' => 'Công ty Cổ Phần Máy Tính Hà Nội - HANOICOMPUTER',
                'dia_chi' => '129 + 131 Lê Thanh Nghị, Đồng Tâm, Hai Bà Trưng, Hà nội',
                'so_dien_thoai' => '04. 36280886',
                'website' => 'www.hanoicomputer.vn'
            ],
            [
                'ten_ncc' => 'Công ty Cổ Phần Thế Giới Số Trần Anh',
                'dia_chi' => '1174 Đường Láng, Đống Đa, Hà Nội',
                'so_dien_thoai' => '1900 545 546',
                'website' => 'https://www.trananh.vn/'
            ],
            [
                'ten_ncc' => 'Công ty TNHH Máy Tính và Viễn Thông An Khang',
                'dia_chi' => 'số 210 Thái Hà, Trung Liệt, Đống Đa, Hà Nội',
                'so_dien_thoai' => '04 3537 9888',
                'website' => 'http://www.ankhang.vn/'
            ],
            [
                'ten_ncc' => 'Trung tâm tin học và ứng dụng công nghệ Gia Hưng',
                'dia_chi' => '61 Khương Trung cũ, Thanh xuân, Hà Nội',
                'so_dien_thoai' => '0463.275.789',
                'website' => 'http://giahung.vn/Home.html'
            ],
            [
                'ten_ncc' => 'Công ty TNHH Công Nghệ Thanh Long',
                'dia_chi' => 'Tổ 23, Yên Sở, Hoàng Mai, Hà Nội',
                'so_dien_thoai' => '0909 354 321',
                'website' => 'http://maytinhhanoi.com.vn/'
            ],
            [
                'ten_ncc' => 'Công ty TNHH Thương Mại Dịch vụ An Phát',
                'dia_chi' => 'số 269 Chùa Bộc, Trung Liệt, Đống Đa, Hà Nội',
                'so_dien_thoai' => '0904 316 386',
                'website' => 'http://www.anphatpc.com.vn/'
            ],
            [
                'ten_ncc' => 'Công Ty TNHH Máy Tính Hà Thành',
                'dia_chi' => '182 Lê Thanh Nghị, Đồng Tâm, Hai Bà Trưng, Hà Nội',
                'so_dien_thoai' => '047.303.1661',
                'website' => 'http://maytinhhathanh.com/'
            ],
        ]);
    }
}
