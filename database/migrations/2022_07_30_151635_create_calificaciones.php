<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calificaciones', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_Curso');
            $table->unsignedBigInteger('id_Estudiante');
            $table->unsignedBigInteger('id_Leccion');
            $table->double('calificaciones', 15, 8);
            $table->foreign('id_Estudiante')->references('id')->on('estudiantes');
            $table->foreign('id_Leccion')->references('id')->on('lecciones');
            $table->foreign('id_Curso')->references('id')->on('cursos');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('calificaciones');
    }
};
