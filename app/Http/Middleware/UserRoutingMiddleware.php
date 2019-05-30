<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Contracts\Container\Container;
use App\Http\Middleware\UserMiddleware;
use App\Http\Middleware\SalesmanMiddleware;
use App\Http\Middleware\AdvertiserMiddleware;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Zizaco\Entrust\EntrustRole;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Config;
class UserRoutingMiddleware {

    /**
     * @var Container
     */
    private $container;

    public function __construct(Container $container) {
        $this->container = $container;
    }

    private static $ROLES = [
        'user' => [
            'namespace' => 'User',
            'middleware' => UserMiddleware::class,
        ],
        'salesman' => [
            'namespace' => 'Salesman',
            'middleware' => SalesmanMiddleware::class,
        ],
        'advertiser' => [
            'namespace' => 'Advertiser',
            'middleware' => AdvertiserMiddleware::class,
        ]

    ];

    public function handle(Request $request, Closure $next, $guard = null) {

        if (!Auth::guard($guard)->check())
            return redirect(route('login'));

        $roleTbl = Auth::user()->roles;
        $roleArr = [];
        foreach ($roleTbl as $row) {
            //  if ($row->name !== 'owner')
//            $roleName = $row->name;
            $roleArr[] = $row->name; //ucfirst($row->name)
        }

        // check allowed roles to login to frontend if not found we redirect to home page
        $allowedRole = static::$ROLES;
 
        $found=false;
        foreach ($allowedRole as $roleKey => $roleVal) {
 
            foreach ($roleArr as $key => $val) {
                $roleName = $val;
                if ($roleKey == $roleName) {
                    $role = static::$ROLES[$roleName];
                    $found=true;
                }
                  
            }
 
        }
 
 
              if ($found !=true)
                return response()->view(Config::get('front_theme') . '.errors.102');          

 
            $action = $request->route()->getAction();
            //$role = static::$ROLES[$roleName];
            $namespace = $action['namespace'] . '\\' . $role['namespace'];
            $action['uses'] = str_replace($action['namespace'], $namespace, $action['uses']);
            $action['controller'] = str_replace($action['namespace'], $namespace, $action['controller']);
            $action['namespace'] = $namespace;

            $request->route()->setAction($action);

            return $this->container->make($role['middleware'])->handle($request, $next);
 
    }

}
