<?php

namespace App\Providers;

use App\Repositories\Author\AuthorRepository;
use App\Repositories\BaseRepository;
use App\Repositories\Contracts\Author\AuthorContract;
use App\Repositories\Contracts\BaseContract;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(BaseContract::class, BaseRepository::class);
        $this->app->bind(AuthorContract::class, AuthorRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
