<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;

class CategoriesController extends Controller
{
    /**
     * Get Category
     * @OA\Get (
     *     tags={"Category"},
     *     path="/api/category/",
     *     security={{"Authentication_Token":{}}},
     *     @OA\Parameter(
     *         in="query",
     *         name="name",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="limit",
     *         @OA\Schema(type="int")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="bad request",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="unauthorized",
     *       @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="The security token is invalid"),
     *          )
     *     )
     * )
     */
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

        if(!Cache::has("categoriesCache")){
            Cache::put("categoriesCache", $nested!==1 ? $category->paginate($limit)->withQueryString()->toArray() : Category::convertCategoryDataToResponseAPI($category->paginate($limit)->withQueryString()->toArray()), now()->addMinutes(10));
        }
    
        return response()->json(Cache::get("categoriesCache"));
    }
}
