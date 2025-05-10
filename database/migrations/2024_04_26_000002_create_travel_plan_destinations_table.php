<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Cek apakah tabel sudah ada sebelum mencoba membuatnya
        if (!Schema::hasTable('travel_plan_destinations')) {
            Schema::create('travel_plan_destinations', function (Blueprint $table) {
                $table->id();
                $table->foreignId('travel_plan_id')->constrained()->onDelete('cascade');
                $table->foreignId('tourism_id')->constrained()->onDelete('cascade');
                $table->integer('order');
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        // Cek apakah tabel ada sebelum mencoba menghapusnya
        if (Schema::hasTable('travel_plan_destinations')) {
            Schema::dropIfExists('travel_plan_destinations');
        }
    }
};
