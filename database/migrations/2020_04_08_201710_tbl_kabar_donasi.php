<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblKabarDonasi extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('tbl_kabar_donasi', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_donasi');
            $table->string('tipe_kabar',100);
            $table->string('subject',200);
            $table->text('isi');
            $table->dateTime('tanggal');
            $table->bigInteger('jumlah_penarikan')->default(0);
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
        Schema::drop('tbl_kabar_donasi');
    }
}
