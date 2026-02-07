<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('alternatives', function (Blueprint $table) {
            $table->string('posisi')->default('kasir')->after('lama_bekerja');
        });
    }

    public function down()
    {
        Schema::table('alternatives', function (Blueprint $table) {
            $table->dropColumn('posisi');
        });
    }
};
