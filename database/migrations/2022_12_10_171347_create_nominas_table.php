<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNominasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nominas', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            // Añadido
            $table->float('sueldo');
            $table->string('mes');
            $table->string('anyo')->default("2022");
            $table->integer('horas');
            $table->integer('horas_extra')->nullable();
            $table->float('importe_horas_extra')->nullable();
            $table->integer('dias_baja')->nullable();
            $table->float('importe_dias_baja')->nullable();
            $table->float('importe_total')->nullable();
            $table->integer('jornadas_trabajadas')->nullable();
            $table->integer('jornadas_esperadas')->nullable();
            $table->boolean('estado')->default(false);
            // Relaciones
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nominas');
    }
}
