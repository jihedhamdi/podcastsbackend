<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthorsminilistResource extends JsonResource
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
        'firstName' => $this->first_name,
        'lastName' => $this->last_name,
        'displayName' => $this->name,
        'email' => $this->email,
        'gender' => $this->gender,
        'avatar' => asset('storage/author/'.$this->image),
        'bgImage' => asset('storage/author/bg/'.$this->bgimage),
        'count' =>  $this->posts_author_count,
        'href' => '/author/'.$this->slug,
        'desc' => $this->description,   
        'jobName' => $this->job_name,        
    ];
    }
}
