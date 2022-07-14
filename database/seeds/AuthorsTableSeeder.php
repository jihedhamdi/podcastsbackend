<?php

use Illuminate\Database\Seeder;

class AuthorsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('authors')->delete();
        
        \DB::table('authors')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'hamdi jihed',
                'description' => 'newbie author',
                'image' => '1657804147avatar5.png',
                'color' => '#000000',
                'slug' => 'jihed',
                'created_at' => '2022-07-14 13:09:07',
                'updated_at' => '2022-07-14 13:09:07',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'ahmed chebbi',
                'description' => 'ahmed is a big fakroune',
                'image' => '1657805083contact-bg.jpg',
                'color' => '#000000',
                'slug' => 'fakroune',
                'created_at' => '2022-07-14 13:24:43',
                'updated_at' => '2022-07-14 13:24:43',
            ),
        ));
        
        
    }
}
