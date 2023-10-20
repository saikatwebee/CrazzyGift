<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyUser
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->is_verified === 0) {
            return redirect('/Myprofile');
        }

        return $next($request);
    }
}
?>