<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class Gate
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role)
    {

        $permissions = [
            1 => ['users', 'home'],
            10 => ['users', 'admin', 'home']
        ];

        if (!Auth::user()) {
            return redirect('login');
        }

        if (!in_array($role, $permissions[Auth::user()->role])) {
            abort(401);
        }

        return $next($request);
    }
}
