<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\IndexVideoResource;
use App\Http\Resources\VideoCollection;
use App\Models\News;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Cache;

class VideoController extends Controller
{
    /**
     * Get Video
     * @OA\Get (
     *     tags={"Video"},
     *     path="/api/video/",
     *     security={{"Authentication_Token":{}}},
     *     @OA\Parameter(
     *         in="query",
     *         name="limit",
     *         @OA\Schema(type="integer")
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
     *         name="max_id",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="editorpick",
     *         @OA\Schema(type="string", enum = {1, 0})
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="alltype",
     *         @OA\Schema(type="string", enum = {1, 0})
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="orderby",
     *         @OA\Schema(type="string", enum = {"asc", "desc"})
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="published",
     *         @OA\Schema(type="string", enum = {1, 0})
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="sensitive",
     *         @OA\Schema(type="string", enum = {1, 0})
     *     ),
     *     @OA\Parameter(
     *         in="query",
     *         name="last_update",
     *         @OA\Schema(type="date")
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
        /*order by published_at desc
        //by is_published
        //limit 10
        //date <= now
        //filter by id category
        //filter by headline 1|0
        */

        $video = News::with(['categories', 'tags','users', 'news_videos:id,video,news_id'])
            ->where('types','=','video')
            ->where('is_published','=','1')
            ->where('published_at','<=',now())
            ->latest('published_at');

        $alltype = $request->get('alltype', 0);
        if ($alltype == 0) {
            $video->where('types', '=', 'video');
        }

        $order = $request->get('orderby');
        if($order){
            $data = explode("-" , $order);
            if ($data[0] == 'news_date_publish') {
                $video->OrderBy('published_at', $data[1]);
            }
            if ($data[0] == 'news_entry') {
                $video->OrderBy('created_at', $data[1]);
            }
            if ($data[0] == 'news_last_update') {
                $video->OrderBy('updated_at', $data[1]);
            }
        }else{
            $video->latest('published_at');
        }


        if ($request->get("headline")) {
            $video->where('is_headline', '=', $request->get('headline', ''));
        }

        if ($request->get("category")) {
            $video->where('category_id', '=', $request->get('category', ''));
        }

        if ($request->get("max_id")) {
            $video->where('id', '<', $request->get('max_id', ''));
        }

        if ($request->get("editorpick")) {
            $video->where('editor_pick', '=', $request->get('editorpick', ''));
        }

        $published = $request->get('published', 1);
        if ($published == 0) {
            $video->where('is_published', '=', "0");
        }

        if ($request->get("sensitive")) {
            $video->where('is_verify_age', '=', $request->get('sensitive', ''));
        }

        if ($request->get('last_update')) {
            $last_update = Carbon::parse(($request->get('last_update')))
                ->toDateTimeString();
            $video->where('updated_at', '>=', $last_update);
        }

        $limit = $request->get('limit', 10);
        if ($limit > 10) {
            $limit = 10;
        }

        if(!Cache::has("videoCache")){
            Cache::put("videoCache", new VideoCollection($video->paginate($limit)->withQueryString()), now()->addMinutes(10));
        }
    
        return response()->json(Cache::get("videoCache"));
    }

    /**
     * Get Video By ID
     * @OA\Get (
     *     tags={"Video"},
     *     path="/api/video/{id}/",
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
        $video_news = News::with(['categories', 'tags','users', 'news_videos:id,video,news_id'])
            ->where('id', $id)
            ->where('types','=','video')
            ->where('is_published','=','1')
            ->where('published_at','<=',now())
            ->latest('published_at')
            ->first();
        if ($video_news==null){
            return response()->json(['message'=>'ID Not Found'],Response::HTTP_NOT_FOUND);
        }
        return response()->json(new IndexVideoResource($video_news));
    }
}
