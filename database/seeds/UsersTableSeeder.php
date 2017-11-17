<?php

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
        DB::table('users')->insert([
            'name' => 'Flicker Leap',
            'email' => 'admin@flickerleap.com',
            'password' => bcrypt('password'),
        ]);
    }
}
