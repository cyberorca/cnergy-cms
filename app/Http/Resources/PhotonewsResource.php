<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PhotonewsResource extends JsonResource
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
            'url' => $this->slug,
            'image' => [
                'real' => ''
            ],
            'description' => $this->description,
            'keywords' => $this->keywords,
            'photographer' => null,
            'copyright' => $this->copyright,
            'photo_id' => '',
            'cdn_image' => [
                'klimg_url' => '',
                'cdnimg_url' => '',
                'file_image' => '',
            ]
        ];
    }
}
