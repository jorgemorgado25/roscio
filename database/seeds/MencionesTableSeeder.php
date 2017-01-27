<?php

use Illuminate\Database\Seeder;

class MencionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::Table('menciones')->truncate();
        $menciones = [
            ['nombre' => 'Media', 'descripcion' => 'Educación Media'],
            //['nombre' => 'Ciencias', 'descripcion' => 'Educación Diversificada'],
            //['nombre' => 'Humanidades', 'descripcion' => 'Educación Diversificada']
        ];
        foreach ($menciones as $mencion)
        {
        	DB::Table('menciones')->insert([
        		'mencion'     => $mencion['nombre'],
                'descripcion' => $mencion['descripcion']
        	]);
        }
    }
}
