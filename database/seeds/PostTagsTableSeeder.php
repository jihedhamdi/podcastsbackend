<?php

use Illuminate\Database\Seeder;

class PostTagsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('post_tags')->delete();
        
        \DB::table('post_tags')->insert(array (
            0 => 
            array (
                'post_id' => 2,
                'tag_id' => 2,
                'created_at' => '2017-06-26 07:54:20',
                'updated_at' => '2017-06-26 07:54:20',
            ),
            1 => 
            array (
                'post_id' => 2,
                'tag_id' => 1,
                'created_at' => '2017-07-01 06:46:36',
                'updated_at' => '2017-07-01 06:46:36',
            ),
            2 => 
            array (
                'post_id' => 161,
                'tag_id' => 1,
                'created_at' => '2017-07-04 08:14:04',
                'updated_at' => '2017-07-04 08:14:04',
            ),
            3 => 
            array (
                'post_id' => 162,
                'tag_id' => 2,
                'created_at' => '2017-07-04 08:14:24',
                'updated_at' => '2017-07-04 08:14:24',
            ),
            4 => 
            array (
                'post_id' => 163,
                'tag_id' => 1,
                'created_at' => '2017-07-04 08:14:41',
                'updated_at' => '2017-07-04 08:14:41',
            ),
            5 => 
            array (
                'post_id' => 164,
                'tag_id' => 1,
                'created_at' => '2017-07-04 08:14:56',
                'updated_at' => '2017-07-04 08:14:56',
            ),
            6 => 
            array (
                'post_id' => 165,
                'tag_id' => 1,
                'created_at' => '2017-07-04 08:15:30',
                'updated_at' => '2017-07-04 08:15:30',
            ),
            7 => 
            array (
                'post_id' => 166,
                'tag_id' => 2,
                'created_at' => '2017-07-04 08:15:49',
                'updated_at' => '2017-07-04 08:15:49',
            ),
            8 => 
            array (
                'post_id' => 167,
                'tag_id' => 1,
                'created_at' => '2017-07-04 08:16:46',
                'updated_at' => '2017-07-04 08:16:46',
            ),
            9 => 
            array (
                'post_id' => 168,
                'tag_id' => 2,
                'created_at' => '2017-07-04 08:17:01',
                'updated_at' => '2017-07-04 08:17:01',
            ),
            10 => 
            array (
                'post_id' => 169,
                'tag_id' => 1,
                'created_at' => '2017-07-04 08:17:20',
                'updated_at' => '2017-07-04 08:17:20',
            ),
            11 => 
            array (
                'post_id' => 170,
                'tag_id' => 1,
                'created_at' => '2017-07-10 16:32:47',
                'updated_at' => '2017-07-10 16:32:47',
            ),
            12 => 
            array (
                'post_id' => 171,
                'tag_id' => 1,
                'created_at' => '2022-07-14 13:29:41',
                'updated_at' => '2022-07-14 13:29:41',
            ),
            13 => 
            array (
                'post_id' => 171,
                'tag_id' => 2,
                'created_at' => '2022-07-14 13:29:41',
                'updated_at' => '2022-07-14 13:29:41',
            ),
        ));
        
        
    }
}
