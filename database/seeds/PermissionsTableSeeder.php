<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('permissions')->delete();
        
        \DB::table('permissions')->insert(array (
            0 => 
            array (
                'id' => 4,
                'name' => 'Post-Create',
                'for' => 'post',
                'created_at' => '2017-07-22 08:21:37',
                'updated_at' => '2017-07-22 08:21:37',
            ),
            1 => 
            array (
                'id' => 5,
                'name' => 'Post-update',
                'for' => 'post',
                'created_at' => '2017-07-22 08:22:27',
                'updated_at' => '2017-07-22 08:22:27',
            ),
            2 => 
            array (
                'id' => 6,
                'name' => 'Post-Delete',
                'for' => 'post',
                'created_at' => '2017-07-22 08:22:40',
                'updated_at' => '2017-07-22 08:22:40',
            ),
            3 => 
            array (
                'id' => 7,
                'name' => 'User-Create',
                'for' => 'user',
                'created_at' => '2017-07-22 08:23:05',
                'updated_at' => '2017-07-22 08:23:05',
            ),
            4 => 
            array (
                'id' => 8,
                'name' => 'User-Update',
                'for' => 'user',
                'created_at' => '2017-07-22 08:23:24',
                'updated_at' => '2017-07-22 08:23:24',
            ),
            5 => 
            array (
                'id' => 9,
                'name' => 'User-Delete',
                'for' => 'user',
                'created_at' => '2017-07-22 08:23:35',
                'updated_at' => '2017-07-22 08:23:35',
            ),
            6 => 
            array (
                'id' => 10,
                'name' => 'Post-Publish',
                'for' => 'post',
                'created_at' => '2017-07-22 08:23:51',
                'updated_at' => '2017-07-22 08:23:51',
            ),
            7 => 
            array (
                'id' => 11,
                'name' => 'Tag-CRUD',
                'for' => 'other',
                'created_at' => '2017-07-22 08:24:12',
                'updated_at' => '2017-07-22 08:24:12',
            ),
            8 => 
            array (
                'id' => 12,
                'name' => 'Category-CRUD',
                'for' => 'other',
                'created_at' => '2017-07-22 08:24:20',
                'updated_at' => '2017-07-22 08:24:20',
            ),
        ));
        
        
    }
}
