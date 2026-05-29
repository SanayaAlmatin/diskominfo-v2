<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PejabatDinasReadOnly
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user && $user->getCmsRole() === 'pejabat-dinas') {
            // Check action method
            $actionMethod = $request->route() ? $request->route()->getActionMethod() : null;
            
            // Allow only index and show
            if ($actionMethod && !in_array($actionMethod, ['index', 'show'])) {
                abort(403, 'Akses Ditolak. Role Pejabat Dinas hanya dapat melihat data (Read-Only).');
            }
        }

        return $next($request);
    }
}
