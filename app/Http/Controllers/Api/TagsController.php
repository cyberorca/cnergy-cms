<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;

class TagsController extends Controller
{
    public function index()
    {
        $data = Tag::all();

        foreach ($data as $tags) {
            $res["data"][] = [
                "id" => $tags->id,
                "name" => $tags->tags,
                "description" => "",
                "content" => null,
                "meta_title"=> "",
                "meta_keyword"=> "",
                "meta_description"=> "",
                "is_headline" => 0,
                "is_recommended" => 0,
                "is_smart_tag" => 0,
                "slug" => $tags->slug,
                "status" => $tags->is_active,
                "display_tag"=> null,
                "smart_tag_type"=> null,
                "smart_tag_url"=> null,

                "smart_tag" => [
                    "id" => null,
                    "name" => null,
                    "url" => null,
                ],

                "related_creator" => [],
                "related_tag" => [],

                "image" => [
                    "real" => "",
                ],

                "date_entry" => $tags->created_at,
                "last_update" => $tags->updated_at,
            ];
        }

        /*$data = [ "data" =>
            ([
                "id" => $tags["id"],
                "name" => $tags["tags"],
                "description" => "",
                "content" => null,
                "meta_title"=> "",
                "meta_keyword"=> "",
                "meta_description"=> "",
                "is_headline" => 0,
                "is_recommended" => 0,
                "is_smart_tag" => 0,
                "slug" => $tags["slug"],
                "status" => $tags["is_active"],
                "display_tag"=> null,
                "smart_tag_type"=> null,
                "smart_tag_url"=> null,

                "smart_tag" => [
                    "id" => null,
                    "name" => null,
                    "url" => null,
                ],

                "related_creator" => [],
                "related_tag" => [],

                "image" => [
                    "real" => "",
                ],

                "date_entry" => $tags["created_at"],
                "last_update" => $tags["updated_at"],
            ])
        ];*/

        return response()->json($res);

    }
}
