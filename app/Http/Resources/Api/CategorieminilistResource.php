<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\Resource;

class CategorieminilistResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return ['id' => $this->id,
        'name' => $this->name,
        'href' => '/categories/'.$this->slug,
        'thumbnail' => asset('storage/category/'.$this->image),
        'count' =>  $this->posts_category_count,
        'color' => $this->color,
        'taxonomy' => "category"                
    ];
    }
}
