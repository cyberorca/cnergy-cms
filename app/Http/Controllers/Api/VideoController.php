<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\IndexVideoResource;
use App\Http\Resources\VideoCollection;
use App\Models\News;

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
    public function index(){
        /*order by published_at desc
        //by is_published
        //limit 10
        //date <= now
        //filter by id category
        //filter by headline 1|0
        */

        $video = News::with(['categories', 'tags','users', 'news_videos:id,video,news_id'])
            ->where('id','=','109')
            ->where('types','=','video')
            ->where('is_published','=','1')
            ->where('published_at','<=',now())
            ->latest('published_at');

        return response()->json(new VideoCollection($video->paginate(10)));
    }

    public function show($id){
        $video_news = News::with(['categories', 'tags','users', 'news_videos:id,video,news_id'])->where('id', $id)->get();
        return response()->json(new IndexVideoResource($video_news[0]));        
    }
}
