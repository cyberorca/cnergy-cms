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
        $category = Category::select("id", "parent_id as parent", "category as name", "common", "slug as url", "types", "meta_title as meta_name", "meta_description");
        

        if($request->get("name")){
            $category->where('category', '=', $request->get('name'));
        }
        
        $limit = $request->get('limit', 10);
        if($limit > 10){
            $limit = 10;
        }
        
        $nested = intval($request->get("nested"));
        
        return response()->json($nested!==1 ? $category->paginate($limit)->withQueryString()->toArray() : Category::convertCategoryDataToResponseAPI($category->paginate($limit)->withQueryString()->toArray()));
    }
}
