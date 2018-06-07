<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSanPhamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('san_phams', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ten_san_pham', 100);
            $table->date('ngay_tao');
            $table->date('ngay_cap_nhat');
            $table->string('anh_dai_dien');
            $table->string('mo_ta', 255);
            $table->integer('gia_tien_id')->unsigned();
            $table->integer('thuong_hieu_id')->unsigned();
            $table->integer('loai_san_pham_id')->unsigned();
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
        Schema::dropIfExists('san_phams');
    }
}
