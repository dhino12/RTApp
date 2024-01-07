<?php

namespace App\Policies;

use App\Models\Blogs;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
        $roleName = Auth::user()->roles->pluck('name')[0];
        return $user->id == $blog->user_id || $roleName == "superadmin" || $roleName == "admin";
    }
    
    public function delete(User $user, Blogs $blog)
    {
        $roleName = Auth::user()->roles->pluck('name')[0];
        return $user->id == $blog->user_id || $roleName == "superadmin" || $roleName == "admin";
    }
}
