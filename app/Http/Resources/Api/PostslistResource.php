<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PostslistResource extends ResourceCollection
{
    public function boot()
    {
        ResourceCollection::withoutWrapping();
    }
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
   /*public function toArray($request)
    {
        return parent::toArray($request);
    }*/
     public function toArray($request)
    {
        return PostsminilistResource::collection($this->collection);
    }

}
