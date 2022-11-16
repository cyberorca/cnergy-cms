<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StaticPageCollection;
use App\Models\StaticPage;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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

        return response()->json(
            new StaticPageCollection($staticPage->get()),
            Response::HTTP_OK);

        // possible filter dev
        // $limit = $request->get('limit', 20);
        // if($limit > 20){
        //     $limit = 20;
        // }
        // return response()->json(new StaticPageCollection($staticPage->paginate($limit)->withQueryString()))->setStatusCode(200);
        // $staticPage = StaticPage::latest()->with(['users'])->paginate(10);
        // return response()->json(new StaticPageCollection($staticPage))->setStatusCode(200);
    }

    /**
     * Get Static Page With Slug
     * @OA\Get (
     *     tags={"Static Page"},
     *     path="/api/static-page/{slug}/",
     *     security={{"Authentication_Token":{}}},
     *     @OA\Parameter(
     *         in="path",
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
    public function show(Request $request, $slug){
        $staticPage = StaticPage::where('slug', $slug)->with('users')->get();
        return response()->json(
            new StaticPageCollection($staticPage),
            Response::HTTP_OK);
    }
}
