<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerizinansTable extends Migration
{
    public function up()
    {
        Schema::create('perizinans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('instansi_penerbit')->nullable();
            $table->string('nomor_izin')->nullable();
            $table->string('nama_izin')->nullable();
            $table->date('tanggal_dikeluarkan')->nullable();
            $table->string('berlaku_sampai')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
