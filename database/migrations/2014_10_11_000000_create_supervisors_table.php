<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupervisorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('supervisors')){
            Schema::create('supervisors', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->rememberToken();
                $table->timestamps();
                // Añadido
                $table->date('fecha_nacimiento')->nullable();
                $table->string('formacion')->nullable();
                $table->string('image_url')->default('default.jpg')->nullable();
                // Relaciones
                $table->foreignId('supervisado')->nullable()->constrained('supervisors')->onDelete('cascade');
                $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supervisors');
    }
}
