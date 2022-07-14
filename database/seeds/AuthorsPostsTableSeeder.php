<?php

use Illuminate\Database\Seeder;

class AuthorsPostsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('authors_posts')->delete();
        
        \DB::table('authors_posts')->insert(array (
            0 => 
            array (
                'post_id' => 2,
                'authors_id' => 2,
                'created_at' => '2022-07-14 13:28:56',
                'updated_at' => '2022-07-14 13:28:56',
            ),
            1 => 
            array (
                'post_id' => 171,
                'authors_id' => 2,
                'created_at' => '2022-07-14 13:29:41',
                'updated_at' => '2022-07-14 13:29:41',
            ),
        ));
        
        
    }
}
