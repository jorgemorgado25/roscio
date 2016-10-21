<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 30; $i++)
    	{
    		$faker = Faker::create();
	        $id = DB::Table('users')->insertGetId([
	        	'first_name' => $faker->firstName,
	            'last_name'  => $faker->lastName,
	            'login'      => $faker->unique()->userName,
	            'password'   => Hash::make('1234'),
	            'role'       => 'user'
	        ]);

	        /*
	        DB::Table('user_profiles')->insert([
	        	'user_id' => $id,
	        	'bio'     => $faker->paragraph(rand(2,5)),
	        	'website' => 'http://www' . $faker->domainName,
	        	'twitter' => 'http://www.twitter.com/' . $faker->userName,
	        	'birthday' => $faker->dateTimeBetween('-45 years', '-15 years')->format('Y-m-d')
	        ]);
	        */
    	}
    }
}
