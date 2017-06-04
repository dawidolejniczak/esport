<?php

namespace Backpack\Settings\database\seeds;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'key'           => 'contact_email',
            'name'          => 'Contact - email address',
            'description'   => 'The contact email will be visible in footer.',
            'value'         => 'admin@updivision.com',
            'field'         => '{"name":"value","label":"Value","type":"email"}',
            'active'        => 1,
        ]);

        DB::table('settings')->insert([
            'key'           => 'pagination',
            'name'          => 'Numbers of news on page',
            'description'   => 'Numbers of news on page',
            'value'         => 3,
            'field'         => '{"name":"value","label":"Value", "title":"Numbers of news on page" ,"type":"number"}',
            'active'        => 1,
        ]);
    }
}
