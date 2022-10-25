<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StaticPageCollection;
use App\Models\StaticPage;
use Illuminate\Http\Request;

class StaticPageController extends Controller
{
    /**
     * Get Static Page
     * @OA\Get (
     *     tags={"Static Page"},
     *     path="/api/static-page/?token={token}",
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
     *     )
     * )
     */
    public function index(Request $request){
        $staticPage = StaticPage::latest();

        if($request->get("slug")){
            $staticPage->where('slug', '=', $request->get('slug', ''));
        }

        $limit = $request->get('limit', 20);
        if($limit > 20){
            $limit = 20;
        }

        return response()->json(new StaticPageCollection($staticPage->paginate($limit)->withQueryString()))->setStatusCode(200);

        // $staticPage = StaticPage::latest()
        //     ->with(['users'])
        //     ->paginate(10);
        // return response()->json(new StaticPageCollection($staticPage))
        //     ->setStatusCode(200);
    }
}
