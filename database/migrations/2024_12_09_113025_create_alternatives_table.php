<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('alternatives', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('jenis_kelamin');
            $table->unsignedInteger('lama_bekerja');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('alternatives');
    }
};