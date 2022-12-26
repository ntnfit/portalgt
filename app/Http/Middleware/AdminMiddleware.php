<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use Spatie\Permission\Models\Role;
class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
       $user = Auth::user();
       $roles = Role::pluck('name','name')->all();
       $userRole = $user->roles->pluck('name','name')->all();
        if(implode($userRole) == 'Admin'){
            return $next($request);
        } else
             abort(403, 'Wrong Accept Header');

        
    }
}
