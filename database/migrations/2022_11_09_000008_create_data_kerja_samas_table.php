<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataKerjaSamasTable extends Migration
{
    public function up()
    {
        Schema::create('data_kerja_samas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_stakeholder')->nullable();
            $table->string('jangkauan_kerjasama')->nullable();
            $table->string('jenis_kerjasama')->nullable();
            $table->date('mulai_kerjasama')->nullable();
            $table->string('frekuensi_kerjasama')->nullable();
            $table->string('no_hp_wa_lembaga')->nullable();
            $table->string('kontak_di_lembaga')->nullable();
            $table->string('no_hp_wa_stakeholder')->nullable();
            $table->string('nama_lembaga_kerjasama')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
