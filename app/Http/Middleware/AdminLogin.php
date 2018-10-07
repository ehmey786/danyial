<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Route;
use Closure;
use Auth;

class AdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check() && $request->path() != "login") {
            return redirect('login');
        }
        if (Auth::user()) {//dd(Route::getCurrentRoute()->getName());
            if (Auth::user()->role_id != 1) {
                if (Route::getCurrentRoute()->getName() != 'save_comment' && Route::getCurrentRoute()->getName() != 'user.tasks' && Route::getCurrentRoute()->getName() != 'user.task_details') {
                    return redirect('user/' . Auth::user()->id . '/tasks');
                }
            }
        }
        return $next($request);
    }
}
