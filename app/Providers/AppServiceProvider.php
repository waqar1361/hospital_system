<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        Schema::defaultStringLength(191);
    }
    
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        Blade::if('admin', function () {
            return Auth::user()->type == 'admin';
        });
        Blade::if('Doctor', function () {
            return (Auth::user()->type == 'admin' or Auth::user()->type == 'doctor' or Auth::user()->type == 'nurse');
        });
        Blade::if('Editable', function ($visit) {
            return $visit->updated_at->diffInHours(now()) < 24 && $visit->status == 'discharged';
        });
    }
}
