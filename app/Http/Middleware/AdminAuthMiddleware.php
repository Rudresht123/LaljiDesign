<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminAuthMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            // Redirect to the login route or homepage if unauthenticated
            return redirect()->route('login'); // Replace 'login' with the name of your login route
        }
        

        // Get the authenticated user
        $user = Auth::user();




    
    
        // Check if the user has the necessary permissions
        if (!$user->hasPermission($request->route()->getName())) {
            // Redirect to an unauthorized page or homepage
            return redirect()->route('unauthorized'); // Replace 'unauthorized' with the appropriate route
        }

        // Proceed with the next middleware/request
        return $next($request);
    }
}
