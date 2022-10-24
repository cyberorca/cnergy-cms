<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;

class TagsController extends Controller
{
    public function index(Request $request)
    {

        $tag = Tag::paginate($request->get('limit', 10))->withQueryString();

        $data["data"] = $this->convertDataToResponse($tag);
        // return response()->json($data);
        return response()->json($data);

    }

    private function convertDataToResponse($dataRaw){
        return $dataRaw->transform(function ($item, $key) {
            return [
                "id" => $item->id,
                "name" => $item->tags,
                "description" => "",
                "content" => null,
                "meta_title"=> "",
                "meta_keyword"=> "",
                "meta_description"=> "",
                "is_headline" => 0,
                "is_recommended" => 0,
                "is_smart_tag" => 0,
                "slug" => $item->slug,
                "status" => $item->is_active,
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

                "date_entry" => $item->created_at,
                "last_update" => $item->updated_at,
            ];
        });
    }
}
