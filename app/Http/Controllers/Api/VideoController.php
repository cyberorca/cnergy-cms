<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\VideoCollection;
use App\Models\News;
use Illuminate\Http\Request;

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
    public function index(Request $request){
        /*order by published_at desc
        //by is_published
        //limit 10
        //date <= now
        //filter by id category
        //filter by headline 1|0
        */
        // $video = News::with(['categories', 'tags'])->where('types','=','video')->latest();
        
        $video = News::with(['categories', 'tags','users'])
            ->where('types','=','video')
            ->where('is_published','=','1')
            ->where('published_at','<=',now())
            ->latest('published_at');


        if($request->get("headline")){
            $video->where('is_headline', '=', $request->get('headline', ''));
        }

        if($request->get("category")){
            $video->where('category_id', '=', $request->get('category', ''));
        }

        if($request->get("max_id")){
            $video->where('id', '<', $request->get('max_id', ''));
        }

        if($request->get("editorpick")){
            $video->where('editor_pick', '=', $request->get('editorpick', ''));
        }
        
        $all = News::with(['categories', 'tags'])->orderby('id');
        $alltype = $request->get('alltype', 1);
        if($alltype = 1){
            $all;
        } else if ($alltype = 0){
            $video;
        }

        $published = $request->get('published', 1);
        if($published == 0){
            $video->where('is_published', '=', "0");
        }

        if($request->get("sensitive")){
            $video->where('is_verify_age', '=', $request->get('sensitive', ''));
        }

        if($request->get("last_update")){
            $video->where('update_at', '=', $request->get('last_update', ''));
        }

        $limit = $request->get('limit', 10);
        if($limit > 10){
            $limit = 10;
        }

        return response()->json(new VideoCollection($video->paginate($limit)->withQueryString()));
    }

}
