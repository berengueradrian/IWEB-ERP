<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConvenioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convenio', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            // Añadido
            $table->float('sueldo');
            $table->integer('horas_diarias');
            $table->float('sueldo_horas_extra');
            $table->integer('tope_horas_extra');
            $table->float('sueldo_extraordinario');
            $table->integer('dias_vacaciones');
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
        Schema::dropIfExists('convenio');
    }
}
