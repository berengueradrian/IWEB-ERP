<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitud', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            // Añadido
            $table->date('fecha_inicio');
            $table->date('fecha_fin')->nullable();
            $table->string('descripcion')->nullable();
            $table->boolean('aceptado')->default(false);
            $table->string('justificante')->nullable();
            $table->string('tipo');
            // Relaciones
            $table->foreignId('user')->constrained('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('solicitud');
    }
}
