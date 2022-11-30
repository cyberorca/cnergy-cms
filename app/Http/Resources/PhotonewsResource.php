<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\ImageBank;

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
            'image' =>  $this->newsImage($this->image), 
            'description' => $this->description,
            'keywords' => $this->keywords,
            'photographer' => null,
            'copyright' => $this->copyright,
            'photo_id' => $this->photo_id,
            'cdn_image' => [
                'klimg_url' => '',
                'cdnimg_url' => '',
                'file_image' => '',
            ]
        ];
    }

    private function newsImage($image){
        if($image === NULL){
            return null;
        }else{
            return [
                "real" => env('APP_URL') . '/storage/' . $this->url
            ];
        }
    }
}
