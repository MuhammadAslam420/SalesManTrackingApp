<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    // protected function redirectTo($request)
    // {
    //     if (!$request->expectsJson()) {
    //         return route('login');
    //     }
    // }

    public function handle($request, Closure $next, ...$guards)
    {
        if ($request->is('salesman*') && !Auth::guard('salesman')->check()) {
            return redirect()->route('salesman.login');
        }

        if ($request->is('admin*') && !Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        if ($request->is('customer*') && !Auth::guard('customer')->check()) {
            return redirect()->route('customer.login');
        }

        return $next($request);
    }
}
