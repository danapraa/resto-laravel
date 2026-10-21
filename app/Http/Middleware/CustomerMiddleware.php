<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->user() && $request->user()->isAdmin()) {
            return redirect()
                ->route('admin.dashboard')
                ->with('error', 'Akun admin tidak dapat mengakses fitur customer.');
        }

        return $next($request);
    }
}
