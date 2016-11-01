<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $this->call(RolesSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(EscolaridadTableSeeder::class);
        $this->call(MencionesTableSeeder::class);        
        $this->call(AnosTableSeeder::class);
        $this->call(SeccionesTableSeeder::class);
        $this->call(EstudianteSeeder::class);
        $this->call(CategoriaPlatoSeeder::class);
        $this->call(RubrosTableSeeder::class);
        $this->call(TipoIngresoTableSeeder::class);
        Model::reguard();
    }
}
