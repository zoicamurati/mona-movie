<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HasPaidMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user && $user->invoices()->where('status', 1)->exists()) {
            return $next($request);
        }

        return redirect()->route('createTransaction');
    }
}
