<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IndexStaticPageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => htmlspecialchars($this->content),
            'status' => $this->is_active,
            'show_footer' => '',
            'domain_id' => '',
            'created_by' => $this->created_by,
            'created_at' => self::formatDateArray($this->created_at),
            'updated_at' => self::formatDateArray($this->updated_at),
            'creator' => self::userArrayToCreatorResponse($this->users),
            'translate' => ''
        ];
    }

    private function formatDateArray($date){
        $timezone = date_timezone_get($date);
        return [
            'date' => date('Y-m-d H:m:s.u', strtotime($date)),
            'timezone_type' => 3,
            'timezone' => timezone_name_get($timezone),
        ];
    }

    private function userArrayToCreatorResponse($creator)
    {
        return [
            'user_uuid' => $creator->uuid,
            'user_realname' => $creator->name,
            'user_photo' => $creator->profile_image,
            'user_nowlogin'=>'',
            'user_loginip'=>'',
            'user_lastlogin'=>$creator->last_logged_in,
            'user_lastloginip'=>'',
            'user_rememberlogin'=>'',
            'expired_date'=>'',
            'user_canlogin'=>'',
            'user_domain_id'=>'',
            'level_id'=>'',
            'user_activation_hash'=>'',
            'is_super_user'=>'',
            'remember_token'=>''
        ];
    }
}
