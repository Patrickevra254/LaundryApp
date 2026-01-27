<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Throwable;

class Handler extends ExceptionHandler
{
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Handle unauthenticated users - especially for HTMX requests
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        // If it's an HTMX request, return 401 with HX-Redirect header
        if ($request->header('HX-Request')) {
            return response('Unauthorized', 401)
                ->header('HX-Redirect', route('login'));
        }

        // For regular requests, redirect normally
        return redirect()->guest(route('login'));
    }

    // REMOVE the redirectTo() method completely
}
