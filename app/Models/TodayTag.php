<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TodayTag extends Model
{
    use HasFactory;

    protected $table = 'today_tag';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = ['order_by_no', 'title','url', 'types', 'tag', 'category_id', 'created_at', 'created_by'];

    public function categoryId(){
        return $this->belongsTo(Category::class, 'category_id');
    }
}
