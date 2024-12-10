<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProfileCompleteCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        $profileChecker = $user->shipping_type || $user->first_name;

        if (!$profileChecker) {
            return Inertia::render('User/Edit', ['middleware' => true]);
        }

        return $next($request);
    }
}
