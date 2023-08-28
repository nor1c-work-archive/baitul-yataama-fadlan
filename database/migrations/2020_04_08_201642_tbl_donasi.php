<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblDonasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_donasi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('key',100);
            $table->text('subject');
            $table->string('gambar',200);
            $table->dateTime('tanggal');
            $table->dateTime('tanggal_berakhir');
            $table->string('tipe_batas_waktu',40);
            $table->bigInteger('target_dana');
            $table->bigInteger('dana_masuk');
            $table->text('cerita');
            $table->string('status',40);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tbl_donasi');
    }
}
