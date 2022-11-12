<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDataLembagasTable extends Migration
{
    public function up()
    {
        Schema::table('data_lembagas', function (Blueprint $table) {
            $table->unsignedBigInteger('ketua_id')->nullable();
            $table->foreign('ketua_id', 'ketua_fk_7597215')->references('id')->on('ketuas');
            $table->unsignedBigInteger('perizinan_id')->nullable();
            $table->foreign('perizinan_id', 'perizinan_fk_7597216')->references('id')->on('perizinans');
            $table->unsignedBigInteger('provinsi_id')->nullable();
            $table->foreign('provinsi_id', 'provinsi_fk_7597253')->references('id')->on('provinces');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_7590376')->references('id')->on('teams');
        });
    }
}
