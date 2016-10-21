<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anos', function (Blueprint $table)
        {
            $table->increments('id');
            $table->integer('mencion_id')->unsigned();
            #crear relacion
            /*
            $table->foreign('mencion_id')
                ->references('id')
                ->on('menciones')
                ->onDelete('cascade');
            */
            $table->string('ano', 3);
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
        Schema::drop('anos');
    }
}
