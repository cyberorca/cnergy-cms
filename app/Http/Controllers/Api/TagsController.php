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
        $tag = Tag::latest()
        ->where('tags', "LIKE", "%{$request->get('name', '')}%")
        ->where('slug', 'like', '%' . $request->get('slug', '') . '%')
        ->whereIn('is_active', $request->get('is_active', ['1', '0']))
        ->paginate($request->get('limit', 20))->withQueryString();

       
        return response()->json(new TagCollection($tag));
    }

    
}
