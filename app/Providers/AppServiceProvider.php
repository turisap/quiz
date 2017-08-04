<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext as PayPal;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('baseviews.navbar', function ($view) {
            $view->with('categories', \App\Category::categories());
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(PayPal::class, function () {
            return new PayPal(new OAuthTokenCredential(config('paypal.client_id'), config('paypal.secret')));
        });
    }
}
