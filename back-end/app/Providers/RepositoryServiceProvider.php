<?php

namespace App\Providers;

use App\Repositories\Contracts\Seller\SellerRepositoryInterface;
use App\Repositories\Seller\SellerRepository;
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
        $this->app->bind(
            SellerRepositoryInterface::class,
            SellerRepository::class
        );
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
