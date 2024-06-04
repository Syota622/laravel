<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyCustomHeader
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->header('X-Custom-Header') !== 'B9mU2TJe') {
            return response()->json(['error' => 'Authentication failed.'], 401);
        }

        return $next($request);
    }
}
