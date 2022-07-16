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
        Schema::create('ejercicios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_Contenido');
            $table->string('problema');
            $table->string('respuesta');
            $table->string('opc1');
            $table->string('opc2');
            $table->string('opc3');
            $table->foreign('id_Contenido')->references('id')->on('contenido_leccion');

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
        Schema::dropIfExists('ejercicios');
    }
};
