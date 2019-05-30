<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Zizaco\Entrust\EntrustRole;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Contracts\Auth\Guard;


class UserTypeRedirectIfAuthenticated {

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
        if (!$this->auth->guest()) {
            foreach ($roles as $role) {
                if (!$request->user()->hasRole($role)) {
                     return redirect(route('dashboard.index') );
                }
            }
        }else{
                      return redirect('login/');  
        }
        return $next($request);
    }

}
