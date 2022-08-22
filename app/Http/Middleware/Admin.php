<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // Check admin login
        if ( !Auth::guard('admin')->check() ) {
            return redirect(route('admin.login'));
        }

        // Show Google authenticator
//        if (config('app.env') === 'production') {
//            $secretCode = auth()->user()->ga_code;
//            if (!$secretCode || !session("2fa_verified")) {
//                return redirect()->route("2fa_scan");
//            }
//        }

        // Use default admin guard
        auth()->shouldUse('admin');

        return $next($request);
    }
}
