<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            //return route('login');
            if ($request->is('admin/*')) {
                return route('adminLogin'); // Replace 'admin.login' with the actual route name of your admin login page
            } else {
                return route('login'); // Replace 'login' with the actual route name of your user login page
            }
        }
    }
}
