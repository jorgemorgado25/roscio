<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$roles = ['Inscripciones', 'Comedor'];
    	for ($i = 0; $i < count($roles) ; $i++)
        { 
    		DB::Table('roles')->insert(
        		['name' => $roles[$i]]
        	);
    	}
        
    }
}
