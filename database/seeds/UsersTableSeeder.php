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
            'name' => 'Dawid Olejniczak',
            'email' => 'contact@dawidolejniczak.com',
            'password' => bcrypt('secret'),
        ]);
    }
}
