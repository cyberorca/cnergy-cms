<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;

class TagsController extends Controller
{
    public function index(Request $request)
    {
        $tags = Tag::all();

        if ($request->get('inputTags')) {
            $tags->where('tags', 'like', '%' . $request->inputTags . '%');
        } 

        if ($request->get('inputSlug')) {
            $tags-> where('slug', 'like', '%' . $request->inputSlug . '%');
        }
        
        if ($request->get('status')) {
            $status = $request->status;
            if($status == 2) {
                $tags ->where('is_active', "0");
            }else {
                $tags ->where('is_active', "1");
            }
        }

        return response()->json($tags);

    }
}
