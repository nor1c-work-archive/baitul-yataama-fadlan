<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SliderGambar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('slider_gambar', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('image');
            $table->text('teks');
            $table->date('create_at');
            $table->string('status',30);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('slider_gambar');
    }
}
