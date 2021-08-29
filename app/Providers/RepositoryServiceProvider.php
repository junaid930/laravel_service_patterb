<?php

namespace App\Providers;

use App\Repositories\EloquentRepositoryInterface;
use App\Repositories\Eloquent\BaseRepository;

use App\Repositories\UserRepositoryInterface;
use App\Repositories\Eloquent\UserRepository;

use App\Repositories\ArticleRepositoryInterface;
use App\Repositories\Eloquent\ArticleRepository;

use App\Repositories\TagRepositoryInterface;
use App\Repositories\Eloquent\TagRepository;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ArticleRepositoryInterface::class, ArticleRepository::class);
        $this->app->bind(TagRepositoryInterface::class, TagRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
