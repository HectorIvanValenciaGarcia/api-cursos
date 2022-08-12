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
        Schema::create('cursos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_Profesor');
            $table->string('Nom_Curso');
            $table->string('Descripcion');
            $table->string('Img_Curso');
            $table->string('Color');
            $table->integer('cant_alumnos');
            $table->foreign('id_Profesor')->references('id')->on('profesor');
            $table->timestamps();
          /*  $table->timestamps();*/
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cursos');
    }
};
