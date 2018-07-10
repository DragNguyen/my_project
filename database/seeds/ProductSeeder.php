<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        DB::table('products')->insert([
           [
               'name' => 'Dell Inspiron 3467 i3 7100U',
               'product_created_at' => date('Y-m-d H:i:s'),
               'product_type_trademark_id' => 1,
               'avatar' => 'assets/img/product/Dell-Inspiron-3467-i3-7100U/avatar.png',
               'slug' => str_slug('Laptop Dell Inspiron 3467 i3 7100U')
           ],
            [
                'name' => 'Dell Inspiron 5379 i7 8550U',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_trademark_id' => 1,
                'avatar' => 'assets/img/product/Dell-Inspiron-5379-i7-8550U/avatar.jpg',
                'slug' => str_slug('Laptop Dell Inspiron 5379 i7 8550U')
            ],
            [
                'name' => 'Apple Macbook Pro Touch MPXX2SA',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_trademark_id' => 2,
                'avatar' => 'assets/img/product/Apple-Macbook-Pro-Touch-MPXX2SA/avatar.jpg',
                'slug' => str_slug('Laptop Apple Macbook Pro Touch MPXX2SA')
            ],
            [
                'name' => 'Asus S510UA i3 7100U',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_trademark_id' => 3,
                'avatar' => 'assets/img/product/Asus-S510UA-i3-7100U/avatar.jpg',
                'slug' => str_slug('Laptop Asus S510UA i3 7100U')
            ],
            [
                'name' => 'iPhone X 256GB Sliver',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_trademark_id' => 7,
                'avatar' => 'assets/img/product/iPhone-X-256GB-Sliver/avatar.png',
                'slug' => str_slug('iPhone X 256GB Sliver')
            ],
            [
                'name' => 'Mobiistar Prime X Max 2018',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_trademark_id' => 8,
                'avatar' => 'assets/img/product/Mobiistar-Prime-X-Max-2018/avatar.png',
                'slug' => str_slug('Mobiistar Prime X Max 2018')
            ],
            [
                'name' => 'Sony Xperia XZ2',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_trademark_id' => 9,
                'avatar' => 'assets/img/product/Sony-Xperia-XZ2/avatar.png',
                'slug' => str_slug('Sony Xperia XZ2')
            ],
            [
                'name' => 'Nokia 7 plus',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_trademark_id' => 10,
                'avatar' => 'assets/img/product/Nokia-7-plus/avatar.png',
                'slug' => str_slug('Nokia 7 plus')
            ],
            [
                'name' => 'iPad Pro 10.5 inch Wifi 64GB (2017)',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_trademark_id' => 11,
                'avatar' => 'assets/img/product/iPad-Pro-105-inch-Wifi-64GB-2017/avatar.png',
                'slug' => str_slug('iPad Pro 10.5 inch Wifi 64GB (2017)')
            ],
            [
                'name' => 'iPad Wifi Cellular 128GB (2018)',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_trademark_id' => 11,
                'avatar' => 'assets/img/product/iPad-Wifi-Cellular-128GB-2018/avatar.png',
                'slug' => str_slug('iPad Wifi Cellular 128GB (2018)')
            ],
            [
                'name' => 'iPad Mini 4 Wifi 128GB',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_trademark_id' => 11,
                'avatar' => 'assets/img/product/iPad-Mini-4-Wifi-128GB/avatar.png',
                'slug' => str_slug('iPad Mini 4 Wifi 128GB')
            ],
            [
                'name' => 'Samsung Galaxy Tab A6 10.1 Spen',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_trademark_id' => 12,
                'avatar' => 'assets/img/product/Samsung-Galaxy-Tab-A6-101-Spen/avatar.png',
                'slug' => str_slug('Samsung Galaxy Tab A6 10.1 Spen')
            ],
            [
                'name' => 'Huawei MediaPad M3 8.0 (2017)',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_trademark_id' => 13,
                'avatar' => 'assets/img/product/Huawei-MediaPad-M3-80-2017/avatar.png',
                'slug' => str_slug('Huawei MediaPad M3 8.0 (2017)')
            ],
            [
                'name' => 'Huawei MediaPad T3 10 (2017)',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_trademark_id' => 13,
                'avatar' => 'assets/img/product/Huawei-MediaPad-T3-10-2017/avatar.png',
                'slug' => str_slug('Huawei MediaPad T3 10 (2017)')
            ],
            [
                'name' => 'Dell Inspiron 7373 i7 8550U',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_trademark_id' => 1,
                'avatar' => 'assets/img/product/Dell-Inspiron-7373/avatar.jpg',
                'slug' => str_slug('Dell Inspiron 7373 i7 8550U')
            ],
            [
                'name' => 'Dell Inspiron 7570 i5 8250U',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_trademark_id' => 1,
                'avatar' => 'assets/img/product/Dell-Inspiron-7570/avatar.jpg',
                'slug' => str_slug('Dell Inspiron 7570 i5 8250U')
            ],
            [
                'name' => 'HP Envy 13 ad160TU i7 8550U',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_trademark_id' => 15,
                'avatar' => 'assets/img/product/HP-Envy-13-ad160TU-i7-8550U/avatar.jpg',
                'slug' => str_slug('HP Envy 13 ad160TU i7 8550U')
            ],
            [
                'name' => 'LG Gram 14Z970-G.AH52A5',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_trademark_id' => 16,
                'avatar' => 'assets/img/product/LG-Gram-14Z970-G-AH52A5/avatar.jpg',
                'slug' => str_slug('LG Gram 14Z970-G.AH52A5')
            ],
            [
                'name' => 'Asus GL503GE i7 8750H',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_trademark_id' => 3,
                'avatar' => 'assets/img/product/Asus-GL503GE-i7-8750H/avatar.jpg',
                'slug' => str_slug('Asus GL503GE i7 8750H')
            ],
            [
                'name' => 'HP EliteBook X360 1030 G2 i5 7200U',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_trademark_id' => 15,
                'avatar' => 'assets/img/product/HP-EliteBook-X360-1030-G2-i5-7200U/avatar.jpg',
                'slug' => str_slug('HP EliteBook X360 1030 G2 i5 7200U')
            ],
            [
                'name' => 'Samsung Galaxy S9+ 128GB Hoàng Kim',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_trademark_id' => 12,
                'avatar' => 'assets/img/product/Samsung-Galaxy-S9/avatar.png',
                'slug' => str_slug('Samsung Galaxy S9+ 128GB Hoàng Kim')
            ],
            [
                'name' => 'Samsung Galaxy Note 8',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_trademark_id' => 12,
                'avatar' => 'assets/img/product/Samsung-Galaxy-Note-8/avatar.png',
                'slug' => str_slug('Samsung Galaxy Note 8')
            ],
            [
                'name' => 'Huawei P20 Pro',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_trademark_id' => 13,
                'avatar' => 'assets/img/product/Huawei-P20-Pro/avatar.png',
                'slug' => str_slug('Huawei P20 Pro')
            ],
            [
                'name' => 'Sony Xperia XZ1',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_trademark_id' => 9,
                'avatar' => 'assets/img/product/Sony-Xperia-XZ1/avatar.png',
                'slug' => str_slug('Sony Xperia XZ1')
            ],
            [
                'name' => 'OPPO F7 128GB',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_trademark_id' => 17,
                'avatar' => 'assets/img/product/OPPO-F7-128GB/avatar.png',
                'slug' => str_slug('OPPO F7 128GB')
            ],
            [
                'name' => 'Mobell Tab 8 Pro',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_trademark_id' => 18,
                'avatar' => 'assets/img/product/Mobell-Tab 8-Pro/avatar.png',
                'slug' => str_slug('Mobell Tab 8 Pro')
            ],
            [
                'name' => 'Huawei MediaPad T1 8.0',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_trademark_id' => 13,
                'avatar' => 'assets/img/product/Huawei-MediaPad-T1-80/avatar.png',
                'slug' => str_slug('Huawei MediaPad T1 8.0')
            ],
            [
                'name' => 'iPad Pro 10.5 inch Wifi Cellular 64GB (2017)',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_trademark_id' => 11,
                'avatar' => 'assets/img/product/iPad-Pro-105-inch-Wifi-Cellular-64GB/avatar.png',
                'slug' => str_slug('iPad Pro 10.5 inch Wifi Cellular 64GB (2017)')
            ],
        ]);
    }
}
