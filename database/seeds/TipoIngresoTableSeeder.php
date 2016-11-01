<?php

use Illuminate\Database\Seeder;

class TipoIngresoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::Table('tipo_ingresos')->truncate();
        $tipos = ['Desayuno', 'Almuerzo'];
        foreach($tipos as $tipo)
        {
        	DB::Table('tipo_ingresos')->insert(
                ['tipo' => $tipo]
            );
        }
    }
}
