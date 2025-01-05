<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tempat', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('alamat', 480)->nullable(); // Kolom alamat bisa null
            $table->enum('status', ['tersedia', 'sedang digunakan'])->default('tersedia'); // Kolom status enum dengan default "tersedia"
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tempat');
    }
};