<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use App\Model\user\like;
use App\Model\user\bookmark;
use App\Model\user\authors;
use App\User;
use tizis\laraComments\Http\Resources\CommentResource;

class PostsResource extends JsonResource
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
            'featuredImage' => $this->getresizedimage($this->image,"posts","300_"),
            'title' => $this->title,
            'desc' => $this->subtitle,
            'date' => $this->publish_date->format('M d, y'),
            'href' => '/podcasts/'.$this->slug,
            'commentCount' => $this->commentsWithChildrenAndCommenter()->where("Approuve",0)->orWhereNull('Approuve')->count(),
            'viewdCount' => $this->post_view_count,
            'readingTime' => 0,
            'bookmark' => ['count' => $this->bookmark_count,
            'isBookmarked' => $this->checkisbookmarked($this->id),
             ],
            'like' => ['count' => $this->likes_count ,
             'isLiked' => $this->checkislike($this->id),
            ],
            'author' => ['id' => $this->authors[0]->id,
             'name' => $this->authors[0]->name,
             'lastName' => $this->authors[0]->lastName,
             'displayName' => $this->authors[0]->name,
             'email' => $this->authors[0]->email,
             'avatar' => $this->getresizedimage($this->authors[0]->image,"author","144x144_"),
             'count' => $this->countauthorarticles($this->authors[0]->id),
             'href' => '/author/'. $this->authors[0]->slug,
             'desc' => strip_tags($this->authors[0]->description),
             'jobName' => $this->authors[0]->jobName,
            ],
            'categories' => $this->categories->map(function ($categories) { return  ['id' => $categories->id,
                'name' => $categories->name,
                'href' => '/categories/'.$categories->slug,
                'thumbnail' => asset('storage/category/'.$categories->image),
                'count' =>  $categories->pivot->exists(),
                'color' => $categories->color,
                'taxonomy' => "category"                
            ];}),
            'postType' => "audio",
            'audioUrl' => $this->audio_link,
            'tags' => $this->tags->map(function ($tags) { return  ['id' => $tags->id,
                'name' => $tags->name,
                'href' => '/tags/'.$tags->slug,
                'thumbnail' => asset('storage/tags/'.$tags->image),
                'count' =>  $tags->pivot->exists(),
                'color' => $tags->color,
                'taxonomy' => "tags"                
            ];}),
            'content' => $this->body,
            'comments' => $this->getarticlecomments($this)
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

    private function countauthorarticles($id)
    {
        $authorscount = authors::withCount('posts_author')->where('authors.id',$id)->first();
        return $authorscount->posts_author_count;

    }
    private function getarticlecomments($model)
    {
        CommentResource::withoutWrapping();
        return  CommentResource::collection(
            $model->commentsWithChildrenAndCommenter()
                ->parentless()
                ->orderBy("created_at", "desc")
                ->get()
        );

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
