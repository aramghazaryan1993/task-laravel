<?php

//namespace App\Http\Resources;
//use Illuminate\Http\Resources\Json\JsonResource;

//class Product extends JsonResource
//{
namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Support\Collection;

class Product extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
//    public function toArray($request)
//    {
//
//        //  return parent::toArray($request);
//        return [
//            'id' => $this->resource->id,
//            'name' => $this->name,
//            'description' => $this->description,
//            'image' => $this->image,
//            'user_id' => $this->user_id,
//            'created_at' => $this->created_at->format('d/m/Y'),
//            'updated_at' => $this->updated_at->format('d/m/Y'),
//        ];
//    }

    public function toArray($request)
    {

        return $this->collection->map(function ($item) {

            $a  =   (object) $item;
            return [
                 'id' => $a->id,
                 'name' => $a->name,
                 'description' => $a->description,
                 'image' => $a->user_id,
                 'created_at' => $a->created_at,
                 'updated_at' => $a->updated_at,

                'get_product' => array_map(function ($product)
                {
                    $b  =   (object) $product;

                     return [
                         'id'=>$b->id,
                         'tag_name'=>$b->tag_name,
                         'created_at'=>$b->created_at,
                         'updated_at'=>$b->updated_at,

                        'pivot' => array_map(function ($pivot)
                        {
                            $c =   (object) $pivot;

                            return [
                               $k = $c->scalar,

//                                'product_id' => array_map(function ($product_id)
//                                {
//                                    $d = (object) $product_id;
////                                    return [
////                                        'id'=>$d
////                                    ];
//
//                                },   $k['product_id'])

                            ];
                        },  $b->pivot)
                    ];

                },  $a->get_product)
            ];
        });
    }
}

