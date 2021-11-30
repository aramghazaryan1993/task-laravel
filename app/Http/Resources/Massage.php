<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Massage extends JsonResource
{
    /**
     * Class Massage
     * @package App\Http\Resources
     */

    /**
     * Transform the resource into an array.
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return $this->resource;
    }
}
