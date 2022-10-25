<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Http\Resources\TagCollection;
use Illuminate\Support\Facades\DB;

class TagsController extends Controller
{

    public function index(Request $request)
    {
        $tag = Tag::latest();

        if($request->get("slug")){
            $tag->where('slug', '=', $request->get('slug', ''));
        }
        $limit = $request->get('limit', 20);
        if($limit > 20){
            $limit = 20;
        }
        return response()->json(new TagCollection($tag->paginate($limit)->withQueryString()));
    }

    
}
