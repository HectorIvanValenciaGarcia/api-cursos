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
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->id();
            $table->string('Tipo');
            $table->string('Nom_Estudiante');
            $table->string('Nom_Usuario');
            $table->string('Dir_img');
            $table->string('email')->unique();
            $table->string('password');
            $table->timestamps();
        /*    $table->timestamp('email_verified_at')->nullable();*/
            
         /**    $table->rememberToken();
          *  
          */
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estudiantes');
    }
};
