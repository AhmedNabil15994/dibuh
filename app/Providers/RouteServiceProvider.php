<?php

namespace App\Providers;

use Illuminate\Routing\Router;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;

class RouteServiceProvider extends ServiceProvider {

    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function boot() {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */


    public function map(Router $router, Request $request) {
        $locale = $request->segment(1);
        ///$locale = Request::segment(1);
        if (array_key_exists($locale, \Config::get('languages.available_locales'))) {
            \App::setLocale($locale);
        } else {
            $locale = null;
        }
        $this->mapWebRoutes($router, $locale);

    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    protected function mapWebRoutes(Router $router, $locale) {

        $router->group(['namespace' => $this->namespace, 'prefix' => $locale, 'middleware' => 'web',], function($router) {
            require app_path('Http/routes.php');
        });


    }

}
