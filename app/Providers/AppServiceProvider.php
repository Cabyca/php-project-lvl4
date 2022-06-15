<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
//        if (env('APP_ENV') != 'local') {
//            \URL::forceScheme('https');
//        }

        if (config('app.env') != 'local') {
            /** @phpstan-ignore-next-line */
            \URL::forceScheme('https');
        }

        Paginator::useBootstrapFive();
        //Paginator::useBootstrapFour();
        \Form::component('bsSelect', 'components.form.select', [
            'name', 'values', 'value' => null, 'attributes' => []
        ]);
        \Form::component('bsTextarea', 'components.form.textarea', [
            'name', 'value' => null, 'attributes' => []
        ]);
        \Form::component('bsText', 'components.form.text', [
            'name', 'value' => null, 'attributes' => []
        ]);
    }
}
