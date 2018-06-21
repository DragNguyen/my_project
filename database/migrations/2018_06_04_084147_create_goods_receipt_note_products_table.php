<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGoodsReceiptNoteProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods_receipt_note_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('goods_receipt_note_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->double('price');
            $table->integer('quantity');
            $table->integer('quantity_updated');
            $table->timestamps();

            $table->foreign('goods_receipt_note_id')->references('id')->on('goods_receipt_notes');
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
        Schema::dropIfExists('goods_receipt_note_products');
    }
}
