<?php

use Illuminate\Database\Seeder;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $prices = array(
            '1' => '11290000',
            '2' => '24490000',
            '3' => '44990000',
            '4' => '13290000',
            '5' => '34790000',
            '6' => '4990000',
            '7' => '19990000',
            '8' => '9990000'
        );
        $rows = [];
        for ($i=1; $i <= count($prices); $i++) {
            $rows[] = [
                'price' => $prices[$i],
                'product_id' => $i,
                'price_updated_at' => date('Y-m-d H:i:s')
            ];
        }
        DB::table('prices')->insert($rows);
    }
}
