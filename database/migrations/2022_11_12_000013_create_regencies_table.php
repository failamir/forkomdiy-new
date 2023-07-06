<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegenciesTable extends Migration
{
    public function up()
    {
        Schema::create('regencies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('id_province')->nullable();
            $table->string('id_regency')->nullable();
            $table->string('regency_name')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
