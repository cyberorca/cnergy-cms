<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Utils\CacheStorage;
use Illuminate\Http\Request;
use App\Models\TodayTag;
use App\Http\Resources\TodayTagCollection;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\TodayTagResource;

class TodayTagController extends Controller
{
    /**
     * Today Tag
     * @OA\Get (
     *     tags={"Today Tag"},
     *     path="/api/today-tag/",
     *     security={{"Authentication_Token":{}}},
     *     @OA\Parameter(
     *         in="query",
     *         name="limit",
     *         @OA\Schema(type="integer")
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
        $todayTag = TodayTag::orderBy('id');

        $limit = $request->get('limit', 20);
        if($limit > 20){
            $limit = 20;
        }

        if(!Cache::has("todayTagCache")){
            CacheStorage::cache("todayTagCache", 'today-tag');
            Cache::put("todayTagCache", new TodayTagCollection($todayTag->paginate($limit)->withQueryString()), now()->addMinutes(10));
        }

        return response()->json(Cache::get("todayTagCache"));
    }

    /**
     * Get Today Tag By ID
     * @OA\Get (
     *     tags={"Today Tag"},
     *     path="/api/today-tag/{id}/",
     *     security={{"Authentication_Token":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *     ),
     *     @OA\Parameter(
     *         in="path",
     *         name="id",
     *         required=true,
     *         @OA\Schema(type="integer")
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
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="not found",
     *       @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="ID Not Found"),
     *          )
     *     )
     * )
     */
    public function show($id){
        $filterId = TodayTag::whereNull('deleted_at')
        ->where('id', $id)
        ->first();

        if ($filterId == null){
            return response()->json(['message'=>'Today Tag Not Found'], Response::HTTP_NOT_FOUND);
        }

        $cacheKey = "todayTagDetail-$id";
        if(!Cache::has($cacheKey)){
            CacheStorage::cache($cacheKey, 'today-tag');
            Cache::put($cacheKey, new TodayTagResource($filterId), now()->addDay());
        }

        return response()->json(Cache::get($cacheKey), Response::HTTP_OK);
    }
}
