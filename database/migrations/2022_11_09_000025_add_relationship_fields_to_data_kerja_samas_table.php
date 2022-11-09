<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToDataKerjaSamasTable extends Migration
{
    public function up()
    {
        Schema::table('data_kerja_samas', function (Blueprint $table) {
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_7590393')->references('id')->on('teams');
        });
    }
}
