<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Model\user\category;

class PostsminilistResource extends JsonResource
{
    public function boot()
{
    JsonResource::withoutWrapping();
}
    /**
     * Transform the resource into an array.
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
        //    return parent::toArray($request);
        return [
            'index' => $this->id,
            'id' => $this->id,
            'featuredImage' => asset('storage/posts/thumbs/300_'.$this->image.'.webp'),
            'title' => $this->title,
            'desc' => $this->subtitle,
            'date' => $this->updated_at->format('M d, y'),
            'href' => '/podcasts/'.$this->slug,
            'commentCount' => 0,
            'viewdCount' => 0,
            'readingTime' => 0,
            'bookmark' => ['count' => $this->bookmark->count(),
            'isBookmarked' => false,
             ],
            'like' => ['count' => $this->likes->count(),
             'isLiked' => false,
            ],
            'authorId' => $this->authors[0]->id,
            'categoriesId' => $this->categories->map(function ($categories) {return $categories->id;}),
            'categories' => $this->categories->map(function ($categories) {return CategorieminilistResource::make(category::withcount('posts_category')->where('id',$categories->id)->first());}),
            'postType' => "audio",
            'audioUrl' => $this->audio_link,
            
        ];
    }
}
