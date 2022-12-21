<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\FrontEndMenu;
use App\Models\User;
use App\Models\News;
use App\Models\PhotoNews;
use Illuminate\Database\Seeder;
use App\Models\Tag;
use App\Models\VideoNews;

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
            FrontEndMenuSeeder::class,
        ]);
        User::factory(100)->create();
    }
}