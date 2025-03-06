<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RolePermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
          $route = $request->route();
        $routeName = $route ? $route->getName() : null;
       
        if (!$routeName || !auth()->user()->hasPermission($routeName)) {
  return redirect()->route('dashboard')->withErrors(['error' => 'You have not authorization to access this.']);

        }

        return $next($request);

    }
}
