<?php

namespace App\Providers;

use App\Repositories\Repository\PaymentRepository;
use App\Repositories\Repository\ReservationRepository;
use App\Repositories\Repository\RestaurantRepository;
use App\Repositories\Repository\UserRepository;
use App\Services\Services\PaymentService;
use App\Services\Services\ReservationService;
use App\Services\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('UserService', function (){
            return new UserService(new UserRepository());
        });

        $this->app->bind('PaymentService', function (){
            return new PaymentService(new PaymentRepository(), new ReservationRepository());
        });

        $this->app->bind('ReservationService', function (){
            return new ReservationService(new ReservationRepository(), new RestaurantRepository());
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
