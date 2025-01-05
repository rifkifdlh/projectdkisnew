<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('user_groups', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id'); 
            $table->unsignedInteger('group_id');
            $table->unsignedInteger('created_id')->nullable(); // Buat kolom nullable
            $table->unsignedInteger('updated_id')->nullable(); // Buat kolom nullable
            $table->timestamps();
    
            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->foreign('created_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_id')->references('id')->on('users')->onDelete('set null');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('user_groups');
    }
};
