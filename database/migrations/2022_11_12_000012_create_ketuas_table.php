<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKetuasTable extends Migration
{
    public function up()
    {
        Schema::create('ketuas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('periode')->nullable();
            $table->string('name')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
