<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDataDaerahsTable extends Migration
{
    public function up()
    {
        Schema::table('data_daerahs', function (Blueprint $table) {
            $table->unsignedBigInteger('regency_id')->nullable();
            $table->foreign('regency_id', 'regency_fk_7597254')->references('id')->on('regencies');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_7590584')->references('id')->on('teams');
        });
    }
}
