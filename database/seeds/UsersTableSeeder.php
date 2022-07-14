<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 2,
                'name' => 'Sarthak Shrivastava',
                'email' => 'bitfumes@gmail.com',
                'password' => '$2y$10$5L.QBN0qXSZ8x9KuxSh65.E4aJtw5cAh901VXqHsfiHI72EfdH5dS',
                'remember_token' => 'ZmfCotzspvRsk7tQVZamZpYyTHSM20SAPmLWjTg9DbWyNmA3Z7zEzTff9PSo',
                'created_at' => '2017-07-12 05:37:55',
                'updated_at' => '2017-07-12 05:37:55',
            ),
            1 => 
            array (
                'id' => 3,
                'name' => 'Ankur Shrivastava',
                'email' => 'ankur@gmail.com',
                'password' => '$2y$10$l4ODE.jAzImO5cL7KJuK7Obok1VXHsDonQX9U/6aishfDfEyiyfaC',
                'remember_token' => 'lMuCX5ZMe0yhEJPL7C2DcjgzKn5J1gY7UJYs35UL0iBmFoTvMdkysFBLTL4D',
                'created_at' => '2017-07-12 05:52:45',
                'updated_at' => '2017-07-12 05:52:45',
            ),
        ));
        
        
    }
}
