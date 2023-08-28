<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TentangYayasan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tentang_yayasan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('tentang');
            $table->text('visi');
            $table->text('misi');
            $table->text('image');
            $table->string('facebook',200);
            $table->string('instagram',200);
            $table->string('email',40);
            $table->string('youtube',200);
            $table->string('twitter',200);
            $table->string('whatsapp',40);
            $table->string('no_telfon',200);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tentang_yayasan');
    }
}
