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
            $table->dateTime('ngay_tao')->default(date('Y-m-d H:i:s'));
            $table->dateTime('ngay_cap_nhat')->nullable();
            $table->string('anh_dai_dien')->nullable();
            $table->integer('so_luong')->default(0);
            $table->boolean('dang_ban')->default(true);
            $table->string('mo_ta', 255)->nullable();
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
