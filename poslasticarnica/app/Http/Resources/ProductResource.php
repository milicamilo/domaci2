<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);

        return [
            'id'=>$this->resource->id,
            'product_name'=>$this->resource->product_name,
            'description'=>$this->resource->description,
            'price'=>$this->resource->price,
            'ingredients'=>$this->resource->ingredients,
        ];
    }
}
