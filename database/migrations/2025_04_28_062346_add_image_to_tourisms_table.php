<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToTourismsTable extends Migration
{
    public function up()
    {
        Schema::table('tourisms', function (Blueprint $table) {
            $table->string('image')->nullable();  // Menambahkan kolom image
        });
    }

    public function down()
    {
        Schema::table('tourisms', function (Blueprint $table) {
            $table->dropColumn('image');  // Membatalkan penambahan kolom image jika migrasi di-rollback
        });
    }
}
