<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\PhotoCollection;
use App\Models\News;
use Carbon\Carbon;

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
            ->where('types', '=', 'photonews')
            ->where('published_at', '<=', now())
            ->latest('published_at');

        $limit = $request->get('limit', 10);
        if ($limit > 10) {
            $limit = 10;
        }

        return response()->json(new PhotoCollection($photo->paginate($limit)->withQueryString()));
    }

    public function show($id){
        $photo_news = News::with(['categories', 'tags','users', 'news_photo:id,photonews,news_id'])->where('id', $id)->get();
        return response()->json(new IndexVideoResource($photo_news[0]));        
    }
}
