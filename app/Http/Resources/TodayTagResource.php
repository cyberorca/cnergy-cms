<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Category;
use App\Models\Tag;

class TodayTagResource extends JsonResource
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
            'id' => $this->id,
            'title' => $this->title,
            'type' => $this->types,
            'tag' => $this->tagResponse($this->tag_id),
            'category' => $this->categoryResponse($this->category_id),
            'order' => $this->order_by_no,
        ];
    }

    private function tagResponse($tag2)
    {
        $tag2 = Tag::where('tags', '=', $tag2)->get(['id', 'tags as name', 'slug as url'])->first();
        return $tag2;
    }

    private function categoryResponse($category2)
    {
        $category2 = Category::where('id', '=', $category2)->get(['id','category as name'])->first();
        return $category2;
    }
}
