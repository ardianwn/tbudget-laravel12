<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Cek apakah tabel 'tourisms' sudah ada
        if (!Schema::hasTable('tourisms')) {
            Schema::create('tourisms', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('type');
                $table->text('description')->nullable();
                $table->string('address')->nullable();
                $table->decimal('latitude', 10, 7);
                $table->decimal('longitude', 10, 7);
                $table->decimal('entrance_fee', 10, 2)->default(0);
                $table->json('facilities')->nullable();
                $table->string('image')->nullable(); // Kolom image yang ditambahkan
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        // Cek apakah tabel 'tourisms' ada sebelum mencoba menghapusnya
        if (Schema::hasTable('tourisms')) {
            Schema::dropIfExists('tourisms');
        }
    }
};
