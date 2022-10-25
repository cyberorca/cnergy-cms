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
        $category = Category::select("id", "parent_id", "category as name", "slug", "types", "meta_title", "meta_description", "meta_keywords")
            ->where('category', 'like', "%{$request->get('name', '')}%")
            ->where('common', 'like', "%{$request->get('common', '')}%")
            ->whereIn('is_active', $request->get('status', ["1", "0"]))->get()->toArray();

        return response()->json(Category::convertCategoryDataToResponse($category));
    }
}
