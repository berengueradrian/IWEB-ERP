<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNominaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nomina', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            // Añadido
            $table->float('sueldo');
            $table->string('mes');
            $table->integer('horas');
            $table->integer('horas_extra')->nullable();
            $table->integer('dias_baja')->nullable();
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
        Schema::dropIfExists('nomina');
    }
}
