<?php

namespace App\Model\user;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    public function posts()
    {
    	return $this->belongsToMany('App\Model\user\post','category_posts')->orderBy('created_at','DESC')->paginate(5);
    }

    public function posts_category()
    {
    	return $this->belongsToMany('App\Model\user\post','category_posts')->where([["posts.status", '=', "1"], ["posts.visible", '=', "0"]])->whereDate('posts.publish_date', '<=', now());
    }

    public function getRouteKeyName()
    {
    	return 'slug';
    }
}
