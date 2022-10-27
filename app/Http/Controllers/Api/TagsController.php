<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Http\Resources\TagCollection;
use Illuminate\Support\Facades\Cache;
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

        if(!Cache::has("tags_api")){
            Cache::forever("tags_api", new TagCollection($tag->paginate($limit)->withQueryString()));
        }
        return response()->json(Cache::get("tags_api"));
    }

    
}
