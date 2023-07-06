<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToKetuasTable extends Migration
{
    public function up()
    {
        Schema::table('ketuas', function (Blueprint $table) {
            $table->unsignedBigInteger('kontak_id')->nullable();
            $table->foreign('kontak_id', 'kontak_fk_7612598')->references('id')->on('kontaks');
            $table->unsignedBigInteger('team_id')->nullable();
            $table->foreign('team_id', 'team_fk_7596966')->references('id')->on('teams');
        });
    }
}
