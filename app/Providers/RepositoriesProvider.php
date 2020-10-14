<?php

namespace App\Providers;
use App\Interfaces\UserRepositoryInterface;

use App\Repositories\UserRepositories;
use Illuminate\Support\ServiceProvider;

class RepositoriesProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepositories::class);

    }
}
