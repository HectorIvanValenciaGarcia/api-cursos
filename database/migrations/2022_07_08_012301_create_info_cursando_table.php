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
        Schema::create('info_cursando', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_Estudiante');
            $table->unsignedBigInteger('id_Cursos');
            $table->string('puntuacion');
            $table->foreign('id_Estudiante')->references('id')->on('estudiantes');
            $table->foreign('id_Cursos')->references('id')->on('cursos');
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
        Schema::dropIfExists('info_cursando');
    }
};
