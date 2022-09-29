<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Model\user\post;

class tagsshowResource extends JsonResource
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
        'count' =>  count($this->tags_posts),
        'color' => $this->color,
        'taxonomy' => "tag",
        'podcasts' =>  $this->tags_posts->map(function ($podcasts) {return PostsminilistResource::make(post::with('tags','categories','authors','likes','bookmark')->where('id',$podcasts->id)->first());}),

    ];
    }
}
