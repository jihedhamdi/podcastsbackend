<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'sarthak',
                'slug' => 'sarthak',
                'description' => '',
                'color' => '',
                'image' => '',
                'created_at' => '2017-06-26 07:47:23',
                'updated_at' => '2017-06-26 07:47:23',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'bitfumes',
                'slug' => 'bitfumes',
                'description' => '',
                'color' => '',
                'image' => '',
                'created_at' => '2017-06-26 07:47:29',
                'updated_at' => '2017-06-26 07:47:29',
            ),
        ));
        
        
    }
}
