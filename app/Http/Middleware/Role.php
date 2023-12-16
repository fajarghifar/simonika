<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Role
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
		$allowAccess = false;

		if(auth()->check())
		{
			if($request->user()->role->name === $role) {
				$allowAccess = true;
			}
		}

		if(!$allowAccess) {
            abort(403, 'Sorry, you are not allowed to access this page. You may not have sufficient permissions or the required authorization.');
		}

		return $next($request);

    }

}
