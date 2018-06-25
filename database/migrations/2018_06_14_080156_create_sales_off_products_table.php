<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesOffProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_off_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sales_off_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->timestamps();

            $table->foreign('sales_off_id')->references('id')->on('sales_offs')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_off_products');
    }
}
