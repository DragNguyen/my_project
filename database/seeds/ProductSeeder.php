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
               'product_type_id' => 1,
               'trademark_id' => 1,
               'slug' => str_slug('Laptop Dell Inspiron 3467 i3 7100U')
           ],
            [
                'name' => 'Laptop Dell Vostro 3468 i3 6006U',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_id' => 1,
                'trademark_id' => 1,
                'slug' => str_slug('Laptop Dell Vostro 3468 i3 6006U')
            ],
            [
                'name' => 'Laptop Dell Vostro 3468 i5 7200U',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_id' => 1,
                'trademark_id' => 1,
                'slug' => str_slug('Laptop Dell Vostro 3468 i5 7200U')
            ],
            [
                'name' => 'Laptop Dell Inspiron 7570 i5 8250U',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_id' => 1,
                'trademark_id' => 1,
                'slug' => str_slug('Laptop Dell Inspiron 7570 i5 8250U')
            ],
            [
                'name' => 'Laptop Dell Inspiron 5379 i7 8550U',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_id' => 1,
                'trademark_id' => 1,
                'slug' => str_slug('Laptop Dell Inspiron 7570 i5 8250U')
            ],
            [
                'name' => 'Laptop Apple Macbook Air MQD32SA',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_id' => 1,
                'trademark_id' => 2,
                'slug' => str_slug('Laptop Dell Inspiron 7570 i5 8250U')
            ],
            [
                'name' => 'Máy tính nguyên bộ iMac 21.5 inch MMQA2SA',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_id' => 1,
                'trademark_id' => 2,
                'slug' => str_slug('Laptop Dell Inspiron 7570 i5 8250U')
            ],
            [
                'name' => 'Laptop Apple Macbook 12" MNYF2SA',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_id' => 1,
                'trademark_id' => 2,
                'slug' => str_slug('Laptop Dell Inspiron 7570 i5 8250U')
            ],
            [
                'name' => 'Laptop Apple Macbook Pro MPXT2SA',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_id' => 1,
                'trademark_id' => 2,
                'slug' => str_slug('Laptop Dell Inspiron 7570 i5 8250U')
            ],
            [
                'name' => 'Laptop Apple Macbook Pro Touch MPXX2SA',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_id' => 1,
                'trademark_id' => 2,
                'slug' => str_slug('Laptop Dell Inspiron 7570 i5 8250U')
            ],
            [
                'name' => 'Laptop Asus GL503GE i7 8750H',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_id' => 1,
                'trademark_id' => 3,
                'slug' => str_slug('Laptop Dell Inspiron 7570 i5 8250U')
            ],
            [
                'name' => 'Laptop Asus FX503VD i7 7700HQ',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_id' => 1,
                'trademark_id' => 3,
                'slug' => str_slug('Laptop Dell Inspiron 7570 i5 8250U')
            ],
            [
                'name' => 'Laptop Asus UX430UA i5 8250U',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_id' => 1,
                'trademark_id' => 3,
                'slug' => str_slug('Laptop Dell Inspiron 7570 i5 8250U')
            ],
            [
                'name' => 'Laptop Asus A540UP i5 7200U',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_id' => 1,
                'trademark_id' => 3,
                'slug' => str_slug('Laptop Dell Inspiron 7570 i5 8250U')
            ],
            [
                'name' => 'Laptop Asus S510UA i3 7100U',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_id' => 1,
                'trademark_id' => 3,
                'slug' => str_slug('Laptop Dell Inspiron 7570 i5 8250U')
            ],
            [
                'name' => 'Điện thoại iPhone X 256GB Sliver',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_id' => 2,
                'trademark_id' => 4,
                'slug' => str_slug('Laptop Dell Inspiron 7570 i5 8250U')
            ],
            [
                'name' => 'Điện thoại iPhone X 64GB Silver',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_id' => 2,
                'trademark_id' => 4,
                'slug' => str_slug('Laptop Dell Inspiron 7570 i5 8250U')
            ],
            [
                'name' => 'Điện thoại iPhone 8 Plus Red 256GB',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_id' => 2,
                'trademark_id' => 4,
                'slug' => str_slug('Laptop Dell Inspiron 7570 i5 8250U')
            ],
            [
                'name' => 'Điện thoại iPhone 8 256GB',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_id' => 2,
                'trademark_id' => 4,
                'slug' => str_slug('Laptop Dell Inspiron 7570 i5 8250U')
            ],
            [
                'name' => 'Điện thoại iPhone 8 Plus 64GB',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_id' => 2,
                'trademark_id' => 4,
                'slug' => str_slug('Laptop Dell Inspiron 7570 i5 8250U')
            ],
            [
                'name' => 'Điện thoại iPhone 7 Plus 128GB',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_id' => 2,
                'trademark_id' => 4,
                'slug' => str_slug('Laptop Dell Inspiron 7570 i5 8250U')
            ],
            [
                'name' => 'Điện thoại iPhone 7 Plus 32GB',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_id' => 2,
                'trademark_id' => 4,
                'slug' => str_slug('Laptop Dell Inspiron 7570 i5 8250U')
            ],
            [
                'name' => 'Điện thoại iPhone 6s Plus 32GB',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_id' => 2,
                'trademark_id' => 4,
                'slug' => str_slug('Laptop Dell Inspiron 7570 i5 8250U')
            ],
            [
                'name' => 'Điện thoại iPhone 6s 32GB',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_id' => 2,
                'trademark_id' => 4,
                'slug' => str_slug('Laptop Dell Inspiron 7570 i5 8250U')
            ],
            [
                'name' => 'Điện thoại Mobiistar Prime X Max 2018',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_id' => 2,
                'trademark_id' => 5,
                'slug' => str_slug('Laptop Dell Inspiron 7570 i5 8250U')
            ],
            [
                'name' => 'Điện thoại Mobiistar Zumbo S2 Dual',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_id' => 2,
                'trademark_id' => 5,
                'slug' => str_slug('Laptop Dell Inspiron 7570 i5 8250U')
            ],
            [
                'name' => 'Điện thoại Mobiistar E Selfie',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_id' => 2,
                'trademark_id' => 5,
                'slug' => str_slug('Laptop Dell Inspiron 7570 i5 8250U')
            ],
            [
                'name' => 'Điện thoại Mobiistar Lai Zumbo S',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_id' => 2,
                'trademark_id' => 5,
                'slug' => str_slug('Laptop Dell Inspiron 7570 i5 8250U')
            ],
            [
                'name' => 'Điện thoại Sony Xperia XZ2',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_id' => 2,
                'trademark_id' => 6,
                'slug' => str_slug('Laptop Dell Inspiron 7570 i5 8250U')
            ],
            [
                'name' => 'Điện thoại Sony Xperia XZ Dual',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_id' => 2,
                'trademark_id' => 6,
                'slug' => str_slug('Laptop Dell Inspiron 7570 i5 8250U')
            ],
            [
                'name' => 'Điện thoại Sony Xperia XA1 Ultra',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_id' => 2,
                'trademark_id' => 6,
                'slug' => str_slug('Laptop Dell Inspiron 7570 i5 8250U')
            ],
            [
                'name' => 'Điện thoại Sony Xperia X',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_id' => 2,
                'trademark_id' => 6,
                'slug' => str_slug('Laptop Dell Inspiron 7570 i5 8250U')
            ],
            [
                'name' => 'Điện thoại Sony Xperia L2',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_id' => 2,
                'trademark_id' => 6,
                'slug' => str_slug('Laptop Dell Inspiron 7570 i5 8250U')
            ],
            [
                'name' => 'Điện thoại Sony Xperia L1',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_id' => 2,
                'trademark_id' => 6,
                'slug' => str_slug('Laptop Dell Inspiron 7570 i5 8250U')
            ],
            [
                'name' => 'Điện thoại Nokia 7 plus',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_id' => 2,
                'trademark_id' => 7,
                'slug' => str_slug('Laptop Dell Inspiron 7570 i5 8250U')
            ],
            [
                'name' => 'Điện thoại Nokia 6 new 64GB',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_id' => 2,
                'trademark_id' => 7,
                'slug' => str_slug('Laptop Dell Inspiron 7570 i5 8250U')
            ],
            [
                'name' => 'Điện thoại Nokia 6 new',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_id' => 2,
                'trademark_id' => 7,
                'slug' => str_slug('Laptop Dell Inspiron 7570 i5 8250U')
            ],
            [
                'name' => 'Điện thoại Nokia 6',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_id' => 2,
                'trademark_id' => 7,
                'slug' => str_slug('Laptop Dell Inspiron 7570 i5 8250U')
            ],
            [
                'name' => 'Điện thoại Nokia 5',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_id' => 2,
                'trademark_id' => 7,
                'slug' => str_slug('Laptop Dell Inspiron 7570 i5 8250U')
            ],
            [
                'name' => 'Điện thoại Nokia 3',
                'product_created_at' => date('Y-m-d H:i:s'),
                'product_type_id' => 2,
                'trademark_id' => 7,
                'slug' => str_slug('Laptop Dell Inspiron 7570 i5 8250U')
            ]
        ]);
    }
}
