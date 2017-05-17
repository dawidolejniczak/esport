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
            'name' => 'Dawid',
            'email' => 'daw98olejniczak@gmail.com',
            'password' => bcrypt('qwerty'),
        ]);
    }
}
