<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    private static $permissions = [
        'CMS',
        'Create_Posts',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $i = 0;
        foreach (self::$permissions as $permission) {
            DB::table('permissions')->insert([
                'name' => $permission,
            ]);

            DB::table('permission_roles')->insert([
                'permission_id' => ++$i,
                'role_id' => 1,
            ]);
        }

        DB::table('role_users')->insert([
            'role_id' => 1,
            'user_id' => 1,
        ]);
    }
}
