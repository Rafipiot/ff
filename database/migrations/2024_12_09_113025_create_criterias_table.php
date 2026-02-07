<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('criterias', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->float('bobot');
            $table->enum('tipe', ['benefit', 'cost']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('criterias');
    }
};