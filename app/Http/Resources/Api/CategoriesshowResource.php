<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Model\user\post;

class CategoriesshowResource extends JsonResource
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
        'count' =>  count($this->posts_category),
        'color' => $this->color,
        'taxonomy' => "category",
        'podcasts' =>  $this->posts_category->map(function ($podcasts) {return PostsminilistResource::make(post::with('tags','categories','authors','likes','bookmark')->where('id',$podcasts->id)->first());}),

    ];
    }
}
