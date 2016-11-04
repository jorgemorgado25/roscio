<?php

use Illuminate\Database\Seeder;

class CategoriaPlatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::Table('categoria_platos')->truncate();
        $categorias = array(
            ['nombre' => 'Desayuno'],
        	['nombre' => 'Sopa'],
        	['nombre' => 'Plato Principal'],
        	['nombre' => 'Ensalada'],
            ['nombre' => 'Bebida'],
        	['nombre' => 'Fruta']
        );
        foreach($categorias as $categoria)
        {
        	DB::Table('categoria_platos')->insert([
        		'categoria' => $categoria['nombre']
        	]);
        }
    }
}
