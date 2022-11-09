<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class IndexInventoryResource extends JsonResource
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
            'inventory' => $this->inventory,
            'slot_name' => $this->slot_name,
            'type' => $this->type,
            'code' => $this->code,
            'template_id' => $this->template_id,
            'placement_id' => $this->placement_id,
            'size' => $this->size,
            'adunit_size' => $this->adunit_size,
            'domain_id' => '',
            'created_at' => date('Y-m-d H:i:s', strtotime($this->created_at)),
            'updated_at' => date('Y-m-d H:i:s', strtotime($this->updated_at)),
        ];
    }
}
