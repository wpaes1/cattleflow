<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureEmailIsVerified
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::user() || !Auth::user()->hasVerifiedEmail()) {
            return response()->json(['message' => 'Seu e-mail não está verificado.'], 403);
        }

        return $next($request);
    }
}
