<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('transportations', function (Blueprint $table) {
            $table->json('coordinates')->nullable()->after('departure_times');
        });
    }

    public function down()
    {
        Schema::table('transportations', function (Blueprint $table) {
            $table->dropColumn('coordinates');
        });
    }
}; 
 
 