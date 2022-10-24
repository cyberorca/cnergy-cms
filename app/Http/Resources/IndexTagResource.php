<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IndexTagResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "name" => $this->tags,
            "description" => "",
            "content" => null,
            "meta_title" => $this->meta_title,
            "meta_keywords" => $this->meta_keywords,
            "meta_description" => $this->meta_description,
            "is_headline" => 0,
            "is_recommended" => 0,
            "is_smart_tag" => 0,
            "slug" => $this->slug,
            "status" => $this->is_active,
            "display_tag" => null,
            "smart_tag_type" => null,
            "smart_tag_url" => null,

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

            "date_entry" => $this->created_at,
            "last_update" => $this->updated_at,
        ];
    }
}
