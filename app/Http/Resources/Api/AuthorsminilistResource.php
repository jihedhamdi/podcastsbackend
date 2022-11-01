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
        'avatar' => $this->getresizedimage($this->image,"author","144x144_"),
        'bgImage' => $this->getresizedimage($this->bgimage,"author/bg","228x196_"),
        'count' =>  $this->posts_author_count,
        'href' => '/author/'.$this->slug,
        'desc' => $this->description,   
        'jobName' => $this->job_name,        
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
