<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IndexFrontEndSettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $data = [
            "id" => $this->id,
            "title" => $this->site_title,
            "address" => $this->address,
            "sosmed" => json_encode([
                "fb" => $this->facebook,
                "ig" => $this->instagram,
                "youtube" => $this->youtube,
                "twitter" => $this->twitter,
            ]),
            "site_logo" => $this->site_logo,
            "favicon" => $this->favicon,
            "color" => $this->accent_color,
            "domain_id" => "",
            "site_description" => $this->site_description,
            "fb_app_id" => $this->facebook_app_id,
            "twitter_username" => $this->twitter_username,
            "created_at" => date('Y-m-d H:i:s', strtotime($this->created_at)),
            "updated_at" => date('Y-m-d H:i:s', strtotime($this->updated_at)),
        ];

        return [
            "status" =>200,
            "data"=>$data
        ];
    }

}
