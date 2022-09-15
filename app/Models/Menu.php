<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['slug', 'menu_name', 'parent_id'];

    public function child()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }

    public function childMenus()
    {
        return $this->hasMany(Menu::class, 'parent_id')->with('child.child');
    }

    public function slug(){
        return $this->slug;
    }
    public function menu_name(){
        return $this->menu_name;
    }

    public function childs(){
        return $this->child;
    }
}
