<?php

namespace Database\Seeders;

use App\Models\FrontEndMenu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class FrontEndMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fe_menus = array(
            array('title' => 'Halo Bandung', 'parent_id' => NULL, 'order' => 0),
            array('title' => 'Pariwisata', 'parent_id' => NULL, 'order' => 1),
            array('title' => 'Kuliner', 'parent_id' => NULL, 'order' => 2),
            array('title' => 'Gaya Hidup', 'parent_id' => NULL, 'order' => 3),
            array('title' => 'Persib', 'parent_id' => NULL, 'order' => 4),
            array('title' => 'Komunitas', 'parent_id' => NULL, 'order' => 5),
            array('title' => 'Profil', 'parent_id' => NULL, 'order' => 6),
            array('title' => 'Lapak', 'parent_id' => NULL, 'order' => 7),
            array('title' => 'Daftar Alamat', 'parent_id' => NULL, 'order' => 8),
            array('title' => 'Berita Duka', 'parent_id' => NULL, 'order' => 9),
            array('title' => 'Advertorial', 'parent_id' => NULL, 'order' => 10),
        );

        foreach($fe_menus as $menu){
            FrontEndMenu::create([
                'slug' => Str::slug($menu['title']),
                'title' => $menu['title'],
                'parent_id' => $menu['parent_id'],
                'order' => $menu['order'],
                'position' => json_encode(fake()->randomElement([['header'], ['footer'], ['header', 'footer']])),
            ]);
        }
    }
}
