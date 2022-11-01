<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\IndexVideoResource;
use App\Http\Resources\VideoCollection;
use App\Models\News;
use Illuminate\Http\Request;
use Carbon\Carbon;

class VideoController extends Controller
{
    /**
     * Get Video
     * @OA\Get (
     *     tags={"Video"},
     *     path="/api/video/",
     *     security={{"Authentication_Token":{}}},
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

        // if ($request->get('orderby')) {
        //     if ($request->get('orderby') == 'news_date_publish-desc') {
        //         $video->OrderBy('published_at', 'desc');
        //     }
        //     if ($request->get('orderby') == 'news_date_publish-asc') {
        //         $video->OrderBy('published_at', 'asc');
        //     }
        //     if ($request->get('orderby') == 'news_entry-asc') {
        //         $video->OrderBy('created_at', 'asc');
        //     }
        //     if ($request->get('orderby') == 'news_entry-desc') {
        //         $video->OrderBy('created_at', 'desc');
        //     }
        // }

        
        $order = explode("-", $request->get('orderby'));

        if ($order == 'news_date_publish-desc') {
            $video->OrderBy('published_at', 'desc');
        }
        if ($order == 'news_date_publish-asc') {
            $video->OrderBy('published_at', 'asc');
        }
        if ($order == 'news_entry-asc') {
            $video->OrderBy('created_at', 'asc');
        }
        if ($order == 'news_entry-desc') {
            $video->OrderBy('created_at', 'desc');
        }
        if ($order == 'news_last_update-asc') {
            $video->OrderBy('updated_at', 'asc');
        }
        if ($order == 'news_last_update-desc') {
            $video->OrderBy('updated_at', 'desc');
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

        return response()->json(new VideoCollection($video->paginate($limit)->withQueryString()));
    }

    public function show($id){
        $video_news = News::with(['categories', 'tags','users', 'news_videos:id,video,news_id'])->where('id', $id)->get();
        return response()->json(new IndexVideoResource($video_news[0]));        
    }
}
