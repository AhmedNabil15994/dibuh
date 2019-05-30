<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Zizaco\Entrust\EntrustRole;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Config;
class AdminRedirectIfAuthenticated {

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null) {

        
        if (Auth::guard($guard)->check() && Auth::user()->is_admin==1) {            
            return redirect(route('admin::dashboard'));            
            //return redirect(Config::get('settings.backend_route').'/dashboard');
        } elseif (Auth::guard($guard)->check() && !Auth::user()->is_admin==1) {            
            return redirect(route('home.index'));            
            //return redirect('/');
        } else {
            // return redirect('/'); 
            return $next($request);
        }
    }

}
