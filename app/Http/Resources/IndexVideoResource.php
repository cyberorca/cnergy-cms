<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class IndexVideoResource extends JsonResource
{
    public function toArray($request): array
    {
        $category = new IndexCategoryResource($this->categories);
        return [
            'news_id' => $this->id,
            'news_entry' =>date('Y-m-d h:i:s', strtotime($this->created_at)),
            'news_last_update'=>date('Y-m-d h:i:s', strtotime($this->updated_at)),
            'news_level' => '',
            'news_top_headline' =>$this->is_headline,
            'news_editor_pick' =>$this->editor_pick,
            'news_hot' =>'',
            'news_category' =>$category,
            'news_title' =>$this->title,
            'news_subtitle' =>'',
            'news_synopsis' =>$this->synopsis,
            'news_content' => $this->content,
            'news_image_prefix' => '',
            'news_image' => '',
            'news_image_thumbnail' =>'',
            'news_image_potrait' =>'',
            'news_image_headline'=>'',
            'news_imageinfo'=>'',
            'news_url'=>$this->slug,
            'news_date_publish'=>$this->published_at,
            'news_type'=>$this->types,
            'news_reporter'=>'',
            'news_editor'=>'',
            'news_photographer'=>'',
            'news_hastag'=>'',
//            'news_city'=>'',
            'news_sponsorship'=>'',
            'has_paging'=>'',
            'is_splitter'=>'',
            'paging_style'=>'',
            'news_mature'=>$this->is_adult_content,
            'news_seo_url'=>$this->is_seo,
            'news_sensitive'=>'',
            'news_top_headtorial'=>'',
            'tracker_dmp'=>'',
            'special_event_name'=>'',
            'news_id_import'=>'',
            'news_guide'=>'',
            'photonews'=>'',
            'category_name'=>$category->category,
            'news_url_full'=>env('APP_URL').'/'.Str::slug(strtolower($category->category)).'/read/'.$this->slug,
            'news_url_full_mobile'=>'',
            'news_paging_order'=>'',
            'news_quote'=>'',
            'news_video'=>'',
            'news_tag'=>'',
            'news_keywords'=>$this->keywords,
            'news_related'=>'',
            'news_dfp'=>'',
            'news_dmp'=>'',
            'cdn_image'=>''
        ];
    }
}
