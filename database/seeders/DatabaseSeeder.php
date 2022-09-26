<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\FrontEndMenu;
use App\Models\User;
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
        // $news = News::all();
        // foreach($news as $item){
            
        // }
    }
}
