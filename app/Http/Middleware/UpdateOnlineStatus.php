<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class UpdateOnlineStatus
{
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {
            Cache::put('user-is-online-' . auth()->user()->id, true, now()->addMinutes(120));
        }
        return $next($request);
    }
}
