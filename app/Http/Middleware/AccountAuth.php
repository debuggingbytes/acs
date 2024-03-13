<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $userLevel = Auth::user()->user_level;

            // Check user level and grant/deny access accordingly
            if ($userLevel >= "2") {
                return $next($request);
            } else {
                dd(Auth::user()->user_level . " This is the user level");
                return redirect()->route('home')->with('error', 'You do not have sufficient privileges to access this page.');
            }
        }

        // Redirect to login if the user is not authenticated
        return redirect()->route('login');
    }
}
