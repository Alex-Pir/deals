<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class XssSecurity
{
    public function handle(Request $request, Closure $next)
    {
        foreach ($request->all() as &$value) {
            $value = htmlspecialchars($value);
        }

        return $next($request);
    }
}
