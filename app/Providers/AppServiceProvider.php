<?php

namespace App\Providers;

use App\Models\ProductOption;
use App\Models\ReturnItem;
use App\Observers\ProductOptionObserver;
use App\Observers\ReturnItemObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        ProductOption::observe(ProductOptionObserver::class);
        ReturnItem::observe(ReturnItemObserver::class);
    }
}
