<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Blogs;
use App\Models\GalleryActivities;
use App\Models\User;
use App\Policies\BlogPolicy;
use App\Policies\GalleryPolicy;
use App\Policies\ProfilePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Blogs::class => BlogPolicy::class,
        GalleryActivities::class => GalleryPolicy::class,
        User::class => ProfilePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
