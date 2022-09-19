<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Menu extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['slug', 'menu_name', 'parent_id', 'created_at', 'updated_at', 'deleted_at'];

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

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'roles_menus');
    }
}
