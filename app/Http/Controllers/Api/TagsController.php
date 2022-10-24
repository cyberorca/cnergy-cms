<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Http\Resources\TagCollection;

class TagsController extends Controller
{
    public function index(Request $request)
    {
        $tag = Tag::paginate($request->get('limit', 10))->withQueryString();

        if ($request->get('name')) {
            $tag->where('tags', 'like', '%' . $request->name . '%');
        } 

        if ($request->get('slug')) {
            $tag-> where('slug', 'like', '%' . $request->slug . '%');
        }
        
        if ($request->get('status')) {
            $status = $request->status;
            $tag ->where('is_active', $status);
        }

       
        return response()->json(new TagCollection($tag->paginate(10)));
    }

    
}
