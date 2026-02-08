<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(RepositoryServiceProvider::class);

        $this->app->bind(\App\Contracts\PaymentGatewayInterface::class, function ($app) {
            $driver = config('services.payment_gateway.driver', 'asaas');

            if ($driver === 'cielo') {
                return $app->make(\App\Services\Payment\CieloAdapter::class);
            }

            return $app->make(\App\Services\Payment\AsaasAdapter::class);
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
