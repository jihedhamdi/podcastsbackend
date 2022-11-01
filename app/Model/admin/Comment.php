<?php

namespace App\Model\admin;
use App\Model\user\post;
use App\Model\user\User;
use tizis\laraComments\Entity\Comment as laraComment;
class Comment extends laraComment
{
    protected $fillable = [
        'commenter_id', 'commentable_type', 'commentable_id','comment','Approuve','child_id ','rating','created_at','updated_at', 'deleted_at'
    ];

    public function post()
    {
        return $this->hasOne(post::class, 'id','commentable_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'commenter_id');
    }
}
