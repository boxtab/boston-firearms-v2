<?php

namespace App\Http\Middleware;

use App\Constants\RoleAdminConstant;
use App\Constants\RoleInstructorConstant;
use App\Constants\RoleSuperAdminConstant;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AdminInstructorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\never
     */
    public function handle(Request $request, Closure $next)
    {
        $allowed = Auth::user()->getRoles()->pluck('slug')->contains(function ($value) {
            return $value === RoleInstructorConstant::SLUG || $value === RoleAdminConstant::SLUG;
        });

        if ( $allowed ) {
            return $next($request);
        }

        return abort(403);
    }
}
