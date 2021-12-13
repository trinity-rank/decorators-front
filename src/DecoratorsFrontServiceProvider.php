<?php

namespace Trinityrank\DecoratorsFront;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Trinityrank\DecoratorsFront\Commands\DecoratorsFrontCommand;

class DecoratorsFrontServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('decorators-front');
    }

    public function bootingPackage(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'courier');

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('../app/view/components'),
        ],'decorator-components');
    }
}
