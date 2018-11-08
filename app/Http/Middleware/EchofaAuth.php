<?php

namespace App\Http\Middleware;

use Closure;

class EchofaAuth
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
        if (Auth::guard('echofa')->check()) {
            return redirect('/home');
        }else{
            return redirect('echofa/login');
        }

        return $next($request);
    }
}
