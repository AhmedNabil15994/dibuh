<?php

namespace App\Http\Middleware;

use Debugbar;
use Closure;
use Redirect;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [];
    
    /*
  	public function handle( $request, Closure $next )
    {
        if ( $this->isReading($request) || $this->runningUnitTests() || $this->shouldPassThrough($request) || $this->tokensMatch($request) ) 
		{
            return $this->addCookieToResponse($request, $next($request));
        }
        
		else
		{
			Debugbar::info("Session-Token: " + $request->session()->token());
			Debugbar::info("Request-Token: " + $request->header('X-CSRF-TOKEN'));
		}
        // redirect the user back to the last page and show error
        return Redirect::back()->withError('Sorry, we could not verify your request. Please try again.');
    }    */
}
