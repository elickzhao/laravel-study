<?php

namespace App\Http\Middleware;

use Closure;

class MiMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$gender)
    {
        if($request->age > 18 && $gender == $request->input('gender')){
            return $next($request);
        }else {
            return redirect()->route('mi::re');
        }
    }
}
