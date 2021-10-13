<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\FeedbackStatus;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('feedback.*', function($view) {
            $view->with(['statuses' => FeedbackStatus::all()]);
        });
    }
}
