<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TblDonatur extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_donatur', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_donasi');
            $table->string('no_donasi',200)->nullable();
            $table->string('nama',200);
            $table->string('anonim',10);
            $table->string('no_telpon',200);
            $table->string('foto',200);
            $table->dateTime('tanggal');
            $table->bigInteger('jumlah_donasi');
            $table->string('metode',200);
            $table->text('doa')->nullable();
            $table->string('order_id',20);
            $table->string('payment_status',100);
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
        Schema::drop('tbl_donatur');
    }
}
