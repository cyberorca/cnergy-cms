<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class IndexVideoResource extends JsonResource
{
    public function toArray($request): array
    {
        $category = new IndexCategoryResource($this->categories);
        return [
            'news_id' => $this->id,
            'news_entry' => date('Y-m-d h:i:s', strtotime($this->created_at)),
            'news_last_update' => date('Y-m-d h:i:s', strtotime($this->updated_at)),
            'news_level' => $this->is_publised,
            'news_top_headline' => $this->is_headline,
            'news_editor_pick' => $this->editor_pick,
            'news_hot' => $this->is_verify_age,
            'news_home_headline'=> $this->is_home_headline,
            'news_category_headline'=> $this->is_category_headline,
            'news_curated'=> $this->is_curated,
            'news_advertorial'=> $this->is_advertorial,
            'news_disable_interactions'=> $this->is_disable_interactions,
            'news_branded_content'=> $this->is_branded_content,
            'news_category' => $category,
            'news_title' => $this->title,
            'news_subtitle' => '',
            'news_synopsis' => $this->synopsis,
            'news_content' => $this->content,
            'news_description' => $this->description,
            'news_image_prefix' => '',
            'news_image' => '',
            'news_image_thumbnail' => '',
            'news_image_potrait' => '',
            'news_image_headline' => '',
            'news_imageinfo' => '',
            'news_url' => $this->slug,
            'news_date_publish' => $this->published_at,
            'news_type' => $this->types,
            'news_reporter' => self::arrayUserToObjectUser(json_decode($this->reporters)),
            'news_editor' => self::arrayUserToObjectUserEditor(json_decode($this->contributors)),
            'news_photographer' => self::arrayUserToObjectUser(json_decode($this->photographers)),
            'news_hastag' => '',
//            'news_city'=>'',
            'news_sponsorship' => '',
            'has_paging' => '',
            'is_splitter' => '',
            'paging_style' => '',
            'news_mature' => $this->is_adult_content,
            'news_seo_url' => $this->is_seo,
            'news_sensitive' => '',
            'news_top_headtorial' => '',
            'tracker_dmp' => '',
            'special_event_name' => '',
            'news_id_import' => '',
            'news_guide' => '',
            'photonews' => '',
            'category_name' => $category->category,
            'news_url_full' => env('APP_URL') . '/' . Str::slug(strtolower($category->category)) . '/read/' . $this->slug,
            'news_url_full_mobile' => '',
            'news_paging_order' => '',
            'news_quote' => '',
            'news_video' => $this->videoResponse($this->video),
            'news_tag' => IndexTagResource::collection($this->tags),
            'news_keywords' => self::keywordResponse($this->keywords),
            'news_related' => '',
            'news_dfp' => '',
            'news_dmp' => '',
            'cdn_image' => ''
        ];
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

    private function videoResponse($video)
    {
        return [
//            "id" => ,
            "video" => $video
        ];
    }
}
