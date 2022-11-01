<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Model\user\category;
use Illuminate\Support\Facades\Auth;
use App\Model\user\like;
use App\Model\user\bookmark;
use App\User;

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
            'featuredImage' => $this->getresizedimage($this->image,"posts","300_"),
            'title' => $this->title,
            'desc' => $this->subtitle,
            'date' => optional($this->publish_date)->format('M d, y'),
            'href' => '/podcasts/'.$this->slug,
            'commentCount' => $this->commentsWithChildrenAndCommenter()->where("Approuve",0)->orWhereNull('Approuve')->count(),
            'viewdCount' => $this->post_view_count,
            'readingTime' => 0,
            'bookmark' => ['count' => $this->bookmark_count,
            'isBookmarked' => $this->checkisbookmarked($this->id),
             ],
            'like' => ['count' => $this->likes_count,
            'isLiked' => $this->checkislike($this->id),
            ],
            'authorId' => $st = isset($this->authors[0]) ? $this->authors[0]->id : 0,
            'categoriesId' => $this->categories->map(function ($categories) {return $categories->id;}),
            'categories' => $this->categories->map(function ($categories) {return CategorieminilistResource::make(category::withcount('posts_category')->where('id',$categories->id)->first());}),
            'postType' => "audio",
            'audioUrl' => $this->audio_link,
            
        ];
    }
    private function checkislike($id)
    {
        if (auth('api')->check())
        {
            $iduser = auth('api')->id();
        }else{
	    	return false;
    	}
        $likecheck = like::where(['user_id'=> $iduser,'post_id'=>$id])->first();
    	if ($likecheck) {
    		return true;
    	}else{
	    	return false;
    	}
    }
    private function checkisbookmarked($id)
    {
        if (auth('api')->check())
        {
            $iduser = auth('api')->id();
        }else{
	    	return false;
    	}

        $bookmarkecheck = bookmark::where(['user_id'=> $iduser,'post_id'=>$id])->first();
    	if ($bookmarkecheck) {
    		return true;
    	}else{
	    	return false;
    	}
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
