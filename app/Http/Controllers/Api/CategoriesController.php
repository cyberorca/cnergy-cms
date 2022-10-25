<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    public function index(Request $request)
    {
        $category = Category::select("id", "parent_id", "category as name", "slug", "types", "meta_title", "meta_description", "meta_keywords");

        if($request->get("name")){
            $category->where('category', '=', $request->get('name'));
        }
        
        // ->toArray();

        return response()->json(($category->get()));
        return response()->json(Category::convertCategoryDataToResponse($category));
    }
}
