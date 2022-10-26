<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Get Category
     * @OA\Get (
     *     tags={"Category"},
     *     path="/api/category/?token={token}",
     *     @OA\Parameter(
     *         in="path",
     *         name="token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="name",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="success",
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
        $category = Category::select("id", "parent_id", "category as name", "slug", "types", "meta_title", "meta_description", "meta_keywords");

        if($request->get("name")){
            $category->where('category', '=', $request->get('name'));
        }

        // ->toArray();

        return response()->json(($category->get()));
        return response()->json(Category::convertCategoryDataToResponse($category));
    }
}
