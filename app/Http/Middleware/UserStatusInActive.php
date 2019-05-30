<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;
use Config;
use DB;

class UserStatusInActive {

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
    public function handle($request, Closure $next) {
        if (!$this->auth->guest()) {

            $userStatus = DB::table('user_profiles')->where('user_id', Auth::user()->id)->first()->user_status_id;

            if ($userStatus == 2) { // 
                //
                //return 'you can not view your account till you upgrade you plan'; 
                return response()->view(Config::get('front_theme') . '.errors.601');
            }

        }

        return $next($request);
    }

}
