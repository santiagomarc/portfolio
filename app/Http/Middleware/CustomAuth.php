<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class CustomAuth
{
    /**
     * Handle an incoming request.
     * 
     * This middleware checks if user is authenticated via session
     * If not authenticated, redirects to login page
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Session::get('logged_in')) {
            return redirect()->route('login')->withErrors([
                'access' => 'Please log in to access this page.'
            ]);
        }
        return $next($request);
    }
}