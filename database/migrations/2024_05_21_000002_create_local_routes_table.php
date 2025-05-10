<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Cek apakah tabel 'local_routes' sudah ada
        if (!Schema::hasTable('local_routes')) {
            Schema::create('local_routes', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('type');
                $table->integer('price');
                $table->string('frequency');
                $table->json('coordinates');
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        // Cek apakah tabel 'local_routes' ada sebelum mencoba menghapusnya
        if (Schema::hasTable('local_routes')) {
            Schema::dropIfExists('local_routes');
        }
    }
};
