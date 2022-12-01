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
            "reldomain" => [
                "domain_name" => $this->domain_name,
                "rubrics_area" => " ",
                "image_group" => " ",
                "domain_url" => $this->domain_url,
                "domain_mobile_url" => $this->domain_url_mobile,
                "default_image_copyright" => "&copy; 2022 trstd.ly",
                "image_info" => $this->image_info,
                "url_format" => " ",
                "logo_url" => $this->logo_url,
                "fanspage_id" => " ",
                "cse_id" => $this->cse_id,
                "gtm_id" => $this->gtm_id,
                "advertiser_id" => $this->advertiser_id,
                "email_domain" => $this->email_domain,
                "code_data_studio" => $this->embed_code_data_studio,
                "robots_txt" => $this->robot_txt,
                "ads_txt" => $this->ads_txt,
            ],
            "cdn_image" => [
                "klimg_url" => "",
                "cdnimg_url" => "",
                "file_image" => "",
                "file_image_thumbnail" => "",
                "file_image_potrait" => "",
            ]
        ];

        return [
            "status" =>200,
            "data"=>$data
        ];
    }

}
