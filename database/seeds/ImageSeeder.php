<?php

use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('images')->insert([
            [
                'product_id' => 1,
                'link' => 'assets/img/product/Laptop-Dell-Inspiron-3467-i3-7100U/1.jpg'
            ],
            [
                'product_id' => 1,
                'link' => 'assets/img/product/Laptop-Dell-Inspiron-3467-i3-7100U/2.jpg'
            ],
            [
                'product_id' => 1,
                'link' => 'assets/img/product/Laptop-Dell-Inspiron-3467-i3-7100U/3.jpg'
            ],
            [
                'product_id' => 2,
                'link' => 'assets/img/product/Laptop-Dell-Inspiron-5379-i7-8550U/1.jpg'
            ],
            [
                'product_id' => 2,
                'link' => 'assets/img/product/Laptop-Dell-Inspiron-5379-i7-8550U/2.jpg'
            ],
            [
                'product_id' => 2,
                'link' => 'assets/img/product/Laptop-Dell-Inspiron-5379-i7-8550U/3.jpg'
            ],
            [
                'product_id' => 3,
                'link' => 'assets/img/product/Laptop-Apple-Macbook-Pro-Touch-MPXX2SA/1.jpg'
            ],
            [
                'product_id' => 3,
                'link' => 'assets/img/product/Laptop-Apple-Macbook-Pro-Touch-MPXX2SA/2.jpg'
            ],
            [
                'product_id' => 3,
                'link' => 'assets/img/product/Laptop-Apple-Macbook-Pro-Touch-MPXX2SA/3.jpg'
            ],
            [
                'product_id' => 4,
                'link' => 'assets/img/product/Laptop-Asus-S510UA-i3-7100U/1.jpg'
            ],
            [
                'product_id' => 4,
                'link' => 'assets/img/product/Laptop-Asus-S510UA-i3-7100U/2.jpg'
            ],
            [
                'product_id' => 4,
                'link' => 'assets/img/product/Laptop-Asus-S510UA-i3-7100U/3.jpg'
            ],
            [
                'product_id' => 5,
                'link' => 'assets/img/product/iPhone-X-256GB-Sliver/1.jpg'
            ],
            [
                'product_id' => 5,
                'link' => 'assets/img/product/iPhone-X-256GB-Sliver/2.jpg'
            ],
            [
                'product_id' => 5,
                'link' => 'assets/img/product/iPhone-X-256GB-Sliver/3.jpg'
            ],
            [
                'product_id' => 6,
                'link' => 'assets/img/product/Mobiistar-Prime-X-Max-2018/1.jpg'
            ],
            [
                'product_id' => 6,
                'link' => 'assets/img/product/Mobiistar-Prime-X-Max-2018/2.jpg'
            ],
            [
                'product_id' => 6,
                'link' => 'assets/img/product/Mobiistar-Prime-X-Max-2018/3.jpg'
            ],
            [
                'product_id' => 7,
                'link' => 'assets/img/product/Sony-Xperia-XZ2/1.jpg'
            ],
            [
                'product_id' => 7,
                'link' => 'assets/img/product/Sony-Xperia-XZ2/2.jpg'
            ],
            [
                'product_id' => 7,
                'link' => 'assets/img/product/Sony-Xperia-XZ2/3.jpg'
            ],
            [
                'product_id' => 8,
                'link' => 'assets/img/product/Nokia-7-plus/1.jpg'
            ],
            [
                'product_id' => 8,
                'link' => 'assets/img/product/Nokia-7-plus/2.jpg'
            ],
            [
                'product_id' => 8,
                'link' => 'assets/img/product/Nokia-7-plus/3.jpg'
            ]
        ]);
    }
}
