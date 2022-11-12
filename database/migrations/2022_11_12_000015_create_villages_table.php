<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVillagesTable extends Migration
{
    public function up()
    {
        Schema::create('villages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_district')->nullable();
            $table->string('id_village')->nullable();
            $table->string('village_name')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
