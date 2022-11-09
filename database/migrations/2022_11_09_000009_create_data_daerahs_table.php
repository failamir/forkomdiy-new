<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataDaerahsTable extends Migration
{
    public function up()
    {
        Schema::create('data_daerahs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_ketua')->nullable();
            $table->string('kontak_hp_wa')->nullable();
            $table->integer('jumlah_anggota')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
