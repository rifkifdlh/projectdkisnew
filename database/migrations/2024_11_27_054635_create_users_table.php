<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('nip', 50);
            $table->string('password');
            $table->unsignedInteger('group_id');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->string('photo', 50)->nullable();
            $table->timestamps();

            // Tambahkan aturan UNIQUE untuk kombinasi NIP dan grup
            $table->unique(['nip', 'group_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
