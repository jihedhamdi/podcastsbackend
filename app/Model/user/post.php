<?php

namespace App\Model\user;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class post extends Model
{

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => ['title', 'id']
            ]
        ];
    }
    public function tags()
    {
    	return $this->belongsToMany('App\Model\user\tag','post_tags')->withTimestamps();
    }

    public function categories()
    {
    	return $this->belongsToMany('App\Model\user\category','category_posts')->withTimestamps();;
    }
    public function authors()
    {
        return $this->belongsToMany('App\Model\user\authors','authors_posts')->withTimestamps();;
    }

    public function getRouteKeyName()
    {
    	return 'slug';
    }

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->diffForHumans();
    }

    public function likes()
    {
        return $this->hasMany('App\Model\user\like');
    }
    public function bookmark()
    {
        return $this->hasMany('App\Model\user\bookmark');
    }

    // public function getSlugAttribute($value)
    // {
    //     return route('post',$value);
    // }
}
