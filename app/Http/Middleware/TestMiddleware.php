<?php

namespace App\Http\Middleware;

use Closure;

class TestMiddleware
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
        //dump($request->age); //两个一样
        //dump($request->input(age));  // 可以了应该这么写 write?age=19 后面那种写法必须在路由上加 write/{age}  不过input怎么都不对 write/19 还是 write/age=19
        if($request->input('age') < 18) {
            return redirect()->route('ro2::refuse');
        }
        return $next($request);
    }
}
