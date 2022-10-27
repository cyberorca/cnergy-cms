<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Http\Resources\TagCollection;
use Illuminate\Support\Facades\DB;

class TagsController extends Controller
{
    /**
     * Get Tag
     * @OA\Get (
     *     tags={"Tag"},
     *     path="/api/tag/?token={token}",
     *     @OA\Parameter(
     *         in="path",
     *         name="token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="limit",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="slug",
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
        $tag = Tag::latest();

        if($request->get("slug")){
            $tag->where('slug', '=', $request->get('slug', ''));
        }
        $limit = $request->get('limit', 20);
        if($limit > 20){
            $limit = 20;
        }
        return response()->json(new TagCollection($tag->paginate($limit)->withQueryString()));
    }

}
