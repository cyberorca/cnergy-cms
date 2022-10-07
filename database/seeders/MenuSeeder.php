<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = array(
            array('slug' => 'dashboard', 'menu_name' => 'Dashboards', 'parent_id' => NULL),
            array('slug' => 'master', 'menu_name' => 'Master', 'parent_id' => NULL),
            array('slug' => 'tools', 'menu_name' => 'Tools', 'parent_id' => NULL),
            array('slug' => 'user', 'menu_name' => 'User', 'parent_id' => '2'),
            array('slug' => 'user-setting', 'menu_name' => 'User Setting', 'parent_id' => '4'),
            array('slug' => 'role', 'menu_name' => 'Role', 'parent_id' => '4'),
            array('slug' => 'role-access', 'menu_name' => 'Role Access', 'parent_id' => '4'),
            array('slug' => 'documentation', 'menu_name' => 'Documentations', 'parent_id' => NULL),
            array('slug' => 'menu', 'menu_name' => 'Menu', 'parent_id' => '2'),
            array('slug' => 'category', 'menu_name' => 'Category', 'parent_id' => '2'),
            array('slug' => 'front-end-menu', 'menu_name' => 'Front End Menu', 'parent_id' => '2'),
            array('slug' => 'front-end-setting', 'menu_name' => 'Front End Setting', 'parent_id' => '2'),
            array('slug' => 'upload-image', 'menu_name' => 'Upload Image', 'parent_id' => '3'),
            array('slug' => 'image-bank', 'menu_name' => 'Image Bank', 'parent_id' => '3'),
            array('slug' => 'php-error', 'menu_name' => 'PHP Error', 'parent_id' => '3'),
            array('slug' => 'inventory-management', 'menu_name' => 'Inventory Management', 'parent_id' => '3'),
            array('slug' => 'static-page', 'menu_name' => 'Static Page', 'parent_id' => '3'),
            array('slug' => 'anouncement', 'menu_name' => 'Anouncement', 'parent_id' => '3'),
            array('slug' => 'update', 'menu_name' => 'Update', 'parent_id' => NULL),
            array('slug' => 'news', 'menu_name' => 'News', 'parent_id' => '19'),
            array('slug' => 'tags', 'menu_name' => 'Tags', 'parent_id' => '19'),
            array('slug' => 'breaking-news', 'menu_name' => 'Breaking News', 'parent_id' => '19'),
            array('slug' => 'news', 'menu_name' => 'News', 'parent_id' => '20'),
            array('slug' => 'photo', 'menu_name' => 'Photo', 'parent_id' => '20'),
            array('slug' => 'video', 'menu_name' => 'Video', 'parent_id' => '20'),
            array('slug' => 'tag-management', 'menu_name' => 'Tag Management', 'parent_id' => '21'),
            array('slug' => 'news-tagging', 'menu_name' => 'News Tagging', 'parent_id' => '21'),
            array('slug' => 'today-tag', 'menu_name' => 'Today Tag', 'parent_id' => '21')
        );

        foreach($menus as $menu){
            $new_menu = Menu::create([
                'slug' => $menu['slug'],
                'menu_name' => $menu['menu_name'],
                'parent_id' => $menu['parent_id'],
            ]);
            // $new_menu->roles()->attach(Role::all()->random(rand(1,4))->pluck('id'));
            $new_menu->roles()->attach(Role::all()->pluck('id'));
        }
    }
}
