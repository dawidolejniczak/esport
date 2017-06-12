<?php

use Illuminate\Database\Seeder;

class GamesTableSeeder extends Seeder
{
    private static $games = [
        'Fifa17',
        'Counter-Strike',
        'Overwatch',
        'World Of Tanks',
        'Dota2',
        'League Of Legends'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::$games as $game) {
            DB::table('games')->insert([
                'name' => $game,
            ]);
        }
    }
}
