<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AutoRefreshMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Cek apakah respons adalah instance dari Response dan bertipe HTML
        if ($response instanceof Response && strpos($response->headers->get('Content-Type'), 'text/html') !== false) {
            $content = $response->getContent();

            // Tambahkan meta tag refresh di dalam tag <head>
            $refreshMeta = '<meta http-equiv="refresh" content="30">';
            $content = preg_replace(
                '/<head.*?>/i',
                '$0' . $refreshMeta,
                $content,
                1
            );

            $response->setContent($content);
        }

        return $response;
    }
}
