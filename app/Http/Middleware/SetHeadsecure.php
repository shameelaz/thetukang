<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetHeadsecure
{
    /**
     *
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        // $response->withHeaders([
        //     'X-Frame-Options' => 'DENY',
        //     'X-XSS-Protection' => '1; mode=block',
        //     'X-Permitted-Cross-Domain-Policies' => 'master-only',
        //     'X-Content-Type-Options' => 'nosniff',
        //     'Referrer-Policy' => 'no-referrer-when-downgrade',
        //     'Strict-Transport-Security' => 'max-age=31536000; includeSubDomains',
        //     'Cache-Control' => 'no-cache, no-store, must-revalidate, post-check=0, pre-check=0',
        //     'Pragma' => 'no-cache',
        //     'Expires' => 'Sat, 26 Jul 1997 05:00:00 GMT',
        //     ]);

        return $response;
    }
}