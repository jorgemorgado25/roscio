<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEstudiantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estudiantes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('madre_id');
            $table->integer('padre_id');
            $table->string('nac', 1);
            $table->string('cedula', 8)->unique();
            $table->string('nombre', 80);
            $table->string('apellido', 80);
            $table->string('genero', 1);
            $table->date('fecha_nac');
            $table->string('estado_nac', 20);
            $table->string('lugar_nac', 100);
            $table->double('talla');
            $table->double('peso');
            $table->string('grupo_sanguineo', 3);
            $table->string('enf_aler', 80);
            $table->string('direccion', 250);
            $table->boolean('vive_con_madre');
            $table->boolean('vive_con_padre');
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
        Schema::drop('estudiantes');
    }
}
