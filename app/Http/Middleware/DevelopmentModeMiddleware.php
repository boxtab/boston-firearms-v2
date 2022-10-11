<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class DevelopmentModeMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed|\never
     */
    public function handle(Request $request, Closure $next)
    {
        if (config('app.env') === 'local' && config('app.debug') === true) {
            return $next($request);
        }

        return abort(403);
    }
}
