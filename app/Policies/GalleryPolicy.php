<?php

namespace App\Policies;

use App\Models\GalleryActivities;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GalleryPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function update(User $user, GalleryActivities $blog)
    {
        $roleName = Auth::user()->roles->pluck('name')[0];
        return $user->id == $blog->user_id || $roleName == "superadmin" || $roleName == "admin";
    }

    public function delete(User $user, GalleryActivities $blog)
    {
        $roleName = Auth::user()->roles->pluck('name')[0];
        return $user->id == $blog->user_id || $roleName == "superadmin" || $roleName == "admin";
    }
}
