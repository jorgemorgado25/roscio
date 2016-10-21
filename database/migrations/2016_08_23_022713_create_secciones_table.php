<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSeccionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('secciones', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('ano_id')->unsigned();
            /*
            $table->foreign('ano_id');
                ->references('id')
                ->on('anos')
                ->onDelete('cascade');
            */
            $table->string('seccion', 1);
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
        Schema::drop('secciones');
    }
}
