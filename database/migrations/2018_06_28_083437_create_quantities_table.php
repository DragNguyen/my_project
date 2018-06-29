<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuantitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quantities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('oldQuantity')->default(0);
            $table->integer('quantity')->default(0);
            $table->integer('quantity_changed')->default(0);
            // 0 - created product
            // 1/-1 - order/cancel order
            // 2/-2 - created goods receipt note/ changed goods receipt note
            // -3 - destroy goods receipt note
            $table->tinyInteger('event')->default(0);
            $table->dateTime('quantity_updated_at');
            $table->integer('product_id')->unsigned();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quantities');
    }
}
