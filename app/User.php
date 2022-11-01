<?php

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\MailResetPasswordNotification;
use tizis\laraComments\Traits\Commenter;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable,Commenter;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    public function verifyUser()
    {
        return $this->hasOne('App\VerifyUser');
    }
    public function linkedSocialAccounts()
    {
        return $this->hasMany('App\Model\user\LinkedSocialAccount');
    }

    public function getId()
        {
        return $this->id;
        }
    
    //user bookmarks relationship
    
    public function bookmarks()
    {
        return $this->belongsToMany('App\Model\user\post', 'bookmarks', 'user_id', 'post_id')->withcount('tags','categories','authors','likes','bookmark','postView')->where([["status", '=',"1"],["visible", '=',"0"],])->whereDate('publish_date','<=',now())->orderBy("bookmarks.updated_at","DESC");
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

     /**
     * Sends the password reset notification.
     *
     * @param  string $token
     *
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new MailResetPasswordNotification($token));
    }

    
}
