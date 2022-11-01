<?php

namespace App\Policies;

use App\Model\admin\admin;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the admin can view the post.
     *
     * @param  \App\admin  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function view(admin $user)
    {
        //
    }

    /**
     * Determine whether the admin can create posts.
     *
     * @param  \App\admin  $user
     * @return mixed
     */
    public function create(admin $user)
    {
        return $this->getPermission($user,4);
    }

    /**
     * Determine whether the admin can update the post.
     *
     * @param  \App\admin  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function update(admin $user)
    {
        return $this->getPermission($user,5);
    }

    /**
     * Determine whether the admin can delete the post.
     *
     * @param  \App\admin  $user
     * @param  \App\Post  $post
     * @return mixed
     */
    public function delete(admin $user)
    {
        return $this->getPermission($user,6);
    }

    public function tag(admin $user)
    {
        return $this->getPermission($user,11);
    }

    public function category(admin $user)
    {
        return $this->getPermission($user,12);
    }
    public function page_informative(admin $user)
    {
        return $this->getPermission($user,13);
    }
    public function client(admin $user)
    {
        return $this->getPermission($user,14);
    }
   
    public function auteur(admin $user)
    {
        return $this->getPermission($user,15);
    }
    public function comments(admin $user)
    {
        return $this->getPermission($user,16);
    }
    protected function getPermission($user,$p_id)
    {
        foreach ($user->roles as $role) {
            foreach ($role->permissions as $permission) {
                if ($permission->id == $p_id) {
                    return true;
                }
            }
        }
        return false;
    }
}
