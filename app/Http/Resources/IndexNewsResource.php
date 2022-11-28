<?php

namespace App\Http\Resources;
use App\Models\User;
use App\Models\ImageBank;
use Illuminate\Support\Str;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexNewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $category = new IndexCategoryResource($this->categories);
        return [
            "news_id" => $this->id,
            "news_entry" => date('Y-m-d G:i:s', strtotime($this->created_at)),
            "news_last_update" => date('Y-m-d G:i:s', strtotime($this->updated_at)),
            "news_level" => $this->is_published,
            "news_top_headline"=> $this->is_headline,
            "news_editor_pick"=> $this->editor_pick,
            "news_hot"=> null,
            "news_home_headline"=> $this->is_home_headline,
            "news_category_headline"=> $this->is_category_headline,
            "news_curated"=> $this->is_curated,
            "news_advertorial"=> $this->is_advertorial,
            "news_disable_interactions"=> $this->is_disable_interactions,
            "news_branded_content"=> $this->is_branded_content,
            "news_category" => $category,
            "news_title" => $this->title,
            "news_subtitle" => null,
            "news_synopsis" => $this->synopsis,
            "news_description" => $this->description,
            "news_content" => htmlspecialchars($this->content),
            "news_image_prefix" => '/trstdly/',
            /*"news_image" => [
                "real"=> $this->image,
            ],*/
            "news_image" => $this->newsImage($this->image),
            "news_image_thumbnail" => [
                "real" => null,
            ],
            "news_image_potrait" => [
                "real"=> null,
            ],
            "news_image_headline" => null,
            "news_imageinfo" => $this->newsImageInfo($this->image),
            "news_url" => $this->slug,
            "news_date_publish" => $this->published_at,
            "news_type" => $this->types,
            "news_reporter" => self::arrayUserToObjectUser(json_decode($this->reporters)),
            'news_editor' => self::arrayUserToObjectUserEditor(json_decode($this->contributors)),
            'news_photographer' => self::arrayUserToObjectUser(json_decode($this->photographers)),
            "news_hastag" => null,
            "news_city" => null,
            "news_sponsorship" => null,
            "has_paging" => count($this->news_paginations),
            "is_splitter" => null,
            "paging_style"=> null,
            "news_mature" => $this->is_adult_content,
            "news_seo_url" => $this->is_seo,
            "news_sensitive" => $this->is_verify_age,
            "news_top_headtorial" => null,
            "news_date_headtorial" => null,
            "tracker_dmp" => null,
            "special_event_name" => null,
            "news_id_import" => null,
            "news_guid" => null,
            "photonews" => [

            ],
            "video" => $this->video,
            "category_name" => $category->category,
            "news_url_full" => env('APP_URL') . '/' . Str::slug(strtolower($this->categories->category)) . '/read/' . $this->slug,
            "news_url_full_mobile" => null,
            "news_paging" => $this->convertDataToResponse3($this->news_paginations),
            "news_paging_order" => 'asc',
            "news_quote" => [

            ],
            "news_tag" => $this->convertDataToResponse2($this->tags),
            "news_keywords" => $this->convertDataToResponse4($this->keywords),
            //"news_keywords" => self::keywordResponse($this->keywords),
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
    }

    private function newsImage($image){
        if($image === NULL){
            return null;
        }else{
            return [
                "real" => env('APP_URL') . '/' . $this->image
            ];
        }
    }

    private function newsImageInfo($image2){
        if($image2 === NULL){
            return null;
        }else{
            $info = ImageBank::where('slug', '=', $image2)->get('description')->first();
            if($info === NULL){
                return null;
            }else{
                return $info->description;
            }
        }
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
                "type" => 'text',
                "url" =>  $item->slug,
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

    private function convertDataToResponse4($dataRaw2){
        return $dataRaw2->transform(function ($item, $key) {
            return [
                "news_keyword_id" => $item->pivot->id,
                "keyword_id" => $item->id,
                "keyword_name" => $item->keywords,
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
        $userById = User::where('uuid', '=', $uuid)->get(['name','profile_image'])->first();
        return [
            "id" => $uuid,
            "name" => $userById->name,
            "image" => $userById->profile_image
        ];
    }

    private function keywordResponse($keywords)
    {
        if (!empty($keywords))
            return explode(',', $keywords);
    }
}
