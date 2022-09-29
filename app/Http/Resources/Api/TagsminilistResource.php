<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class TagsminilistResource extends JsonResource
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
        'href' => '/tags/'.$this->slug,
        'thumbnail' => asset('storage/tags/'.$this->image),
        'count' =>  $this->tags_posts_count,
        'color' => $this->color,
        'taxonomy' => "tag"                
    ];
    }
}
