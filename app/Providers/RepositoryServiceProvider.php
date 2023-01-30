<?php

namespace App\Providers;

use App\Interfaces\AdminRepositoryInterface;
use App\Interfaces\AuthRepositoryInterface;
use App\Interfaces\TransactionRepositoryInterface;
use App\Interfaces\TripRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use App\Repository\AdminRepository;
use App\Repository\AuthRepository;
use App\Repository\TransactionRepository;
use App\Repository\TripRepository;
use App\Repository\UserRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(TransactionRepositoryInterface::class, TransactionRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(TripRepositoryInterface::class, TripRepository::class);
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
