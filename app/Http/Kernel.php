<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \App\Http\Middleware\Language::class, // language MiddleWare By Mahmoud            
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,

        ],

        'api' => [
            'throttle:60,1',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,             
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'can' => \Illuminate\Foundation\Http\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'admin.guest' => \App\Http\Middleware\AdminRedirectIfAuthenticated::class,   // middleware By Mahmoud
        'user.guest' => \App\Http\Middleware\UserRedirectIfAuthenticated::class,      //middleware By Mahmoud          
        'user.type' => \App\Http\Middleware\UserTypeRedirectIfAuthenticated::class,      //middleware By Mahmoud    
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'frontend.check.role' => \App\Http\Middleware\FrontendCheckRole::class, //middleware By Mahmoud            
        'backend.check.role' => \App\Http\Middleware\BackendCheckRole::class, //middleware By Mahmoud 
        'backend.access' => \App\Http\Middleware\BackendAccess::class, //middleware By Mahmoud             
        'role' => \Zizaco\Entrust\Middleware\EntrustRole::class, 
        'permission' => \Zizaco\Entrust\Middleware\EntrustPermission::class,
        'ability' => \Zizaco\Entrust\Middleware\EntrustAbility::class,        
        'status.inactive' =>  \App\Http\Middleware\UserStatusInActive::class, //middleware By Mahmoud  
        
    ];
}
