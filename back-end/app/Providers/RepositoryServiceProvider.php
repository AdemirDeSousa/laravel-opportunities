<?php

namespace App\Providers;

use App\Repositories\Client\ClientRepository;
use App\Repositories\Contracts\Client\ClientRepositoryInterface;
use App\Repositories\Contracts\Opportunity\OpportunityRepositoryInterface;
use App\Repositories\Contracts\Product\ProductRepositoryInterface;
use App\Repositories\Contracts\Seller\SellerRepositoryInterface;
use App\Repositories\Opportunity\OpportunityRepository;
use App\Repositories\Product\ProductRepository;
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

        $this->app->bind(
            ClientRepositoryInterface::class,
            ClientRepository::class
        );

        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );

        $this->app->bind(
            OpportunityRepositoryInterface::class,
            OpportunityRepository::class
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
