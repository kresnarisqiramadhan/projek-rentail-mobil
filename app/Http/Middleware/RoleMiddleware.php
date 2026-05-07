<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

/**
 * RoleMiddleware
 * Enforces RBAC per FR-A07, NFR-SEC-05.
 * Logs unauthorized access attempts per NFR-SEC-06.
 */
class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        if (!in_array($user->role->value, $roles, true)) {
            // Log unauthorized access attempt (NFR-SEC-06, FR-A07)
            Log::warning('Unauthorized access attempt', [
                'user_id'    => $user->id,
                'user_role'  => $user->role->value,
                'required'   => $roles,
                'url'        => $request->fullUrl(),
                'ip'         => $request->ip(),
            ]);

            abort(403, 'Akses tidak diizinkan.');
        }

        return $next($request);
    }
}
