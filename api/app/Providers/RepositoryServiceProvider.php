<?php

namespace App\Providers;

use App\Repositories\CompanyRepository;
use App\Repositories\CompanyRepositoryInterface;
use App\Repositories\RecoverPasswordsRepository;
use App\Repositories\RecoverPasswordsRepositoryInterface;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(CompanyRepositoryInterface::class, CompanyRepository::class);
        $this->app->bind(RecoverPasswordsRepositoryInterface::class, RecoverPasswordsRepository::class);
    }

}
