<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class NewsCollection extends ResourceCollection
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
            'data' => IndexNewsResource::collection($this->collection),
            'attribute' => [
                "total_result"=>$this->count(),
                "total_row" =>  $this->total(),
                "per_page" =>  $this->perPage(),
                "current_page" => $this->currentPage(),
                "last_page" =>  $this->lastPage(),
            ]];
    }
}
