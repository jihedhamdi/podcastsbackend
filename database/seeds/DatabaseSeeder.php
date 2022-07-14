<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call('AdminsTableSeeder');
        $this->call('AdminRoleTableSeeder');
        $this->call('AuthorsTableSeeder');
        $this->call('AuthorsPostsTableSeeder');
        $this->call('CategoriesTableSeeder');
        $this->call('CategoryPostsTableSeeder');
        $this->call('PasswordResetsTableSeeder');
        $this->call('PermissionsTableSeeder');
        $this->call('PermissionRoleTableSeeder');
        $this->call('PostsTableSeeder');
        $this->call('PostTagsTableSeeder');
        $this->call('RolesTableSeeder');
        $this->call('TagsTableSeeder');
        $this->call('UsersTableSeeder');
    }
}
