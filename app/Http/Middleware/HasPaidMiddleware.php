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

        if ($user->role == 1) {
            return $next($request);
        }

        $validInvoice = $user && $user->invoices()
            ->where('status', 1)
            ->where('created_at', '>=', now()->subDays(3))
            ->exists();

        if ($validInvoice) {
            return $next($request);
        }

        if ($user && $user->invoices()->where('status', 1)->exists()) {
            return redirect()->route('access.expired');
        }

        return redirect()->route('createTransaction');
    }
}
