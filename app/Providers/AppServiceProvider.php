<?php

namespace App\Providers;

use App\Service\Contracts\FileServiceContract;
use App\Service\Contracts\ParserServiceContract;
use App\Service\FileService;
use App\Service\Parser\ParserService;
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
        $this->app->bind(
            FileServiceContract::class,
            FileService::class
        );

        $this->app->bind(
            ParserServiceContract::class,
            ParserService::class
        );
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
