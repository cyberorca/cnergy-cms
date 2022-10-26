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
        
        $nested = $request->get("nested");
        if($nested == 0){
            $category->where('parent_id', '=', $request->get('child.parent.child.parent'))->paginate($limit)->withQueryString();
        } else {
            $category->paginate($limit)->withQueryString();
        }
        // ->toArray();

        // return response()->json(($category->get()));
        // return response()->json(Category::convertCategoryDataToResponse($category->paginate($limit)->withQueryString()->toArray()));
        return response()->json(Category::convertCategoryDataToResponse($category->get()->toArray()));
    }
}
