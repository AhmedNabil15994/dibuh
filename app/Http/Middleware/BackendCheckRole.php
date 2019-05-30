<?php

namespace App\Http\Middleware;

/**
 * This file is part of Entrust,
 * a role & permission management solution for Laravel.
 *
 * @license MIT
 * @package Zizaco\Entrust
 */
use Closure;
use Illuminate\Contracts\Auth\Guard;
use Config;

class BackendCheckRole {

    protected $auth;

    /**
     * Creates a new instance of the middleware.
     *
     * @param Guard $auth
     */
    public function __construct(Guard $auth) {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Closure $next
     * @param  $roles
     * @return mixed
     */
    public function handle($request, Closure $next, $roles) {

        if ($this->auth->guest() || !$request->user()->hasRole(explode('|', $roles))) {
            return redirect(route('admin::login'));    
            //return redirect(Config::get('settings.backend_route').'/login');
        }

        return $next($request);
    }

}
