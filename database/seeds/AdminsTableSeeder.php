<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('admins')->delete();
        
        \DB::table('admins')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'jihed hamdi',
                'email' => 'jihedhamdi52@gmail.com',
                'password' => '$2y$10$7LBId.EcKr/qNOMFEFF8VeDzDeQ9aUVZRheB13i/I0nZ8sKhRA2V2',
                'phone' => '9999999999',
                'status' => 1,
                'created_at' => '2017-07-28 06:52:47',
                'updated_at' => '2017-07-30 14:19:48',
            ),
            1 => 
            array (
                'id' => 3,
                'name' => 'Sarthak Shrivastava',
                'email' => 'bitfumes@gmail.com',
                'password' => '$2y$10$XlYHnFdjf.jb0ez1ojkq9e6aPUOPhn4VhFu7oN3nPJ7QP1MyrVeuS',
                'phone' => '7987569077',
                'status' => 1,
                'created_at' => '2017-07-28 06:52:47',
                'updated_at' => '2017-07-28 08:01:39',
            ),
        ));
        
        
    }
}
