<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataLembagasTable extends Migration
{
    public function up()
    {
        Schema::create('data_lembagas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nama_lembaga')->nullable();
            $table->string('singkatan')->nullable();
            $table->string('sekretariat_wilayah')->nullable();
            $table->string('website')->nullable();
            $table->string('email')->nullable();
            $table->string('telp')->nullable();
            $table->string('whats_app')->nullable();
            $table->string('lingkup_kegiatan')->nullable();
            $table->integer('jumlah_anggota')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
