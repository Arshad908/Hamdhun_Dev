<?php

namespace App\Http\Middleware;

use Closure;

class WebAdminMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if( !empty(session("account_logged_in")) ) {
            return $next($request);
        }

        return redirect()->route("site_login_ext");
        
    }
}
