<?php

use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permission_role')->delete();
        
        \DB::table('permission_role')->insert(array (
            0 => 
            array (
                'role_id' => 3,
                'permission_id' => 6,
            ),
            1 => 
            array (
                'role_id' => 3,
                'permission_id' => 10,
            ),
            2 => 
            array (
                'role_id' => 4,
                'permission_id' => 4,
            ),
            3 => 
            array (
                'role_id' => 4,
                'permission_id' => 5,
            ),
            4 => 
            array (
                'role_id' => 4,
                'permission_id' => 11,
            ),
            5 => 
            array (
                'role_id' => 4,
                'permission_id' => 12,
            ),
            6 => 
            array (
                'role_id' => 5,
                'permission_id' => 4,
            ),
            7 => 
            array (
                'role_id' => 5,
                'permission_id' => 9,
            ),
            8 => 
            array (
                'role_id' => 5,
                'permission_id' => 12,
            ),
            9 => 
            array (
                'role_id' => 1,
                'permission_id' => 6,
            ),
            10 => 
            array (
                'role_id' => 1,
                'permission_id' => 4,
            ),
            11 => 
            array (
                'role_id' => 1,
                'permission_id' => 12,
            ),
            12 => 
            array (
                'role_id' => 1,
                'permission_id' => 5,
            ),
            13 => 
            array (
                'role_id' => 1,
                'permission_id' => 10,
            ),
        ));
        
        
    }
}
