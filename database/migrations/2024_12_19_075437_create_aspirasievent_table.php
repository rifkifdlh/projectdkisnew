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
        Schema::create('aspirasievent', function (Blueprint $table) {
            $table->increments('id_aspirasi');
            $table->string('no_aspirasi', 50);
            $table->string('tujuan', 255);
            $table->string('manfaat', 510);
            $table->string('lampiransurat', 50);
            $table->unsignedInteger('disposisi_id')->nullable();
            $table->enum('status', ['ditinjau', 'disetujui', 'ditolak'])->default('ditinjau')->nullable();// Kolom status enum dengan default "tersedia"
            $table->string('alasan_ditolak', 510)->nullable();
            $table->unsignedInteger('created_id')->nullable(); // Buat kolom nullable
            $table->unsignedInteger('updated_id')->nullable(); // Buat kolom nullable
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('disposisi_id')->references('id')->on('groups')->onDelete('cascade');
            $table->foreign('created_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aspirasievent');
    }
};
