<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CabangYayasan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cabang_yayasan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('nama_cabang');
            $table->text('alamat');
            $table->string('no_telp',30);
            $table->text('gambar');
            $table->string('cabang_utama',30);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cabang_yayasan');
    }
}
