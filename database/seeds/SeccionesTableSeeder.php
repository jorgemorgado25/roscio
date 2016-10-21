<?php

use Illuminate\Database\Seeder;
use Roscio\Ano;
class SeccionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('secciones')->truncate();
        $anos = Ano::all();
        $secciones = ['A', 'B'];
        foreach($anos as $ano)
        {
            foreach($secciones as $seccion)
            {
                DB::Table('secciones')->insert(
                    ['ano_id' => $ano->id, 'seccion' => $seccion]
                );
            }
        	
        }
    }
}
