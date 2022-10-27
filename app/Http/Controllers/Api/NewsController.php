<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NewsCollection;
use App\Models\News;
use App\Models\User;
use App\Models\NewsPagination;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Get News
     * @OA\Get (
     *     tags={"News"},
     *     path="/api/news/?token={token}",
     *     @OA\Parameter(
     *         in="path",
     *         name="token",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
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
        $news = News::with(['categories', 'tags', 'users', 'news_paginations'])
        //->where('is_published','=','1')
        ->where('published_at','<=',now())
        ->latest('published_at');

        $limit = $request->get('limit', 10);
        if($limit > 10){
            $limit = 10;
        }
        if($request->get("headline")){
            $news->where('is_headline', '=', $request->get('headline', ''));
        }
        if($request->get("category")){
            $news->where('category_id', '=', $request->get('category', ''));
        }
        if($request->get("max_id")){
            $news->where('id', '<', $request->get('max_id', ''));
        }
        if($request->get("editorpick")){
            $news->where('editor_pick', '=', $request->get('editorpick', ''));
        }
        if($request->get("editorpick")){
            $news->where('editor_pick', '=', $request->get('editorpick', ''));
        }

        $alltype = $request->get('alltype', 1);
        if($alltype == 0){
            $news->where('types', '=', "news");
        }

        $published = $request->get('published', 1);
        if($published == 0){
            $news->where('is_published', '=', "0");
        }

        if($request->get("sensitive")){
            $news->where('is_verify_age', '=', $request->get('sensitive', ''));
        }

        /*if ($request->get('published')) {
            $published = $request->get('published');
            if($published = 1) {
                $news->where('is_published','=','0');
            }
            if ($published = 0) {
                $news->where('is_published','=','1');
            } 
            
        }*/
        /*$editors = User::join('roles', 'users.role_id', '=', 'roles.id')->where('roles.role', "Editor");
        $reporters = User::join('roles', 'users.role_id', '=', 'roles.id')->where('roles.role', "Reporter");
        $photographers = User::join('roles', 'users.role_id', '=', 'roles.id')->where('roles.role', "Photographer");

        if ($request->get('published')) {
            $published = $request->get('published');
            if ($published == 2) {
                $news->where('is_published', "0");
            } else {
                $news->where('is_published', "1");
            }
        }

        if ($request->get('inputTitle')) {
            $news->where('title', 'like', '%' . $request->inputTitle . '%');
        }

        if ($request->get('inputCategory')) {
            $news->whereHas('categories', function ($query) use ($request) {
                $query->where('category', 'like', "%{$request->get('inputCategory')}%");
            });
        }

        if ($request->get('headline')) {
            $headline = $request->get('headline');
            if ($headline == 2) {
                $news->where('is_headline', "0");
            } else {
                $news->where('is_headline', "1");
            }
        }

        if ($request->get('inputTag')) {
            $news->whereHas('tags', function ($query) use ($request) {
                $query->where('tags', 'like', "%{$request->get('inputTag')}%");
            });
        }

        if ($request->get('startDate') && $request->get('endDate')) {
            $startDate = Carbon::parse(($request->get('startDate')))
                ->toDateTimeString();

            $endDate = Carbon::parse($request->get('endDate'))
                ->toDateTimeString();
            $news->whereBetween('created_at', [
                $startDate, $endDate
            ]);
        }*/

        //$data["data"] = $this->convertDataToResponse($news->paginate(10));
        //return response()->json($data);

        return response()->json(new NewsCollection($news->paginate($limit)));

    }

    private function convertDataToResponse($dataRaw){
        return $dataRaw->transform(function ($item, $key) {
            return [
                "news_id" => $item->id,
                "news_entry" => date('Y-m-d h:i:s', strtotime($item->created_at)),
                "news_last_update" => date('Y-m-d h:i:s', strtotime($item->updated_at)),
                "news_level" => $item->is_publised,
                "news_top_headline"=> $item->is_headline,
                "news_editor_pick"=> $item->editor_pick,
                "news_hot"=> $item->is_verify_age,
                "news_home_headline"=> $item->is_home_headline,
                "news_category_headline"=> $item->is_category_headline,
                "news_curated"=> $item->is_curated,
                "news_advertorial"=> $item->is_advertorial,
                "news_disable_interactions"=> $item->is_disable_interactions,
                "news_branded_content"=> $item->is_branded_content,
                "news_category" => [
                    "id" => $item->categories->id,
                    "name" => $item->categories->category,
                    "url" => $item->categories->slug,
                ],
                "news_title" => $item->title,
                "news_subtitle" => null,
                "news_synopsis" => $item->synopsis,
                "news_description" => $item->description,
                "news_content" => $item->content,
                "news_image_prefix" => $item->image,
                "news_image" => [
                    "real"=> null,
                ],
                "news_image_thumbnail" => [
                    "real" => null,
                ],
                "news_image_potrait" => [
                    "real"=> null,
                ],
                "news_image_headline" => null,
                "news_imageinfo" => null,
                "news_url" => $item->slug,
                "news_date_publish" => $item->published_at,
                "news_type" => $item->types,
                "news_reporter" => self::arrayUserToObjectUser(json_decode($item->reporters)),
                'news_editor' => self::arrayUserToObjectUserEditor(json_decode($item->contributors)),
                'news_photographer' => self::arrayUserToObjectUser(json_decode($item->photographers)),
                "news_hastag" => null,
                "news_city" => null,
                "news_sponsorship" => null,
                "has_paging" => count($item->news_paginations),
                "is_splitter" => null,
                "paging_style"=> null,
                "news_mature" => $item->is_adult_content,
                "news_seo_url" => $item->is_seo,
                "news_sensitive" => null,
                "news_top_headtorial" => null,
                "news_date_headtorial" => null,
                "tracker_dmp" => null,
                "special_event_name" => null,
                "news_id_import" => null,
                "news_guid" => null,
                "photonews" => [

                ],
                "video" => $item->video,
                "category_name" => $item->categories->category,
                "news_url_full" => env('APP_URL') . '/' . Str::slug(strtolower($item->categories->category)) . '/read/' . $item->slug,
                "news_url_full_mobile" => null,
                "news_paging" => $this->convertDataToResponse3($item->news_paginations),
                "news_paging_order" => null,
                "news_quote" => [

                ],
                "news_tag" => $this->convertDataToResponse2($item->tags),
                "news_keywords" => self::keywordResponse($item->keywords),
                "news_related" => [

                ],
                "news_dfp" => [

                ],
                "news_dmp" => [

                ],
                "cdn_image" => [
                    "klimg_url" => null,
                    "cdnimg_url"=> null,
                    "file_image" => null,
                    "file_image_thumbnail" => null,
                    "file_image_potrait" => null,
                ],
            ];
        });
    }

    private function convertDataToResponse2($dataRaw2){
        return $dataRaw2->transform(function ($item, $key) {
            return [
                "news_tag_id" => $item->pivot->id,
                "tag_id" => $item->id,
                "tag_name" => $item->tags,
                "tag_url" => $item->slug,
            ];
        });
    }

    private function convertDataToResponse3($dataRaw2){
        return $dataRaw2->transform(function ($item, $key) {
            return [
                "id" => $item->id,
                "no" => $item->order_by_no,
                "title" => $item->title,
                "type" => null,
                "url" => null,
                "content" => $item->content,
                "media" => null,
                "cdn_image" => [
                    "klimg_url" => null,
                    "cdnimg_url" => null,
                    "file_image" => null,
                ],
            ];
        });
    }

    private function arrayUserToObjectUser($array)
    {
        $temp = array();
        if ($array != null) {
            foreach ($array as $uuid) {
                array_push($temp,
                    self::userResponse($uuid)
                );
            }
        }
        return $temp;
    }

    private function arrayUserToObjectUserEditor($array)
    {
        $temp = array();
        if ($array != null) {
            foreach ($array as $uuid) {
                if (User::join('roles', 'users.role_id', '=', 'roles.id')
                    ->where('roles.role', "Editor")
                    ->where('uuid', $uuid)
                    ->exists())
                    array_push($temp,
                        self::userResponse($uuid)
                    );
            }
        }
        return $temp;
    }

    private function userResponse($uuid)
    {
        $userById = User::where('uuid', '=', $uuid)->get('name')->first();
        return [
            "id" => $uuid,
            "name" => $userById->name,
            "image" => null
        ];
    }

    private function keywordResponse($keywords)
    {
        if (!empty($keywords))
            return explode(',', $keywords);
    }

}
