<?php

use App\Article;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ArticleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 20; $i++) { 
        	$article = new Article;

        	$article -> title = $faker -> name;
	        $article -> cate_id = rand(1,5);
	        $article -> intro = str_random(20);
	        $article -> content = $faker->realText();
	        $article -> user_id = 1;
	        $article -> image = $faker -> imageUrl(640,480);

	        $article -> save();
        }
    }
}
