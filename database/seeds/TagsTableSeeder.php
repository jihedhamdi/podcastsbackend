<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tags')->delete();
        
        \DB::table('tags')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'master',
                'slug' => 'master',
                'created_at' => '2017-06-26 07:47:05',
                'updated_at' => '2017-06-26 07:47:05',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'master1',
                'slug' => 'master1',
                'created_at' => '2017-06-26 07:47:12',
                'updated_at' => '2017-06-26 07:47:12',
            ),
        ));
        
        
    }
}
