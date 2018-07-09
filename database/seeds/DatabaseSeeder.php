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
             PriceSeeder::class,
             GoodsReceiptNoteSeeder::class,
             GoodsReceiptNoteProductSeeder::class,
             GoodsReceiptNoteCostSeeder::class,
             ImageSeeder::class,
             QuantitySeeder::class,
             CustomerSeeder::class,
             ShoppingCartSeeder::class,
             SpecificationSeeder::class,
             OrderSeeder::class,
             OrderProductSeeder::class,
             OrderCostSeeder::class,
         ]);
    }
}
