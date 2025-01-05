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
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id_event');
            $table->string('no_event', 50);
            $table->string('nama_event', 50);
            $table->string('photo', 50)->nullable();
            $table->string('deskripsi_singkat', 255)->nullable();
            $table->unsignedInteger('tempat_id');
            $table->date('tanggal');
            $table->time('waktu_mulai')->nullable(); 
            $table->time('waktu_selesai')->nullable(); 
            $table->enum('status', ['akanhadir', 'berlangsung', 'selesai'])->default('akanhadir'); // Kolom status enum dengan default "tersedia"
            $table->unsignedInteger('created_id')->nullable(); // Buat kolom nullable
            $table->unsignedInteger('updated_id')->nullable(); // Buat kolom nullable
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('tempat_id')->references('id')->on('tempat')->onDelete('cascade');
            $table->foreign('created_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
