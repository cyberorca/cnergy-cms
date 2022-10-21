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
            'content' => $this->content,
            'status' => $this->is_active,
            'show_footer' => '',
            'domain_id' => '',
            'created_by' => $this->created_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'creator' => self::userArrayToCreatorResponse($this->users),
            'translate' => ''
        ];
    }

    private function userArrayToCreatorResponse($creator)
    {
        return [
            'user_id' => $creator->id,
            'user_realname' => $creator->name,
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
