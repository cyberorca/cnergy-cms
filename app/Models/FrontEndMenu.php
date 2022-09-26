<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FrontEndMenu extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function child()
    {
        return $this->hasMany(FrontEndMenu::class, 'parent_id');
    }

    public function child_desc()
    {
        return $this->hasMany(FrontEndMenu::class, 'parent_id')->orderBy('order', 'desc');
    }

    public function childMenus()
    {
        return $this->hasMany(FrontEndMenu::class, 'parent_id')->with('child.child');
    }

    public function slug()
    {
        return $this->slug;
    }

    public function menu_name()
    {
        return $this->title;
    }

    public function childs()
    {
        return $this->child;
    }
}
