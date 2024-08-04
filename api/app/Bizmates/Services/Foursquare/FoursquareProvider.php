<?php

namespace Bizmates\Services\Foursquare;

use Illuminate\Support\ServiceProvider;

class FoursquareProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton('bizmates-foursquare', function($app) {
            return new Foursquare(config('services.foursquare'));
        });

        $this->app->alias('bizmates-foursquare', Foursquare::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array<int, string>
     */
    public function provides(): array
    {
        return [
            'bizmates-foursquare',
            Foursquare::class,
        ];
    }
}
