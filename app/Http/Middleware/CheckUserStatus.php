<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check()) {

            $user1 = User::where('id', '=', auth()->user()->id)
                ->where(function ($query) {
                    $query->whereHas('invoices', function ($q) {
                        $q->where('status', '=', 1);
                    });
                    $query->orWhere('role', '=', 1);
                })
                ->first();
            if ($user1 == null) {
                Auth::logout();

                $request->session()->invalidate();

                $request->session()->regenerateToken();

                return redirect()->route('login')->with('error', 'Your Account is suspended, please contact Admin.');

            } else {
                return $next($request);
            }

        } else {

            return $next($request);
        }
    }
}
