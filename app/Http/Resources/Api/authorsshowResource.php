<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Model\user\post;


class authorsshowResource extends JsonResource
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
        'bgImage' => $this->getresizedimage($this->bgimage,"author/bg","1520x570_"),
        'count' =>  count($this->posts_author),
        'href' => '/author/'.$this->slug,
        'desc' => $this->description,   
        'jobName' => $this->job_name, 
        'socials' => [
            ['id' => 'Facebook', 
             'name' => 'Facebook', 
             'icon' => 'lab la-facebook-square',
             'href' => $this->link_facebook,
            ],
             [  'id' => 'Twitter', 
                'name' => 'Twitter', 
                'icon' => 'lab la-twitter',
                'href' => $this->link_twitter,
            ],
            [   'id' => 'Youtube', 
                'name' => 'Youtube', 
                'icon' => 'lab la-youtube',
                'href' => $this->link_youtube,
                ]
            ,
            [   'id' => 'Instagram', 
                'name' => 'Instagram', 
                'icon' => 'lab la-instagram',
                'href' => $this->link_Instagram,
            ]        
            ],
        'podcasts' =>  $this->posts_author->map(function ($podcasts) {return PostsminilistResource::make(post::with('tags','categories','authors','likes','bookmark')->where('id',$podcasts->id)->first());}),
       
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
