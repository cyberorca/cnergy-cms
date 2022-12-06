<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StaticPageCollection;
use App\Http\Utils\CacheStorage;
use App\Models\StaticPage;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cache;

class StaticPageController extends Controller
{
    /**
     * Get Static Page
     * @OA\Get (
     *     tags={"Static Page"},
     *     path="/api/static-page/",
     *     security={{"Authentication_Token":{}}},
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
    public function index(Request $request){
        $staticPage = StaticPage::latest()->with('users');

        if($request->get("slug")){
            $staticPage->where('slug', '=', $request->get('slug', ''));
        }
        
        if(!Cache::has("staticPageCache")){
            CacheStorage::cache("staticPageCache", 'static-page');
            Cache::put("staticPageCache", new StaticPageCollection($staticPage->get()), now()->addMinutes(10));
        }

        return response()->json(Cache::get("staticPageCache"), Response::HTTP_OK);
    }

    public function show($slug){
        $filterSlug = StaticPage::where('slug', $slug)->with('users')->get();

        if (count($filterSlug) <= null){
            return response()->json(['message'=>'Static Page Not Found'], Response::HTTP_NOT_FOUND);
        }
        $cache_key = "static-page-$slug";
        if(!Cache::has($cache_key)){
            CacheStorage::cache($cache_key, 'static-page');
            Cache::put($cache_key, new StaticPageCollection($filterSlug), now()->addDay());
        }

        return response()->json(Cache::get($cache_key), Response::HTTP_OK);
    }
}
