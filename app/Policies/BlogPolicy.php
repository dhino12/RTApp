<?php

namespace App\Policies;

use App\Models\Blogs;
use App\Models\User;

class BlogPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, Blogs $blog)
    {
        return $user->id == $blog->user_id;
    }

    public function delete()
    {
        
    }
}
