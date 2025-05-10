<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('transportations')) {
        Schema::create('transportations', function (Blueprint $table) {
            $table->id();
            $table->string('route_name');
            $table->string('type');
            $table->integer('price');
            $table->integer('duration_minutes');
            $table->json('departure_times');
            $table->timestamps();
        });
    }}

    public function down()
    {
        Schema::dropIfExists('transportations');
    }
}; 