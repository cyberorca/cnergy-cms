<?php

namespace Database\Seeders;
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
        // $this->call([
        //     RoleSeeder::class,
        //     MenuSeeder::class,
        // ]);
        // User::factory(100)->create();
        Tag::factory(100)->create();
        // $news = News::all();
        // foreach($news as $item){
            
        // }
    }
}
