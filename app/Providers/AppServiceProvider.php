<?php

namespace App\Providers;

use App\EchofaUser;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Auth::extend('EchofaGuard', function(){
            return new EchofaGuard();
        });
        Auth::provider('EchofaUserProvider', function(){
           return new EChofaUserProvider();
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
