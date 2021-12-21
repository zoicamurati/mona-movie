<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class DateMiddleware
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
        $date = Carbon::now();
        $date = Carbon::parse('2021-12-25 00:00:00');

        if ($date->betweenIncluded('2021-12-25 00:00:00', '2021-12-25 23:59:59')) {
            return $next($request);
        } else {

            return response()->view('transaction');
        }

    }
}
