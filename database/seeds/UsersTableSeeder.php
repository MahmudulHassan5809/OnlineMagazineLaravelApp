<?php

use Faker\Factory;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('users')->truncate();//Reset

        $faker = Factory::create();
        //Generate 3 Users
        DB::table('users')->insert([
           [

                'name' => 'Jhon Doe',
                'slug' => 'jhon-doe',
                'email' => 'jhon@gmail.com',
                'password' =>  bcrypt('secret'),
                'bio' => $faker->text(rand(250,300))
           ],
           [

                'name' => 'Jhon Mark',
                'slug' => 'jhon-mark',
                'email' => 'mark@gmail.com',
                'password' =>  bcrypt('secret'),
                'bio' => $faker->text(rand(250,300))
           ],
           [

                'name' => 'Mark Doe',
                'slug' => 'mark-doe',
                'email' => 'doe@gmail.com',
                'password' =>  bcrypt('secret'),
                'bio' => $faker->text(rand(250,300))
           ],

        ]);
    }
}
