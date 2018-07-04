<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    private $laptops = array(
        'dell' => array(
            '1' => '11290000',
            '2' => '11290000',
            '3' => '11390000',
            '4' => '11690000',
            '5' => '11900000',
            '6' => '12190000',
            '7' => '12190000',
            '8' => '14900000',
            '9' => '20990000',
            '10' => '22990000',
            '11' => '24490000',
            '12' => '26990000',
            '13' => '29990000'
        ),
        'mac' => array(
            '14' => '19990000',
            '15' => '24990000',
            '16' => '28990000',
            '17' => '33990000',
            '18' => '33990000',
            '19' => '38990000',
            '20' => '44990000',
            '21' => '44990000',
            '22' => '59990000',
        ),
        'asus' => array(
            '23' => '29990000',
            '24' => '24490000',
            '25' => '21990000',
            '26' => '17290000',
            '27' => '16290000',
            '28' => '14290000',
            '29' => '13990000',
            '30' => '13490000',
            '31' => '13290000',
        )
    );

    private $smartPhones = array(
        'iphone' => array(
            '32' => '34790000',
            '33' => '29990000',
            '34' => '28790000',
            '35' => '25790000',
            '36' => '23990000',
            '37' => '22990000',
            '38' => '19990000',
            '39' => '12990000',
            '40' => '12490000',
        ),
        'mobiistar' => array(
            '41' => '5990000',
            '42' => '3290000',
            '43' => '2990000',
            '44' => '2590000',
        ),
        'htc' => array(
            '45' => '19990000',
            '46' => '11990000',
            '47' => '9990000',
            '48' => '6990000',
            '49' => '6990000',
            '50' => '4990000',
            '51' => '3590000',
        ),
        'nokia' => array(
            '52' => '8990000',
            '53' => '6990000',
            '54' => '5990000',
            '55' => '4990000',
            '56' => '3860000',
            '57' => '2790000'
        )
    );

    public function run()
    {
        DB::table('products')->insert([
           [
               'name' => 'Laptop Dell Inspiron 3467 i3 7100U',
               'product_created_at' => date('Y-m-d H:i:s'),
               'product_type_trademark_id' => 1,
               'avatar' => 'assets/img/product/Laptop-Dell-Inspiron-3467-i3-7100U/avatar.png',
               'slug' => str_slug('Laptop Dell Inspiron 3467 i3 7100U')
           ],
            [
                'name' => 'Laptop Dell Inspiron 5379 i7 8550U',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_trademark_id' => 1,
                'avatar' => 'assets/img/product/Laptop-Dell-Inspiron-5379-i7-8550U/avatar.jpg',
                'slug' => str_slug('Laptop Dell Inspiron 5379 i7 8550U')
            ],
            [
                'name' => 'Laptop Apple Macbook Pro Touch MPXX2SA',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_trademark_id' => 2,
                'avatar' => 'assets/img/product/Laptop-Apple-Macbook-Pro-Touch-MPXX2SA/avatar.jpg',
                'slug' => str_slug('Laptop Apple Macbook Pro Touch MPXX2SA')
            ],
            [
                'name' => 'Laptop Asus S510UA i3 7100U',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_trademark_id' => 3,
                'avatar' => 'assets/img/product/Laptop-Asus-S510UA-i3-7100U/avatar.jpg',
                'slug' => str_slug('Laptop Asus S510UA i3 7100U')
            ],
            [
                'name' => 'Điện thoại iPhone X 256GB Sliver',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_trademark_id' => 7,
                'avatar' => 'assets/img/product/iPhone-X-256GB-Sliver/avatar.png',
                'slug' => str_slug('Điện thoại iPhone X 256GB Sliver')
            ],
            [
                'name' => 'Điện thoại Mobiistar Prime X Max 2018',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_trademark_id' => 8,
                'avatar' => 'assets/img/product/Mobiistar-Prime-X-Max-2018/avatar.png',
                'slug' => str_slug('Điện thoại Mobiistar Prime X Max 2018')
            ],
            [
                'name' => 'Điện thoại Sony Xperia XZ2',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_trademark_id' => 9,
                'avatar' => 'assets/img/product/Sony-Xperia-XZ2/avatar.png',
                'slug' => str_slug('Điện thoại Sony Xperia XZ2')
            ],
            [
                'name' => 'Điện thoại Nokia 7 plus',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_trademark_id' => 10,
                'avatar' => 'assets/img/product/Nokia-7-plus/avatar.png',
                'slug' => str_slug('Điện thoại Nokia 7 plus')
            ]
        ]);
    }
}
