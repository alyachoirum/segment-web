<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SesionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next,...$level_users)
    {
        if(in_array($request->user()->id_level_user, $level_users)){
            return $next($request);
        }
        return redirect('/dashboard');
    }
}
