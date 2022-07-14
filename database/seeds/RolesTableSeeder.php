<?php

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Editors',
                'created_at' => '2017-07-21 08:17:13',
                'updated_at' => '2017-07-21 08:27:48',
            ),
            1 => 
            array (
                'id' => 3,
                'name' => 'Publisher',
                'created_at' => '2017-07-21 08:28:33',
                'updated_at' => '2017-07-21 08:28:33',
            ),
            2 => 
            array (
                'id' => 4,
                'name' => 'Writer',
                'created_at' => '2017-07-21 08:28:38',
                'updated_at' => '2017-07-21 08:28:38',
            ),
        ));
        
        
    }
}
