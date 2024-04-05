<?php

namespace App\Providers;

use App\Interfaces\QuoteRepositoryInterface;
use App\Interfaces\TransactionRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\QuoteRepository;
use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(QuoteRepositoryInterface::class, QuoteRepository::class);
        $this->app->bind(TransactionRepositoryInterface::class, TransactionRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
