<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\Resource;

class PostsResource extends Resource
{

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        
        //    return parent::toArray($request);
        return [
            'id' => $this->id,
            'featuredImage' => asset('storage/posts/thumbs/300_'.$this->image),
            'title' => $this->title,
            'desc' => $this->subtitle,
            'date' => $this->updated_at->format('M d, y'),
            'href' => '/podcast/'.$this->slug,
            'commentCount' => 0,
            'viewdCount' => 0,
            'readingTime' => 0,
            'bookmark' => ['count' => $this->bookmark->count(),
            'isBookmarked' => false,
             ],
            'like' => ['count' => $this->likes->count(),
             'isLiked' => false,
            ],
            'author' => ['id' => $this->authors[0]->id,
             'name' => $this->authors[0]->name,
             'lastName' => $this->authors[0]->lastName,
             'displayName' => $this->authors[0]->name,
             'email' => $this->authors[0]->email,
             'avatar' => asset('storage/author/thumbs/300_'.$this->authors[0]->image),
             'count' => $this->count_authors,
             'href' => '/author/'. $this->authors[0]->slug,
             'desc' => $this->authors[0]->description,
             'jobName' => $this->authors[0]->jobName,
            ],
            'categories' => $this->categories->map(function ($categories) { return  ['id' => $categories->id,
                'name' => $categories->name,
                'href' => '/categories/'.$categories->slug,
                'thumbnail' => asset('storage/category/'.$categories->image),
                'count' =>  count($categories->pivot),
                'color' => $categories->color,
                'taxonomy' => "category"                
            ];}),
            'postType' => "audio",
            'audioUrl' => $this->audio_link,
            'tags' => $this->tags->map(function ($tags) { return  ['id' => $tags->id,
                'name' => $tags->name,
                'href' => '/tags/'.$tags->slug,
                'thumbnail' => asset('storage/tags/'.$tags->image),
                'count' =>  count($tags->pivot),
                'color' => $tags->color,
                'taxonomy' => "tags"                
            ];}),
            'content' => $this->body,
            'comments' => []
        ];
    }
}
