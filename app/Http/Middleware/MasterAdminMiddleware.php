<?php

namespace App\Http\Middleware;

use Closure;
use Redirector;


class MasterAdminMiddleware
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
        //Check auth token
        //Auth id
        
        $admin_master_type = (session("ac_acc_type") == "") ? 0 : base64_decode(session("ac_acc_type"))+(-15200-0.254+854);

        if( $admin_master_type == env("APP_MASTER_ADMIN")  && session("ac_active_status") == 1 && session("active_flag") == env("APP_MASTER_ACTIVE")){

            return $next($request);
            
        }
            return redirect()->route("stfprocromb980123%123Load");    
        
        
        
    }
}
