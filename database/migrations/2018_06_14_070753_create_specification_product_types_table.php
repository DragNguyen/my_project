<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpecificationProductTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('specification_product_types', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('specification_id')->unsigned();
            $table->integer('product_type_id')->unsigned();
            $table->timestamps();

            $table->foreign('specification_id')->references('id')->on('specifications');
            $table->foreign('product_type_id')->references('id')->on('product_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('specification_product_types');
    }
}
