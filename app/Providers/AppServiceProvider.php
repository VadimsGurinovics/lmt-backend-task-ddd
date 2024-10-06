<?php

namespace App\Providers;

use App\Domain\Product\Repositories\ProductSetRepositoryInterface;
use App\Infrastructure\Persistence\Repositories\ProductSetRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Bind the interface to the concrete implementation
        $this->app->bind(ProductSetRepositoryInterface::class, ProductSetRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
