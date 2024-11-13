<?php

namespace App\Providers;

use App\Core\Contracts\CategoryRepositoryInterface;
use App\Core\Contracts\ResponseRepositoryInterface;
use App\Core\Contracts\TopicRepositoryInterface;
use App\Core\Contracts\UserRepositoryInterface;
use app\Infrastructure\Repositories\CategoryRepository;
use app\Infrastructure\Repositories\ResponseRepository;
use app\Infrastructure\Repositories\TopicRepository;
use app\Infrastructure\Repositories\UserRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        App::bind(UserRepositoryInterface::class, UserRepository::class);
        App::bind(TopicRepositoryInterface::class, TopicRepository::class);
        App::bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        App::bind(ResponseRepositoryInterface::class, ResponseRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
