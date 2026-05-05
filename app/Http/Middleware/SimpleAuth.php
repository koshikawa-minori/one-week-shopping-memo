<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SimpleAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $loggedIn = $request->session()->get('is_logged_in');
        $loginScreen  = $request->is('login');

        if(!$loggedIn && !$loginScreen) {
            return redirect()->route('login');
        }
        return $next($request);
    }
}
