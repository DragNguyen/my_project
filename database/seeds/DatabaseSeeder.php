<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
             AdminSeeder::class,
             SupplierSeeder::class,
             ProductTypeSeeder::class,
             TrademarkSeeder::class,
             ProductTypeTrademarkSeeder::class,
             ProductSeeder::class,
             ImageSeeder::class,
             PriceSeeder::class,
             QuantitySeeder::class,
             CustomerSeeder::class,
             ShoppingCartSeeder::class,
             SpecificationSeeder::class,
             GoodsReceiptNoteSeeder::class,
             GoodsReceiptNoteProductSeeder::class,
         ]);
    }
}
