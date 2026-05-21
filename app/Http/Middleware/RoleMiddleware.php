<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        if (!in_array($user->role->value, $roles, true)) {
            Log::warning('Unauthorized access attempt', [
                'user_id'   => $user->id,
                'user_role' => $user->role->value,
                'required'  => $roles,
                'url'       => $request->fullUrl(),
                'ip'        => $request->ip(),
            ]);

            abort(403, 'Akses tidak diizinkan.');
        }

        return $next($request);
    }
}
