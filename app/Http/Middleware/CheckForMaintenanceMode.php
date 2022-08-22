<?php

namespace App\Http\Middleware;

//use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as Middleware;
use Closure;

//class CheckForMaintenanceMode extends Middleware
class CheckForMaintenanceMode
{
    /**
     * The URIs that should be reachable while maintenance mode is enabled.
     *
     * @var array
     */
    protected $except = [
        //
    ];

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
        if (config('system.offline_status') == 'yes'
            && !app('request')->is('offline')
            && !app('request')->is('admin*')
            && !app('request')->is('media*')
            && !app('request')->is('login*')
            && !app('request')->is('password*')
        ) {
            return redirect(route('offline'));
        }

        if (config('system.offline_status') != 'yes'
            && app('request')->is('offline')
        ) {
            return redirect('/');
        }

        return $next($request);
    }
}
