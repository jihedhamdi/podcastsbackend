<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
        // $this->call('AdminsTableSeeder');
        // $this->call('AdminRoleTableSeeder');
        // $this->call('AuthorsTableSeeder');
        // $this->call('AuthorsPostsTableSeeder');
        // $this->call('CategoriesTableSeeder');
        // $this->call('CategoryPostsTableSeeder');
        // $this->call('PasswordResetsTableSeeder');
        // $this->call('PermissionsTableSeeder');
        // $this->call('PermissionRoleTableSeeder');
        // $this->call('PostsTableSeeder');
        // $this->call('PostTagsTableSeeder');
        // $this->call('RolesTableSeeder');
         // $this->call('TagsTableSeeder');
         // $this->call('UsersTableSeeder');
		$faker = Faker\Factory::create();
		
		 for($i=0; $i <= 30; $i++){
		  \App\Model\user\category::create([
		        'name' => $faker->sentence(2),
                'slug' => Str::slug($faker->name),
                'description' => $faker->sentence(15),
                'color' => '#000',
                'image' => 'https://via.placeholder.com/150',
		  ]);
		 }
		 for($i=0; $i <= 30; $i++){
		  \App\Model\user\tag::create ([
                'name' => $faker->name,
                'slug' => Str::slug($faker->name),
                
		  ]);
		 }
		 for($i=0; $i <= 20; $i++){
		  \App\Model\user\User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('passuser'),
                'remember_token' => str_random(60),
            
		  ]);
		 }
		 for($i=0; $i <= 50; $i++){
		  \App\Model\user\post::create([
                'title' => $faker->name,
                'subtitle' =>$faker->sentence(2),
                'slug' => Str::slug($faker->name),
                'body' =>$faker->sentence(10),
			    'status' => rand(0,1),
                'posted_by' => \App\Model\admin\admin::all()->random()->id,
                'image' => 'https://via.placeholder.com/150',
                'audio_link' => 'https://feeds.soundcloud.com/stream/1278392533-user-172906021-podcast-arn-connect-comprendre-larnm-avec-le-pr-patrick-couvreur.mp3'
		  ]);
		 }
		 for($i=0; $i <= 20; $i++){
		  \App\Model\user\authors::create([
                'name' => $faker->name,
                'description' => $faker->sentence(10),
                'image' => 'https://via.placeholder.com/150',
                'color' => '#000000',
                'slug' => Str::slug($faker->name),
                'bgimage'=> 'https://via.placeholder.com/150',
				'first_name'=> $faker->name,
				'last_name'=> $faker->name,
		        'email' => $faker->unique()->safeEmail,
				'gender' => $faker->sentence(1),
				'job_name'=> $faker->sentence(1),
				'link_facebook'=> 'https://www.facebook.com/',
				'link_twitter' => 'https://twitter.com/?lang=fr',
				'link_youtube' => 'https://www.youtube.com/',
				'link_Instagram' => 'https://www.instagram.com/?hl=fr',
		  ]);
		  
		 }
		 
		 for($i=0; $i <= 20;$i++){
		  \App\Model\user\post_tag::create([
                'post_id' => \App\Model\user\post::all()->random()->id,
                'tag_id' => \App\Model\user\tag::all()->random()->id,
                 
		  ]);
		  
		 }
		 
		 for($i=0; $i <= 20;$i++){
		  \App\Model\user\category_post::create([
                'post_id' => \App\Model\user\post::all()->random()->id,
                'category_id' => \App\Model\user\category::all()->random()->id,
                
                 
		  ]);
		  
		 }
		 
		 for($i=0; $i <= 20;$i++){
		  \App\Model\user\authors_posts::create([
  
				'post_id' => \App\Model\user\post::all()->random()->id,
                'authors_id' => \App\Model\user\authors::all()->random()->id,
                 
		  ]);
		  
		 }
    }
}
