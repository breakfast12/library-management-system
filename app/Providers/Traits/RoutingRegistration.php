<?php

namespace App\Providers\Traits;

use Illuminate\Support\Facades\Route;

trait RoutingRegistration
{
    /**
     * Retrieve the routing paths from the config.
     *
     * @return array
     */
    protected function paths()
    {
        // Get the routing paths from the config file
        return config('routing.paths');
    }

    /**
     * Register the routes defined in the config.
     */
    protected function registeredRoutes(): void
    {
        // Get the list of routes from the paths method
        $routes = $this->paths();

        // Loop through each route configuration
        foreach ($routes as $route) {
            // Register the route with the specified prefix, middleware, and path
            Route::prefix($route['prefix'])
                ->middleware($route['middleware'])
                ->group($route['path']);
        }
    }
}
