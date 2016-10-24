<?php

use Illuminate\Database\Seeder;
use Roscio\User;
use Roscio\Role;
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::Table('users')->truncate();
        $inscripciones = Role::where('name', 'Inscripciones')->first();
        $comedor = Role::where('name', 'Comedor')->first();

        $user = new User();
        $user->first_name  = 'Jorge';
        $user->last_name   = 'Morgado';
        $user->login       = 'admin';
        $user->password    = 'admin';
        $user->role        = 'admin';
        $user->description = 'Administrador del Sistema';
        $user->save();
        $user->roles()->attach($inscripciones);
        $user->roles()->attach($comedor);
        /*
        $id = DB::table('users')->insertGetId([
            'first_name' => 'Jorge',
            'last_name'  => 'Morgado',
            'login'      => 'admin',
            'password'   => Hash::make('admin'),
            'role'       => 'admin'
        ]);
        */
    }
}
