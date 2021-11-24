<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;
class Product extends JsonResource
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
            'id'          => $this->id,
            'name'        => $this->name,
            'description' => $this->description,
            'image'       => empty($this->resource->image) ? null : Storage::url( 'public/' .$this->resource->image),
            'user_id'     => $this->user_id,
            'tag_ids'     => empty(count($this->resource->getAllTagsId()->get(['id as tag_id']))>=1) ? null : $this->resource->getAllTagsId()->get(['id as tag_id']),
        ];
    }


}

