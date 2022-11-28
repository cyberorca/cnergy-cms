<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IndexFrontEndMenuResource extends JsonResource
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
            'parent' => $this->parent_id,
            'title'=>$this->title,
            'url'=> $this->slug,
            'type'=>'link',
            'target'=> $this->target($this->target),
            'order'=>$this->order,
            'position'=>json_decode($this->position),
            'children'=>$this->convertDataToResponse($this->childMenus)
        ];
    }

    private function convertDataToResponse($dataRaw){ 
        return $dataRaw->transform(function ($item, $key) {
            return [
                'id' => $item->id,
                'parent' => $item->parent_id,
                'title'=>$item->title,
                'url'=> $this->slug,
                'type'=>'link',
                'target'=> $this->target($this->target),
                'order'=>$item->order,
                'position'=>json_decode($item->position),
                'children'=>$this->convertDataToResponse($item->childMenus)
            ];
        });
    }

    private function target($target){
        if($target == 'Same Tab'){
            return 'self';
        } elseif ($target == 'New Window') {
            return 'blank';
        }
    }
}
