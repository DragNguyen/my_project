<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesOffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_offs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100);
            $table->integer('value');
            $table->date('begin_at');
            $table->date('end_at');
            $table->integer('sales_off_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('sales_off_id')->references('id')->on('sales_offs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_offs');
    }
}
