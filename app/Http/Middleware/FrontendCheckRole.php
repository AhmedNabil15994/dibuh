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

class FrontendCheckRole {

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
        $roles = explode('|', $roles);

        foreach ($roles as $role) {
            if ($request->user()->hasRole($role)) {
                if ($role != 'owner') {
                    return redirect(route('dashboard'));                                        
                    //return redirect('dashboard/' . $role);
                    
                }
            }
        }
        return $next($request);
    }

}
