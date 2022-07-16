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
        Schema::create('contenido_leccion', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_Leccion');
            $table->string('contenido');
            $table->string('img');
            $table->foreign('id_Leccion')->references('id')->on('lecciones');
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
        Schema::dropIfExists('contenido_leccion');
    }
};
