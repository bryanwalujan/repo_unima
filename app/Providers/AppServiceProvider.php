<?php
namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\RecommendationService;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(RecommendationService::class, function ($app) {
            return new RecommendationService();
        });
    }

    public function boot()
    {
        //
    }
}