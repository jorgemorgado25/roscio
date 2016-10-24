<?php

use Illuminate\Database\Seeder;
use Roscio\CategoriaRubro;
class RubrosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::Table('categoria_rubros')->truncate();
    	DB::Table('rubros')->truncate();

        $categorias = [
        	['nombre' => 'Pastas'],
        	['nombre' => 'Cereales y Legumbres'],
        	['nombre' => 'Carnes'],
        	['nombre' => 'Verduras y Hortalizas'], 
        	['nombre' => 'Frutas'], 
        	['nombre' => 'Otros']
        ];

        foreach($categorias as $categoria)
        {
        	DB::Table('categoria_rubros')->insert([
        		'categoria' => $categoria['nombre']
        	]);
        }

        $categoriaPasta = CategoriaRubro::where('categoria', 'Pastas')->first();

        $pastas = array(
        	['nombre' => 'Pasta Corta'], 
        	['nombre' => 'Espaguetti']
        );

        foreach($pastas as $pasta)
        {
        	db::Table('rubros')->insert([
        		'categoria_rubro_id' => $categoriaPasta->id,
        		'rubro' => $pasta['nombre']
        	]);
        }

        $categoriaCarne = CategoriaRubro::where('categoria', 'Carnes')->first();

        $carnes = array(
        	['nombre' => 'Pollo'],
        	['nombre' => 'Carne Molida'],
        	['nombre' => 'Carne Mechada'],
        );
        foreach($carnes as $carne)
        {
        	db::Table('rubros')->insert([
        		'categoria_rubro_id' => $categoriaCarne->id,
        		'rubro' => $carne['nombre']
        	]);
        }

        $categoriaCereal = CategoriaRubro::where('categoria', 'Cereales y Legumbres')->first();
        $cereales = array(
        	['nombre' => 'Arroz'],
        	['nombre' => 'Caraota'],
        	['nombre' => 'Arbejas']
        );
        foreach($cereales as $cereal)
        {
        	db::Table('rubros')->insert([
        		'categoria_rubro_id' => $categoriaCereal->id,
        		'rubro' => $cereal['nombre']
        	]);
        }

        $categoriaVerdura = CategoriaRubro::where('categoria', 'Verduras y Hortalizas')->first();
        $verduras = array(
        	['nombre' => 'Papa'],
        	['nombre' => 'Zanahoria'],
        	['nombre' => 'Tomate']
        );
        foreach($verduras as $verdura)
        {
        	db::Table('rubros')->insert([
        		'categoria_rubro_id' => $categoriaVerdura->id,
        		'rubro' => $verdura['nombre']
        	]);
        }

        $categoriaOtros = CategoriaRubro::where('categoria', 'Otros')->first();
        $otros = array(
        	['nombre' => 'Azucar'],
        	['nombre' => 'Sal']
        );
        foreach($otros as $otro)
        {
        	db::Table('rubros')->insert([
        		'categoria_rubro_id' => $categoriaOtros->id,
        		'rubro' => $otro['nombre']
        	]);
        }

        $categoriaFruta = CategoriaRubro::where('categoria', 'Frutas')->first();
        $frutas = array(
        	['nombre' => 'Parchita'],
        	['nombre' => 'Patilla']
        );
        foreach($frutas as $fruta)
        {
        	db::Table('rubros')->insert([
        		'categoria_rubro_id' => $categoriaFruta->id,
        		'rubro' => $fruta['nombre']
        	]);
        }
    }
}
