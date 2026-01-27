<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    // protected function redirectTo(Request $request): ?string
    // {
    //     // redirect to login page
    //     return $request->expectsJson() ? null : route('login');
    // }

    protected function redirectTo($request)
    {
        return $request->expectsJson()
            ? null
            : route('admin.login');

        // HTMX boosted or normal request → Force full redirect
        if ($request->header('hx-request') || $request->header('hx-boosted')) {
            abort(401, '', [
                'HX-Redirect' => route('login')
            ]);
        }

        return route('login');
    }
}

// route('login')

// protected function redirectTo(Request $request): ?string
// {
    // If it's not an AJAX/JSON request, redirect to login route
    // if (! $request->expectsJson()) {
    //     return route('login');
    // }

    // If it's an AJAX or API request, return null (Laravel will send 401)
    // return null;
// }
