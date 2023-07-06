<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDataCabangsTable extends Migration
{
    public function up()
    {
        Schema::table('data_cabangs', function (Blueprint $table) {
            $table->unsignedBigInteger('kec')->nullable();
            $table->foreign('kec', 'district_fk_7597256')->references('id')->on('districts');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_7597264')->references('id')->on('teams');
        });
    }
}
