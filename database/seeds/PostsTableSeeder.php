<?php

use Faker\Factory;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->truncate();//Reset
        $posts = [];
        $faker = Factory::create();
        for ($i=0; $i < 10; $i++) {
        	$image = 'Post_Image_' . rand(1,5) . ".jpg";
        	//$date = date("Y-m-d H:i:s" , strtotime('2018-7-18 08:00::00 +{$i} days'));
            $posts[] = [
                'user_id' => rand(1,3),
                'category_id' => rand(1,3),
                'title' => $faker->sentence(rand(8,12)),
                'excerpt' => $faker->text(rand(250,30)),
                'body' => $faker->paragraphs(rand(10,15),true),
                'slug' => $faker->slug(),
                'image' => rand(0,1) == 1 ? $image : NULL,

            ];
        }

        DB::table('posts')->insert($posts);
    }
}
