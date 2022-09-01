<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoriesResource extends ResourceCollection
{
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
        return CategorieminilistResource::collection($this->collection);
    }
}
