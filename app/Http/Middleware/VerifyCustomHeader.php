<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyCustomHeader
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->header('X-Custom-Header') !== 'B9mU2TJe') {
            return response()->json(['error' => '認証に失敗しました'], 401);
        }

        return $next($request);
    }
}
