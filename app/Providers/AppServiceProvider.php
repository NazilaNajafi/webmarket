<?php

namespace App\Providers;

use App\Group;
use App\Product;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        view()->composer('layout.main-layout', function ($view) {
            $groups = Group::whereNull('parent_id')->with('subgroups.products')->get();
            $view->with(['groups' => $groups]);

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
