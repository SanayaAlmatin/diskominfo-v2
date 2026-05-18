<?php

namespace App\Http\Middleware;

use App\Models\TmPageVisit;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackPageVisit
{
    public function handle(Request $request, Closure $next): Response
    {
        TmPageVisit::create([
            'ip_address' => $request->ip(),
            'page'       => $request->path(),
            'created_at' => now(),
        ]);

        return $next($request);
    }
}
