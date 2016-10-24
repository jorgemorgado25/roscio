<?php

use Illuminate\Database\Seeder;

class EscolaridadTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::Table('escolaridades')->truncate();
        DB::Table('escolaridades')->insert(
        	['escolaridad' => '2016-2017', 'active' => 1]
        );
    }
}
