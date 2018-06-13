<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->dateTime('product_created_at')->default(date('Y-m-d H:i:s'));
            $table->dateTime('product_updated_at')->nullable();
            $table->string('avatar')->nullable();
            $table->integer('quantity')->default(0);
            $table->boolean('is_activated')->default(true);
            $table->string('describe', 255)->nullable();
            $table->integer('trademark_id')->unsigned();
            $table->integer('product_type_id')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
