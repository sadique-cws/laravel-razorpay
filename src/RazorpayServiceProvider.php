<?php

namespace Comestro\Razorpay;

use Illuminate\Support\ServiceProvider;

class RazorpayServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the package services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/razorpay.php' => config_path('razorpay.php'),
        ], 'razorpay-config');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/razorpay.php', 'razorpay'
        );

        $this->app->singleton('razorpay-service', function ($app) {
            return new RazorpayService();
        });
    }
}
