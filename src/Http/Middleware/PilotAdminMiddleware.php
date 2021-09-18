<?php

namespace PEAVEL\Pilot\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class PilotAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        auth()->setDefaultDriver(app('PilotGuard'));

        if (!Auth::guest()) {
            $user = Auth::user();
            app()->setLocale($user->locale ?? app()->getLocale());

            return $user->hasPermission('browse_admin') ? $next($request) : redirect('/');
        }

        $urlLogin = route('pilot.login');

        return redirect()->guest($urlLogin);
    }
}
