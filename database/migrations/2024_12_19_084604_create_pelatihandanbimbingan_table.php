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
        Schema::create('pelatihandanbimbingan', function (Blueprint $table) {
            $table->increments('id_pelatihan');
            $table->string('no_pelatihan', 50);
            $table->string('nama_pelatihan', 50);
            $table->string('peserta', 510)->nullable(); // Untuk menyimpan nama-nama peserta
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('group_id');
            $table->unsignedInteger('tempat_id');
            $table->integer('kuota');
            $table->date('tanggal');
            $table->time('waktu_mulai')->nullable(); 
            $table->time('waktu_selesai')->nullable(); 
            $table->enum('status', ['akanhadir','berlangsung', 'selesai'])->default('akanhadir')->nullable(); // Kolom status enum dengan default "tersedia"
            $table->unsignedInteger('created_id')->nullable(); // Buat kolom nullable
            $table->unsignedInteger('updated_id')->nullable(); // Buat kolom nullable
            $table->timestamps();


            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
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
        Schema::dropIfExists('pelatihandanbimbingan');
    }
};
