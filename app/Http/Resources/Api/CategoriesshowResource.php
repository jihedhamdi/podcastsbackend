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
        'thumbnail' => $this->getresizedimage($this->image,"category","1520x475_"),
        'count' =>  count($this->posts_category),
        'color' => $this->color,
        'taxonomy' => "category",
        'podcasts' =>  $this->posts_category->map(function ($podcasts) {return PostsminilistResource::make(post::withcount('tags', 'categories', 'authors', 'likes', 'bookmark', 'postView')->where([['id','=',$podcasts->id], ["posts.status", '=', "1"], ["posts.visible", '=', "0"]])->whereDate('publish_date', '<=', now())->first());}),

    ];
    }
    private function getresizedimage($imagename,$directory,$dimension)
    {
        if ($imagename != "")
        {
            $info = pathinfo($imagename);
            $resizedimagename = asset('storage/'.$directory.'/thumbs/'.$dimension.basename($imagename,'.'.$info['extension']).'.webp');
            return $resizedimagename;
        }else{
	    	return "";
    	}

    }
}
