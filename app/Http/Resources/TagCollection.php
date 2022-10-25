<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class TagCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'data' => IndexTagResource::collection($this->collection),
            'attribute' => [
                "total_result"=>$this->count(),
                "next_page"=>$this->currentPage(),
                "next_url"=>$this->nextPageUrl(),
            ]];
    }
}
