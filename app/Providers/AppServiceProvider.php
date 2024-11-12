<?php

namespace App\Providers;

use App\Core\Contracts\TopicRepositoryInterface;
use App\Core\Contracts\UserRepositoryInterface;
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
        App::bind(UserRepositoryInterface::class,UserRepository::class);
        App::bind(TopicRepositoryInterface::class,TopicRepository::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
