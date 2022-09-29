<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\FrontEndMenu;
use App\Models\User;
use App\Models\News;
use Illuminate\Database\Seeder;
use App\Models\Tag;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
             RoleSeeder::class,
             MenuSeeder::class,
            //  FrontEndMenu::class,
        ]);
        User::factory(100)->create();
        Tag::factory(100)->create();
        Category::factory(100)->create();
        News::factory(100)->create();
        // $news = News::all();
        // foreach($news as $item){
        //    $news_tag = News::create([
        //        'news_id' => fake()->randomElement([random_int(1, 10)]),
        //        'tag_id' => fake()->randomElement([random_int(1, 10)]),
        //        'is_active' => fake()->randomElement(['0', '1']),
        //        'created_at' => now(),
        //        'updated_at' => now(),
        //    ]);
        //      $news_tag->tags()->attach(Tag::all()->random(rand(1,100))->pluck('id'));    
        // }

        $tags = Tag::all();

        // Populate the pivot table
        News::all()->each(function ($news) use ($tags) { 
            $news->tags()->attach(
                $tags->random(rand(1, 5))->pluck('id')->toArray()
            ); 
        });
    }
}