<?php

use Illuminate\Database\Seeder;
use Roscio\Mencion;
class AnosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::Table('anos')->truncate();
        $mencion = Mencion::where('mencion', 'Media')->first();
        
        $anos = ['1ro', '2do', '3ro', '4to', '5to'];
        foreach($anos as $a)
        {
			DB::Table('anos')->insert([
                'mencion_id' => $mencion->id,
                'ano' => $a
            ]);
        }

        $anos = ['4to', '5to'];

        $mencion = Mencion::where('mencion', 'Ciencias')->first();      
        foreach($anos as $a)
        {
            DB::Table('anos')->insert([
                'mencion_id' => $mencion->id,
                'ano' => $a
            ]);
        }
        $mencion = Mencion::where('mencion', 'Humanidades')->first();      
        foreach($anos as $a)
        {
            DB::Table('anos')->insert([
                'mencion_id' => $mencion->id,
                'ano' => $a
            ]);
        }
    }
}
