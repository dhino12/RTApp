<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfilePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function read(User $user)
    {
        return $user->id == auth()->user()->id;
    }

    public function update(User $user)
    {
        return $user->id == auth()->user()->id;
    }
    
    public function delete(User $user)
    {
        return $user->id == auth()->user()->id;
    }
}
