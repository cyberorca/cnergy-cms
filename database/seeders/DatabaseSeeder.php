<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\News;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Category::factory(50)->create();
        Tag::factory(50)->create();
        News::factory(50)->create();
        User::factory(50)->create();

        // $news = News::all();
        // foreach($news as $item){
            
        // }
    }
}
