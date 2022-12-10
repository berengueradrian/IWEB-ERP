<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDirectionUsuarioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('direction_usuario', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            // Añadido
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('directions_id')->constrained('directions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('direccion_usuario');
    }
}
