<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\PhotoCollection;
use App\Http\Resources\IndexPhotoResource;
use App\Models\News;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;

class PhotoController extends Controller
{
    /**
     * Get Photonews
     * @OA\Get (
     *     tags={"Photonews"},
     *     path="/api/photonews/",
     *     security={{"Authentication_Token":{}}},
     *     @OA\Parameter(
     *         in="query",
     *         name="limit",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="max_id",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="last_update",
     *         @OA\Schema(type="date")
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="category",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="headline",
     *         @OA\Schema(type="string", enum = {1, 0})
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="editorpick",
     *         @OA\Schema(type="string", enum = {1, 0})
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="published",
     *         @OA\Schema(type="string", enum = {1, 0})
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="orderby",
     *         @OA\Schema(type="string", enum = {"asc", "desc"})
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="sensitive",
     *         @OA\Schema(type="string", enum = {1, 0})
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="alltype",
     *         @OA\Schema(type="string", enum = {1, 0})
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
        $photo = News::with(['categories', 'tags', 'users', 'news_photo'])
            ->where('is_published', '=', '1')
            ->where('published_at', '<=', now())
            ->latest('published_at');

        // return response()->json($photo->get());
        $limit = $request->get('limit', 20);
        if ($limit > 20) {
            $limit = 20;
        }

        if ($request->get("max_id")) {
            $photo->where('id', '<', $request->get('max_id', ''));
        }

        if ($request->get('last_update')) {
            $last_update = Carbon::parse(($request->get('last_update')))
                ->toDateTimeString();
            $photo->where('updated_at', '>=', $last_update);
        }

        if ($request->get("category")) {
            $photo->where('category_id', '=', $request->get('category', ''));
        }

        if ($request->get("headline")) {
            $photo->where('is_headline', '=', $request->get('headline', ''));
        }

        if ($request->get("editorpick")) {
            $photo->where('editor_pick', '=', $request->get('editorpick', ''));
        }

        $published = $request->get('published', 1);
        if ($published == 0) {
            $photo->where('is_published', '=', "0");
        }

        $alltype = $request->get('alltype', 0);
        if ($alltype == 0) {
            $photo->where('types', '=', 'photonews');
        }

        $order = $request->get('orderby');
        if($order){
            $data = explode("-" , $order);
            if ($data[0] == 'news_date_publish') {
                $photo->OrderBy('published_at', $data[1]);
            }
            if ($data[0] == 'news_entry') {
                $photo->OrderBy('created_at', $data[1]);
            }
            if ($data[0] == 'news_last_update') {
                $photo->OrderBy('updated_at', $data[1]);
            }
        }else{
            $photo->latest('published_at');
        }

        if ($request->get("sensitive")) {
            $photo->where('is_verify_age', '=', $request->get('sensitive', ''));
        }

        if(!Cache::has("photoCache")){
            Cache::put("photoCache", new PhotoCollection($photo->paginate($limit)->withQueryString()), now()->addMinutes(10));
        }

        return response()->json(Cache::get("photoCache"));
    }

    public function show($id){
        $filterId = News::with(['users'])
        ->where('id', $id)
        ->where('types','=','photonews')
        ->first();

        if ($filterId == null){
            return response()->json(['message'=>'Photonews Not Found'], Response::HTTP_NOT_FOUND);
        }

        $cacheKey = "photoDetail-$id";
        if(!Cache::has($cacheKey)){
            Cache::put($cacheKey, new IndexPhotoResource($filterId), now()->addDay());
        }

        return response()->json(Cache::get($cacheKey), Response::HTTP_OK);
    }
}
