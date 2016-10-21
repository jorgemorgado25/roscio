<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nac', 1);
            $table->string('cedula', 8)->unique();
            $table->string('nombre', 80);
            $table->string('apellido', 80);
            $table->string('genero', 1);
            $table->date('fecha_nac');
            $table->string('telefono', 20);
            $table->string('email', 80)->unique()->nullable();
            $table->string('profesion', 40);            
            $table->string('grado_instruccion', 15);            
            $table->string('direccion', 100);            
            $table->boolean('difunto');
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
        Schema::drop('personas');
    }
}
