<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class Product extends JsonResource
{
    /**
     * Class Product
     * @package App\Http\Resources
     */

    /**
     * Transform the resource into an array.
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'id'          => $this->resource->id,
            'name'        => $this->resource->name,
            'description' => $this->resource->description,
            'image'       => empty($this->resource->image) ? null : Storage::url($this->resource->image),
            'user_id'     => $this->resource->user_id,
            'tag_ids'     => $this->resource->getAllTagsId()->get()->pluck('id'),
        ];
    }
}

