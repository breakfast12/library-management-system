<?php

namespace App\Providers;

use App\Repositories\Author\AuthorRepository;
use App\Repositories\BaseRepository;
use App\Repositories\Book\BookRepository;
use App\Repositories\Contracts\Author\AuthorContract;
use App\Repositories\Contracts\BaseContract;
use App\Repositories\Contracts\Book\BookContract;
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
        $this->app->bind(BookContract::class, BookRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
